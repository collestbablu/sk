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
	<li><a class="btn btn-success btn-sm" href="<?=base_url();?>inbound/addInbound">Add Pre Alert</a></li> 
	<?php }?>
</ol>

<ol class="breadcrumb breadcrumb-2"> 
	<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
	<li><a href="#">Pre Alert</a></li> 
	
	<li class="active"><strong><a href="#">Manage Pre Alert</a></strong></li> 
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
<a href="<?=base_url('inbound/export_prealert').'?stockinid='.$_GET['stockinid'].'&hawb='.$_GET['hawb'].'&mawb_no='.$_GET['mawb_no'].'&origin='.$_GET['origin'].'&destination='.$_GET['destination'].'&HAWB_booking_date='.$_GET['HAWB_booking_date'].'&port_of_loading='.$_GET['port_of_loading'].'&pre_alert_date='.$_GET['pre_alert_date'].'&eta_date='.$_GET['eta_date'].'&status='.$_GET['status'].'&filter='.$_GET['filter'];?>" class="dt-button buttons-excel buttons-html5" style="margin: 0px 30px 0px 0px;"><strong>Excel</strong></a>
</div>
</div>

<div class="dataTables_length" id="DataTables_Table_0_length" style="margin: 0px 0px 0px 30px;">
<label>Show
<select name="DataTables_Table_0_length" url="<?=base_url('inbound/manageInbound'.'?stockinid='.$_GET['stockinid'].'&hawb='.$_GET['hawb'].'&mawb_no='.$_GET['mawb_no'].'&origin='.$_GET['origin'].'&destination='.$_GET['destination'].'&HAWB_booking_date='.$_GET['HAWB_booking_date'].'&port_of_loading='.$_GET['port_of_loading'].'&pre_alert_date='.$_GET['pre_alert_date'].'&eta_date='.$_GET['eta_date'].'&status='.$_GET['status'].'&filter='.$_GET['filter']);?>" aria-controls="DataTables_Table_0" id="entries" class="form-control input-sm">
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

<table class="table table-striped table-bordered table-hover dataTables-example1" id="tblData" >
<thead>
<tr>
	    <th><div style="width: 95px;">Serial No.</div></th>
	    <th><div style="width: 100px;">HAWB No.</div></th>
        <th><div style="width: 100px;">MAWB No.</div></th>
        <th><div style="width: 100px;">Origin</div></th>
        <th><div style="width: 100px;">Destination</div></th>
		<th><div style="width: 160px;">HAWB Booking date</div></th>
      	<th><div style="width: 160px;">Port of Loading</div></th>
		<th><div style="width: 160px;">Pre Alert Date</div></th>
        <th><div style="width: 100px;">EDA</div></th>
        <th><div style="width: 130px;">Status</div></th>
        <th><div style="width: 250px;">Action</div></th>
</tr>
</thead>

<tbody id="getDataTable">
<form method="get">
<tr>
	<td><input name="stockinid"  type="text"  class="form-control"  value="" /></td>
	<td><input name="hawb"  type="text"  class="form-control"  value="" /></td>
	<td><input name="mawb_no"  type="text"  class="form-control"  value="" /></td>
	<td><input name="origin"  type="text"  class="form-control"  value="" /></td>
	<td><input name="destination"  type="text"  class="form-control"  value="" /></td>
	<td><input name="HAWB_booking_date"  type="date"  class="form-control"  value="" /></td>
	<td><input name="port_of_loading"  type="text"  class="form-control"  value="" /></td>
	<td><input name="pre_alert_date"  type="date"  class="form-control"  value="" /></td>
	<td><input name="eta_date"  type="date"  class="form-control"  value="" /></td>
	<td><input name="status"  type="text"  class="form-control"  value="" /></td>
	<td><button type="submit" class="btn btn-success btn-sm" name="filter" value="filter"><span>Search</span></button></td>
</tr>
</form>

