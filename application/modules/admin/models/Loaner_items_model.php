<?php 

class Loaner_items_model extends MY_Model {

	public function get_lent(){
		return $this->db->select('l.name as loaner_name, l.date_start, l.date_end,p.brand as product_brand, p.name as product_name,p.description as product_description,i.*')->join('loaner as l','l.id=i.loaner_id')->join('products as p','p.id=i.pid')->get('loaner_items as i')->result();
	}
}