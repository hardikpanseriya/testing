<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$dictionary['pharma'] = array(

	'table' => 'customer',
	'fields' => array(
		'id' => array(
				'name' => 'id',
			    'type' => 'int',
			    'length' => 11,
			    'required' => false,
			    'rule' => '',
		),
		'user_id' => array(
				'name' => 'user_id',
			    'type' => 'int',
			    'length' => 11,
			    'required' => false,
			    'rule' => '',
		),
		'created_by' => array(
				'name' => 'created_by',
			    'type' => 'int',
			    'length' => 11,
			    'required' => true,
			    'rule' => '',
		),
		'customer_id' => array(
				'name' => 'customer_id',
			    'type' => 'varchar',
			    'length' => 50,
			    'required' => false,
			    'rule' => '',
		),
		'customer_type' => array(
				'name' => 'customer_type',
			    'type' => 'enum',
			    'length' => '',
			    'required' => false,
			    'rule' => 'trim|required|xss_clean',
		),
		'full_name' => array(
				'name' => 'full_name',
			    'type' => 'varchar',
			    'length' => 255,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'first_name' => array(
				'name' => 'first_name',
			    'type' => 'varchar',
			    'length' => 255,
			    'required' => false,
			    'rule' => 'trim|required|xss_clean',
		),
		'middle_name' => array(
				'name' => 'middle_name',
			    'type' => 'varchar',
			    'length' => 255,
			    'required' => false,
			    'rule' => 'trim|required|xss_clean',
		),
		'last_name' => array(
				'name' => 'last_name',
			    'type' => 'varchar',
			    'length' => 255,
			    'required' => false,
			    'rule' => 'trim|required|xss_clean',
		),
		'email' => array(
				'name' => 'email',
			    'type' => 'varchar',
			    'length' => 255,
			    'required' => false,
			    'rule' => 'trim|required|xss_clean|valid_email',
		),
		'password' => array(
				'name' => 'password',
			    'type' => 'varchar',
			    'length' => 255,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'mobile_no' => array(
				'name' => 'mobile_no',
			    'type' => 'varchar',
			    'length' => 255,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean|numeric|min_length[10]|max_length[10]',
		),
		'gender' => array(
				'name' => 'gender',
			    'type' => 'varchar',
			    'length' => 10,
			    'required' => true,
			    'rule' => 'required',
		),
		'dob' => array(
				'name' => 'dob',
			    'type' => 'date',
			    'length' => '',
			    'required' => true,
			    'rule' => 'required',
		),
		'home_address' => array(
				'name' => 'home_address',
			    'type' => 'text',
			    'length' => '',
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'work_address' => array(
				'name' => 'work_address',
			    'type' => 'text',
			    'length' => '',
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'home_street1' => array(
				'name' => 'home_street1',
			    'type' => 'varchar',
			    'length' => 255,
			    'required' => false,
			    'rule' => 'trim|required|xss_clean',
		),
		'home_street2' => array(
				'name' => 'home_street2',
			    'type' => 'varchar',
			    'length' => 255,
			    'required' => false,
			    'rule' => 'trim|required|xss_clean',
		),
		'home_state' => array(
				'name' => 'home_state',
			    'type' => 'varchar',
			    'length' => 50,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'home_district' => array(
				'name' => 'home_district',
			    'type' => 'varchar',
			    'length' => 50,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'home_taluka' => array(
				'name' => 'home_taluka',
			    'type' => 'varchar',
			    'length' => 50,
			    'required' => false,
			    'rule' => 'trim|required|xss_clean',
		),
		'home_city' => array(
				'name' => 'home_city',
			    'type' => 'varchar',
			    'length' => 50,
			    'required' => false,
			    'rule' => 'trim|required|xss_clean',
		),
		'home_area' => array(
				'name' => 'home_area',
			    'type' => 'varchar',
			    'length' => 50,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'refer_to' => array(
				'name' => 'refer_to',
			    'type' => 'varchar',
			    'length' => 255,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'marriage_anni' => array(
				'name' => 'marriage_anni',
			    'type' => 'varchar',
			    'length' => 255,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'designation' => array(
				'name' => 'designation',
			    'type' => 'varchar',
			    'length' => 255,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'pancard_no' => array(
				'name' => 'pancard_no',
			    'type' => 'varchar',
			    'length' => 100,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'blood_group' => array(
				'name' => 'blood_group',
			    'type' => 'varchar',
			    'length' => 20,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'nominee' => array(
				'name' => 'nominee',
			    'type' => 'varchar',
			    'length' => 255,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'nominee_relation' => array(
				'name' => 'nominee_relation',
			    'type' => 'varchar',
			    'length' => 100,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'nominee_dob' => array(
				'name' => 'nominee_dob',
			    'type' => 'date',
			    'length' => '',
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'income' => array(
				'name' => 'income',
			    'type' => 'varchar',
			    'length' => 100,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'payment' => array(
				'name' => 'payment',
			    'type' => 'varchar',
			    'length' => 255,
			    'required' => false,
			    'rule' => 'trim|required|xss_clean',
		),
		'bank_name' => array(
				'name' => 'bank_name',
			    'type' => 'varchar',
			    'length' => 255,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'account_no' => array(
				'name' => 'account_no',
			    'type' => 'varchar',
			    'length' => 100,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'ifsc_code' => array(
				'name' => 'ifsc_code',
			    'type' => 'varchar',
			    'length' => 50,
			    'required' => true,
			    'rule' => 'trim|required|xss_clean',
		),
		'transportation' => array(
				'name' => 'transportation',
			    'type' => 'varchar',
			    'length' => 255,
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