<?php
$i=1;
foreach($result as $sales)
{
?>

<tr class="gradeC record">
<th><?php echo $sales->stockinid;?></th>
<th><?php echo $sales->hawb;?></th>
<th><?php echo $sales->mawb_no;?></th>

<?php
//echo "select *from tbl_master_data where serial_number='$sales->booking_type'";
$bookingTypeQuery=$this->db->query("select *from tbl_master_data where serial_number='$sales->origin'");
$getBookingType=$bookingTypeQuery->row();
?>
<th><?=$getBookingType->keyvalue;?></th>

<?php
//echo "select *from tbl_master_data where serial_number='$sales->booking_type'";
$bookingTypeQuery2=$this->db->query("select *from tbl_master_data where serial_number='$sales->destination'");
$getBookingType2=$bookingTypeQuery2->row();
?>
<th><?php echo $getBookingType2->keyvalue;?></th>

<th><?php echo $sales->HAWB_booking_date; ?></th>
<?php
//echo "select *from tbl_master_data where serial_number='$sales->booking_type'";
$bookingTypeQuery3=$this->db->query("select *from tbl_master_data where serial_number='$sales->port_of_loading'");
$getBookingType3=$bookingTypeQuery3->row();
?>
<th><?=$getBookingType3->keyvalue?></th>


<th><?=$sales->pre_alert_date;?></th>
<th><?=$sales->eta_date;?></th>

<th>
<?php
//echo "select *from tbl_master_data where serial_number='$sales->booking_type'";
$bookingTypeQuery4=$this->db->query("select *from tbl_master_data where serial_number='$sales->status'");
$getBookingType4=$bookingTypeQuery4->row();
?>
<?=$getBookingType4->keyvalue;?>
</th>

<th>
<a href="#" onClick="openpopup('<?=base_url();?>inbound/edit_Inbound',1400,600,'view',<?=$sales->stockinid;?>)"><i class="glyphicon glyphicon-zoom-in"></i>
</a>&nbsp;&nbsp;&nbsp;<a href="#" onClick="openpopup('<?=base_url();?>inbound/edit_Inbound',1400,600,'id',<?=$sales->stockinid;?>)"><i class="glyphicon glyphicon-pencil"></i>
<?php
$pri_col='stockinid';
$table_name='tbl_stock_in_hdr';

$pri_col_dtl='stockinhdr';
$table_name_dtl='tbl_stock_in_dtl';
	?>
	&nbsp;&nbsp;&nbsp;<a href="#" id="<?php echo $sales->stockinid."^".$table_name."^".$pri_col."^".$table_name_dtl."^".$pri_col_dtl."^".tbl_stock_in_inv_hdr."^".stockinhdr ; ?>" class="delbuttonMultiple icon"><i class="glyphicon glyphicon-remove"></i></a> 
<?php
if($sales->mrn_date!='')
{
	
	$stockInQ=$this->db->query("select SUM(quantity) as qtyS from tbl_stock_in_dtl where stockinhdr='$sales->stockinid'");
	$stockSum=$stockInQ->row();
	$stockSum->qtyS;
	
	
	$stockInQ1=$this->db->query("select SUM(quantity) as qtyD from tbl_product_serial_log where inbound_id='$sales->stockinid' and type='Inbound-mul' or type='Inbound'");
	$stockSum1=$stockInQ1->row();
	 $stockSum1->qtyD;
	
	if($stockSum1->qtyD==$stockSum->qtyS){
	}
	else
	{
?>
<a  href="#" onClick="openpopup('<?=base_url();?>inbound/stockIn?id',1200,500,'id',<?=$sales->stockinid;?>)">&nbsp;&nbsp; Stock In</a>|
<?php }?>
<a  href="<?=base_url();?>inbound/print_mrp?id=<?=$sales->stockinid;?>" target="_blank" >Print MRN</a>|
<?php }?>
<a href="#" onClick="openpopup('<?=base_url();?>inbound/add_multi_invoice?id',1200,500,'id',<?=$sales->stockinid;?>)">Add Invoice</a>|
<a href="#" onClick="openpopup('<?=base_url();?>inbound/ViewInv?id',1200,500,'id',<?=$sales->stockinid;?>)">View Invoice</a>|
<a href="#" onClick="openpopup('<?=base_url();?>inbound/show_mul_inv?id',1200,500,'id',<?=$sales->stockinid;?>)">Edit Invoice</a>


</th>
</tr>
<?php $i++;} ?>
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
