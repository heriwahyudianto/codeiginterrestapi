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
    public function getbyaccount($accountnumber)
    {
        $this->db->where('accountnumber', $accountnumber);
        $data=$this->db->get('customer')->result_array();
        if (count($data)>0){
             return $data[0]['id'];
        } else {
            return 0;
        } 
    }
    public function add($datas)
    {   
    	$this->db->insert('customer', $datas);
    	return 1;    
    }
    public function login($datas)
    {
        $this->db->where('accountnumber', $datas['accountnumber']);
        $this->db->where('password', md5($datas['password']));
        $data=$this->db->get('customer')->result_array();
        if (count($data)>0){
             return $data[0];
        } else {
            return [];
        }  
    }
} 
?>