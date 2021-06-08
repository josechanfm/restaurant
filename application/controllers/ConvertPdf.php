<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Home page
 */
class ConvertPdf extends MY_Controller {

	public function index()
	{
		require FCPATH. '/vendor/spatie/autoload.php';
		echo \Spatie\PdfToText\Pdf::getText(FCPATH.'/uploads/pdf/StoryStudio.pdf');
	}

}
