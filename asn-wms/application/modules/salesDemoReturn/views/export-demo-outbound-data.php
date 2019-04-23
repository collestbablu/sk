<?php
@extract($_GET);

$contents="SERIAL NO.,RESPONSIBILITY,RGP GATEPASS DATE,RETURN DUE DATE,RGP GATEPASS NO.,MANUAL GATE PASS NO.,MANUAL GATEPASS DATE,TYPE,TENURE (IN DAYS),STATUS \n";	

if($_GET['filter'] != '')
{
	if($this->session->userdata('user_id')=='1')
	{
    	$qry = "select * from tbl_return_hdr where return_type='Demo' ";
	}
	else
	{
		$qry = "select * from tbl_return_hdr where return_type='Demo' AND comp_id='".$this->session->userdata('comp_id')."' ";
	}
          
		 
		  if($returnid != "")
		   		$qry .="and returnid = '$returnid' ";
		 
		   if($respblty != "")
		     {
			   $unitQuery2=$this->db->query("select * from tbl_contact_m where first_name LIKE '%$respblty%' ");
		       $getUnit2=$unitQuery2->row();
		       $sr_no2=$getUnit2->contact_id;
			   $qry .= " AND responsibility ='$sr_no2'";
			 }
		      
		   if($g_p_date != "")
			  $qry .= " AND rgp_gate_pass_date like '%$g_p_date%' ";
     
		   if($rt_due_date != "")
			  $qry .= " AND return_due_date LIKE '%$rt_due_date%' ";
			  
		   if($g_p_no !="")
		      $qry .= "and rgp_gatepass_no like '%$g_p_no%' ";
			
		   if($m_g_p_no !="")
		 	  $qry .= "and manual_gate_pass_no like '%$m_g_p_no%' ";
			
		   if($m_g_p_date !="")
		 	  $qry .=" and manual_gp_date like '%$m_g_p_date%' ";
	      
}
		
		
if($_GET['filter'] == '')
{
	if($this->session->userdata('user_id')=='1')
	{
    	$qry = "select * from tbl_return_hdr where return_type='Demo' Order by returnid desc ";
	}
	else
	{
		$qry = "select * from tbl_return_hdr where return_type='Demo' AND comp_id='".$this->session->userdata('comp_id')."' Order by returnid desc ";
	}
}		

$result=$this->db->query($qry);

$i=1;


foreach(@$result->result() as $line)
{

$contactQuery=$this->db->query("select *from tbl_contact_m where contact_id='$line->responsibility'");
$getContact=$contactQuery->row();;

$todays=date('Y-m-d');
$date1=date_create($todays);
$date2=date_create($line->return_due_date);
$diff=date_diff($date1,$date2);
if($date1<=$date2)
{
	$tenure = $diff->format("%a days");
}

else
{
	$tenure = $diff->format("%a days");	
}							
							
$contents.=str_replace(',',' ',$line->returnid).",";
$contents.=str_replace(',',' ',$getContact->first_name).",";
$contents.=str_replace(',',' ',$line->rgp_gate_pass_date).",";
$contents.=str_replace(',',' ',$line->return_due_date).",";
$contents.=str_replace(',',' ',$line->rgp_gatepass_no).",";
$contents.=str_replace(',',' ',$line->manual_gate_pass_no).",";
$contents.=str_replace(',',' ',$line->manual_gp_date).",";
$contents.=str_replace(',',' ',$line->return_type).",";
$contents.=str_replace(',',' ',$tenure).",";
$contents.=str_replace(',',' ',$line->mail_send_status).",\n";
	
  $i++;
} 

$filename = "DemoOutBound"."_".@date('Y-m-d');
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . @date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $contents;
exit;

?>		
	
