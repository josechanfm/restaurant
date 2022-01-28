<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		redirect($this->mModule.'/profile/card');
	}
	public function dashboard(){
		$crud=$this->generate_crud('contests');
		$this->render_crud();
	}
}

