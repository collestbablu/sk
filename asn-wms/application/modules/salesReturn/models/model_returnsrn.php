<?php
class model_returnsrn extends CI_Model {
	
function returnsrn_data(){
	  $query=$this->db->query("select * from tbl_return_hdr where return_type='Return'  Order by returnid desc ");
	  
	  
      
	  return $result=$query->result();  
}

}
