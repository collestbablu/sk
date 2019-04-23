<?php
class model_returndemo extends CI_Model {
	
function returnDemo_data()
{
	if($this->session->userdata('user_id')=='1')
	{
	
	  $query=$this->db->query("select * from tbl_return_hdr where comp_id='".$this->session->userdata('comp_id')."' and return_type='Demo'  Order by returnid desc  ");
	}
	else
	{
		 $query=$this->db->query("select * from tbl_return_hdr where  comp_id='".$this->session->userdata('comp_id')."' and  return_type='Demo'  Order by returnid desc  ");
	}
	  
   return $result=$query->result();  
}

//=====================Demo outbond=======================

function get_return_demo_data($last,$strat)
{
		
	if($this->session->userdata('user_id')=='1')
	{
	   $query=$this->db->query("select * from tbl_return_hdr where comp_id='".$this->session->userdata('comp_id')."' and return_type='Demo'  Order by returnid desc  limit $strat,$last");
	}
	else
	{
	   $query=$this->db->query("select * from tbl_return_hdr where return_type='Demo' and comp_id='".$this->session->userdata('comp_id')."'  Order by returnid desc  limit $strat,$last");
	}
	  return $result=$query->result();  

}
 
function filterDemoOutbondData($perpage,$pages,$get)
{
 	
		if($this->session->userdata('user_id')=='1')
		{
           $qry = "select * from tbl_return_hdr where comp_id='".$this->session->userdata('comp_id')."' and return_type='Demo' ";
    	}
		else
		{
		   $qry = "select * from tbl_return_hdr where return_type='Demo' and comp_id='".$this->session->userdata('comp_id')."' ";
		}

	   if(sizeof($get) > 0)
		{
         
		   if($get['returnid'] != "")
		   		$qry .="and returnid = '".$get['returnid']."' ";
		 
		   if($get['respblty'] != "")
		     {
			   $unitQuery2=$this->db->query("select * from tbl_contact_m where first_name LIKE '%".$get['respblty']."%'");
		       $getUnit2=$unitQuery2->row();
		       $sr_no2=$getUnit2->contact_id;
			   $qry .= " AND responsibility ='$sr_no2'";
			 }
		      
		   if($get['g_p_date'] != "")
			  $qry .= " AND rgp_gate_pass_date like '%".$get['g_p_date']."%' ";
     
		   if($get['rt_due_date'] != "")
			  $qry .= " AND return_due_date LIKE '%".$get['rt_due_date']."%'";
			  
		   if($get['g_p_no'] !="")
		      $qry .= "and rgp_gatepass_no like '%".$get['g_p_no']."%' ";
			
		   if($get['m_g_p_no'] !="")
		 	  $qry .= "and manual_gate_pass_no like '%".$get['m_g_p_no']."%' ";
			
		   if($get['m_g_p_date'] !="")
		 	  $qry .=" and manual_gp_date like '%".$get['m_g_p_date']."%' ";
	   }
	 
	  $qry .= " LIMIT $pages,$perpage";
 
    $data =  $this->db->query($qry)->result();
	
  return $data;
  
}

function count_demo_outbound($tableName,$status = 0,$get)
{
    if($this->session->userdata('user_id')=='1')
    {
   		$qry ="select count(*) as countval from $tableName where comp_id='".$this->session->userdata('comp_id')."' and return_type='Demo'";
    }
	else
	{	
		$qry ="select count(*) as countval from $tableName where return_type='Demo' and comp_id='".$this->session->userdata('comp_id')."' ";
	}


     if(sizeof($get) > 0)
		{
         
		   if($get['returnid'] != "")
		   		$qry .="and returnid = '".$get['returnid']."' ";
		 
		   if($get['respblty'] != "")
		     {
			   $unitQuery2=$this->db->query("select * from tbl_contact_m where first_name LIKE '%".$get['respblty']."%'");
		       $getUnit2=$unitQuery2->row();
		       $sr_no2=$getUnit2->contact_id;
			   $qry .= " AND responsibility ='$sr_no2'";
			 }
		      
		   if($get['g_p_date'] != "")
			  $qry .= " AND rgp_gate_pass_date like '%".$get['g_p_date']."%' ";
     
		   if($get['rt_due_date'] != "")
			  $qry .= " AND return_due_date LIKE '%".$get['rt_due_date']."%'";
			  
		   if($get['g_p_no'] !="")
		      $qry .= "and rgp_gatepass_no like '%".$get['g_p_no']."%' ";
			
		   if($get['m_g_p_no'] !="")
		 	  $qry .= "and manual_gate_pass_no like '%".$get['m_g_p_no']."%' ";
			
		   if($get['m_g_p_date'] !="")
		 	  $qry .=" and manual_gp_date like '%".$get['m_g_p_date']."%' ";
	   }
	 	  
	 
  	 $query=$this->db->query($qry,array($status))->result_array();
   
   return $query[0]['countval'];
   
} 


//==============================Demo Return=========================

function get_demo_return_data($last,$strat)
{

	if($this->session->userdata('user_id')=='1')
	{
		//echo "select * from tbl_return_hdr where comp_id='".$this->session->userdata('comp_id')."' and return_type='Demo'  Order by returnid desc  limit $strat,$last";
	  $query=$this->db->query("select * from tbl_return_hdr where comp_id='".$this->session->userdata('comp_id')."' and return_type='Demo'  Order by returnid desc  limit $strat,$last");
	}
	else 
	{
	  $query=$this->db->query("select * from tbl_return_hdr where return_type='Demo' and comp_id='".$this->session->userdata('comp_id')."'  Order by returnid desc  limit $strat,$last");
	}
	  return $result=$query->result();  

}
 
function filterDemoReturnData($perpage,$pages,$get)
{

		if($this->session->userdata('user_id')=='1')
		{ 	
          $qry = "select * from tbl_return_hdr where comp_id='".$this->session->userdata('comp_id')."' and return_type='Demo' ";
		}
		else
		{
		  $qry = "select * from tbl_return_hdr where return_type='Demo' and comp_id='".$this->session->userdata('comp_id')."' ";	
		}
    
	   if(sizeof($get) > 0)
		 {
         
		 	if($get['rgp_gatepass_no'] != "")
				$qry .="and rgp_gatepass_no like '%".$get['rgp_gatepass_no']."%' ";
		 	
			if($get['manual_gate_pass_no'] != "")
			   $qry .= " AND manual_gate_pass_no like '%".$get['manual_gate_pass_no']."%' ";
			  
		    if($get['responsibility'] != "")
			 {
			     $unitQuery2=$this->db->query("select * from tbl_contact_m where first_name LIKE '%".$get['responsibility']."%'");
		         $getUnit2=$unitQuery2->row();
		         $sr_no2=$getUnit2->contact_id;
				 $qry .= " AND responsibility ='$sr_no2'";
			 }
		   
		    if($get['gatepass_issued_name'] != "")
			   $qry .= " AND gatepass_issued_name LIKE '%".$get['gatepass_issued_name']."%'";
			  
		    if($get['f_date']!='' && $get['t_date']!='')
			 {
				$tdate=explode("-",$get['t_date']);
				$fdate=explode("-",$get['f_date']);
	
				$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
				$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
				$qry .="and return_due_date >='$fdate1' and return_due_date <='$todate1'";
			 }
	      }

		$qry .="LIMIT $pages,$perpage ";
 
    $data =  $this->db->query($qry)->result();

  return $data;

}

function count_demo_return($tableName,$status = 0,$get)
{

   if($this->session->userdata('user_id')=='1')
   {
   		$qry ="select count(*) as countval from $tableName where comp_id='".$this->session->userdata('comp_id')."' and return_type='Demo'";
   }
   else
   {
   		$qry ="select count(*) as countval from $tableName where return_type='Demo' and comp_id='".$this->session->userdata('comp_id')."' ";
   }
     	 	
         if(sizeof($get) > 0)
		 {
         
		 	if($get['rgp_gatepass_no'] != "")
				$qry .="and rgp_gatepass_no like '%".$get['rgp_gatepass_no']."%' ";
		 	
			if($get['manual_gate_pass_no'] != "")
			   $qry .= " AND manual_gate_pass_no like '%".$get['manual_gate_pass_no']."%' ";
			  
		    if($get['responsibility'] != "")
			{
			     $unitQuery2=$this->db->query("select * from tbl_contact_m where first_name LIKE '%".$get['responsibility']."%'");
		         $getUnit2=$unitQuery2->row();
		         $sr_no2=$getUnit2->contact_id;
				 $qry .= " AND responsibility ='$sr_no2'";
			}
		   
		    if($get['gatepass_issued_name'] != "")
			   $qry .= " AND gatepass_issued_name LIKE '%".$get['gatepass_issued_name']."%'";
			  
		    if($get['f_date']!='' && $get['t_date']!='')
			 {
				$tdate=explode("-",$get['t_date']);
				$fdate=explode("-",$get['f_date']);
	
				$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
				$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
				$qry .="and return_due_date >='$fdate1' and return_due_date <='$todate1'";
			 }
	      }
	 
	 
  	 $query=$this->db->query($qry,array($status))->result_array();
   
   return $query[0]['countval'];

} 




}
?>