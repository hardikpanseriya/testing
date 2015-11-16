<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$listViewDefs['stock'] = array(

	'id' => array(
			'label' => 'Stock ID',
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
	'name' => array(
			'label' => 'Product Name',
		    'type' => 'input',
		    'edit' => false,
		    'default' => false,
		    'formatter' => false,
	),
	'batch_no' => array(
			'label' => 'Batch No.',
		    'type' => 'input',
		    'edit' => true,
		    'default' => true,
		    'formatter' => true,
		    'width' => '25%',
	),
	'quantity' => array(
			'label' => 'Total Quantity',
		    'type' => 'input',
		    'edit' => true,
		    'default' => true,
		    'formatter' => true,
		    'width' => '15%',
	),
	'expiry_date' => array(
			'label' => 'Expiry Date',
		    'type' => 'input',
		    'edit' => true,
		    'default' => true,
		    'formatter' => true,
		    'width' => '25%',
	),
	'remaining_quantity' => array(
			'label' => 'Remaining Qty',
		    'type' => 'input1',
		    'edit' => true,
		    'default' => true,
		    'formatter' => true,
		    'width' => '15%',
	),
	'action' => array(
			'label' => 'Action',
		    'type' => '',
		    'edit' => false,
		    'default' => $this->ion_auth->is_admin() ? true : false,
		    'formatter' => true,
		    'width' => '25%',
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