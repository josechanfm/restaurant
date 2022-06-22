<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| CI Bootstrap 3 Configuration
| -------------------------------------------------------------------------
| This file lets you define default values to be passed into views 
| when calling MY_Controller's render() function. 
| 
| See example and detailed explanation from:
| 	/application/config/ci_bootstrap_example.php
*/

$config['ci_bootstrap'] = array(

	// Site name
	'site_name' => 'CI Bootstrap 4',
	'site_name_mini'=>'CI3',

	// Default page title prefix
	'page_title_prefix' => '',

	// Default page title
	'page_title' => '',
	'navbar_fixed_top'=>FALSE,

	// Default meta data
	'meta_data'	=> array(
		'author'		=> '',
		'description'	=> '',
		'keywords'		=> ''
	),

	// Default scripts to embed at page head or end
	'scripts' => array(
		'head'	=> array(
			'assets/dist/admin/bootstrap4/js/jquery.min.js',
			'assets/plugins/bootstrap/js/bootstrap.bundle.js',
			'assets/dist/admin/bootstrap4/js/adminlte.min.js',
			'assets/dist/vue/axios.min.js',
			'assets/dist/vue/vue.min.js',
			'assets/dist/vue/index.js'
		),
		'foot'	=> array(
			//'assets/dist/frontend/lib.min.js',
			//'assets/dist/frontend/app.min.js'
		),
	),

	// Default stylesheets to embed at page head
	'stylesheets' => array(
		'screen' => array(
			'assets/dist/admin/bootstrap4/css/font-awesome.min.css',
			//'assets/dist/admin/bootstrap4/css/fontawesome_all.min.css',
			'assets/dist/admin/bootstrap4/webfonts/fa-solid-900.woff2',
			'assets/dist/admin/bootstrap4/css/ionicons.min.css',
			'assets/dist/admin/bootstrap4/css/adminlte.min.css',
			'assets/dist/admin/bootstrap4/css/_all-skins.min.css',
			'assets/dist/vue/index.css'
		)
	),

	// Default CSS class for <body> tag
	'body_class' => 'layout-top-nav',
	
	// Multilingual settings
	'languages' => array(
		'default'		=> 'en',
		'autoload'		=> array('general'),
		'available'		=> array(
			'en' => array(
				'label'	=> 'English',
				'value'	=> 'english'
			),
			'zh' => array(
				'label'	=> '繁體中文',
				'value'	=> 'traditional-chinese'
			),
			'cn' => array(
				'label'	=> '简体中文',
				'value'	=> 'simplified-chinese'
			),
			'es' => array(
				'label'	=> 'Español',
				'value' => 'spanish'
			)
		)
	),

	// Google Analytics User ID
	'ga_id' => '',

	// Menu items
	'menu' => array(
		'home' => array(
			'name'		=> 'Home',
			'url'		=> '',
		),
		'contact'=>array(
			'name'	=>'Contact',
			'url'	=>'contact'
		),
		'dropdown'=>array(
			'name'		=> 'Dropdown',
			'url'		=> 'dropdown',
			'icon'		=> 'fa fa-users',
			'children'  => array(
				'List'			=> 'user',
				'Create'		=> 'user/create',
				'divider'		=>	'---',
				'User Groups'	=> 'user/group',
			)
		),
	),

	// Login page
	'login_url' => '',

	// Restricted pages
	'page_auth' => array(
	),

	// Email config
	'email' => array(
		'from_email'		=> 'no-replay@ipm.edu.mo',
		'from_name'			=> 'no-replay',
		'subject_prefix'	=> '(Auto email)',
		
		// Mailgun HTTP API
		'mailgun_api'		=> array(
			'domain'			=> '',
			'private_api_key'	=> ''
		),
	),

	// Debug tools
	'debug' => array(
		'view_data'	=> FALSE,
		'profiler'	=> FALSE
	),
);

/*
| -------------------------------------------------------------------------
| Override values from /application/config/config.php
| -------------------------------------------------------------------------
*/
$config['sess_cookie_name'] = 'ci_session_frontend';
