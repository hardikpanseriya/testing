<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "backend/auth/index";
$route['404_override'] = '';

// auth
$route['auth'] = "backend/auth/index";
$route['auth/login'] = "backend/auth/login";
$route['auth/logout'] = "backend/auth/logout";
$route['profile'] = "backend/auth/profile";
$route['auth/change_password'] = "backend/auth/change_password";

// customer
$route['customer/create'] = "backend/customer_controller/edit";
$route['get/customer'] = "backend/customer_controller/get_customer";
$route['customer/edit/(:num)'] = "backend/customer_controller/edit/$1";
$route['customer/save'] = "backend/customer_controller/save";
$route['customer'] = "backend/customer_controller/index";
$route['customer/index'] = "backend/customer_controller/index";
$route['customer/delete/(:num)'] = "backend/customer_controller/delete/$1";
$route['customer/tree'] = "backend/customer_controller/tree";

// depot
$route['depot/create'] = "backend/depot_controller/edit";
$route['get/depot'] = "backend/depot_controller/get_depot";
$route['depot/edit/(:num)'] = "backend/depot_controller/edit/$1";
$route['depot/save'] = "backend/depot_controller/save";
$route['depot'] = "backend/depot_controller/index";
$route['depot/index'] = "backend/depot_controller/index";
$route['depot/delete/(:num)'] = "backend/depot_controller/delete/$1";

// pharma
$route['pharma/create'] = "backend/pharma_controller/edit";
$route['get/pharma'] = "backend/pharma_controller/get_pharma";
$route['pharma/edit/(:num)'] = "backend/pharma_controller/edit/$1";
$route['pharma/save'] = "backend/pharma_controller/save";
$route['pharma'] = "backend/pharma_controller/index";
$route['pharma/index'] = "backend/pharma_controller/index";
$route['pharma/delete/(:num)'] = "backend/pharma_controller/delete/$1";

// search
$route['get/customer/customer_id'] = "backend/search_controller/get/$1/$2";
$route['search/customer_id'] = "backend/search_controller/customer_id/$1";
$route['search/customer/medical_store'] = "backend/search_controller/customer_medical_store/$1";

// product
$route['product'] = "backend/product_controller/index";
$route['get/product'] = "backend/product_controller/get_product";
$route['product/index'] = "backend/product_controller/index";
$route['product/create'] = "backend/product_controller/edit";
$route['product/edit/(:num)'] = "backend/product_controller/edit/$1";
$route['product/save'] = "backend/product_controller/save";
$route['product/delete/(:num)'] = "backend/product_controller/delete/$1";
$route['product/unit'] = "backend/product_controller/get_product_total_unit";

// Balance
$route['balance/prescription'] = "backend/balance_controller/prescription";
$route['get/balance/prescription/products'] = "backend/balance_controller/get_prescription_product";
$route['prescription/unit'] = "backend/balance_controller/get_prescription_total_unit";

// stock
$route['get/product/stock/(:num)'] = "backend/stock_controller/get_product_stock/$1";
$route['product/stock/save'] = "backend/stock_controller/product_stock_save/$1";
$route['stock/(:num)'] = "backend/stock_controller/index/$1";

// onclick edit
$route['grid/edit/(:any)/(:any)'] = "backend/simba_backend_controller/grid_edit/$1/$2";
$route['grid/onclick/update/(:any)/(:any)'] = "backend/simba_backend_controller/onclick_update/$1/$2";

// Order
$route['order'] = "backend/order_controller/index";
$route['get/order'] = "backend/order_controller/get_order_data";
$route['order/view/(:num)'] = "backend/order_controller/view/$1";
$route['order/convert/(:num)'] = "backend/order_controller/convert/$1";
$route['order/confirm/(:num)'] = "backend/order_controller/confirm/$1";
$route['order/create'] = "backend/order_controller/create";
$route['order/create/products'] = "backend/order_controller/get_order_create_product";
$route['get/order/product/(:num)'] = "backend/order_controller/get_order_product_data/$1";

// cart
$route['cart/info'] = "backend/cart_controller/info";
$route['cart/add'] = "backend/cart_controller/add";
$route['cart/update'] = "backend/cart_controller/update";
$route['cart/save'] = "backend/cart_controller/save";

