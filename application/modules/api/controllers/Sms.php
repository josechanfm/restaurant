<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms extends MY_Controller {

	public function send()
	{
		$key=date('Y-m-d');
		if(hash('crc32','123456'.$key,false)==$_POST['secret_key']){
			$recipients=preg_split("/(,|;)/",$_POST['recipient']);
			$content=$_POST['content'];
			//$this->send_sms($recipients,$recipients);//
			redirect($_SERVER["HTTP_REFERER"]);
		}else{
			echo 'Secret key incorrect!';
			echo 'Please contact your system administrator';
		}
	}

	function send_sms($recipients,$content){
		$this->load->config('sms');
		$sms_company=$this->config->item('three_sms')['company'];
		$sms_username=$this->config->item('three_sms')['user'];
		$sms_password=$this->config->item('three_sms')['pwd'];
		$sms_url=$this->config->item('three_sms')['url'];
		$sms_header='"Content-type : text/xml; charset=UTF-8\"';

		$sms_xml ="<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
		$sms_xml.="<!DOCTYPE jds SYSTEM \"/home/httpd/dtd/jds2.dtd\">";
		$sms_xml.="<jds>";
		$sms_xml.="<account acid=\"".$sms_company."\" loginid=\"".$sms_username."\" passwd=\"".$sms_password."\">";
		$sms_xml.="<msg_send>";

		if(is_array($recipients)){
		  foreach($recipients as $num){
		    $sms_xml.="<recipient>".$num."</recipient>";
		  }
		}else{
		  $sms_xml.="<recipient>".$recipients."</recipient>";
		}
		$sms_xml.="<content>".$content."</content>";
		$sms_xml.="<language>C</language>";
		$sms_xml.="</msg_send>";
		$sms_xml.="</account>";
		$sms_xml.="</jds>";
		echo $sms_xml;

		preg_match('/^(.+:\/\/)([^:\/]+)(\/.+)/', $sms_url, $matches);

		$protocol = $matches[1];
		$host = $matches[2];
		$uri = $matches[3];

		// open a socket connection on port 80 - timeout: 30 sec
		$fp = fsockopen($host, 80, $errno, $errstr, 5);

		if ($fp){
		  $httpHeader = "POST $sms_url HTTP/1.1\r\n";
		  $httpHeader .= $sms_header;
		  $httpHeader .= "Host: $host:80\r\n";
		  $httpHeader .= "Content-length: ". mb_strlen($sms_xml) ."\r\n";
		  $httpHeader .= "Connection: close\r\n";
		  $httpHeader .= "\r\n";

		  $httpBody = $sms_xml."\r\n";
		  // send the request headers:
		  fputs($fp, $httpHeader.$httpBody);

		  $result = '';
		  while(!feof($fp)) {
		    // receive the results of the request
		    $result .= fgets($fp, 2048);
		  }
		}else{
		  //error
		}

		// close the socket connection:
		fclose($fp);
		// split the result header from the content
		// echo $result;
		// $result = explode("\r\n\r\n", $result, 2);

		// $header = isset($result[0]) ? $result[0] : '';
		// $content = isset($result[1]) ? $result[1] : '';
	}	
}



