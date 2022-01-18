<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
	}

	public function index()
	{
		$crud=$this->generate_crud('products');
		$this->render_crud();
	}

	public function available(){
		$_SESSION['cart']=array();
		//$this->cart->destroy();
		$this->load->model('products_model');
		$this->mViewData['products']=$this->products_model->get_many_by('status',1);
		$this->render('products/available');
	}
	public function add_to_cart(){
		//$this->cart->insert($_GET['pid']);
		array_push($_SESSION['cart'],$_GET['pid']);
		//echo json_encode($_SESSION['cart']);
		echo count($_SESSION['cart']);
	}
	public function my_cart(){
		//$this->cart->insert();
		//echo json_encode($this->cart->contents());
		echo json_encode($_SESSION['cart']);
	}
	public function cart(){
		$this->cart->destroy();
		echo 'my cart';

		$data = array(
		        'id'      => 'sku_123ABC',
		        'qty'     => 2,
		        'price'   => 39.95,
		        'name'    => 'T-Shirt',
		        'options' => array('Size' => 'L', 'Color' => 'Red')
		);

		$this->cart->insert($data);		

		$data=array(
			'id'=>'abc123',
			'qty'=>'3',
			'price'=>'1123',
			'name'=>'abc',
		);
		$this->cart->insert($data);

		$products=$this->cart->contents();
		foreach($products as $product){
			echo json_encode($product);
			echo '<hr>';
		}
	}
}