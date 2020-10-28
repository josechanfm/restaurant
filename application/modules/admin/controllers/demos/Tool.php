<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//if delete this demo, please delete the following files as well

//admin/models/Php_model.php

//modules/api/config/sms.php
//moudles/api/controllers/sms.php

//the libraries of 'my_Excel' and my_email are gineric library


class Tool extends Admin_Controller {

	//Spread Sheet Export
	public function export(){
		$this->load->library('my_SpreadSheet');
		$this->my_spreadsheet->test_export();
	}
	public function import(){
		$this->render('demos/import');	
	}
	//Spread Sheet Import and file to array
	public function import_to_array(){
		$tmp_file = $_FILES['userfile']['tmp_name'];
		//tmp file to array
		$this->load->library('my_SpreadSheet');
        $data = $this->my_spreadsheet->import_to_array($tmp_file);
        foreach ($data as $i => $row) {
        	echo $i.'===';
        	foreach ($row as  $value) {
        	echo $value.', ';
        	}
        	echo '<br>';
        }
        echo '<hr>';
        echo json_encode($data);
	}

	public function gen_pdf(){
		$this->load->model('pdf_model');
		 $data=array(
		 	'title'=>'Page title for PDF',
		 	'date'=>'adsfads'
		 );
		$this->pdf_model->print_out($data);
	}

	public function mailer(){
		//$this->add_script('https://www.google.com/recaptcha/api.js',true,'head');
		$this->load->library('form_builder');
		$this->load->library('my_email','email');
		$form = $this->form_builder->create_form();
		if ($form->validate())
		{
			$this->email->send_email_template(
				$this->input->post('reciever_email'),
				$this->input->post('reciever_name'),
				$this->input->post('subject'),
				'demos/notice',
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
