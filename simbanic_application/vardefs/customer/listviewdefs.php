<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$listViewDefs['customer'] = array(

	'id' => array(
			'label' => 'ID',
		    'type' => 'input',
		    'edit' => false,
		    'default' => false,
	),
	'created_by' => array(
			'label' => 'Created By',
		    'type' => 'input',
		    'edit' => false,
		    'default' => false,
	),
	'customer_id' => array(
			'label' => 'Customer ID',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => false,
		    'width' => '15%',
	),
	'full_name' => array(
			'label' => 'Customer Name',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => false,
		    'width' => '20%',
	),
	'sponsor_id' => array(
			'label' => 'Sponsor ID',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => false,
		    'width' => '15%',
	),
	'mobile_no' => array(
			'label' => 'Mobile No.',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'width' => '15%',
	),
	'customer_type' => array(
			'label' => 'Customer Type',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'width' => '15%',
		    'formatter' => true,
	),
	'action' => array(
			'label' => 'Action',
		    'type' => 'input',
		    'edit' => false,
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

?>