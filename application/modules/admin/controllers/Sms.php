<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms extends Admin_Controller {

	public function index()
	{
		$this->render('sms');
	}
}
