<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prescription extends Simba_Model
{
	public $request_data = array();
    public $db_data = array();
    public $vardefs = array();
	public $table = 'prescription';
	public $prescription_product_table = 'prescription_product';
	public $prescription_invoice_product_table = 'prescription_invoice_product';
	public $prescription_store_table = 'prescription_medical_store';
	public $prescription_seen_table = 'prescription_seen';
	public $otc_prescription_table = 'otc_prescription';
	public $otc_prescription_product_table = 'otc_prescription_product';
	public $customer_table = 'customer';
	public $grid_search_field = array();
	public $grid_products_search_field = array();
	public $main_grid_search_field = array('full_name');
	

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

	public function getPrescriptionDetail($id)
	{
		$this->db->where('id', $id);
		$this->db->where('deleted', '0');
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

	public function getPrescriptions($id, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		if($this->ion_auth->is_doctor($id))
		{
			return $this->getDoctorPrescriptions($id, $limit, $start, $search_text, $count, $filter_data);
		}
		elseif($this->ion_auth->is_medical_store($id))
		{
			return $this->getMedicalStorePrescriptions($id, $limit, $start, $search_text, $count, $filter_data);
		}
		else
		{
			return false;
		}
	}

	public function getPrescriptionsProducts($user_id, $prescription_id = 0, $filter_data = array())
	{
		if($this->ion_auth->is_doctor($user_id))
		{
			return $this->getDoctorPrescriptionsProducts($user_id, $prescription_id, $filter_data);
		}
		elseif($this->ion_auth->is_medical_store($user_id))
		{
			return $this->getMedicalStorePrescriptionsProducts($user_id, $prescription_id, $filter_data);
		}
		else
		{
			return false;
		}
	}

	public function getPrescriptionsStores($user_id, $prescription_id = 0, $filter_data = array())
	{
		if($this->ion_auth->is_doctor($user_id))
		{
			return $this->getDoctorPrescriptionsStores($user_id, $prescription_id, $filter_data);
		}
		elseif($this->ion_auth->is_medical_store($user_id))
		{
			return $this->getMedicalStorePrescriptionsStores($user_id, $prescription_id, $filter_data);
		}
		else
		{
			return false;
		}
	}

	public function getPrescriptionsSeens($user_id, $prescription_id = 0, $filter_data = array())
	{
		if($this->ion_auth->is_doctor($user_id))
		{
			return $this->getDoctorPrescriptionsSeens($user_id, $prescription_id, $filter_data);
		}
		elseif($this->ion_auth->is_medical_store($user_id))
		{
			return $this->getMedicalStorePrescriptionsSeens($user_id, $prescription_id, $filter_data);
		}
		else
		{
			return false;
		}
	}

	public function getDoctorPrescriptions($id, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		$this->db->from($this->table.' as sp');
		$this->db->where('sp.created_by', $id);
		$this->db->where('sp.deleted', '0');

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

		$this->db->order_by('sp.id', 'DESC');
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

	public function getMedicalStorePrescriptions($id, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		$this->db->from($this->table.' as sp');
		$this->db->where('sp.completed_by', (int)$id);
		$this->db->where('sp.deleted', '0');

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

		$this->db->order_by('sp.id', 'DESC');
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

	public function getDoctorPrescriptionsProducts($user_id, $prescription_id = 0, $filter_data = array())
	{
		$this->db->select('spp.*, IFNULL(spip.quantity, "") as given_quantity', FALSE);
		$this->db->from($this->prescription_product_table.' as spp');
		$this->db->where('spp.created_by', $user_id);
		if(!empty($prescription_id) && $prescription_id != 0)
		{
			$this->db->where('spp.prescription_id', $prescription_id);
		}
		$this->db->join($this->prescription_invoice_product_table.' as spip', "spp.prescription_id = spip.prescription_id AND spp.product_id = spip.product_id", 'left');
		$this->db->where('spp.deleted', '0');
		$result = $this->db->get();

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

		if ($result->num_rows() > 0)
        {
            return $result->result();
        }
        else
        {
            return false;
        }
	}

	public function getMedicalStorePrescriptionsProducts($user_id, $prescription_id = 0, $filter_data = array())
	{
		$this->db->from($this->prescription_product_table.' as spp');
		$this->db->where('spp.completed_by', $user_id);
		if(!empty($prescription_id) && $prescription_id != 0)
		{
			$this->db->where('spp.prescription_id', $prescription_id);
		}
		$this->db->where('spp.deleted', '0');
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

	public function getDoctorPrescriptionsStores($user_id, $prescription_id = 0, $filter_data = array())
	{
		$this->db->from($this->prescription_store_table.' as spms');
		$this->db->where('spms.created_by', $user_id);
		if(!empty($prescription_id) && $prescription_id != 0)
		{
			$this->db->where('spms.prescription_id', $prescription_id);
		}
		$this->db->where('spms.deleted', '0');
		$result = $this->db->get();

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

		if ($result->num_rows() > 0)
        {
            return $result->result();
        }
        else
        {
            return false;
        }
	}

	public function getMedicalStorePrescriptionsStores($user_id, $prescription_id = 0, $filter_data = array())
	{
		$this->db->from($this->prescription_store_table.' as spms');
		$this->db->where('spms.completed_by', $user_id);
		if(!empty($prescription_id) && $prescription_id != 0)
		{
			$this->db->where('spms.prescription_id', $prescription_id);
		}
		$this->db->where('spms.deleted', '0');
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

	public function getDoctorPrescriptionsSeens($user_id, $prescription_id = 0, $filter_data = array())
	{
		$this->db->from($this->prescription_seen_table.' as sps');
		$this->db->where('sps.created_by', $user_id);
		if(!empty($prescription_id) && $prescription_id != 0)
		{
			$this->db->where('sps.prescription_id', $prescription_id);
		}

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

	public function getMedicalStorePrescriptionsSeens($user_id, $prescription_id = 0, $filter_data = array())
	{
		$this->db->from($this->prescription_seen_table.' as sps');
		$this->db->where('sps.seen_by', $user_id);
		if(!empty($prescription_id) && $prescription_id != 0)
		{
			$this->db->where('sps.prescription_id', $prescription_id);
		}
		
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

	public function checkingPrescriptionCode($id, $code)
	{
		$this->db->from($this->table.' as sp');
		$this->db->where('sp.code', $code);
		$this->db->where('sp.completed_by', '0');
		$this->db->where('sp.deleted', '0');
		$result = $this->db->get();
		if ($result->num_rows() > 0)
        {
    		return true;
        }
        else
        {
        	return false;
        }
	}

	public function checkPrescriptionInvoiceCode($id, $code)
	{
		$this->db->from($this->table.' as sp');
		$this->db->where('sp.code', $code);
		$this->db->where('sp.completed_by !=', '0');
		$this->db->where('sp.deleted', '0');
		$result = $this->db->get();
		if ($result->num_rows() > 0)
        {
        	return false;
        }
        else
        {
        	return true;
        }
	}

	// get prescription list through code
	public function checkPrescriptionCode($id, $code)
	{
		$this->db->from($this->table.' as sp');
		$this->db->where('sp.code', $code);
		$this->db->where('sp.completed_by', '0');
		$this->db->where('sp.deleted', '0');
		$result = $this->db->get();
		//echo $this->db->last_query();
		if ($result->num_rows() == 1)
        {
        	$prescription_id = $result->row()->id;
        	$created_by = $result->row()->created_by;

        	$this->db->where('user_id', $id);
            $this->db->where('prescription_id', $prescription_id);
            $this->db->where('deleted', '0');
            $res = $this->db->get($this->prescription_store_table);
        	//echo $this->db->last_query();
            if ($res->num_rows() > 0)
    		{
	        	$this->db->where('prescription_id', $prescription_id);
	    		$this->db->where('deleted', '0');
	    		$invoice_res = $this->db->get($this->prescription_invoice_product_table);
    			
	            if ($invoice_res->num_rows() == 0)
	    		{
    				$check = $this->checkPrescriptionSeen($id, $prescription_id);
		        	if($check)
		        	{
		    			$this->savePrescriptionSeen($created_by, $id, $prescription_id);
		        	}
		        	return $prescription_id;
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
        else
        {
            return false;
        }
	}

	public function checkPrescriptionSeen($seen_by, $prescription_id)
	{
		$this->db->where('prescription_id', $prescription_id);
		$this->db->where('seen_by', $seen_by);
		$result = $this->db->get($this->prescription_seen_table);
		if ($result->num_rows() == 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	// created by = doctor id, $user_id = medical store id
	public function savePrescriptionSeen($created_by, $seen_by, $prescription_id)
	{
		$prescription_seen = array(
				'created_by' => $created_by,
        		'prescription_id' => $prescription_id,
        		'seen_by' => $seen_by,
        		'sync_datetime' => CURRENT_DATETIME,
        		'date_created' => CURRENT_DATETIME
    		);

		$this->query_model->save('prescription_seen', $prescription_seen);
	}

	public function getPrescriptionProducts($prescription_id)
	{
		$this->db->where('prescription_id', $prescription_id);
		$this->db->where('deleted', '0');
		$result = $this->db->get($this->prescription_product_table);
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

	//
	public function getInvoicePrescriptions($user_id, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		if($this->ion_auth->is_doctor($user_id))
		{
			return $this->getDoctorInvoicePrescriptions($user_id, $limit, $start, $search_text, $count, $filter_data);
		}
		elseif($this->ion_auth->is_medical_store($user_id))
		{
			return $this->getMedicalStoreInvoicePrescriptions($user_id, $limit, $start, $search_text, $count, $filter_data);	
		}
		else
		{
			return false;
		}
	}

	public function getDoctorInvoicePrescriptions($user_id, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		$this->db->select('sp.*, sp.id as prescription_no, sc.full_name, DATE_FORMAT(sp.date_confirm, "%d-%m-%Y %h:%i %p") as date', FALSE);
		$this->db->from($this->table . ' As sp');
		$this->db->join($this->customer_table .' As sc', "sp.completed_by = sc.user_id AND sc.deleted = '0'", 'left');

		$this->db->where('sp.created_by', $user_id);
		$this->db->where('sp.completed_by !=', '0');
		$this->db->where('sp.deleted', '0');

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
			if(count($this->main_grid_search_field) > 0)
			{
				$search_item = '';
				$search_count = 1;
				foreach($this->main_grid_search_field as $search_field)
				{
					if($search_count == 1)
					{
						$search_item .= '(';
					}
					else
					{
						$search_item .= ' OR ';
					}
					
					$search_item .= "sc.". $search_field ." like '%". $search_text ."%'";
					if($search_count == count($this->main_grid_search_field))
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

		$this->db->order_by('sp.id', 'DESC');
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

	public function getMedicalStoreInvoicePrescriptions($user_id, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		$this->db->select('sp.*, sp.id As prescription_no, sc.full_name, DATE_FORMAT(sp.date_confirm, "%d-%m-%Y %h:%i %p") as date', FALSE);
		$this->db->from($this->table . ' As sp');
		$this->db->join($this->customer_table .' As sc', "sp.created_by = sc.user_id AND sc.deleted = '0'", 'left');
		$this->db->where('sp.completed_by', $user_id);
		$this->db->where('sp.deleted', '0');

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
			if(count($this->main_grid_search_field) > 0)
			{
				$search_item = '';
				$search_count = 1;
				foreach($this->main_grid_search_field as $search_field)
				{
					if($search_count == 1)
					{
						$search_item .= '(';
					}
					else
					{
						$search_item .= ' OR ';
					}
					
					$search_item .= "sc.". $search_field ." like '%". $search_text ."%'";
					if($search_count == count($this->main_grid_search_field))
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

		$this->db->order_by('sp.id', 'DESC');
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

	// user_id as a medical store id
	public function getInvoicePrescriptionProducts($prescription_id)
	{
		$this->db->where('prescription_id', $prescription_id);
		$this->db->where('deleted', '0');
		$result = $this->db->get($this->prescription_invoice_product_table);

		if ($result->num_rows() > 0)
        {
        	return $result->result();
        }
        else
        {
            return false;
        }
	}

	// whos sms_status = 0 then send sms to customer
	public function getPrescriptionsSMS($user_id)
	{
		$this->db->select('sp.*, GROUP_CONCAT(IFNULL(spms.full_name, "")) As stores_name', FALSE);
		$this->db->from($this->table . ' As sp');
		$this->db->where('sp.created_by', $user_id);
		$this->db->where('sp.sms_status', '0');
		$this->db->where('sp.deleted', '0');
		$this->db->join($this->prescription_store_table . " As spms", "sp.id = spms.prescription_id", 'left', FALSE);
		$this->db->group_by('sp.id');
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

	public function getPrescriptionSMSMedicalStore($prescription_id)
	{
		$this->db->select('spms.*, IFNULL(spms.full_name, "") As store_name, sc.mobile_no, sc.work_address', FALSE);
		$this->db->from($this->prescription_store_table . ' As spms');
		$this->db->join($this->customer_table . " As sc", "sc.user_id = spms.user_id", 'left', FALSE);
		$this->db->where('spms.prescription_id', $prescription_id);
		$this->db->where('spms.deleted', '0');
		$this->db->group_by('spms.user_id');
		
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

	public function getOTCPrescriptions($id, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		$this->db->select('sop.*, DATE_FORMAT(sop.date_confirm, "%d-%m-%Y %h:%i %p") as date', FALSE);
		$this->db->from($this->otc_prescription_table.' as sop');
		$this->db->where('sop.created_by', $id);
		$this->db->where('sop.deleted', '0');

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
					
					$search_item .= "sop.". $search_field ." like '%". $search_text ."%'";
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

		$this->db->order_by('sop.id', 'DESC');
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

	public function getOTCPrescriptionProducts($otc_prescription_id)
	{
		$this->db->where('otc_prescription_id', $otc_prescription_id);
		$this->db->where('deleted', '0');
		$result = $this->db->get($this->otc_prescription_product_table);

		if ($result->num_rows() > 0)
        {
        	return $result->result();
        }
        else
        {
            return false;
        }
	}

	public function getGroupByPrescriptionProducts($user_id)
	{
		if($this->ion_auth->is_doctor($user_id))
		{
			return $this->getDoctorGroupByPrescriptionProducts($user_id);
		}
		elseif($this->ion_auth->is_medical_store($user_id))
		{
			return $this->getStoreGroupByPrescriptionProducts($user_id);
		}
		else
		{
			return false;
		}
	}

	public function getDoctorGroupByPrescriptionProducts($user_id)
	{
		$this->db->from($this->prescription_invoice_product_table . ' As spip');
		$this->db->where('spip.retailer_id', (int)$user_id);
		$this->db->where('spip.deleted', '0');
		$this->db->group_by('spip.created_by, spip.product_id');
		$this->db->order_by('spip.name', 'ASC');
		$result = $this->db->get();
		//echo $this->db->last_query();
		//die();
		
		if ($result->num_rows() > 0)
        {
            return $result->result();
        }
        else
        {
            return false;
        }
	}

	public function getStoreGroupByPrescriptionProducts($user_id)
	{
		$this->db->from($this->prescription_invoice_product_table . ' As spip');
		$this->db->where('spip.created_by', (int)$user_id);
		$this->db->where('spip.deleted', '0');
		$this->db->group_by('spip.retailer_id, spip.product_id');
		$this->db->order_by('spip.name', 'ASC');
		$result = $this->db->get();
		//echo $this->db->last_query();
		//die();
		
		if ($result->num_rows() > 0)
        {
            return $result->result();
        }
        else
        {
            return false;
        }
	}

	public function checkPrescriptionStoreExist($prescription_id, $user_id)
	{
		$this->db->from($this->prescription_store_table . ' As spms');
		$this->db->where('spms.prescription_id', (int)$prescription_id);
		$this->db->where('spms.user_id', (int)$user_id);
		$this->db->where('spms.deleted', '0');
		
		$result = $this->db->get();
		//echo $this->db->last_query();
		//die();
		
		if ($result->num_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
	}
}
?>