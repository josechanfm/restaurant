<?php 

class Gc_dependent_select_model extends MY_Model {
	function get_js($crud,$properties){
		$this->load->library('gc_dependent_select');
		 foreach($properties['fields'] as $prop){
			$crud->set_relation($prop['id'],$prop['table_name'],$prop['title']);
			$fields[$prop['id']]= array( // first dropdown name
						'table_name' => $prop['table_name'], // table of country
						'title' => $prop['title'], // country title
						'id_field'=>'id',
						'relate' => $prop['relate'], // the first dropdown hasn't a relation
						'data-placeholder' => 'select course' //dropdown's data-placeholder:
					);
		 };
		$config = array(
			'main_table' => $properties['config']['main_table'],
			'main_table_primary' => $properties['config']['main_table_primary'],
			'url' => site_url().$properties['config']['url'].'/', //path to method
			'ajax_loader' => '',// base_url() . 'assets/custom/images/ajax-loader.gif', // path to ajax-loader image. It's an optional parameter
			'segment_name' => 'get_items' // It's an optional parameter. by default "get_items"
		);

		$categories = new gc_dependent_select($crud, $fields, $config);
		return $categories->get_js();		
	}

	//each dependent dropdown set, need to create a get_xxxx_properties() function 
	function get_courses_properties(){
		$p= array(
			'fields'=>array(
				array(
					'id'=>'faculty_id',
					'table_name'=>'faculties',
					'title'=>'name',
					'relate'=>null
				),
				array(
					'id'=>'department_id',
					'table_name'=>'departments',
					'title'=>'name',
					'relate'=>'faculty_id'
				)
			),
			'config'=>array(
				'main_table'=>'courses',
				'main_table_primary'=>'id',
				'url'=>'admin/school/course'
			)
		);
		return $p;
	}


}