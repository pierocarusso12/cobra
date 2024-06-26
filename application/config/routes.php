<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'events';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['events'] = 'events/index';
$route['events/getAll'] = 'events/getAll';
$route['events/add'] = 'events/add';
$route['events/edit/(:num)'] = 'events/edit/$1';
$route['events/delete/(:num)'] = 'events/delete/$1';
$route['events/getOne/(:num)'] = 'events/getOne/$1';

$route['events/(:any)'] = 'events/$1';