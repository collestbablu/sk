<?php
@extract($_GET);

$contents="SERIAL NO.,HAWB No.,MAWB No.,ORIGIN,DESTINATION,HAWB BOOKING DATE,PORT OF LOADING,PRE ALERT DATE,EDA,STATUS \n";	

if($_GET['filter'] != '')
{
	
     //$qry = "select * from tbl_stock_in_hdr where order_type!='other_inbound' ";
	 if($this->session->userdata('user_id')=='1')
		{
	        $qry = "select * from tbl_stock_in_hdr where order_type!='other_inbound'";
		}
		else
		{
			$qry = "select * from tbl_stock_in_hdr where order_type!='other_inbound' and comp_id='".$this->session->userdata('comp_id')."' ";
		}
    		   
          
		 	if($stockinid != "")
		  		$qry .= " AND stockinid = '$stockinid' ";
			
			if($hawb != "")
	     	    $qry .= " AND hawb LIKE '%$hawb%'";
				
			if($mawb_no != "")
	      	   $qry .= " AND mawb_no LIKE '%$mawb_no' ";
		 	
		    if($origin != "")
		     {
			   $unitQuery2=$this->db->query("select * from tbl_master_data where param_id = '25' AND keyvalue LIKE '%$origin%' ");
		       $getUnit2=$unitQuery2->row();
		       $sr_no2=$getUnit2->serial_number;
		 
			   $qry .= " AND origin ='$sr_no2'";
		     }
		      
		    if($destination != "")
		     {
			   $unitQuery=$this->db->query("select * from tbl_master_data where param_id = '25' AND keyvalue LIKE '%$destination%' ");
		       $getUnit=$unitQuery->row();
		       $sr_no=$getUnit->serial_number;
		 
			   $qry .= " AND destination ='$sr_no'";
             }
	  		
		    if($HAWB_booking_date != "")
		  	  $qry .= " AND HAWB_booking_date = '$HAWB_booking_date' ";
			
		    if($port_of_loading != "")
		     {
		   		$pol=$this->db->query("select *from tbl_master_data where param_id = '32' AND keyvalue LIKE '%$port_of_loading%' ");
				$getPol=$pol->row();
		
		  	   $qry .= " AND port_of_loading = '$getPol->serial_number'";
			 }
			
			if($pre_alert_date != "")
		  	  $qry .= " AND pre_alert_date = '$pre_alert_date' ";
			 
			if($eta_date != "")
		  	  $qry .= " AND eta_date = '$eta_date' ";
			  
			 if($status != "")
			 {
		   		$status=$this->db->query("select * from tbl_master_data where param_id = '27' AND keyvalue LIKE '%$status%' ");
				$getStatus=$status->row();
		
		  	   $qry .= " AND status = '$getStatus->serial_number'";
		     }
	      
}
		
		
if($_GET['filter'] == '')
{
	//$qry = "select * from tbl_stock_in_hdr where order_type!='other_inbound'  Order by stockinid desc ";
	if($this->session->userdata('user_id')=='1')
		{
	        $qry = "select * from tbl_stock_in_hdr where order_type!='other_inbound' Order by stockinid desc ";
		}
		else
		{
			$qry = "select * from tbl_stock_in_hdr where order_type!='other_inbound' and comp_id='".$this->session->userdata('comp_id')."' Order by stockinid desc ";
		}
}		

$result=$this->db->query($qry);

$i=1;


foreach(@$result->result() as $line)
{

$origin=$this->db->query("select *from tbl_master_data where serial_number='$line->origin'");
$getOrigin=$origin->row();

$destin=$this->db->query("select *from tbl_master_data where serial_number='$line->destination'");
$getDestin=$destin->row();		 	

$pol=$this->db->query("select *from tbl_master_data where serial_number='$line->port_of_loading'");
$getPol=$pol->row();

$status=$this->db->query("select *from tbl_master_data where serial_number='$line->status'");
$getStatus=$status->row();
							
$contents.=str_replace(',',' ',$line->stockinid).",";
$contents.=str_replace(',',' ',$line->hawb).",";
$contents.=str_replace(',',' ',$line->mawb_no).",";
$contents.=str_replace(',',' ',$getOrigin->keyvalue).",";
$contents.=str_replace(',',' ',$getDestin->keyvalue).",";
$contents.=str_replace(',',' ',$line->HAWB_booking_date).",";
$contents.=str_replace(',',' ',$getPol->keyvalue).",";
$contents.=str_replace(',',' ',$line->pre_alert_date).",";
$contents.=str_replace(',',' ',$line->eta_date).",";
$contents.=str_replace(',',' ',$getStatus->keyvalue).",\n";
	
  $i++;
} 

$filename = "PreAlert"."_".@date('Y-m-d');
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . @date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $contents;
exit;

?>		
	
