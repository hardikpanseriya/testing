<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$paymentListViewDefs['report'] = array(

	'date' => array(
		'label' => 'Date',
	    'type' => 'input',
	    'edit' => false,
	    'default' => true,
	    'width' => '15%',
	),
	'details' => array(
		'label' => 'Details',
	    'type' => 'input',
	    'edit' => false,
	    'default' => true,
	    'width' => '25%',
	),
	'debit' => array(
		'label' => 'Debit',
	    'type' => 'input',
	    'edit' => false,
	    'default' => true,
	    'formatter' => false,
	    'width' => '20%',
	),
	'credit' => array(
			'label' => 'Credit',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => true,
		    'width' => '20%',
	),
	'due_balance' => array(
			'label' => 'Due Balance',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => true,
		    'width' => '20%',
	),
);
?>