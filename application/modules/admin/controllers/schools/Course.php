<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends Admin_Controller {

	public function index()
	{
		// $this->load->library('gc_dependent_select');
		$this->load->model('gc_dependent_select_model','gc_dependent');
		$crud=$this->generate_crud('courses');
		//to set up the dependency relation, you need to create an get_xxxx_properties() function in the model
		$this->mGridTitle=$this->gc_dependent->get_js($crud,$this->gc_dependent->get_courses_properties());

		$this->render_crud();
	}

}
