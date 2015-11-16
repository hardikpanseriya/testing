<?php

require_once(APPPATH . 'controllers/' . BACKEND . '/simba_backend_controller.php');

class Product_Controller extends Simba_Backend_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->setup('product');
	}

	public function index()
	{
		if($this->ion_auth->is_customer())
		{
			$this->data['title'] = 'Product Purchase';
		}
		else
		{
			$this->data['title'] = 'Product Stock';	
		}
		
		$this->data['styles']['href'] = array(
								'components/bootgrid/jquery.bootgrid.min.css',
							);
		$this->data['scripts']['src'] = array(
    									'components/bootgrid/jquery.bootgrid.min.js',
    								);

		$this->model->loadListViewDefs();
		$this->data['gridDefs'] = $this->model->listviewdefs;

		$this->load->render('product/index', $this->data, FALSE);
	}

	public function edit($id = '')
	{
		$this->data['styles']['href'] = array(
							);
		$this->data['scripts']['src'] = array(
    								);

		$this->load->helper('input');

		if(!empty($id))
		{
			$this->record = $id;
			$this->data['title'] = 'Edit Product';
		}
		else
		{
			$this->data['title'] = 'Create Product';
		}
		
		$this->load->render('product/edit', $this->data, FALSE);
	}

	public function get_product()
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

		$rows = $this->model->getProducts($this->ion_auth->get_user_id(), $limit, $start, $searchPhrase, '', $filter_data);
		
		if(!isset($rows) && empty($rows))
		{
			$rows = array();
		}
		
		$json['current'] = (int)$current;
		$json['rows'] = $rows;
		$json['rowCount'] = (int)$limit;
		$json['total'] = $this->model->getProducts($this->ion_auth->get_user_id(), '', '', $searchPhrase, 'COUNT', $filter_data);
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}

	public function get_product_total_unit()
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

		$total = $this->model->getTotalCustomerProductsStockUnit($this->ion_auth->get_user_id(), $filter_data);
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