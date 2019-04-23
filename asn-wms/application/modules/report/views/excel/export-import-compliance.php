<?php
@extract($_GET);
//echo "aaaaaaaaaa";die;

$contents="SERIAL NO.,CONTROL NO.,MRN DATE,MRN SENT TIME,DESTINATION,HAWB BOOKING DATE,PORT OF LOADING,PRE ALERT DATE,ETA DATE,ATA DATE,DUTY AMOUNT,IGST AMOUNT,ORDER NO.,GATE ENTRY,GE DATE,GE TIME,VEHICLE NUMBER,UNLOADING DATE,UNLOADING TIME,DATE OF RECEIPT AT WAREHOUSE,INTERNATIONAL TAT( ETA-ATA),LEAD TIME (FROM ATA DEL TO RECIPT AT WAREHOUSE),LEAD TIME(FROM HAWB TO RECIPT AT W/H),RECEIPT OF MONTH,MAWB NO.,ORIGIN,HAWB NO.,PKG,PALLET,GROSS WEIGHT(KG),BOE NO.,HSN CODE,EXCHANGE RATE 1 USD/EURO,BOE DATE,PG GROUP,CATEGORY,MODEL NO.,DESCRIPTION,GRN NO.,GRN DATE,NO_OF_DAYS FROM W-H RECIPT TO GRN DATE (<=2),INVOICE NO.,INVOICE DATE,INVOICE HSN CODE,QTY,UNT OF MEASURMENT,CURRENCY,UNIT PRICE,TOTAL VALUE,INVOICE VALUE (USD / EURO/ INR),VALUE INR,DAMAGE IN PCS,SHORTAGE IN PCS,INCIDENT REPORT SENT Y/N,REMARKS 1,REMARKS 2 \n";	

//echo $contents;

if($_GET['filter'] == 'filter')
{
	
  if($this->session->userdata('user_id')=='1')
	{
		$qry = "select * from tbl_stock_in_hdr H, tbl_stock_in_inv_hdr I where H.stockinid = I.stockinhdr AND H.order_type != 'other_inbound' ";
		$qry1= "select * from tbl_stock_in_hdr H, tbl_stock_in_dtl D where H.stockinid = D.stockinhdr AND H.order_type != 'other_inbound' " ;
	}
	else
	{
		$qry = "select * from tbl_stock_in_hdr H, tbl_stock_in_inv_hdr I where H.stockinid = I.stockinhdr AND H.order_type != 'other_inbound' AND H.comp_id='".$this->session->userdata('comp_id')."' ";
		$qry1= "select * from tbl_stock_in_hdr H, tbl_stock_in_dtl D where H.stockinid = D.stockinhdr AND H.order_type != 'other_inbound' AND H.comp_id='".$this->session->userdata('comp_id')."' " ;
	}
    
		    if($_GET['control_no'] != "")	
				 $qry .= " AND H.control_no = '".$_GET['control_no']."' ";
				 $qry1 .= " AND H.control_no = '".$_GET['control_no']."' ";
			  
				
			   //if($get['mawb_no'] != "")					
				 //$qry .= " AND H.mawb_no = '".$get['mawb_no']."' ";
				 //$qry1 .= " AND H.mawb_no = '".$get['mawb_no']."' ";
}
		
		
if($_GET['filter'] != 'filter')
{
	
 if($this->session->userdata('user_id')=='1')
	{
		$qry = "select * from tbl_stock_in_hdr H, tbl_stock_in_inv_hdr I where H.stockinid = I.stockinhdr AND H.order_type != 'other_inbound' ";
		$qry1= "select * from tbl_stock_in_hdr H, tbl_stock_in_dtl D where H.stockinid = D.stockinhdr AND H.order_type != 'other_inbound' " ;
	}
	else
	{
		$qry = "select * from tbl_stock_in_hdr H, tbl_stock_in_inv_hdr I where H.stockinid = I.stockinhdr AND H.order_type != 'other_inbound' AND H.comp_id='".$this->session->userdata('comp_id')."' ";
		$qry1= "select * from tbl_stock_in_hdr H, tbl_stock_in_dtl D where H.stockinid = D.stockinhdr AND H.order_type != 'other_inbound' AND H.comp_id='".$this->session->userdata('comp_id')."' " ;
	}

}		


$data =  $this->db->query($qry)->result();
$data1 =  $this->db->query($qry1)->result();
		
$result = array_merge($data,$data1);
//$result=$this->db->query($qry);

//echo $result;

$i=1;


