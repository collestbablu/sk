<?php
class model_stock extends CI_Model {
	
function stock_data(){
	  $query=$this->db->query("select * from tbl_adjustment_hdr where status='A' Order by adjid desc ");
	  
	  
      
	  return $result=$query->result();  
}

}
function count_all($tableName,$status = 0,$get)
{
       if($this->session->userdata('user_id')=='1')
		{	
   		  $qry ="select count(*) as countval from $tableName where maker_id='1' ";
        }
		else
		{
		  $qry ="select count(*) as countval from $tableName where comp_id='".$this->session->userdata('comp_id')."'";
		}
		 
         //====================Product Search=======================
		 
		 
	 
     
  	 $query=$this->db->query($qry,array($status))->result_array();
   
   return $query[0]['countval'];
} 
