<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'C_login';
$route['404_override'] = 'errors/page_missing';
$route['translate_uri_dashes'] = FALSE;


$route['login'] = 'C_login/login';
$route['logout'] = 'C_login/logout';
$route['index'] = 'C_login/index';
$route['changepassword'] = 'C_login/changePassword';
$route['savepassword'] = 'C_login/changePasswordSimpan';

$route['dashboard'] = 'C_index';
$route['dashboard/(:any)'] = 'C_index/$1';
$route['dashboard/(:any)/(:any)'] = 'C_index/$1/$2';
$route['dashboard/(:any)/(:any)/(:any)'] = 'C_index/$1/$2/$3';


$route['customer'] = 'C_customer/index';
$route['customer/(:any)'] = 'C_customer/$1';
$route['customer/(:any)/(:any)'] = 'C_customer/$1/$2';

$route['petugas'] = 'C_petugas/index';
$route['petugas/(:any)'] = 'C_petugas/$1';
$route['petugas/(:any)/(:any)'] = 'C_petugas/$1/$2';


$route['barang'] = 'C_barang/index';
$route['barang/(:any)'] = 'C_barang/$1';
$route['barang/(:any)/(:any)'] = 'C_barang/$1/$2';


$route['pelipat'] = 'C_pelipat/index';
$route['pelipat/(:any)'] = 'C_pelipat/$1';
$route['pelipat/(:any)/(:any)'] = 'C_pelipat/$1/$2';

$route['perusahaan'] = 'C_perusahaan/index';
$route['perusahaan/(:any)'] = 'C_perusahaan/$1';
$route['perusahaan/(:any)/(:any)'] = 'C_perusahaan/$1/$2';

$route['sumber_transaksi'] = 'C_sumber_transaksi/index';
$route['sumber_transaksi/(:any)'] = 'C_sumber_transaksi/$1';
$route['sumber_transaksi/(:any)/(:any)'] = 'C_sumber_transaksi/$1/$2';


$route['laporan'] = 'C_laporan/index';
$route['laporan/(:any)'] = 'C_laporan/$1';
$route['laporan/(:any)/(:any)'] = 'C_laporan/$1/$2';
