<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$productListViewDefs['invoice'] = array(

	'id' => array(
			'label' => 'Order No.',
		    'type' => 'input',
		    'edit' => false,
		    'default' => false,
	),
	'created_by' => array(
			'label' => 'created_by',
		    'type' => 'input',
		    'edit' => false,
		    'default' => false,
	),
	'product_id' => array(
			'label' => 'Product ID',
		    'type' => 'input',
		    'edit' => false,
		    'default' => false,
		    'formatter' => false,
	),
	'simbanic_product_name' => array(
			'label' => 'Product Name',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => true,
		    'width' => '20%',
	),
	'simba_packing_size' => array(
			'label' => 'Packing Size',
		    'type' => 'input',
		    'edit' => false,
		    'default' => false,
		    'formatter' => true,
		    'width' => '25%',
	),
	'batch_no' => array(
			'label' => 'Batch No.',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => false,
		    'width' => '15%',
	),
	'unit' => array(
			'label' => 'Product Unit',
		    'type' => 'input',
		    'edit' => false,
		    'default' => false,
		    'formatter' => true,
		    'width' => '20%',
	),
	'price' => array(
			'label' => 'Rate',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => true,
		    'width' => '10%',
		    'width' => '10%',
	),
	'depot_quantity' => array(
			'label' => 'Depot Quantity',
		    'type' => 'input',
		    'edit' => false,
		    'default' => false,
		    'formatter' => true,
		    'width' => '20%',
	),
	'order_quantity' => array(
			'label' => 'Quantity',
		    'type' => 'input',
		    'edit' => true,
		    'default' => true,
		    'formatter' => true,
		    'width' => '20%',
	),
	'sub_total' => array(
			'label' => 'Qty x Rate (Rs.)',
		    'type' => 'input',
		    'edit' => true,
		    'default' => true,
		    'formatter' => true,
		    'width' => '20%',
	),
	'date_created' => array(
			'label' => 'date_created',
		    'type' => 'datetime',
		    'edit' => false,
		    'default' => false,
	),
	'date_modified' => array(
			'label' => 'date_modified',
		    'type' => 'datetime',
		    'edit' => false,
		    'default' => false,
	),
);

if($this->ion_auth->is_admin() || $this->input->get_post('view') == 'customer')
{
	$productListViewDefs['invoice']['action'] = array(
					'label' => 'Action',
				    'type' => '',
				    'edit' => false,
				    'default' => true,
				    'formatter' => true,
	);
}

?>