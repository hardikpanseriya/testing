<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends Simba_Model
{
	public $request_data = array();
    public $db_data = array();
    public $vardefs = array();
	public $table = 'temp_report';
	public $temp_point_table = 'temp_point';
	public $carry_forward_table = 'temp_carry_forward';
	public $depot_invoice_product_table = 'depot_invoice_product';
	public $retailer_invoice_product_table = 'retailer_invoice_product';
	public $depot_payment_table = 'depot_payment';
	public $retailer_payment_table = 'retailer_payment';
	public $customer_table = 'customer';
	public $product_table = 'product';
	public $prescription_invoice_product_table = 'prescription_invoice_product';
	public $grid_search_field = array('customer_id', 'full_name');
	public $main_grid_search_field = array();

	public function __construct()
	{
		parent::__construct();
		$this->init();
		$this->load->model('prescription/prescription');
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

	public function saveCustomerUnit()
	{
		$sql = "
		SELECT *,
		CASE
		WHEN unit = 50 THEN 1
		WHEN unit = 100 THEN 2
		WHEN unit = 150 THEN 3
		WHEN unit = 200 THEN 5
		WHEN unit = 250 THEN 6
		WHEN unit = 300 THEN 8
		WHEN unit = 350 THEN 9
		WHEN unit = 400 THEN 12
		WHEN unit = 450 THEN 13
		WHEN unit >= 500 THEN 16
		ELSE 0
		END As point,
		NOW() As date_confirm,
		NOW() As date_created
		FROM
		(
			SELECT *,
			IFNULL(total_unit - (total_unit % 50), 0) As unit,
			IF((total_unit % 50) >= 30, IFNULL(total_unit % 50, 0), 0) As cf_unit
			FROM 
			(
				SELECT
				buy_unit,
				sc.user_id,
				sc.customer_type,
				sc.customer_id,
				sc.sponsor_id,
				sc.full_name,
				IF(sc.customer_type = 'medical_store', 
					IFNULL(otc_prescription_unit, 0),
					IFNULL(buy_unit, 0) + IFNULL(prescription_unit, 0)
				) As total_unit, 
				simba_prescription.prescription_unit,
				simba_otc_prescription.otc_prescription_unit 
				FROM {PRE}customer As sc
				LEFT JOIN (
					SELECT
						srip.retailer_id,
						srip.date_confirm, 
						SUM(
							IFNULL(
									IF(srip.unit='kg' OR srip.unit='ltr', 
										srip.packing_size * IFNULL(srip.order_quantity, 0), 
										(srip.packing_size / 1000) * IFNULL(srip.order_quantity, 0)), 0
							)
						) As buy_unit 
					FROM {PRE}retailer_invoice_product As srip
					WHERE srip.deleted = '0'
					AND srip.date_confirm IS NOT NULL
					AND MONTH(srip.date_confirm) = MONTH(CURRENT_DATE)
					GROUP BY 
						srip.retailer_id, 
						MONTH(CURRENT_DATE)
				) As simba
				ON sc.user_id = simba.retailer_id
				LEFT JOIN (
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
						spip.retailer_id, 
						MONTH(CURRENT_DATE)
				) As simba_prescription
				ON sc.user_id = simba_prescription.retailer_id
				LEFT JOIN (
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
						sopp.created_by, 
						MONTH(CURRENT_DATE)
				) As simba_otc_prescription
				ON sc.user_id = simba_otc_prescription.created_by
				WHERE sc.deleted = '0'
			) As simba_sub
		) As simba_final";
	
		$result = $this->db->query($sql);
		//echo $this->db->last_query();
		//die();

		if ($result->num_rows() > 0)
        {
            $res = $result->result_array();
            $this->db->truncate($this->temp_point_table);
        	$this->query_model->save_multiple($this->temp_point_table, $res);
        	return true;
        }
        else
        {
            return false;
        }

	}

	public function getCustomerStageReports($id, $date, $limit = '', $start = '', $search_text = '', $count = '')
	{
		$user_type = $this->ion_auth->user()->row()->user_type;
		$this->db->select('customer_id, full_name, customer_type');
		$this->db->where('deleted', '0');
		$this->db->where('sponsor_id !=', '0');
		if($user_type == 'customer')
		{
			$this->db->where('user_id', $id);
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
					
					$search_item .= "". $search_field ." like '%". $search_text ."%'";
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
		$this->db->order_by('id', 'ASC');
		$result = $this->db->get($this->customer_table);

		if(empty($count))
		{
			if ($result->num_rows() > 0)
	        {
	        	$customer_point = array();
	        	$i = 0;
	        	foreach ($result->result() as $row)
	        	{
	        		$customer_id = $row->customer_id;
	        		$full_name = $row->full_name;
	        		$customer_type = $row->customer_type;

	        		// Stage1
	        		/*if($customer_type == 'medical_store')
	        		{
	        			$stage_1_rs = 0;
	        		}
	        		else
	        		{
	        			$stage_1_array = array($customer_id);
	        			$stage_1_rs = $this->getCustomerTempReport($customer_id, $date) * 500;
	        		}*/
	        		$stage_1_array = array($customer_id);
	        			$stage_1_rs = $this->getCustomerTempReport($customer_id, $date) * 500;
	        		
	        		// Stage2
	        		$stage_2 = $this->getstage2($customer_id);
	        		if(!empty($stage_2))
	        		{
	        			$stage_2_array = explode(",", $stage_2);
		        		if(!empty($stage_2_array))
		        		{
		        			$stage_2_rs = $this->getCustomerTempReport($stage_2_array, $date) * 200;	
		        		}
		        		else
		        		{
		        			$stage_2_rs = 0;
		        		}
	        		}
	        		else
	        		{
	        			$stage_2_rs = 0;
	        		}

	        		// Stage3
	        		$stage_3 = $this->getstage3($customer_id);
	        		if(!empty($stage_3))
	        		{
	        			$stage_3_array = explode(",", $stage_3);
		        		if(!empty($stage_3_array))
		        		{
		        			$stage_3_rs = $this->getCustomerTempReport($stage_3_array, $date) * 100;	
		        		}
		        		else
		        		{
		        			$stage_3_rs = 0;
		        		}
	        		}
	        		else
	        		{
	        			$stage_3_rs = 0;
	        		}

	        		// Stage4
	        		$stage_4 = $this->getstage4($customer_id);
	        		if(!empty($stage_4))
	        		{
	        			$stage_4_array = explode(",", $stage_4);
		        		if(!empty($stage_4_array))
		        		{
		        			$stage_4_rs = $this->getCustomerTempReport($stage_4_array, $date) * 50;	
		        		}
		        		else
		        		{
		        			$stage_4_rs = 0;
		        		}
	        		}
	        		else
	        		{
	        			$stage_4_rs = 0;
	        		}

	        		$total_pay = $stage_1_rs + $stage_2_rs + $stage_3_rs + $stage_4_rs;

		        	$customer_point[$i] = array(
		        		'customer_id' => $customer_id,
		        		'full_name' => $full_name,
		        		'stage1' => $stage_1_rs,
		        		'stage2' => $stage_2_rs,
		        		'stage3' => $stage_3_rs,
		        		'stage4' => $stage_4_rs,
		        		'total_pay' => $total_pay
	        		);
	        		//var_dump($customer_point);
	        		$i++;
	        	}
	        	return $customer_point;
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

	public function getstage2($customer_id)
	{
		$this->db->select("GROUP_CONCAT(customer_id) As stage_2", FALSE);
		$this->db->where('sponsor_id', $customer_id);
		$this->db->where('deleted', '0');
		return $this->db->get($this->customer_table)->row()->stage_2;
	}
	public function getstage3($customer_id)
	{
		$sql = "
			SELECT GROUP_CONCAT(customer_id) As stage_3 
			FROM {PRE}customer 
			WHERE sponsor_id IN (
					SELECT customer_id FROM {PRE}customer 
					WHERE sponsor_id IN('". $customer_id ."')
				)
			";
		return $this->db->query($sql)->row()->stage_3;
	}
	public function getstage4($customer_id)
	{
		$sql = "
		SELECT GROUP_CONCAT(customer_id) As stage_4 
		FROM {PRE}customer 
		WHERE sponsor_id IN(
				SELECT customer_id FROM {PRE}customer 
				WHERE sponsor_id IN (
					SELECT customer_id FROM {PRE}customer 
					WHERE sponsor_id IN('". $customer_id ."'))
			)";
		return $this->db->query($sql)->row()->stage_4;
	}

	public function getCustomerTempReport($customer_id_array = array(), $date = CURRENT_DATETIME)
	{
		if(!empty($customer_id_array))
		{
			$this->db->select('IFNULL(SUM(point), 0) As stage_point', FALSE);
			$this->db->where('MONTH(date_confirm)', "MONTH('". $date ."')", FALSE);
			//$this->db->where('customer_type !=', 'medical_store');
			$this->db->where_in('customer_id', $customer_id_array);
			$result = $this->db->get($this->temp_point_table);
			//echo $this->db->last_query();
			//die();
			if ($result->num_rows() == 1)
        	{
        		return $result->row()->stage_point;
        	}
        	else
        	{
        		return '0';
        	}
		}
		else
		{
			return '0';
		}
	}

	public function getPrescriptionReport($id, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		$this->load->model('customer/customer');
		$this->load->model('product/product');

		if($this->ion_auth->is_doctor($id))
		{
			return $this->getDoctorPrescriptionReport($id, $limit, $start, $search_text, $count, $filter_data);
		}
		elseif($this->ion_auth->is_medical_store($id))
		{
			return $this->getMedicalStorePrescriptionReport($id, $limit, $start, $search_text, $count, $filter_data);	
		}
		else
		{
			return false;
		}
	}

	public function getDoctorPrescriptionReport($id, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		$users = $this->customer->getRelatedCustomers($id);

		if($users)
		{
			$productsData = $this->prescription->getGroupByPrescriptionProducts($id);
			if(!empty($count))
			{
				return count($productsData);
			}
			if($productsData)
			{
				$i = 0;
				foreach($productsData as $product)
				{
					$product_id = $product->product_id;
					$simba_product_name = $product->name . " " . $product->packing_size . " " . $product->unit;
					$response[$i] = array(
            			'product_name' => $simba_product_name
        			);
					foreach($users as $customer)
					{
						$retailer_id = $customer->user_id;
						if ($id != $retailer_id) 
						{
							$getData = $this->getDoctorMedicalStoreProductPrescription($id, $retailer_id, $product_id, $limit, $start, $search_text, $count, $filter_data);
							if($getData)
			            	{
		            			$response[$i][$retailer_id] = $getData->total_qty;
			            	}
						}
					}
					$i++;
				}
				return $response;
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

	public function getDoctorMedicalStoreProductPrescription($id, $retailer_id, $product_id, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		$this->db->select('spip.*, IFNULL(SUM(spip.quantity), 0) As total_qty, sc.full_name', FALSE);

		$this->db->from($this->prescription_invoice_product_table . ' As spip');

		$this->db->join($this->customer_table.' as sc', "sc.user_id = spip.retailer_id AND sc.deleted = '0'", 'left');

		$this->db->where('spip.retailer_id', (int)$id);
		$this->db->where('spip.created_by', (int)$retailer_id);
		$this->db->where('spip.product_id', (int)$product_id);
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
					
					$search_item .= "spip.". $search_field ." like '%". $search_text ."%'";
					if($search_count == count($this->main_grid_search_field))
					{
						$search_item .= ')';
					}

					$search_count++;
				}
				$this->db->where($search_item);
			}
		}

		$this->db->group_by('spip.created_by, spip.product_id');
		$this->db->order_by('spip.name', 'ASC');
		$result = $this->db->get();
		//echo $this->db->last_query();
		//die();
		
		if ($result->num_rows() == 1)
        {
            return $result->row();
        }
        else
        {
            return false;
        }
	}

	public function getMedicalStorePrescriptionReport($id, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		
		$users = $this->customer->getRelatedCustomers($id);
		if($users)
		{
			$productsData = $this->prescription->getGroupByPrescriptionProducts($id);
			if(!empty($count))
			{
				return count($productsData);
			}
			if($productsData)
			{
				$i = 0;
				foreach($productsData as $product)
				{
					$product_id = $product->product_id;
					$simba_product_name = $product->name . " " . $product->packing_size . " " . $product->unit;
					$response[$i] = array(
            			'product_name' => $simba_product_name
        			);
					foreach($users as $customer)
					{
						$retailer_id = $customer->user_id;
						if ($id != $retailer_id) 
						{
							$getData = $this->getMedicalStoreDoctorProductPrescription($id, $retailer_id, $product_id, $limit, $start, $search_text, $count, $filter_data);
							if($getData)
			            	{
			            		$response[$i][$retailer_id] = $getData->total_qty;
			            	}
						}
					}
					$i++;
				}
				return $response;
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

	public function getMedicalStoreDoctorProductPrescription($created_by, $retailer_id, $product_id, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		$this->db->select('spip.*, IFNULL(SUM(spip.quantity), 0) As total_qty, sc.full_name', FALSE);

		$this->db->from($this->prescription_invoice_product_table . ' As spip');

		$this->db->join($this->customer_table.' as sc', "sc.user_id = spip.retailer_id AND sc.deleted = '0'", 'left');

		$this->db->where('spip.retailer_id', (int)$retailer_id);
		$this->db->where('spip.created_by', (int)$created_by);
		$this->db->where('spip.product_id', (int)$product_id);
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
					
					$search_item .= "spip.". $search_field ." like '%". $search_text ."%'";
					if($search_count == count($this->main_grid_search_field))
					{
						$search_item .= ')';
					}

					$search_count++;
				}
				$this->db->where($search_item);
			}
		}

		$this->db->group_by('spip.retailer_id, spip.product_id');
		$this->db->order_by('spip.name', 'ASC');
		$result = $this->db->get();
		//echo $this->db->last_query();
		//die();
		
		if ($result->num_rows() == 1)
        {
            return $result->row();
        }
        else
        {
            return false;
        }
	}

	public function getProductStockReport($user_id, $filter_user_id, $start_date, $end_date, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		if($this->ion_auth->is_admin())
		{
			return $this->getAdminProductStockReport($user_id, $filter_user_id, $start_date, $end_date, $limit, $start, $search_text, $count, $filter_data);
		}
		elseif($this->ion_auth->is_depot())
		{
			return $this->getDepotProductStockReport($user_id, $start_date, $end_date, $limit, $start, $search_text, $count, $filter_data);
		}
		elseif($this->ion_auth->is_customer())
		{
			return $this->getCustomerProductStockReport($user_id, $start_date, $end_date, $limit, $start, $search_text, $count, $filter_data);
		}
		else
		{
			return false;
		}
	}

	public function getAdminProductStockReport($user_id, $filter_user_id, $start_date, $end_date, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		if(!empty($filter_user_id))
		{
			return $this->getDepotProductStockReport($filter_user_id, $start_date, $end_date, $limit, $start, $search_text, $count, $filter_data);
		}
		
		$this->db->select('sp.*', FALSE);
		$this->db->select('CONCAT_WS(" ", sp.name, sp.packing_size, sp.unit) AS product_name', FALSE);

		$this->db->select('IFNULL((IFNULL(previousBuyQty, 0) - IFNULL(prevoiusSellQty, 0)), 0) As opening_stock', FALSE);
		$this->db->select('IFNULL(ReceivedQty, 0) As received_qty', FALSE);
		$this->db->select('IFNULL((IFNULL((IFNULL(previousBuyQty, 0) - IFNULL(prevoiusSellQty, 0)), 0) + IFNULL(ReceivedQty, 0)), 0) As total', FALSE);
		$this->db->select('IFNULL(SellQty, 0) As sell_qty', FALSE);
		$this->db->select('IFNULL(((IFNULL((IFNULL(previousBuyQty, 0) - IFNULL(prevoiusSellQty, 0)), 0) + IFNULL(ReceivedQty, 0)) - IFNULL(SellQty, 0)), 0) As closing_qty', FALSE);

		if(!empty($filter_user_id))
		{
			$filter_and = "sdip.depot_id = " . $filter_user_id . " AND";
		}
		else
		{
			$filter_and = "";
		}

		$this->db->from($this->product_table.' as sp');

		$this->db->join("( SELECT ss.product_id, SUM(ss.quantity) AS previousBuyQty FROM {PRE}stock AS ss 
				WHERE 
				ss.date_created < '". $start_date ."' AND
				ss.deleted='0' 
				GROUP BY ss.product_id
			) AS simba_stock", "sp.id = simba_stock.product_id", 'left', FALSE);

		$this->db->join("( SELECT sdip.product_id, SUM(sdip.order_quantity) AS prevoiusSellQty FROM {PRE}depot_invoice_product AS sdip 
				WHERE 
				sdip.date_confirm < '". $start_date ."' AND
				" . $filter_and ."
				sdip.deleted='0' 
				GROUP BY sdip.product_id
			) AS simba_depot_stock", "sp.id = simba_depot_stock.product_id", 'left', FALSE);

		$this->db->join("( SELECT ss.product_id, SUM(ss.quantity) AS ReceivedQty FROM {PRE}stock AS ss 
				WHERE 
				DATE(ss.date_created) BETWEEN '". $start_date ."' AND '". $end_date ."'
				AND ss.deleted='0' 
				GROUP BY ss.product_id
			) AS simba_received_stock", "sp.id = simba_received_stock.product_id", 'left', FALSE);

		$this->db->join("( SELECT sdip.product_id, SUM(sdip.order_quantity) AS SellQty FROM {PRE}depot_invoice_product AS sdip 
				WHERE 
				DATE(sdip.date_confirm) BETWEEN '". $start_date ."' AND '". $end_date ."' AND 
				" . $filter_and ."
				sdip.deleted='0' 
				GROUP BY sdip.product_id
			) AS simba_sell_stock", "sp.id = simba_sell_stock.product_id", 'left', FALSE);

		$this->db->where('sp.deleted', '0');

		if(!empty($filter_data))
		{
			if(count($filter_data) > 0)
			{
				foreach($filter_data as $key => $value)
				{
					$this->db->where($key, $value, FALSE);
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

	public function getDepotProductStockReport($user_id, $start_date, $end_date, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		$this->db->select('sdip.*', FALSE);
		$this->db->select('CONCAT_WS(" ", sdip.name, sdip.packing_size, sdip.unit) AS product_name', FALSE);

		$this->db->select('IFNULL((IFNULL(previousBuyQty, 0) - IFNULL(prevoiusSellQty, 0)), 0) As opening_stock', FALSE);
		$this->db->select('IFNULL(ReceivedQty, 0) As received_qty', FALSE);
		$this->db->select('IFNULL((IFNULL((IFNULL(previousBuyQty, 0) - IFNULL(prevoiusSellQty, 0)), 0) + IFNULL(ReceivedQty, 0)), 0) As total', FALSE);
		$this->db->select('IFNULL(SellQty, 0) As sell_qty', FALSE);
		$this->db->select('IFNULL(((IFNULL((IFNULL(previousBuyQty, 0) - IFNULL(prevoiusSellQty, 0)), 0) + IFNULL(ReceivedQty, 0)) - IFNULL(SellQty, 0)), 0) As closing_qty', FALSE);

		$this->db->from($this->depot_invoice_product_table.' as sdip');

		$this->db->join("( SELECT sdip.product_id, SUM(sdip.order_quantity) AS previousBuyQty FROM {PRE}depot_invoice_product AS sdip 
				WHERE
				sdip.depot_id = ". $user_id ." AND
				sdip.date_confirm < '". $start_date ."' AND
				sdip.deleted='0' 
				GROUP BY sdip.product_id
			) AS previousBuyStock", "sdip.product_id = previousBuyStock.product_id", 'left', FALSE);

		$this->db->join("( SELECT srip.product_id, SUM(srip.order_quantity) AS prevoiusSellQty FROM {PRE}retailer_invoice_product AS srip 
				WHERE
				srip.created_by = ". $user_id ." AND
				srip.date_created < '". $start_date ."' AND
				srip.deleted='0' 
				GROUP BY srip.product_id
			) AS prevoiusSellStock", "sdip.product_id = prevoiusSellStock.product_id", 'left', FALSE);

		$this->db->join("( SELECT sdip.product_id, SUM(sdip.order_quantity) AS ReceivedQty FROM {PRE}depot_invoice_product AS sdip 
				WHERE
				sdip.depot_id = ". $user_id ." AND 
				DATE(sdip.date_created) BETWEEN '". $start_date ."' AND '". $end_date ."'
				AND sdip.deleted='0' 
				GROUP BY sdip.product_id
			) AS receivedStock", "sdip.product_id = receivedStock.product_id", 'left', FALSE);

		$this->db->join("( SELECT srip.product_id, SUM(srip.order_quantity) AS SellQty FROM {PRE}retailer_invoice_product AS srip 
				WHERE
				srip.created_by = ". $user_id ." AND
				DATE(srip.date_created) BETWEEN '". $start_date ."' AND '". $end_date ."'
				AND srip.deleted='0' 
				GROUP BY srip.product_id
			) AS sellStock", "sdip.product_id = sellStock.product_id", 'left', FALSE);

		$this->db->where('sdip.depot_id', $user_id);
		$this->db->where('sdip.deleted', '0');

		if(!empty($filter_data))
		{
			if(count($filter_data) > 0)
			{
				foreach($filter_data as $key => $value)
				{
					$this->db->where($key, $value, FALSE);
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

	public function getCustomerProductStockReport($user_id, $start_date, $end_date, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		$this->db->select('srip.*', FALSE);
		$this->db->select('CONCAT_WS(" ", srip.name, srip.packing_size, srip.unit) AS product_name', FALSE);

		$this->db->select('IFNULL((IFNULL(previousBuyQty, 0) - (IFNULL(prevoiusPrescSellQty, 0) + IFNULL(prevoiusOTCPrescSellQty, 0))), 0) As opening_stock', FALSE);
		$this->db->select('IFNULL(ReceivedQty, 0) As received_qty', FALSE);
		$this->db->select('IFNULL((IFNULL((IFNULL(previousBuyQty, 0) - (IFNULL(prevoiusPrescSellQty, 0) + IFNULL(prevoiusOTCPrescSellQty, 0))), 0) + IFNULL(ReceivedQty, 0)), 0) As total', FALSE);
		$this->db->select('IFNULL(IFNULL(SellPrescQty, 0) + IFNULL(SellOTCPrescQty, 0), 0) As sell_qty', FALSE);
		$this->db->select('IFNULL(((IFNULL((IFNULL(previousBuyQty, 0) - (IFNULL(prevoiusPrescSellQty, 0) + IFNULL(prevoiusOTCPrescSellQty, 0))), 0) + IFNULL(ReceivedQty, 0)) - IFNULL(IFNULL(SellPrescQty, 0) + IFNULL(SellOTCPrescQty, 0), 0)), 0) As closing_qty', FALSE);

		$this->db->from($this->retailer_invoice_product_table.' as srip');

		$this->db->join("( SELECT srip.product_id, SUM(srip.order_quantity) AS previousBuyQty FROM {PRE}retailer_invoice_product AS srip 
				WHERE
				srip.retailer_id = ". $user_id ." AND
				srip.date_confirm < '". $start_date ."' AND
				srip.deleted='0' 
				GROUP BY srip.product_id
			) AS previousBuyStock", "srip.product_id = previousBuyStock.product_id", 'left', FALSE);

		$this->db->join("( SELECT spip.product_id, SUM(spip.quantity) AS prevoiusPrescSellQty FROM {PRE}prescription_invoice_product AS spip 
				WHERE
				spip.created_by = ". $user_id ." AND
				spip.date_confirm < '". $start_date ."' AND
				spip.deleted='0' 
				GROUP BY spip.product_id
			) AS prevoiusPrescSellStock", "srip.product_id = prevoiusPrescSellStock.product_id", 'left', FALSE);

		$this->db->join("( SELECT sopp.product_id, SUM(sopp.quantity) AS prevoiusOTCPrescSellQty FROM {PRE}otc_prescription_product AS sopp 
				WHERE
				sopp.created_by = ". $user_id ." AND
				sopp.date_confirm < '". $start_date ."' AND
				sopp.deleted='0' 
				GROUP BY sopp.product_id
			) AS prevoiusOTCPrescSellStock", "srip.product_id = prevoiusOTCPrescSellStock.product_id", 'left', FALSE);

		$this->db->join("( SELECT srip.product_id, SUM(srip.order_quantity) AS ReceivedQty FROM {PRE}retailer_invoice_product AS srip 
				WHERE
				srip.retailer_id = ". $user_id ." AND 
				DATE(srip.date_confirm) BETWEEN '". $start_date ."' AND '". $end_date ."'
				AND srip.deleted='0' 
				GROUP BY srip.product_id
			) AS receivedStock", "srip.product_id = receivedStock.product_id", 'left', FALSE);

		$this->db->join("( SELECT spip.product_id, SUM(spip.quantity) AS SellPrescQty FROM {PRE}prescription_invoice_product AS spip 
				WHERE
				spip.created_by = ". $user_id ." AND
				DATE(spip.date_confirm) BETWEEN '". $start_date ."' AND '". $end_date ."'
				AND spip.deleted='0' 
				GROUP BY spip.product_id
			) AS sellPrescStock", "srip.product_id = sellPrescStock.product_id", 'left', FALSE);

		$this->db->join("( SELECT sopp.product_id, SUM(quantity) AS SellOTCPrescQty FROM {PRE}otc_prescription_product AS sopp 
				WHERE
				sopp.created_by = ". $user_id ." AND
				DATE(sopp.date_confirm) BETWEEN '". $start_date ."' AND '". $end_date ."'
				AND sopp.deleted='0' 
				GROUP BY sopp.product_id
			) AS sellPrescOTCStock", "srip.product_id = sellPrescOTCStock.product_id", 'left', FALSE);

		$this->db->where('srip.retailer_id', $user_id);
		$this->db->where('srip.deleted', '0');

		if(!empty($filter_data))
		{
			if(count($filter_data) > 0)
			{
				foreach($filter_data as $key => $value)
				{
					$this->db->where($key, $value, FALSE);
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

		$this->db->order_by("srip.name ASC, 
			IF(srip.unit = 'gm' OR srip.unit = 'ml', srip.packing_size, srip.name ) ASC,
			IF(srip.unit = 'kg' OR srip.unit = 'ltr', srip.packing_size, srip.name ) ASC ", FALSE);
		
		$this->db->group_by('srip.product_id');
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

	public function getPaymentReport($user_id, $depot_id, $start_date, $end_date, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		if($this->ion_auth->is_admin())
		{
			return $this->getAdminToDepotPaymentReport($user_id, $depot_id, $start_date, $end_date, $limit, $start, $search_text, $count, $filter_data);
		}
		elseif($this->ion_auth->is_depot())
		{
			return $this->getDepotToAdminCustomerPaymentReport($user_id, $depot_id, $start_date, $end_date, $limit, $start, $search_text, $count, $filter_data);
		}
		elseif($this->ion_auth->is_customer())
		{
			return $this->getCustomerToDepotPaymentReport($user_id, $depot_id, $start_date, $end_date, $limit, $start, $search_text, $count, $filter_data);
		}
		else
		{
			return false;
		}
	}

	public function getAdminToDepotPaymentReport($user_id, $depot_id, $start_date, $end_date, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		$payment_data = array();

		$this->db->select('IFNULL(SUM(IFNULL((sdip.order_quantity * sdip.price),0)) - IFNULL(previousPayment.previousAmount, 0), 0) As due_balance', FALSE);
		$this->db->from($this->depot_invoice_product_table . ' As sdip');

		$this->db->join("( SELECT sdp.depot_id, SUM(sdp.amount) AS previousAmount FROM {PRE}depot_payment AS sdp 
				WHERE
				sdp.depot_id = ". $depot_id ." AND 
				sdp.confirm_date < '". $start_date ."' AND
				sdp.status = 'Done' AND
				sdp.deleted='0' 
				GROUP BY sdp.depot_id
			) AS previousPayment", "sdip.depot_id = previousPayment.depot_id", 'left', FALSE);

		$this->db->where('sdip.depot_id', $depot_id);
		$this->db->where('sdip.date_created <', $start_date);
		$this->db->where('sdip.deleted', '0');
		$this->db->group_by('sdip.depot_id');
		$result = $this->db->get();
		//echo $this->db->last_query();
		//die();

		if ($result->num_rows() == 1)
        {
        	$due_balance = $result->row()->due_balance;
        	$payment_data[0]['details'] = 'Op. Due Balance';
        	$payment_data[0]['due_balance'] = $due_balance;
    	}
    	else
    	{
    		$due_balance = 0;
    		$payment_data[0]['details'] = 'Op. Due Balance';
        	$payment_data[0]['due_balance'] = $due_balance;
    	}

    	$query = "
			(
				SELECT
				sdip.depot_invoice_id,
				sdip.depot_id, 
				DATE_FORMAT(sdip.date_created, '%Y-%m-%d') as date,
				SUM(IFNULL((sdip.order_quantity * sdip.price),0)) As amount,
    			'' As method,
    			'' As receipt_no,
    			'' As cheque_no,
    			'' As transfer_id
    			FROM {PRE}depot_invoice_product AS sdip 
				WHERE
				sdip.depot_id = ". $depot_id ." AND 
				DATE(sdip.date_created) BETWEEN '". $start_date ."' AND '". $end_date ."'
				AND sdip.deleted='0'
				GROUP BY depot_invoice_id
			)
			UNION ALL
			(
				SELECT
				'' As depot_invoice_id,
				sdp.depot_id,
				DATE_FORMAT(sdp.confirm_date, '%Y-%m-%d') as date,
				sdp.amount As amount,
				sdp.method,
				sdp.receipt_no,
				sdp.cheque_no,
				sdp.transfer_id
				FROM {PRE}depot_payment AS sdp 
				WHERE
				sdp.depot_id = ". $depot_id ." AND
				DATE(sdp.confirm_date) BETWEEN '". $start_date ."' AND '". $end_date ."' AND
				sdp.status = 'Done' AND
				sdp.deleted='0'
			)
			ORDER BY date ASC
			";

        $result = $this->db->query($query);
        //echo $this->db->last_query();
        //die();

		if ($result->num_rows() > 0)
        {
            $res = $result->result();
            if($res)
            {
            	$i = 1;
            	foreach($res as $row)
            	{
            		$depot_invoice_id = $row->depot_invoice_id;
            		$date = $row->date;
            		$amount = $row->amount;
            		$method = $row->method;

            		if(!empty($depot_invoice_id))
            		{
            			$details = anchor('invoice/view/'.$depot_invoice_id, "Invoice No.".$depot_invoice_id, array('target' => '_blank'));
            			
            			$payment_data[$i]['date'] = convertYMDtoDMY('-', $date);
            			$payment_data[$i]['details'] = $details;
            			$payment_data[$i]['debit'] = $amount;
            			$due_balance = $due_balance + $amount;
            			$payment_data[$i]['due_balance'] = $due_balance;
            		}
            		else
            		{
            			if(!empty($method))
            			{
            				$details = "Payment By ". $method;
            				
            				if($method == 'Cash')
            				{
            					$details .= " <br/> Receipt No. " . $row->receipt_no;
            				}
            				else if($method == 'Cheque')
            				{
            					$details .= " <br/> Cheque No. " . $row->cheque_no;
            				}
            				else if($method == 'NEFT')
            				{
            					$details .= " <br/> Transfer ID. " . $row->transfer_id;
            				}
            				$payment_data[$i]['date'] = convertYMDtoDMY('-', $date);
            				$payment_data[$i]['details'] = $details;
	            			$payment_data[$i]['credit'] = $amount;
	            			$due_balance = $due_balance - $amount;
	            			$payment_data[$i]['due_balance'] = $due_balance;
            			}
            		}
            		$i++;
            	}
            }
        }
        return $payment_data;
        
	}

	// if filter_user_id empth then company report else customer report
	public function getDepotToAdminCustomerPaymentReport($user_id, $filter_user_id, $start_date, $end_date, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		if(!empty($filter_user_id))
		{
			return $this->getDepotToCustomerPaymentReport($user_id, $filter_user_id, $start_date, $end_date, $limit, $start, $search_text, $count, $filter_data);
		}
		else
		{
			return $this->getDepotToAdminPaymentReport($user_id, $start_date, $end_date, $limit, $start, $search_text, $count, $filter_data);
		}
	}
	public function getDepotToAdminPaymentReport($user_id, $start_date, $end_date, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		$payment_data = array();

		$this->db->select('IFNULL(SUM(IFNULL((sdip.order_quantity * sdip.price),0)) - IFNULL(previousPayment.previousAmount, 0), 0) As due_balance', FALSE);
		$this->db->from($this->depot_invoice_product_table . ' As sdip');

		$this->db->join("( SELECT sdp.depot_id, SUM(sdp.amount) AS previousAmount FROM {PRE}depot_payment AS sdp 
				WHERE
				sdp.depot_id = ". $user_id ." AND 
				sdp.confirm_date < '". $start_date ."' AND
				sdp.status = 'Done' AND
				sdp.deleted='0' 
				GROUP BY sdp.depot_id
			) AS previousPayment", "sdip.depot_id = previousPayment.depot_id", 'left', FALSE);

		$this->db->where('sdip.depot_id', $user_id);
		$this->db->where('sdip.date_confirm <', $start_date);
		$this->db->where('sdip.deleted', '0');
		$this->db->group_by('sdip.depot_id');
		$result = $this->db->get();
		//echo $this->db->last_query();
		//die();

		if ($result->num_rows() == 1)
        {
        	$due_balance = $result->row()->due_balance;
        	$payment_data[0]['details'] = 'Op. Due Balance';
        	$payment_data[0]['due_balance'] = $due_balance;
    	}
    	else
    	{
    		$due_balance = 0;
    		$payment_data[0]['details'] = 'Op. Due Balance';
        	$payment_data[0]['due_balance'] = $due_balance;
    	}

    	$query = "
			(
				SELECT
				sdip.depot_invoice_id,
				sdip.depot_id, 
				DATE_FORMAT(sdip.date_confirm, '%Y-%m-%d') as date,
				SUM(IFNULL((sdip.order_quantity * sdip.price),0)) As amount,
    			'' As method,
    			'' As receipt_no,
    			'' As cheque_no,
    			'' As transfer_id
    			FROM {PRE}depot_invoice_product AS sdip 
				WHERE
				sdip.depot_id = ". $user_id ." AND 
				DATE(sdip.date_confirm) BETWEEN '". $start_date ."' AND '". $end_date ."'
				AND sdip.deleted='0'
				GROUP BY depot_invoice_id
			)
			UNION ALL
			(
				SELECT
				'' As depot_invoice_id,
				sdp.depot_id,
				DATE_FORMAT(sdp.confirm_date, '%Y-%m-%d') as date,
				sdp.amount As amount,
				sdp.method,
				sdp.receipt_no,
				sdp.cheque_no,
				sdp.transfer_id
				FROM {PRE}depot_payment AS sdp 
				WHERE
				sdp.depot_id = ". $user_id ." AND
				DATE(sdp.confirm_date) BETWEEN '". $start_date ."' AND '". $end_date ."' AND
				sdp.status = 'Done' AND
				sdp.deleted='0'
			)
			ORDER BY date ASC
			";

        $result = $this->db->query($query);
        //echo $this->db->last_query();
        //die();

		if ($result->num_rows() > 0)
        {
            $res = $result->result();
            if($res)
            {
            	$i = 1;
            	foreach($res as $row)
            	{
            		$depot_invoice_id = $row->depot_invoice_id;
            		$date = $row->date;
            		$amount = $row->amount;
            		$method = $row->method;

            		if(!empty($depot_invoice_id))
            		{
            			$details = anchor('invoice/view/'.$depot_invoice_id, "Invoice No.".$depot_invoice_id, array('target' => '_blank'));
            			
            			$payment_data[$i]['date'] = convertYMDtoDMY('-', $date);
            			$payment_data[$i]['details'] = $details;
            			$payment_data[$i]['debit'] = $amount;
            			$due_balance = $due_balance + $amount;
            			$payment_data[$i]['due_balance'] = $due_balance;
            		}
            		else
            		{
            			if(!empty($method))
            			{
            				$details = "Payment By ". $method;
            				
            				if($method == 'Cash')
            				{
            					$details .= " <br/> Receipt No. " . $row->receipt_no;
            				}
            				else if($method == 'Cheque')
            				{
            					$details .= " <br/> Cheque No. " . $row->cheque_no;
            				}
            				else if($method == 'NEFT')
            				{
            					$details .= " <br/> Transfer ID. " . $row->transfer_id;
            				}
            				$payment_data[$i]['date'] = convertYMDtoDMY('-', $date);
            				$payment_data[$i]['details'] = $details;
	            			$payment_data[$i]['credit'] = $amount;
	            			$due_balance = $due_balance - $amount;
	            			$payment_data[$i]['due_balance'] = $due_balance;
            			}
            		}
            		$i++;
            	}
            }
        }
        return $payment_data;

	}
	public function getDepotToCustomerPaymentReport($user_id, $filter_user_id, $start_date, $end_date, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		$payment_data = array();

		$this->db->select('IFNULL(SUM(IFNULL((srip.order_quantity * srip.price),0)) - IFNULL(previousPayment.previousAmount, 0), 0) As due_balance', FALSE);
		$this->db->from($this->retailer_invoice_product_table . ' As srip');

		$this->db->join("( SELECT srp.depot_id, srp.retailer_id, SUM(srp.amount) AS previousAmount FROM {PRE}retailer_payment AS srp 
				WHERE
				srp.depot_id = ". $user_id ." AND
				srp.retailer_id = ". $filter_user_id ." AND 
				srp.confirm_date < '". $start_date ."' AND
				srp.status = 'Done' AND
				srp.deleted='0' 
				GROUP BY srp.depot_id
			) AS previousPayment", "srip.created_by = previousPayment.depot_id AND srip.retailer_id = previousPayment.retailer_id", 'left', FALSE);

		$this->db->where('srip.created_by', $user_id);
		$this->db->where('srip.retailer_id', $filter_user_id);
		$this->db->where('srip.date_created <', $start_date);
		$this->db->where('srip.deleted', '0');
		$this->db->group_by('srip.created_by');
		$result = $this->db->get();
		//echo $this->db->last_query();
		//die();

		if ($result->num_rows() == 1)
        {
        	$due_balance = $result->row()->due_balance;
        	$payment_data[0]['details'] = 'Op. Due Balance';
        	$payment_data[0]['due_balance'] = $due_balance;
        	$payment_data[0]['filter_user_id'] = $filter_user_id;
    	}
    	else
    	{
    		$due_balance = 0;
    		$payment_data[0]['details'] = 'Op. Due Balance';
        	$payment_data[0]['due_balance'] = $due_balance;
        	$payment_data[0]['filter_user_id'] = $filter_user_id;
    	}

    	$query = "
			(
				SELECT
				srip.retailer_invoice_id, 
				DATE_FORMAT(srip.date_created, '%Y-%m-%d') as date,
				SUM(IFNULL((srip.order_quantity * srip.price),0)) As amount,
    			'' As method,
    			'' As receipt_no,
    			'' As cheque_no,
    			'' As transfer_id
    			FROM {PRE}retailer_invoice_product AS srip 
				WHERE
				srip.created_by = ". $user_id ." AND 
				srip.retailer_id = ". $filter_user_id ." AND 
				DATE(srip.date_created) BETWEEN '". $start_date ."' AND '". $end_date ."'
				AND srip.deleted='0'
				GROUP BY retailer_invoice_id
			)
			UNION ALL
			(
				SELECT
				'' As retailer_invoice_id,
				DATE_FORMAT(srp.confirm_date, '%Y-%m-%d') as date,
				srp.amount As amount,
				srp.method,
				srp.receipt_no,
				srp.cheque_no,
				srp.transfer_id
				FROM {PRE}retailer_payment AS srp 
				WHERE
				srp.depot_id = ". $user_id ." AND
				srp.retailer_id = ". $filter_user_id ." AND 
				DATE(srp.confirm_date) BETWEEN '". $start_date ."' AND '". $end_date ."' AND
				srp.status = 'Done' AND
				srp.deleted='0'
			)
			ORDER BY date ASC
			";

        $result = $this->db->query($query);
        //echo $this->db->last_query();
        //die();

		if ($result->num_rows() > 0)
        {
            $res = $result->result();
            if($res)
            {
            	$i = 1;
            	foreach($res as $row)
            	{
            		$retailer_invoice_id = $row->retailer_invoice_id;
            		$date = $row->date;
            		$amount = $row->amount;
            		$method = $row->method;

            		if(!empty($retailer_invoice_id))
            		{
            			$details = anchor('invoice/view/'.$retailer_invoice_id."?view=customer", "Invoice No.".$retailer_invoice_id, array('target' => '_blank'));
            			
            			$payment_data[$i]['date'] = convertYMDtoDMY('-', $date);
            			$payment_data[$i]['details'] = $details;
            			$payment_data[$i]['debit'] = $amount;
            			$due_balance = $due_balance + $amount;
            			$payment_data[$i]['due_balance'] = $due_balance;
            		}
            		else
            		{
            			if(!empty($method))
            			{
            				$details = "Payment By ". $method;
            				
            				if($method == 'Cash')
            				{
            					$details .= " <br/> Receipt No. " . $row->receipt_no;
            				}
            				else if($method == 'Cheque')
            				{
            					$details .= " <br/> Cheque No. " . $row->cheque_no;
            				}
            				else if($method == 'NEFT')
            				{
            					$details .= " <br/> Transfer ID. " . $row->transfer_id;
            				}
            				$payment_data[$i]['date'] = convertYMDtoDMY('-', $date);
            				$payment_data[$i]['details'] = $details;
	            			$payment_data[$i]['credit'] = $amount;
	            			$due_balance = $due_balance - $amount;
	            			$payment_data[$i]['due_balance'] = $due_balance;
            			}
            		}
            		$i++;
            	}
            }
        }
        return $payment_data;

	}
	public function getCustomerToDepotPaymentReport($user_id, $filter_user_id, $start_date, $end_date, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		$payment_data = array();

		$this->db->select('IFNULL(SUM(IFNULL((srip.order_quantity * srip.price),0)) - IFNULL(previousPayment.previousAmount, 0), 0) As due_balance', FALSE);
		$this->db->from($this->retailer_invoice_product_table . ' As srip');

		$this->db->join("( SELECT srp.depot_id, srp.retailer_id, SUM(srp.amount) AS previousAmount FROM {PRE}retailer_payment AS srp 
				WHERE
				srp.depot_id = ". $filter_user_id ." AND
				srp.retailer_id = ". $user_id ." AND 
				srp.confirm_date < '". $start_date ."' AND
				srp.status = 'Done' AND
				srp.deleted='0' 
				GROUP BY srp.depot_id
			) AS previousPayment", "srip.created_by = previousPayment.depot_id AND srip.retailer_id = previousPayment.retailer_id", 'left', FALSE);

		$this->db->where('srip.created_by', $filter_user_id);
		$this->db->where('srip.retailer_id', $user_id);
		$this->db->where('srip.date_confirm <', $start_date);
		$this->db->where('srip.deleted', '0');
		$this->db->group_by('srip.retailer_id');
		$result = $this->db->get();
		//echo $this->db->last_query();
		//die();

		if ($result->num_rows() == 1)
        {
        	$due_balance = $result->row()->due_balance;
        	$payment_data[0]['details'] = 'Op. Due Balance';
        	$payment_data[0]['due_balance'] = $due_balance;
    	}
    	else
    	{
    		$due_balance = 0;
    		$payment_data[0]['details'] = 'Op. Due Balance';
        	$payment_data[0]['due_balance'] = $due_balance;
    	}

    	$query = "
			(
				SELECT
				srip.retailer_invoice_id, 
				DATE_FORMAT(srip.date_confirm, '%Y-%m-%d') as date,
				SUM(IFNULL((srip.order_quantity * srip.price),0)) As amount,
    			'' As method,
    			'' As receipt_no,
    			'' As cheque_no,
    			'' As transfer_id
    			FROM {PRE}retailer_invoice_product AS srip 
				WHERE
				srip.created_by = ". $filter_user_id ." AND 
				srip.retailer_id = ". $user_id ." AND 
				DATE(srip.date_confirm) BETWEEN '". $start_date ."' AND '". $end_date ."'
				AND srip.deleted='0'
				GROUP BY retailer_invoice_id
			)
			UNION ALL
			(
				SELECT
				'' As retailer_invoice_id,
				DATE_FORMAT(srp.confirm_date, '%Y-%m-%d') as date,
				srp.amount As amount,
				srp.method,
				srp.receipt_no,
				srp.cheque_no,
				srp.transfer_id
				FROM {PRE}retailer_payment AS srp 
				WHERE
				srp.depot_id = ". $filter_user_id ." AND
				srp.retailer_id = ". $user_id ." AND 
				DATE(srp.confirm_date) BETWEEN '". $start_date ."' AND '". $end_date ."' AND
				srp.status = 'Done' AND
				srp.deleted='0'
			)
			ORDER BY date ASC
			";

        $result = $this->db->query($query);
        //echo $this->db->last_query();
        //die();

		if ($result->num_rows() > 0)
        {
            $res = $result->result();
            if($res)
            {
            	$i = 1;
            	foreach($res as $row)
            	{
            		$retailer_invoice_id = $row->retailer_invoice_id;
            		$date = $row->date;
            		$amount = $row->amount;
            		$method = $row->method;

            		if(!empty($retailer_invoice_id))
            		{
            			$details = anchor('invoice/view/'.$retailer_invoice_id."?view=customer", "Invoice No.".$retailer_invoice_id, array('target' => '_blank'));
            			
            			$payment_data[$i]['date'] = convertYMDtoDMY('-', $date);
            			$payment_data[$i]['details'] = $details;
            			$payment_data[$i]['debit'] = $amount;
            			$due_balance = $due_balance + $amount;
            			$payment_data[$i]['due_balance'] = $due_balance;
            		}
            		else
            		{
            			if(!empty($method))
            			{
            				$details = "Payment By ". $method;
            				
            				if($method == 'Cash')
            				{
            					$details .= " <br/> Receipt No. " . $row->receipt_no;
            				}
            				else if($method == 'Cheque')
            				{
            					$details .= " <br/> Cheque No. " . $row->cheque_no;
            				}
            				else if($method == 'NEFT')
            				{
            					$details .= " <br/> Transfer ID. " . $row->transfer_id;
            				}
            				$payment_data[$i]['date'] = convertYMDtoDMY('-', $date);
            				$payment_data[$i]['details'] = $details;
	            			$payment_data[$i]['credit'] = $amount;
	            			$due_balance = $due_balance - $amount;
	            			$payment_data[$i]['due_balance'] = $due_balance;
            			}
            		}
            		$i++;
            	}
            }
        }
        return $payment_data;
	}

	public function getDepotToAllCustomerPaymentReport($user_id, $start_date, $end_date, $limit = '', $start = '', $search_text = '', $count = '', $filter_data = array())
	{
		$all_payment_data = array();

		$this->load->model('depot/depot');
		$customer_data = $this->depot->getRelatedCustomer($user_id);
		if($customer_data)
		{
			$k = 0;
			foreach ($customer_data as $customer) 
			{
				$customer_user_id = $customer->user_id;
				$all_payment_data[$k] = $this->getDepotToCustomerPaymentReport($user_id, $customer_user_id, $start_date, $end_date, $limit, $start, $search_text, $count, $filter_data);
				$k++;
			}
			return $all_payment_data;
		}
		else
		{
			return false;
		}
	}
}

?>