<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MY_SpreadSheet { 

	public function test_export($data = null){
		//Spread Object
		$spreadsheet = new Spreadsheet();

		$sheet = $spreadsheet->getActiveSheet();

		$sheet->setCellValue('A1','Hello World!');

		$writer = new Xlsx($spreadsheet);

		//output
		header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename=test.xlsx');
	    header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}

/*
	Three main object 
	 -Sheet: $spreadsheet
	 -Writer:  $writer
	 -Reader: $reader
*/
	public function import_write($file = null){
		//create sheet object after reader file 
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);

		//get active sheet in sheet object 
		$worksheet = $spreadsheet->getActiveSheet();

		//write something in A1
		$worksheet -> setCellValue('A1','Hello World!');

		$writer = new Xlsx($spreadsheet);

		//output
		header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename=test.xlsx');
	    header('Cache-Control: max-age=0');
		$writer->save('php://output');
	} 

	public function import_to_array($file = null){
		//reader object 
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		
		//create sheet object after reader file 
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);

		//get active sheet in sheet object 
		$worksheet = $spreadsheet->getActiveSheet();

		$array = $worksheet->toArray();

		return $array;
	}
}