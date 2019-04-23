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
<h4 class="panel-title">TRANSACTION REPORT </h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
</ul>
</div>
<div class="panel-body">
<form class="form-horizontal panel-body-to" method="get">

<div class="form-group"> 
<label class="col-sm-2 control-label">Location</label> 
<div class="col-sm-3"> 
<select name="location" class="form-control">
<option value="">--Select--</option>
<?php
$masterData=$this->db->query("select *from tbl_master_data where param_id='29'");
foreach($masterData->result() as $getData){
?>
<option value="<?=$getData->serial_number;?>"><?=$getData->keyvalue;?></option>
<?php }?>
</select>
</div>
<label class="col-sm-2 control-label">Product Code</label> 
<div class="col-sm-3"> 
<input type="text" name="sku_no" class="form-control" value="" /> 
</div>
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">From Date</label> 
<div class="col-sm-3"> 
<input type="date" name="f_date" class="form-control"/> 
</div>
<label class="col-sm-2 control-label">To Date</label> 
<div class="col-sm-3"> 
<input type="date" name="t_date" class="form-control" /> 
</div>
<label class="col-sm-2 control-label"><button type="submit" name="filter" value="filter" class="btn btn-info btn-sm">Search</button></label>  
</div>

</form>
</div>

<div class="row">
<div class="col-sm-12">
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
<div class="html5buttons">
<div class="dt-buttons">
<a href="<?=base_url('report/Report/export_transaction').'?location='.$_GET['location'].'&sku_no='.$_GET['sku_no'].'&f_date='.$_GET['f_date'].'&t_date='.$_GET['t_date'].'&filter='.$_GET['filter'];?>" class="dt-button buttons-excel buttons-html5" style="margin: 0px 30px 0px 0px;"><strong>Excel</strong></a>
</div>
</div>

<div class="dataTables_length" id="DataTables_Table_0_length" style="margin: 0px 0px 0px 30px;">
<label> Show
<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('/report/Report/searchDelhiStock').'?location='.$_GET['location'].'&sku_no='.$_GET['sku_no'].'&f_date='.$_GET['f_date'].'&t_date='.$_GET['t_date'].'&filter='.$_GET['filter'];?>" class="form-control input-sm">
	<option value="10">10</option>
	<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
	<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
	<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
	<option value="500" <?=$entries=='500'?'selected':'';?>>500</option>
    <option value="<?=$dataConfig['total'];?>" <?=$entries==$dataConfig['total']?'selected':'';?>>ALL</option>
</select>
entries</label>

<div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite" style=" margin-top: -6px;margin-left: 12px;float: right;">
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
		<th><div style="width:70px;">Date</div></th>
        <th><div style="width:110px;">Original Invoice Received Time</div></th>   
		<th><div style="width:150px;">Customer</div></th>
		<th><div style="width:115px;">From Location</div></th>
		<th><div style="width:75px;">Type</div></th>
		<th><div style="width:80px;">Order No</div></th>
		<th><div style="width:100px;">Invoice No.</div></th>
		<th><div style="width:100px;">To Location</div></th>
		<th><div style="width:100px;">Product Code</div></th>
		<th><div style="width:100px;">Qty Receipt</div></th>
		<th><div style="width:120px;">Qty Dispatched</div></th>
		<th><div style="width:100px;">Availability</div></th>
		<th><div style="width:190px;">Description-1</div></th>
		<th><div style="width:190px;">Description-2</div></th>
		<th><div style="width:100px;">Total Pcs</div></th>
		<th><div style="width:140px;">Warehouse Remarks</div></th>
</tr>
</thead>
<tbody id="getDataTable">
<?php
$yy=1;

