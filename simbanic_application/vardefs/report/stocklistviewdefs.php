<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$stockListViewDefs['report'] = array(

	'product_name' => array(
			'label' => 'Name',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'width' => '20%',
	),
	'opening_stock' => array(
			'label' => 'Op. Stock',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'width' => '15%',
	),
	'received_qty' => array(
			'label' => 'Received Qty',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => false,
		    'width' => '15%',
	),
	'total' => array(
			'label' => 'Total',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => true,
		    'width' => '20%',
	),
	'sell_qty' => array(
			'label' => 'Sell Qty',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => true,
		    'width' => '15%',
	),
	'closing_qty' => array(
			'label' => 'Clos. Qty',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => true,
		    'width' => '15%',
	),
	
);

?>