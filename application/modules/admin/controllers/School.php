<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class School extends Admin_Controller {

	public function index()
	{
		$this->render('schools/home');
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
		$this->load->library('MY_Excel');
		$this->my_excel->excel_import(
			'assets\uploads\faculties.xlsx',
			'faculties',
			1,
			array('name'=>'B','dean'=>'C','phone'=>'D','start'=>'E'),
			array('start'=>'date'),
			array('campus'=>'Main Campus')
		);
	}
/*	
	public function send_email(){
		$this->load->library('my_email','email');
		$this->email->send_email_template(
			'josechan@ipm.edu.mo',
			'josechan',
			'test',
			'general',
			array('full_name'=>'jose chan')
		);
	}
*/
	public function mailer(){
		$this->add_script('https://www.google.com/recaptcha/api.js',true,'head');
		$this->load->library('form_builder');
		$this->load->library('my_email','email');
		$form = $this->form_builder->create_form();
		if ($form->validate())
		{
			$this->email->send_email_template(
				$this->input->post('reciever_email'),
				$this->input->post('reciever_name'),
				$this->input->post('subject'),
				'schools/notice',
				array(
					'sender_email'=>$this->input->post('sender_email'),
					'sender_name'=>$this->input->post('sender_name'),
					'reciever_email'=>$this->input->post('reciever_email'),
					'reciever_name'=>$this->input->post('reciever_name'),
					'subject'=>$this->input->post('subject'),
					'message'=>$this->input->post('message'),
				)
			);
		}
		$this->mViewData['form'] = $form;
		$this->render('schools/mailer');
	}
}
