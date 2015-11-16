<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$listViewDefs['report'] = array(

	'customer_id' => array(
			'label' => 'Customer ID',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'width' => '20%',
	),
	'full_name' => array(
			'label' => 'Customer Name',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => false,
		    'width' => '20%',
	),
	'stage1' => array(
			'label' => 'Stage1',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => true,
		    'width' => '10%',
	),
	'stage2' => array(
			'label' => 'Stage2',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => true,
		    'width' => '10%',
	),
	'stage3' => array(
			'label' => 'Stage3',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => true,
		    'width' => '10%',
	),
	'stage4' => array(
			'label' => 'Stage4',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => true,
		    'width' => '10%',
	),
	'total_pay' => array(
			'label' => 'Total Pay',
		    'type' => '',
		    'edit' => false,
		    'default' => true,
		    'formatter' => true,
		    'width' => '20%',
	),
);

?>