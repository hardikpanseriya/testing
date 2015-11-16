<?php

require_once(APPPATH . 'controllers/' . BACKEND . '/simba_backend_controller.php');

class Depot_Controller extends Simba_Backend_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->setup('depot');
	}

	public function index()
	{
		$this->data['title'] = 'Depot List';
		$this->data['styles']['href'] = array(
								'components/bootgrid/jquery.bootgrid.min.css',
							);
		$this->data['scripts']['src'] = array(
    									'components/bootgrid/jquery.bootgrid.min.js',
    								);
		
		$this->model->loadListViewDefs();
		$this->data['gridDefs'] = $this->model->listviewdefs;

		$this->load->render('depot/index', $this->data, FALSE);
	}

	public function edit($id = '')
	{
		$this->data['styles']['href'] = array(
								'components/jquery-ui/jquery-ui.css',
							);
		$this->data['scripts']['src'] = array(
    									'components/jquery-ui/jquery-ui.js',
    									'js/simbanic_input.js',
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
				$this->data['title'] = 'Edit Depot';
			}
		}
		else
		{
			$this->data['title'] = 'Create Depot';	
		}
		
		$this->load->render('depot/edit', $this->data);
	}

	public function get_depot()
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

		$rows = $this->model->getDepot($this->ion_auth->get_user_id(), $limit, $start, $searchPhrase);
		
		if(!isset($rows) && empty($rows))
		{
			$rows = array();
		}
		
		$json['current'] = (int)$current;
		$json['rows'] = $rows;
		$json['rowCount'] = (int)$limit;
		$json['total'] = $this->model->getDepot($this->ion_auth->get_user_id(), '', '', $searchPhrase, 'COUNT');
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}

}
?>