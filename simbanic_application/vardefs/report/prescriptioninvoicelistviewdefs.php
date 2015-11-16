<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$prescriptionInvoiceListViewDefs['report'] = array(

	'date' => array(
			'label' => 'Date',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'width' => '25%',
	),
	'prescription_no' => array(
			'label' => 'Prescription No',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'width' => '25%',
	),
	'full_name' => array(
			'label' => 'Given By',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'width' => '25%',
	)
);

?>