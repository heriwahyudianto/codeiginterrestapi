<?php  
class Customer_model extends CI_Model {
    public function listall()
    {   $datas=$this->db->get('customer')->result_array();
    	return $datas;
    }

    public function get($id)
    {   
    	$this->db->where('id', $id);
    	$data=$this->db->get('customer')->result_array();
    	if (count($data)>0){
    		 return $data[0];
    	} else {
    		return [];
    	}        
    }
    public function add($datas)
    {   
    	$this->db->insert('customer', $datas);
    	return 1;    
    }
} 
?>