<?php
$this->load->view("header.php");	
require_once(APPPATH.'core/my_controller.php');
$obj=new my_controller();
$CI =& get_instance();
$tableName='tbl_stock_in_hdr';

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
<form method="post">
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<tr>
	   <th style="display:none;">Sr.No.</th>
	   
	   <th><div style="width:55px;">Date</div></th>
       <th><div style="width:110px;">Original Invoice Received Time</div></th>
		<th><div style="width:110px;">Customer</div></th>
		<th><div style="width:90px;">Order No</div></th>
        <th><div style="width:90px;">Invoice No</div></th>
        <th><div style="width:90px;">To Location</div></th>
        <th><div style="width:80px;">Type</div></th>
        
        <th><div style="width:80px;">Action</div></th>
</tr>
</thead>

<tbody>
<?php
$i=1;
	foreach($result as $sales)
  {
  ?>

<tr class="gradeC record">
<th style="display:none"><?php echo $sales->stockoutid;?></th>

<th><?php echo $sales->date;?></th>


<th><?php echo $sales->original_inv_rec_time;?></th>

<?php
//echo "select *from tbl_master_data where serial_number='$sales->booking_type'";
$bookingTypeQuery=$this->db->query("select *from tbl_contact_m where code='$sales->contact_id'");
$getBookingType=$bookingTypeQuery->row();
?>

<th>
<?php 
echo $getBookingType->first_name;
?>
</th>
<th><?=$sales->order_no?></th>


<th><?=$sales->invoice_no;?></th>
<?php
//echo "select *from tbl_master_data where serial_number='$sales->booking_type'";
$bookingTypeQuery=$this->db->query("select *from tbl_contact_m where contact_id='$sales->location_to'");
$getBookingType=$bookingTypeQuery->row();
?>
<th><?=$getBookingType->city;?></th>




<th>
<?php
//echo "select *from tbl_master_data where serial_number='$sales->booking_type'";
$bookingTypeQuery=$this->db->query("select *from tbl_master_data where serial_number='$sales->type'");
$getBookingType=$bookingTypeQuery->row();
?>

<?=$getBookingType->keyvalue;?>
</th>

<th>
<a style="display:none1" href="#" onClick="openpopup('<?=base_url();?>outbound/edit_OutBound',1400,600,'view',<?=$sales->stockoutid;?>)"><i class="glyphicon glyphicon-zoom-in"></i>
</a>&nbsp;&nbsp;&nbsp;<a style="display:none" href="#" onClick="openpopup('<?=base_url();?>outbound/edit_OutBound',1400,600,'id',<?=$sales->stockoutid;?>)"><i class="glyphicon glyphicon-pencil"></i>
<?php
$pri_col='stockoutid';
$table_name='tbl_stock_out_hdr';

$pri_col_dtl='stockoutdtlid';
$table_name_dtl='tbl_stock_out_dtl';
	?>
	&nbsp;&nbsp;&nbsp;<a href="#" style="display:none" id="<?php echo $sales->stockoutid."^".$table_name."^".$pri_col."^".$tbl_stock_out_dtl."^".$pri_col_dtl ; ?>" class="delbuttonPurchase icon"><i class="glyphicon glyphicon-remove"></i></a> 
<a style="display:none1" href="#" onClick="openpopup('<?=base_url();?>inbound/stockInTransfer',1400,600,'id',<?=$sales->stockoutid;?>)">Stock In</a>

</th>
</tr>
<?php $i++;} ?>
</tbody>
</table>
</form>
</div>
</div>
</div>
</div>
</div>
<?php

$this->load->view("footer.php");
?>