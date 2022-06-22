<?php 

class Forms_generator_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }
    var $table = '';
    var $foreign_key = '';
    
    public function set_foreign_key($id){
        $this->foreign_key = $id;
    }
    public function set_table($table){
        $this->table = $table;
    }

    public function save($formData){


        $data = array();
        foreach ($formData as $key => $value) {
            if ($this->db->field_exists($key,$this->table ) )
            {
                // check field exist
                $data[$key] = $value;
            }else{
                
            }
        }
        
        $this->db->where('id', $data['id']);
        $this->db->update($this->table,$data);
    }

    public function get_form(){
        $query = $this->db->where($this->foreign_key,$id)
                        ->get($this->table);
        // Check if the event already has a form
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            //Create a form
            return $this->_create_form($id);
        }
    }

    function _create_form($id){
        $data=array(
            $this->foreign_key=>$id,
            'code'=>rand(100000,999999),
            'form_lang'=>'["zh"]',
            'title'=>'[]',
            'welcome'=>'[]',
            'form_fields'=>'[]',
            'success'=>'[]',
            'success_title'=>'[]',
            'uploads'=>'[]',
            'user_id'=>$_SESSION['user_id'],
        );
        $this->db->insert($this->table,$data);

        //return the inserted row
        return $this->db->where('id',$this->db->insert_id() )
                    ->get($this->table)
                    ->row();
    }
}