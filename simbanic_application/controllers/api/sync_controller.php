<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Sync_Controller extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->module = 'sync';
		$this->load->model('customer/customer');
		$this->load->model('product/product');
		$this->load->model('prescription/prescription');
		$simbanic_json = array();
	}

	public function refresh_post()
	{
		$user_id = $this->input->post('user_id');
		$sync_datetime = $this->input->get_post('sync_datetime');

		if(isset($user_id) && !empty($user_id) && isset($sync_datetime) && !empty($sync_datetime))
		{
			$simbanic_json['sync_datetime'] = CURRENT_DATETIME;

			$filter_customer = array('date_modified >' => $sync_datetime);
			$users = $this->customer->getRelatedCustomers($user_id, $filter_customer);
			if(!empty($users) && $this->ion_auth->is_doctor($user_id))
			{
				$products = $this->product->getAdminProductsStock(1, '', '', '', '', array(), $filter_customer);

				$filter_data = array('sync_datetime >' => $sync_datetime);

				$prescriptions = $this->prescription->getPrescriptions($user_id, '', '', '', '', $filter_data);
				$prescriptions_products = $this->prescription->getPrescriptionsProducts($user_id, '', '', '', '', $filter_data);
				$prescriptions_stores = $this->prescription->getPrescriptionsStores($user_id, '', '', '', '', $filter_data);
				$prescriptions_seen = $this->prescription->getPrescriptionsSeens($user_id, '', '', '', '', $filter_data);

				if(!empty($users) || !empty($products) || !empty($prescriptions) || !empty($prescriptions) || !empty($prescriptions))
				{
					if(!empty($users))
					{
						$simbanic_json['data']['users'] = $users;	
					}

					if(!empty($products))
					{
						$simbanic_json['data']['products'] = $products;	
					}

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
				if(!empty($users))
				{
					$simbanic_json['data']['users'] = $users;
					if($this->ion_auth->is_medical_store($user_id))
					{
						$products = $this->product->getCustomerProductsStock($user_id, '', '', '', '', array(), $filter_customer);
						if(!empty($products))
						{
							$simbanic_json['data']['products'] = $products;
						}
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
		}
		else
		{
			$simbanic_json['status'] = false;
			$simbanic_json['message'] = 'Please Complete All Fields.';
		}
		$this->response($simbanic_json);
	}
}