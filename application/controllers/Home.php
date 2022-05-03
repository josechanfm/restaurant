<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Home extends MY_Controller {

	public function index()
	{
		$this->render('home');
	}
	public function page(){
		$this->load->library('MY_Pagination','pagination');
		$pages=$this->pagination->render(100,10,'abc');
		echo json_encode($pages);
	}

	public function mailer(){
		$this->add_script('https://www.google.com/recaptcha/api.js',true,'head');
		$this->load->library('form_builder');
		$this->load->library('my_email','email');
		$form = $this->form_builder->create_form();
		if ($form->validate())
		{
			//send_email_template($to_email, $to_name, $subject, $view, $data = NULL)
			$this->email->send_email_prepare(
				$this->get_email_prop($this->input->post())
			);
		}
		$this->mViewData['form'] = $form;
		$this->render('email/mailer');
	}
	public function table(){
		$this->add_stylesheet('/assets/dist/admin/bootstrap4/css/dataTables.bootstrap.min.css');
		$this->add_script('assets/dist/admin/bootstrap4/js/jquery.dataTables.min.js');
		$this->add_script('assets/dist/admin/bootstrap4/js/dataTables.bootstrap.min.js');
		$this->render('table');
	}

	function get_email_prop($post){
		$data=array(
			'reciever'=>array(
				'email'=>$post['reciever_email'],
				'name'=>$post['reciever_name']
			),
			'sender'=>array(
				'email'=>$post['sender_email'],
				'name'=>$post['sender_name'],
				'subject_prefix'=>'prefix'
			),
			'subject'=>$post['subject'],
			'template'=>'schools/notice',
			'data'=>array(
				'sender_email'=>$post['sender_email'],
				'sender_name'=>$post['sender_name'],
				'reciever_email'=>$post['reciever_email'],
				'reciever_name'=>$post['reciever_name'],
				'subject'=>$post['subject'],
				'message'=>$post['message'],
			)
		);
		return $data;
	}

}
