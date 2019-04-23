<?php
class model_salesorder_other extends CI_Model {
	
function salesorder_data_other(){
	
	if($this->session->userdata('user_id')=='1')
	{
	 $query=$this->db->query("select * from tbl_stock_in_hdr where comp_id='".$this->session->userdata('comp_id')."' and order_type='other_inbound'  Order by stockinid desc ");	
	}
	else
	{
	  $query=$this->db->query("select * from tbl_stock_in_hdr where order_type='other_inbound' and comp_id='".$this->session->userdata('comp_id')."'  Order by stockinid desc ");
	  
	}
	  return $result=$query->result();  
}

//==============================Inbound Other===============================

function getOtherInbound($last,$strat)
{

		if($this->session->userdata('user_id')=='1')
		{
			$query=$this->db->query("select * from tbl_stock_in_hdr where comp_id='".$this->session->userdata('comp_id')."' and order_type='other_inbound'  Order by stockinid desc limit $strat,$last");
		}
		else
		{
			$query=$this->db->query("select * from tbl_stock_in_hdr where order_type='other_inbound' and comp_id='".$this->session->userdata('comp_id')."'  Order by stockinid desc limit $strat,$last ");
		}

	  return $result=$query->result();  

}
 
function filterOtherInbound($perpage,$pages,$get)
{
 		
		if($this->session->userdata('user_id')=='1')
		{
          $qry = "select * from tbl_stock_in_hdr where comp_id='".$this->session->userdata('comp_id')."' and order_type='other_inbound'";
    	}
		else
		{
		  $qry = "select * from tbl_stock_in_hdr where order_type='other_inbound' and comp_id='".$this->session->userdata('comp_id')."' ";
		}

	     if(sizeof($get) > 0)
		 {
         
		 	if($get['stockinid'] != "")
		  		$qry .= " AND stockinid = '".$get['stockinid']."'";
			
			if($get['date'] != "")
	     	    $qry .= " AND date LIKE '%".$get['date']."%'";
				
			if($get['original_inv_rec_time'] != "")
	       	   $qry .= " AND original_inv_rec_time LIKE '%".$get['original_inv_rec_time']."%'";
		 	
		    if($get['customer'] != "")
			 {
			    $unitQuery2=$this->db->query("select * from tbl_contact_m where first_name LIKE '%".$get['customer']."%' ");
		        $getUnit2=$unitQuery2->row();
		        $sr_no2=$getUnit2->code;
			    $qry .= " AND supplier_id ='$sr_no2'";
			 }
		      
		    if($get['order_no'] != "")
			   $qry .= " AND order_no ='".$get['order_no']."'";
         
	  	    if($get['invoice_no'] != "")
		  	   $qry .= " AND invoice_no = '".$get['invoice_no']."'";
			
		    if($get['origin'] != "")
		     {
		   		$pol=$this->db->query("select * from tbl_master_data where keyvalue LIKE '%".$get['origin']."%'");
				$getPol=$pol->row();
		  	    $qry .= " AND origin = '$getPol->serial_number'";
 		     }
			  
			 if($get['type'] != "")
			 {
		   		$status=$this->db->query("select * from tbl_master_data where keyvalue LIKE '%".$get['type']."%'");
				$getStatus=$status->row();
		  	    $qry .= " AND type = '$getStatus->serial_number'";
		     }
	      }
		  
		  $qry .= " LIMIT $pages,$perpage";
 
    $data =  $this->db->query($qry)->result();

  return $data;

}

function count_other_inbound($tableName,$status = 0,$get)
{
	   if($this->session->userdata('user_id')=='1')
	   {
			$qry ="select count(*) as countval from $tableName where comp_id='".$this->session->userdata('comp_id')."' and order_type='other_inbound' ";
	   }
	   else
	   {
			$qry ="select count(*) as countval from $tableName where order_type='other_inbound' and comp_id='".$this->session->userdata('comp_id')."' ";
	   }      
		 	
	 if(sizeof($get) > 0)
		 {
         
		 	if($get['stockinid'] != "")
		  		$qry .= " AND stockinid = '".$get['stockinid']."'";
			
			if($get['date'] != "")
	     	    $qry .= " AND date LIKE '%".$get['date']."%'";
				
			if($get['original_inv_rec_time'] != "")
	       	   $qry .= " AND original_inv_rec_time LIKE '%".$get['original_inv_rec_time']."%'";
		 	
		    if($get['customer'] != "")
			 {
			    $unitQuery2=$this->db->query("select * from tbl_contact_m where first_name LIKE '%".$get['customer']."%' ");
		        $getUnit2=$unitQuery2->row();
		        $sr_no2=$getUnit2->code;
			    $qry .= " AND supplier_id ='$sr_no2'";
			 }
		      
		    if($get['order_no'] != "")
			   $qry .= " AND order_no ='".$get['order_no']."'";
         
	  	    if($get['invoice_no'] != "")
		  	   $qry .= " AND invoice_no = '".$get['invoice_no']."'";
			
		    if($get['origin'] != "")
		     {
		   		$pol=$this->db->query("select * from tbl_master_data where keyvalue LIKE '%".$get['origin']."%'");
				$getPol=$pol->row();
		  	    $qry .= " AND origin = '$getPol->serial_number'";
 		     }
			  
			 if($get['type'] != "")
			 {
		   		$status=$this->db->query("select * from tbl_master_data where keyvalue LIKE '%".$get['type']."%'");
				$getStatus=$status->row();
		  	    $qry .= " AND type = '$getStatus->serial_number'";
		     }
	      }
	 
  	 $query=$this->db->query($qry,array($status))->result_array();
   
   return $query[0]['countval'];
} 


}

?>