// invoice
$route['invoice'] = "backend/invoice_controller/index";
$route['get/invoice'] = "backend/invoice_controller/get_invoice";
$route['invoice/view/(:num)'] = "backend/invoice_controller/view/$1";
$route['get/invoice/product/(:num)'] = "backend/invoice_controller/get_invoice_product/$1";
$route['get/invoice/customer'] = "backend/invoice_controller/get_invoice_customer";
$route['invoice/customer'] = "backend/invoice_controller/customer";
$route['invoice/create'] = "backend/invoice_controller/create";
$route['invoice/generate/(:num)'] = "backend/invoice_controller/generate/$1";
$route['invoice/confirm/(:num)'] = "backend/invoice_controller/confirm/$1";
$route['invoice/comment/(:num)'] = "backend/invoice_controller/comment/$1";

// reports
$route['report'] = "backend/report_controller/index";
$route['get/report/save'] = "backend/report_controller/save_report";
$route['get/point/customer'] = "backend/report_controller/get_customer_point";

// Payment
$route['payment'] = "backend/payment_controller/index";
$route['payment/customer'] = "backend/payment_controller/customer";
$route['payment/create/(:num)'] = "backend/payment_controller/edit/$1";
$route['payment/edit/(:num)'] = "backend/payment_controller/edit/$1";
$route['payment/save'] = "backend/payment_controller/save";

$route['get/payment'] = "backend/payment_controller/get_payment";

$route['payment/view/(:num)'] = "backend/payment_controller/view/$1";
$route['payment/save'] = "backend/payment_controller/save";
$route['get/payment/history/(:num)'] = "backend/payment_controller/get_payment_history/$1";
$route['payment/generate/(:num)'] = "backend/payment_controller/generate/$1";
		// Customer Payment
$route['payment/customer/create'] = "backend/payment_controller/customer_edit";
$route['payment/customer/save'] = "backend/payment_controller/customer_save";
$route['get/payment/customer'] = "backend/payment_controller/get_payment_customer";
$route['payment/customer/view/(:num)'] = "backend/payment_controller/customer_view/$1";
$route['get/payment/customer/history/(:num)'] = "backend/payment_controller/get_payment_customer_history/$1";
$route['payment/customer/create'] = "backend/payment_controller/customer_edit";
$route['payment/customer/edit/(:num)'] = "backend/payment_controller/customer_edit/$1";

// API
$route['api/login'] = 'api/session_controller/login';
$route['api/users_products'] = 'api/session_controller/get_users_products';
$route['api/prescription'] = 'api/prescription_controller/prescription';
$route['api/prescription/products_stores'] = 'api/prescription_controller/prescription_product_store';
$route['api/prescription/code'] = 'api/prescription_controller/code';

$route['api/sync/refresh'] = 'api/sync_controller/refresh';

$route['api/get/prescriptions'] = 'api/prescription_controller/get_prescriptions';

$route['api/prescription/invoice/products'] = 'api/prescription_controller/prescription_invoice_products';
$route['api/get/prescription/invoices'] = 'api/prescription_controller/get_prescription_invoices';
$route['api/get/prescription/invoice/products'] = 'api/prescription_controller/get_prescription_invoice_products';

$route['api/get/otc/prescriptions'] = 'api/prescription_controller/get_otc_prescriptions';
$route['api/get/otc/prescription/products'] = 'api/prescription_controller/get_otc_prescription_products';
$route['api/otc/prescriptions'] = 'api/prescription_controller/otc_prescriptions';

// Report
$route['report/prescription'] = "backend/report_controller/prescription";
$route['get/report/prescription'] = "backend/report_controller/get_prescription";

$route['report/prescription/invoice'] = "backend/report_controller/prescription_invoice";
$route['get/report/prescription/invoice'] = "backend/report_controller/get_prescription_invoice";

$route['report/stock'] = "backend/report_controller/stock";
$route['get/report/stock'] = "backend/report_controller/get_stock";

$route['report/payment'] = "backend/report_controller/payment";
$route['get/report/payment'] = "backend/report_controller/get_payment";

$route['report/payment/area'] = "backend/report_controller/payment_area";
$route['get/report/payment/area'] = "backend/report_controller/get_payment_area";


/* End of file routes.php */
/* Location: ./application/config/routes.php */