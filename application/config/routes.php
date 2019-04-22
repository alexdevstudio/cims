<?php
defined('BASEPATH') OR exit('No direct script access allowed');



$route['default_controller'] = 'frontend';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$exist_controllers = ['auth','admin','crud', 'generic']; //Just add here the controllers that exist
if(!in_array($this->uri->segment(1) , $exist_controllers))
{
  $route['post/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "frontend/post/$1/$2/$3/$4/$5/$6";
  $route['post/(:any)/(:any)/(:any)/(:any)/(:any)'] = "frontend/post/$1/$2/$3/$4/$5";
  $route['post/(:any)/(:any)/(:any)/(:any)'] = "frontend/post/$1/$2/$3/$4";
  $route['post/(:any)/(:any)/(:any)'] = "frontend/post/$1/$2/$3";
  $route['post/(:any)/(:any)'] = "frontend/post/$1/$2";
  $route['post/(:any)'] = "frontend/post/$1";

  $route['(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "frontend/index/$1/$2/$3/$4/$5/$6";
  $route['(:any)/(:any)/(:any)/(:any)/(:any)'] = "frontend/index/$1/$2/$3/$4/$5";
  $route['(:any)/(:any)/(:any)/(:any)'] = "frontend/index/$1/$2/$3/$4";
  $route['(:any)/(:any)/(:any)'] = "frontend/index/$1/$2/$3";
  $route['(:any)/(:any)'] = "frontend/index/$1/$2";
  $route['(:any)'] = "frontend/index/$1";
}
$route['admin/user/create_user'] = "admin/create_user";
