<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$createListViewDefs['invoice'] = array(

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
	'name' => array(
			'label' => 'Product Name',
		    'type' => 'input',
		    'edit' => false,
		    'default' => false,
		    'formatter' => true,
		    'width' => '20%',
	),
	'simba_packing_size' => array(
			'label' => 'Packing Size',
		    'type' => 'input',
		    'edit' => false,
		    'default' => false,
		    'formatter' => true,
		    'width' => '15%',
	),
	'unit' => array(
			'label' => 'Product Unit',
		    'type' => 'input',
		    'edit' => false,
		    'default' => false,
		    'formatter' => true,
		    'width' => '15%',
	),
	'price' => array(
			'label' => 'Rate',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => true,
		    'width' => '15%',
	),
	'quantity' => array(
			'label' => 'Enter Product Quantity',
		    'type' => 'input',
		    'edit' => true,
		    'default' => true,
		    'formatter' => true,
		    'width' => '30%',
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

if($this->ion_auth->is_depot() || $this->ion_auth->is_customer())
{
	$createListViewDefs['invoice']['action'] = array(
					'label' => 'Action',
				    'type' => '',
				    'edit' => false,
				    'default' => true,
				    'formatter' => true,
				    'width' => '20%',
	);
}


?>