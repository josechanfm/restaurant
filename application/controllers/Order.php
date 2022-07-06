<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Order extends MY_Controller {

	public function index()
	{
		$this->load->model('categories_model','categories');
		$this->load->model('products_model','products');
		$this->mViewData['categories']=$this->categories->get_all();
		$this->mViewData['products']=$this->products->get_many_by('category_id',1);
		$this->render($this->mCtrler.'/home','empty');
	}

}
