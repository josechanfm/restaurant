<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vue extends Admin_Controller {

	public function index()
	{
		$this->add_script('/assets/dist/vue/axios.min.js',FALSE,'head');
		$this->add_script('/assets/dist/vue/vue.min.js',FALSE,'head');
		$this->add_script('/assets/dist/vue/demo_vue.js');
		$this->add_stylesheet('/assets/dist/vue/demo_vue.css');
		$members=array(
			array(
				'name_c'=>'陳輝民',
				'name_e'=>'Jose'
			),
			array(
				'name_c'=>'陳輝民1',
				'name_e'=>'Jose1'
			)
		);
		$this->mViewData['products']=
				$this->db->select('*')
						->get('products')
						->result();
		$this->mViewData['members']=$members;

		$this->render('demos/vue');
	}

	public function get_all_products(){
		echo json_encode($this->db->get('products')->result());
	}
}
