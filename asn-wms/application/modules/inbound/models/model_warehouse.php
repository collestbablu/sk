<?php
class model_warehouse extends CI_Model {
	
function out_data()
{
	if($this->session->userdata('user_id')=='1')
	{
	  $query=$this->db->query("select * from tbl_stock_out_hdr where contact_id='SennheiserDELW-H'  Order by stockoutid desc ");
	}
	if($this->session->userdata('comp_id')=='3')
	{
		 $query=$this->db->query("select * from tbl_stock_out_hdr where contact_id='SennheiserBLRW-H'  Order by stockoutid desc ");
	}
	
  return $result=$query->result();  
}


}
?>