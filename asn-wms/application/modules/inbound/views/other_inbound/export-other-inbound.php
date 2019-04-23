<?php
@extract($_GET);

$contents="SERIAL NO.,DATE,ORIGINAL INVOICE RECEIVED TIME,CUSTOMER,ORDER NO,INVOICE NO,ORIGIN,TYPE \n";	

if($_GET['filter'] != '')
{
	
    //$qry = "select * from tbl_stock_in_hdr where order_type='other_inbound' ";
	if($this->session->userdata('user_id')=='1')
		{
          $qry = "select * from tbl_stock_in_hdr where order_type='other_inbound'";
    	}
		else
		{
		  $qry = "select * from tbl_stock_in_hdr where order_type='other_inbound' and comp_id='".$this->session->userdata('comp_id')."' ";
		}
    		   
          
		 	if($stockinid != "")
		  		$qry .= " AND stockinid = '$stockinid' ";
			
			if($date != "")
	     	    $qry .= " AND date LIKE '%$date%' ";
				
			if($original_inv_rec_time != "")
	       	   $qry .= " AND original_inv_rec_time LIKE '%$original_inv_rec_time%' ";
		 	
		    if($customer != "")
			 {
			    $unitQuery2=$this->db->query("select * from tbl_contact_m where first_name LIKE '%$customer%' ");
		        $getUnit2=$unitQuery2->row();
		        $sr_no2=$getUnit2->code;
			    $qry .= " AND supplier_id ='$sr_no2'";
			 }
		      
		    if($order_no != "")
			   $qry .= " AND order_no ='$order_no' ";
         
	  	    if($invoice_no != "")
		  	   $qry .= " AND invoice_no = '$invoice_no' ";
			
		    if($origin != "")
		     {
		   		$pol=$this->db->query("select * from tbl_master_data where keyvalue LIKE '%$origin%' ");
				$getPol=$pol->row();
		  	    $qry .= " AND origin = '$getPol->serial_number'";
 		     }
			  
			 if($type != "")
			 {
		   		$status=$this->db->query("select * from tbl_master_data where keyvalue LIKE '%$type%'");
				$getStatus=$status->row();
		  	    $qry .= " AND type = '$getStatus->serial_number'";
		     }
	      
}
		
		
if($_GET['filter'] == '')
{
	//$qry = "select * from tbl_stock_in_hdr where order_type='other_inbound'  Order by stockinid desc ";
	if($this->session->userdata('user_id')=='1')
		{
          $qry = "select * from tbl_stock_in_hdr where order_type='other_inbound' Order by stockinid desc ";
    	}
		else
		{
		  $qry = "select * from tbl_stock_in_hdr where order_type='other_inbound' and comp_id='".$this->session->userdata('comp_id')."' Order by stockinid desc ";
		}
}		

$result=$this->db->query($qry);

$i=1;


foreach(@$result->result() as $line)
{

$bookingTypeQuery=$this->db->query("select *from tbl_contact_m where code='$line->supplier_id'");
$getBookingType=$bookingTypeQuery->row();

$origin=$this->db->query("select *from tbl_master_data where serial_number='$line->origin'");
$getOrigin=$origin->row();

$type=$this->db->query("select *from tbl_master_data where serial_number='$line->type'");
$getType=$type->row();
							
$contents.=str_replace(',',' ',$line->stockinid).",";
$contents.=str_replace(',',' ',$line->date).",";
$contents.=str_replace(',',' ',$line->original_inv_rec_time).",";
$contents.=str_replace(',',' ',$getBookingType->first_name).",";
$contents.=str_replace(',',' ',$line->order_no).",";
$contents.=str_replace(',',' ',$line->invoice_no).",";
$contents.=str_replace(',',' ',$getOrigin->keyvalue).",";
$contents.=str_replace(',',' ',$getType->keyvalue).",\n";
	
  $i++;
} 

$filename = "InboundOther"."_".@date('Y-m-d');
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . @date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $contents;
exit;

?>		
	
