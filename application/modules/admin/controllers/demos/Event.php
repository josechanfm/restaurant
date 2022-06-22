<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Event extends Admin_Controller {

	public $forms ;

	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		$crud=$this->generate_crud('events');
		$crud->add_action('More', '', base_url().$this->mModule.'/demos/event/edit/','fa fa-edit ');
		$this->render_crud();
	}

	public function edit($foreign_key = null){

		include_once ( dirname(__FILE__) . "/forms_generator.php" );

		$this->forms = new Forms_generator;
		//init the forms config
		$this->forms->set_config_file('forms_generator');

		$this->forms->form($foreign_key);
	}

}