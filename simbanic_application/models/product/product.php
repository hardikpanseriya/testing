<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends Simba_Model
{
	public $request_data = array();
    public $db_data = array();
    public $vardefs = array();
	public $table = 'product';
	public $stock_table = 'stock';
	public $depot_order_product_table = 'depot_order_product';
	public $depot_invoice_product_table = 'depot_invoice_product';
	public $retailer_invoice_product_table = 'retailer_invoice_product';
	public $otc_prescription_table = 'otc_prescription';
	public $otc_prescription_product_table = 'otc_prescription_product';
	public $grid_search_field = array('name', 'id');
	public $grid_products_search_field = array('name', 'unit');

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

	public function get($id = 0)
	{
		$this->db->where('created_by', $id);
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

	public function getProducts($id, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		if($this->ion_auth->is_admin())
		{
			return $this->getAdminProductsStock($id, $limit, $start, $search_text, $count);
		}
		elseif($this->ion_auth->is_depot())
		{
			return $this->getDepotProductsStock($id, $limit, $start, $search_text, $count, $filter_data);
		}
		elseif($this->ion_auth->is_customer())
		{
			return $this->getCustomerProductsStock($id, $limit, $start, $search_text, $count, $filter_data);
		}
		else
		{
			return false;
		}
	}

	public function getAdminProductsStock($id, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array(), $new_add = array())
	{
		$admin_ids = $this->simba_init->getAllAdminID();

		$this->db->select('sp.*');
		$this->db->select('IFNULL(SUM(simba.quantity),0) - IFNULL(SUM(simbanic.qty), 0) as quantity', FALSE);
		$this->db->select('CONCAT_WS(" ", sp.name, sp.packing_size, sp.unit) AS simbanic_product_name', FALSE);
		$this->db->from($this->table.' as sp');
		//$this->db->join($this->stock_table.' as ss', "sp.id = ss.product_id AND ss.deleted = '0'", 'left');
		//$this->db->join($this->depot_invoice_product_table.' as sdip', "sp.id = sdip.product_id AND sdip.deleted = '0'", 'left');
		$this->db->join("( SELECT ss.product_id, SUM(ss.quantity) AS quantity FROM {PRE}stock AS ss 
				WHERE ss.deleted='0' 
				GROUP BY ss.product_id
			) AS simba", "sp.id = simba.product_id", 'left', FALSE);
		$this->db->join("( SELECT sdip.product_id, SUM(sdip.order_quantity) AS qty FROM {PRE}depot_invoice_product AS sdip 
				WHERE sdip.deleted='0' 
				GROUP BY sdip.product_id
			) AS simbanic", "sp.id = simbanic.product_id", 'left', FALSE);

		if(in_array($id, $admin_ids))
		{
			$this->db->where_in('sp.created_by', $admin_ids);
		}
		else
		{
			$this->db->where('sp.created_by', $id);
		}

		$this->db->where('sp.deleted', '0');

		if(!empty($filter_data))
		{
			if(count($filter_data) > 0)
			{
				foreach($filter_data as $key => $value)
				{
					$this->db->where_in('sp.id', $value);
				}
			}
		}

		if(!empty($new_add))
		{
			if(count($new_add) > 0)
			{
				foreach($new_add as $key => $value)
				{
					$this->db->where($key, $value);
				}
			}
		}

		if($search_text != '')
		{
			if(count($this->grid_search_field) > 0)
			{
				$search_item = '';
				$search_count = 1;
				foreach($this->grid_search_field as $search_field)
				{
					if($search_count == 1)
					{
						$search_item .= '(';
					}
					else
					{
						$search_item .= ' OR ';
					}
					
					$search_item .= "sp.". $search_field ." like '%". $search_text ."%'";
					if($search_count == count($this->grid_search_field))
					{
						$search_item .= ')';
					}

					$search_count++;
				}
				$this->db->where($search_item);
			}
		}

		if(empty($count) && !empty($limit))
		{
			if(($limit != '' && $start != '') || $start == 0)
			{
				$this->db->limit($limit, $start);
			}
		}

		$this->db->order_by("sp.name ASC, 
			IF(sp.unit = 'gm' OR sp.unit = 'ml', sp.packing_size, sp.name ) ASC,
			IF(sp.unit = 'kg' OR sp.unit = 'ltr', sp.packing_size, sp.name ) ASC ", FALSE);

		$this->db->group_by('sp.id');
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

	public function getDepotProductsStock($created_by = 0, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		$this->db->select('sdip.*');
		$this->db->select('IFNULL(SUM(sdip.order_quantity),0) - IFNULL(qty, 0) as quantity', FALSE);
		$this->db->select('CONCAT_WS(" ", sdip.name, sdip.packing_size, sdip.unit) AS simbanic_product_name', FALSE);
		$this->db->from($this->depot_invoice_product_table . ' as sdip');
		$this->db->join("( SELECT srip.product_id, SUM(srip.order_quantity) AS qty FROM {PRE}retailer_invoice_product AS srip 
				WHERE srip.created_by = ".$created_by." AND srip.deleted='0' 
				GROUP BY srip.product_id
			) AS simbanic", "sdip.product_id = simbanic.product_id", 'left', FALSE);

		$this->db->where('sdip.depot_id', (int)$created_by);
		$this->db->where('sdip.date_confirm IS NOT NULL');
		$this->db->where('sdip.deleted', '0');

		if(!empty($filter_data))
		{
			if(count($filter_data) > 0)
			{
				foreach($filter_data as $key => $value)
				{
					$this->db->where_in('sdip.product_id', $value);
				}
			}
		}

		if($search_text != '')
		{
			if(count($this->grid_products_search_field) > 0)
			{
				$search_item = '';
				$search_count = 1;
				foreach($this->grid_search_field as $search_field)
				{
					if($search_count == 1)
					{
						$search_item .= '(';
					}
					else
					{
						$search_item .= ' OR ';
					}
					
					$search_item .= "sdip.". $search_field ." like '%". $search_text ."%'";
					if($search_count == count($this->grid_search_field))
					{
						$search_item .= ')';
					}

					$search_count++;
				}
				$this->db->where($search_item);
			}
		}

		if(empty($count) && !empty($limit))
		{
			if(($limit != '' && $start != '') || $start == 0)
			{
				$this->db->limit($limit, $start);
			}
		}

		$this->db->order_by("sdip.name ASC, 
			IF(sdip.unit = 'gm' OR sdip.unit = 'ml', sdip.packing_size, sdip.name ) ASC,
			IF(sdip.unit = 'kg' OR sdip.unit = 'ltr', sdip.packing_size, sdip.name ) ASC ", FALSE);
		$this->db->group_by('sdip.product_id');

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

	public function getCustomerProductsStock($user_id = 0, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		$this->db->select('srip.*', FALSE);
		$this->db->select('IFNULL(SUM(srip.order_quantity),0) - IFNULL(qty, 0) - IFNULL(opQty, 0) as quantity', FALSE);
		$this->db->select('CONCAT_WS(" ", srip.name, srip.packing_size, srip.unit) AS simbanic_product_name', FALSE);
		$this->db->select('IF(srip.unit="kg" OR srip.unit="ltr", srip.packing_size * (IFNULL(SUM(srip.order_quantity),0) - IFNULL(qty, 0) - IFNULL(opQty, 0)), TRUNCATE((srip.packing_size / 1000) * (IFNULL(SUM(srip.order_quantity),0) - IFNULL(qty, 0) - IFNULL(opQty, 0)), 2)) As product_unit', FALSE);
		
		$this->db->from($this->retailer_invoice_product_table . ' as srip');

		$this->db->join("( SELECT spip.product_id, SUM(spip.quantity) AS qty FROM {PRE}prescription_invoice_product AS spip 
				WHERE spip.created_by = ".$user_id." AND spip.deleted='0' 
				GROUP BY spip.product_id
			) AS simbanic", "srip.product_id = simbanic.product_id", 'left', FALSE);
		$this->db->join("( SELECT sopp.product_id, SUM(sopp.quantity) AS opQty FROM {PRE}otc_prescription_product AS sopp 
				WHERE sopp.created_by = ". $user_id ." AND sopp.deleted='0' 
				GROUP BY sopp.product_id
			) AS simba", "srip.product_id = simba.product_id", 'left', FALSE);

		$this->db->where('srip.retailer_id', (int)$user_id);
		$this->db->where('srip.date_confirm IS NOT NULL');
		$this->db->where('srip.deleted', '0');

		if(!empty($filter_data))
		{
			if(count($filter_data) > 0)
			{
				foreach($filter_data as $key => $value)
				{
					if($value != '')
					{
						$this->db->where($key, $value, FALSE);
					}
				}
			}
		}

		if($search_text != '')
		{
			if(count($this->grid_products_search_field) > 0)
			{
				$search_item = '';
				$search_count = 1;
				foreach($this->grid_search_field as $search_field)
				{
					if($search_count == 1)
					{
						$search_item .= '(';
					}
					else
					{
						$search_item .= ' OR ';
					}
					
					$search_item .= "srip.". $search_field ." like '%". $search_text ."%'";
					if($search_count == count($this->grid_search_field))
					{
						$search_item .= ')';
					}

					$search_count++;
				}
				$this->db->where($search_item);
			}
		}

		if(empty($count) && !empty($limit))
		{
			if(($limit != '' && $start != '') || $start == 0)
			{
				$this->db->limit($limit, $start);
			}
		}

		$this->db->order_by("srip.name ASC, 
			IF(srip.unit = 'gm' OR srip.unit = 'ml', srip.packing_size, srip.name ) ASC,
			IF(srip.unit = 'kg' OR srip.unit = 'ltr', srip.packing_size, srip.name ) ASC ", FALSE);

		$this->db->group_by('srip.product_id, srip.unit');

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

	public function getTotalCustomerProductsStockUnit($id, $filter_data = array())
	{
		$this->db->select('TRUNCATE(SUM(IFNULL(IF(srip.unit="kg" OR srip.unit="ltr", srip.packing_size * IFNULL(srip.order_quantity, 0), (srip.packing_size / 1000) * IFNULL(srip.order_quantity, 0)), 0)), 2) As product_unit', FALSE);
		$this->db->from($this->retailer_invoice_product_table . ' as srip');
		$this->db->where('retailer_id', (int)$id);
		$this->db->where('srip.deleted', '0');
		$this->db->where('srip.date_confirm IS NOT NULL');

		if(!empty($filter_data))
		{
			if(count($filter_data) > 0)
			{
				foreach($filter_data as $key => $value)
				{
					if($value != '')
					{
						$this->db->where($key, $value, FALSE);	
					}
				}
			}
		}
		
		$this->db->group_by('retailer_id');
		$result = $this->db->get();
		
		if ($result->num_rows() > 0)
        {
            return $result->row()->product_unit;
        }
        else
        {
            return false;
        }
	}

	public function checkCustomerProductStockQty($user_id, $product_id, $given_qty)
	{
		$this->db->select('IFNULL(SUM(srip.order_quantity),0) - IFNULL(qty, 0) - IFNULL(opQty, 0) as quantity', FALSE);
		$this->db->from($this->retailer_invoice_product_table . ' as srip');

		$this->db->join("( SELECT spip.product_id, SUM(spip.quantity) AS qty FROM {PRE}prescription_invoice_product AS spip 
				WHERE spip.created_by = ".$user_id." AND spip.product_id = " . $product_id . " AND spip.deleted='0' 
				GROUP BY spip.product_id
			) AS simbanic", "srip.product_id = simbanic.product_id", 'left', FALSE);

		$this->db->join("( SELECT sopp.product_id, SUM(sopp.quantity) AS opQty FROM {PRE}otc_prescription_product AS sopp 
				WHERE sopp.created_by = ". $user_id ." AND sopp.deleted='0' 
				GROUP BY sopp.product_id
			) AS simba", "srip.product_id = simba.product_id", 'left', FALSE);

		$this->db->where('srip.retailer_id', (int)$user_id);
		$this->db->where('srip.product_id', (int)$product_id);
		$this->db->where('srip.date_confirm IS NOT NULL');
		$this->db->where('srip.deleted', '0');
		$this->db->order_by('srip.name', 'ASC');
		$this->db->group_by('srip.product_id');
		$result = $this->db->get();

		//echo $this->db->last_query();
		
		if ($result->num_rows() == 1)
        {
        	$qty = $result->row()->quantity;
        	if($qty >= $given_qty)
        	{
    			return true;
        	}
        	else
        	{
        		return false;
        	}
        }
        else
        {
            return false;
        }
	}
}
?>