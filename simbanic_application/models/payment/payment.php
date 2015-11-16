<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends Simba_Model
{
	public $request_data = array();
    public $db_data = array();
    public $vardefs = array();
	public $table = 'depot_payment';
	public $retailer_payment_table = 'retailer_payment';
	public $user_table = 'user';
	public $stock_table = 'stock';
	public $depot_invoice_product_table = 'depot_invoice_product';
	public $retailer_invoice_product_table = 'retailer_invoice_product';
	public $grid_search_field = array('customer_id', 'full_name');
	public $grid_history_field = array('status');

	public function __construct()
	{
		parent::__construct();
		$this->init();
	}

	public function init()
	{
		$this->module = 'payment';
		$this->setTableName($this->table);
		$this->loadVarDefs();
	}

	public function setTableName($table)
	{
		$this->table = $table;
	}

	public function getPayment($payment_id)
	{
		if($this->ion_auth->is_admin())
		{
			return $this->getDepotPayment($payment_id);
		}
		elseif($this->ion_auth->is_depot())
		{
			if($this->input->get_post('view'))
			{
				return $this->getCustomerPayment($payment_id);
			}
			else
			{
				return $this->getDepotPayment($payment_id);	
			}
		}
		elseif($this->ion_auth->is_customer())
		{
			return $this->getCustomerPayment($payment_id);
		}
		else
		{
			return false;
		}
	}

	public function getDepotPayment($payment_id)
	{
		$this->db->where('id', $payment_id);
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

	public function getCustomerPayment($payment_id)
	{
		$this->db->where('id', $payment_id);
		$result = $this->db->get($this->retailer_payment_table);
		if ($result->num_rows() == 1)
        {
            return $result->row();
        }
        else
        {
            return false;
        }
	}

	public function getPayments($id, $limit = '', $start = '', $search_text = '', $count = '')
	{
		if($this->ion_auth->is_admin())
		{
			return $this->getAdminPayments($id, $limit, $start, $search_text, $count);
		}
		elseif($this->ion_auth->is_depot())
		{
			return $this->getDepotPayments($id, $limit, $start, $search_text, $count);
		}
		elseif($this->ion_auth->is_customer())
		{
			return $this->getCustomerToDepotPayments($id, $limit, $start, $search_text, $count);
		}
		else
		{
			return false;
		}
	}

	public function getAdminPayments($id, $limit = '', $start = '', $search_text = '', $count = '')
	{
		if($search_text != '')
		{
			if($search_text == 'pending' || $search_text == 'Pending')
			{
				$where_condition = "su.user_type = 'depot' ";
				$payment_status = "'Pending'";
			}
			else
			{
				$where_condition = "su.user_type = 'depot' AND su.customer_id like '%". $search_text."%'";
				$payment_status = "'Done'";
			}
		}
		else
		{
			$where_condition = "su.user_type = 'depot' ";
			$payment_status = "'Done'";
		}

		$query = 
			"SELECT simba.*, 
				IFNULL(SUM(amount), 0) As total_payment, 
				IFNULL(invoice_amount - IFNULL(SUM(amount), 0), 0) As outstanding_payment 
				FROM 
				(
					SELECT su.id, su.customer_id, su.full_name, su.id as view_id, 
					IFNULL(SUM(price * order_quantity), 0) As invoice_amount 
					FROM `simbanic_depot_invoice_product` as sdip 
					RIGHT JOIN `simbanic_user` as su ON su.id = sdip.depot_id AND sdip.deleted='0' 
					WHERE ". $where_condition ." GROUP BY su.id
				) As simba 
				LEFT JOIN `simbanic_depot_payment` as sdp ON sdp.depot_id = view_id AND sdp.status=". $payment_status ." 
				GROUP BY view_id";

		if(empty($count) && !empty($limit))
		{
			if(($limit != '' && $start != '') || $start == 0)
			{
				$query .= " LIMIT $start, $limit ";
			}
		}

		$result = $this->db->query($query);
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

	public function getDepotPayments($created_by = 0, $limit = '', $start = '', $search_text = '', $count = '')
	{
		$query = 
			"SELECT simba.*, 
				IFNULL(SUM(amount), 0) As total_payment, 
				IFNULL(invoice_amount - IFNULL(SUM(amount), 0), 0) As outstanding_payment 
				FROM 
				(
					SELECT su.id, su.customer_id, su.full_name, su.id as view_id, 
					IFNULL(SUM(price * order_quantity), 0) As invoice_amount 
					FROM `simbanic_depot_invoice_product` as sdip 
					RIGHT JOIN `simbanic_user` as su ON su.id = sdip.depot_id AND sdip.deleted='0' 
					WHERE su.id = '".$created_by."' GROUP BY su.id
				) As simba 
				LEFT JOIN `simbanic_depot_payment` as sdp ON sdp.depot_id = view_id AND sdp.status='Done' 
				GROUP BY view_id";

		if(empty($count) && !empty($limit))
		{
			if(($limit != '' && $start != '') || $start == 0)
			{
				$query .= " LIMIT $start, $limit ";
			}
		}

		$result = $this->db->query($query);
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

	public function getRetailerPayments($id, $limit = '', $start = '', $search_text = '', $count = '')
	{
		if($this->ion_auth->is_admin())
		{
			return false;
		}
		elseif($this->ion_auth->is_depot())
		{
			return $this->getDepotToCustomerPayments($id, $limit, $start, $search_text, $count);
		}
		elseif($this->ion_auth->is_customer())
		{
			return $this->getCustomerToDepotPayments($id, $limit, $start, $search_text, $count);
		}
		else
		{
			return false;
		}
	}

	public function getCustomerToDepotPayments($id = 0, $limit = '', $start = '', $search_text = '', $count = '')
	{
		$this->db->select('su.id, su.full_name, su.customer_id');
		$this->db->select('IFNULL(pay_amount, 0) As total_payment', FALSE);
		$this->db->select('IFNULL(SUM(srip.price * srip.order_quantity), 0) As invoice_amount', FALSE);
		$this->db->select('(IFNULL(SUM(srip.price * srip.order_quantity), 0) - IFNULL(pay_amount, 0)) As outstanding_payment', FALSE);

		$this->db->from($this->retailer_invoice_product_table.' as srip');

		$this->db->join("( SELECT depot_id, retailer_id, IFNULL(SUM(srp.amount), 0) As pay_amount FROM {PRE}retailer_payment AS srp 
			WHERE srp.retailer_id = ". (int)$id ." AND srp.status = 'Done' AND srp.deleted = '0' 
			GROUP BY srp.retailer_id, srp.depot_id 
		) AS simba_payment", 'srip.created_by = simba_payment.depot_id AND srip.retailer_id = simba_payment.retailer_id', 'left');

		$this->db->join($this->user_table . ' AS su', 'srip.created_by = su.id', 'left');

		$this->db->where('srip.retailer_id', (int)$id);
		$this->db->where('srip.date_confirm IS NOT NULL');
		$this->db->where('srip.deleted', '0');

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
					
					$search_item .= "su.". $search_field ." like '%". $search_text ."%'";
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

		$this->db->group_by('srip.created_by, srip.retailer_id');
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

	public function getDepotToCustomerPayments($id = 0, $limit = '', $start = '', $search_text = '', $count = '')
	{
		$this->db->select('su.id, su.full_name, su.customer_id');
		$this->db->select('IFNULL(pay_amount, 0) As total_payment', FALSE);
		$this->db->select('IFNULL(SUM(srip.price * srip.order_quantity), 0) As invoice_amount', FALSE);
		$this->db->select('(IFNULL(SUM(srip.price * srip.order_quantity), 0) - IFNULL(pay_amount, 0)) As outstanding_payment', FALSE);

		$this->db->from($this->retailer_invoice_product_table.' as srip');

		$this->db->join("( SELECT depot_id, retailer_id, IFNULL(SUM(srp.amount), 0) As pay_amount FROM {PRE}retailer_payment AS srp 
			WHERE srp.depot_id = " . (int)$id . " AND srp.status = 'Done' AND srp.deleted = '0' 
			GROUP BY srp.retailer_id, srp.depot_id 
		) AS simba_payment", 'srip.created_by = simba_payment.depot_id AND srip.retailer_id = simba_payment.retailer_id', 'left');

		$this->db->join($this->user_table . ' AS su', 'srip.retailer_id = su.id', 'left');

		$this->db->where('srip.created_by', (int)$id);
		$this->db->where('srip.date_confirm IS NOT NULL');
		$this->db->where('srip.deleted', '0');

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
					
					$search_item .= "su.". $search_field ." like '%". $search_text ."%'";
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

		$this->db->group_by('srip.created_by, srip.retailer_id');
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

	public function getPaymentHistory($depot_id, $limit = '', $start = '', $search_text = '', $count = '')
	{
		$this->db->select('sdp.*');

		$this->db->select('DATE_FORMAT(sdp.date, "%d-%m-%Y") as date', FALSE);
		$this->db->select('DATE_FORMAT(sdp.confirm_date, "%d-%m-%Y") as confirm_date', FALSE);
		$this->db->select('IF(sdp.status = "", "", LOWER(sdp.status)) as status_class', FALSE);
		$this->db->from($this->table . ' as sdp');
		$this->db->where('sdp.depot_id', $depot_id);
		$this->db->where('sdp.deleted', '0');
		
		if($search_text != '')
		{
			if(count($this->grid_products_search_field) > 0)
			{
				foreach($this->grid_products_search_field as $search_field)
				{
					if(count($this->grid_products_search_field) == 1)
					{
						$this->db->like('sdp.'.$search_field, $search_text);	
					}
					else
					{
						$this->db->or_like('sdp.'.$search_field, $search_text);
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

		$this->db->order_by('sdp.id', 'DESC');
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

	public function getRetailerPaymentHistories($depot_id = 0, $retailer_id = 0, $limit = '', $start = '', $search_text = '', $count = '')
	{
		$this->db->select('srp.*');
		$this->db->select('DATE_FORMAT(srp.date, "%d-%m-%Y") as date', FALSE);
		$this->db->select('DATE_FORMAT(srp.confirm_date, "%d-%m-%Y") as confirm_date', FALSE);
		$this->db->select('IF(srp.status = "", "", LOWER(srp.status)) as status_class', FALSE);
		$this->db->from($this->retailer_payment_table . ' as srp');
		
		$this->db->where('srp.depot_id', (int)$depot_id);
		$this->db->where('srp.retailer_id', (int)$retailer_id);
		
		
		$this->db->where('srp.deleted', '0');
		
		if($search_text != '')
		{
			if(count($this->grid_history_field) > 0)
			{
				$search_item = '';
				$search_count = 1;
				foreach($this->grid_history_field as $search_field)
				{
					if($search_count == 1)
					{
						$search_item .= '(';
					}
					else
					{
						$search_item .= ' OR ';
					}
					
					$search_item .= "srp.". $search_field ." like '%". $search_text ."%'";
					if($search_count == count($this->grid_history_field))
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

		$this->db->order_by('srp.id', 'DESC');
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
}
?>