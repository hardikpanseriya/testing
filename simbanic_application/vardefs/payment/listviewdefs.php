<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$listViewDefs['payment'] = array(

	'id' => array(
			'label' => 'Payment ID',
		    'type' => 'input',
		    'edit' => false,
		    'default' => false,
		    'width' => '10%',
	),
	'full_name' => array(
			'label' => 'Depot Name',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'width' => '20%',
	),
	'customer_id' => array(
			'label' => 'Depot ID',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => true,
		    'width' => '10%',
	),
	'invoice_amount' => array(
			'label' => 'Turn Over',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => true,
		    'width' => '13%',
	),
	'total_payment' => array(
			'label' => $this->ion_auth->is_depot() || $this->ion_auth->is_customer() ? 'Given Payment' : 'Received Payment',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => true,
		    'width' => '15%',
	),
	'outstanding_payment' => array(
			'label' => 'Outstanding Payment',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => true,
		    'width' => '20%',
	),
	'payment_request' => array(
			'label' => 'Request',
		    'type' => '',
		    'edit' => false,
		    'default' => false,
		    'formatter' => false,
		    'width' => '12%',
	),
	'payment_received' => array(
			'label' => 'Received',
		    'type' => '',
		    'edit' => false,
		    'default' => false,
		    'formatter' => false,
		    'width' => '13%',
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