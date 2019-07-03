<?php 
class Sms_model extends MY_Model {
  function send_sms($recipient,$content){
    $sms_username=$this->config->item('three_sms')['user'];
    $sms_password=$this->config->item('three_sms')['pwd'];
    $sms_url='http://smsmgr01.three.com.mo/servlet/_xml';
    $sms_header='"Content-type : text/xml; charset=UTF-8\"';

    $sms_xml ="<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
    $sms_xml.="<!DOCTYPE jds SYSTEM \"/home/httpd/dtd/jds2.dtd\">";
    $sms_xml.="<jds>";
    $sms_xml.="<account acid=\"ccc\" loginid=\"".$sms_username."\" passwd=\"".$sms_password."\">";
    $sms_xml.="<msg_send>";
    if(is_array($recipient)){
      foreach($recipient as $num){
        $sms_xml.="<recipient>".$num."</recipient>";
      }
    }else{
      $sms_xml.="<recipient>".$recipient."</recipient>";
    }
    $sms_xml.="<content>".$content."</content>";
    $sms_xml.="<language>C</language>";
    $sms_xml.="</msg_send>";
    $sms_xml.="</account>";
    $sms_xml.="</jds>";

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
    }
    else{
      //error
    }

    // close the socket connection:
    fclose($fp);
    // split the result header from the content
    echo $result;
    $result = explode("\r\n\r\n", $result, 2);

    $header = isset($result[0]) ? $result[0] : '';
    $content = isset($result[1]) ? $result[1] : '';

  }
}