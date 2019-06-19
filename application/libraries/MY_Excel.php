<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'third_party/PHPExcel/Classes/PHPExcel.php';
require_once APPPATH.'third_party/PHPExcel/Classes/PHPExcel/IOFactory.php';

/**
 * Library to import data from .csv files
 */
class MY_Excel {

	/**
	 * Import data from .csv file to a single table.
	 * Reference: http://csv.thephpleague.com/
	 * 
	 * Sample usage:
	 * 	$fields = array('name', 'email', 'age', 'active');
	 *  $this->load->library('data_importer');
	 *  $this->data_importer->csv_import('data.csv', 'users', $fields, TRUE);
	 */
	public function csv_import($file, $table, $fields, $clear_table = FALSE, $delimiter = ',', $skip_header = TRUE)
	{
		$CI =& get_instance();
		$CI->load->database();

		// prepend file path with project directory
		$reader = League\Csv\Reader::createFromPath(FCPATH.$file);
		$reader->setDelimiter($delimiter);

		// (optional) skip header row
		if ($skip_header)
			$reader->setOffset(1);

		// prepare array to be imported
		$data = array();
		$count_fields = count($fields);
		$query_result = $reader->query();
		foreach ($query_result as $idx => $row)
		{
			// skip empty rows
			if ( !empty($row[0]) )
			{
				$temp = array();
				for ($i=0; $i<$count_fields; $i++)
				{
					$name = key($fields[$i]);
					$value = $row[$i];
					$temp[$name] = $value;
				}
				$data[] = $temp;
			}
		}

		// (optional) empty existing table
		if ($clear_table)
			$CI->db->truncate($table);

		// confirm import (return number of records inserted)
		return $CI->db->insert_batch($table, $data);
	}

	/**
	 * Import data from Excel file to a single table.
	 * Reference: https://phpexcel.codeplex.com/
	 *
	 * TODO: complete feature
	 */
	function _excel_data($file, $skip=0, $fields=null,$format=null,$persistent=null){ 
		if($fields!=null && !is_array($fields)) return false;
		if($format!=null && !is_array($format)) return false;
		if($persistent!=null && !is_array($persistent)) return false;
		if(!is_numeric($skip)) return false;
		// prepend file path with project directory
		$excel = PHPExcel_IOFactory::load(FCPATH.$file);
		$objWorksheet = $excel->getActiveSheet();
		$data=array();
		$count_fields = count($fields);
		foreach ($objWorksheet->getRowIterator() as $rowIndex=>$row) {
			if ($rowIndex <= $skip) continue;
			$temp=$persistent;
			foreach($fields as $field=>$col){
				$value = $objWorksheet->getCell($col . $rowIndex);
				$temp[$field]=$value.'';
			}
	    	$data[]=$temp;
		}
		if($format!=null && is_array($format)){
			foreach ($format as $field => $type) {
				switch($type){
					case 'date':
						$data=$this->_convert_date($data,$field);
						break;
				}
			}
		}
		return $data;
	}	
	/**
	*$file: Excel file read to import to database table
	*$table: Data table to import, if empty return data array, else insert to the table
	*$fields: Excel column read for table field
			eg. array('table field name'=>'excel_column_letter')
			eg. array('name_e'=>'B','name_c'=>'B','phone'=>'C','gender'=>'D','dob'=>'F')
	*format: Special format that need to convert before insert to table
			et. array('table field name' => 'required format')
			eg. array('dob'=>'date', 'start_date'=>'date');
	*persistent: array('id'=>1)		
	**/
	public function excel_import($file, $table, $skip=0, $fields=null,$format=null,$persistent=null){
		$CI =& get_instance();
		$CI->load->database();

		$data=$this->_excel_data($file, $skip, $fields,$format,$persistent);
		echo '<h1>The data to import!</h1><br>';
		echo 'from file:'.FCPATH.$file.'<br>';
		echo 'to table: '.$table.'<br>';
		echo 'skip row: '.$skip.'<br>';
		echo 'field array: '.json_encode($fields).'<br>';
		echo 'format to change: '.json_encode($format).'<br>';
		echo 'persistent field:'.json_encode($persistent).'<br>';
		echo '<p></p>';
		echo json_encode($data);
		//$CI->db->insert_batch($table,$data);
	}

	function _convert_date($data, $field){
		foreach($data as $rowIndex=>$row){
			foreach($row as $col=>$value){
				if($col==$field){
				    $data[$rowIndex][$field]=date('Y-m-d',strtotime('1899-12-30+'.$value.' day'));
				}
			}
		}
		return $data;
	}

	function excel_export($data)
	{
		$string_to_export = "";
		foreach($data[0] as $field=>$value){
			$string_to_export.=$field."\t";
		}
		$string_to_export .= "\n";
		foreach($data as $row){
			foreach($row as $field){
				$string_to_export.=$field."\t";
			}
			$string_to_export.="\n";
		}
		// Convert to UTF-16LE and Prepend BOM
		$string_to_export = "\xFF\xFE" .mb_convert_encoding($string_to_export, 'UTF-16LE', 'UTF-8');

		$filename = "export-".date("Y-m-d_H:i:s").".xls";

		header('Content-type: application/vnd.ms-excel;charset=UTF-16LE');
		header('Content-Disposition: attachment; filename='.$filename);
		header("Cache-Control: no-cache");
		echo $string_to_export;
		die();
	}

}