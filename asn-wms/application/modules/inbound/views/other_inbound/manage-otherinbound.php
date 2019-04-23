<?php
$this->load->view("header.php");	
require_once(APPPATH.'core/my_controller.php');
$obj=new my_controller();
$CI =& get_instance();
$tableName='tbl_stock_in_hdr';

$entries = "";
if($this->input->get('entries')!=""){
  $entries = $this->input->get('entries');
}

?>
<!-- Main content -->
<div class="main-content">
			
<ol class="breadcrumb breadcrumb-2"> 
	<?php 
	if($add!='')
	{ ?>
	<li><a class="btn btn-success btn-sm" href="<?=base_url();?>inbound/otherinbound/addOtherInbound">Add Intbond</a></li> 
	<?php }?>
</ol>

<ol class="breadcrumb breadcrumb-2"> 
	<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
	<li><a href="#">Intbond</a></li> 
	<li class="active"><strong><a href="#">Manage Inbound</a></strong></li> 
</ol>
			
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
	<h4 class="panel-title"><strong>Pre Alert</strong></h4>
	<ul class="panel-tool-options"> 
		<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
	</ul>
</div>
<br />

<div class="row">
<div class="col-sm-12" id="listingData">
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
<div class="html5buttons">
<div class="dt-buttons">
<a href="<?=base_url('inbound/otherinbound/export_other_inbound').'?stockinid='.$_GET['stockinid'].'&date='.$_GET['date'].'&original_inv_rec_time='.$_GET['original_inv_rec_time'].'&customer='.$_GET['customer'].'&order_no='.$_GET['order_no'].'&invoice_no='.$_GET['invoice_no'].'&origin='.$_GET['origin'].'&type='.$_GET['type'].'&filter='.$_GET['filter'];?>" class="dt-button buttons-excel buttons-html5" style="margin: 0px 30px 0px 0px;"><strong>Excel</strong></a>
</div>
</div>

<div class="dataTables_length" id="DataTables_Table_0_length" style="margin: 0px 0px 0px 30px;">
<label>Show
<select name="DataTables_Table_0_length" url="<?=base_url('inbound/otherinbound/manageotherinbound').'?stockinid='.$_GET['stockinid'].'&date='.$_GET['date'].'&original_inv_rec_time='.$_GET['original_inv_rec_time'].'&customer='.$_GET['customer'].'&order_no='.$_GET['order_no'].'&invoice_no='.$_GET['invoice_no'].'&origin='.$_GET['origin'].'&type='.$_GET['type'].'&filter='.$_GET['filter'];?>" aria-controls="DataTables_Table_0" id="entries" class="form-control input-sm">
	<option value="10" <?=$entries=='10'?'selected':'';?>>10</option>
	<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
	<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
	<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
	<option value="500" <?=$entries=='500'?'selected':'';?>>500</option>
	<option value="<?=$dataConfig['total'];?>" <?=$entries==$dataConfig['total']?'selected':'';?>>ALL</option>
</select>
entries</label>
<div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite" style="margin-top: -6px;margin-left: 12px;float: right;">Showing <?=$dataConfig['page']+1;?> to 
<?php
$m=$dataConfig['page']==0?$dataConfig['perPage']:$dataConfig['page']+$dataConfig['perPage'];
echo $m >= $dataConfig['total']?$dataConfig['total']:$m;
?> of <?=$dataConfig['total'];?> entries
</div>
</div>

<div id="DataTables_Table_0_filter" class="dataTables_filter">
<label>Search:
<input type="text" id="searchTerm"  class="search_box form-control input-sm" onkeyup="doSearch()"  placeholder="What you looking for?">
</label>
</div>
</div>

</div>
</div>
<div class="panel-body">
	<div class="table-responsive">
<form1 method="post">
<table class="table table-striped table-bordered table-hover dataTables-example1" id="tblData" >
<thead>
<tr>
	  <th style="display:none;"><input type="checkbox" /></th>
	   <th><div style="width:90px;">Serial No.</div></th>
	   <th><div style="width:90px;">Date</div></th>
       <th><div style="width:130px;">Original Invoice Received Time</div></th>
       <th><div style="width:185px;">Customer</div></th>
       <th><div style="width:90px;">Order No</div></th>
       <th><div style="width:90px;">Invoice No</div></th>
       <th><div style="width:90px;">Origin</div></th>
       <th><div style="width:90px;">Type</div></th>
       <th>Action</th>
</tr>
</thead>

