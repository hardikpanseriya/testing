<?php

require_once(APPPATH . 'controllers/' . BACKEND . '/simba_backend_controller.php');

class Payment_Controller extends Simba_Backend_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('payment/payment');
	}

	public function index()
	{
		if($this->ion_auth->is_admin())
		{
			$this->data['title'] = 'Depot Payment';
		}
		elseif($this->ion_auth->is_depot())
		{
			$this->data['title'] = 'Company Payment';
		}
		else
		{
			$this->data['title'] = 'Payment List';
		}

		
		$this->data['styles']['href'] = array(
								'components/bootgrid/jquery.bootgrid.min.css',
							);
		$this->data['scripts']['src'] = array(
    									'components/bootgrid/jquery.bootgrid.min.js',
    								);

		$this->payment->loadDefs('payment', 'listViewDefs');
    	$this->data['gridDefs'] = $this->payment->listViewDefs;

		$this->load->render('payment/index', $this->data, FALSE);
	}

	public function edit($id)
	{
		$this->data['styles']['href'] = array(
								'components/jquery-ui/jquery-ui.css',
							);
		$this->data['scripts']['src'] = array(
    									'components/jquery-ui/jquery-ui.js',
    								);

		$this->load->helper('input');

		if(!empty($id))
		{
			$this->record = $id;
			$this->data['title'] = 'Edit Payment';
		}
		else
		{
			$this->data['title'] = 'Create Payment';	
		}

		if($this->uri->segment(2) == 'edit')
		{
			$depot_payment_info = $this->query_model->get('depot_payment', $id);
			foreach($depot_payment_info as $key => $value)
			{
				if($key == 'date' || $key == 'confirm_date')
				{
					$this->data[$key] = convertYMDtoDMY('-', $value);
				}
				else
				{
					$this->data[$key] = $value;
				}
			}
		}
		if($this->uri->segment('2') == 'create')
		{
			$this->data['depot_id'] = $id;	
		}
		if($this->uri->segment('2') == 'edit')
		{
			$this->data['record'] = $id;	
		}
		
		$this->load->render('payment/edit', $this->data, FALSE);
	}

	public function view($depot_id)
	{
		$this->data['title'] = 'View Payment Detail';

		$this->data['styles']['href'] = array(
								'components/bootgrid/jquery.bootgrid.min.css',
							);
		$this->data['scripts']['src'] = array(
    									'components/bootgrid/jquery.bootgrid.min.js',
    									'js/payment.js',
    									'js/simbanic_onclick.js',
    								);

		$this->payment->loadDefs('payment', 'historyListViewDefs');
		$this->data['gridDefs'] = $this->payment->historyListViewDefs;

		$depot_info = $this->query_model->get('user', $depot_id);
		$this->data['depot_info'] = $depot_info;
		$this->data['depot_id'] = $depot_id;
		
		$this->load->render('payment/view', $this->data, FALSE);
	}

	public function save()
	{
		if($this->validation())
        {
        	$json = array();
			if(!empty($this->input->post('amount')) && !empty($this->input->post('method')) && !empty($this->input->post('status')) && !empty($this->input->post('depot_id')))
			{
				if(is_numeric($this->input->post('amount')))
				{
					$payment_data = array(
						'created_by' => $this->ion_auth->get_user_id(),
						'depot_id' => $this->input->post('depot_id'),
						'amount' => $this->input->post('amount'),
						'method' => $this->input->post('method'),
						'cash_type' => $this->input->post('cash_type'),
						'receipt_no' => $this->input->post('receipt_no'),
						'cheque_no' => $this->input->post('cheque_no'),
						'bank_name' => $this->input->post('bank_name'),
						'bank_branch' => $this->input->post('bank_branch'),
						'transfer_id' => $this->input->post('transfer_id'),
						'date' => convertDMYtoYMD('-', $this->input->post('date')),
						'remark' => $this->input->post('remark'),
						'status' => $this->input->post('status'),
						'date_created' => CURRENT_DATETIME,
						'date_modified' => CURRENT_DATETIME,
					);
					if($this->input->post('confirm_date') != '' && $this->input->post('confirm_date') != '0000-00-00')
					{
						$payment_data['confirm_date'] = convertDMYtoYMD('-', $this->input->post('confirm_date'));
					}
					
					if($this->ion_auth->is_admin())
					{
						$payment_data['created_at'] = 'admin';
					}
					else if($this->ion_auth->is_depot())
					{
						$payment_data['created_at'] = 'depot';
					}

					if($this->input->post('status') == 'Pending')
					{
						$payment_data['date_pending'] = CURRENT_DATETIME;
					}
					else if($this->input->post('status') == 'Done')
					{
						$payment_data['date_done'] = CURRENT_DATETIME;
					}

					if(!empty($this->input->post('record')))
					{
						$this->query_model->save('depot_payment', $payment_data, $this->input->post('record'));
					}
					else
					{
						$this->query_model->save('depot_payment', $payment_data);	
					}
					redirect('payment/view/'.$this->input->post('depot_id'));
					$json['success'] = 'Added Successfully.';
				}
				else
				{
					$json['error'] = 'Please enter a valid amount';
				}
			}
			else
			{
				$json['error'] = 'Please complete all fields';
			}

			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode($json));
        }
        else
        {
        	$this->data = $_POST;
			$this->edit($this->input->post('depot_id'));
        }
	}

	public function validation()
	{
		$this->load->library('form_validation');
		$method = $this->input->post('method');
		$this->form_validation->set_rules('method', 'Method', 'trim|required|xss_clean');
		$this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean');
		$this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
		$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
		if($method == 'Cash')
		{
			$this->form_validation->set_rules('cash_type', 'Cash Type', 'trim|required|xss_clean');
			$this->form_validation->set_rules('receipt_no', 'Receipt No.', 'trim|required|xss_clean');
		}
		if($method == 'Cheque')
		{
			$this->form_validation->set_rules('cheque_no', 'Cheque No', 'trim|required|xss_clean');
			$this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('bank_branch', 'Bank Branch', 'trim|required|xss_clean');
		}
		if($method == 'NEFT')
		{
			$this->form_validation->set_rules('transfer_id', 'Transfer ID', 'trim|required|xss_clean');
		}

		if ($this->form_validation->run() == FALSE)
        {
            return $this->form_validation->run();
        }
        else
        {
            return true;
        }
	}

	public function generate($payment_id)
	{
		$this->data['payment_id'] = $payment_id;
		
		$payment_info = $this->payment->getPayment($payment_id);

		if($payment_info)
		{
			if($this->ion_auth->is_customer() || $this->input->get_post('view') == 'customer')
			{
				$user_id = $payment_info->retailer_id;
			}
			else
			{
				$user_id = $payment_info->depot_id;
			}

			$this->data['payment_info'] = $payment_info;
			$user_info = $this->ion_auth->getSimbanicUser($user_id);
			$this->data['user_info'] = $user_info;
			
			$invoice_month = date("M", strtotime($payment_info->confirm_date));
			$pdfFilePath = $invoice_month . '_' .$user_info->full_name . '_' . $user_info->customer_id . '_' . $payment_info->id . ".pdf";
		 
			//load mPDF library
			$this->load->library('m_pdf');
			$pdf = $this->m_pdf->load();
			$mpdf = new mPDF('c', 'A4', '', '', 20, 15, 38, 25, 10, 10);
			$mpdf->SetProtection(array('print'));
			$mpdf->SetTitle("Walart Pharmaceutical. - Payment Receipt");
			$mpdf->SetAuthor("Walart Pharmaceutical.");
			$mpdf->SetDisplayMode('fullpage');

			$header = $this->load->view( BACKEND . '/payment/generate/header', $this->data, true);
			$footer = $this->load->view( BACKEND . '/payment/generate/footer', $this->data, true);
			$html = $this->load->view( BACKEND . '/payment/generate', $this->data, true);

			$mpdf->SetHTMLHeader($header);
			$mpdf->SetHTMLFooter($footer);
			$mpdf->WriteHTML($html);

			$mpdf->Output($pdfFilePath, "D");
		}
		else
		{
			redirect_backend_url('invoice');
		}
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

		$rows = $this->payment->getPayments($this->ion_auth->get_user_id(), $limit, $start, $searchPhrase);
		
		if(!isset($rows) && empty($rows))
		{
			$rows = array();
		}
		
		$json['current'] = (int)$current;
		$json['rows'] = $rows;
		$json['rowCount'] = (int)$limit;
		$json['total'] = $this->payment->getPayments($this->ion_auth->get_user_id(), '', '', $searchPhrase, 'COUNT');
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}

	public function get_payment_history($depot_id)
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

		$rows = $this->payment->getPaymentHistory($depot_id, $limit, $start, $searchPhrase);
		
		if(!isset($rows) && empty($rows))
		{
			$rows = array();
		}
		
		$json['current'] = (int)$current;
		$json['rows'] = $rows;
		$json['rowCount'] = (int)$limit;
		$json['total'] = $this->payment->getPaymentHistory($depot_id, '', '', $searchPhrase, 'COUNT');
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}

	public function customer()
	{
		if($this->ion_auth->is_customer())
		{
			$this->data['title'] = 'Depot Payment';
		}
		elseif($this->ion_auth->is_depot())
		{
			$this->data['title'] = 'Customer Payment';
		}
		else
		{
			$this->data['title'] = 'Payment List';
		}

		$this->data['styles']['href'] = array(
								'components/bootgrid/jquery.bootgrid.min.css',
							);
		$this->data['scripts']['src'] = array(
    									'components/bootgrid/jquery.bootgrid.min.js',
    								);

		$this->payment->loadDefs('payment', 'listViewDefs');
    	$this->data['gridDefs'] = $this->payment->listViewDefs;

		$this->load->render('payment/customer/index', $this->data, FALSE);
	}

	public function customer_save()
	{
		if($this->validation())
		{
			$this->setup('payment');
	    	$this->payment->setRequestData();
	    	$this->payment->table = 'retailer_payment';
	    	
	    	if($this->input->post('status') == 'Pending')
            {
                $this->payment->request_data['date_pending'] = CURRENT_DATETIME;
            }
            else if($this->input->post('status') == 'Done')
            {
                $this->payment->request_data['date_done'] = CURRENT_DATETIME;
            }
            if($this->input->post('record'))
            {
            	$this->record = $this->input->post('record');
            }
	    	$this->payment->save();
	    	redirect('payment/customer', 'refresh');
		}
		else
		{
			$this->data = $_POST;
			$this->customer_edit();
		}
	}

	public function get_payment_customer()
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

		$rows = $this->payment->getRetailerPayments($this->ion_auth->get_user_id(), $limit, $start, $searchPhrase);
		
		if(!isset($rows) && empty($rows))
		{
			$rows = array();
		}
		
		$json['current'] = (int)$current;
		$json['rows'] = $rows;
		$json['rowCount'] = (int)$limit;
		$json['total'] = $this->payment->getRetailerPayments($this->ion_auth->get_user_id(), '', '', $searchPhrase, 'COUNT');
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}

	public function customer_edit($id = '')
	{
		$this->data['styles']['href'] = array(
								'components/jquery-ui/jquery-ui.css',
							);
		$this->data['scripts']['src'] = array(
    									'components/jquery-ui/jquery-ui.js',
    								);
		$this->load->helper('input');

		if(!empty($id))
		{
			$this->module = 'payment';
			$this->setModelName();
			$this->record = $id;
			$this->payment->table = 'retailer_payment';
			$this->dataRetrieve();
		}

		
		
		$account_id = $this->input->get_post('depot_id');
		$retailer_id = $this->input->get_post('retailer_id');

		if($this->ion_auth->is_depot())
		{
			$this->data['simbanic_id'] = $retailer_id;
		}
		elseif($this->ion_auth->is_customer())
		{
			$this->data['simbanic_id'] = $account_id;
		}
		
		$account_info = $this->ion_auth->getSimbanicUser($account_id);
		if($account_info)
		{
			$this->data['account_info'] = $account_info;
		}

		$this->payment->table = 'retailer_payment';

		$this->data['title'] = 'Payment';

		$this->data['depot_id'] = $account_id;
		$this->data['retailer_id'] = $retailer_id;
		
		$this->load->render('payment/customer/edit', $this->data, FALSE);
	}

	public function customer_view($id)
	{
		$this->data['title'] = 'View Payment Detail';

		$this->data['styles']['href'] = array(
								'components/bootgrid/jquery.bootgrid.min.css',
							);
		$this->data['scripts']['src'] = array(
    									'components/bootgrid/jquery.bootgrid.min.js',
    									'js/payment.js',
    									'js/simbanic_onclick.js',
    								);

		$this->payment->loadDefs('payment', 'historyListViewDefs');
		$this->data['gridDefs'] = $this->payment->historyListViewDefs;

		$user_info = $this->ion_auth->getSimbanicUser($id);		

		$this->data['user_info'] = $user_info;

		if($this->ion_auth->is_depot())
		{
			$depot_id = $this->ion_auth->get_user_id();
			$retailer_id = $id;
		}
		elseif($this->ion_auth->is_customer())
		{
			$retailer_id = $this->ion_auth->get_user_id();
			$depot_id = $id;
		}
		else
		{
			$depot_id = 0;
			$retailer_id = 0;
		}

		$this->data['id'] = $id;
		$this->data['depot_id'] = $depot_id;
		$this->data['retailer_id'] = $retailer_id;
		
		$this->load->render('payment/customer/view', $this->data, FALSE);
	}

	public function get_payment_customer_history($id)
	{
		if($this->ion_auth->is_depot())
		{
			$depot_id = $this->ion_auth->get_user_id();
			$retailer_id = $id;
		}
		elseif($this->ion_auth->is_customer())
		{
			$retailer_id = $this->ion_auth->get_user_id();
			$depot_id = $id;
		}
		else
		{
			$depot_id = 0;
			$retailer_id = 0;
		}
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

		$rows = $this->payment->getRetailerPaymentHistories($depot_id, $retailer_id, $limit, $start, $searchPhrase);
		
		if(!isset($rows) && empty($rows))
		{
			$rows = array();
		}
		
		$json['current'] = (int)$current;
		$json['rows'] = $rows;
		$json['rowCount'] = (int)$limit;
		$json['total'] = $this->payment->getRetailerPaymentHistories($id, '', '', $searchPhrase, 'COUNT');
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}
}
?>