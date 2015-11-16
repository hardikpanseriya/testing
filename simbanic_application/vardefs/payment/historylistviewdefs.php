<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$historyListViewDefs['payment'] = array(

	'id' => array(
			'label' => 'ID',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'width' => '5%',
	),
	'depot_customer_id' => array(
			'label' => 'Depot ID',
		    'type' => 'input',
		    'edit' => false,
		    'default' => false,
		    'width' => '10%',
	),
	'amount' => array(
			'label' => 'Amount',
		    'type' => 'input',
		    'edit' => true,
		    'default' => true,
		    'formatter' => true,
		    'width' => '15%',
	),
	'method' => array(
			'label' => 'Method',
			'type' => 'select',
			'options' => array(
		    				'Cash' => 'Cash',
		    				'Cheque' => 'Cheque',
		    				'NEFT' => 'NEFT',
		    			),
		    'edit' => true,
		    'default' => true,
		    'formatter' => true,
		    'width' => '15%',
	),
	'status' => array(
			'label' => 'Status',
		    'type' => 'select',
		    'edit' => true,
		    'default' => true,
		    'formatter' => true,
		    'width' => '15%',
	),
	'date' => array(
			'label' => 'Release Date',
		    'type' => 'datetime',
		    'edit' => false,
		    'default' => true,
		    'formatter' => true,
		    'width' => '15%',
	),
	'confirm_date' => array(
			'label' => 'Confirm Date',
		    'type' => 'datetime',
		    'edit' => false,
		    'default' => true,
		    'formatter' => true,
		    'width' => '15%',
	),
	'action' => array(
			'label' => 'Action',
		    'type' => '',
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

if($this->ion_auth->is_admin())
{
	$historyListViewDefs['payment']['status']['options'] = array(
					'Pending' => 'Pending',
    				'Done' => 'Done',
	);
}
elseif($this->ion_auth->is_depot())
{
	$historyListViewDefs['payment']['status']['options'] = array(
					'Pending' => 'Pending',
	);
}
?>