<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends MY_Controller {

	public function index(){
		$this->render('events');
	}

	public function ajax_get_events(){
		echo json_encode($this->db->get('events')->result());
	}

	public function forms($eventId){
		if($eventId == null){
			redirect('./');
		}
		$this->add_script('/assets/forms_generator/event_form_vue.js');

		$this->add_stylesheet('/assets/dist/admin/bootstrap4/css/dataTables.bootstrap4.min.css');
		

		$data=$this->db->where('event_id',$eventId)->get('forms')->row();

		$this->mViewData['data']=$data;

		$this->render($this->mCtrler.'/'.$this->mAction);
	}

	public function ajax_get_event_form(){
		$postData = json_decode(file_get_contents('php://input'), true);
		// $postData = json_decode(file_get_contents('php://input'), true);
        $data = $this->db->where('id',$postData['form_id'])->get('forms')->row();
        echo json_encode($data);
	}
	public function ajax_submit_event_form(){
		
		$form_id = $_POST['form_id'];
		$fields = $_POST['fields'];

		$uploads = $this->_upload_file($_FILES);

		$data=[
			'form_id'=>$form_id,
			'uploads'=>$uploads,
			// 'net_id'=>$_POST['net_id'],
			'fields'=>$fields,
		];
		$this->db->insert('form_applies',$data);

		echo json_encode($_FILES);
	}

	public function _upload_file($files){
		$path = './assets/uploads/form_files';

		$config['upload_path']          = $path;
        $config['allowed_types']        = 'xlsx|docx|doc|ppt|jpg|jpeg|png|pdf';
        $config['max_size']             = 20000;
        $config['max_width']            = 4096;
        $config['max_height']           = 3072;
        $this->load->library('upload', $config);

        $uploads = array();
		foreach ($files as $key => $file) {
			$files[$key]['path'] = $path.'/'.$file['name'];
			$this->upload->do_upload($key);

			//Set the upload field
			$uploads[$key] = [
				"name"=>$file['name'],
				"path"=>$path.'/'.$file['name']
			];
		}
        return json_encode($uploads);
		// $this->db->insert('applications',$postData);
	}

}