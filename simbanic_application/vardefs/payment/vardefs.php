<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$dictionary['payment'] = array(

	'table' => 'depot_payment',
	'fields' => array(
		'id' => array(
				'name' => 'id',
			    'type' => 'int',
			    'length' => 11,
			    'required' => false,
			    'rule' => '',
		),
		'depot_id' => array(
				'name' => 'depot_id',
			    'type' => 'int',
			    'length' => 11,
			    'required' => true,
			    'rule' => '',
		),
		'retailer_id' => array(
				'name' => 'retailer_id',
			    'type' => 'int',
			    'length' => 11,
			    'required' => false,
			    'rule' => '',
		),
		'created_at' => array(
				'name' => 'created_at',
			    'type' => 'varchar',
			    'length' => 100,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'amount' => array(
				'name' => 'amount',
			    'type' => 'varchar',
			    'length' => 50,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'method' => array(
				'name' => 'method',
			    'type' => 'varchar',
			    'length' => 100,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'cash_type' => array(
				'name' => 'cash_type',
			    'type' => 'varchar',
			    'length' => 255,
			    'required' => false,
			    'rule' => 'trim|required|xss_clean',
		),
		'receipt_no' => array(
				'name' => 'receipt_no',
			    'type' => 'varchar',
			    'length' => 100,
			    'required' => false,
			    'rule' => 'trim|required|xss_clean',
		),
		'cheque_no' => array(
				'name' => 'cheque_no',
			    'type' => 'varchar',
			    'length' => 50,
			    'required' => false,
			    'rule' => 'trim|required|xss_clean',
		),
		'bank_name' => array(
				'name' => 'bank_name',
			    'type' => 'varchar',
			    'length' => 255,
			    'required' => false,
			    'rule' => 'trim|required|xss_clean',
		),
		'bank_branch' => array(
				'name' => 'bank_branch',
			    'type' => 'varchar',
			    'length' => 255,
			    'required' => false,
			    'rule' => 'trim|required|xss_clean',
		),
		'transfer_id' => array(
				'name' => 'transfer_id',
			    'type' => 'varchar',
			    'length' => 100,
			    'required' => false,
			    'rule' => 'trim|required|xss_clean',
		),
		'date' => array(
				'name' => 'date',
			    'type' => 'date',
			    'length' => '',
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'confirm_date' => array(
				'name' => 'confirm_date',
			    'type' => 'date',
			    'length' => '',
			    'required' => false,
			    'rule' => 'trim|required|xss_clean',
		),
		'remark' => array(
				'name' => 'remark',
			    'type' => 'textarea',
			    'length' => '',
			    'required' => false,
			    'rule' => 'trim|required|xss_clean',
		),
		'status' => array(
				'name' => 'status',
			    'type' => 'enum',
			    'length' => '',
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'date_pending' => array(
				'name' => 'date_pending',
			    'type' => 'date',
			    'length' => '',
			    'required' => false,
			    'rule' => '',
		),
		'date_done' => array(
				'name' => 'date_done',
			    'type' => 'date',
			    'length' => '',
			    'required' => false,
			    'rule' => '',
		),
		'date_created_at' => array(
				'name' => 'date_created_at',
			    'type' => 'date',
			    'length' => '',
			    'required' => false,
			    'rule' => '',
		),
	),
);

?>