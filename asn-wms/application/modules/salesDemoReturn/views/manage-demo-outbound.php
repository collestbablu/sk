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
	<li><a class="btn btn-success btn-sm" href="<?=base_url();?>salesDemoReturn/addDemoOutBound">Add Demo Outbound</a></li> 
	<?php }?>
</ol>

<ol class="breadcrumb breadcrumb-2"> 
	<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
	<li><a href="#">Demo Return</a></li> 
	<li class="active"><strong><a href="#">Manage Demo Outbound</a></strong></li> 
</ol>
	
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
	<h4 class="panel-title"><strong>Demo Outbound</strong></h4>
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
<a href="<?=base_url('salesDemoReturn/export_demo_outbound').'?returnid='.$_GET['returnid'].'&respblty='.$_GET['respblty'].'&g_p_date='.$_GET['g_p_date'].'&rt_due_date='.$_GET['rt_due_date'].'&g_p_no='.$_GET['g_p_no'].'&m_g_p_no='.$_GET['m_g_p_no'].'&m_g_p_date='.$_GET['m_g_p_date'].'&filter='.$_GET['filter'];?>" class="dt-button buttons-excel buttons-html5" style="margin: 0px 30px 0px 0px;"><strong>Excel</strong></a>
</div>
</div>

<div class="dataTables_length" id="DataTables_Table_0_length" style="margin: 0px 0px 0px 30px;">
<label>Show
<select name="DataTables_Table_0_length" url="<?=base_url('salesDemoReturn/manageDemoOutbound').'?returnid='.$_GET['returnid'].'&respblty='.$_GET['respblty'].'&g_p_date='.$_GET['g_p_date'].'&rt_due_date='.$_GET['rt_due_date'].'&g_p_no='.$_GET['g_p_no'].'&m_g_p_no='.$_GET['m_g_p_no'].'&m_g_p_date='.$_GET['m_g_p_date'].'&filter='.$_GET['filter'];?>" aria-controls="DataTables_Table_0" id="entries" class="form-control input-sm">
	<option value="10" <?=$entries=='10'?'selected':'';?>>10</option>
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
	   <th style="display:none">Check</th>
       <th><div style="width:80px;">Serial No.</div></th>
	   <th><div style="width:105px;">Responsibility</div></th>
       <th><div style="width:140px;">RGP Gatepass Date</div></th>
       <th><div style="width:125px;">Return Due Date</div></th>
	   <th><div style="width:155px;">RGP Gatepass No.</div></th>
	   <th><div style="width:165px;">Manual Gate Pass No.</div></th>
       <th><div style="width:170px;">Manual Gatepass Date</div></th>
	   <th><div style="width:80px;">Type</div></th>
       <th><div style="width:125px;">Tenure (in Days)</div></th>
       <th><div style="width:80px;">Status</div></th>
       <th><div style="width:130px;">Action</div></th>
</tr>
</thead>

<tbody id="getDataTable">
<form method="get">
<tr>
	<td><input name="returnid"  type="text"  class="form-control"  value="" /></td>
	<td><input name="respblty"  type="text"  class="form-control"  value="" /></td>
	<td><input name="g_p_date"  type="date"  class="form-control"  value="" /></td>
	<td><input name="rt_due_date"  type="date"  class="form-control"  value="" /></td>
	<td><input name="g_p_no"  type="text"  class="form-control"  value="" /></td>
	<td><input name="m_g_p_no"  type="text"  class="form-control"  value="" /></td>
	<td><input name="m_g_p_date"  type="date"  class="form-control"  value="" /></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
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

<th><?php echo $sales->returnid;?></th>
<th>
<?php
$contactQuery=$this->db->query("select *from tbl_contact_m where contact_id='$sales->responsibility'");
$getContact=$contactQuery->row();

echo $getContact->first_name;?>
</th>

<th><?php echo $sales->rgp_gate_pass_date;?></th>

<th><?php echo $sales->return_due_date;?></th>

<?php
/*
//echo "select *from tbl_master_data where serial_number='$sales->booking_type'";
$bookingTypeQuery=$this->db->query("select *from tbl_contact_m where contact_id='$sales->contact_id'");
$getBookingType=$bookingTypeQuery->row();
*/
?>

<th><?=$sales->rgp_gatepass_no;?></th>

<th><?=$sales->manual_gate_pass_no;?></th>

<th><?=$sales->manual_gp_date;?></th>

<th><?php echo $sales->return_type; ?></th>

<th>
<b style="color:#0F0">
<?php
$todays=date('Y-m-d');
$date1=date_create($todays);
$date2=date_create($sales->return_due_date);
$diff=date_diff($date1,$date2);
if($date1<=$date2)
{
	?>
     <b style="color:#0F0;">
    <?php
echo $diff->format("%a days");
}

else
{
	?>
    <b style="color:#F00;">
    <?php
echo $diff->format("%a days");	
}
?>

</th>
<th><?php echo $sales->mail_send_status;?></th>
<th style="width:450px;">
<a href="#" onClick="openpopup('<?=base_url();?>salesDemoReturn/edit_demo_outbound_order',1400,600,'view',<?=$sales->returnid;?>)"><i class="glyphicon glyphicon-zoom-in"></i>
</a>&nbsp;&nbsp;&nbsp;<a href="#" onClick="openpopup('<?=base_url();?>salesDemoReturn/edit_demo_outbound_order',1400,600,'id',<?=$sales->returnid;?>)"><i class="glyphicon glyphicon-pencil"></i>
<?php
$pri_col='returnid';
$table_name='tbl_return_hdr';

$pri_col_dtl='returnhdr';
$table_name_dtl='tbl_return_dtl';
	?>
	&nbsp;&nbsp;&nbsp;<a href="#" id="<?php echo $sales->returnid."^".$table_name."^".$pri_col."^".$table_name_dtl."^".$returnhdr ; ?>" class="delbuttonPurchase icon"><i class="glyphicon glyphicon-remove"></i></a> 

&nbsp;
<a href="print_gatepass?id=<?php echo $sales->returnid;?>" target="_blank"><img src="<?=base_url();?>assets/images/print.png" /></a>
<a href="send_res_mail?id=<?php echo $sales->returnid;?>" onclick="return confirm('Do you want to send mail?');"><img src="<?=base_url();?>assets/images/mail.png" /></a>
<br />
<a href="send_remainder_mail?id=<?php echo $sales->responsibility;?>">Send Reminder</a>
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
