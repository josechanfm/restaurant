<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class School extends Admin_Controller {

	public function index()
	{
		$this->render('schools/home');
	}
	public function faculty(){
		$crud=$this->generate_crud('faculties');
		$this->render_crud();
	}
	public function department(){
		$crud=$this->generate_crud('departments');
		$crud->set_relation('faculty_id','faculties','name');
		$this->render_crud();
	}
	public function course(){
		// $this->load->library('gc_dependent_select');
		$this->load->model('gc_dependent_select_model','gc_dependent');
		$crud=$this->generate_crud('courses');
		//to set up the dependency relation, you need to create an get_xxxx_properties() function in the model
		$this->mGridTitle=$this->gc_dependent->get_js($crud,$this->gc_dependent->get_courses_properties());

		$this->render_crud();
	}

	public function gen_pdf(){
		$this->load->model('pdf_model');
		 $data=array(
		 	'title'=>'Page title for PDF',
		 	'date'=>'adsfads'
		 );
		$this->pdf_model->print_out($data);

	}
	public function import(){
		$this->load->library('data_importer');
		$this->data_importer->excel_import(
			'assets\uploads\faculties.xlsx',
			'faculties',
			1,
			array('name'=>'B','dean'=>'C','phone'=>'D','start'=>'E'),
			array('start'=>'date'),
			array('campus'=>'Main Campus')
		);
	}

}
