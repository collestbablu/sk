<?php
@extract($_GET);

$contents="SERIAL NO.,PART NO.,DESCRIPTION,PHY. QTY,QTY,LOCATION,SEGMENT \n";	


if($_GET['filter'] == 'filter')
{
	
  	 if($this->session->userdata('user_id')=='1')
		{
			 $qry = "Select * from tbl_product_serial_log where status='A' ";
		}
		else
		{
			 $qry = "Select * from tbl_product_serial_log where comp_id='".$this->session->userdata('comp_id')."' ";
		}
    
	   if($_GET['location'] != "")					
		 {
			$qry .= " AND location_id = '".$_GET['location']."' ";
		 }
		
	   if($_GET['f_date']!='' && $_GET['t_date']!='')
		{
			$tdate=explode("-",$_GET['t_date']);
			$fdate=explode("-",$_GET['f_date']);
	
			$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
			$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
			$qry .="and maker_date >='$fdate1' and maker_date <='$todate1'";
		}
		
		$qry .="group by product_id order by product_id asc ";
		
	
}
		
		
if($_GET['filter'] != 'filter')
{
	
	$crdate=date('Y-m-d');
	if($this->session->userdata('user_id')=='1')
	{
		$qry="Select * from tbl_product_serial_log where maker_date='$crdate'  group by product_id order by product_id asc";
	}
	else
	{
		$qry="Select * from tbl_product_serial_log where maker_date='$crdate' AND comp_id='".$this->session->userdata('comp_id')."'  group by product_id order by product_id asc";
	}

}		

$result=$this->db->query($qry);

$i=1;


foreach(@$result->result() as $line)
{

//==================
$blank="";

$bookingTypeQuery=$this->db->query("select * from tbl_product_stock where Product_id='$line->product_id' ");
$getBookingType=$bookingTypeQuery->row();

if($_GET['location']!='')
{
$fetchQ21=$this->db->query("select SUM(quantity) as qtyy from tbl_product_serial where product_id='$line->product_id' and location_id='".$_GET['location']."' and comp_id='".$this->session->userdata('comp_id')."'   ");
}
else
{
$fetchQ21=$this->db->query("select SUM(quantity) as qtyy from tbl_product_serial where product_id='$line->product_id' and location_id='$line->location_id' and comp_id='".$this->session->userdata('comp_id')."'");
}
$fetchQ31=$fetchQ21->row();
$piqty = $fetchQ31->qtyy;


$proQ112=$this->db->query("select * from tbl_location_rack where id='$line->rack_id'");
$fProQ111=$proQ112->row();

$sql1 = $this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='$getBookingType->category' ");
$sql3 = $sql1->row();

//======================					
							
$contents.=str_replace(',',' ',$i).",";
$contents.=str_replace(',',' ',$getBookingType->sku_no).",";
$contents.=str_replace(',',' ',$getBookingType->productname).",";

$contents.=str_replace(',',' ',$blank).",";

$contents.=str_replace(',',' ',$piqty).",";
$contents.=str_replace(',',' ',$fProQ111->rack_name).",";
$contents.=str_replace(',',' ',$sql3->prodcatg_name).",\n";
	
  $i++;
} 


$filename = "PI_Report"."_".@date('Y-m-d');
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . @date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $contents;
exit;

?>		
	
