<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms extends Admin_Controller {

	public function index()
	{
		$this->load->model('sms_model', 'sms');
		$this->sms->send_sms(array('63860836'),'Test by Jose');
	}
}
