<?php

require_once(APPPATH . 'controllers/' . BACKEND . '/simba_backend_controller.php');

class Cart_Controller extends Simba_Backend_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
	}

	public function index()
	{
		
	}

	public function info()
	{
		$cart_json = array();
		$cart_rows = array();

		if ($this->input->get_post('current'))
		{
			$current = (int)$_REQUEST['current'];
		}
		else
		{
			$current = 1;
		}

		if ($this->input->get_post('searchPhrase'))
		{
			$searchPhrase = $this->input->get_post('searchPhrase');
		}
		else
		{
			$searchPhrase = '';
		}
		
		$i = 0;
		foreach ($this->cart->contents() as $cart_items)
		{
			$cart_rows[$i]['id'] = $cart_items['id'];
			$cart_rows[$i]['name'] = $cart_items['name'];
			$cart_rows[$i]['quantity'] = $cart_items['qty'];
			$cart_rows[$i]['price'] = $cart_items['price'];	
			$cart_rows[$i]['rowid'] = $cart_items['rowid'];
			$cart_rows[$i]['subtotal'] = $cart_items['subtotal'];

			if ($this->cart->has_options($cart_items['rowid']) == TRUE)
			{
				foreach ($this->cart->product_options($cart_items['rowid']) as $option_name => $option_value)
				{
					$cart_rows[$i][$option_name] = $option_value;
				}
			}
			if(isset($cart_rows[$i]['unit']))
			{
				if(isset($cart_rows[$i]['packing_size']))
				{
					$cart_rows[$i]['simba_packing_size'] = $cart_rows[$i]['packing_size'] . ' ' . $cart_rows[$i]['unit'];
				}
				else
				{
					$cart_rows[$i]['simba_packing_size'] = $cart_rows[$i]['unit'];
				}
				$cart_rows[$i]['simbanic_product_name'] = $cart_rows[$i]['name'] . ' ' . $cart_rows[$i]['simba_packing_size'];
			}
			$i++;
		}

		$cart_count  = count($this->cart->contents());
		if($cart_count > 0)
		{
			//$cart_rows[$cart_count]['name'] = '<span class="cart_total">Total</span>';
			//$cart_rows[$cart_count]['quantity'] = $this->cart->total_items();
			$cart_rows[$cart_count]['price'] = 'Total Rs.';
			$cart_rows[$cart_count]['subtotal'] = $this->cart->total();
		}
		
		$cart_json['current'] = (int)$current;
		$cart_json['rows'] = $cart_rows;
		$cart_json['rowCount'] = (int)$cart_count;
		$cart_json['total'] = (int)$cart_count;

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($cart_json));
	}

	public function add()
	{
		$json = array();

		if ($this->input->post('product_id'))
		{
			$product_id = (int)$this->input->post('product_id');
		}
		else
		{
			$product_id = 0;
		}

		if ($this->input->post('quantity'))
		{
			$quantity = (float)$this->input->post('quantity');
		}
		else 
		{
			$quantity = 0;
		}

		if(!empty($product_id) && !empty($quantity) && is_numeric($product_id) && is_numeric($quantity))
		{
			$product_info = $this->query_model->get('product', $product_id);
			if($product_info)
			{
				$product_name = $product_info->name;
				$product_price = $product_info->price;
				$product_unit = $product_info->unit;
				$packing_size = $product_info->packing_size;
				$mrp = $product_info->mrp;

				$cart_data = array(
	               'id'      => $product_id,
	               'qty'     => $quantity,
	               'price'   => $product_price,
	               'name'    => $product_name,
	               'options' => array('unit' => $product_unit, 'packing_size' => $packing_size, 'mrp' => $mrp),
	            );

				$this->cart->insert($cart_data);

				$json['success'] = 'You have added <b>'. $product_name .'</b> to your order!';
			}
			else
			{
				$json['redirect'] = '/';
			}
		}
		else
		{
			$json['error'] = 'Please Enter numeric value!';
		}
		//var_dump($this->cart->contents());
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}

	public function update()
	{
		$json = array();

		if ($this->input->post('rowid'))
		{
			$rowid = $this->input->post('rowid');
		}
		else
		{
			$rowid = 0;
		}

		if ($this->input->post('qty'))
		{
			$qty = $this->input->post('qty');
		}
		else
		{
			$qty = 0;
		}

		$update_data = array(
        	'rowid' => $rowid,
        	'qty'   => $qty,
        );

        $this->cart->update($update_data);

        $this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}

	public function save()
	{
		$json = array();

		if($this->cart->contents())
		{
			$user_id = $this->ion_auth->get_user_id();
			if($this->input->post('order_type') == 'retailer')
			{
				$this->load->model('product/product');

				$cart_array = array();
				$l = 0;
				$product_ids = '';
				foreach ($this->cart->contents() as $check_cart_items)
				{
					$cart_array[$check_cart_items['id']]['product_id'] = $check_cart_items['id'];
					$cart_array[$check_cart_items['id']]['quantity'] = $check_cart_items['qty'];
					$product_ids .= $check_cart_items['id'] . ',';
					$l++;
				}
				$exp_product_ids = explode(",", $product_ids);
				$filter = array('product_id' => $exp_product_ids);
				$product_infos = $this->product->getDepotProductsStock($user_id, '', '', '', '', $filter);

				$sufficient_product = '';
				$p = 0;
				foreach($product_infos as $product_stock)
				{
					$stock_product_id = $product_stock->product_id;
					$stock_quantity = $product_stock->quantity;
					$cart_quantity = $cart_array[$stock_product_id]['quantity'];
					if($stock_quantity < $cart_quantity)
					{
						$sufficient_product .= "\n";
						$sufficient_product .= $product_stock->simbanic_product_name;
						$p++;
					}
				}
				if(!empty($sufficient_product))
				{
					$sufficient_message = 'do not have sufficient quantity' . $sufficient_product;
					$json['error'] = $sufficient_message;
					echo json_encode($json);
					exit();
				}
			}

			$cart_order = array(
				'total' => $this->cart->total(),
				'date_created' => CURRENT_DATETIME,
				'date_modified' => CURRENT_DATETIME,
			);
			if ($this->input->post('comment'))
			{
				$cart_order['comment'] = $this->input->post('comment');
			}
			if ($this->input->post('order_id'))
			{
				$order_id = $this->input->post('order_id');
				$delete_data = array('depot_order_id' => $order_id);
				$this->query_model->delete_hard('depot_order_product', $delete_data);
			}
			else
			{
				$cart_order['created_by'] = $user_id;
				$order_id = NULL;
			}
			if ($this->input->post('retailer_id'))
			{
				$cart_order['retailer_id'] = $this->input->post('retailer_id');
				$cart_order['status'] = 'Complete';
			}

			if($this->input->post('order_type') == 'retailer')
			{
				$order_table_name = 'retailer_order';
				$order_product_table_name = 'retailer_order_product';
			}
			else
			{
				$order_table_name = 'depot_order';
				$order_product_table_name = 'depot_order_product';
			}

			$order_id = $this->query_model->save($order_table_name, $cart_order, $order_id);

			$i = 0;
			$cart_save = array();
			foreach ($this->cart->contents() as $cart_items)
			{
				$cart_save[$i] = array(
					'created_by' => $user_id,
					'product_id' => (int)$cart_items['id'],
					'name' => $cart_items['name'],
					'price' => $cart_items['price'],
					'quantity' => (int)$cart_items['qty'],
					'date_created' => CURRENT_DATETIME,
					'date_modified' => CURRENT_DATETIME,
				);
				$quantity[(int)$cart_items['id']] = (int)$cart_items['qty'];
				//$filter[$i] = (int)$cart_items['id'];
				if($this->input->post('order_type') == 'retailer' && isset($order_id))
				{
					$cart_save[$i]['retailer_order_id'] = $order_id;
				}
				else
				{
					$cart_save[$i]['depot_order_id'] = $order_id;
				}

				if ($this->cart->has_options($cart_items['rowid']) == TRUE)
				{
					foreach ($this->cart->product_options($cart_items['rowid']) as $option_name => $option_value)
					{
						$cart_save[$i][$option_name] = $option_value;
					}
				}
				$i++;
			}
			
			$this->query_model->save_multiple($order_product_table_name, $cart_save);

			if($this->input->post('order_type') == 'retailer')
			{
				$cart_order['retailer_order_id'] = $order_id;
				unset($cart_order['status']);
				
				$this->load->model('invoice/invoice');
				$get_invoice_no = $this->invoice->getInvoiceNo($this->input->post('retailer_id'));
				if($get_invoice_no)
				{
					$cart_order['invoice_no'] = $get_invoice_no;
				}
				else
				{
					$cart_order['invoice_no'] = 1;
				}

				$retailer_invoice_id = $this->query_model->save('retailer_invoice', $cart_order);

				$invoice_product_batch = $this->invoice->getInvoiceProductBatch($quantity, $filter, $order_id);
				
				if(!empty($invoice_product_batch))
				{
					$invoice_product_batch_values = array_values($invoice_product_batch);
					$invoice_product_result = array_reduce($invoice_product_batch_values, 'array_merge', array());
					$order_price = 0;

					for($i = 0; $i < count($invoice_product_result); $i++)
					{
						$order_price += $invoice_product_result[$i]['order_quantity'] * $invoice_product_result[$i]['price'];
						
						$invoice_product_result[$i]['created_by'] = $user_id;
						$invoice_product_result[$i]['retailer_id'] = $this->input->post('retailer_id');
						$invoice_product_result[$i]['retailer_order_id'] = (int)$order_id;
						$invoice_product_result[$i]['retailer_invoice_id'] = (int)$retailer_invoice_id;
						$invoice_product_result[$i]['date_created'] = CURRENT_DATETIME;
						$invoice_product_result[$i]['date_modified'] = CURRENT_DATETIME;
					}
					
					$this->query_model->save_multiple('retailer_invoice_product', $invoice_product_result);
					$update_invoice = array('total' => $order_price);
					$this->query_model->save('retailer_invoice', $update_invoice, $retailer_invoice_id);
				}
			}
			
			$this->cart->destroy();
			$json['success'] = 'Your Order has been Placed!';
		}
		else
		{
			$json['error'] = 'Please add product in order';
		}

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($json));
	}
}
?>