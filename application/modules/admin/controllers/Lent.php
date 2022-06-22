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

	public function products(){
		$p=isset($_GET['p'])?$_GET['p']:'1';
		$search_condition=[];
		if(isset($_POST['table_search'])){
			$search_condition=array(
				'name "%'.$_POST['table_search'].'%" or brand "%'.$_POST['table_search'].'%" or barcode like "%'.$_POST['table_search'].'%"',			);
		}
		$products=$this->products->with('loaner_items')->get(1);
		$this->mViewData['products']=>$this->products->with('loaner_items')->paginate($p,$search_condition);
		echo json_encode($products);
	}


	public function sheet(){
		$p=isset($_GET['p'])?$_GET['p']:'1';
		$search_condition=[];
		if(isset($_POST['table_search'])){
			$search_condition=array(
				'username like "%'.$_POST['table_search'].'%" or name_zh like "%'.$_POST['table_search'].'%" or name_pt like "%'.$_POST['table_search'].'%"',			);
		}
		$result=$this->staffs_model->select('id,username,name_zh,name_pt,email')->with('staffs_uploads')->paginate($p,$search_condition);
		$this->mViewData['staffs']=$result['data'];
		$this->mViewData['pagination']=$this->pagination->render($this->staffs_model->count_all(),$result['counts']['limit']);
		$this->mPageTitle='Staff Card';
		$this->render($this->mCtrler.'/'.$this->mAction);
	}

}