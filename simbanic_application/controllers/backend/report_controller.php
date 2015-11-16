<?php

require_once(APPPATH . 'controllers/' . BACKEND . '/simba_backend_controller.php');

class Report_Controller extends Simba_Backend_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('report/report');
		$this->load->model('prescription/prescription');
	}

	public function index()
	{
		if(!$this->ion_auth->is_depot())
		{
			$filter_data = array('MONTH(srip.date_confirm)' => "MONTH('". date("Y-m-d", strtotime("-1 Months")) ."')");
		
			$this->report->saveCustomerUnit();
			
			if($this->ion_auth->is_admin())
			{
				$this->data['title'] = 'Report';
			}
			else
			{
				$this->data['title'] = 'My Balance';
			}

			$this->data['styles']['href'] = array(
									'components/bootgrid/jquery.bootgrid.min.css',
								);
			$this->data['scripts']['src'] = array(
	    									'components/bootgrid/jquery.bootgrid.min.js',
	    								);

			$this->report->loadDefs('report', 'listViewDefs');
	    	$this->data['gridDefs'] = $this->report->listViewDefs;

			$this->load->render('report/index', $this->data, FALSE);
		}
		else
		{
			redirect('/');
		}
	}

	public function get_customer_point()
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

		if($this->input->get_post('date'))
		{
			$date = $this->input->get_post('date');
		}
		else
		{
			$date = CURRENT_DATETIME;
		}

		$rows = $this->report->getCustomerStageReports($this->ion_auth->get_user_id(), $date, $limit, $start, $searchPhrase);
		
		if(!isset($rows) && empty($rows))
		{
			$rows = array();
		}
		
		$json['current'] = (int)$current;
		$json['rows'] = $rows;
		$json['rowCount'] = (int)$limit;
		$json['total'] = $this->report->getCustomerStageReports($this->ion_auth->get_user_id(), $date, '', '', $searchPhrase, 'COUNT');
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}

	public function prescription()
	{
		$this->data['title'] = 'Report By Prescription';
	
		$this->data['styles']['href'] = array(
								'components/bootgrid/jquery.bootgrid.min.css',
							);
		$this->data['scripts']['src'] = array(
    									'components/bootgrid/jquery.bootgrid.min.js',
    								);

		$this->report->loadDefs('report', 'prescriptionListViewDefs');
    	$this->data['gridDefs'] = $this->report->prescriptionListViewDefs;

		$this->load->render('report/prescription/index', $this->data, FALSE);
	}

	public function get_prescription()
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

		$rows = $this->report->getPrescriptionReport($this->ion_auth->get_user_id(), $limit, $start, $searchPhrase, '', $filter_data);
		
		if(!isset($rows) && empty($rows))
		{
			$rows = array();
		}
		
		$json['current'] = (int)$current;
		$json['rows'] = $rows;
		$json['rowCount'] = (int)$limit;
		$json['total'] = $this->report->getPrescriptionReport($this->ion_auth->get_user_id(), '', '', $searchPhrase, 'COUNT', $filter_data);
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}

	public function prescription_invoice()
	{
		$this->data['title'] = 'Report By Prescription Invoice';
	
		$this->data['styles']['href'] = array(
								'components/bootgrid/jquery.bootgrid.min.css',
							);
		$this->data['scripts']['src'] = array(
    									'components/bootgrid/jquery.bootgrid.min.js',
    								);

		$this->report->loadDefs('report', 'prescriptionInvoiceListViewDefs');
    	$this->data['gridDefs'] = $this->report->prescriptionInvoiceListViewDefs;

		$this->load->render('report/prescription/invoice', $this->data, FALSE);

	}

	public function get_prescription_invoice()
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

		$rows = $this->prescription->getInvoicePrescriptions($this->ion_auth->get_user_id(), $limit, $start, $searchPhrase, '', $filter_data);
		
		if(!isset($rows) && empty($rows))
		{
			$rows = array();
		}
		
		$json['current'] = (int)$current;
		$json['rows'] = $rows;
		$json['rowCount'] = (int)$limit;
		$json['total'] = $this->prescription->getInvoicePrescriptions($this->ion_auth->get_user_id(), '', '', $searchPhrase, 'COUNT', $filter_data);
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}

	public function stock()
	{
		$this->data['title'] = 'Report By Stock';
	
		$this->data['styles']['href'] = array(
								'components/bootgrid/jquery.bootgrid.min.css',
								'components/dateRange/css/daterangepicker.css',
							);
		$this->data['scripts']['src'] = array(
								'components/bootgrid/jquery.bootgrid.min.js',
								'components/dateRange/js/moment.min.js',
								'components/dateRange/js/daterangepicker.js',

							);

		$this->report->loadDefs('report', 'stockListViewDefs');
    	$this->data['gridDefs'] = $this->report->stockListViewDefs;

    	if($this->ion_auth->is_admin())
    	{
    		$this->load->model('depot/depot');
    		$depot_data = $this->depot->getDepot($this->ion_auth->get_user_id());

    		if($depot_data)
    		{
    			$this->data['depot_data'] = $depot_data;
    		}
    	}

		$this->load->render('report/stock', $this->data, FALSE);
	}

	public function get_stock()
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
		}
		else
		{
			$filter_data = array();
		}

		$filter_user_id = $this->input->post('filter_user_id');

		if(!empty($filter_data))
		{
			if(isset($filter_data['start_date']) && !empty($filter_data['start_date']) && isset($filter_data['end_date']) && (!empty($filter_data['end_date'])))
			{
				$start_date = $filter_data['start_date'];
				$end_date = $filter_data['end_date'];
				unset($filter_data['start_date']);
				unset($filter_data['end_date']);
				$rows = $this->report->getProductStockReport($this->ion_auth->get_user_id(), $filter_user_id, $start_date, $end_date,  $limit, $start, $searchPhrase, '', $filter_data);
			}
		}
		
		if(!isset($rows) && empty($rows))
		{
			$rows = array();
		}
		
		$json['current'] = (int)$current;
		$json['rows'] = $rows;
		$json['rowCount'] = (int)$limit;

		if(!empty($filter_data) && isset($start_date) && isset($end_date))
		{
			$json['total'] = $this->report->getProductStockReport($this->ion_auth->get_user_id(), $start_date, $end_date, '', '', $searchPhrase, 'COUNT', $filter_data);	
		}
		else
		{
			$json['total'] = 0;
		}
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}



	public function payment()
	{
		$this->data['title'] = 'Report By Payment';
	
		$this->data['styles']['href'] = array(
								'components/bootgrid/jquery.bootgrid.min.css',
								'components/dateRange/css/daterangepicker.css',
							);
		$this->data['scripts']['src'] = array(
								'components/bootgrid/jquery.bootgrid.min.js',
								'components/dateRange/js/moment.min.js',
								'components/dateRange/js/daterangepicker.js',
							);

		$this->load->model('depot/depot');
		if($this->ion_auth->is_admin())
    	{
    		$this->load->model('customer/customer');
    		$depot_data = $this->depot->getDepot($this->ion_auth->get_user_id());
    		if($depot_data)
    		{
    			$this->data['depot_data'] = $depot_data;
    		}
    		$this->data['filter_view'] = array(
				'depot' => 'Depot',
				'customer' => 'Customer'
			);
			$customer_data = $this->customer->getCustomer($this->ion_auth->get_user_id());
    		if($customer_data)
    		{
    			$this->data['customer_data'] = $customer_data;
    		}
    	}
    	else if($this->ion_auth->is_depot())
    	{
    		$customer_data = $this->depot->getRelatedCustomer($this->ion_auth->get_user_id());
    		if($customer_data)
    		{
    			$this->data['customer_data'] = $customer_data;
    		}
    		$this->data['filter_view'] = array(
    				'admin' => 'Admin',
    				'customer' => 'Customer'
    			);
    	}
    	else if($this->ion_auth->is_customer())
    	{
    		$depot_data = $this->depot->getRelatedDepot($this->ion_auth->get_user_id());

    		if($depot_data)
    		{
    			$this->data['depot_data'] = $depot_data;
    		}
    	}

		$this->report->loadDefs('report', 'paymentListViewDefs');
    	$this->data['gridDefs'] = $this->report->paymentListViewDefs;

		$this->load->render('report/payment', $this->data, FALSE);
	}

	public function get_payment()
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
		}
		else
		{
			$filter_data = array();
		}

		$filter_view = $this->input->post('filter_view');
		$filter_user_id = $this->input->post('filter_user_id');
		$filter_customer_id = $this->input->post('filter_customer_id');
		$user_id = $this->ion_auth->get_user_id();

		if($filter_view == 'admin')
		{
			$filter_user_id = 0;
		}
		elseif(!empty($filter_user_id) && !empty($filter_customer_id) && $filter_view == 'customer')
		{
			$user_id = $filter_user_id;
			$filter_user_id = $filter_customer_id;
		}


		if(!empty($filter_data))
		{
			if(isset($filter_data['start_date']) && !empty($filter_data['start_date']) && isset($filter_data['end_date']) && (!empty($filter_data['end_date'])))
			{
				$start_date = $filter_data['start_date'];
				$end_date = $filter_data['end_date'];
				unset($filter_data['start_date']);
				unset($filter_data['end_date']);
				if(!empty($filter_user_id) && !empty($filter_customer_id) && $filter_view == 'customer')
				{
					$rows = $this->report->getDepotToCustomerPaymentReport($user_id, $filter_user_id, $start_date, $end_date,  $limit, $start, $searchPhrase, '', $filter_data);
				}
				else
				{
					$rows = $this->report->getPaymentReport($user_id, $filter_user_id, $start_date, $end_date,  $limit, $start, $searchPhrase, '', $filter_data);
				}	
				
			}
		}
		
		if(!isset($rows) && empty($rows))
		{
			$rows = array();
		}
		
		$json['current'] = (int)$current;
		$json['rows'] = $rows;
		$json['rowCount'] = (int)$limit;

		if(!empty($filter_data) && isset($start_date) && isset($end_date))
		{
			$json['total'] = $this->report->getPaymentReport($user_id, $filter_user_id, $start_date, $end_date, '', '', $searchPhrase, 'COUNT', $filter_data);
		}
		else
		{
			$json['total'] = 0;
		}
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}

	public function payment_area()
	{
		$this->data['title'] = 'Report By Payment Area';
	
		$this->data['styles']['href'] = array(
								'components/bootgrid/jquery.bootgrid.min.css',
								'components/dateRange/css/daterangepicker.css',
							);
		$this->data['scripts']['src'] = array(
								'components/bootgrid/jquery.bootgrid.min.js',
								'components/dateRange/js/moment.min.js',
								'components/dateRange/js/daterangepicker.js',
							);

		$this->report->loadDefs('report', 'paymentListViewDefs');
    	$this->data['gridDefs'] = $this->report->paymentListViewDefs;

		$this->load->render('report/payment/area', $this->data, FALSE);
	}

	public function get_payment_area()
	{
		$start_date = $this->input->get_post('start_date');
		$end_date = $this->input->get_post('end_date');
		
		$this->data['payment_info'] = $this->report->getDepotToAllCustomerPaymentReport($this->ion_auth->get_user_id(), $start_date, $end_date);
		if ($this->input->is_ajax_request()) 
		{
			$this->load->view( BACKEND . '/report/payment/generate', $this->data);
		}
		else
		{
			//load mPDF library
			$this->load->library('m_pdf');
			$pdf = $this->m_pdf->load();
			$mpdf = new mPDF('c', 'A4', '', '', 20, 15, 38, 25, 10, 10);
			$mpdf->SetProtection(array('print'));
			$mpdf->SetTitle("Walart Pharmaceutical. - Payment Report");
			$mpdf->SetAuthor("Walart Pharmaceutical.");
			$mpdf->SetDisplayMode('fullpage');

			$header = $this->load->view( BACKEND . '/report/payment/generate/header', $this->data, true);
			$footer = $this->load->view( BACKEND . '/report/payment/generate/footer', $this->data, true);
			$html = $this->load->view( BACKEND . '/report/payment/generate', $this->data, true);

			$mpdf->SetHTMLHeader($header);
			$mpdf->SetHTMLFooter($footer);
			$mpdf->WriteHTML($html);

			$mpdf->Output($pdfFilePath, "D");
		}
	}

	public function generate()
	{
		
		
	}
}
?>