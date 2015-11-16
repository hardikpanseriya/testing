<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends Simba_Model
{
	public $request_data = array();
    public $db_data = array();
    public $vardefs = array();
	public $table = 'customer';
	public $grid_search_field = array('full_name', 'customer_id', 'sponsor_id');

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

	public function getCustomer($id, $limit = '', $start = '', $search_text = '', $count = '')
	{
		$admin_ids = $this->simba_init->getAllAdminID();

		if(in_array($id, $admin_ids))
		{
			$this->db->where_in('created_by', $admin_ids);
			$this->db->where('sponsor_id !=', '0');
		}
		else
		{
			$this->db->where('created_by', $id);
		}
		
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

		$this->db->order_by('id', 'DESC');

		$result = $this->db->get($this->table);
		
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

	public function checkSponsorIDLevel($sponsor_id, $record = '')
	{
		$sponsor_level = $this->config->item('simba_sponsor_level_restriction') - 1;
		$this->db->where('sponsor_id', $sponsor_id);
		if(!empty($record))
		{
			$this->db->where('id !=', $record);			
		}
		$result = $this->db->get($this->table);
		$total_rows = $result->num_rows();

		if ($total_rows > 0)
        {
        	if($total_rows > $sponsor_level)
        	{
        		return false;
        	}
        	else
        	{
        		return true;
        	}
        }
        else
        {
        	return true;
        }
	}

	public function getParticularTreeData($sponsor_id, $tree_level = 0)
	{
		$this->db->select('sc.customer_id, sc.sponsor_id, sc.tree_id, sc.user_id, sc.full_name, sc.customer_type');
		$this->db->select("IF(sc.customer_type = 'medical_store', IFNULL(otc_prescription_unit, 0), IFNULL(product_unit, 0) + IFNULL(prescription_unit, 0)) As unit", FALSE);
		
    	$this->db->from($this->table . ' AS sc');

		$this->db->join("( SELECT retailer_id, TRUNCATE(SUM(IFNULL(IF(srip.unit='kg' OR srip.unit='ltr', srip.packing_size * IFNULL(srip.order_quantity, 0), (srip.packing_size / 1000) * IFNULL(srip.order_quantity, 0)), 0)), 2) As product_unit FROM {PRE}retailer_invoice_product AS srip 
				WHERE srip.date_confirm IS NOT NULL AND MONTH(date_confirm) = MONTH(CURDATE()) AND srip.deleted='0' 
				GROUP BY srip.retailer_id
			) AS simbanic", "sc.user_id = simbanic.retailer_id", 'left', FALSE);

		$this->db->join("(
					SELECT
						spip.retailer_id, 
						spip.date_confirm, 
						SUM(
							IFNULL(
									IF(spip.unit='kg' OR spip.unit='ltr', 
										spip.packing_size * IFNULL(spip.quantity, 0), 
										(spip.packing_size / 1000) * IFNULL(spip.quantity, 0)), 0
							)
						) As prescription_unit 
					FROM {PRE}prescription_invoice_product As spip
					WHERE spip.deleted = '0'
					AND spip.date_confirm IS NOT NULL
					AND MONTH(spip.date_confirm) = MONTH(CURRENT_DATE)
					GROUP BY 
						spip.retailer_id
				) As simba_prescription", "sc.user_id = simba_prescription.retailer_id", 'left', FALSE);

			$this->db->join("(
					SELECT
						sopp.created_by, 
						sopp.date_confirm, 
						SUM(
							IFNULL(
									IF(sopp.unit='kg' OR sopp.unit='ltr', 
										sopp.packing_size * IFNULL(sopp.quantity, 0), 
										(sopp.packing_size / 1000) * IFNULL(sopp.quantity, 0)), 0
							)
						) As otc_prescription_unit 
					FROM {PRE}otc_prescription_product As sopp
					WHERE sopp.deleted = '0'
					AND sopp.date_confirm IS NOT NULL
					AND MONTH(sopp.date_confirm) = MONTH(CURRENT_DATE)
					GROUP BY 
						sopp.created_by
				) As simba_otc_prescription", "sc.user_id = simba_otc_prescription.created_by", 'left', FALSE);

		$this->db->where('sc.sponsor_id', $sponsor_id);
		if($tree_level != 0)
		{
			$this->db->where('sc.tree_id <=', $tree_level);
		}
		$this->db->where('sc.deleted', '0');
		$result = $this->db->get();
		
		if ($result->num_rows() > 0)
        {
            return $result->result();
        }
        else
        {
            return false;
        }
	}

	public function getTreeData($id)
	{
		if($this->ion_auth->is_admin())
		{
			$user_type = 'admin';
			$this->db->where('sponsor_id', '0');
		}
		elseif($this->ion_auth->is_depot())
		{
			$user_type = 'depot';
			$this->db->where('id', '0');
		}
		elseif($this->ion_auth->is_customer())
		{
			$user_type = 'customer';
			$this->db->where('user_id', $id);
		}
		$this->db->select('GROUP_CONCAT(customer_id) As customer_id_group');
		$this->db->where('deleted', '0');
		$this->db->order_by('customer_id', 'ASC');
		$result = $this->db->get($this->table);
		//echo $this->db->last_query();
		if ($result->num_rows() == 1)
        {
        	$customer_id_group = $result->row()->customer_id_group;
        	$expl_customer_id_group = explode(",", $customer_id_group);

        	$this->db->select('sc.customer_id, sc.sponsor_id, sc.tree_id, user_id, sc.full_name, sc.customer_type');
        	
        	$this->db->select("IF(sc.customer_type = 'medical_store', IFNULL(otc_prescription_unit, 0), IFNULL(product_unit, 0) + IFNULL(prescription_unit, 0)) As unit", FALSE);
        	$this->db->from($this->table . ' AS sc');

        	$this->db->join("( SELECT retailer_id, TRUNCATE(SUM(IFNULL(IF(srip.unit='kg' OR srip.unit='ltr', srip.packing_size * IFNULL(srip.order_quantity, 0), (srip.packing_size / 1000) * IFNULL(srip.order_quantity, 0)), 0)), 2) As product_unit FROM {PRE}retailer_invoice_product AS srip 
				WHERE srip.date_confirm IS NOT NULL AND MONTH(date_confirm) = MONTH(CURDATE()) AND srip.deleted='0' 
				GROUP BY srip.retailer_id
			) AS simbanic", "sc.user_id = simbanic.retailer_id", 'left', FALSE);

			$this->db->join("(
					SELECT
						spip.retailer_id, 
						spip.date_confirm, 
						SUM(
							IFNULL(
									IF(spip.unit='kg' OR spip.unit='ltr', 
										spip.packing_size * IFNULL(spip.quantity, 0), 
										(spip.packing_size / 1000) * IFNULL(spip.quantity, 0)), 0
							)
						) As prescription_unit 
					FROM {PRE}prescription_invoice_product As spip
					WHERE spip.deleted = '0'
					AND spip.date_confirm IS NOT NULL
					AND MONTH(spip.date_confirm) = MONTH(CURRENT_DATE)
					GROUP BY 
						spip.retailer_id
				) As simba_prescription", "sc.user_id = simba_prescription.retailer_id", 'left', FALSE);

			$this->db->join("(
					SELECT
						sopp.created_by, 
						sopp.date_confirm, 
						SUM(
							IFNULL(
									IF(sopp.unit='kg' OR sopp.unit='ltr', 
										sopp.packing_size * IFNULL(sopp.quantity, 0), 
										(sopp.packing_size / 1000) * IFNULL(sopp.quantity, 0)), 0
							)
						) As otc_prescription_unit 
					FROM {PRE}otc_prescription_product As sopp
					WHERE sopp.deleted = '0'
					AND sopp.date_confirm IS NOT NULL
					AND MONTH(sopp.date_confirm) = MONTH(CURRENT_DATE)
					GROUP BY 
						sopp.created_by
				) As simba_otc_prescription", "sc.user_id = simba_otc_prescription.created_by", 'left', FALSE);

        	$this->db->where_in('sc.sponsor_id', $expl_customer_id_group);

        	if($user_type == 'admin')
        	{
        		$this->db->or_where('sc.sponsor_id', '0');
        	}
        	elseif($user_type == 'depot')
			{
				$this->db->where('sc.id', '0');
			}
			elseif($user_type == 'customer')
			{
				$this->db->or_where('sc.user_id', $id);
			}
        	
        	$res = $this->db->get();
        	//echo $this->db->last_query();
        	//die();
        	if ($res->num_rows() > 0)
        	{
        		return $res->result();
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

	// get customer info using customer_id not user id
	public function getCustomerInfo($customer_id)
	{
		$this->db->where('customer_id', $customer_id);
		$res = $this->db->get($this->table);
		if ($res->num_rows() == 1)
        {
            return $res->row();
        }
        else
        {
            return false;
        }
	}

	public function getTotalTreeJson($id)
	{
		if($this->ion_auth->is_admin())
		{
			$user_type = 'admin';
			$this->db->where('sponsor_id', '0');
		}
		elseif($this->ion_auth->is_depot())
		{
			$user_type = 'depot';
			$this->db->where('id', '0');
		}
		elseif($this->ion_auth->is_customer())
		{
			$user_type = 'customer';
			$this->db->where('user_id', $id);
		}
		$this->db->select('GROUP_CONCAT(customer_id) As customer_id_group');
		$this->db->where('deleted', '0');
		$this->db->order_by('customer_id', 'ASC');
		$result = $this->db->get($this->table);
		//echo $this->db->last_query();
		if ($result->num_rows() == 1)
        {
        	$customer_id_group = $result->row()->customer_id_group;
        	$expl_customer_id_group = explode(",", $customer_id_group);
        	$this->db->select('customer_id, sponsor_id, tree_id, user_id, full_name');
        	$this->db->where_in('sponsor_id', $expl_customer_id_group);
        	if($user_type == 'admin')
        	{
        		$this->db->or_where('sponsor_id', '0');
        	}
        	elseif($user_type == 'depot')
			{
				$this->db->where('id', '0');
			}
			elseif($user_type == 'customer')
			{
				$this->db->or_where('user_id', $id);
			}
        	
        	$res = $this->db->get($this->table);
        	
        	if ($res->num_rows() > 0)
        	{
        		foreach ($res->result() as $result)
        		{
        			
        		}
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

	public function getRelatedCustomers($user_id, $filter_data = array())
	{
		if($this->ion_auth->is_doctor($user_id))
		{
			$user_info = $this->ion_auth->getSimbanicUser($user_id);
			$related_medical = $user_info->related_medical;
			$related_medicals = explode(",", $related_medical);
			$this->db->where('user_id', $user_id);
			$this->db->or_where_in('user_id', $related_medicals);
			$this->db->where('deleted', '0');

			if(!empty($filter_data))
			{
				if(count($filter_data) > 0)
				{
					foreach($filter_data as $key => $value)
					{
						$this->db->where($key, $value);
					}
				}
			}
			$res = $this->db->get($this->table);
        	
        	if ($res->num_rows() > 0)
        	{
        		return $res->result();
        	}
        	else
        	{
        		return false;
        	}
		}
		elseif($this->ion_auth->is_medical_store($user_id))
		{
			$this->db->where('user_id', $user_id);
			$this->db->or_where('FIND_IN_SET('. $user_id .', related_medical)');
			$this->db->where('deleted', '0');

			if(!empty($filter_data))
			{
				if(count($filter_data) > 0)
				{
					foreach($filter_data as $key => $value)
					{
						$this->db->where($key, $value);
					}
				}
			}

			$res = $this->db->get($this->table);
        	//echo $this->db->last_query();
        	if ($res->num_rows() > 0)
        	{
        		return $res->result();
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