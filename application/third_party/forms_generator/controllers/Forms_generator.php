<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Forms_generator extends CI_Controller {
	public function __construct()
	{
		$this->load->model('forms_model','forms');
	}

}