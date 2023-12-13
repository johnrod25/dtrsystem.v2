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
|	https://codeigniter.com/userguide3/general/routing.html
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

//LOGIN
$route['default_controller'] = 'home';
$route['404_override'] = 'home/error_page';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'home/login_page';
$route['loginvalid'] = 'home/login';
$route['logout'] = 'home/logout';

// DASHBOARD ROUTE
//$route['default_controller'] = 'admin/index';
$route['tapcard'] = 'home/tapcard';
$route['fetch'] = 'admin/fetch';

// DEPARTMENT ROUTE
$route['department'] = 'department/index';
$route['insert-department'] = 'department/insert';
$route['edit-department'] = 'department/edit';
$route['update-department'] = 'department/update';
$route['delete-department'] = 'department/delete';

// STAFF ROUTE
$route['employee'] = 'staff/index';
$route['insert-staff'] = 'staff/insert';
$route['edit-staff'] = 'staff/edit';
$route['update-staff'] = 'staff/update';
$route['delete-staff'] = 'staff/delete';

// SCHEDULE ROUTE
$route['schedule'] = 'schedule/index';
$route['insert-schedule'] = 'schedule/insert';
$route['edit-schedule'] = 'schedule/edit';
$route['update-schedule'] = 'schedule/update';
$route['delete-schedule'] = 'schedule/delete';

// ATTENDANCE ROUTE
$route['attendance'] = 'attendance/index';
$route['edit-all-attendance'] = 'attendance/edit_all_attd';
$route['edit-attd-schedule'] = 'attendance/edit_attd';
$route['update-my-attendance'] = 'attendance/update_attendance';
$route['insert-attendance'] = 'attendance/insert';
$route['edit-attendance'] = 'attendance/edit';
$route['update-attendance'] = 'attendance/update';
$route['delete-attendance'] = 'attendance/delete';

// REPORT ROUTE
$route['report'] = 'report/index';
$route['print-dtr/(:num)/(:num)'] = 'home/printdtr/$1/$2';
$route['printmydtr'] = 'home/printmydtr';
$route['printall'] = 'home/printalldtr';
// $route['printall/(:num)'] = 'home/printalldtr/$1';

// TRYYY
// $route['fetch'] = 'staff/fetch';
// $route['delete'] = 'ajax/delete';
// $route['index'] = 'ajax/index';
// $route['inserts'] = 'ajax/insert';
// $route['updates'] = 'ajax/update';
// $route['edits'] = 'ajax/edit';
// $route['fetch'] = 'ajax/fetch';

// $route['emp'] = 'admin/employee';
// $route['edit-staff'] = 'staff/modaledit';
// $route['schedule'] = 'admin/schedule';
// $route['attendance'] = 'admin/attendance';


// $route['login'] = 'pages/login';
// $route['logout'] = 'pages/logout';

// $route['add'] = 'pages/add';
// $route['edit/(:any)'] = 'pages/edit/$1';
// $route['delete'] = 'pages/delete';

// $route['search'] = 'pages/search';
// $route['default_controller'] = 'pages/view';
// $route['(:any)'] = 'pages/view/$1';
// $route['404_override'] = '';
// $route['translate_uri_dashes'] = FALSE;
