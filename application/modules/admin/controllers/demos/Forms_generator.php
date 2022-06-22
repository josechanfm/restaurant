<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forms_generator extends Admin_Controller {

	protected $table = '';
	protected $foreign_key = '';

	public function __construct()
    {
        parent::__construct();
        $this->add_script('assets/forms_generator/vue.min.js',FALSE,'head');
        $this->add_script('assets/forms_generator/axios.min.js',FALSE,'head');
        $this->add_script('assets/forms_generator/edit_vue.js');
        $this->set_config();
    }

    function set_config_file($fileName){
        $_SESSION['config_file'] = $fileName;
        $this->set_config();
    }
    function set_config(){
        if(!isset($_SESSION['config_file']) ){
            return;
        }
        $this->load->config($_SESSION['config_file']);
        $this->set_table();        
    }
    function set_table(){
        $this->foreign_key = $this->config->item('foreign_key');
        $this->table = $this->config->item('table');
    }

    public function form($id){

        $this->mViewData['id'] = $id;
        $this->mViewData['ctrl_path'] = base_url().$this->mModule.'/'.basename(__DIR__).'/forms_generator';
        $this->render("forms_generator/edit");
    }

    //Save Form function 
    public function form_save(){
        $formData = file_get_contents('php://input');
        $formData = json_decode($formData, true);
        $this->_save($formData);
        echo json_encode($formData);
    }
    public function _save($formData){
        $data = array();
        foreach ($formData as $key => $value) {
            if ($this->db->field_exists($key,$this->table ) )
            {
                // check field exist
                $data[$key] = $value;
            }
        }
        $this->db->where('id', $data['id']);
        $this->db->update($this->table,$data);
    }
    //Save
    //--------------

    //Get Form or Create a new one
    public function get($Id = null){
        $this->set_config();
        $query = $this->db->where($this->foreign_key,$Id)
                        ->get($this->table);
        // Check if the event already has a form
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            //Create a form
            return $this->_create_form($Id);
        }
    }
    function _create_form($Id){
        $data=array(
            $this->foreign_key=>$Id,
            'code'=>rand(100000,999999),
            'fields'=>'[]',
            'welcome'=>'[]',
            'welcome_title'=>'[]',
            'success'=>'[]',
            'success_title'=>'[]',
        );
        $data['lang'] = json_encode( 
                    $this->config->item('lang')?
                        $this->config->item('lang'):array("zh") 
                    );
        $this->db->insert($this->table,$data);

        //return the inserted row
        return $this->db->where('id',$this->db->insert_id() )
                    ->get($this->table)
                    ->row();
    }
    public function get_form($Id=null){
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($this->get($Id));
    }
    //Get
    //--------------
}
	

