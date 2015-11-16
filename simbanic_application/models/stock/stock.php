<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock extends Simba_Model
{
	public $request_data = array();
    public $db_data = array();
    public $vardefs = array();
	public $table = 'stock';
	public $depot_invoice_product_table = 'depot_invoice_product';
	public $retailer_invoice_product_table = 'retailer_invoice_product';
	public $product_table = 'product';
	public $grid_search_field = array('batch_no');

	public function __construct()
	{
		parent::__construct();
		$this->init();
	}

	public function init()
	{
		$this->setTableName($this->table);
		$this->loadVarDefs();
	}

	public function setTableName($table)
	{
		$this->table = $table;
	}

	public function get($id = 0, $product_id)
	{
		$this->db->where('created_by', $id);
		$this->db->where('product_id', $product_id);
		$this->db->where('deleted', '0');
		$this->db->order_by('id', 'DESC');
		$result = $this->db->get($this->table);
		if ($result->num_rows() > 0)
        {
            return $result->result();
        }
        else
        {
            return false;
        }
	}

	public function getProductStocks($id, $product_id, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		if($this->ion_auth->is_admin())
		{
			return $this->getAdminProductStocks($id, $product_id, $limit, $start, $search_text, $count);
		}
		elseif($this->ion_auth->is_depot())
		{
			return $this->getDepotProductStocks($id, $product_id, $limit, $start, $search_text, $count, $filter_data);
		}
		elseif($this->ion_auth->is_customer())
		{
			return $this->getCustomerProductStocks($id, $limit, $start, $search_text, $count, $filter_data);
		}
		else
		{
			return false;
		}
	}

	public function getAdminProductStocks($id, $product_id, $limit = '', $start = '', $search_text = '', $count = '')
	{
		$admin_ids = $this->simba_init->getAllAdminID();
		$this->db->select('*');
		$this->db->select('IFNULL(ss.quantity, 0) - IFNULL(simbanic.qty, 0) as remaining_quantity', FALSE);
		$this->db->select('DATE_FORMAT(ss.expiry_date, "%d-%m-%Y") as expiry_date', FALSE);
		$this->db->from($this->table.' as ss');
		$this->db->join("( SELECT sdip.product_id, sdip.stock_id, IFNULL(SUM(sdip.order_quantity), 0) AS qty FROM {PRE}depot_invoice_product AS sdip 
				WHERE sdip.product_id = ". $product_id ." AND sdip.deleted='0' 
				GROUP BY sdip.product_id,sdip.stock_id
			) AS simbanic", "ss.id = simbanic.stock_id AND ss.product_id = simbanic.product_id", 'left', FALSE);
		if(in_array($id, $admin_ids))
		{
			$this->db->where_in('ss.created_by', $admin_ids);
		}
		else
		{
			$this->db->where('ss.created_by', $id);
		}

		$this->db->where('ss.product_id', $product_id);
		$this->db->where('ss.deleted', '0');

		if($search_text != '')
		{
			if(count($this->grid_search_field) > 0)
			{
				foreach($this->grid_search_field as $search_field)
				{
					if(count($this->grid_search_field) == 1)
					{
						$this->db->like($search_field, $search_text);	
					}
					else
					{
						$this->db->or_like($search_field, $search_text);
					}
				}
			}
		}

		if(empty($count) && !empty($limit))
		{
			if(($limit != '' && $start != '') || $start == 0)
			{
				$this->db->limit($limit, $start);
			}
		}

		$this->db->order_by('ss.id', 'DESC');
		$result = $this->db->get();
		//echo $this->db->last_query();
		//die();
		if(empty($count))
		{
			if ($result->num_rows() > 0)
	        {
	            return $result->result();
	        }
	        else
	        {
	            return false;
	        }
		}
		else
		{
			return $result->num_rows();
		}
	}

	public function getDepotProductStocks($id, $product_id, $limit = '', $start = '', $search_text = '', $count = '')
	{
		$this->db->select('sdip.batch_no');
		$this->db->select('IFNULL(SUM(sdip.order_quantity), 0) As quantity', FALSE);
		$this->db->select('IFNULL(SUM(sdip.order_quantity), 0) - IFNULL(simbanic.qty, 0) as remaining_quantity', FALSE);
		$this->db->select('DATE_FORMAT(sdip.expiry_date, "%d-%m-%Y") as expiry_date', FALSE);
		$this->db->from($this->depot_invoice_product_table.' as sdip');
		$this->db->join("( SELECT srip.product_id, srip.stock_id, IFNULL(SUM(srip.order_quantity), 0) AS qty FROM {PRE}retailer_invoice_product AS srip 
				WHERE srip.created_by = ". (int)$id ." AND srip.product_id = ". $product_id ." AND srip.deleted='0' 
				GROUP BY srip.product_id, srip.stock_id
			) AS simbanic", "sdip.stock_id = simbanic.stock_id AND sdip.product_id = simbanic.product_id", 'left', FALSE);

		$this->db->where('sdip.depot_id', (int)$id);
		$this->db->where('sdip.product_id', $product_id);
		$this->db->where('sdip.date_confirm IS NOT NULL');
		$this->db->where('sdip.deleted', '0');

		if($search_text != '')
		{
			if(count($this->grid_search_field) > 0)
			{
				foreach($this->grid_search_field as $search_field)
				{
					if(count($this->grid_search_field) == 1)
					{
						$this->db->like($search_field, $search_text);	
					}
					else
					{
						$this->db->or_like($search_field, $search_text);
					}
				}
			}
		}

		if(empty($count) && !empty($limit))
		{
			if(($limit != '' && $start != '') || $start == 0)
			{
				$this->db->limit($limit, $start);
			}
		}

		$this->db->group_by('sdip.product_id, sdip.stock_id');
		$this->db->order_by('sdip.stock_id', 'DESC');
		$result = $this->db->get();
		//echo $this->db->last_query();
		//die();
		if(empty($count))
		{
			if ($result->num_rows() > 0)
	        {
	            return $result->result();
	        }
	        else
	        {
	            return false;
	        }
		}
		else
		{
			return $result->num_rows();
		}
	}

	public function getCustomerProductStocks($id, $product_id, $limit = '', $start = '', $search_text = '', $count = '')
	{
		return false;
	}
}
?>