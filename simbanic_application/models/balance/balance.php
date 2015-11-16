<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Balance extends Simba_Model
{
	public $request_data = array();
    public $db_data = array();
    public $vardefs = array();
	public $table = 'prescription';
	public $prescription_product_table = 'prescription_product';
	public $prescription_invoice_product_table = 'prescription_invoice_product';
	public $prescription_store_table = 'prescription_medical_store';
	public $prescription_seen_table = 'prescription_seen';
	public $customer_table = 'customer';
	public $grid_search_field = array();
	public $grid_products_search_field = array();

	public function __construct()
	{
		parent::__construct();
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

	public function getPrescriptionProducts($id, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		if($this->ion_auth->is_doctor())
		{
			return $this->getDoctorPrescriptionProducts($id, $limit, $start, $search_text, $count);
		}
		else
		{
			return false;
		}
	}

	public function getDoctorPrescriptionProducts($user_id = 0, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		$this->db->select('spip.*', FALSE);
		$this->db->select('IFNULL(SUM(spip.quantity),0) As quantity', FALSE);
		$this->db->select('CONCAT_WS(" ", spip.name, spip.packing_size, spip.unit) AS simbanic_product_name', FALSE);
		$this->db->select('IF(spip.unit="kg" OR spip.unit="ltr", spip.packing_size * IFNULL(SUM(spip.quantity),0), TRUNCATE((spip.packing_size / 1000) * IFNULL(SUM(spip.quantity),0), 2)) As product_unit', FALSE);
		
		$this->db->from($this->prescription_invoice_product_table . ' as spip');
		
		$this->db->where('spip.retailer_id', (int)$user_id);
		$this->db->where('spip.date_confirm IS NOT NULL');
		$this->db->where('spip.deleted', '0');

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
					
					$search_item .= "spip.". $search_field ." like '%". $search_text ."%'";
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

		$this->db->order_by('spip.name', 'ASC');
		$this->db->group_by('spip.product_id, spip.unit');

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
		$this->db->select('TRUNCATE(SUM(IFNULL(IF(spip.unit="kg" OR spip.unit="ltr", spip.packing_size * IFNULL(spip.quantity, 0), (spip.packing_size / 1000) * IFNULL(spip.quantity, 0)), 0)), 2) As product_unit', FALSE);
		$this->db->from($this->prescription_invoice_product_table . ' as spip');
		$this->db->where('retailer_id', (int)$id);
		$this->db->where('spip.deleted', '0');
		$this->db->where('spip.date_confirm IS NOT NULL');

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
	
}
?>