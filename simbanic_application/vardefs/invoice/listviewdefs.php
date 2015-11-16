<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$listViewDefs['invoice'] = array(

	'id' => array(
			'label' => 'Invoice No.',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
	),
	'created_by' => array(
			'label' => 'Order By',
		    'type' => 'input',
		    'edit' => false,
		    'default' => false,
	),
	'invoice_no' => array(
			'label' => 'Invoice No.',
		    'type' => 'input',
		    'edit' => false,
		    'default' => false,
	),
	'full_name' => array(
			'label' => $this->ion_auth->is_customer() ? 'Depot Name' : 'Full Name',
		    'type' => 'input',
		    'edit' => false,
		    'default' => $this->ion_auth->is_admin() || $this->ion_auth->is_customer() || $this->uri->segment(2) == 'customer' ? true : false,
	),
	'comment' => array(
			'label' => 'Comment',
		    'type' => 'textarea',
		    'edit' => false,
		    'default' => false,
		    'formatter' => false,
	),
	'invoice_total' => array(
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
		    'default' => false,
		    'formatter' => true,
	),
	'confirm' => array(
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