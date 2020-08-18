<!--https://github.com/Akshay-Hegde/grocery_crud_multiuploader
-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Multi extends Admin_Controller {

	public function index()
	{
        $this->load->library('Grocery_CRUD_Multiuploader');

		$this->render('home');
	}
}
