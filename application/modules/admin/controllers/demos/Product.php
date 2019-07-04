<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//if delete this demo, also delete the folowing files
// /assets/dist/admin/jquery.mycart.js
// /assets/dist/admin/jquery.mycart.min.js
// /prodct/*

class Product extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$crud = $this->generate_crud('products');
		$crud->columns('sub_category','brand','name','origin','image');
		//$crud->field_type('category', 'dropdown', $this->config->item('product_category'));
		//$crud->set_relation('sub_category','categories','name');
		$crud->set_field_upload('image','assets\products\images');
		//$crud->set_field_upload('file','assets\products\files');
		$this->mPageTitle = 'Products';
		$this->render_crud();
	}
	public function cart()
	{
		$this->add_script('assets/dist/admin/jquery.mycart.js',TRUE, 'head');
		$this->mViewData['products'] = $this->db->select('*')
							->from('products')
							->get()->result_array();
		$this->render('demos/cart');
	}

	public function add(){
		$data = array(
        		'user_id' => $this->input->post('user_id'),
	        	'product_id' => $this->input->post('product_id'),
        		'qty' => $this->input->post('qty')
		);

		$this->db->insert('orders', $data);
		echo "done";
	}
}
