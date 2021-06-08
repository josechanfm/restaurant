<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends Admin_Controller {

	public function index()
	{
		$crud=$this->generate_crud('articles');
		$crud->columns('title','journal','volume','issue','page','file');
	    $crud->set_field_upload('file','uploads/pdf');
		$crud->unset_texteditor('Content','content');
    	$crud->callback_after_insert(array($this, '_extract_text'));
    	$crud->callback_after_update(array($this, '_extract_text'));

		$this->render_crud();
	}

	function _extract_text($post_array,$primary_key){
		require FCPATH. '/vendor/spatie/autoload.php';
		$content= \Spatie\PdfToText\Pdf::getText(FCPATH.'/uploads/pdf/'.$post_array['file']);
		$this->db->where('id',$primary_key);
		$this->db->set('content',$content);
		$this->db->update('articles');

	}
}
