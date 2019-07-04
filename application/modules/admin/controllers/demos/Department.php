<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends Admin_Controller {

	public function index()
	{
		$crud=$this->generate_crud('departments');
		$crud->set_relation('faculty_id','faculties','name');
		$this->render_crud();
	}

}