foreach(@$result as $line)
{

$dest=$this->db->query("select *from tbl_master_data where serial_number='$line->destination'");
$dest1=$dest->row();

$pload=$this->db->query("select * from tbl_master_data where serial_number='$line->port_of_loading'");
$ploading=$pload->row();

$mnth=$this->db->query("select *from tbl_master_data where serial_number='$line->receipt_of_month'");
$mnth1=$mnth->row();

$origin=$this->db->query("select *from tbl_master_data where serial_number='$line->origin'");
$origin1=$origin->row();

$tarif=$this->db->query("select * from tbl_product_stock where Product_id='$line->product_id'");
$tariff=$tarif->row();

$sql1 = $this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='$tariff->category' ");
$sql3 = $sql1->row();

//----------------------------

$date1 = $line->date_of_receipt_at_warehose;
$date2 = $line->grn_date; 

$date1Timestamp = strtotime($date1);
$date2Timestamp = strtotime($date2); 

$no_of_days = $date2Timestamp - $date1Timestamp;
 
if($line->grn_date !='' && $line->date_of_receipt_at_warehose !=''){ $nod = $no_of_days/86400; } else { }

//---------------------------

$bookingTypeQuery=$this->db->query("select *from tbl_master_data where serial_number='12' and param_id='16' ");
$getBookingType=$bookingTypeQuery->row();
							
$contents.=str_replace(',',' ',$i).",";
$contents.=str_replace(',',' ',$line->control_no).",";
$contents.=str_replace(',',' ',$line->mrn_date).",";
$contents.=str_replace(',',' ',$line->mrn_sent_time).",";

$contents.=str_replace(',',' ',$dest1->keyvalue).",";

$contents.=str_replace(',',' ',$line->HAWB_booking_date).",";

$contents.=str_replace(',',' ',$ploading->keyvalue).",";

$contents.=str_replace(',',' ',$line->pre_alert_date).",";
$contents.=str_replace(',',' ',$line->eta_date).",";
$contents.=str_replace(',',' ',$line->ata_date).",";
$contents.=str_replace(',',' ',$line->duty_amount).",";
$contents.=str_replace(',',' ',$line->igst_amount).",";
$contents.=str_replace(',',' ',$line->order_no).",";
$contents.=str_replace(',',' ',$line->gate_entry).",";
$contents.=str_replace(',',' ',$line->ge_date).",";
$contents.=str_replace(',',' ',$line->ge_time).",";
$contents.=str_replace(',',' ',$line->vehicle_number).",";
$contents.=str_replace(',',' ',$line->unloading_date).",";
$contents.=str_replace(',',' ',$line->unloading_time).",";
$contents.=str_replace(',',' ',$line->date_of_receipt_at_warehose).",";
$contents.=str_replace(',',' ',$line->international_tat).",";
$contents.=str_replace(',',' ',$line->lead_time_from_ata).",";
$contents.=str_replace(',',' ',$line->lead_time_from_hawb).",";

$contents.=str_replace(',',' ',$mnth1->keyvalue).",";

$contents.=str_replace(',',' ',$line->mawb_no).",";

$contents.=str_replace(',',' ',$origin1->keyvalue).",";

$contents.=str_replace(',',' ',$line->hawb).",";
$contents.=str_replace(',',' ',$line->pkg).",";
$contents.=str_replace(',',' ',$line->pallet).",";
$contents.=str_replace(',',' ',$line->gross_weight).",";
$contents.=str_replace(',',' ',$line->boe_no).",";

$contents.=str_replace(',',' ',$tariff->hsn_code).",";

$contents.=str_replace(',',' ',$line->exchange_rate).",";
$contents.=str_replace(',',' ',$line->boe_date).",";

$contents.=str_replace(',',' ',$tariff->pg_group).",";
$contents.=str_replace(',',' ',$sql3->prodcatg_name).",";
$contents.=str_replace(',',' ',$tariff->sku_no).",";
$contents.=str_replace(',',' ',$tariff->productname).",";

$contents.=str_replace(',',' ',$line->grn_no).",";
$contents.=str_replace(',',' ',$line->grn_date).",";

$contents.=str_replace(',',' ',$nod).",";

$contents.=str_replace(',',' ',$line->invoice_no).",";
$contents.=str_replace(',',' ',$line->invoice_date).",";

$contents.=str_replace(',',' ',$tariff->tariff).",";

$contents.=str_replace(',',' ',$line->quantity).",";

$contents.=str_replace(',',' ',$getBookingType->keyvalue).",";

$contents.=str_replace(',',' ',$line->currency).",";
$contents.=str_replace(',',' ',$line->list_price).",";
$contents.=str_replace(',',' ',$line->list_price * $line->quantity).",\n";

//$contents.=str_replace(',',' ',$line->inventoy_type).",\n";
	
  $i++;
} 


$filename = "ImportComplianceReport"."_".@date('Y-m-d');
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . @date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $contents;
exit;

?>		
	
