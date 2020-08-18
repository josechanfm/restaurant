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
	'site_name' => 'Admin Panel',
	'site_name_mini'=>'CI3',
	
	// Default page title prefix
	'page_title_prefix' => '',

	// Default page title
	'page_title' => '',

	// Default meta data
	'meta_data'	=> array(
		'author'		=> '',
		'description'	=> '',
		'keywords'		=> ''
	),
	
	// Default scripts to embed at page head or end
	'scripts' => array(
		'head'	=> array(
/*			'assets/dist/admin/adminlte.min.js',
			'assets/dist/admin/lib.min.js',
			'assets/dist/admin/app.min.js'*/
			'assets/api/plugins/jquery/jquery.min.js',
			'assets/api/plugins/jquery-ui/jquery-ui.min.js',

			'assets/api/plugins/bootstrap/js/bootstrap.bundle.min.js',
			'assets/api/plugins/chart.js/Chart.min.js',
			'assets/api/plugins/sparklines/sparkline.js',
			'assets/api/plugins/jqvmap/jquery.vmap.min.js',
			'assets/api/plugins/jqvmap/maps/jquery.vmap.usa.js',
			'assets/api/plugins/jquery-knob/jquery.knob.min.js',
			'assets/api/plugins/moment/moment.min.js',
			'assets/api/plugins/daterangepicker/daterangepicker.js',
			'assets/api/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
			'assets/api/plugins/summernote/summernote-bs4.min.js',
			'assets/api/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
			'assets/dist/admin/bootstrap4/js/adminlte.min.js',
			'assets/dist/admin/lib.min.js',
			'assets/dist/admin/app.min.js'

		),
		'foot'	=> array(
		),
	),

	// Default stylesheets to embed at page head
	'stylesheets' => array(
		'screen' => array(
			/*'assets/dist/admin/adminlte.min.css',
			'assets/dist/admin/lib.min.css',
			'assets/dist/admin/app.min.css'*/

			'assets/api/plugins/fontawesome-free/css/all.min.css',
			'assets/api/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
			'assets/api/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
			'assets/api/plugins/jqvmap/jqvmap.min.css',
			'assets/dist/admin/bootstrap4/css/adminlte.min.css',
			'assets/api/plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
			'assets/api/plugins/daterangepicker/daterangepicker.css',
			'assets/api/plugins/summernote/summernote-bs4.css',
			'assets/dist/admin/lib.min.css',
			'assets/dist/admin/app.min.css'
		)
	),

	// Default CSS class for <body> tag
	'body_class' => 'sidebar-mini',
	
	// Multilingual settings
	'languages' => array(
	),

	// Menu items
	'menu' => array(
		'home' => array(
			'name'		=> 'Home',
			'url'		=> '',
			'icon'		=> 'fa fa-home',
		),
		'demo' => array(
			'name'		=> 'Demos',
			'url'		=> 'demos',
			'icon'		=> 'fa fa-bank',
			'children'  => array(
				'Faculty'		=> 'demos/faculty',
				'Department'	=> 'demos/department',
				'Course'	=>'demos/course',
				'Gen PDF'	=>'demos/tool/gen_pdf',
				'Import'	=>'demos/tool/import',
				'Mailer'	=>'demos/tool/mailer',
				'SMS'		=>'demos/tool/sms',
				'Products'		=>'demos/product/',
				'Shopping Cart'		=>'demos/product/cart'
			)
		),
		'user' => array(
			'name'		=> 'Users',
			'url'		=> 'user',
			'icon'		=> 'fa fa-users',
			'children'  => array(
				'List'			=> 'user',
				'Create'		=> 'user/create',
				'User Groups'	=> 'user/group',
			)
		),
		'panel' => array(
			'name'		=> 'Admin Panel',
			'url'		=> 'panel',
			'icon'		=> 'fa fa-cog',
			'children'  => array(
				'Admin Users'			=> 'panel/admin_user',
				'Create Admin User'		=> 'panel/admin_user_create',
				'Admin User Groups'		=> 'panel/admin_user_group',
			)
		),
		'util' => array(
			'name'		=> 'Utilities',
			'url'		=> 'util',
			'icon'		=> 'fa fa-cogs',
			'children'  => array(
				'Database Versions'		=> 'util/list_db',
			)
		),
		'logout' => array(
			'name'		=> 'Sign Out',
			'url'		=> 'panel/logout',
			'icon'		=> 'fa fa-sign-out',
		)
	),

	// Login page
	'login_url' => 'admin/login',

	// Restricted pages
	'page_auth' => array(
		'user/create'				=> array('webmaster', 'admin', 'manager'),
		'user/group'				=> array('webmaster', 'admin', 'manager'),
		'panel'						=> array('webmaster'),
		'panel/admin_user'			=> array('webmaster'),
		'panel/admin_user_create'	=> array('webmaster'),
		'panel/admin_user_group'	=> array('webmaster'),
		'util'						=> array('webmaster'),
		'util/list_db'				=> array('webmaster'),
		'util/backup_db'			=> array('webmaster'),
		'util/restore_db'			=> array('webmaster'),
		'util/remove_db'			=> array('webmaster'),
	),

	// AdminLTE settings
	'adminlte' => array(
		'body_class' => array(
			'webmaster'	=> 'skin-red',
			'admin'		=> 'skin-purple',
			'manager'	=> 'skin-black',
			'staff'		=> 'skin-blue',
		)
	),

	// Useful links to display at bottom of sidemenu
	'useful_links' => array(
		array(
			'auth'		=> array('webmaster', 'admin', 'manager', 'staff'),
			'name'		=> 'Frontend Website',
			'url'		=> '',
			'target'	=> '_blank',
			'color'		=> 'text-aqua'
		),
		array(
			'auth'		=> array('webmaster', 'admin'),
			'name'		=> 'API Site',
			'url'		=> 'api',
			'target'	=> '_blank',
			'color'		=> 'text-orange'
		),
		array(
			'auth'		=> array('webmaster', 'admin', 'manager', 'staff'),
			'name'		=> 'Github Repo',
			'url'		=> CI_BOOTSTRAP_REPO,
			'target'	=> '_blank',
			'color'		=> 'text-green'
		),
	),

	// Email config
	'email' => array(
		'from_email'		=> 'no-replay@ipm.edu.mo',
		'from_name'			=> 'no-replay',
		'subject_prefix'	=> '(Auto Mailer)',
		
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
$config['sess_cookie_name'] = 'ci_session_admin';