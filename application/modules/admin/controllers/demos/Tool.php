<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//if delete this demo, please delete the following files as well

//admin/models/Php_model.php

//modules/api/config/sms.php
//moudles/api/controllers/sms.php

//the libraries of 'my_Excel' and my_email are gineric library


class Tool extends Admin_Controller {

	public function gen_pdf(){
		$this->load->model('pdf_model');
		 $data=array(
		 	'title'=>'Page title for PDF',
		 	'date'=>'adsfads'
		 );
		$this->pdf_model->print_out($data);

	}
	public function import(){
		$this->load->library('my_Excel');
		$this->my_excel->excel_import(
			'assets\uploads\faculties.xlsx',
			'faculties',
			1,
			array('name'=>'B','dean'=>'C','phone'=>'D','start'=>'E'),
			array('start'=>'date'),
			array('campus'=>'Main Campus')
		);
	}
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
		$this->render('demos/mailer');
	}

	public function sms(){
		$this->render('demos/sms');

	}
}
