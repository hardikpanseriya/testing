<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$prescriptionListViewDefs['report'] = array(

	'product_name' => array(
			'label' => 'Product Name',
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'width' => '25%',
	)
);
$this->load->model('customer/customer');
$user_id = $this->ion_auth->get_user_id();
$users = $this->customer->getRelatedCustomers($user_id); 
foreach($users as $customer)
{
	$retailer_id = $customer->user_id;
	if ($user_id != $retailer_id) 
	{
		$prescriptionListViewDefs['report'][$retailer_id] = array(
			'label' => $customer->full_name,
		    'type' => 'input',
		    'edit' => false,
		    'default' => true,
		    'width' => '30%',
		);
	}
}

?>