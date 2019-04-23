<?php
class model_salesorder extends CI_Model {
	
function salesorder_data()
{
	
	if($this->session->userdata('user_id')=='1')
	{
		 $query=$this->db->query("select * from tbl_stock_in_hdr where comp_id='".$this->session->userdata('comp_id')."' and order_type!='other_inbound'    Order by stockinid desc ");
	}
	else
	{
	  $query=$this->db->query("select * from tbl_stock_in_hdr where order_type!='other_inbound'  and comp_id='".$this->session->userdata('comp_id')."' Order by stockinid desc ");
	}
	  return $result=$query->result();  
}

//==============Pre Alert========================

function getPreAlert($last,$strat)
{
		
	  if($this->session->userdata('user_id')=='1')
	  {
	  	$query=$this->db->query("select * from tbl_stock_in_hdr where comp_id='".$this->session->userdata('comp_id')."' and order_type!='other_inbound'  Order by stockinid desc limit $strat,$last");
	  }
	  else
	  {
	  	$query=$this->db->query("select * from tbl_stock_in_hdr where order_type!='other_inbound' and comp_id='".$this->session->userdata('comp_id')."'  Order by stockinid desc limit $strat,$last");
	  }
	  return $result=$query->result();  
}
 
function filterPreAlert($perpage,$pages,$get)
{
 	
		if($this->session->userdata('user_id')=='1')
		{
	        $qry = "select * from tbl_stock_in_hdr where comp_id='".$this->session->userdata('comp_id')."' and order_type!='other_inbound'";
		}
		else
		{
			$qry = "select * from tbl_stock_in_hdr where order_type!='other_inbound' and comp_id='".$this->session->userdata('comp_id')."' ";
		}
    
	     if(sizeof($get) > 0)
		 {
          
		 	if($get['stockinid'] != "")
		  		$qry .= " AND stockinid = '".$get['stockinid']."'";
			
			if($get['hawb'] != "")
	     	    $qry .= " AND hawb LIKE '%".$get['hawb']."%'";
				
			if($get['mawb_no'] != "")
	      	   $qry .= " AND mawb_no LIKE '%".$get['mawb_no']."%'";
		 	
		    if($get['origin'] != "")
		     {
			   $unitQuery2=$this->db->query("select * from tbl_master_data where param_id = '25' AND keyvalue LIKE '%".$get['origin']."%' ");
		       $getUnit2=$unitQuery2->row();
		       $sr_no2=$getUnit2->serial_number;
		 
			   $qry .= " AND origin ='$sr_no2'";
		     }
		      
		    if($get['destination'] != "")
		     {
			   $unitQuery=$this->db->query("select * from tbl_master_data where param_id = '25' AND keyvalue LIKE '%".$get['destination']."%' ");
		       $getUnit=$unitQuery->row();
		       $sr_no=$getUnit->serial_number;
		 
			   $qry .= " AND destination ='$sr_no'";
             }
	  		
		    if($get['HAWB_booking_date'] != "")
		  	  $qry .= " AND HAWB_booking_date = '".$get['HAWB_booking_date']."'";
			
		    if($get['port_of_loading'] != "")
		     {
		   		$pol=$this->db->query("select *from tbl_master_data where param_id = '32' AND keyvalue LIKE '%".$get['port_of_loading']."%' ");
				$getPol=$pol->row();
		
		  	   $qry .= " AND port_of_loading = '$getPol->serial_number'";
			 }
			
			if($get['pre_alert_date'] != "")
		  	  $qry .= " AND pre_alert_date = '".$get['pre_alert_date']."'";
			 
			if($get['eta_date'] != "")
		  	  $qry .= " AND eta_date = '".$get['eta_date']."'";
			  
			 if($get['status'] != "")
			 {
		   		$status=$this->db->query("select *from tbl_master_data where param_id = '27' AND keyvalue LIKE '%".$get['status']."%' ");
				$getStatus=$status->row();
		
		  	   $qry .= " AND status = '$getStatus->serial_number'";
		     }
	      }
		  
		  $qry .= " LIMIT $pages,$perpage";
 
    $data =  $this->db->query($qry)->result();
	
  return $data;
  
}

function count_preAlert($tableName,$status = 0,$get)
{
   
    if($this->session->userdata('user_id')=='1')
	{
       $qry ="select count(*) as countval from $tableName where comp_id='".$this->session->userdata('comp_id')."' and order_type!='other_inbound' ";
    }
	else
	{
	   $qry ="select count(*) as countval from $tableName where order_type!='other_inbound' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
 	
	  if(sizeof($get) > 0)
		 {
          
		 	if($get['stockinid'] != "")
		  		$qry .= " AND stockinid = '".$get['stockinid']."'";
			
			if($get['hawb'] != "")
	     	    $qry .= " AND hawb LIKE '%".$get['hawb']."%'";
				
			if($get['mawb_no'] != "")
	      	   $qry .= " AND mawb_no LIKE '%".$get['mawb_no']."%'";
		 	
		    if($get['origin'] != "")
		     {
			   $unitQuery2=$this->db->query("select * from tbl_master_data where param_id = '25' AND keyvalue LIKE '%".$get['origin']."%' ");
		       $getUnit2=$unitQuery2->row();
		       $sr_no2=$getUnit2->serial_number;
		 
			   $qry .= " AND origin ='$sr_no2'";
		     }
		      
		    if($get['destination'] != "")
		     {
			   $unitQuery=$this->db->query("select * from tbl_master_data where param_id = '25' AND keyvalue LIKE '%".$get['destination']."%' ");
		       $getUnit=$unitQuery->row();
		       $sr_no=$getUnit->serial_number;
		 
			   $qry .= " AND destination ='$sr_no'";
             }
	  		
		    if($get['HAWB_booking_date'] != "")
		  	  $qry .= " AND HAWB_booking_date = '".$get['HAWB_booking_date']."'";
			
		    if($get['port_of_loading'] != "")
		     {
		   		$pol=$this->db->query("select *from tbl_master_data where param_id = '32' AND keyvalue LIKE '%".$get['port_of_loading']."%' ");
				$getPol=$pol->row();
		
		  	   $qry .= " AND port_of_loading = '$getPol->serial_number'";
			 }
			
			if($get['pre_alert_date'] != "")
		  	  $qry .= " AND pre_alert_date = '".$get['pre_alert_date']."'";
			 
			if($get['eta_date'] != "")
		  	  $qry .= " AND eta_date = '".$get['eta_date']."'";
			  
			 if($get['status'] != "")
			 {
		   		$status=$this->db->query("select *from tbl_master_data where param_id = '27' AND keyvalue LIKE '%".$get['status']."%' ");
				$getStatus=$status->row();
		
		  	   $qry .= " AND status = '$getStatus->serial_number'";
		     }
	      }
	 
	 
  	 $query=$this->db->query($qry,array($status))->result_array();
   
   return $query[0]['countval'];
} 


}
?>