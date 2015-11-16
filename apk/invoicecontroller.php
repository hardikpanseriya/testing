<?php

if (!defined('BASEPATH'))
        exit('No direct script access allowed');

class InvoiceController extends MY_Controller
{
        public function __construct()
        {
            parent::__construct();
            $this->load->model('invoice/invoice');
            $this->load->library('form_validation');
        }

        public function index()
        {
        	$data['title'] = 'Invoice';
        	$session_data = $this->session->userdata('is_user_logged_in');
            $user_id = $session_data['INVOICE_USER_ID'];

            $offset = ($this->uri->segment(3) != '' ? $this->uri->segment(3): 0);
            $config['total_rows'] = $this->notes->getTotalCountByUser($user_id);
            $config['per_page'] = 4;
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';
            $config['uri_segment'] = 3;
            $config['base_url']= base_url().'/notescontroller/index';
            $config['suffix'] = '?'.http_build_query($_GET, '', "&");
            $this->pagination->initialize($config);

            $data['paginglinks'] = $this->pagination->create_links();
            // Showing total rows count
            if($data['paginglinks']!= '') {
                    $data['pagermessage'] = 'Showing '.((($this->pagination->cur_page-1)*$this->pagination->per_page)+1).' to '.($this->pagination->cur_page*$this->pagination->per_page).' of '.$this->pagination->total_rows;
            }
            $data['result'] = $this->notes->GetLimitNotesListByUser($user_id, $config["per_page"], $offset); 
            $data['offset'] = $offset;
        	$this->load->view('invoice/index', $data);
        }

