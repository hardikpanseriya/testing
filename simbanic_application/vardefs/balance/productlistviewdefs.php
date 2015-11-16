<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$productListViewDefs['balance'] = array(

	'id' => array(
			'label' => 'Product ID',
		    'type' => 'input',
		    'edit' => false,
		    'default' => false,
	),
	'created_by' => array(
			'label' => 'created_by',
		    'type' => 'input',
		    'edit' => false,
		    'default' => false,
	),
	'simbanic_product_name' => array(
			'label' => 'Product Name',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => true,
		    'width' => '36%',
	),
	'simba_packing_size' => array(
			'label' => 'Packing Size',
		    'type' => 'input',
		    'edit' => false,
		    'default' => false,
		    'formatter' => true,
		    'width' => '18%',
	),
	'unit' => array(
			'label' => 'Product Unit',
		    'type' => 'select',
		    'options' => array(
		    				'gm' => 'Gram',
		    				'kg' => 'Kilogram',
		    				'ml' => 'Milliliter',
		    				'ltr' => 'Liter',
		    			),
		    'edit' => false,
		    'default' => false,
		    'formatter' => true,
		    'width' => '18%',
	),
	'price' => array(
			'label' => 'Rate',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'formatter' => true,
		    'width' => '18%',
	),
	'quantity' => array(
			'label' => 'Total Quantity',
		    'type' => '',
		    'edit' => false,
		    'default' => true,
		    'formatter' => false,
		    'width' => '18%',
	),
	'product_unit' => array(
			'label' => 'Unit',
		    'type' => '',
		    'edit' => false,
		    'default' => $this->ion_auth->is_doctor() ? true : false,
		    'formatter' => false,
		    'width' => '15%',
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
	'action' => array(
			'label' => 'Action',
		    'type' => '',
		    'edit' => false,
		    'default' => $this->ion_auth->is_admin() || $this->ion_auth->is_depot() ? true : false,
		    'formatter' => true,
		    'width' => '28%',
	),
);
?>