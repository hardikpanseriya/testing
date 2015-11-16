<?php

require_once(APPPATH . 'controllers/' . BACKEND . '/simba_backend_controller.php');

class Balance_Controller extends Simba_Backend_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('balance/balance');
	}

	public function index() 
	{

	}

	public function test() {
		$this->load->model('sms/sms');
		$this->sms->createPrescription(266);
	}

	public function prescription()
	{
		if($this->ion_auth->is_doctor())
		{
			$this->data['title'] = 'Balance By Prescription';
			$this->data['styles']['href'] = array(
								'components/bootgrid/jquery.bootgrid.min.css',
							);
			$this->data['scripts']['src'] = array(
	    									'components/bootgrid/jquery.bootgrid.min.js',
	    								);

			$this->balance->loadDefs('balance', 'productListViewDefs');
			$this->data['gridDefs'] = $this->balance->productListViewDefs;

			$this->load->render('balance/prescription', $this->data, FALSE);
		}
		else
		{
			redirect('auth/login', 'refresh');
		}
	}

	public function get_prescription_product()
	{
		if ($this->input->get_post('current'))
		{
			$current = (int)$this->input->get_post('current');
		}
		else
		{
			$current = 1;
		}

		$limit = (int)$this->config->item('simba_list_limit');
		$start = ($current * $limit) - ($limit);

		if ($this->input->get_post('searchPhrase'))
		{
			$searchPhrase = $this->input->get_post('searchPhrase');
		}
		else
		{
			$searchPhrase = '';
		}

		if ($this->input->get_post('filter'))
		{
			$filter_data = $this->input->get_post('filter');
			if(!empty($filter_data) && count($filter_data) > 0)
			{
				if(array_key_exists("MONTH-date_confirm", $filter_data))
				{
					if(!empty($filter_data['MONTH-date_confirm']))
					{
						$filter_data['MONTH(date_confirm)'] = "MONTH('".$filter_data['MONTH-date_confirm']."')";	
					}
					unset($filter_data['MONTH-date_confirm']);
				}
			}
		}
		else
		{
			$filter_data = array();
		}

		$rows = $this->balance->getDoctorPrescriptionProducts($this->ion_auth->get_user_id(), $limit, $start, $searchPhrase, '', $filter_data);
		
		if(!isset($rows) && empty($rows))
		{
			$rows = array();
		}
		
		$json['current'] = (int)$current;
		$json['rows'] = $rows;
		$json['rowCount'] = (int)$limit;
		$json['total'] = $this->balance->getDoctorPrescriptionProducts($this->ion_auth->get_user_id(), '', '', $searchPhrase, 'COUNT', $filter_data);
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}

	public function get_prescription_total_unit()
	{
		$json = array();
		if ($this->input->get_post('filter'))
		{
			$filter_data = $this->input->get_post('filter');

			if(!empty($filter_data) && count($filter_data) > 0)
			{
				if(array_key_exists("MONTH-date_confirm", $filter_data))
				{
					if(!empty($filter_data['MONTH-date_confirm']))
					{
						$filter_data['MONTH(date_confirm)'] = "MONTH('".$filter_data['MONTH-date_confirm']."')";	
					}
					unset($filter_data['MONTH-date_confirm']);
				}
			}
		}
		else
		{
			$filter_data['MONTH(date_confirm)'] = "MONTH('".CURRENT_DATE."')";
		}

		$total = $this->balance->getTotalCustomerProductsStockUnit($this->ion_auth->get_user_id(), $filter_data);
		if($total)
		{
			$json['success'] = $total;	
		}
		else
		{
			$json['success'] = '0';
		}
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}
}
?>