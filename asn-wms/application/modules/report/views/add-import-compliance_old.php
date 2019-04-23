<?php
$this->load->view("header.php");
?>
	<!-- Main content -->
	<div class="main-content">
		
<?php
$this->load->view("reportheader");
?>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
<h4 class="panel-title">Import Compliance Report</h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
</ul>
</div>
<div class="panel-body">
<form class="form-horizontal panel-body-to" method="post" >
<div class="form-group"> 
<label class="col-sm-2 control-label">HAWB No</label> 
<div class="col-sm-3"> 
<input type="text" name="hawb_no" class="form-control" value="" />
</div>
<label class="col-sm-2 control-label">MAWB No</label> 
<div class="col-sm-3"> 
<input type="text" name="mawb_no" class="form-control" value="" />
</div>  
<label class="col-sm-2 control-label"><input type="submit" name="Show" class="btn btn-info" value="Show"></input></label> 
</div>
</form>
</div>

<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<tr>
 		<th>Serial No.</th>
		<th>CONTROL No.</th>
		<th>MRN Date</th>
		<th>MRN Sent Time</th>
		<th>Destination</th>
		<th>HAWB Booking date</th>
		<th>Port Of Loading</th>
		<th>Pre Alert Date</th>
		<th>ETA Date</th>										
		<th>ATA Date</th>
		<th>Duty Amount</th>
		<th>IGST Amount</th>
		<th>Order No.</th>		
		<th>Gate Entry</th>
		<th>GE Date</th>
		<th>GE Time</th>
		<th>Vehicle Number</th>
		<th>Unloading Date</th>
		<th>Unloading Time</th>
		<th>Date Of Receipt at warehouse</th>
		<th>International TAT( ETA-ATA)</th>
		<th>Lead Time (from ATA Del to Recipt at warehouse)</th>
		<th>Lead time(from HAWB to Recipt at w/h)</th>
		<th>Receipt of Month</th>
        <th>MAWB No.</th>
		<th>Origin</th> 
		<th>HAWB No.</th>
		<th>Pkg</th>
	 	<th>Pallet</th>
		<th>Gross Weight(KG) </th>		
		<th>BOE No.</th>
		<th>HSN Code</th>
		<th>Exchange Rate 1 USD/EURO</th>
		<th>BOE Date</th>		
		<th>PG GROUP</th>
		<th>Category</th>
		<th>Model No.</th>
		<th>Description</th>
		<th>GRN NO.</th>
		<th>GRN Date</th>
		<th>NO_OF_DAYS FROM W-H RECIPT TO GRN DATE (<=2)</th>
		<th>Invoice No.</th>
		<th>Invoice Date</th>		
		<th>Invoice HSN Code</th>
		<th>Qty</th>
		<th>Unt of Measurment</th>
		<th>Currency</th>
		<th>Unit Price</th>
		<th>Total Value</th>
		<th>Invoice Value (USD / EURO/ INR)</th>
		<th>Value INR</th>
		<th>Damage in Pcs</th>
		<th>Shortage in Pcs</th>
		<th>Incident report Sent Y/N</th>
		<th>REMARKS 1</th>
		<th>REMARKS 2</th>
</tr>
</thead>
<tbody>
<?php
$yy=1;

@extract($_POST);

if(@$Show!=''){

	   $queryy="select * from tbl_stock_in_dtl where status='A' ";
		$queryyto="select * from tbl_stock_in_inv_hdr where status='A' ";
	 	
		  if($hawb_no!='')
		  {
		  	$hwb=$this->db->query("select * from tbl_stock_in_hdr where hawb='$hawb_no'");
			$hawb_no=$hwb->row();
			$queryy.=" and stockinhdr  = '$hawb_no->stockinid'";
			$queryyto.=" and stockinhdr  = '$hawb_no->stockinid'";
		  }
		  
		  if($mawb_no!='')
		  {
	  	 	$mawb=$this->db->query("select * from tbl_stock_in_hdr where mawb_no='$mawb_no'");
			$mawb_no=$mawb->row();
	  	    $queryy.=" and stockinhdr  = '$mawb_no->stockinid'";
			$queryyto.=" and stockinhdr  = '$mawb_no->stockinid'";
		  }
		 
		}
