<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faculty extends Admin_Controller {

	public function index()
	{
		$crud=$this->generate_crud('faculties');
		$this->render_crud();
	}
}
