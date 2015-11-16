<?php

require_once(APPPATH . 'controllers/' . BACKEND . '/simba_backend_controller.php');

class Invoice_Controller extends Simba_Backend_Controller
{
	public $productListViewDefs = array();
	public $orderConvertedListViewDefs = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model('invoice/invoice');
	}

	public function index()
	{
		if($this->ion_auth->is_admin())
		{
			$this->data['title'] = 'Depot Invoice List';
		}
		elseif($this->ion_auth->is_depot())
		{
			$this->data['title'] = 'Company Invoice List';
		}
		else
		{
			$this->data['title'] = 'Invoice List';	
		}

		$this->data['styles']['href'] = array(
								'components/bootgrid/jquery.bootgrid.min.css',
							);
		$this->data['scripts']['src'] = array(
    									'components/bootgrid/jquery.bootgrid.min.js',
    								);
		
		$this->invoice->setListViewDefs('invoice');
		$this->data['gridDefs'] = $this->invoice->listviewdefs;
		

		$this->load->render('invoice/index', $this->data, FALSE);
	}

	public function create()
	{
		$this->load->library('cart');
		$this->cart->destroy();

		$this->data['title'] = 'Make Customer Invoice';
		$this->data['styles']['href'] = array(
								'components/bootgrid/jquery.bootgrid.min.css',
								'components/jquery-ui/jquery-ui.css',
								'components/select2/css/select2.css',
							);
		$this->data['scripts']['src'] = array(
    									'components/bootgrid/jquery.bootgrid.min.js',
    									'components/jquery-ui/jquery-ui.js',
    									'components/select2/js/select2.js',
    									'js/simbanic_cart.js',
    								);
		
		$this->load->helper('input');

		$this->invoice->loadDefs('invoice', 'createListViewDefs');
    	$this->data['gridDefs'] = $this->invoice->createListViewDefs;

		$this->load->render('invoice/create', $this->data, FALSE);
	}

	public function view($invoice_id)
	{
		$this->data['title'] = 'View Invoice';

		$this->data['styles']['href'] = array(
								'components/bootgrid/jquery.bootgrid.min.css',
							);
		$this->data['scripts']['src'] = array(
    									'components/bootgrid/jquery.bootgrid.min.js',
    									'js/simbanic_onclick.js',
    								);

		$this->invoice->loadDefs('invoice', 'productListViewDefs');
		$this->data['gridDefs'] = $this->invoice->productListViewDefs;

		$invoice_info = $this->invoice->getInvoice($invoice_id);
		$this->data['invoice'] = $invoice_info;
		$this->data['invoice_id'] = $invoice_id;
		$this->data['invoice_no'] = $invoice_info->invoice_no;

		$next = array(
			'invoice_id'	=> $invoice_id,
			'next_previous_name'	=> 'next',
		);

		$previous = array(
			'invoice_id'	=> $invoice_id,
			'next_previous_name'	=> 'previous',
		);

		if($this->ion_auth->is_depot())
		{
			if($this->input->get_post('view') == 'customer')
			{
				$this->data['next_invoice'] = $this->invoice->getCustomerInvoices($this->ion_auth->get_user_id(), '', '', '', '', $next);
		
				$this->data['previous_invoice'] = $this->invoice->getCustomerInvoices($this->ion_auth->get_user_id(), '', '', '', '', $previous);
			}
			else
			{
				$this->data['next_invoice'] = $this->invoice->getInvoices($this->ion_auth->get_user_id(), '', '', '', '', $next);
		
				$this->data['previous_invoice'] = $this->invoice->getInvoices($this->ion_auth->get_user_id(), '', '', '', '', $previous);
			}
		}
		else
		{
			$this->data['next_invoice'] = $this->invoice->getInvoices($this->ion_auth->get_user_id(), '', '', '', '', $next);
		
			$this->data['previous_invoice'] = $this->invoice->getInvoices($this->ion_auth->get_user_id(), '', '', '', '', $previous);
		}
		
		$this->load->render('invoice/view', $this->data, FALSE);
	}

	public function confirm($invoice_id)
	{
		$invoice_update_data = array('date_confirm' => CURRENT_DATETIME);

		if($this->ion_auth->is_depot())
		{
			$invoice_where_data = array('depot_invoice_id' => $invoice_id);
			$this->query_model->save('depot_invoice', $invoice_update_data, $invoice_id);
			$this->query_model->update_Data('depot_invoice_product', $invoice_update_data, $invoice_where_data);
		}
		else if($this->ion_auth->is_customer())
		{
			$invoice_where_data = array('retailer_invoice_id' => $invoice_id);
			$this->query_model->save('retailer_invoice', $invoice_update_data, $invoice_id);
			$this->query_model->update_Data('retailer_invoice_product', $invoice_update_data, $invoice_where_data);
		}
		
		redirect('invoice', 'refresh');
	}

	public function comment($invoice_id)
	{
		$json = array();
		$comment = $this->input->get_post('comment');
		if(!empty($comment))
		{
			$invoice_update_data = array('comment' => $comment);

			if($this->ion_auth->is_depot() || $this->ion_auth->is_admin())
			{
				if($this->input->get_post('view') == 'customer')
				{
					$this->query_model->save('retailer_invoice', $invoice_update_data, $invoice_id);
				}
				else
				{
					$this->query_model->save('depot_invoice', $invoice_update_data, $invoice_id);
				}
			}
			elseif($this->ion_auth->is_customer())
			{
				$this->query_model->save('retailer_invoice', $invoice_update_data, $invoice_id);
			}
			$json['success'] = 'Comment Saved Successfully !!!';
		}
		else
		{
			$json['error'] = 'Please Enter Comment';
		}
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}

	public function generate($invoice_id)
	{
		$this->data['invoice_id'] = $invoice_id;
		if(!empty($this->input->get('transportation_name')) || !empty($this->input->get('lr_no')))
		{
			$invoice_update_data = array();
			if(!empty($this->input->get('transportation_name')))
			{
				$invoice_update_data['transportation_name'] = $this->input->get('transportation_name');
			}
			if(!empty($this->input->get('lr_no')))
			{
				$invoice_update_data['lr_no'] = $this->input->get('lr_no');
			}
			if(!empty($invoice_update_data))
			{
				$this->query_model->save('depot_invoice', $invoice_update_data, $invoice_id);
			}
		}
		$invoice_info = $this->invoice->getInvoice($invoice_id);

		if($invoice_info)
		{
			if($this->ion_auth->is_customer() || $this->input->get_post('view') == 'customer')
			{
				$user_id = $invoice_info->retailer_id;
			}
			else
			{
				$user_id = $invoice_info->depot_id;
			}

			$this->data['invoice_info'] = $invoice_info;
			$user_info = $this->ion_auth->getSimbanicUser($user_id);
			$this->data['user_info'] = $user_info;
			$this->data['invoice_product_info'] = $this->invoice->getInvoiceProducts($invoice_id);
			$invoice_month = date("M", strtotime($invoice_info->date_created));
			$pdfFilePath = $invoice_month . '_' .$user_info->full_name . '_' . $user_info->customer_id . '_' . $invoice_info->invoice_no . ".pdf";
		 
			//load mPDF library
			$this->load->library('m_pdf');
			$pdf = $this->m_pdf->load();
			$mpdf = new mPDF('c', 'A4', '', '', 20, 15, 38, 25, 10, 10);
			$mpdf->SetProtection(array('print'));
			$mpdf->SetTitle("Walart Pharmaceutical. - Invoice");
			$mpdf->SetAuthor("Walart Pharmaceutical.");
			$mpdf->SetDisplayMode('fullpage');

			$header = $this->load->view( BACKEND . '/invoice/generate/header', $this->data, true);
			$footer = $this->load->view( BACKEND . '/invoice/generate/footer', $this->data, true);
			$html = $this->load->view( BACKEND . '/invoice/generate', $this->data, true);

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

	public function get_invoice()
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
				if(array_key_exists("MONTH-date_created", $filter_data))
				{
					if(!empty($filter_data['MONTH-date_created']))
					{
						$filter_data['MONTH(sri.date_created)'] = "MONTH('".$filter_data['MONTH-date_created']."')";	
					}
					unset($filter_data['MONTH-date_created']);
				}
			}
		}
		else
		{
			$filter_data = array();
		}

		$rows = $this->invoice->getInvoices($this->ion_auth->get_user_id(), $limit, $start, $searchPhrase, '', array(), $filter_data);
		
		if(!isset($rows) && empty($rows))
		{
			$rows = array();
		}
		
		$json['current'] = (int)$current;
		$json['rows'] = $rows;
		$json['rowCount'] = (int)$limit;
		$json['total'] = $this->invoice->getInvoices($this->ion_auth->get_user_id(), '', '', $searchPhrase, 'COUNT', array(), $filter_data);
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}

	public function get_invoice_product($invoice_id)
	{
		if ($this->input->get_post('current'))
		{
			$current = (int)$_REQUEST['current'];
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

		
		$rows = $this->invoice->getInvoiceProducts($invoice_id);

		if(!isset($rows) && empty($rows))
		{
			$rows = array();
		}

		$total_count = $this->invoice->getInvoiceProducts($invoice_id, '', '', '', 'COUNT');

		if($rows)
		{
			if($total_count > 0)
			{
				$last_row = array();
				$last_row[$total_count]['sub_total'] = 0;
				$last_row[$total_count]['order_quantity'] = 'Total';
				foreach ($rows as $row)
				{
					$last_row[$total_count]['sub_total'] += $row->order_quantity * $row->price;
					//$last_row[$total_count]['order_quantity'] += $row->order_quantity;
				}
				$rows = array_merge($rows, $last_row);
			}
		}
		//var_dump($rows);
		$json['current'] = (int)$current;
		$json['rows'] = $rows;
		$json['rowCount'] = (int)$total_count;
		$json['total'] = $total_count;
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}

	public function customer()
	{
		$this->data['title'] = 'Customer Invoice List';
		$this->data['styles']['href'] = array(
								'components/bootgrid/jquery.bootgrid.min.css',
							);
		$this->data['scripts']['src'] = array(
    									'components/bootgrid/jquery.bootgrid.min.js',
    								);
		
		$this->invoice->setListViewDefs('invoice');
		$this->data['gridDefs'] = $this->invoice->listviewdefs;
		
		$this->load->render('invoice/customer/index', $this->data, FALSE);
	}

	public function get_invoice_customer()
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

		$rows = $this->invoice->getCustomerInvoices($this->ion_auth->get_user_id(), $limit, $start, $searchPhrase);
		
		if(!isset($rows) && empty($rows))
		{
			$rows = array();
		}
		
		$json['current'] = (int)$current;
		$json['rows'] = $rows;
		$json['rowCount'] = (int)$limit;
		$json['total'] = $this->invoice->getCustomerInvoices($this->ion_auth->get_user_id(), '', '', $searchPhrase, 'COUNT');
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}
}
?>