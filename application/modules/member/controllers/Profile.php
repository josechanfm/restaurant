<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('members_model','members');
	}

	public function index()
	{
		$this->render($this->mModule.'/'.$this->mCtrler.'/home','empty');
	}
	public function card(){
		$this->mViewData['member']=$this->members->get_by('user_id',$_SESSION['user_id']);
		$this->render($this->mModule.'/profile/card', 'empty');
	}
	public function info(){
		$crud=$this->generate_crud('members');
		$crud->where('id',$_SESSION['user_id']);
		$this->render_crud('empty');
	}
	/**
	 * Logout user
	 */
	public function logout()
	{
		$this->ion_auth->logout();
		redirect($this->mConfig['login_url']);
	}
}
