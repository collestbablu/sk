<?php
$this->load->view("header.php");

$entries = "";
if($this->input->get('entries')!="")
{
  $entries = $this->input->get('entries');
}

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
<form class="form-horizontal panel-body-to" method="get" >
<div class="form-group"> 
<label class="col-sm-2 control-label">CONTROL No</label> 
<div class="col-sm-3"> 
<input type="text" name="control_no" class="form-control" value="" />
</div>
<!--<label class="col-sm-2 control-label">MAWB No</label> 
<div class="col-sm-3"> 
<input type="text" name="mawb_no" class="form-control" value="" />
</div> --> 
<label class="col-sm-2 control-label"><button type="submit" name="filter" value="filter" class="btn btn-info btn-sm">Search</button></label>  
</div>
</form>
</div>

<div class="row">
<div class="col-sm-12">
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
<div class="html5buttons">
<div class="dt-buttons">
<a href="<?=base_url('report/Report/export_import_compliance').'?control_no='.$_GET['control_no'].'&mawb_no='.$_GET['mawb_no'].'&filter='.$_GET['filter'];?>" class="dt-button buttons-excel buttons-html5" style="margin: 0px 30px 0px 0px;"><strong>Excel</strong></a>
</div>
</div>

<div class="dataTables_length" id="DataTables_Table_0_length" style="margin: 0px 0px 0px 30px;">
<label> Show
<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('/report/Report/searchImportCompliance').'?control_no='.$_GET['control_no'].'&mawb_no='.$_GET['mawb_no'].'&filter='.$_GET['filter'];?>" class="form-control input-sm">
	<option value="10">10</option>
	<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
	<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
	<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
	<option value="500" <?=$entries=='500'?'selected':'';?>>500</option>
	<option value="<?=$dataConfig['total'];?>" <?=$entries==$dataConfig['total']?'selected':'';?>>ALL</option>
</select>
entries</label>

<div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite" style="margin-top: -6px;margin-left: 12px;float: right;">
	Showing <?=$dataConfig['page']+1;?> to 
	<?php
		$m=$dataConfig['page']==0?$dataConfig['perPage']:$dataConfig['page']+$dataConfig['perPage'];
		echo $m >= $dataConfig['total']?$dataConfig['total']:$m;
	?> of <?php echo $dataConfig['total'];?> entries
</div>
</div>
<div id="DataTables_Table_0_filter" class="dataTables_filter">
<label>Search:
<input type="text" class="form-control input-sm" id="searchTerm"  onkeyup="doSearch()" placeholder="What you looking for?">
</label>
</div>
</div>
</div>
</div>

