<?php

require_once(APPPATH . 'controllers/' . BACKEND . '/simba_backend_controller.php');

class Order_Controller extends Simba_Backend_Controller
{
	public $productListViewDefs = array();
	public $orderConvertedListViewDefs = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model('order/order');
	}

	public function index()
	{
		$this->data['title'] = 'Order List';
		$this->data['styles']['href'] = array(
								'components/bootgrid/jquery.bootgrid.min.css',
							);
		$this->data['scripts']['src'] = array(
    									'components/bootgrid/jquery.bootgrid.min.js',
    								);
		
		$this->order->setListViewDefs('order');
		$this->data['gridDefs'] = $this->order->listviewdefs;

		$this->load->render('order/index', $this->data, FALSE);
	}

	public function create()
	{
		$this->load->library('cart');
		$this->cart->destroy();

		$this->data['title'] = 'Create Order';
		$this->data['styles']['href'] = array(
								'components/bootgrid/jquery.bootgrid.min.css',
							);
		$this->data['scripts']['src'] = array(
    									'components/bootgrid/jquery.bootgrid.min.js',
    									'js/simbanic_cart.js',
    								);

		$this->order->loadDefs('order', 'createListViewDefs');
    	$this->data['gridDefs'] = $this->order->createListViewDefs;

		$this->load->render('order/create', $this->data, FALSE);
	}

	public function view($order_id)
	{
		$this->load->library('cart');
		$this->cart->destroy();
		
		$this->data['title'] = 'View Order';

		$this->data['styles']['href'] = array(
								'components/bootgrid/jquery.bootgrid.min.css',
							);
		$this->data['scripts']['src'] = array(
    									'components/bootgrid/jquery.bootgrid.min.js',
    									'js/simbanic_cart.js',
    									'js/simbanic_onclick.js',
    								);

		$order_info = $this->order->getOrder($order_id);
		$this->data['order'] = $order_info;
		$this->data['order_id'] = $order_id;

		if($this->ion_auth->is_admin())
		{
			if($order_info->status == 'Processing')
			{
				redirect('order/convert/'.$order_id);
			}
		}

		$this->order->loadDefs('order', 'productListViewDefs');
		$this->data['gridDefs'] = $this->order->productListViewDefs;
		
		$rows = $this->order->getOrderProducts($order_id, 'depot');

		$i = 0;
		$cart_rows = array();
		if($rows)
		{
			foreach ($rows as $row)
			{
				$cart_rows[$i]['id'] = $row->product_id;
				$cart_rows[$i]['name'] = $row->name;
				$cart_rows[$i]['qty'] = $row->quantity;
				$cart_rows[$i]['price'] = $row->price;
				$cart_rows[$i]['unit'] = $row->unit;
				$cart_rows[$i]['options'] = array('unit' => $row->unit, 'packing_size' => $row->packing_size, 'mrp' => $row->mrp);
				$i++;
			}
			$this->cart->insert($cart_rows);
		}

		$next = array(
			'order_id'	=> $order_id,
			'next_previous_name'	=> 'next',
		);

		$previous = array(
			'order_id'	=> $order_id,
			'next_previous_name'	=> 'previous',
		);

		$this->data['next_order'] = $this->order->getOrders($this->ion_auth->get_user_id(), '', '', '', '', $next);
		
		$this->data['previous_order'] = $this->order->getOrders($this->ion_auth->get_user_id(), '', '', '', '', $previous);
		
		$this->load->render('order/view', $this->data, FALSE);
	}

	public function convert($order_id)
	{
		$order_update = array(
				'status' => 'Processing',
			);
		$depot_invoice_id = $this->query_model->save('depot_order', $order_update, $order_id);

		$this->data['title'] = 'Convert Order';

		$this->data['styles']['href'] = array(
								'components/bootgrid/jquery.bootgrid.min.css',
							);
		$this->data['scripts']['src'] = array(
    									'components/bootgrid/jquery.bootgrid.min.js',
    								);

		$this->order->loadDefs('order', 'orderConvertedListViewDefs');
    	$this->data['gridDefs'] = $this->order->orderConvertedListViewDefs;

		$order_info = $this->order->getOrder($order_id);
		
		//$order_stock_info = $this->order->checkQuantity($this->ion_auth->get_user_id(), $order_id);
		//$this->data['order_stock_info'] = $order_stock_info;
		$this->data['order'] = $order_info;
		$this->data['order_id'] = $order_id;
		
		$this->load->render('order/convert', $this->data, FALSE);
	}

	public function confirm($depot_order_id)
	{
		$json = array();
		if($this->input->post('quantity'))
		{
			$quantity = $this->input->post('quantity');
		}
		else
		{
			$quantity = array();
		}

		if(!array_filter($quantity)) 
		{
			$json['error'] = 'Please Enter Quantity';
		}
		if(!$json)
		{
			//$product_ids = join(',', array_keys($quantity));
			$product_ids_array = array_keys($quantity);
			$filter = array('product_id' => $product_ids_array);
			$this->load->model('product/product');

			$product_infos = $this->product->getAdminProductsStock($this->ion_auth->get_user_id(), '', '', '', '', $filter);

			if($product_infos)
			{
				$sufficient_product = '';
				foreach($product_infos as $product_info)
				{
					$product_quantity = $product_info->quantity;
					$simbanic_product_name = $product_info->simbanic_product_name;
					$order_quantity = $quantity[$product_info->id];
					if($product_quantity < $order_quantity)
					{
						if(isset($json['error']))
						{
							$json['error'] .= '\n';
							$json['error'] .= $simbanic_product_name;
						}
						else
						{
							$json['error'] = 'do not have sufficient quantity';
							$json['error'] .= '\n';
							$json['error'] .= $simbanic_product_name;
						}
					}
				}
				
	            if (!$json)
	            {
	            	$order_update = array(
						'status' => 'Complete',
					);
					$depot_invoice_id = $this->query_model->save('depot_order', $order_update, $depot_order_id);

					$depot_order_detail = $this->query_model->get('depot_order', $depot_order_id);
					$depot_id = $depot_order_detail->created_by;

					$this->load->model('invoice/invoice');

					$get_invoice_no = $this->invoice->getInvoiceNo($depot_id);
					if($get_invoice_no)
					{
						$invoice_no = $get_invoice_no;
					}
					else
					{
						$invoice_no = 1;
					}
					$created_by = $this->ion_auth->get_user_id();

					$invoice_data = array(
						'created_by' => $created_by,
						'depot_id' => $depot_id,
						'depot_order_id' => $depot_order_id,
						'invoice_no' => $invoice_no,
						'invoice_prefix' => INVOICE_PREFIX,
						'date_created' => CURRENT_DATETIME,
						'date_modified' => CURRENT_DATETIME,
					);
					if($this->input->post('comment'))
					{
						$invoice_data['comment'] = $this->input->post('comment');
					}
					
					$depot_invoice_id = $this->query_model->save('depot_invoice', $invoice_data);

					$delete_data = array('depot_order_id' => $depot_order_id);
					$this->query_model->delete_hard('depot_invoice_product', $delete_data);

					$invoice_product_batch = $this->invoice->getInvoiceProductBatch($quantity, $filter, $depot_order_id);
				
					$invoice_product_batch_values = array_values($invoice_product_batch);
					$invoice_product_result = array_reduce($invoice_product_batch_values, 'array_merge', array());
					$order_price = 0;

					for($i = 0; $i < count($invoice_product_result); $i++)
					{
						$order_price += $invoice_product_result[$i]['order_quantity'] * $invoice_product_result[$i]['price'];
						
						$invoice_product_result[$i]['created_by'] = $created_by;
						$invoice_product_result[$i]['depot_id'] = $depot_id;
						$invoice_product_result[$i]['depot_order_id'] = (int)$depot_order_id;
						$invoice_product_result[$i]['depot_invoice_id'] = (int)$depot_invoice_id;
						$invoice_product_result[$i]['date_created'] = CURRENT_DATETIME;
						$invoice_product_result[$i]['date_modified'] = CURRENT_DATETIME;
					}

					$this->query_model->save_multiple('depot_invoice_product', $invoice_product_result);
					$update_invoice = array('total' => $order_price);
					$this->query_model->save('depot_invoice', $update_invoice, $depot_invoice_id);
					
					$json['redirect'] = redirect_backend_url('invoice');
	            }
			}
		}
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}

	public function get_order_data()
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

		$rows = $this->order->getOrders($this->ion_auth->get_user_id(), $limit, $start, $searchPhrase);
		
		if(!isset($rows) && empty($rows))
		{
			$rows = array();
		}
		
		$json['current'] = (int)$current;
		$json['rows'] = $rows;
		$json['rowCount'] = (int)$limit;
		$json['total'] = $this->order->getOrders($this->ion_auth->get_user_id(), '', '', $searchPhrase, 'COUNT');
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}

	public function get_order_product_data($order_id)
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

		$rows = $this->order->getOrderProducts($order_id, 'depot');

		if(!isset($rows) && empty($rows))
		{
			$rows = array();
		}

		$total_count = $this->order->getOrderProducts($order_id, 'depot', '', '', '', 'COUNT');

		$json['current'] = (int)$current;
		$json['rows'] = $rows;
		$json['rowCount'] = (int)$total_count;
		$json['total'] = $total_count;
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}

	public function get_order_create_product()
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

		$rows = $this->order->getOrderCreateProducts($this->ion_auth->get_user_id(), $limit, $start, $searchPhrase);
		
		if(!isset($rows) && empty($rows))
		{
			$rows = array();
		}
		
		$json['current'] = (int)$current;
		$json['rows'] = $rows;
		$json['rowCount'] = (int)$limit;
		$json['total'] = $this->order->getOrderCreateProducts($this->ion_auth->get_user_id(), '', '', $searchPhrase, 'COUNT');
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}
}
?>