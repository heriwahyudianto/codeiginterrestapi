<?php  
class Transaction_model extends CI_Model {
    public function listall()
    {   $datas=$this->db->get('transaction')->result_array();
    	return $datas;
    }

    public function getbycustid($id)
    {   
    	$this->db->where('customerid', $id);
    	$this->db->order_by('create_at', 'ASC');
    	$data=$this->db->get('transaction')->result_array();    	
    	return $data;    	      
    }
    public function add($datas)
    {   
    	$this->db->insert('transaction', $datas);
    	return 1;    
    }
    public function transfer($fromdatas,$todatas)
    {   
    	$this->db->insert('transaction', $fromdatas);
    	$this->db->insert('transaction', $todatas);
    	return 1;    
    }
} 
?>