<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example1" id="tblData" >
<thead>
<tr>
 		<th><div style="width:65px;">Serial No.</div></th>
		<th><div style="width:85px;">CONTROL No.</div></th>
		<th><div style="width:70px;">MRN Date</div></th>
		<th><div style="width:92px;">MRN Sent Time</div></th>
		<th><div style="width:80px;">Destination</div></th>
		<th><div style="width: 130px;">HAWB Booking date</div></th>
		<th><div style="width: 107px;">Port Of Loading</div></th>
		<th><div style="width:95px;">Pre Alert Date</div></th>
		<th><div style="width:70px;">ETA Date</div></th>										
		<th><div style="width:70px;">ATA Date</div></th>
		<th><div style="width:90px;">Duty Amount</div></th>
		<th><div style="width:85px;">IGST Amount</div></th>
		<th><div style="width:80px;">Order No.</div></th>		
		<th><div style="width:75px;">Gate Entry</div></th>
		<th><div style="width:70px;">GE Date</div></th>
		<th><div style="width:50px;">GE Time</div></th>
		<th><div style="width: 105px;">Vehicle Number</div></th>
		<th><div style="width: 105px;">Unloading Date</div></th>
		<th><div style="width: 105px;">Unloading Time</div></th>
		<th><div style="width:110px;">Date Of Receipt at warehouse</div></th>
		<th><div style="width:100px;">International TAT( ETA-ATA)</div></th>
		<th><div style="width: 170px;">Lead Time (from ATA Del to Recipt at warehouse)</div></th>
		<th><div style="width: 145px;">Lead time(from HAWB to Recipt at w/h)</div></th>
		<th><div style="width: 120px;">Receipt of Month</div></th>
        <th><div style="width:80px;">MAWB No.</div></th>
		<th><div style="width:70px;">Origin</div></th> 
		<th><div style="width:95px;">HAWB No.</div></th>
		<th><div style="width:40px;">Pkg</div></th>
	 	<th><div style="width:40px;">Pallet</div></th>
		<th><div style="width: 115px;">Gross Weight(KG)</div></th>		
		<th><div style="width:70px;">BOE No.</div></th>
		<th><div style="width:70px;">HSN Code</div></th>
		<th><div style="width: 107px;">Exchange Rate 1 USD/EURO</div></th>
		<th><div style="width:70px;">BOE Date</div></th>		
		<th><div style="width:65px;">PG GROUP</div></th>
		<th><div style="width:100px;">Category</div></th>
		<th><div style="width:80px;">Model No.</div></th>
		<th><div style="width:120px;">Description</div></th>
		<th><div style="width:70px;">GRN NO.</div></th>
		<th><div style="width:70px;">GRN Date</div></th>
		<th><div style="width: 160px;">NO_OF_DAYS FROM W-H RECIPT TO GRN DATE (&lt;=2)</div></th>
		<th><div style="width:80px;">Invoice No.</div></th>
		<th><div style="width:82px;">Invoice Date</div></th>		
		<th><div style="width: 115px;">Invoice HSN Code</div></th>
		<th><div style="width:40px;">Qty</div></th>
		<th><div style="width: 130px;">Unt of Measurment</div></th>
		<th><div style="width:70px;">Currency</div></th>
		<th><div style="width:70px;">Unit Price</div></th>
		<th><div style="width:80px;">Total Value</div></th>
		<th><div style="width: 115px;">Invoice Value (USD / EURO/ INR)</div></th>
		<th><div style="width:70px;">Value INR</div></th>
		<th><div style="width:100px;">Damage in Pcs</div></th>
		<th><div style="width: 103px;">Shortage in Pcs</div></th>
		<th><div style="width: 105px;">Incident report Sent Y/N</div></th>
		<th><div style="width:100px;">REMARKS 1</div></th>
		<th><div style="width:100px;">REMARKS 2</div></th>
</tr>
</thead>
<tbody id="getDataTable">
<?php
$yy=1;

foreach(@$result as $ctrlno){
?>
<tr class="gradeC record">

<th><?php echo $yy++; //$ctrlno->stockinhdr;  ?></th>
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
echo $ploading->keyvalue; ?></th>

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
	$tarif=$this->db->query("select * from tbl_product_stock where Product_id='$ctrlno->product_id'");
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
<th><?php echo $ctrlno->grn_no; ?></th>
<th><?php echo $ctrlno->grn_date; ?></th>

<th><?php 
$date1 = $ctrlno->date_of_receipt_at_warehose;
$date2 = $ctrlno->grn_date; 

$date1Timestamp = strtotime($date1);
$date2Timestamp = strtotime($date2); 

$no_of_days = $date2Timestamp - $date1Timestamp;
 
if($ctrlno->grn_date !='' && $ctrlno->date_of_receipt_at_warehose !=''){ echo $no_of_days/86400; } else { } ?></th>

<th><?php echo $ctrlno->invoice_no; ?></th>
<th><?php echo $ctrlno->invoice_date; ?></th>	
<th><?php echo $tariff->tariff; ?></th>	
<th><?php echo $ctrlno->quantity; ?></th>

<th><?php
	$bookingTypeQuery=$this->db->query("select *from tbl_master_data where serial_number='12' and param_id='16' ");
	$getBookingType=$bookingTypeQuery->row();
echo $getBookingType->keyvalue;?></th>

<th><?php echo $ctrlno->currency; ?></th>
<th><?php echo $ctrlno->list_price; ?></th>
<th><?php echo $ctrlno->list_price *  $ctrlno->quantity; ?></th>	

<th><?php ?></th>	
<th><?php //echo $ctrlno->grand_total * $ctrlno->exchange_rate; ?></th>	
<th><?php ?></th>
<th><?php ?></th>
<th><?php ?></th>
<th><?php ?></th>
<th><?php ?></th>

</tr>
<?php  } ?>
</tbody>
</table>

<div class="row">
   <div class="col-md-12 text-right">
	  <div class="col-md-6 text-left"> 
	  </div>
	  <div class="col-md-6"> 
		 <?=$pagination; ?>
	  </div>
   </div>
</div>

</div>
</div>
</div>
</div>
</div>
<?php
$this->load->view("footer.php");
?>

