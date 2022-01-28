<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lent extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
		$this->load->model('products_model','products');
		$this->load->model('loaner_items_model','loaner_items');
	}

	public function index()
	{
		$crud=$this->generate_crud('products');
		$this->render_crud();
	}

	public function available(){
		$_SESSION['cart']=array();
		$this->cart->destroy();
		$this->mViewData['products']=$this->products->get_many_by('status',1);
		$this->render($this->mCtrler.'/available');
	}
	public function checkout(){
    	$data=$_POST['items'];
    	$loaner=$_POST['loaner'];
    	$this->db->insert('loaner',$loaner);
    	$loaner_id=$this->db->insert_id();

    	foreach($data as $i=>$d){
    		$data[$i]['loaner_id']=$loaner_id;
    	}
    	$this->db->insert_batch('loaner_items',$data);
    	$result=array(
    		"loaner_id"=>$loaner_id,
    		"items_num"=>$this->db->affected_rows()
    	);
    	echo json_encode($result);
	}
	public function lent(){
		$this->mViewData['products']=$this->loaner_items->get_lent();
		$this->render($this->mCtrler.'/lent');
	}

}