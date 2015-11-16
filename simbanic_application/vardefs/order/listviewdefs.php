<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$listViewDefs['order'] = array(

	'id' => array(
			'label' => 'Order No.',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
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
		    'default' => $this->ion_auth->is_admin() ? true : false,
	),
	'comment' => array(
			'label' => 'Comment',
		    'type' => 'textarea',
		    'edit' => false,
		    'default' => false,
		    'formatter' => false,
	),
	'total' => array(
			'label' => 'Total Rs.',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => false,
	),
	'date' => array(
			'label' => 'Date',
		    'type' => 'datetime',
		    'edit' => false,
		    'default' => true,
	),
	'status' => array(
			'label' => 'Status',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => true,
	),
	'action' => array(
			'label' => 'Action',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => true,
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