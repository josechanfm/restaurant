<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// default controller for this module
$route['admin'] = 'home';
$route['admin/(\w{2})/(:any)']="$2";
$route['admin/(\w{2})']="";