<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$productListViewDefs['order'] = array(

	'id' => array(
			'label' => 'Order No.',
		    'type' => 'input',
		    'edit' => false,
		    'default' => false,
	),
	'order_by' => array(
			'label' => 'order_by',
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
		    'width' => '30%',
	),
	
	'simba_packing_size' => array(
			'label' => 'Packing Size',
		    'type' => 'input',
		    'edit' => false,
		    'default' => false,
		    'formatter' => true,
		    'width' => '10%',
	),
	'unit' => array(
			'label' => 'Product Unit',
		    'type' => 'input',
		    'edit' => false,
		    'default' => false,
		    'formatter' => true,
		    'width' => '10%',
	),
	'price' => array(
			'label' => 'Rate',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => true,
		    'width' => '10%',
	),
	'quantity' => array(
			'label' => 'Enter Product Quantity',
		    'type' => 'input',
		    'edit' => true,
		    'default' => true,
		    'formatter' => true,
		    'width' => '40%',
	),
	'action' => array(
			'label' => 'Action',
		    'type' => '',
		    'edit' => false,
		    'default' => true,
		    'formatter' => true,
		    'width' => '10%',
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
?>