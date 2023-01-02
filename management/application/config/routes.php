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
$route['default_controller'] = 'welcome';
$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
if(strpos($url, 'about') !== false || strpos($url, 'courses') !== false || strpos($url, 'coursedetails') !== false || strpos($url, 'startlesson') !== false || strpos($url, 'sectiondetails') !== false || strpos($url, 'cart') !== false || strpos($url, 'checkout') !== false || strpos($url, 'lectures') !== false || strpos($url, 'login') !== false || strpos($url, 'singup') !== false || strpos($url, 'student') !== false || strpos($url, 'myaccount') !== false || strpos($url, 'contact') !== false || strpos($url, 'profile') !== false || strpos($url, 'access') !== false || strpos($url, 'admin') !== false || strpos($url, 'blogs') !== false || strpos($url, 'privacy') !== false){
} else{
	if(strpos($url, 'institute')){
		$route['institute/(:any)'] = 'welcome/institute/$1';
	}
	if(strpos($url, 'mycourses')){
		$route['institute/mycourses'] = 'welcome/mycourses';
	}
	else{
		$route['(:any)/mycourses'] = 'welcome/$1/mycourses';
	}
}
//$route['account/(:any)'] = 'welcome/institute/$1';
//$route['(:any)'] = 'welcome/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin/attendance'] = 'attendance';
