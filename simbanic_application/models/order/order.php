<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends Simba_Model
{
	public $request_data = array();
    public $db_data = array();
    public $vardefs = array();
	public $table = 'depot_order';
	public $depot_order_product_table = 'depot_order_product';
	public $retailer_order_table = 'retailer_order';
	public $retailer_order_product_table = 'retailer_order_product';
	public $user_table = 'user';
	public $product_table = 'product';
	public $stock_table = 'stock';
	public $depot_invoice_table = 'depot_invoice';
	public $depot_invoice_product_table = 'depot_invoice_product';
	public $retailer_invoice_product_table = 'retailer_invoice_product';
	public $grid_search_field = array('id', 'status', 'full_name');
	public $grid_products_search_field = array('name');

	public function __construct()
	{
		parent::__construct();
		$this->init();
	}

	public function init()
	{
		$this->setTableName($this->table);
	}

	public function setTableName($table)
	{
		$this->table = $table;
	}

	public function getOrder($order_id)
	{
		if($this->ion_auth->is_admin())
		{
			return $this->getDepotOrder($order_id);
		}
		elseif($this->ion_auth->is_depot())
		{
			return $this->getDepotOrder($order_id);
		}
		elseif($this->ion_auth->is_customer())
		{
			return $this->getCustomerOrder($order_id);
		}
		else
		{
			return false;
		}
	}

	public function getDepotOrder($order_id)
	{
		$this->db->where('id', $order_id);
		$result = $this->db->get($this->table);
		if ($result->num_rows() == 1)
        {
            return $result->row();
        }
        else
        {
            return false;
        }
	}

	public function getCustomerOrder($order_id)
	{
		$this->db->where('id', $order_id);
		$result = $this->db->get($this->retailer_order_table);
		if ($result->num_rows() == 1)
        {
            return $result->row();
        }
        else
        {
            return false;
        }
	}

	public function getOrders($id, $limit = '', $start = '', $search_text = '', $count = '', $next_prevoius = array())
	{
		if($this->ion_auth->is_admin())
		{
			return $this->getAdminOrders($id, $limit, $start, $search_text, $count, $next_prevoius);
		}
		elseif($this->ion_auth->is_depot())
		{
			return $this->getDepotOrders($id, $limit, $start, $search_text, $count, $next_prevoius);
		}
		elseif($this->ion_auth->is_customer())
		{
			return $this->getCustomerOrders($id, $limit, $start, $search_text, $count, $next_prevoius);
		}
		else
		{
			return false;
		}
	}

	public function getAdminOrders($id, $limit = '', $start = '', $search_text = '', $count = '', $next_prevoius = array())
	{
		$this->db->select('sdo.*, su.full_name, DATE_FORMAT(sdo.date_modified, "%d-%m-%Y") as date', FALSE);
		$this->db->select('IF(sdo.status = "", "", LOWER(sdo.status)) as status_class', FALSE);
		$this->db->select('sdi.id AS invoice_id');
		$this->db->from($this->table .' AS sdo');
		$this->db->join($this->depot_invoice_table . ' AS sdi', 'sdo.id = sdi.depot_order_id', 'left');
		$this->db->join($this->user_table . ' AS su', 'sdo.created_by = su.id', 'left');
		$this->db->where('sdo.deleted', '0');

		// next and previous order
		if(!empty($next_prevoius) && count($next_prevoius) > 0)
		{
			$order_order_id = $next_prevoius['order_id'];
			$order_next_previous = $next_prevoius['next_previous_name'];
			$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
			if (strpos($url, 'order/view') !== false)
			{
				if($order_next_previous == 'next')
				{
					$this->db->where('sdo.id', "(SELECT MIN(sdo.id) FROM {PRE}depot_order as sdo WHERE sdo.id > ". $order_order_id ." AND sdo.deleted = '0')", FALSE);
				}
				elseif($order_next_previous == 'previous')
				{
					$this->db->where('sdo.id', "(SELECT MAX(sdo.id) FROM {PRE}depot_order as sdo WHERE sdo.id < ". $order_order_id ." AND sdo.deleted = '0')", FALSE);
				}
			}
		}

		if($search_text != '')
		{
			if(count($this->grid_search_field) > 0)
			{
				foreach($this->grid_search_field as $search_field)
				{
					if(count($this->grid_search_field) == 1)
					{
						if($search_field == 'full_name')
						{
							$this->db->like('su.'.$search_field, $search_text);
						}
						else
						{
							$this->db->like('sdo.'.$search_field, $search_text);
						}
					}
					else
					{
						if($search_field == 'full_name')
						{
							$this->db->or_like('su.'.$search_field, $search_text);
						}
						else
						{
							$this->db->or_like('sdo.'.$search_field, $search_text);	
						}
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

		$this->db->order_by('sdo.id', 'DESC');

		$result = $this->db->get();
		
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

	public function getDepotOrders($id, $limit = '', $start = '', $search_text = '', $count = '', $next_prevoius = array())
	{
		$this->db->select('sdo.*, su.full_name, DATE_FORMAT(sdo.date_modified, "%d-%m-%Y") as date', FALSE);
		$this->db->select('IF(sdo.status = "", "", LOWER(sdo.status)) as status_class', FALSE);
		$this->db->from($this->table .' AS sdo');
		$this->db->join($this->user_table . ' AS su', 'sdo.created_by = su.id', 'left');
		$this->db->where('sdo.created_by', $id);
		$this->db->where('sdo.deleted', '0');

		// next and previous order
		if(!empty($next_prevoius) && count($next_prevoius) > 0)
		{
			$order_order_id = $next_prevoius['order_id'];
			$order_next_previous = $next_prevoius['next_previous_name'];
			$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
			if (strpos($url, 'order/view') !== false)
			{
				if($order_next_previous == 'next')
				{
					$this->db->where('sdo.id', "(SELECT MIN(sdo.id) FROM {PRE}depot_order as sdo WHERE sdo.id > ". $order_order_id ." AND sdo.created_by = ". $id ." AND sdo.deleted = '0')", FALSE);
				}
				elseif($order_next_previous == 'previous')
				{
					$this->db->where('sdo.id', "(SELECT MAX(sdo.id) FROM {PRE}depot_order as sdo WHERE sdo.id < ". $order_order_id ." AND sdo.created_by = ". $id ." AND sdo.deleted = '0')", FALSE);
				}
			}
		}

		if($search_text != '')
		{
			if(count($this->grid_search_field) > 0)
			{
				foreach($this->grid_search_field as $search_field)
				{
					if(count($this->grid_search_field) == 1)
					{
						if($search_field == 'full_name')
						{
							$this->db->like('su.'.$search_field, $search_text);
						}
						else
						{
							$this->db->like('sdo.'.$search_field, $search_text);
						}
					}
					else
					{
						if($search_field == 'full_name')
						{
							$this->db->or_like('su.'.$search_field, $search_text);
						}
						else
						{
							$this->db->or_like('sdo.'.$search_field, $search_text);	
						}
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

		$this->db->order_by('sdo.id', 'DESC');

		$result = $this->db->get();
		//echo $this->db->last_query();
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

	public function getCustomerOrders($id, $limit = '', $start = '', $search_text = '', $count = '', $next_prevoius = array())
	{
		$this->db->select('*, DATE_FORMAT(date_modified, "%d-%m-%Y") as date', FALSE);
		$this->db->select('IF(status = "", "", LOWER(status)) as status_class', FALSE);

		$this->db->where('retailer_id', $id);
		$this->db->where('deleted', '0');

		// next and previous order
		if(!empty($next_prevoius) && count($next_prevoius) > 0)
		{
			$order_order_id = $next_prevoius['order_id'];
			$order_next_previous = $next_prevoius['next_previous_name'];
			$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
			if (strpos($url, 'order/view') !== false)
			{
				if($order_next_previous == 'next')
				{
					$this->db->where('id', "(SELECT MIN(sro.id) FROM {PRE}retailer_order as sro WHERE sro.id > ". $order_order_id ." AND sro.deleted = '0')", FALSE);
				}
				elseif($order_next_previous == 'previous')
				{
					$this->db->where('id', "(SELECT MAX(sro.id) FROM {PRE}retailer_order as sro WHERE sro.id < ". $order_order_id ." AND sro.deleted = '0')", FALSE);
				}
			}
		}

		if($search_text != '')
		{
			if(count($this->grid_search_field) > 0)
			{
				foreach($this->grid_search_field as $search_field)
				{
					if(count($this->grid_search_field) == 1)
					{
						if($search_field == 'full_name')
						{
							$this->db->like($search_field, $search_text);
						}
						else
						{
							$this->db->like($search_field, $search_text);
						}
					}
					else
					{
						if($search_field == 'full_name')
						{
							$this->db->or_like($search_field, $search_text);
						}
						else
						{
							$this->db->or_like($search_field, $search_text);	
						}
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

		$this->db->order_by('id', 'DESC');

		$result = $this->db->get($this->retailer_order_table);
		
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

	public function getOrderCreateProducts($id, $limit = '', $start = '', $search_text = '', $count = '')
	{
		if($this->ion_auth->is_admin())
		{
			return $this->getDepotOrderCreateProducts($id, $limit, $start, $search_text, $count);
		}
		elseif($this->ion_auth->is_depot())
		{
			return $this->getDepotOrderCreateProducts($id, $limit, $start, $search_text, $count);
		}
		elseif($this->ion_auth->is_customer())
		{
			return $this->getCustomerOrderCreateProducts($id, $limit, $start, $search_text, $count);
		}
		else
		{
			return false;
		}
	}

	public function getDepotOrderCreateProducts($id, $limit = '', $start = '', $search_text = '', $count = '')
	{
		$admin_ids = $this->simba_init->getAllAdminID();
		$this->db->select('*');
		$this->db->select('CONCAT_WS(" ", name, packing_size, unit) AS simbanic_product_name', FALSE);
		//$this->db->select('CONCAT_WS(" ", packing_size, unit) AS simba_packing_size', FALSE);
		$this->db->where_in('created_by', $admin_ids);
		$this->db->where('deleted', '0');

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

		$this->db->order_by('name', 'ASC');

		$result = $this->db->get($this->product_table);
		
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

	public function getCustomerOrderCreateProducts($id, $limit = '', $start = '', $search_text = '', $count = '')
	{
		// Here $id as depot_id not login id.
		$this->db->select('sdip.*, CONCAT_WS(" ", sdip.name, sdip.packing_size, sdip.unit) AS simbanic_product_name', FALSE);
		$this->db->from($this->depot_invoice_product_table . ' as sdip');
		$this->db->where('sdip.depot_id', (int)$id);
		$this->db->where('sdip.date_confirm IS NULL');
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

		$this->db->order_by('sdip.name', 'ASC');
		$this->db->group_by('sdip.product_id');
		
		$result = $this->db->get();
		
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

	public function getOrderProducts($id, $order_table = '', $limit = '', $start = '', $search_text = '', $count = '')
	{
		if(!empty($order_table))
		{
			if($order_table == 'depot')
			{
				return $this->getDepotOrderProducts($id, $limit, $start, $search_text, $count);
			}
			else
			{
				return $this->getRetailerOrderProducts($id, $limit, $start, $search_text, $count);
			}
		}
		else
		{
			return false;	
		}
	}

	public function getDepotOrderProducts($order_id, $limit = '', $start = '', $search_text = '', $count = '')
	{
		$this->db->from($this->depot_order_product_table . ' as sdop');
		$this->db->select('*');
		$this->db->select('CONCAT_WS(" ", sdop.name, sdop.packing_size, sdop.unit) AS simbanic_product_name', FALSE);
		$this->db->where('sdop.depot_order_id', (int)$order_id);
		$this->db->where('sdop.deleted', '0');

		if($search_text != '')
		{
			if(count($this->grid_products_search_field) > 0)
			{
				foreach($this->grid_products_search_field as $search_field)
				{
					if(count($this->grid_products_search_field) == 1)
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
		$this->db->order_by('sdop.name', 'ASC');
		$result = $this->db->get();
		
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

	public function getRetailerOrderProducts($order_id, $limit = '', $start = '', $search_text = '', $count = '')
	{
		$this->db->from($this->retailer_order_product_table . ' as srop');
		$this->db->select('*');
		$this->db->select('CONCAT_WS(" ", srop.name, srop.packing_size, srop.unit) AS simbanic_product_name', FALSE);
		//$this->db->select('CONCAT_WS(" ", packing_size, unit) AS simba_packing_size', FALSE);
		$this->db->where('srop.retailer_order_id', (int)$order_id);
		$this->db->where('srop.deleted', '0');

		if($search_text != '')
		{
			if(count($this->grid_products_search_field) > 0)
			{
				foreach($this->grid_products_search_field as $search_field)
				{
					if(count($this->grid_products_search_field) == 1)
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
		$this->db->order_by('srop.name', 'ASC');
		$result = $this->db->get();
		
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

	public function checkQuantity($id, $order_id)
	{
		$this->db->select('sdop.product_id, sdop.quantity');
		$this->db->select('CONCAT_WS(" ", sdop.name, sdop.packing_size, sdop.unit) AS simbanic_product_name', FALSE);
		$this->db->select('(IFNULL(SUM(simba.quantity), 0) - IFNULL(SUM(simbanic.qty), 0)) >= sdop.quantity AS sufficient_qty', FALSE);
		$this->db->from($this->depot_order_product_table . ' as sdop');
		$this->db->join("( SELECT ss.product_id, SUM(ss.quantity) AS quantity FROM {PRE}stock AS ss 
				WHERE ss.deleted='0' 
				GROUP BY ss.product_id
			) AS simba", "sdop.product_id = simba.product_id ", 'left', FALSE);
		$this->db->join("( SELECT sdip.product_id, SUM(sdip.order_quantity) AS qty FROM {PRE}depot_invoice_product AS sdip 
				WHERE sdip.deleted='0' 
				GROUP BY sdip.product_id
			) AS simbanic", "sdop.product_id = simbanic.product_id", 'left', FALSE);

		$this->db->where('sdop.depot_order_id', (int)$order_id);
		$this->db->where('sdop.deleted', '0');
		$this->db->group_by('sdop.product_id');
		$result = $this->db->get();
		//echo $this->db->last_query();
		
		if ($result->num_rows() > 0)
        {
            return $result->result();
        }
        else
        {
            return false;
        }
	}
}
?>