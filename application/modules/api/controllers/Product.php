<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {
	public function __construct()
	{
		$this->load->model('products_model','products');
		$this->load->library('jwt_client');
	}

	public function get_all(){
		header('Content-Type: application/json');
		echo json_encode($this->products->get_all());
	}

	public function test_jwt_encode(){
		echo $this->jwt_client->encode(array("first_name"=>"Jose", "last_name"=>"Chan"));
	}	
	public function test_jwt_decode(){
		$data=$this->jwt_client->decode('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJDSSBCb290c3RyYXAgMyIsImlhdCI6MTYyMTg0ODI0NywianRpIjoiYTFkMjExZDUyNWY1MmI4MWZhMjc1NTY1MDA2NWU4YzYiLCJmaXJzdF9uYW1lIjoiSm9zZSIsImxhc3RfbmFtZSI6IkNoYW4ifQ.c3LSaPBOWCS3CoG2ySry-MlIT97HJanQfzxuGYV5onw');
		echo json_encode($data);
	}
}
