<?php 

class Forms_generator extends CI_Model {

	protected $table = '';
	protected $foreign_key = '';

	public function __construct()
    {
        parent::__construct();
        $this->set_config();
		
    }

    function set_config(){
    	// echo '../../third_party/forms_generator/config/Forms_generator.php';
    	// echo file_exists(APPPATH.'modules/admin/config/'.'Forms_generator.php');
    	//$this->load->config('Forms_generator.php');
    	// $this->load->config('../../third_party/forms_generator/config/Forms_generator.php');
    	$this->load->config('Forms_generator.php');
    	echo $this->config->item("form_lang");
    }

    public function set_foreign_key($field){
        $this->foreign_key = $field;
    }
    public function set_table($table){
        $this->table = $table;
    }

    public function get_form($id = null){
        modules::run('edit');
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
}
	