<tbody id="getDataTable">
<form method="get">
<tr>
	<td><input name="stockinid"  type="text"  class="form-control"  value="" /></td>
	<td><input name="date"  type="date"  class="form-control"  value="" /></td>
	<td><input name="original_inv_rec_time"  type="text"  class="form-control"  value="" /></td>
	<td><input name="customer"  type="text"  class="form-control"  value="" /></td>
	<td><input name="order_no"  type="text"  class="form-control"  value="" /></td>
	<td><input name="invoice_no"  type="text"  class="form-control"  value="" /></td>
	<td><input name="origin"  type="text"  class="form-control"  value="" /></td>
	<td><input name="type"  type="text"  class="form-control"  value="" /></td>
	<td><button type="submit" class="btn btn-success btn-sm" name="filter" value="filter"><span>Search</span></button></td>
</tr>
</form>

<?php
$i=1;
	foreach($result as $sales)
  {
  ?>

<tr class="gradeC record">
<th style="display:none"><input type="checkbox" /></th>
<th><?php echo $sales->stockinid;?></th>
<th><?php echo $sales->date;?></th>
<th><?php echo $sales->original_inv_rec_time;?></th>

<?php
//echo "select *from tbl_master_data where serial_number='$sales->booking_type'";
$bookingTypeQuery=$this->db->query("select *from tbl_contact_m where code='$sales->supplier_id'");
$getBookingType=$bookingTypeQuery->row();
?>
<th><?php echo $getBookingType->first_name; ?></th>

<th><?=$sales->order_no?></th>
<th><?=$sales->invoice_no;?></th>
<?php
//echo "select *from tbl_master_data where serial_number='$sales->booking_type'";
$bookingTypeQuery333=$this->db->query("select * from tbl_master_data where serial_number='$sales->origin'");
$getBookingType333=$bookingTypeQuery333->row();
?>
<th><?=$getBookingType333->keyvalue;?></th>

<th>
<?php
//echo "select *from tbl_master_data where serial_number='$sales->booking_type'";
$bookingTypeQuery4444=$this->db->query("select *from tbl_master_data where serial_number='$sales->type'");
$getBookingType22=$bookingTypeQuery4444->row();
?>
<?=$getBookingType22->keyvalue;?>
</th>

<th>
<a style="display:none1;" href="#" onClick="openpopup('<?=base_url();?>inbound/otherinbound/edit_OtherInbound',1400,600,'view',<?=$sales->stockinid;?>)"><i class="glyphicon glyphicon-zoom-in"></i>
</a>&nbsp;&nbsp;&nbsp;<a style="display:none1;" href="#" onClick="openpopup('<?=base_url();?>inbound/otherinbound/edit_OtherInbound',1400,600,'id',<?=$sales->stockinid;?>)"><i class="glyphicon glyphicon-pencil"></i>
<?php
$pri_col='stockinid';
$table_name='tbl_stock_in_hdr';

$pri_col_dtl='stockinhdr';
$table_name_dtl='tbl_stock_in_dtl';


$dtlCntQuery=$this->db->query("select SUM(quantity) as qnty from tbl_stock_in_dtl where stockinhdr='$sales->stockinid'");
$stdDtlCnt=$dtlCntQuery->row();
$stdDtlCnt->qnty;
	
$selogCntQuery=$this->db->query("select SUM(quantity) as log_qnty from tbl_product_serial_log where inbound_id='$sales->stockinid' and type='Inbound'");
$selLogCnt=$selogCntQuery->row();
$selLogCnt->log_qnty;
	if($stdDtlCnt->qnty==$selLogCnt->log_qnty)
	{
	}
	else
	{
	?>
	&nbsp;&nbsp;&nbsp;<a href="#" style="display:none1;" id="<?php echo $sales->stockinid."^".$table_name."^".$pri_col."^".tbl_stock_in_dtl."^".$pri_col_dtl ; ?>" class="delbuttonPurchase icon"><i class="glyphicon glyphicon-remove"></i></a> 

<a  href="#" onClick="openpopup('<?=base_url();?>inbound/stockIn?id',1200,500,'id',<?=$sales->stockinid;?>)">Stock In</a>
<?php }?>
</th>
</tr>
<?php $i++;} ?>
</tbody>
</table>
</form1>
<div class="row">
 <div class="col-md-12 text-right">
  <div class="col-md-6 text-left"> 
  </div>
 	<div class="col-md-6"> 
		<?php echo $pagination; ?>
	</div>
		<div class="popover fade right in displayclass" role="tooltip" id="popover" style=" background-color: #ffffff;border-color: #212B4F;">
		<div class="popover-content" id="showParent"></div>
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

