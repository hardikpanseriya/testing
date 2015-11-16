<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice extends Simba_Model
{
	public $request_data = array();
    public $db_data = array();
    public $vardefs = array();
	public $table = 'depot_invoice';
	public $retailer_invoice_table = 'retailer_invoice';
	public $depot_invoice_product_table = 'depot_invoice_product';
	public $depot_order_product_table = 'depot_order_product';
	public $retailer_order_product_table = 'retailer_order_product';
	public $retailer_invoice_product_table = 'retailer_invoice_product';
	public $user_table = 'user';
	public $product_table = 'product';
	public $stock_table = 'stock';
	public $grid_search_field = array('invoice_no', 'full_name');
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

	public function getInvoice($invoice_id)
	{
		if($this->ion_auth->is_admin())
		{
			return $this->getDepotInvoice($invoice_id);
		}
		elseif($this->ion_auth->is_depot())
		{
			if($this->input->get_post('view'))
			{
				return $this->getCustomerInvoice($invoice_id);
			}
			else
			{
				return $this->getDepotInvoice($invoice_id);	
			}
		}
		elseif($this->ion_auth->is_customer())
		{
			return $this->getCustomerInvoice($invoice_id);
		}
		else
		{
			return false;
		}
	}

	public function getDepotInvoice($invoice_id)
	{
		$this->db->where('id', $invoice_id);
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

	public function getCustomerInvoice($invoice_id)
	{
		$this->db->where('id', $invoice_id);
		$result = $this->db->get($this->retailer_invoice_table);
		if ($result->num_rows() == 1)
        {
            return $result->row();
        }
        else
        {
            return false;
        }
	}

	public function getInvoices($id, $limit = '', $start = '', $search_text = '', $count = '', $next_prevoius = array(), $filter_data = array())
	{
		if($this->ion_auth->is_admin())
		{
			return $this->getAdminInvoices($id, $limit, $start, $search_text, $count, $next_prevoius);
		}
		elseif($this->ion_auth->is_depot())
		{
			return $this->getDepotInvoices($id, $limit, $start, $search_text, $count, $next_prevoius);
		}
		elseif($this->ion_auth->is_customer())
		{
			return $this->getCustomerInvoices($id, $limit, $start, $search_text, $count, $next_prevoius, $filter_data);
		}
		else
		{
			return false;
		}
	}

	public function getAdminInvoices($id = 0, $limit = '', $start = '', $search_text = '', $count = '', $next_prevoius = array())
	{
		$admin_ids = $this->simba_init->getAllAdminID();

		$this->db->select('sdi.*, su.full_name, DATE_FORMAT(sdi.date_created, "%d-%m-%Y") as date', FALSE);
		$this->db->select('SUM(IFNULL((sdip.order_quantity * sdip.price),0)) as invoice_total', false);
		$this->db->from($this->table . ' AS sdi');
		$this->db->join($this->depot_invoice_product_table . ' AS sdip', "sdi.id = sdip.depot_invoice_id AND sdip.deleted = '0'", 'left');
		$this->db->join($this->user_table . ' AS su', 'sdi.depot_id = su.id', 'left');

		if(in_array($id, $admin_ids))
		{
			$this->db->where_in('sdi.created_by', $admin_ids);
		}
		else
		{
			$this->db->where('sdi.created_by', $id);
		}
		
		$this->db->where('sdi.deleted', '0');

		// next and previous invoice
		if(!empty($next_prevoius) && count($next_prevoius) > 0)
		{
			$invoice_invoice_id = $next_prevoius['invoice_id'];
			$invoice_next_previous = $next_prevoius['next_previous_name'];
			$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
			if (strpos($url, 'invoice/view') !== false)
			{
				if($invoice_next_previous == 'next')
				{
					$this->db->where('sdi.id', "(SELECT MIN(sdi.id) FROM {PRE}depot_invoice as sdi WHERE sdi.id > ". $invoice_invoice_id ." AND sdi.deleted = '0')", FALSE);
				}
				elseif($invoice_next_previous == 'previous')
				{
					$this->db->where('sdi.id', "(SELECT MAX(sdi.id) FROM {PRE}depot_invoice as sdi WHERE sdi.id < ". $invoice_invoice_id ." AND sdi.deleted = '0')", FALSE);
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
					if($search_field == 'full_name')
					{
						$search_item .= "su.". $search_field ." like '%". $search_text ."%'";
					}
					else
					{
						$search_item .= "sdi.". $search_field ." like '%". $search_text ."%'";
					}
					
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

		$this->db->group_by('sdi.id');
		$this->db->order_by('sdi.id', 'DESC');

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

	public function getDepotInvoices($id = 0, $limit = '', $start = '', $search_text = '', $count = '', $next_prevoius = array())
	{
		$this->db->select('sdi.*, su.full_name, DATE_FORMAT(sdi.date_created, "%d-%m-%Y") as date', FALSE);
		$this->db->select('SUM(IFNULL((sdip.order_quantity * sdip.price),0)) as invoice_total', false);
		$this->db->from($this->table . ' AS sdi');
		$this->db->join($this->depot_invoice_product_table . ' AS sdip', "sdi.id = sdip.depot_invoice_id AND sdip.deleted = '0'", 'left');
		$this->db->join($this->user_table . ' AS su', 'sdi.depot_id = su.id', 'left');
		$this->db->where('sdi.depot_id', $id);
		$this->db->where('sdi.deleted', '0');

		// next and previous invoice
		if(!empty($next_prevoius) && count($next_prevoius) > 0)
		{
			$invoice_invoice_id = $next_prevoius['invoice_id'];
			$invoice_next_previous = $next_prevoius['next_previous_name'];
			$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
			if (strpos($url, 'invoice/view') !== false)
			{
				if($invoice_next_previous == 'next')
				{
					$this->db->where('sdi.id', "(SELECT MIN(sdi.id) FROM {PRE}depot_invoice as sdi WHERE sdi.id > ". $invoice_invoice_id ." AND sdi.depot_id = ". $id ." AND sdi.deleted = '0')", FALSE);
				}
				elseif($invoice_next_previous == 'previous')
				{
					$this->db->where('sdi.id', "(SELECT MAX(sdi.id) FROM {PRE}depot_invoice as sdi WHERE sdi.id < ". $invoice_invoice_id ." AND sdi.depot_id = ". $id ." AND sdi.deleted = '0')", FALSE);
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
					if($search_field == 'full_name')
					{
						$search_item .= "su.". $search_field ." like '%". $search_text ."%'";
					}
					else
					{
						$search_item .= "sdi.". $search_field ." like '%". $search_text ."%'";
					}
					
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

		$this->db->group_by('sdi.id');
		$this->db->order_by('sdi.id', 'DESC');

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

	public function getCustomerInvoices($id = 0, $limit = '', $start = '', $search_text = '', $count = '', $next_prevoius = array(), $filter_data = array())
	{
		if($this->ion_auth->is_depot())
		{
			$simbanic_role = 'depot';
			$nxtprvs = 'sri.created_by';
		}
		else
		{
			$simbanic_role = 'customer';
			$nxtprvs = 'sri.retailer_id';
		}

		$this->db->select('sri.*, su.customer_id, su.full_name, DATE_FORMAT(sri.date_created, "%d-%m-%Y") as date', FALSE);
		$this->db->select('SUM(IFNULL((srip.order_quantity * srip.price),0)) as invoice_total', FALSE);
		$this->db->from($this->retailer_invoice_table . ' AS sri');
		$this->db->join($this->retailer_invoice_product_table . ' AS srip', "sri.id = srip.retailer_invoice_id AND srip.deleted = '0' ", 'left');

		if($simbanic_role == 'depot')
		{
			$this->db->join($this->user_table . ' AS su', 'sri.retailer_id = su.id', 'left');
			$this->db->where('sri.created_by', $id);
		}
		else
		{
			$this->db->join($this->user_table . ' AS su', 'sri.created_by = su.id', 'left');
			$this->db->where('sri.retailer_id', $id);
		}
		$this->db->where('sri.deleted', '0');

		// next and previous invoice
		if(!empty($next_prevoius) && count($next_prevoius) > 0)
		{
			$invoice_invoice_id = $next_prevoius['invoice_id'];
			$invoice_next_previous = $next_prevoius['next_previous_name'];
			$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
			if (strpos($url, 'invoice/view') !== false)
			{
				if($invoice_next_previous == 'next')
				{
					$this->db->where('sri.id', "(SELECT MIN(sri.id) FROM {PRE}retailer_invoice as sri WHERE sri.id > ". $invoice_invoice_id ." AND ". $nxtprvs ." = ". $id ." AND sri.deleted = '0')", FALSE);
				}
				elseif($invoice_next_previous == 'previous')
				{
					$this->db->where('sri.id', "(SELECT MAX(sri.id) FROM {PRE}retailer_invoice as sri WHERE sri.id < ". $invoice_invoice_id ." AND ". $nxtprvs ." = ". $id ." AND sri.deleted = '0')", FALSE);
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
					if($search_field == 'full_name')
					{
						$search_item .= "su.". $search_field ." like '%". $search_text ."%'";
					}
					else
					{
						$search_item .= "sri.". $search_field ." like '%". $search_text ."%'";
					}
					
					if($search_count == count($this->grid_search_field))
					{
						$search_item .= ')';
					}

					$search_count++;
				}
				$this->db->where($search_item);
			}
		}

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

		if(empty($count) && !empty($limit))
		{
			if(($limit != '' && $start != '') || $start == 0)
			{
				$this->db->limit($limit, $start);
			}
		}

		$this->db->group_by('sri.id');
		$this->db->order_by('sri.id', 'DESC');
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

	public function getInvoiceProducts($invoice_id, $limit = '', $start = '', $search_text = '', $count = '')
	{
		if($this->ion_auth->is_admin())
		{
			return $this->getDepotInvoiceProducts($invoice_id, $limit, $start, $search_text, $count);
		}
		elseif($this->ion_auth->is_depot())
		{
			if($this->input->get_post('view'))
			{
				return $this->getCustomerInvoiceProducts($invoice_id, $limit, $start, $search_text, $count);
			}
			else
			{
				return $this->getDepotInvoiceProducts($invoice_id, $limit, $start, $search_text, $count);
			}
		}
		elseif($this->ion_auth->is_customer())
		{
			return $this->getCustomerInvoiceProducts($invoice_id, $limit, $start, $search_text, $count);
		}
		else
		{
			return false;
		}
	}

	public function getDepotInvoiceProducts($invoice_id, $limit = '', $start = '', $search_text = '', $count = '')
	{
		$this->db->select('sdip.*');
		$this->db->select('sp.mrp, sp.vat');
		$this->db->select('sdip.price * sp.vat AS vatrs');
		$this->db->select('sdip.price * sdip.order_quantity AS sub_total');
		$this->db->select('CONCAT_WS(" ", sdip.name, sdip.packing_size, sdip.unit) AS simbanic_product_name', FALSE);
		$this->db->from($this->depot_invoice_product_table . ' as sdip');
		$this->db->join($this->product_table . ' AS sp', "sdip.product_id = sp.id", 'left');
		$this->db->where('sdip.depot_invoice_id', (int)$invoice_id);
		$this->db->where('sdip.deleted', '0');

		/*if($search_text != '')
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
		}*/

		if(empty($count) && !empty($limit))
		{
			if(($limit != '' && $start != '') || $start == 0)
			{
				$this->db->limit($limit, $start);
			}
		}
		$this->db->order_by('sdip.name, sdip.unit', 'ASC');
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

	public function getCustomerInvoiceProducts($invoice_id, $limit = '', $start = '', $search_text = '', $count = '')
	{
		$this->db->select('*');
		$this->db->select('price * order_quantity AS sub_total');
		$this->db->select('CONCAT_WS(" ", srip.name, srip.packing_size, srip.unit) AS simbanic_product_name', FALSE);
		$this->db->from($this->retailer_invoice_product_table . ' as srip');
		$this->db->where('srip.retailer_invoice_id', (int)$invoice_id);
		$this->db->where('srip.deleted', '0');

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
		$this->db->order_by('srip.name, srip.unit', 'ASC');
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

	public function getInvoiceNo($id)
	{
		if($this->ion_auth->is_admin())
		{
			return $this->getDepotInvoiceNo($id);
		}
		elseif($this->ion_auth->is_depot())
		{
			return $this->getCustomerInvoiceNo($id);
		}
		else
		{
			return false;
		}
	}

	public function getDepotInvoiceNo($depot_id)
	{
		$this->db->select('IFNULL(MAX(invoice_no) + 1, 1) As invoice_no', FALSE);
		$this->db->where('depot_id', $depot_id);
		$this->db->where('deleted', '0');
		$result = $this->db->get($this->table);
		if ($result->num_rows() == 1)
        {
            return $result->row()->invoice_no;
        }
        else
        {
            return false;
        }
	}

	public function getCustomerInvoiceNo($retailer_id)
	{
		$this->db->select('IFNULL(MAX(invoice_no) + 1, 1) As invoice_no', FALSE);
		$this->db->where('retailer_id', $retailer_id);
		$this->db->where('deleted', '0');
		$result = $this->db->get($this->retailer_invoice_table);
		if ($result->num_rows() == 1)
        {
            return $result->row()->invoice_no;
        }
        else
        {
            return false;
        }
	}

	public function getInvoiceProductBatch($quantity_data, $filter = array(), $order_id = 0)
    {
		if(!empty($quantity_data) && count($filter['product_id']) > 0)
		{
			if($this->ion_auth->is_admin())
			{
				$user_type = 'admin';
			}
			elseif($this->ion_auth->is_depot())
			{
				$user_type = 'depot';
				$this->load->model('stock/stock');
			}
			$user_id = $this->ion_auth->get_user_id();
			$invoice_stock = array();

    		for($i = 0; $i < count($filter['product_id']); $i++)
    		{
    			$product_id = $filter['product_id'][$i];
    			
    			if(!empty($quantity_data[$product_id]))
				{
					$quantity = $quantity_data[$product_id];
				}
            	else
            	{
            		$quantity = 0;
            	}
            	if($product_id != '' && $product_id != 0 && $quantity != 0)
            	{
            		if($user_type == 'admin')
	            	{
						$invoice_stock[$product_id] = $this->getAdminToDepotInvoiceProductBatch($user_id, $product_id, $quantity, $order_id);
	            	}
	            	elseif($user_type == 'depot')
	            	{
	            		$invoice_stock[$product_id] = $this->getDepotToCustomerInvoiceProductBatch($user_id, $product_id, $quantity, $order_id);
	            	}
            	}
    		}
    		return $invoice_stock;
    	}
    	else
    	{
    		return false;
    	}
    }

    public function getAdminToDepotInvoiceProductBatch($id, $product_id, $order_quantity, $order_id = 0)
    {
    	$this->db->select('ss.id, ss.product_id, ss.batch_no, ss.expiry_date', FALSE);
    	$this->db->select('sdop.name, sdop.packing_size, sdop.unit, sdop.mrp, sdop.price, sdop.quantity AS depot_quantity', FALSE);
		$this->db->select('IFNULL(simba.invoice_batch_quantity, 0) AS invoice_batch_qty', FALSE);
		$this->db->select('(IFNULL(ss.quantity, 0) - IFNULL(simba.invoice_batch_quantity, 0)) AS batch_quantity', FALSE);
		$this->db->from($this->stock_table . ' AS ss');
		$this->db->join($this->depot_order_product_table . ' AS sdop', 'sdop.product_id = ss.product_id AND sdop.depot_order_id = '. $order_id .' ', 'left');
		$this->db->join("( SELECT *, IFNULL(SUM(sdip.order_quantity), 0) As invoice_batch_quantity FROM {PRE}depot_invoice_product AS sdip 
			WHERE sdip.product_id IN(" . $product_id . ") AND sdip.deleted = '0' AND sdip.stock_status = '0' 
			GROUP BY sdip.product_id, sdip.stock_id 
			ORDER BY sdip.product_id, sdip.expiry_date ASC
		) AS simba", "ss.id = simba.stock_id", 'left', FALSE);

		$this->db->where('ss.product_id', $product_id);
		//$this->db->where('ss.status', '0');
		$this->db->where('ss.deleted', '0');
    	$this->db->order_by('ss.product_id, ss.expiry_date', 'ASC');
    	$result = $this->db->get();
    	
    	$depot_invoice_product = array();

    	if ($result->num_rows() > 0)
        {
        	$remaining_quantity = $order_quantity;

        	foreach ($result->result() as $row)
            {
            	$product_id = $row->product_id;
            	$name = $row->name;
            	$packing_size = $row->packing_size;
            	$unit = $row->unit;
            	$price = $row->price;
            	$mrp = $row->mrp;
            	
            	$depot_quantity = $row->depot_quantity;
	        	$batch_quantity = $row->batch_quantity;
	        	$batch_no = $row->batch_no;
	        	$stock_id = $row->id;
	        	$expiry_date = $row->expiry_date;

	        	if($batch_quantity != 0 && $order_quantity != 0 && !empty($order_quantity))
	        	{
	        		if($remaining_quantity <= $batch_quantity)
	            	{
	            		$depot_invoice_product[] = array(
	            			'product_id' => $product_id,
	            			'stock_id' => $stock_id,
	            			'name' => $name,
	            			'packing_size' => $packing_size,
	            			'unit' => $unit,
	            			'price' => $price,
	            			'mrp' => $mrp,
	            			'depot_quantity' => (int)$depot_quantity,
	            			'order_quantity' => (int)$remaining_quantity,
	            			'batch_no' => $batch_no,
	            			'expiry_date' => $expiry_date
            			);
            			break;
	            	}
	            	elseif($remaining_quantity >= $batch_quantity)
	            	{
	            		$remaining_quantity = $remaining_quantity - $batch_quantity;

	            		$depot_invoice_product[] = array(
	            			'product_id' => $product_id,
	            			'stock_id' => $stock_id,
	            			'name' => $name,
	            			'packing_size' => $packing_size,
	            			'unit' => $unit,
	            			'price' => $price,
	            			'mrp' => $mrp,
	            			'depot_quantity' => (int)$depot_quantity,
	            			'order_quantity' => (int)$batch_quantity,
	            			'batch_no' => $batch_no,
	            			'expiry_date' => $expiry_date
	        			);
	        			if($remaining_quantity <= 0)
	        			{
	        				break;
	        			}
	            	}
	        	}
            }
        }
        return $depot_invoice_product;
    }

	public function getDepotToCustomerInvoiceProductBatch($id, $product_id, $order_quantity, $order_id = 0)
    {
    	$this->db->select('sdip.product_id, sdip.stock_id, sdip.batch_no, sdip.expiry_date', FALSE);
    	$this->db->select('srop.name, srop.packing_size, srop.unit, srop.mrp, srop.price, srop.quantity AS retailer_quantity', FALSE);
		$this->db->select('IFNULL(simba.invoice_batch_quantity, 0) AS invoice_batch_qty', FALSE);
		$this->db->select('(IFNULL(SUM(sdip.order_quantity), 0) - IFNULL(simba.invoice_batch_quantity, 0)) AS batch_quantity', FALSE);
		$this->db->from($this->depot_invoice_product_table . ' AS sdip');
		$this->db->join($this->retailer_order_product_table . ' AS srop', 'srop.product_id = sdip.product_id AND srop.retailer_order_id = '. $order_id .' ', 'left');
		$this->db->join("( SELECT *, IFNULL(SUM(srip.order_quantity), 0) As invoice_batch_quantity FROM {PRE}retailer_invoice_product AS srip 
			WHERE srip.created_by = ". (int)$id ." AND srip.product_id IN(" . $product_id . ") AND srip.deleted = '0' 
			GROUP BY srip.product_id, srip.stock_id 
			ORDER BY srip.product_id, srip.expiry_date ASC
		) AS simba", "sdip.stock_id = simba.stock_id AND sdip.product_id = simba.product_id", 'left', FALSE);

		$this->db->where('sdip.product_id', $product_id);
		$this->db->where('sdip.depot_id', (int)$id);
		$this->db->where('sdip.date_confirm IS NOT NULL');
		$this->db->where('sdip.deleted', '0');
		$this->db->group_by('sdip.product_id, sdip.stock_id');
    	$this->db->order_by('sdip.product_id, sdip.expiry_date', 'ASC');
    	$result = $this->db->get();
    	
    	$retailer_invoice_product = array();

    	if ($result->num_rows() > 0)
        {
        	$remaining_quantity = $order_quantity;

        	foreach ($result->result() as $row)
            {
            	$product_id = $row->product_id;
            	$name = $row->name;
            	$packing_size = $row->packing_size;
            	$unit = $row->unit;
            	$price = $row->price;
            	$mrp = $row->mrp;
            	
            	$retailer_quantity = $row->retailer_quantity;
	        	$batch_quantity = $row->batch_quantity;
	        	$batch_no = $row->batch_no;
	        	$stock_id = $row->stock_id;
	        	$expiry_date = $row->expiry_date;

	        	if($batch_quantity != 0 && $order_quantity != 0 && !empty($order_quantity))
	        	{
	        		if($remaining_quantity <= $batch_quantity)
	            	{
	            		$retailer_invoice_product[] = array(
	            			'product_id' => $product_id,
	            			'stock_id' => $stock_id,
	            			'name' => $name,
	            			'packing_size' => $packing_size,
	            			'unit' => $unit,
	            			'price' => $price,
	            			'mrp' => $mrp,
	            			'retailer_quantity' => (int)$retailer_quantity,
	            			'order_quantity' => (int)$remaining_quantity,
	            			'batch_no' => $batch_no,
	            			'expiry_date' => $expiry_date
            			);
            			break;
	            	}
	            	elseif($remaining_quantity >= $batch_quantity)
	            	{
	            		$remaining_quantity = $remaining_quantity - $batch_quantity;

	            		$retailer_invoice_product[] = array(
	            			'product_id' => $product_id,
	            			'stock_id' => $stock_id,
	            			'name' => $name,
	            			'packing_size' => $packing_size,
	            			'unit' => $unit,
	            			'price' => $price,
	            			'mrp' => $mrp,
	            			'retailer_quantity' => $retailer_quantity,
	            			'order_quantity' => (int)$batch_quantity,
	            			'batch_no' => $batch_no,
	            			'expiry_date' => $expiry_date
	        			);
	        			if($remaining_quantity <= 0)
	        			{
	        				break;
	        			}
	            	}
	        	}
            }
        }
        return $retailer_invoice_product;
    }

}
?>