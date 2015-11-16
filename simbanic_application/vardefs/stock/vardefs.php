<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$dictionary['stock'] = array(

	'table' => 'stock',
	'fields' => array(
		'id' => array(
				'name' => 'id',
			    'type' => 'int',
			    'length' => 11,
			    'required' => false,
			    'rule' => '',
		),
		'created_by' => array(
				'name' => 'created_by',
			    'type' => 'int',
			    'length' => 11,
			    'required' => false,
			    'rule' => '',
		),
		'product_id' => array(
				'name' => 'product_id',
			    'type' => 'int',
			    'length' => 11,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'batch_no' => array(
				'name' => 'batch_no',
			    'type' => 'varchar',
			    'length' => 255,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'quantity' => array(
				'name' => 'quantity',
			    'type' => 'varchar',
			    'length' => 255,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean|numeric',
		),
		'expiry_date' => array(
				'name' => 'quantity',
			    'type' => 'date',
			    'length' => '',
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'date_created' => array(
				'name' => 'date_created',
			    'type' => 'date',
			    'length' => '',
			    'required' => false,
			    'rule' => '',
		),
		'date_modified' => array(
				'name' => 'date_modified',
			    'type' => 'date',
			    'length' => '',
			    'required' => false,
			    'rule' => '',
		),
	),
);

?>