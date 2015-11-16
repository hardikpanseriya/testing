<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Prescription_Controller extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('prescription/prescription');
		$this->load->model('sms/sms');
		$simbanic_json = array();
	}

	// store prescription
	public function prescription_post()
	{
		$prescriptions = trim($_POST['prescriptions']);
		$user_id = $this->input->post('user_id');

		if(!empty($user_id) && !empty($prescriptions))
		{
			$prescriptions_array = json_decode($prescriptions, true);
			if(count($prescriptions_array) > 0)
			{
				$prescriptions_array = array_map("unserialize", array_unique(array_map("serialize", $prescriptions_array)));
				$return_prescription = array();
				for($i = 0; $i<count($prescriptions_array); $i++)
				{
					if($this->prescription->checkingPrescriptionCode($user_id, $prescriptions_array[$i]['code']))
					{
						if(isset($prescriptions_array[$i]['prescription_id']) && !empty($prescriptions_array[$i]['prescription_id']))
						{
							$prescription_id = $prescriptions_array[$i]['prescription_id'];
							$prescriptions_array[$i]['date_modified'] = CURRENT_DATETIME;
							$prescriptions_array[$i]['sync_datetime'] = CURRENT_DATETIME;
							unset($prescriptions_array[$i]['local_id']);
							unset($prescriptions_array[$i]['prescription_id']);
							$this->query_model->save('prescription', $prescriptions_array[$i], $prescription_id);
						}
					}
					else
					{
						$return_prescription[$i] = array(
							'id' => $prescriptions_array[$i]['local_id']
						);
						$prescriptions_array[$i]['sync_datetime'] = CURRENT_DATETIME;
						$prescriptions_array[$i]['date_created'] = CURRENT_DATETIME;
						$prescriptions_array[$i]['date_modified'] = CURRENT_DATETIME;
						unset($prescriptions_array[$i]['local_id']);
						unset($prescriptions_array[$i]['prescription_id']);
						$prescription_id = $this->query_model->save('prescription', $prescriptions_array[$i]);
						$return_prescription[$i]['prescription_id'] = $prescription_id;	
					}
				}
				if(!empty($return_prescription))
				{
					$simbanic_json['data'] = $return_prescription;
				}
				else
				{
					$simbanic_json['data'] = array();	
				}
			}
			else
			{
				$simbanic_json['data'] = array();
			}
			$simbanic_json['sync_datetime'] = CURRENT_DATETIME;
			$simbanic_json['status'] = true;
			$simbanic_json['message'] = NULL;
		}
		else
		{
			$simbanic_json['status'] = false;
			$simbanic_json['message'] = 'Please Complete All Fields.';
		}
		$this->response($simbanic_json);
	}

	// Store prescription_product & prescription_medical_store
	public function prescription_product_store_post()
	{
		$prescription_products = trim($_POST['prescription_products']);
		$prescription_stores = trim($_POST['prescription_stores']);
		$user_id = $this->input->post('user_id');

		if(!empty($user_id) && (!empty($prescription_products) || !empty($prescription_stores)))
		{
			$prescription_products_array = json_decode($prescription_products, true);
			$prescription_stores_array = json_decode($prescription_stores, true);
			if(count($prescription_products_array) > 0)
			{
				$prescription_products_array = array_map("unserialize", array_unique(array_map("serialize", $prescription_products_array)));
				$return_prescription_products_array = array();
				$m = 0;

				for($i = 0; $i<count($prescription_products_array); $i++)
				{
					if(isset($prescription_products_array[$i]['prescription_product_id']) && !empty($prescription_products_array[$i]['prescription_product_id']))
					{
						$prescription_product_id = $prescription_products_array[$i]['prescription_product_id'];
						$prescription_products_array[$i]['sync_datetime'] = CURRENT_DATETIME;
						$prescription_products_array[$i]['date_modified'] = CURRENT_DATETIME;
						unset($prescription_products_array[$i]['local_id']);
						unset($prescription_products_array[$i]['prescription_product_id']);
						$this->query_model->save('prescription_product', $prescription_products_array[$i], $prescription_product_id);
					}
					else
					{
						$return_prescription_products_array[$m] = array(
							'id' => $prescription_products_array[$i]['local_id']
						);
						$prescription_products_array[$i]['sync_datetime'] = CURRENT_DATETIME;
						$prescription_products_array[$i]['date_created'] = CURRENT_DATETIME;
						$prescription_products_array[$i]['date_modified'] = CURRENT_DATETIME;
						unset($prescription_products_array[$i]['local_id']);
						unset($prescription_products_array[$i]['prescription_product_id']);
						$prescription_product_id = $this->query_model->save('prescription_product', $prescription_products_array[$i]);
						$return_prescription_products_array[$m]['prescription_product_id'] = $prescription_product_id;
						$m++;
					}
				}
				if(!empty($return_prescription_products_array))
				{
					$simbanic_json['data']['prescription_products'] = $return_prescription_products_array;
				}
				else
				{
					$simbanic_json['data']['prescription_products'] = array();
				}
			}
			
			if(count($prescription_stores_array) > 0)
			{
				$prescription_stores_array = array_map("unserialize", array_unique(array_map("serialize", $prescription_stores_array)));
				$return_prescription_stores_array = array();
				$n = 0;
				for($i = 0; $i<count($prescription_stores_array); $i++)
				{
					if(isset($prescription_stores_array[$i]['prescription_store_id']) && !empty($prescription_stores_array[$i]['prescription_store_id']))
					{
						$prescription_store_id = $prescription_stores_array[$i]['prescription_store_id'];
						$prescription_stores_array[$i]['sync_datetime'] = CURRENT_DATETIME;
						$prescription_stores_array[$i]['date_modified'] = CURRENT_DATETIME;
						unset($prescription_stores_array[$i]['local_id']);
						unset($prescription_stores_array[$i]['prescription_store_id']);
						$this->query_model->save('prescription_medical_store', $prescription_stores_array[$i], $prescription_store_id);
					}
					else
					{
						if(isset($prescription_stores_array[$i]['prescription_id']) && !empty($prescription_stores_array[$i]['prescription_id']))
						{
							$check = $this->prescription->checkPrescriptionStoreExist($prescription_stores_array[$i]['prescription_id'], $prescription_stores_array[$i]['user_id']);

							if($check)
							{
								$prescription_store_id = $prescription_stores_array[$i]['prescription_store_id'];
								$prescription_stores_array[$i]['sync_datetime'] = CURRENT_DATETIME;
								$prescription_stores_array[$i]['date_modified'] = CURRENT_DATETIME;
								unset($prescription_stores_array[$i]['local_id']);
								unset($prescription_stores_array[$i]['prescription_store_id']);
								$update_where = array(
									'prescription_id' => $prescription_stores_array[$i]['prescription_id'],
									'user_id' => $prescription_stores_array[$i]['user_id'],
								);
								$this->query_model->update_Data('prescription_medical_store', $prescription_stores_array[$i], $update_where);
							}
							else
							{
								$return_prescription_stores_array[$n] = array(
									'id' => $prescription_stores_array[$i]['local_id']
								);
								unset($prescription_stores_array[$i]['local_id']);
								unset($prescription_stores_array[$i]['prescription_store_id']);
								$prescription_stores_array[$i]['sync_datetime'] = CURRENT_DATETIME;
								$prescription_stores_array[$i]['date_created'] = CURRENT_DATETIME;
								$prescription_stores_array[$i]['date_modified'] = CURRENT_DATETIME;
								$prescription_store_id = $this->query_model->save('prescription_medical_store', $prescription_stores_array[$i]);
								$return_prescription_stores_array[$n]['prescription_store_id'] = $prescription_store_id;
								$n++;
							}
						}
						else
						{
							$return_prescription_stores_array[$n] = array(
								'id' => $prescription_stores_array[$i]['local_id']
							);
							unset($prescription_stores_array[$i]['local_id']);
							unset($prescription_stores_array[$i]['prescription_store_id']);
							$prescription_stores_array[$i]['sync_datetime'] = CURRENT_DATETIME;
							$prescription_stores_array[$i]['date_created'] = CURRENT_DATETIME;
							$prescription_stores_array[$i]['date_modified'] = CURRENT_DATETIME;
							$prescription_store_id = $this->query_model->save('prescription_medical_store', $prescription_stores_array[$i]);
							$return_prescription_stores_array[$n]['prescription_store_id'] = $prescription_store_id;
							$n++;
						}
					}
				}
				
				$this->sms->createPrescription($user_id);

				if(!empty($return_prescription_stores_array))
				{
					$simbanic_json['data']['prescription_stores'] = $return_prescription_stores_array;
				}
				else
				{
					$simbanic_json['data']['prescription_stores'] = array();
				}
			}
			
			$simbanic_json['sync_datetime'] = CURRENT_DATETIME;
			$simbanic_json['status'] = true;
			$simbanic_json['message'] = NULL;
		}
		else
		{
			$simbanic_json['status'] = false;
			$simbanic_json['message'] = 'Please Complete All Fields.';
		}
		$this->response($simbanic_json);
	}

	public function testing_get() {
		$this->prescription_sms(274);
	}

	public function code_post()
	{
		$user_id = $this->input->post('user_id');
		$code = $this->input->post('code');

		if(!empty($user_id) && !empty($code))
		{
			$check_invoice_code = $this->prescription->checkPrescriptionInvoiceCode($user_id, $code);
			if($check_invoice_code)
			{
				$check_code = $this->prescription->checkPrescriptionCode($user_id, $code);
				if($check_code)
				{
					$prescription_id = $check_code;
					$products = $this->prescription->getPrescriptionProducts($prescription_id);
					$prescription_detail = $this->prescription->getPrescriptionDetail($prescription_id);
					$simbanic_json['data'] = $products;
					$simbanic_json['prescription_detail'] = $prescription_detail;
					$simbanic_json['status'] = true;
					$simbanic_json['message'] = NULL;
				}
				else
				{
					$simbanic_json['status'] = false;
					$simbanic_json['message'] = 'Record Not Found.';
				}
			}
			else
			{
				$simbanic_json['status'] = false;
				$simbanic_json['message'] = 'Already given.';
			}
		}
		else
		{
			$simbanic_json['status'] = false;
			$simbanic_json['message'] = 'Please Complete All Fields.';
		}
		$this->response($simbanic_json);
	}

	// Store Prescription Invoice Product
	public function prescription_invoice_products_post()
	{
		$simbanic_json = array();
		$prescriptions = trim($_POST['prescriptions']);
		$prescription_id = $this->input->post('prescription_id');
		$user_id = $this->input->post('user_id');
		
		if(!empty($prescriptions) && !empty($prescription_id) && !empty($user_id))
		{
			$prescriptions_array = json_decode($prescriptions, true);
			if(count($prescriptions_array) > 0)
			{
				$this->module = 'product';
				$this->load->model('product/product');
				$invoice_product = array();
				$prescriptions_array = array_map("unserialize", array_unique(array_map("serialize", $prescriptions_array)));
				
				for($i = 0; $i<count($prescriptions_array); $i++)
				{
					$invoice_product[$i]['created_by'] = $user_id;
					$invoice_product[$i]['retailer_id'] = $prescriptions_array[$i]['retailer_id'];
					$invoice_product[$i]['prescription_id'] = $prescriptions_array[$i]['prescription_id'];

					$invoice_product[$i]['product_id'] = $prescriptions_array[$i]['product_id'];
					$invoice_product[$i]['name'] = $prescriptions_array[$i]['name'];
					$invoice_product[$i]['packing_size'] = $prescriptions_array[$i]['packing_size'];
					$invoice_product[$i]['unit'] = $prescriptions_array[$i]['unit'];
					$invoice_product[$i]['price'] = $prescriptions_array[$i]['price'];
					$invoice_product[$i]['mrp'] = $prescriptions_array[$i]['mrp'];
					$simbanic_product_name = $prescriptions_array[$i]['name'] . " " . $prescriptions_array[$i]['packing_size'] . " " . $prescriptions_array[$i]['unit'];

					$rx_qty = $prescriptions_array[$i]['retailer_quantity'];
					$given_qty = $prescriptions_array[$i]['quantity'];

					$invoice_product[$i]['retailer_quantity'] = $prescriptions_array[$i]['retailer_quantity'];
					$invoice_product[$i]['quantity'] = $prescriptions_array[$i]['quantity'];
					$invoice_product[$i]['date_confirm'] = CURRENT_DATETIME;
					$invoice_product[$i]['sync_datetime'] = CURRENT_DATETIME;
					$invoice_product[$i]['date_created'] = CURRENT_DATETIME;
					$invoice_product[$i]['date_modified'] = CURRENT_DATETIME;

					if(!empty($prescriptions_array[$i]['quantity']) && $prescriptions_array[$i]['quantity'] != '0')
					{
						$check = $this->product->checkCustomerProductStockQty($user_id, $prescriptions_array[$i]['product_id'], $prescriptions_array[$i]['quantity']);
						
						if(!$check)
						{
							$error[] = $simbanic_product_name;
						}
					}
					
					if($given_qty >= $rx_qty)
					{
						if(!isset($send_sms))
						{
							$send_sms = false;
						}
					}
					else
					{
						$send_sms = true;
					}
				}

				if(isset($error) && !empty($error))
				{
					$implode_error = implode(", ", array_unique($error));
					$simbanic_json['message'] = "do not have sufficient quantity. ". $implode_error;
				}

				if(!$simbanic_json && !empty($invoice_product))
				{
					$update_array = array(
										'completed_by' => $user_id,
										'date_confirm' => CURRENT_DATETIME,
										'sync_datetime' => CURRENT_DATETIME
									);
					$update_where = array('prescription_id' => $prescription_id);
					$this->query_model->updateData('prescription', $prescription_id, $update_array);
					$this->query_model->update_Data('prescription_product', $update_array, $update_where);
					$this->query_model->update_Data('prescription_medical_store', $update_array, $update_where);

					if($send_sms)
					{
						// prescription changed
						$this->sms->prescriptionChanged($prescription_id);
					}
					$prescription_invoice_id = $this->query_model->save_multiple('prescription_invoice_product', $invoice_product);
					$simbanic_json['status'] = true;
					$simbanic_json['message'] = 'Saved Successfully.';
					$simbanic_json['data'] = NULL;
				}
				else
				{
					$simbanic_json['status'] = false;
					$simbanic_json['message'] = $simbanic_json['message'];
				}
			}
			else
			{
				$simbanic_json['status'] = false;
				$simbanic_json['message'] = "Record Not Found.";
			}
		}
		else
		{
			$simbanic_json['status'] = false;
			$simbanic_json['message'] = 'Please Complete All Fields.';
		}
		$this->response($simbanic_json);
	}

	// Get All Prescriptions
	public function get_prescriptions_get()
	{
		$sync_datetime = $this->input->get_post('sync_datetime');
		$user_id = $this->input->get_post('user_id');

		if(isset($user_id) && !empty($user_id) && isset($sync_datetime) && !empty($sync_datetime))
		{
			$filter_data = array('sync_datetime >', $sync_datetime);
			$prescriptions = $this->prescription->getPrescriptions($user_id, '', '', '', '', $filter_data);
			$prescriptions_products = $this->prescription->getPrescriptionsProducts($user_id);
			$prescriptions_stores = $this->prescription->getPrescriptionsStores($user_id);
			$prescriptions_seen = $this->prescription->getPrescriptionsSeens($user_id);

			if(!empty($prescriptions) || !empty($prescriptions) || !empty($prescriptions))
			{
				if(!empty($prescriptions))
				{
					$simbanic_json['data']['prescriptions'] = $prescriptions;	
				}

				if(!empty($prescriptions_products))
				{
					$simbanic_json['data']['prescriptions_products'] = $prescriptions_products;	
				}

				if(!empty($prescriptions_stores))
				{
					$simbanic_json['data']['prescriptions_stores'] = $prescriptions_stores;	
				}

				if(!empty($prescriptions_seen))
				{
					$simbanic_json['data']['prescriptions_seen'] = $prescriptions_seen;	
				}

				$simbanic_json['status'] = true;
				$simbanic_json['message'] = NULL;
			}
			else
			{
				$simbanic_json['status'] = false;
				$simbanic_json['message'] = 'Record Not Found.';
			}
		}
		else
		{
			$simbanic_json['status'] = false;
			$simbanic_json['message'] = 'Please Complete All Fields.';
		}
		$this->response($simbanic_json);
	}

	// get All Prescription Invoice
	public function get_prescription_invoices_post()
	{
		if(isset($_POST['user_id']) && !empty($_POST['user_id']))
		{
			$user_id = trim($_POST['user_id']);
			$prescription_list = $this->prescription->getInvoicePrescriptions($user_id);
			if($prescription_list)
			{
				$simbanic_json['data'] = $prescription_list;
				$simbanic_json['status'] = true;
				$simbanic_json['message'] = NULL;
			}
			else
			{
				$simbanic_json['status'] = false;
				$simbanic_json['message'] = 'Record Not Found.';
			}
		}
		else
		{
			$simbanic_json['status'] = false;
			$simbanic_json['message'] = 'Please Complete All Fields.';
		}
		$this->response($simbanic_json);
	}

	
	public function get_prescription_invoice_products_post()
	{
		if(isset($_POST['user_id']) && !empty($_POST['user_id']) && isset($_POST['prescription_id']) && !empty($_POST['prescription_id']))
		{
			$user_id = trim($_POST['user_id']);
			$prescription_id = trim($_POST['prescription_id']);

			$check_prescription_producs = $this->prescription->getInvoicePrescriptionProducts($prescription_id);
			$prescription_detail = $this->prescription->getPrescriptionDetail($prescription_id);
				
			if($check_prescription_producs)
			{
				$simbanic_json['data'] = $check_prescription_producs;
				$simbanic_json['prescription_detail'] = $prescription_detail;
				$simbanic_json['status'] = true;
				$simbanic_json['message'] = NULL;
			}
			else
			{
				$simbanic_json['status'] = false;
				$simbanic_json['message'] = 'Record Not Found.';
			}
		}
		else
		{
			$simbanic_json['status'] = false;
			$simbanic_json['message'] = 'Please Complete All Fields.';
		}
		
		$this->response($simbanic_json);
	}

	public function otc_prescriptions_post()
	{
		$simbanic_json = array();
		$prescriptions = trim($_POST['prescriptions']);
		$user_id = $this->input->post('user_id');
		$customer_name = $this->input->post('customer_name');
		
		if(!empty($prescriptions) && !empty($user_id))
		{
			$prescriptions_array = json_decode($prescriptions, true);
			if(count($prescriptions_array) > 0)
			{
				$this->module = 'product';
				$this->load->model('product/product');
				$invoice_product = array();
				$prescriptions_array = array_map("unserialize", array_unique(array_map("serialize", $prescriptions_array)));
				
				for($i = 0; $i<count($prescriptions_array); $i++)
				{
					$invoice_product[$i]['created_by'] = $user_id;

					$invoice_product[$i]['product_id'] = $prescriptions_array[$i]['product_id'];
					$invoice_product[$i]['name'] = $prescriptions_array[$i]['name'];
					$invoice_product[$i]['packing_size'] = $prescriptions_array[$i]['packing_size'];
					$invoice_product[$i]['unit'] = $prescriptions_array[$i]['unit'];
					$invoice_product[$i]['price'] = $prescriptions_array[$i]['price'];
					$invoice_product[$i]['mrp'] = $prescriptions_array[$i]['mrp'];

					$invoice_product[$i]['quantity'] = $prescriptions_array[$i]['quantity'];

					$simbanic_product_name = $prescriptions_array[$i]['name'] . " " . $prescriptions_array[$i]['packing_size'] . " " . $prescriptions_array[$i]['unit'];

					if(!empty($prescriptions_array[$i]['quantity']) && $prescriptions_array[$i]['quantity'] != '0')
					{
						$check = $this->product->checkCustomerProductStockQty($user_id, $prescriptions_array[$i]['product_id'], $prescriptions_array[$i]['quantity']);
						
						if(!$check)
						{
							$error[] = $simbanic_product_name;
						}
					}

					$invoice_product[$i]['date_confirm'] = CURRENT_DATETIME;
					$invoice_product[$i]['date_created'] = CURRENT_DATETIME;
					$invoice_product[$i]['date_modified'] = CURRENT_DATETIME;
				}

				if(isset($error) && !empty($error))
				{
					$implode_error = implode(", ", array_unique($error));
					$simbanic_json['message'] = "do not have sufficient quantity. ". $implode_error;
				}

				if(!$simbanic_json && !empty($invoice_product))
				{
					$otc_prescription = array(
						'created_by' => $user_id,
						'customer_name' => $customer_name,
						'date_confirm' => CURRENT_DATETIME,
						'date_created' => CURRENT_DATETIME,
						'date_modified' => CURRENT_DATETIME,
					);
					$otc_prescription_id = $this->query_model->save('otc_prescription', $otc_prescription);

					for($j = 0; $j < count($invoice_product); $j++)
					{
						$invoice_product[$j]['otc_prescription_id'] = $otc_prescription_id;
					}
					
					$this->query_model->save_multiple('otc_prescription_product', $invoice_product);
					$simbanic_json['status'] = true;
					$simbanic_json['message'] = 'Saved Successfully.';
					$simbanic_json['data'] = NULL;
				}
				else
				{
					$simbanic_json['status'] = false;
					$simbanic_json['message'] = $simbanic_json['message'];
				}
			}
			else
			{
				$simbanic_json['status'] = false;
				$simbanic_json['message'] = "Record Not Found.";
			}
		}
		else
		{
			$simbanic_json['status'] = false;
			$simbanic_json['message'] = 'Please Complete All Fields.';
		}
		$this->response($simbanic_json);
	}

	public function get_otc_prescriptions_get()
	{
		$user_id = $this->input->get_post('user_id');

		if(!empty($user_id))
		{
			$otc_prescriptions = $this->prescription->getOTCPrescriptions($user_id);
				
			if($otc_prescriptions)
			{
				$simbanic_json['data'] = $otc_prescriptions;
				$simbanic_json['status'] = true;
				$simbanic_json['message'] = NULL;
			}
			else
			{
				$simbanic_json['status'] = false;
				$simbanic_json['message'] = 'Record Not Found.';
			}
		}
		else
		{
			$simbanic_json['status'] = false;
			$simbanic_json['message'] = 'Please Complete All Fields.';
		}
		
		$this->response($simbanic_json);
	}

	public function get_otc_prescription_products_get()
	{
		$user_id = $this->input->get_post('user_id');
		$otc_prescription_id = $this->input->get_post('otc_prescription_id');

		if(!empty($user_id) && !empty($otc_prescription_id))
		{
			$otc_products = $this->prescription->getOTCPrescriptionProducts($otc_prescription_id);
				
			if($otc_products)
			{
				$simbanic_json['data'] = $otc_products;
				$simbanic_json['status'] = true;
				$simbanic_json['message'] = NULL;
			}
			else
			{
				$simbanic_json['status'] = false;
				$simbanic_json['message'] = 'Record Not Found.';
			}
		}
		else
		{
			$simbanic_json['status'] = false;
			$simbanic_json['message'] = 'Please Complete All Fields.';
		}
		
		$this->response($simbanic_json);
	}
}