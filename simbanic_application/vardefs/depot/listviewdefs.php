<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$listViewDefs['depot'] = array(

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
	'full_name' => array(
			'label' => 'Depot Name',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => false,
		    'width' => '25%',
	),
	'customer_id' => array(
			'label' => 'Depot ID',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => false,
		    'width' => '25%',
	),
	'sponsor_id' => array(
			'label' => 'Sponsor ID',
		    'type' => 'input',
		    'edit' => false,
		    'default' => false,
		    'formatter' => false,
		    'width' => '20%',
	),
	'mobile_no' => array(
			'label' => 'Mobile No.',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'width' => '25%',
	),
	'action' => array(
			'label' => 'Action',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
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