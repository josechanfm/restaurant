<?php 

class Products_model extends MY_Model {
	public $has_many=array('loaner_items'=>array(
		'model'=>'loaner_items_model',
		'primary_key'=>'pid'
	));	
}