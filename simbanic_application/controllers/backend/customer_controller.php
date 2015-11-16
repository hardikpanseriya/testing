<?php

require_once(APPPATH . 'controllers/' . BACKEND . '/simba_backend_controller.php');

class Customer_Controller extends Simba_Backend_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->setup('customer');
	}

	public function index()
	{
		/*$send_sms = $this->simba_sms->send_sms('9724563175', 'સૌરાષ્ટ્રમાં ‘ચાપલા’ નામના વાવાઝોડાનો ભય, અમુક સ્થળે વરસાદ શરૂ', '', 'json');*/
		$this->data['title'] = 'Customer List';
		$this->data['styles']['href'] = array(
								'components/bootgrid/jquery.bootgrid.min.css',
							);
		$this->data['scripts']['src'] = array(
    									'components/bootgrid/jquery.bootgrid.min.js',
    								);

		$this->model->loadListViewDefs();
		$this->data['gridDefs'] = $this->model->listviewdefs;

		$this->load->render('customer/index', $this->data, FALSE);
	}

	public function edit($id = '')
	{
		$this->data['styles']['href'] = array(
								'components/jquery-ui/jquery-ui.css',
								'components/select2/css/select2.css',
							);
		$this->data['scripts']['src'] = array(
    									'components/jquery-ui/jquery-ui.js',
    									'js/simbanic_input.js',
    									'components/select2/js/select2.js',
    								);

		$this->load->helper('input');
		$this->loadSimbaVarDefs();

		if(!empty($id))
		{
			$this->record = $id;
			if(!$this->ion_auth->is_admin())
			{
				$this->data['title'] = 'View Profile';
			}
			else
			{
				$this->data['title'] = 'Edit Customer';
			}
		}
		else
		{
			$this->data['title'] = 'Create Customer';	
		}
		
		$this->load->render('customer/edit', $this->data, FALSE);
	}

	public function tree()
	{
		if(!$this->ion_auth->is_depot())
		{
			$this->data['styles']['href'] = array(
								//'components/dagre-d3/custom_dagred3/xcode.min.css',
								'css/tree.css'
							);
			$this->data['scripts']['src'] = array(
	    									'components/dagre-d3/js/d3.v3.min.js',
	    									'components/dagre-d3/js/dagre-d3.min.js',
	    									//'components/dagre-d3/custom_dagred3/highlight.min.js',
	    								);
			$this->data['title'] = 'Tree';

			$this->data['sponsor_id'] = $this->ion_auth->user()->row()->sponsor_id;
			
			$this->data['tree_result'] = $this->model->getTreeData($this->ion_auth->get_user_id());
			
			$this->load->render('customer/tree', $this->data, FALSE);
		}
		else
		{
			redirect('/', 'refresh');
		}
	}

	public function get_customer_tree_data()
	{
		if ($this->input->post('node_id'))
		{
			$node_id = $this->input->get_post('node_id');
		}
		else
		{
			$node_id = 0;
		}
		if($this->ion_auth->is_customer())
		{
			$tree_level = $this->ion_auth->getSimbanicUser($this->ion_auth->get_user_id())->tree_id + 3;	
		}
		else
		{
			$tree_level = 0;
		}
		
		$json = $this->model->getParticularTreeData($node_id, $tree_level);
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}

	public function get_customer()
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

		$rows = $this->model->getCustomer($this->ion_auth->get_user_id(), $limit, $start, $searchPhrase);
		
		if(!isset($rows) && empty($rows))
		{
			$rows = array();
		}
		
		$json['current'] = (int)$current;
		$json['rows'] = $rows;
		$json['rowCount'] = (int)$limit;
		$json['total'] = $this->model->getCustomer($this->ion_auth->get_user_id(), '', '', $searchPhrase, 'COUNT');
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}

	public function check_parent_sponsor_id()
    {
        if($this->input->post('sponsor_id'))
        {
            $sponsor_id = $this->input->post('sponsor_id');

            if(isset($this->record))
            {
            	$record = $this->record;
            }
            elseif($this->input->post('record'))
            {
            	$record = $this->input->post('record');
            }
            else
            {
            	$record = '';
            }
            if($this->model->checkSponsorIDLevel($sponsor_id, $record))
            {
                return TRUE;   
            }
            else
            {
                $this->form_validation->set_message('check_parent_sponsor_id', 'Sponsor Position does not exist');
                return FALSE;
            }
            
        }
        else
        {
        	return true;
        }
    }
}
?>