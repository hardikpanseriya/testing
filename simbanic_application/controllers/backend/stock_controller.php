<?php

require_once(APPPATH . 'controllers/' . BACKEND . '/simba_backend_controller.php');

class Stock_Controller extends Simba_Backend_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->setup('stock');
	}

	public function index($id)
	{
		$this->data['title'] = 'Stock List';
		$this->data['styles']['href'] = array(
								'components/bootgrid/jquery.bootgrid.min.css',
								'components/jquery-ui/jquery-ui.css',
							);
		$this->data['scripts']['src'] = array(
    									'components/bootgrid/jquery.bootgrid.min.js',
    									'components/jquery-ui/jquery-ui.js',
    									'js/stock.js',
    									'js/simbanic_onclick.js',
    								);
		
		$this->model->loadListViewDefs();
		$this->data['gridDefs'] = $this->model->listviewdefs;

		$this->data['product_id'] = $id;
		$product_info = $this->query_model->get('product', $id);

		if($product_info)
		{
			$this->data['product'] = $product_info;
		}

		$this->load->render('stock/index', $this->data, FALSE);
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
			$this->data['title'] = 'Edit Stock';
		}
		else
		{
			$this->data['title'] = 'Create Stock';
		}
		
		$this->load->render('stock/edit', $this->data, FALSE);
	}

	public function product_stock_save()
	{
		$json = array();
		if(!empty($this->input->post('quantity')) && !empty($this->input->post('batch_no')))
		{
			if(is_numeric($this->input->post('quantity')))
			{
				$this->model->setRequestData();
				if($this->validate())
				{
					$this->model->save();
					$json['success'] = 'Stock added successfully';
				}
				else
				{
					$json['error'] = 'Please validate all fields';
				}
			}
			else
			{
				$json['error'] = 'Please enter a valid quantity';
			}
		}
		else
		{
			$json['error'] = 'Please complete all fields';
		}

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}

	public function get_product_stock($product_id)
	{
		$json = array();
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

		$rows = $this->model->getProductStocks($this->ion_auth->get_user_id(), $product_id, $limit, $start, $searchPhrase);
		
		if(!isset($rows) && empty($rows))
		{
			$rows = array();
		}
		
		$json['current'] = (int)$current;
		$json['rows'] = $rows;
		$json['rowCount'] = (int)$limit;
		$json['total'] = $this->model->getProductStocks($this->ion_auth->get_user_id(), $product_id, '', '', $searchPhrase, 'COUNT');
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}
}
?>