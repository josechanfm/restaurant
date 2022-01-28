<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends My_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->config->load('email');
	}

	public function signup(){
		$form = $this->form_builder->create_form();

		if ($form->validate())
		{
			// passed validation
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$identity = empty($username) ? $email : $username;
			$additional_data = array(
				'first_name'	=> $this->input->post('first_name'),
				'last_name'		=> $this->input->post('last_name'),
			);
			$groups = [1]; //regular member

			// [IMPORTANT] override database tables to update Frontend Users instead of Admin Users
			$this->ion_auth_model->tables = array(
				'users'				=> 'users',
				'groups'			=> 'groups',
				'users_groups'		=> 'users_groups',
				'login_attempts'	=> 'login_attempts',
			);

			// proceed to create user
			$user_id = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups);			
			if ($user_id)
			{
				// success
				$messages = $this->ion_auth->messages();
				$this->system_message->set_success($messages);

				// directly activate user
				//$this->ion_auth->activate($user_id);
				$this->_send_passcode($user_id,$email);
				redirect($this->mModule.'/'.$this->mCtrler.'/registration_confirmation/'.$userId.'/'.$this->_confirmation_hash($userId));
			}
			else
			{
				// failed
				$errors = $this->ion_auth->errors();
				$this->system_message->set_error($errors);
			}
			refresh();
		}

		// get list of Frontend user groups
		$this->mPageTitle = 'Create your own accout';
		$this->mViewData['form'] = $form;
		$this->mBodyClass = 'login-page';
		$this->render($this->mCtrler.'/registration','empty');
	}

	public function registration_confirmation($userId=0,$hashCode=''){
		if($this->_confirmation_hash($userId)!=$hashCode){
			redirect($this->mModule.'/'.$this->mCtrler.'/signup');
		}
		$form = $this->form_builder->create_form();
		if ($form->validate())
		{
			$inputPasscode = $this->input->post('passcode');
			$dbPasscode=$this->db->where('user_id',$userId)->where('expired',0)->where('service','REG')->order_by('id','DESC')->get('passcodes')->row();
			if($inputPasscode==$dbPasscode->passcode){
				$this->db->set('expired',1);
				$this->db->where('id',$dbPasscode->id);
				$this->db->update('passcodes');
				$this->_create_member($userId);
				redirect($this->mModule.'/login');
			}
			$this->system_message->set_error('Passcode not valid or expired!');
			refresh();
		}
		// get list of Frontend user groups
		$this->mPageTitle = 'Confirm your registration';
		$this->mViewData['form'] = $form;
		$this->mBodyClass = 'login-page';
		$this->render($this->mCtrler.'/'.$this->mAction,'empty');
	}
	public function forgot_password_confirmation($userId,$hashCode){
		if($this->_confirmation_hash($userId)!=$hashCode){
			redirect($this->mModdule.'/'.$this->mCtrler.'/signup');
		}
		$form = $this->form_builder->create_form();
		if ($form->validate())
		{
			$inputPasscode = $this->input->post('passcode');
			$dbPasscode=$this->db->where('user_id',$userId)->where('expired',0)->where('service','FGT')->order_by('id','DESC')->get('passcodes')->row();
			if($inputPasscode==$dbPasscode->passcode){
				$this->db->set('expired',1);
				$this->db->where('id',$dbPasscode->id);
				$this->db->update('passcodes');
				$this->_create_member($userId);
				redirect($this->mModule.'/login');
			}
			$this->system_message->set_error('Passcode not valid or expired!');
			refresh();
		}
		// get list of Frontend user groups
		$this->mPageTitle = 'Forgot password confiromation';
		$this->mViewData['form'] = $form;
		$this->mBodyClass = 'login-page';
		$this->render($this->mCtrler.'/'.$this->mAction,'empty');

	}

	public function forgot_password(){
		$this->mBodyClass = 'login-page';
		$form = $this->form_builder->create_form();
		if ($form->validate())
		{
			$email=$this->input->post('email');
			$user=$this->db->where('email',$email)->get('users')->row();
			if(!empty($user)){
				$this->resend_confirmation($user->id,$user->email);
				redirect($this->mModule.'/'.$this->mCtrler.'/forgot_password_confirmation/'.$user->id.'/'.$this->_confirmation_hash($user->id));
			}
			$this->system_message->set_error('Email not correct!');
			refresh();
		}
		// get list of Frontend user groups
		$this->mPageTitle = 'Forgot password';
		$this->mViewData['form'] = $form;
		$this->mBodyClass = 'login-page';
		$this->render($this->mCtrler.'/'.$this->mAction,'empty');
	}

	public function login(){
		$this->load->library('form_builder');
		$form = $this->form_builder->create_form();

		if ($form->validate())
		{
			// passed validation
			$identity = $this->input->post('email');
			$password = $this->input->post('password');
			$remember = ($this->input->post('remember')=='on');
			
			if ($this->ion_auth->login($identity, $password, $remember))
			{
				// login succeed
				$messages = $this->ion_auth->messages();
				$this->system_message->set_success($messages);
				redirect($this->mModule);
			}
			else
			{
				// login failed
				$errors = $this->ion_auth->errors();
				$this->system_message->set_error($errors);
				echo json_encode($_POST);
				//refresh();
			}
		}
		
		// display form when no POST data, or validation failed
		$this->mViewData['form'] = $form;
		$this->mBodyClass = 'login-page';
		$this->render($this->mModule.'/'.$this->mCtrler.'/login', 'empty');

	}
	public function _send_passcode($userId,$email){
		$passcodeInfo=array(
			'user_id'=>$userId,
			'email'=>$email,
			'passcode'=>rand(10090,99999),
			'service'=>'REG'
		);
		$this->db->insert('passcodes',$passcodeInfo);
		$this->load->library("MY_email",'email');
		$data=array(
			'passcode_info'=>$passcodeInfo,
			'path'=>current_path('ctrler','registration_confirmation/'.$userId.'/'.$this->_confirmation_hash($userId))
		);
		$this->email->send_email_template($email, 'newbie', 'Registration Confirmation', 'registration_confirmation',$data);

	}

	public function _confirmation_hash($userId){
		return hash('gost',$this->config->item('confirmation_key').$userId);
	}

	public function _create_member($userId){
		$user=$this->db->where('id',$userId)->get('users')->row();
		$data=array(
			'user_id'=>$userId,
			'chinese_name'=>$user->first_name,
			'foreign_name'=>$user->last_name,
			'email'=>$user->email
		);
		$insert_query = $this->db->insert_string('members', $data);
		$insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
		$this->db->query($insert_query);
		echo $this->db->insert_id();
	}
	public function resend_confirmation($userId=null,$email='josechan@ipm.edu.mo'){
		if(empty($user)){
			$user=$this->db->where('id',1)->where('email',$email)->get('users')->row();
		}
		$passcodeInfo=array(
			'user_id'=>$userId,
			'email'=>$email,
			'passcode'=>rand(10090,99999),
			'service'=>'FGT'
		);
		$this->db->insert('passcodes',$passcodeInfo);
		$this->load->library("MY_email",'email');
		$data=array(
			'passcode_info'=>$passcodeInfo,
			'path'=>$this->mModule.'/'.$this->mCtrler.'/forgot_password_confirmation/'.$userId.'/'.$this->_confirmation_hash($userId)
		);
		$this->email->send_email_template($email, 'member', 'Forgot Password', 'resend_confirmation',$data);
	}
}