<?php
@extract($_GET);

$contents="SERIAL NO.,RESPONSIBILITY,GATEPASS ISSUED NAME,RGP GATEPASS DATE,RETURN DUE DATE,RGP GATEPASS NO.,MANUAL GATE PASS NO.,MANUAL GATE PASS DATE,TENURE (IN DAYS) \n";	

if($_GET['filter'] != '')
{
	  if($this->session->userdata('user_id')=='1')
		{ 	
          $qry = "select * from tbl_return_hdr where return_type='Demo' ";
		}
		else
		{
		  $qry = "select * from tbl_return_hdr where return_type='Demo' and comp_id='".$this->session->userdata('comp_id')."' ";	
		}
          
         
		 	if($rgp_gatepass_no != "")
				$qry .="and rgp_gatepass_no like '%$rgp_gatepass_no%' ";
		 	
			if($manual_gate_pass_no != "")
			   $qry .= " AND manual_gate_pass_no like '%$manual_gate_pass_no%' ";
			  
		    if($responsibility != "")
			 {
			     $unitQuery2=$this->db->query("select * from tbl_contact_m where first_name LIKE '%$responsibility%' ");
		         $getUnit2=$unitQuery2->row();
		         $sr_no2=$getUnit2->contact_id;
				 $qry .= " AND responsibility ='$sr_no2'";
			 }
		   
		    if($gatepass_issued_name != "")
			   $qry .= " AND gatepass_issued_name LIKE '%$gatepass_issued_name%' ";
			  
		    if($f_date!='' && $t_date!='')
			 {
				$tdate=explode("-",$t_date);
				$fdate=explode("-",$f_date);
	
				$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
				$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
				$qry .="and return_due_date >='$fdate1' and return_due_date <='$todate1'";
			 }
	      
	      
}
		
		
if($_GET['filter'] == '')
{
	 if($this->session->userdata('user_id')=='1')
		{ 	
          $qry = "select * from tbl_return_hdr where return_type='Demo' Order by returnid desc ";
		}
		else
		{
		  $qry = "select * from tbl_return_hdr where return_type='Demo' and comp_id='".$this->session->userdata('comp_id')."' Order by returnid desc ";	
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
$contents.=str_replace(',',' ',$line->gatepass_issued_name).",";
$contents.=str_replace(',',' ',$line->rgp_gate_pass_date).",";
$contents.=str_replace(',',' ',$line->return_due_date).",";
$contents.=str_replace(',',' ',$line->rgp_gatepass_no).",";
$contents.=str_replace(',',' ',$line->manual_gate_pass_no).",";
$contents.=str_replace(',',' ',$line->manual_gp_date).",";
$contents.=str_replace(',',' ',$tenure).",\n";
	
  $i++;
} 

$filename = "DemoReturn"."_".@date('Y-m-d');
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . @date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $contents;
exit;

?>		
	
