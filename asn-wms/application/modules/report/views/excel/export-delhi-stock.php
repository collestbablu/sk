<?php
@extract($_GET);

$contents="SERIAL NO.,DATE,ORIGINAL INVOICE RECEIVED TIME,CUSTOMER,FROM LOCATION,TYPE,ORDER NO,INVOICE NO.,TO LOCATION,PRODUCT CODE,QTY RECEIPT,QTY DISPATCHED,AVAILABILITY,DESCRIPTION-1,DESCRIPTION-2,TOTAL PCS,WAREHOUSE REMARKS \n";	


if($_GET['filter'] == 'filter')
{
	
	   if($this->session->userdata('user_id')=='1')
		{
			$qry = "Select * from tbl_product_serial_log  where type != 'Stock In' AND inbound_id !='' ";
		}
		else
		{
			$qry = "Select * from tbl_product_serial_log  where type != 'Stock In' AND inbound_id !='' AND comp_id='".$this->session->userdata('comp_id')."' ";
		}
		
    
	   if($_GET['location'] != "")	
		 {
			$qry .= " AND location_id ='".$_GET['location']."'";
		 }
		
	   if($_GET['sku_no'] != "")					
		 {	
			$sku=$this->db->query("select * from tbl_product_stock where sku_no = '".$_GET['sku_no']."' ");
			$getSku=$sku->row();
			
			$qry .= " AND product_id = '$getSku->Product_id' ";
		 }
	   
	   if($_GET['f_date']!='' && $_GET['t_date']!='')
		{
			$tdate=explode("-",$_GET['t_date']);
			$fdate=explode("-",$_GET['f_date']);
	
			$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
			$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
			
		   
			$qry .=" and maker_date >= '$fdate1' and maker_date <= '$todate1' ";
		}

		$qry .=" ORDER BY serial_number DESC";
	
}
		
		
if($_GET['filter'] != 'filter')
{
	
		if($this->session->userdata('user_id')=='1')
		{
			$qry = "Select * from tbl_product_serial_log  where type != 'Stock In' AND inbound_id !='' ORDER BY serial_number DESC ";
		}
		else
		{
			$qry = "Select * from tbl_product_serial_log  where type != 'Stock In' AND inbound_id !='' AND comp_id='".$this->session->userdata('comp_id')."' ORDER BY serial_number DESC ";
		}

}		

$result=$this->db->query($qry);

$i=1;