foreach($result as $rows) {

$dtl=$this->db->query("select * from tbl_stock_out_dtl where product_id='$rows->product_id' AND stockouthdr = '$rows->inbound_id '");
$getDtl=$dtl->row();

$hdr=$this->db->query("select * from tbl_stock_out_hdr where stockoutid='$getDtl->stockouthdr'");
$getHdr=$hdr->row();


//echo "select * from tbl_stock_in_hdr where stockinid='$rows->inbound_id'";
$stockinhdr=$this->db->query("select * from tbl_stock_in_hdr where stockinid='$rows->inbound_id'");
$getStockInHdr=$stockinhdr->row();


$stock=$this->db->query("select * from tbl_product_stock where Product_id='$rows->product_id'");
$getStock=$stock->row();
?>
<tr class="gradeC record">
<th><?php echo $yy++; ?></th>

<th><?php echo $rows->maker_date; ?></th>

<th><?php echo $getHdr->original_inv_rec_time; ?></th>
<th><?php
//echo "select * from tbl_contact_m where contact_id='$getHdr->contact_id' ";
if($rows->type=='Inbound' or $rows->type=='Inbound-mul'){

$stockInQuery=$this->db->query("select *from tbl_stock_in_hdr where stockinid='$rows->inbound_id'");
$getStockIn=$stockInQuery->row();

if($getStockIn->origin == 32 or $getStockIn->origin == 73 ){
	echo "Sennheiser Logistics Services GmbH";
}elseif($getStockIn->origin == 80 or $getStockIn->origin == 84){
	echo "APART AUDIO NV";
}
	
}
else
{
		$sql1 = $this->db->query("select * from tbl_contact_m where code='$getHdr->contact_id' AND group_name='4' ");
		$sql2 = $sql1->row();
		
		if($sql2->code!='')
		 echo $sql2->first_name;	
}
?>
</th>
<th><?php
//echo "select *from tbl_master_data where serial_number='$rows->location_id'";
	$hdrQueryStockIn=$this->db->query("select *from tbl_master_data where serial_number='$rows->location_id'");
	$getStockIn=$hdrQueryStockIn->row();
	echo $getStockIn->keyvalue;
?> 
</th>
<th><?php
		$proQ1=$this->db->query("select * from tbl_master_data where serial_number='$getHdr->type'");
		$fProQ12=$proQ1->row();
		
		if($rows->type=='Inbound' or $rows->type=='Inbound-mul')
		{
				echo "Import";	
		
		}
		else if($rows->type=='Transfer')
		{
			echo "Transfer";
		}
		else if($rows->type=='Demo Outbound')
		{
			echo "Demo Outbound";
		}
		else if($rows->type=='Sales Return')
		{
			echo "Sales Return";
		}
		else if($rows->type=='Demo Return')
		{
			echo "Demo Return";
		}
		else if($rows->type=='warehouse_transfer')
		{
			echo "warehouse_transfer";
		}
		else
		{
			echo $fProQ12->keyvalue;
		}
	 ?>
</th>	

<?php if($rows->type=='Inbound' or $rows->type=='Inbound-mul') { ?>
<th><?php echo $getStockInHdr->order_no;?></th>	
<th><?php echo $getStockInHdr->invoice_no;?></th>
<?php }  else { ?>
<th><?php echo $getHdr->order_no;?></th>	
<th><?php echo $getHdr->invoice_no;?></th>
<?php } ?>

<th><?php
// if($rows->type=='Inbound-mul' or $rows->type=='Inbound')
// {
// 	$hdrQueryStockIn=$this->db->query("select *from tbl_stock_in_hdr where stockinid='$rows->inbound_id'");
// 	$getStockIn=$hdrQueryStockIn->row();
	
// 		$bookingTypeQuery=$this->db->query("select *from tbl_contact_m where contact_id='$getStockIn->location_to'");
// 		$getBookingType=$bookingTypeQuery->row();
// 		echo $getBookingType->city; 
// }
// else
// {
	
	$hdrQueryStockInn=$this->db->query("select *from tbl_stock_out_hdr where stockoutid='$rows->inbound_id'");
	$getStockInn=$hdrQueryStockInn->row();
	//echo "select *from tbl_contact_m where contact_id='$getStockInn->location_to'";
		$bookingTypeQueryy=$this->db->query("select *from tbl_contact_m where contact_id='$getStockInn->location_to'");
		$getBookingTypee=$bookingTypeQueryy->row();
		echo $getBookingTypee->city; 
//}
?>
</th>

<th><?php echo $getStock->sku_no;  ?></th>
<th><?php 	 
	    $qtyin=$this->db->query("select * from tbl_stock_in_dtl where product_id='$rows->product_id'");
		$qtyindtl=$qtyin->row();
		
		//if($fProQ12->keyvalue=='Inbound' or $fProQ12->keyvalue=='Inbound-mul' )
		if($rows->type=='Demo Return' or $rows->type=='Transfer' or $rows->type=='Inbound' or $rows->type=='Inbound-mul')
		{
 			echo $rows->quantity;  
        }
        else{}
        //echo $rows->quantity;   ?>
</th>
<th><?php	

 		//if($fProQ12->keyvalue=='STNOUT' or $fProQ12->keyvalue=='Outbound' or $fProQ12->keyvalue=='STNOUT' or $fProQ12->keyvalue=='Invoice')
		if($fProQ12->keyvalue=='STNOUT' or $fProQ12->keyvalue=='Invoice' or $rows->type=='Demo Outbound')
		{
	 		echo $rows->quantity;  
        }
        else{}
		?>
</th>
<th><?php
		//echo "select SUM(quantity) as Aqty from tbl_product_serial where product_id='$rows->product_id' and location_id='$rows->location_id'";
	    $avaltyQuery=$this->db->query("select SUM(quantity) as Aqty from tbl_product_serial where product_id='$rows->product_id' and location_id='$rows->location_id'");
 		$getAvalty= $avaltyQuery->row(); 
		echo $getAvalty->Aqty ; 	?>
</th>

<th><?php echo $getStock->productname; ?></th>
<th><?php echo $getStock->description2; ?></th>
<th><?php   ?></th>
<th><?php 
 		$dest=$this->db->query("select * from tbl_return_dtl where product_id='$rows->product_id'");
		$dest1=$dest->row();
		$dest3=$this->db->query("select * from tbl_return_hdr where returnid='$dest1->returnhdr'");
		$dest4=$dest3->row();
	 echo $dest4->wh_remarks; ?></th>
</tr>
<?php }  ?>
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