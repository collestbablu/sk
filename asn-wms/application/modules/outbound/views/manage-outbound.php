<?php
$this->load->view("header.php");	
require_once(APPPATH.'core/my_controller.php');
$obj=new my_controller();
$CI =& get_instance();
$tableName='tbl_stock_in_hdr';

$entries = "";
if($this->input->get('entries')!="")
{
  $entries = $this->input->get('entries');
}


?>
<!-- Main content -->
<div class="main-content">
<ol class="breadcrumb breadcrumb-2"> 
	<?php 
	if($add!='')
	{ ?>
	<li><a class="btn btn-success btn-sm" href="<?=base_url();?>outbound/addOutbound">Add Outbond</a></li> 
	<?php }?>
</ol>
		
<ol class="breadcrumb breadcrumb-2"> 
	<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
	<li><a href="#">Outbond</a></li> 
	<li class="active"><strong><a href="#">Manage Outbond</a></strong></li> 
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

<div class="panel-body">
<div class="table-responsive">

<div class="row">
<div class="col-sm-12" id="listingData">
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
<div class="html5buttons">
<div class="dt-buttons">
<a href="<?=base_url('outbound/export_outbound').'?p_code='.$_GET['p_code'].'&date='.$_GET['date'].'&original_inv_rec_time='.$_GET['original_inv_rec_time'].'&customer='.$_GET['customer'].'&order_no='.$_GET['order_no'].'&invoice_no='.$_GET['invoice_no'].'&location='.$_GET['location'].'&type='.$_GET['type'].'&filter='.$_GET['filter'];?>" class="dt-button buttons-excel buttons-html5" style="margin: 0px 0px 0px 0px;"><strong>Excel</strong></a>
</div>
</div>

<div class="dataTables_length" id="DataTables_Table_0_length" style="margin: 0px 0px 0px 0px;">
<label>Show
<select name="DataTables_Table_0_length" url="<?=base_url('outbound/manageOutbound').'?p_code='.$_GET['p_code'].'&date='.$_GET['date'].'&original_inv_rec_time='.$_GET['original_inv_rec_time'].'&customer='.$_GET['customer'].'&order_no='.$_GET['order_no'].'&invoice_no='.$_GET['invoice_no'].'&location='.$_GET['location'].'&type='.$_GET['type'].'&filter='.$_GET['filter'];?>" aria-controls="DataTables_Table_0" id="entries" class="form-control input-sm">
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
<br />

<table class="table table-striped table-bordered table-hover dataTables-example1" id="tblData" >
<thead>
<tr>
<form method="get">
<th></th>
<th></th>
<th></th>
<th>Product Code</th>
<th><input type="text" name="p_code" class="form-control" value="" > </th> 
<th></th>
<th></th>
<th></th>
</tr>
</thead>
<thead style="background:#2C365A;color: #fff;">
<tr>
	    <th style="display:none;">Sr.No.</th>
	    <th><div style="width:100px;">Date</div></th>
        <th><div style="width:120px;">Original Invoice Received Time</div></th>
		<th><div style="width:150px;">Customer</div></th>
		<th><div style="width:100px;">Order No</div></th>
        <th><div style="width:100px;">Invoice No</div></th>
        <th><div style="width:100px;">To Location</div></th>
        <th><div style="width:100px;">Type</div></th>
        <th><div style="width:130px;">Action</div></th>
</tr>
</thead>

<tbody id="getDataTable">
<tr>
	<td><input name="date"  type="date"  class="form-control"  value="" style="width: 155px;"/></td>
	<td><input name="original_inv_rec_time"  type="text"  class="form-control"  value="" /></td>
	<td><input name="customer"  type="text"  class="form-control"  value="" /></td>
	<td><input name="order_no"  type="text"  class="form-control"  value="" /></td>
	<td><input name="invoice_no"  type="text"  class="form-control"  value="" /></td>
	<td><input name="location"  type="text"  class="form-control"  value="" /></td>
	<td><input name="type"  type="text"  class="form-control"  value="" /></td>
	<td><button type="submit" class="btn btn-success btn-sm" name="filter" value="filter"><span>Search</span></button></td>
</tr>
</form>
<?php

$i=1;
/*@extract($_POST);
if($Show=='')
{
$select_query = "Select * from tbl_stock_out_hdr where  comp_id='".$this->session->userdata('comp_id')."' order by stockoutid desc ";
}
else
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
		

$select_query = "Select * from tbl_stock_out_hdr where stockoutid in ($hdrDataa)";



}
$select_query1= $this->db->query($select_query);


foreach($select_query1->result() as $sales) {
*/
foreach($result as $sales){
?>

<tr class="gradeC record">
<th style="display:none"><?php echo $sales->stockoutid;?></th>

<th><?php echo $obj->explode_date($sales->date);?></th>

<th><?php echo $sales->original_inv_rec_time;?></th>
<?php
//echo "select *from tbl_master_data where serial_number='$sales->booking_type'";
$bookingTypeQuery=$this->db->query("select * from tbl_contact_m where code='$sales->contact_id'");
$getBookingType=$bookingTypeQuery->row();
?>
<th><?php echo $getBookingType->first_name; ?></th>

<th><?=$sales->order_no?></th>

<th><?=$sales->invoice_no;?></th>
<?php
//echo "select *from tbl_master_data where serial_number='$sales->booking_type'";
$bookingTypeQuery22=$this->db->query("select * from tbl_contact_m where contact_id='$sales->location_to'");
$getBookingType22=$bookingTypeQuery22->row();
?>
<th><?=$getBookingType22->city;?></th>
<th>
<?php
//echo "select *from tbl_master_data where serial_number='$sales->booking_type'";
$bookingTypeQuery333=$this->db->query("select * from tbl_master_data where serial_number='$sales->type'");
$getBookingType333=$bookingTypeQuery333->row();
?>

<?=$getBookingType333->keyvalue;?></th>

<th>
<a href="#" onClick="openpopup('<?=base_url();?>outbound/edit_OutBound',1400,600,'view',<?=$sales->stockoutid;?>)"><i class="glyphicon glyphicon-zoom-in"></i></a>&nbsp;&nbsp;&nbsp;<a href="#" onClick="openpopup('<?=base_url();?>outbound/edit_OutBound',1400,600,'id',<?=$sales->stockoutid;?>)"><i class="glyphicon glyphicon-pencil"></i></a> &nbsp;&nbsp;&nbsp;
<?php
$pri_col='stockoutid';
$table_name='tbl_stock_out_hdr';

$pri_col_dtl='stockoutdtlid';
$table_name_dtl='tbl_stock_out_dtl';
?>
 <a href="#" id="<?php echo $sales->stockoutid."^".$table_name."^".$pri_col."^".$tbl_stock_out_dtl."^".$pri_col_dtl ; ?>" class="delbuttonPurchase icon"><i class="glyphicon glyphicon-remove"></i></a>  

<?php
if($sales->type=='68')
{
?>
&nbsp;&nbsp;<a target="_blank" href="<?=base_url();?>outbound/print_gatepass?id=<?php echo $sales->stockoutid;?>">Print</a>

<?php }

if($sales->type=='67')
{
?>
&nbsp;&nbsp;<a href="#" onClick="openpopup('<?=base_url();?>outbound/stockIn',1400,600,'id',<?=$sales->stockoutid;?>)">Sales Return</i></a>
<?php } ?>
</th>
</tr>
<?php $i++; } ?>
</tbody>
</table>

<div class="row">
 <div class="col-md-12 text-right">
  <div class="col-md-6 text-left"> 
  </div>
 	<div class="col-md-6"> 
		<?php echo $pagination; ?>
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