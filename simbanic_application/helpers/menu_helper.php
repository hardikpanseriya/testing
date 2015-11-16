<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

if( !function_exists('activate_menu') )
{
	function activate_menu($controller)
	{
    	// Getting CI class instance.
    	$CI = get_instance();
	    // Getting router class to active.
	    $class = $CI->router->fetch_class();
	    return ($class == $controller) ? 'active' : '';
  	}
}

if( !function_exists('admin_menu') )
{
	function admin_menu()
	{
		$admin_menu['Create Customer'] = array(
							'href' => redirect_backend_url('customer/create'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$admin_menu['Customer List'] = array(
							'href' => redirect_backend_url('customer'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$admin_menu['Create Depot'] = array(
							'href' => redirect_backend_url('depot/create'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$admin_menu['Depot List'] = array(
							'href' => redirect_backend_url('depot'),
							'icon_class' => 'fa fa-table fa-fw',
						);
		
		/*$admin_menu['Pharma'] = array(
							'href' => redirect_backend_url('pharma'),
							'icon_class' => 'fa fa-table fa-fw',
						);*/

		$admin_menu['Product Stock'] = array(
							'href' => redirect_backend_url('product'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$admin_menu['Order List'] = array(
							'href' => redirect_backend_url('order'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$admin_menu['Depot Invoice List'] = array(
							'href' => redirect_backend_url('invoice'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$admin_menu['Depot Payment'] = array(
							'href' => redirect_backend_url('payment'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$report['Report'] = array(
							'href' => redirect_backend_url('report'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$report['Report By Stock'] = array(
							'href' => redirect_backend_url('report/stock'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$report['Report By Payment'] = array(
							'href' => redirect_backend_url('report/payment'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$admin_menu['Tree'] = array(
							'href' => redirect_backend_url('customer/tree'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$admin_menu['Change Password'] = array(
							'href' => redirect_backend_url('auth/change_password'),
							'icon_class' => 'fa fa-table fa-fw',
						);
		
		$menu = '';
		foreach($admin_menu as $key => $value)
		{
			$menu .= '<li>';
			$menu .= '<a href="'. $value['href'] .'">';
			//$menu .= '<i class="'. $value['icon_class'] .'"></i>';
			$menu .= $key;
			$menu .= '</a>';
			$menu .= '</li>';
		}
		$menu .= '<li style="background: #26a69a;"><a style="color:#FFF;">Report</a></li>';
		foreach($report as $key => $value)
		{
			$menu .= '<li>';
			$menu .= '<a href="'. $value['href'] .'">';
			//$menu .= '<i class="'. $value['icon_class'] .'"></i>';
			$menu .= $key;
			$menu .= '</a>';
			$menu .= '</li>';
		}
		return $menu;
  	}
}

if( !function_exists('doctor_menu') )
{
	function doctor_menu()
	{
		$customer_menu['Product Purchase'] = array(
				'href' => redirect_backend_url('product'),
				'icon_class' => 'fa fa-table fa-fw',
			);

		$customer_menu['Balance By Prescription'] = array(
				'href' => redirect_backend_url('balance/prescription'),
				'icon_class' => 'fa fa-table fa-fw',
			);
		
		$customer_menu['Invoice List'] = array(
							'href' => redirect_backend_url('invoice'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$report['Report By Stock'] = array(
							'href' => redirect_backend_url('report/stock'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$report['Report By Payment'] = array(
							'href' => redirect_backend_url('report/payment'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$report['Report By Prescription'] = array(
				'href' => redirect_backend_url('report/prescription'),
				'icon_class' => 'fa fa-table fa-fw',
			);

		$report['Report By Prescription Invoice'] = array(
				'href' => redirect_backend_url('report/prescription/invoice'),
				'icon_class' => 'fa fa-table fa-fw',
			);

		$report['My Balance'] = array(
							'href' => redirect_backend_url('report'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$customer_menu['Tree'] = array(
							'href' => redirect_backend_url('customer/tree'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$customer_menu['Depot Payment'] = array(
							'href' => redirect_backend_url('payment/customer'),
							'icon_class' => 'fa fa-table fa-fw',
						);
		
		$customer_menu['View Profile'] = array(
							'href' => redirect_backend_url('profile'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$customer_menu['Change Password'] = array(
							'href' => redirect_backend_url('auth/change_password'),
							'icon_class' => 'fa fa-table fa-fw',
						);
		
		$menu = '';
		foreach($customer_menu as $key => $value)
		{
			$menu .= '<li>';
			$menu .= '<a href="'. $value['href'] .'">';
			$menu .= '<i class="'. $value['icon_class'] .'"></i>';
			$menu .= $key;
			$menu .= '</a>';
			$menu .= '</li>';
		}
		$menu .= '<li style="background: #26a69a;"><a style="color:#FFF;">Report</a></li>';
		foreach($report as $key => $value)
		{
			$menu .= '<li>';
			$menu .= '<a href="'. $value['href'] .'">';
			//$menu .= '<i class="'. $value['icon_class'] .'"></i>';
			$menu .= $key;
			$menu .= '</a>';
			$menu .= '</li>';
		}
		return $menu;
  	}
}

if( !function_exists('medical_store_menu') )
{
	function medical_store_menu()
	{
		$customer_menu['Product Stock'] = array(
				'href' => redirect_backend_url('product'),
				'icon_class' => 'fa fa-table fa-fw',
			);
		
		$customer_menu['Invoice List'] = array(
							'href' => redirect_backend_url('invoice'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$report['Report By Stock'] = array(
							'href' => redirect_backend_url('report/stock'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$report['Report By Payment'] = array(
							'href' => redirect_backend_url('report/payment'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$report['Report By Prescription'] = array(
				'href' => redirect_backend_url('report/prescription'),
				'icon_class' => 'fa fa-table fa-fw',
			);

		$report['Report By Prescription Invoice'] = array(
				'href' => redirect_backend_url('report/prescription/invoice'),
				'icon_class' => 'fa fa-table fa-fw',
			);

		$report['My Balance'] = array(
							'href' => redirect_backend_url('report'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$customer_menu['Tree'] = array(
							'href' => redirect_backend_url('customer/tree'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$customer_menu['Depot Payment'] = array(
							'href' => redirect_backend_url('payment/customer'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		
		
		$customer_menu['View Profile'] = array(
							'href' => redirect_backend_url('profile'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$customer_menu['Change Password'] = array(
							'href' => redirect_backend_url('auth/change_password'),
							'icon_class' => 'fa fa-table fa-fw',
						);
		
		$menu = '';
		foreach($customer_menu as $key => $value)
		{
			$menu .= '<li>';
			$menu .= '<a href="'. $value['href'] .'">';
			$menu .= '<i class="'. $value['icon_class'] .'"></i>';
			$menu .= $key;
			$menu .= '</a>';
			$menu .= '</li>';
		}
		$menu .= '<li style="background: #26a69a;"><a style="color:#FFF;">Report</a></li>';
		foreach($report as $key => $value)
		{
			$menu .= '<li>';
			$menu .= '<a href="'. $value['href'] .'">';
			//$menu .= '<i class="'. $value['icon_class'] .'"></i>';
			$menu .= $key;
			$menu .= '</a>';
			$menu .= '</li>';
		}
		return $menu;
  	}
}

if( !function_exists('depot_menu') )
{
	function depot_menu()
	{
		$depot_menu_company['Product Stock'] = array(
							'href' => redirect_backend_url('product'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$depot_menu_company['Company Invoice List'] = array(
							'href' => redirect_backend_url('invoice'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$depot_menu_company['Create Order'] = array(
							'href' => redirect_backend_url('order/create'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$depot_menu_company['Order List'] = array(
							'href' => redirect_backend_url('order'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$depot_menu_customer['Make Customer Invoice'] = array(
							'href' => redirect_backend_url('invoice/create'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$depot_menu_customer['Customer Invoice List'] = array(
							'href' => redirect_backend_url('invoice/customer'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$depot_menu_customer['Customer Payment'] = array(
							'href' => redirect_backend_url('payment/customer'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$depot_menu_company['Company Payment'] = array(
							'href' => redirect_backend_url('payment'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$report['Report By Stock'] = array(
							'href' => redirect_backend_url('report/stock'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$report['Report By Payment'] = array(
							'href' => redirect_backend_url('report/payment'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$report['Report By Payment Area'] = array(
							'href' => redirect_backend_url('report/payment/area'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		$depot_menu_customer['View Profile'] = array(
							'href' => redirect_backend_url('profile'),
							'icon_class' => 'fa fa-table fa-fw',
						);
		$depot_menu_customer['Change Password'] = array(
							'href' => redirect_backend_url('auth/change_password'),
							'icon_class' => 'fa fa-table fa-fw',
						);

		
		
		$menu = '<li style="background: #26a69a;"><a style="color:#FFF;">For Company</a></li>';
		foreach($depot_menu_company as $key => $value)
		{
			$menu .= '<li>';
			$menu .= '<a href="'. $value['href'] .'">';
			//$menu .= '<i class="'. $value['icon_class'] .'"></i>';
			$menu .= $key;
			$menu .= '</a>';
			$menu .= '</li>';
		}
		$menu .= '<li style="background: #26a69a;"><a style="color:#FFF;">For Customer</a></li>';
		foreach($depot_menu_customer as $key => $value)
		{
			$menu .= '<li>';
			$menu .= '<a href="'. $value['href'] .'">';
			//$menu .= '<i class="'. $value['icon_class'] .'"></i>';
			$menu .= $key;
			$menu .= '</a>';
			$menu .= '</li>';
		}
		$menu .= '<li style="background: #26a69a;"><a style="color:#FFF;">Report</a></li>';
		foreach($report as $key => $value)
		{
			$menu .= '<li>';
			$menu .= '<a href="'. $value['href'] .'">';
			//$menu .= '<i class="'. $value['icon_class'] .'"></i>';
			$menu .= $key;
			$menu .= '</a>';
			$menu .= '</li>';
		}
		return $menu;
  	}
}

if( !function_exists('pharma_menu') )
{
	function pharma_menu()
	{
		$pharma_menu['Product'] = array(
							'href' => redirect_backend_url('product'),
							'icon_class' => 'fa fa-table fa-fw',
						);
		
		$pharma_menu['Invoice'] = array(
							'href' => redirect_backend_url('invoice'),
							'icon_class' => 'fa fa-table fa-fw',
						);
		
		$menu = '';
		foreach($pharma_menu as $key => $value)
		{
			$menu .= '<li>';
			$menu .= '<a href="'. $value['href'] .'">';
			$menu .= '<i class="'. $value['icon_class'] .'"></i>';
			$menu .= $key;
			$menu .= '</a>';
			$menu .= '</li>';
		}
		return $menu;
  	}
}

?>