foreach(@$result->result() as $line)
{

//=======================
$dtl=$this->db->query("select * from tbl_stock_out_dtl where product_id='$line->product_id' AND stockouthdr = '$line->inbound_id '");
$getDtl=$dtl->row();

$hdr=$this->db->query("select * from tbl_stock_out_hdr where stockoutid='$getDtl->stockouthdr'");
$getHdr=$hdr->row();

$stockinhdr=$this->db->query("select * from tbl_stock_in_hdr where stockinid='$line->inbound_id'");
$getStockInHdr=$stockinhdr->row();

$stock=$this->db->query("select * from tbl_product_stock where Product_id='$line->product_id'");
$getStock=$stock->row();

//=======================

if($line->type=='Inbound' or $line->type=='Inbound-mul'){

$stockInQuery=$this->db->query("select *from tbl_stock_in_hdr where stockinid='$line->inbound_id'");
$getStockIn=$stockInQuery->row();

if($getStockIn->origin == 32 or $getStockIn->origin == 73 ){
	$abc="Sennheiser Logistics Services GmbH";
}elseif($getStockIn->origin == 80 or $getStockIn->origin == 84){
	$abc="APART AUDIO NV";
}
		//$abc=" ";	
}
else
{
		$sql1 = $this->db->query("select * from tbl_contact_m where code='$getHdr->contact_id' AND group_name='4' ");
		$sql2 = $sql1->row();
		
		if($sql2->code!='')
		 $abc = $sql2->first_name;	
}

$hdrQueryStockIn=$this->db->query("select *from tbl_master_data where serial_number='$line->location_id'");
$getStockIn=$hdrQueryStockIn->row();

$proQ1=$this->db->query("select * from tbl_master_data where serial_number='$getHdr->type'");
$fProQ12=$proQ1->row();
		
		if($line->type=='Inbound' or $line->type=='Inbound-mul')
		{
			$bcd = "Import";	
		}
		else if($line->type=='Transfer')
		{
			$bcd = "Transfer";
		}
		else if($line->type=='Demo Outbound')
		{
			$bcd = "Demo Outbound";
		}
		else if($line->type=='Sales Return')
		{
			$bcd = "Sales Return";
		}
		else if($line->type=='Demo Return')
		{
			$bcd = "Demo Return";
		}
		else if($line->type=='warehouse_transfer')
		{
			$bcd = "warehouse_transfer";
		}
		else
		{
			$bcd = $fProQ12->keyvalue;
		}


if($line->type=='Inbound' or $line->type=='Inbound-mul') {
	$ordno=$getStockInHdr->order_no;
    $invno=$getStockInHdr->invoice_no;
}else{
	$ordno=$getHdr->order_no;
	$invno=$getHdr->invoice_no;
}




// if($line->type=='Inbound-mul' or $line->type=='Inbound')
// {
// 	$hdrQueryStockIn=$this->db->query("select *from tbl_stock_in_hdr where stockinid='$line->inbound_id'");
// 	$getStockIn=$hdrQueryStockIn->row();
	
// 		$bookingTypeQuery=$this->db->query("select *from tbl_contact_m where contact_id='$getStockIn->location_to'");
// 		$getBookingType=$bookingTypeQuery->row();
// 		$citi = $getBookingType->city; 
// }
// else
// {
	
	$hdrQueryStockInn=$this->db->query("select *from tbl_stock_out_hdr where stockoutid='$line->inbound_id'");
	$getStockInn=$hdrQueryStockInn->row();
	
	$bookingTypeQueryy=$this->db->query("select *from tbl_contact_m where contact_id='$getStockInn->location_to'");
	$getBookingTypee=$bookingTypeQueryy->row();
	$citi = $getBookingTypee->city; 
//}

$qtyin=$this->db->query("select * from tbl_stock_in_dtl where product_id='$line->product_id'");
$qtyindtl=$qtyin->row();
		
		//if($fProQ12->keyvalue=='Inbound' or $fProQ12->keyvalue=='Inbound-mul' )
		if($line->type=='Demo Return' or $line->type=='Transfer' or $line->type=='Inbound' or $line->type=='Inbound-mul')
		{
	 		$rqty = $line->quantity;  
        }
        else
		{
			$rqty = " ";
		}

//if($fProQ12->keyvalue=='STNOUT' or $fProQ12->keyvalue=='Outbound' or $fProQ12->keyvalue=='STNOUT' or $fProQ12->keyvalue=='Invoice')
	if($fProQ12->keyvalue=='STNOUT' or $fProQ12->keyvalue=='Invoice' or $line->type=='Demo Outbound')
	{
		$dqty = $line->quantity;  
	}
	else
	{
		$dqty="";
	}

$avaltyQuery=$this->db->query("select SUM(quantity) as Aqty from tbl_product_serial where product_id='$line->product_id' and location_id='$line->location_id'");
$getAvalty= $avaltyQuery->row(); 
$aqty = $getAvalty->Aqty;

$dest=$this->db->query("select * from tbl_return_dtl where product_id='$line->product_id'");
$dest1=$dest->row();
$dest3=$this->db->query("select * from tbl_return_hdr where returnid='$dest1->returnhdr'");
$dest4=$dest3->row();
 
 $blank="";
//=======================
							
$contents.=str_replace(',',' ',$i).",";
$contents.=str_replace(',',' ',$line->maker_date).",";
$contents.=str_replace(',',' ',$getHdr->original_inv_rec_time).",";
$contents.=str_replace(',',' ',$abc).",";
$contents.=str_replace(',',' ',$getStockIn->keyvalue).",";
$contents.=str_replace(',',' ',$bcd).",";

$contents.=str_replace(',',' ',$ordno).",";
$contents.=str_replace(',',' ',$invno).",";
$contents.=str_replace(',',' ',$citi).",";
$contents.=str_replace(',',' ',$getStock->sku_no).",";
$contents.=str_replace(',',' ',$rqty).",";
$contents.=str_replace(',',' ',$dqty).",";
$contents.=str_replace(',',' ',$aqty).",";

$contents.=str_replace(',',' ',$getStock->productname).",";
$contents.=str_replace(',',' ',$getStock->description2).",";
$contents.=str_replace(',',' ',$blank).",";
$contents.=str_replace(',',' ',$dest4->wh_remarks).",\n";
	
  $i++;
} 


$filename = "Transaction_Report"."_".@date('Y-m-d');
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . @date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $contents;
exit;

?>		
	
