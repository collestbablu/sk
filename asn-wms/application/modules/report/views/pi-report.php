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
<h4 class="panel-title">PI Report</h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
</ul>
</div>

<div class="panel-body">
<form class="form-horizontal panel-body-to" method="get" >

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

<!--<label class="col-sm-2 control-label">Part No.</label> 
<div class="col-sm-3"> 
<input type="text" name="part_no" class="form-control" readonly=""/> 
</div>
-->
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
<a href="<?=base_url('report/Report/export_pi').'?location='.$_GET['location'].'&f_date='.$_GET['f_date'].'&t_date='.$_GET['t_date'].'&filter='.$_GET['filter'];?>" class="dt-button buttons-excel buttons-html5" style="margin: 0px 30px 0px 0px;"><strong>Excel</strong></a>
</div>
</div>

<div class="dataTables_length" id="DataTables_Table_0_length" style="margin: 0px 0px 0px 30px;">
<label>Show
<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('/report/Report/searchPI').'?location='.$_GET['location'].'&f_date='.$_GET['f_date'].'&t_date='.$_GET['t_date'].'&filter='.$_GET['filter'];?>" class="form-control input-sm">
	<option value="10">10</option>
	<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
	<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
	<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
	<option value="500" <?=$entries=='500'?'selected':'';?>>500</option>
	<option value="<?=$dataConfig['total'];?>" <?=$entries==$dataConfig['total']?'selected':'';?>>ALL</option>
</select>
entries</label>

<div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite" style="    margin-top: -6px;margin-left: 12px;float: right;">
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
 		<th>Serial No.</th>
		<th>Part No.</th>
		<th>DESCRIPTION</th>
		<th>PHY. QTY</th> 
		<th>Qty</th>
		<th>Location</th>
		<th>Segment</th>
			
</tr>
</thead>
<tbody id="getDataTable">
<?php

$yy=1;
foreach($result as $rows) {

?>

<?php
$bookingTypeQuery=$this->db->query("select * from tbl_product_stock where Product_id='$rows->product_id' ");
$getBookingType=$bookingTypeQuery->row();
?>
<tr class="gradeC record">
<th><?php echo $yy; ?></th>
<th><?php echo $getBookingType->sku_no; ?></th>
<th><?php echo $getBookingType->productname; ?></th>
<th><?php //echo $rows->maker_date;	 ?> </th>
<th>
<?php

if($location!='')
{
$fetchQ21=$this->db->query("select SUM(quantity) as qtyy from tbl_product_serial where product_id='$rows->product_id' and location_id='$location' and comp_id='".$this->session->userdata('comp_id')."'   ");
}
else
{
$fetchQ21=$this->db->query("select SUM(quantity) as qtyy from tbl_product_serial where product_id='$rows->product_id' and location_id='$rows->location_id' and comp_id='".$this->session->userdata('comp_id')."'");
}

$fetchQ31=$fetchQ21->row();

echo $fetchQ31->qtyy;

?>
</th>

<th>
<?php 
	$proQ112=$this->db->query("select * from tbl_location_rack where id='$rows->rack_id'");
		$fProQ111=$proQ112->row();
	echo $fProQ111->rack_name;?>
</th>	
<th><?php 
		$sql1 = $this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='$getBookingType->category' ");
			$sql3 = $sql1->row();
			echo $sql3->prodcatg_name; 
?></th>

</tr>
<?php $yy++; } ?>


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