if($Show=='')
	{
		  $queryy="select * from tbl_stock_in_dtl where status='A' ";
		  $queryyto="select * from tbl_stock_in_inv_hdr where status='A' ";
	}		

   $result=$this->db->query($queryy);
		
   foreach(@$result->result() as $line){

$cntno=$this->db->query("select * from tbl_stock_in_hdr where order_type!='other_inbound' and stockinid='$line->stockinhdr'");
$ctrlno=$cntno->row();	
if($ctrlno->stockinid!='')
{
?>
<tr class="gradeC record">

<th><?php echo $yy++; ?></th>
<th><?php echo $ctrlno->control_no; ?></th>
<th><?php echo $ctrlno->mrn_date; ?></th>
<th><?php echo $ctrlno->mrn_sent_time; ?></th>
<th><?php
$dest=$this->db->query("select *from tbl_master_data where serial_number='$ctrlno->destination'");
$dest1=$dest->row();
 echo $dest1->keyvalue;?></th>
<th><?php echo $ctrlno->HAWB_booking_date; ?></th>
<th><?php
$pload=$this->db->query("select * from tbl_master_data where serial_number='$ctrlno->port_of_loading'");
$ploading=$pload->row();
echo $ploading->keyvalue?></th>
<th><?php echo $ctrlno->pre_alert_date; ?></th>
<th><?php echo $ctrlno->eta_date; ?></th>

<th><?php echo $ctrlno->ata_date; ?></th>
<th><?php echo $ctrlno->duty_amount; ?></th>
<th><?php echo $ctrlno->igst_amount; ?></th>
<th><?php echo $ctrlno->order_no; ?></th>	
<th><?php echo $ctrlno->gate_entry; ?></th>
<th><?php echo $ctrlno->ge_date; ?></th>
<th><?php echo $ctrlno->ge_time; ?></th>
<th><?php echo $ctrlno->vehicle_number; ?></th>
<th><?php echo $ctrlno->unloading_date; ?></th>
<th><?php echo $ctrlno->unloading_time; ?></th>
<th><?php echo $ctrlno->date_of_receipt_at_warehose; ?></th>
<th><?php echo $ctrlno->international_tat; ?></th>
<th><?php echo $ctrlno->lead_time_from_ata; ?></th>
<th><?php echo $ctrlno->lead_time_from_hawb; ?></th>
<th><?php 
$mnth=$this->db->query("select *from tbl_master_data where serial_number='$ctrlno->receipt_of_month'");
$mnth1=$mnth->row();
echo $mnth1->keyvalue; ?></th>
<th><?php echo $ctrlno->mawb_no; ?></th>
<th><?php
$origin=$this->db->query("select *from tbl_master_data where serial_number='$ctrlno->origin'");
$origin1=$origin->row();
echo $origin1->keyvalue;?></th>
<th><?php echo $ctrlno->hawb; ?></th>

<th><?php echo $ctrlno->pkg; ?></th>
<th><?php echo $ctrlno->pallet; ?></th>
<th><?php echo $ctrlno->gross_weight; ?></th>
<th><?php echo $ctrlno->boe_no; ?></th>
<th><?php 
//echo "select *from tbl_product_stock where Product_id='$line->product_id'";
$tarif=$this->db->query("select * from tbl_product_stock where Product_id='$line->product_id'");
$tariff=$tarif->row();
echo $tariff->hsn_code; ?></th>	
<th><?php echo $ctrlno->exchange_rate; ?></th>
<th><?php echo $ctrlno->boe_date; ?></th>
<th><?php echo $tariff->pg_group; ?></th>
<th><?php 
$sql1 = $this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='$tariff->category' ");
$sql3 = $sql1->row();
	echo $sql3->prodcatg_name;  ?></th>	
<th><?php echo $tariff->sku_no; ?></th>
<th><?php echo $tariff->productname; ?></th>
<th><?php echo $line->grn_no; ?></th>
<th><?php echo $line->grn_date; ?></th>
<?php 
$date1 = $ctrlno->date_of_receipt_at_warehose;
$date2 = $line->grn_date; 

$date1Timestamp = strtotime($date1);
$date2Timestamp = strtotime($date2); 

$no_of_days = $date2Timestamp - $date1Timestamp;
 
if($line->grn_date !='' && $ctrlno->date_of_receipt_at_warehose !='')
{
?>
<th><?php echo $no_of_days/86400; ?></th>
<?php } else {?>
<th><?php echo "";?></th>
<?php } ?>
<th><?php echo $ctrlno->invoice_no; ?></th>
<th><?php echo $ctrlno->invoice_date; ?></th>	
<th><?php echo $tariff->tariff; ?></th>	
<th><?php echo $line->quantity; ?></th>
<th>
<?php
$bookingTypeQuery=$this->db->query("select *from tbl_master_data where serial_number='12' and param_id='16' ");
$getBookingType=$bookingTypeQuery->row();
echo $getBookingType->keyvalue;?></th>
<th><?php echo $ctrlno->currency; ?></th>
<th><?php echo $line->list_price; ?></th>
<th><?php $t_val=$line->list_price *  $line->quantity; echo $t_val; ?></th>	
<?php 
$suminv='';
$totalQueryy=$this->db->query("select * from tbl_stock_in_inv_hdr where inv_no='$ctrlno->invoice_no'");
foreach($totalQueryy->result() as $gettotallist){
					
		$suminv +=$gettotallist->list_price *  $gettotallist->quantity;
}
$tosuminv=$suminv+$line->list_price *  $line->quantity; 
?>
<th><?php echo "hello".$tosuminv; ?></th>	
<th><?php //echo $ctrlno->grand_total * $ctrlno->exchange_rate; ?></th>	
<th><?php ?></th>
<th><?php ?></th>
<th><?php ?></th>
<th><?php ?></th>
<th><?php ?></th>
</tr>
<?php  }  }

 $resultto=$this->db->query($queryyto);
 foreach(@$resultto->result() as $lineto){
 

$cntno1=$this->db->query("select * from tbl_stock_in_hdr where stockinid='$lineto->stockinhdr'");
$ctrlno1=$cntno1->row();
if($ctrlno1->stockinid !='')
{
 ?>
 
<tr class="gradeC record">
<th><?php echo $yy++; ?></th>
<th><?php echo $ctrlno1->control_no ; ?></th>
<th><?php echo $ctrlno1->mrn_date; ?></th>
<th><?php echo $ctrlno1->mrn_sent_time; ?></th>
<th><?php
$dest=$this->db->query("select *from tbl_master_data where serial_number='$ctrlno1->destination'");
$dest1=$dest->row();
 echo $dest1->keyvalue;?></th>
<th><?php echo $ctrlno1->HAWB_booking_date; ?></th>
<th><?php
$pload=$this->db->query("select * from tbl_master_data where serial_number='$ctrlno1->port_of_loading'");
$ploading=$pload->row();
echo $ploading->keyvalue?></th>
<th><?php echo $ctrlno1->pre_alert_date; ?></th>
<th><?php echo $ctrlno1->eta_date; ?></th>

<th><?php echo $ctrlno1->ata_date; ?></th>
<th><?php //echo $ctrlno1->duty_amount; ?></th>
<th><?php //echo $ctrlno1->igst_amount; ?></th>
<th><?php echo $lineto->order_no; ?></th>	
<th><?php echo $ctrlno1->gate_entry; ?></th>
<th><?php echo $ctrlno1->ge_date; ?></th>
<th><?php echo $ctrlno1->ge_time; ?></th>
<th><?php echo $ctrlno1->vehicle_number; ?></th>
<th><?php echo $ctrlno1->unloading_date; ?></th>
<th><?php echo $ctrlno1->unloading_time; ?></th>
<th><?php echo $ctrlno1->date_of_receipt_at_warehose; ?></th>
<th><?php echo $ctrlno1->international_tat; ?></th>
<th><?php echo $ctrlno1->lead_time_from_ata; ?></th>
<th><?php echo $ctrlno1->lead_time_from_hawb; ?></th>
<th><?php 
$mnth=$this->db->query("select *from tbl_master_data where serial_number='$ctrlno1->receipt_of_month'");
$mnth1=$mnth->row();
echo $mnth1->keyvalue; ?></th>
<th><?php echo $ctrlno1->mawb_no; ?></th>
<th><?php
$origin=$this->db->query("select *from tbl_master_data where serial_number='$ctrlno1->origin'");
$origin1=$origin->row();
echo $origin1->keyvalue;?></th>
<th><?php echo $ctrlno1->hawb; ?></th>

<th><?php //echo $ctrlno1->pkg; ?></th>
<th><?php //echo $ctrlno1->pallet; ?></th>
<th><?php //echo $ctrlno1->gross_weight; ?></th>
<th><?php echo $ctrlno1->boe_no; ?></th>
<th><?php 
$hsncd=$this->db->query("select *from tbl_product_stock where Product_id='$lineto->product_id'");
$hsndata=$hsncd->row();
echo $hsndata->hsn_code; ?></th>	
<th><?php echo $ctrlno1->exchange_rate; ?></th>
<th><?php echo $ctrlno1->boe_date; ?></th>
<th><?php echo $hsndata->pg_group; ?></th>
<th><?php 
$sql1 = $this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='".$hsndata->category."' ");
$sql3 = $sql1->row();
	echo $sql3->prodcatg_name;  ?></th>	
<th><?php echo $hsndata->sku_no; ?></th>
<th><?php echo $hsndata->productname; ?></th>
<th><?php echo $lineto->grn_no; ?></th>
<th><?php echo $lineto->grn_date; ?></th>
<?php 
//Our dates
$date1 = $ctrlno1->date_of_receipt_at_warehose;
$date2 = $lineto->grn_date; 
//Convert them to timestamps.
$date1Timestamp = strtotime($date1);
$date2Timestamp = strtotime($date2); 
//Calculate the difference.
$no_days = $date2Timestamp - $date1Timestamp;

if($lineto->grn_date !='' && $ctrlno1->date_of_receipt_at_warehose !='')
{
?>
<th><?php echo $no_days/86400; ?></th>
<?php } else { ?>
<th><?php echo "";?></th>
<?php } ?>
<th><?php echo $lineto->inv_no; ?></th>
<th><?php echo $lineto->inv_date; ?></th>	
<th><?php echo $hsndata->tariff; ?></th>	
<th><?php echo $lineto->quantity; ?></th>
<th>
<?php
$bookingTypeQuery=$this->db->query("select *from tbl_master_data where serial_number='12' and param_id='16' ");
$getBookingType=$bookingTypeQuery->row();
echo $getBookingType->keyvalue;?></th>
<th><?php echo $ctrlno1->currency; ?></th>
<th><?php echo $lineto->list_price; ?></th>
<th><?php $t_val2=$lineto->list_price *  $lineto->quantity; echo $t_val2;?></th>	
<?php  
$suminv1='';
//$abc=$this->db->query("SELECT invoice_no, SUM(list_price * quantity) AS amount FROM tbl_stock_in_hdr INNER JOIN tbl_stock_in_inv_hdr USING (stockinhdr) GROUP BY invoice_no;");
$totalQ=$this->db->query("SELECT * FROM tbl_stock_in_inv_hdr where inv_no='$lineto->inv_no' GROUP BY inv_no");
foreach($totalQ->result() as $getlist){
		//	echo $getlist->inv_no;		
		$suminv1 +=$getlist->list_price *  $getlist->quantity;
}
//$tosuminv1=$suminv1+$lineto->list_price *  $lineto->quantity; 

?>

<th><?php //echo "Ab".$suminv1;  ?></th>	
<th><?php //echo $ctrlno1->grand_total * $ctrlno->exchange_rate; ?></th>	
<th><?php ?></th>
<th><?php ?></th>
<th><?php ?></th>
<th><?php ?></th>
<th><?php ?></th>
</tr>
<?php } } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<?php
$this->load->view("footer.php");
?>
