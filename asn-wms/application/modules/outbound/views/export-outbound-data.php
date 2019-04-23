<?php
@extract($_GET);

$contents="DATE,ORIGINAL INVOICE RECEIVED TIME,CUSTOMER,ORDER NO,INVOICE NO,TO LOCATION,TYPE \n";	

if($_GET['filter'] != '')
{
	if($this->session->userdata('user_id')=='1')
	{
    	$qry = "select * from tbl_stock_out_hdr where divn_id='1' ";
	}
	else
	{
		$qry = "select * from tbl_stock_out_hdr where comp_id='".$this->session->userdata('comp_id')."' ";
	}
          
		 
		  //====================Product Search=======================
			 if($p_code != "")
			 {
					$sq1 = $this->db->query("select * from tbl_product_stock where sku_no = '$p_code' ");
					$sq2 = $sq1->row();	
					
					$out = array();
					$sq3 = $this->db->query("select * from tbl_stock_out_dtl where product_id='$sq2->Product_id' ");
					foreach($sq3->result() as $sq4)
					{
					 $hdrData=$sq4->stockouthdr;
					 array_push($out,$hdrData);
					
					}	
					
					$numCnt=$sq1->num_rows();
					if($numCnt>0)
								{
							
								$hdrDataa= implode(', ', $out);
					
								}
					else
					{
					$hdrDataa='9999999';
					}
				
		
				 $qry .= "and stockoutid in ($hdrDataa)";
	
			 }
			 //=========================End=====================
		 
		 
		    if($date != "")
				$qry .= " AND date LIKE '%$date%' ";
			  
		    if($original_inv_rec_time != "")
				$qry .= " AND original_inv_rec_time LIKE '%$original_inv_rec_time%' ";
        	
		    if($customer != "")
		     {
				   $unitQuery=$this->db->query("select * from tbl_contact_m where first_name LIKE '%$customer%' ");
				   $getUnit=$unitQuery->row();
				   $sr_no=$getUnit->code;
				   $qry .= " AND contact_id = '$sr_no'";
		     }	  
		   
		    if($order_no != "")
				$qry .= " AND order_no LIKE '%$order_no%' ";
		
		    if($invoice_no != "")
				$qry .= " AND invoice_no LIKE '%$invoice_no%' ";

			if($location != "")
			  {
				 $location=$this->db->query("select * from tbl_contact_m where city like '%$location%' ");
				 $getLocation=$location->row();		 
				 $qry .= " AND location_to = '$getLocation->contact_id'";
			  }
		  
			if($type != "")
			  {
				  $type=$this->db->query("select * from tbl_master_data where keyvalue like '%$type%' ");
				  $getType=$type->row();
				  $qry .= " AND type = '$getType->serial_number'";
			  }
	      
}
		
		
if($_GET['filter'] == '')
{
	if($this->session->userdata('user_id')=='1')
	{
		$qry = "select * from tbl_stock_out_hdr Order by stockoutid desc ";
	}
	else
	{
		$qry = "select * from tbl_stock_out_hdr where comp_id='".$this->session->userdata('comp_id')."' Order by stockoutid desc ";
	}
}		

$result=$this->db->query($qry);

$i=1;


foreach(@$result->result() as $line)
{

$bookingTypeQuery=$this->db->query("select * from tbl_contact_m where code='$line->contact_id' ");
$getBookingType=$bookingTypeQuery->row();

$location=$this->db->query("select * from tbl_contact_m where contact_id='$line->location_to' ");
$getLocation=$location->row();

$type=$this->db->query("select * from tbl_master_data where serial_number='$line->type'");
$getType=$type->row();
							
$contents.=str_replace(',',' ',$line->date).",";
$contents.=str_replace(',',' ',$line->original_inv_rec_time).",";
$contents.=str_replace(',',' ',$getBookingType->first_name).",";
$contents.=str_replace(',',' ',$line->order_no).",";
$contents.=str_replace(',',' ',$line->invoice_no).",";
$contents.=str_replace(',',' ',$getLocation->city).",";
$contents.=str_replace(',',' ',$getType->keyvalue).",\n";
	
  $i++;
} 

$filename = "OutBound"."_".@date('Y-m-d');
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . @date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $contents;
exit;

?>		
	
