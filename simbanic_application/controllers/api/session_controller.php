<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Session_Controller extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->module = 'customer';
		$this->load->model('customer/customer');
		$simbanic_json = array();
	}

	public function login_post()
	{
		$identity = $this->input->post('identity');
		$password = $this->input->post('password');
		if(isset($identity) && !empty($identity) && isset($password) && !empty($password))
		{
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($identity, $password, $remember))
			{
				$user_id = $this->ion_auth->get_user_id();
				if($this->ion_auth->is_customer())
				{
					$user_info = $this->ion_auth->getSimbanicUser($user_id);

					$simbanic_json['data'] = $user_info;
					$simbanic_json['status'] = true;
					$simbanic_json['message'] = NULL;
				}
				else
				{
					$simbanic_json['status'] = false;
					$simbanic_json['message'] = 'Incorrect Login';
				}
			}
			else
			{
				$simbanic_json['status'] = false;
				$simbanic_json['message'] = 'Incorrect Login';
			}
		}
		else
		{
			$simbanic_json['status'] = false;
			$simbanic_json['message'] = 'Please Complete All Fields.';
		}
		$simbanic_json['sync_datetime'] = CURRENT_DATETIME;
		$this->response($simbanic_json);
	}

	public function get_users_products_post() {

		$user_id = $this->input->post('user_id');
		if(isset($user_id) && !empty($user_id))
		{
			$this->load->model('product/product');
			$users = $this->customer->getRelatedCustomers($user_id);
			if($this->ion_auth->is_doctor($user_id))
			{
				$products = $this->product->getAdminProductsStock(1);
			}
			elseif($this->ion_auth->is_medical_store($user_id))
			{
				$products = $this->product->getCustomerProductsStock($user_id);
				if($products)
				{

				}
				else
				{
					$products = array();
				}
			}
			else
			{
				$products = NULL;
			}
			
			$simbanic_json['data']['users'] = $users;
			$simbanic_json['data']['products'] = $products;
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
}