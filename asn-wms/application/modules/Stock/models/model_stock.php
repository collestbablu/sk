<?php
class model_stock extends CI_Model {
	
function stock_data(){
	  $query=$this->db->query("select * from tbl_bom_hdr where status='A' Order by bom_id_hdr desc ");
	  
	  
      
	  return $result=$query->result();  
}

}
