<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$dictionary['product'] = array(

	'table' => 'product',
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
		'name' => array(
				'name' => 'name',
			    'type' => 'varchar',
			    'length' => 255,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'packing_size' => array(
				'name' => 'packing_size',
			    'type' => 'varchar',
			    'length' => 255,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'unit' => array(
				'name' => 'unit',
			    'type' => 'varchar',
			    'length' => 255,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'price' => array(
				'name' => 'price',
			    'type' => 'varchar',
			    'length' => 255,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'mrp' => array(
				'name' => 'mrp',
			    'type' => 'varchar',
			    'length' => 50,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'vat' => array(
				'name' => 'vat',
			    'type' => 'varchar',
			    'length' => 50,
			    'required' => false,
			    'rule' => 'trim|required|xss_clean',
		),
		'cst' => array(
				'name' => 'cst',
			    'type' => 'varchar',
			    'length' => 50,
			    'required' => false,
			    'rule' => 'trim|required|xss_clean',
		),
		'st' => array(
				'name' => 'st',
			    'type' => 'varchar',
			    'length' => 50,
			    'required' => false,
			    'rule' => 'trim|required|xss_clean',
		),
		'gst' => array(
				'name' => 'gst',
			    'type' => 'varchar',
			    'length' => 50,
			    'required' => false,
			    'rule' => 'trim|required|xss_clean',
		),
		'octr' => array(
				'name' => 'octr',
			    'type' => 'varchar',
			    'length' => 50,
			    'required' => false,
			    'rule' => 'trim|required|xss_clean',
		),
		'excise' => array(
				'name' => 'excise',
			    'type' => 'varchar',
			    'length' => 100,
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