        public function create()
		{
			$session_data = $this->session->userdata('is_user_logged_in');
            $user_id = $session_data['INVOICE_USER_ID'];
            $data['user_role'] = $session_data['INVOICE_USER_ROLE'];

			$data['title'] = 'Invoice: Create';
			$data['styles']['href'] = array(
									'plugins/datepicker/css/datepicker.css',
								);
			$data['scripts']['src'] = array(
    									'plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
    									'plugins/jquery.maskedinput/src/jquery.maskedinput.js',
    									'plugins/jquery-validation/dist/jquery.validate.min.js',
    									'js/form-elements.js'
    								);
			$this->load->view('invoice/create', $data);
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @return Response
		 */
		public function store()
		{
			$this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
			$this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean');
			$this->form_validation->set_rules('collector_name', 'Collector Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('position', 'Position', 'trim|required|xss_clean');
			$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('company_address', 'Company Address', 'trim|required|xss_clean');
			$this->form_validation->set_rules('company_city', 'Company City', 'trim|required|xss_clean');
			$this->form_validation->set_rules('company_state', 'Company State', 'trim|required|xss_clean');
			$this->form_validation->set_rules('company_zip', 'Company Zip', 'trim|required|xss_clean');
			$this->form_validation->set_rules('company_phone', 'Company Phone', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('company_fax', 'Company Fax', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('company_email', 'Company Email', 'trim|required|xss_clean');
			
			if ($this->form_validation->run() == FALSE)
			{
				$session_data = $this->session->userdata('is_user_logged_in');
	            $user_id = $session_data['INVOICE_USER_ID'];
	            $data['user_role'] = $session_data['INVOICE_USER_ROLE'];
				$data['title'] = 'Invoice: Create';
				$data['styles']['href'] = array(
										'plugins/datepicker/css/datepicker.css',
									);
				$data['scripts']['src'] = array(
	    									'plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
	    									'plugins/jquery.maskedinput/src/jquery.maskedinput.js',
	    									'plugins/jquery-validation/dist/jquery.validate.min.js',
	    									'js/form-elements.js'
	    								);
				$this->load->view('invoice/create', $data);
			}
			else
			{
				$session_data = $this->session->userdata('is_user_logged_in');
				$user_id = $session_data['INVOICE_USER_ID'];
				$user_data = $this->sitefunction->getIdWiseData('user', 'user_id', $user_id);
				$date = $this->sitefunction->convertmdyToymdFormat('-', trim($this->input->post('date')));
				
				$company_phone = str_replace('(', '', str_replace(') ', '', str_replace('-', '', trim($this->input->post('company_phone')))));
				
				if(trim($this->input->post('company_fax')) != '')
				{
					$company_fax = trim($this->input->post('company_fax'));
				}
				else
				{
					$company_fax = 0;
				}
				
				if(trim($this->input->post('company_email')) != '')
				{
					$company_email = trim($this->input->post('company_email'));
				}
				else
				{
					$company_email = 'N/A';
				}

                $data = array(
                	'user_id' => $user_id,
                	'company_id' => $user_data->company_id,
                    'date' => $date,
	                'amount' => trim($this->input->post('amount')),
	                'collector_name' => trim($this->input->post('collector_name')),
	                'position' => trim($this->input->post('position')),
	                'company_name' => trim($this->input->post('company_name')),
	                'company_address' => trim($this->input->post('company_address')),
	                'company_city' => trim($this->input->post('company_city')),
	                'company_state' => trim($this->input->post('company_state')),
	                'company_zip' => trim($this->input->post('company_zip')),
	                'company_phone' => $company_phone,
	                'company_fax' => $company_fax,
	                'company_email' => $company_email,
	                'contact_name' => trim($this->input->post('contact_name')),
	                'discount' => trim($this->input->post('discount')),
                    'ip_address' => $this->input->ip_address(),
                    'user_agent' => $this->input->user_agent(),
                    'created_at' => CURRENT_DATETIME,
                    'updated_at' => CURRENT_DATETIME
                );
				$prefix = trim($this->input->post('prefix'));
				$invoice_status = trim($this->input->post('invoice_status'));
				$invoice_sent = trim($this->input->post('invoice_sent'));
				$invoice_invoice_id = trim($this->input->post('invoice_invoice_id'));

				if(isset($invoice_invoice_id) && $invoice_invoice_id != '')
				{
					$data['invoice_invoice_id'] = $invoice_invoice_id;
				}
				if(isset($prefix) && $prefix != '')
				{
					$data['prefix'] = $prefix;
				}
				if(isset($invoice_status) && $invoice_status != '')
				{
					$data['invoice_status'] = $invoice_status;
				}
				if(isset($invoice_sent) && $invoice_sent != '')
				{
					$data['invoice_sent'] = $invoice_sent;
				}

				
				
                // insert data
                $this->sitefunction->insertData('invoice', $data);
            	
				$this->session->set_flashdata('message', 'Invoice created successfully');
				redirect('dashboard', 'refresh');
			}
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int  $id
		 * @return Response
		 */
		public function show($id)
		{
			if (is_numeric($id))
			{
				if($this->invoice->checkInvoiceIdExist($id))
				{
					$data['invoice_id'] = $id;
					$invoice_res = $this->sitefunction->getIdWiseData('invoice', 'invoice_id', $id);
					$data['date'] = date(INVOICE_DATE_DISPLAY, strtotime($invoice_res->date));
					$data['amount'] = $invoice_res->amount;
					$data['collector_name'] = $invoice_res->collector_name;
					$data['position'] = $invoice_res->position;
					$data['company_name'] = $invoice_res->company_name;
					$data['company_address'] = $invoice_res->company_address;
					$data['company_city'] = $invoice_res->company_city;
					$data['company_state'] = $invoice_res->company_state;
					$data['company_zip'] = $invoice_res->company_zip;
					$data['company_phone'] = $invoice_res->company_phone;
					$data['company_fax'] = $invoice_res->company_fax;
					$data['company_email'] = $invoice_res->company_email;
					$data['invoice_status'] = $invoice_res->invoice_status;
					$data['title'] = $invoice_res->company_name.': Invoice';
					$this->load->view('invoice/show', $data);
				}
			}
			else
			{
				redirect('dashboard', 'refresh');
			}
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int  $id
		 * @return Response
		 */
		public function edit($id)
		{
			if (is_numeric($id))
			{
				if($this->invoice->checkInvoiceIdExist($id))
				{
					$data['title'] = 'Invoice: Edit';
					$data['styles']['href'] = array(
											'plugins/datepicker/css/datepicker.css',
										);
					$data['scripts']['src'] = array(
		    									'plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
		    									'plugins/jquery.maskedinput/src/jquery.maskedinput.js',
		    									'plugins/jquery-validation/dist/jquery.validate.min.js',
		    									'js/form-elements.js'
		    								);
					$session_data = $this->session->userdata('is_user_logged_in');
		            $user_id = $session_data['INVOICE_USER_ID'];
		            $data['user_role'] = $session_data['INVOICE_USER_ROLE'];
					$data['invoice_id'] = $id;
					$invoice_res = $this->sitefunction->getIdWiseData('invoice', 'invoice_id', $id);
					$data['invoice_invoice_id'] = $invoice_res->invoice_invoice_id;
					$data['prefix'] = $invoice_res->prefix;
					$data['date'] = date(INVOICE_DATE_DISPLAY, strtotime($invoice_res->date));
					
					if($invoice_res->amount != '' && $invoice_res->amount != 0)
					{
						$data['amount'] = $invoice_res->amount;
					}
					else
					{
						$data['amount'] = 0;
					}
					
					$data['collector_name'] = $invoice_res->collector_name;
					$data['position'] = $invoice_res->position;
					$data['company_name'] = $invoice_res->company_name;
					$data['company_address'] = $invoice_res->company_address;
					$data['company_city'] = $invoice_res->company_city;
					$data['company_state'] = $invoice_res->company_state;
					$data['company_zip'] = $invoice_res->company_zip;
					$data['company_phone'] = $invoice_res->company_phone;
					$data['company_fax'] = $invoice_res->company_fax;
					$data['company_email'] = $invoice_res->company_email;
					$data['invoice_status'] = $invoice_res->invoice_status;
					$data['invoice_sent'] = $invoice_res->invoice_sent;
					$data['contact_name'] = $invoice_res->contact_name;
					if($invoice_res->discount != '' && $invoice_res->discount != 0)
					{
						$data['discount'] = $invoice_res->discount;
					}
					else
					{
						$data['discount'] = 0;
					}

					$this->load->view('invoice/create', $data);
				}
				else
				{
					redirect('dashboard', 'refresh');
				}
			}
			else
			{
				redirect('dashboard', 'refresh');
			}
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  int  $id
		 * @return Response
		 */
		public function update($id)
		{
			if (is_numeric($id))
			{
				if($this->invoice->checkInvoiceIdExist($id))
				{

					$this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
					$this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean');
					$this->form_validation->set_rules('collector_name', 'Collector Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('position', 'Position', 'trim|required|xss_clean');
					$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('company_address', 'Company Address', 'trim|required|xss_clean');
					$this->form_validation->set_rules('company_city', 'Company City', 'trim|required|xss_clean');
					$this->form_validation->set_rules('company_state', 'Company State', 'trim|required|xss_clean');
					$this->form_validation->set_rules('company_zip', 'Company Zip', 'trim|required|xss_clean');
					$this->form_validation->set_rules('company_phone', 'Company Phone', 'trim|required|xss_clean');
					//$this->form_validation->set_rules('company_fax', 'Company Fax', 'trim|required|xss_clean');
					//$this->form_validation->set_rules('company_email', 'Company Email', 'trim|required|xss_clean');
					
					if ($this->form_validation->run() == FALSE)
					{
						$data['title'] = 'Invoice: Edit';
						$data['styles']['href'] = array(
												'plugins/datepicker/css/datepicker.css',
											);
						$data['scripts']['src'] = array(
			    									'plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
			    									'plugins/jquery.maskedinput/src/jquery.maskedinput.js',
			    									'plugins/jquery-validation/dist/jquery.validate.min.js',
			    									'js/form-elements.js'
			    								);
						$this->load->view('invoice/create', $data);
					}
					else
					{
						$company_phone = str_replace('(', '', str_replace(') ', '', str_replace('-', '', trim($this->input->post('company_phone')))));
						$date = $this->sitefunction->convertmdyToymdFormat('-', trim($this->input->post('date')));

						if(trim($this->input->post('company_fax')) != '')
						{
							$company_fax = trim($this->input->post('company_fax'));
						}
						else
						{
							$company_fax = 0;
						}
						
						if(trim($this->input->post('company_email')) != '')
						{
							$company_email = trim($this->input->post('company_email'));
						}
						else
						{
							$company_email = 'N/A';
						}
				
		                $data = array(
		                    'date' => $date,
			                'amount' => trim($this->input->post('amount')),
			                'collector_name' => trim($this->input->post('collector_name')),
			                'position' => trim($this->input->post('position')),
			                'company_name' => trim($this->input->post('company_name')),
			                'company_address' => trim($this->input->post('company_address')),
			                'company_city' => trim($this->input->post('company_city')),
			                'company_state' => trim($this->input->post('company_state')),
			                'company_zip' => trim($this->input->post('company_zip')),
			                'company_phone' => $company_phone,
			                'company_fax' => $company_fax,
	                		'company_email' => $company_email,
			                'contact_name' => trim($this->input->post('contact_name')),
	                		'discount' => trim($this->input->post('discount')),
		                    'ip_address' => $this->input->ip_address(),
		                    'user_agent' => $this->input->user_agent(),
		                    'updated_at' => CURRENT_DATETIME
		                );
						$prefix = trim($this->input->post('prefix'));
						$invoice_status = trim($this->input->post('invoice_status'));
						$invoice_invoice_id = trim($this->input->post('invoice_invoice_id'));
				
						if(isset($invoice_invoice_id) && $invoice_invoice_id != '')
						{
							$data['invoice_invoice_id'] = $invoice_invoice_id;
						}
						if(isset($prefix) && $prefix != '')
						{
							$data['prefix'] = $prefix;
						}
						if(isset($invoice_status) && $invoice_status != '')
						{
							$data['invoice_status'] = $invoice_status;
						}

		                // update data
		                $user_id = $this->sitefunction->updateData('invoice', 'invoice_id', $id, $data);
		                $this->session->set_flashdata('message', 'Invoice updated successfully');
		                $get_url_data = '?'.http_build_query($_GET, '', "&");
						redirect('invoice/edit/'.$id.$get_url_data, 'refresh');
					}
				}
			}
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * @return Response
		 */
		public function destroy()
		{
			$session_data = $this->session->userdata('is_user_logged_in');
            $user_id = $session_data['INVOICE_USER_ID'];
			$res = $this->sitefunction->deleteInvoiceByCompany($user_id);
			if($res)
			{
				$this->session->set_flashdata('message', 'Deleted successfully.');
    			redirect('dashboard', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('message', 'Record Not Found');
    			redirect('dashboard', 'refresh');
			}
		}

		public function download($filename)
		{
			$this->load->helper('download');
			$data = file_get_contents(base_url()."public/csv/".$filename); // Read the file's contents		 
		    force_download($filename, $data);
		}

		public function invoice_ajax()
		{
			$session_data = $this->session->userdata('is_user_logged_in');
            $user_id = $session_data['INVOICE_USER_ID'];

            $offset = ($this->uri->segment(3) != '' ? $this->uri->segment(3): 0);
            $config['total_rows'] = $this->invoice->getTotalCountInvoiceByUser($user_id);
            $config['per_page'] = 1;
            //$config['first_link'] = 'First';
            //$config['last_link'] = 'Last';
            $config['uri_segment'] = 3;
            $config['base_url']= base_url().'/invoicecontroller/invoice_ajax';
            $config['suffix'] = '?'.http_build_query($_GET, '', "&");
            $this->pagination->initialize($config);

            $data['paginglinks'] = $this->pagination->create_links();
            $data['offset'] = $offset;
            // Showing total rows count
            if($data['paginglinks']!= '') {
                    $data['pagermessage'] = 'Showing '.((($this->pagination->cur_page-1)*$this->pagination->per_page)+1).' to '.($this->pagination->cur_page*$this->pagination->per_page).' of '.$this->pagination->total_rows;
            }
            $data['result'] = $this->invoice->GetLimitInvoiceListByUser($user_id, $config["per_page"], $offset);
            $data['offset'] = $offset;
            $this->load->view('component/invoice_ajax', $data);
		}

		public function checkIsCompanyPhonelUnique()
        {
        	$session_data = $this->session->userdata('is_user_logged_in');
            $user_id = $session_data['INVOICE_USER_ID'];
            $user_data = $this->sitefunction->getIdWiseData('user', 'user_id', $user_id);
            $company_id = $user_data->company_id;

			$company_phone = str_replace('(', '', str_replace(') ', '', str_replace('-', '', trim($this->input->post('company_phone')))));
            $invoice_id = trim($this->input->post('invoice_id'));
			$res = $this->invoice->checkPhoneUnique($company_id, $company_phone, $invoice_id);
            if($res)
            {
                echo "true";
            }
            else
            {
                echo "false";
            }
        }

        public function readExcel()
        {
        	$this->load->library('csvreader');
        	if (empty($_FILES['csvfile']['name']))
			{
			    $this->session->set_flashdata('error_message', 'please upload valid file');
			    redirect('invoice/create', 'refresh');
			}
			else
			{
				if((isset($_FILES['csvfile']) && $_FILES['csvfile']['type'] == 'text/csv') || $_FILES['csvfile']['type'] == 'text/x-comma-separated-values' || $_FILES['csvfile']['type'] == 'application/octet-stream' || $_FILES['csvfile']['type'] == 'application/vnd.ms-excel')
				{
					$result =   $this->csvreader->parse_file($_FILES['csvfile']['tmp_name']);
					
        			if(count($result) > 0)
        			{
        				$session_data = $this->session->userdata('is_user_logged_in');
						$user_id = $session_data['INVOICE_USER_ID'];
						$user_data = $this->sitefunction->getIdWiseData('user', 'user_id', $user_id);

        				if($this->checkCsvCompanyPhoneUnique($user_data->company_id, $result))
        				{
        					foreach($result as $res)
	    					{
	    						if(isset($res['fax']) && $res['fax'] != '')
								{
									$company_fax = trim($res['fax']);
								}
								else
								{
									$company_fax = 0;
								}
								
								if(isset($res['email']) && $res['email'] != '')
								{
									$company_email = trim($res['email']);
								}
								else
								{
									$company_email = 'N/A';
								}
								
								if(isset($res['invoicedate']) && $res['invoicedate'] != '')
								{
									$exp = explode("/", DATE($res['invoicedate']));
									$date_exp = $exp[0].'-'.$exp[1].'-'.$exp[2];
									$invoicedate = date("Y-m-d", strtotime($date_exp));
								}
								else
								{
									$invoicedate = '0000-00-00';
								}

	    						$data = array(
				                	'user_id' => $user_id,
				                	'company_id' => $user_data->company_id,
				                	'prefix' => isset($res['prefex'])?trim($res['prefex']):'',
				                    	'date' => $invoicedate,
					                'amount' => isset($res['amount'])?trim($res['amount']):'',
					                'collector_name' => isset($res['collector'])?trim($res['collector']):'',
					                'position' => isset($res['position'])?trim($res['position']):'',
					                'company_name' => isset($res['company'])?trim($res['company']):'',
					                'company_address' => isset($res['address'])?trim($res['address']):'',
					                'company_city' => isset($res['city'])?trim($res['city']):'',
					                'company_state' => isset($res['state'])?trim($res['state']):'',
					                'company_zip' => isset($res['zip'])?trim($res['zip']):'',
					                'company_phone' => isset($res['phone'])?trim($res['phone']):'',
					                'company_fax' => $company_fax,
					                'company_email' => $company_email,
					                'contact_name' => isset($res['contact'])?trim($res['contact']):'',
					                'invoice_status' => isset($res['status'])?trim($res['status']):'',
				                    'ip_address' => $this->input->ip_address(),
				                    'user_agent' => $this->input->user_agent(),
				                    'created_at' => CURRENT_DATETIME,
				                    'updated_at' => CURRENT_DATETIME
				                );
	
								if(isset($res['discount']))
								{
									$data['discount'] = isset($res['discount'])?trim($res['discount']):'0';
								}
								if(isset($res['id']))
								{
									$data['invoice_invoice_id'] = isset($res['id'])?trim($res['id']):'';
								}
								/*if(isset($res['sent']))
								{
									$data['invoice_sent'] = isset($res['sent']) && $res['sent'] == 'on'? 'on':'';
								}*/
								// insert data
                				$this->sitefunction->insertData('invoice', $data);
	    					}
	    					$this->session->set_flashdata('message', 'Uploaded Successfully.');
	    					redirect('dashboard', 'refresh');
        				}
        				else
        				{
        					$this->session->set_flashdata('error_message', 'Phone Number Already Exist. Please Enter Valid Data.');
							redirect('invoice/create', 'refresh');
        				}
        			}
				}
				else
				{
					$this->session->set_flashdata('error_message', 'Please Upload Valid Data');
					redirect('invoice/create', 'refresh');
				}
			}
        }

        protected function valid_date($str, $params)
		{
			// setup
			$CI =&get_instance();
			$params = explode(',', $params);
			$delimiter = $params[1];
			$date_parts = explode($delimiter, $params[0]);

			// get the index (0, 1 or 2) for each part
			$di = $this->valid_date_part_index($date_parts, 'y');
			$mi = $this->valid_date_part_index($date_parts, 'm');
			$yi = $this->valid_date_part_index($date_parts, 'd');

			// regex setup
			$dre =   "(0?1|0?2|0?3|0?4|0?5|0?6|0?7|0?8|0?9|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25|26|27|28|29|30|31)";
			$mre = "(0?1|0?2|0?3|0?4|0?5|0?6|0?7|0?8|0?9|10|11|12)";
			$yre = "([0-9]{4})";
			$red = ''.$delimiter; // escape delimiter for regex
			$rex = "/^[0]{$red}[1]{$red}[2]/";

			// do replacements at correct positions
			$rex = str_replace("[{$di}]", $dre, $rex);
			$rex = str_replace("[{$mi}]", $mre, $rex);
			$rex = str_replace("[{$yi}]", $yre, $rex);

			if (preg_match($rex, $str, $matches))
			{
				// skip 0 as it contains full match, check the date is logically valid
				if (checkdate($matches[$mi + 1], $matches[$di + 1], $matches[$yi + 1]))
				{
					return true;
				}
				else
				{
					// match but logically invalid
					$CI->form_validation->set_message('valid_date', "The date is invalid.");
					return false;
				}
			}

			// no match
			$CI->form_validation->set_message('valid_date', "The date format is invalid. Use {$params[0]}");
			return false;
		}

		protected function checkCsvCompanyPhoneUnique($company_id, $result)
		{
			if(count($result) > 0)
			{
				$phone_unique = array();
				foreach($result as $checkPhone)
				{
					if(!in_array(trim($checkPhone['phone']), $phone_unique))
					{
						$phone_unique[] = trim($checkPhone['phone']);	
					}
				}
				array_unique($phone_unique);
				if($this->sitefunction->checkMulInvoicePhoneNoExist($company_id, $phone_unique))
				{
					return true;
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

		protected function valid_date_part_index($parts, $search)
		{
			for ($i = 0; $i <= count($parts); $i++)
			{
				if ($parts[$i] == $search)
				{
					return $i;
				}
			}
		}

		public function generate($id)
		{
			if (is_numeric($id))
			{
				if($this->invoice->checkInvoiceIdExist($id))
				{
					$invoice_data = $this->sitefunction->getInvoiceGenerateDetail($id);
					
					if(isset($invoice_data->invoice_sent) && ($invoice_data->invoice_sent == 0 || $invoice_data->invoice_sent == '0'))
					{
						$update_data = array('invoice_sent' => 1);
						$user_id = $this->sitefunction->updateData('invoice', 'invoice_id', $id, $update_data);
					}
					if($invoice_data)
					{
						$data['print'] = $invoice_data;
					}
					$data['title'] = 'Invoice: Generate';
					$data['body_class'] = 'print_body';
					$this->load->view('invoice/generate', $data);
				}
				else
				{
					redirect('dashboard', 'refresh');
				}
			}
			else
			{
				redirect('dashboard', 'refresh');
			}		
		}

		public function changecollectorname()
		{
			$data['title'] = 'Invoice: Collector Name';
			$this->load->view('invoice/collectorname', $data);
		}
		public function collectornameupdate()
		{
			$this->form_validation->set_rules('existing_collector_name', 'Existing Collector Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('new_collector_name', 'Change Collector Name', 'trim|required|xss_clean');

			if ($this->form_validation->run() == FALSE)
			{
				$data['title'] = 'Invoice: Collector Name';
				$this->load->view('invoice/collectorname', $data);
			}
			else
			{
				$session_data = $this->session->userdata('is_user_logged_in');
	            $user_id = $session_data['INVOICE_USER_ID'];
	            $user_data = $this->sitefunction->getIdWiseData('user', 'user_id', $user_id);
	            $company_id = $user_data->company_id;

				$existing_collector_name = trim($this->input->post('existing_collector_name'));
				$new_collector_name = trim($this->input->post('new_collector_name'));

				$data = array(
	                'collector_name' => $new_collector_name
                );

                // update data
                $user_id = $this->invoice->updateCollectorName($company_id, $existing_collector_name, $data);
                $this->session->set_flashdata('message', 'Collector Name updated successfully');
				redirect('dashboard', 'refresh');
			}
		}
}