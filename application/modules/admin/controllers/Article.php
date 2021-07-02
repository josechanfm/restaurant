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




		$ext=strtoupper(pathinfo($post_array['file'], PATHINFO_EXTENSION));
		switch($ext){
			case in_array($ext,array('DOC','DOCX')):
				$this->_word_text($primary_key,$post_array['file']);
				break;
			case 'PDF':
				$this->_pdf_text($primary_key,$post_array['file']);
				break;
			default:
		}

	}

	function _pdf_text($primary_key,$file){
		require FCPATH. '/vendor/spatie/autoload.php';
		$content= \Spatie\PdfToText\Pdf::getText(FCPATH.'/uploads/pdf/'.$file);
		$this->db->where('id',$primary_key);
		$this->db->set('user_id',$_SESSION['user_id']);
		$this->db->set('content',$content);
		$this->db->update('articles');

	}

	function _word_text($primary_key, $file){
		//require("class.filetotext.php"); 
		require FCPATH. '/vendor/filetotext/class.filetotext.php';

		$docObj = new Filetotext(FCPATH."/uploads/pdf/".$file);  
		//$docObj = new Filetotext("test.pdf"); 
		$content = $docObj->convertToText(); 
		$this->db->where('id',$primary_key);
		$this->db->set('user_id',$_SESSION['user_id']);
		$this->db->set('content',$content);
		$this->db->update('articles');

	}
}
