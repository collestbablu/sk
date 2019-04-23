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
<h4 class="panel-title">LOCATION RGP REPORT </h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
</ul>
</div>
<div class="panel-body">
<form class="form-horizontal" method="get">
<div class="form-group panel-body-to"> 
<label class="col-sm-2 control-label">Product Name</label> 
<div class="col-sm-3"> 
<input type="text" name="p_name" class="form-control" value="" />
</div>
<label class="col-sm-2 control-label">Model No</label> 
<div class="col-sm-3"> 
<input type="text" name="sku_no" class="form-control" value="" /> 
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
<a href="<?=base_url('report/Report/export_location_rgp').'?p_name='.$_GET['p_name'].'&sku_no='.$_GET['sku_no'].'&filter='.$_GET['filter'];?>" class="dt-button buttons-excel buttons-html5" style="margin: 0px 30px 0px 0px;"><strong>Excel</strong></a>
</div>
</div>

<div class="dataTables_length" id="DataTables_Table_0_length" style="margin: 0px 0px 0px 30px;">
<label> Show
<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('/report/Report/searchLocationRgp').'?p_name='.$_GET['p_name'].'&sku_no='.$_GET['sku_no'].'&filter='.$_GET['filter'];?>" class="form-control input-sm">
	<option value="10">10</option>
	<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
	<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
	<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
	<option value="500" <?=$entries=='500'?'selected':'';?>>500</option>
	<option value="<?=$dataConfig['total'];?>" <?=$entries==$dataConfig['total']?'selected':'';?>>ALL</option>
</select>
entries</label>

<div style="display:none;" class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite" style="margin-top: -6px;margin-left: 12px;float: right;">
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
        <th><div style="width:80px;">Serial No.</div></th>
        <th><div style="width:140px;">RGP Gatepass Date</div></th>
		<th><div style="width:120px;">Current Date</div></th>
        <th><div style="width:130px;">Return Due Date</div></th>
        <th><div style="width:120px;">Tenure(in Days)</div></th>
        <th><div style="width:170px;">RGP Gatepass No.</div></th>
        <th><div style="width:170px;">Manual Gate Pass No.</div></th>
        <th><div style="width:180px;">Manual Gate Pass Date</div></th>
        <th><div style="width:100px;">PG Group</div></th>
        <th><div style="width:100px;">Category</div></th>
        <th><div style="width:100px;">Model No.</div></th>
        <th><div style="width:170px;">Description</div></th>
        <th><div style="width:100px;">Qty</div></th>
        <th><div style="width:100px;">Location</div></th>
        <th><div style="width:170px;">Stock Position</div></th>
        <th><div style="width:165px;">Gatepass Issued Name</div></th>
        <th><div style="width:125px;">Responsibility</div></th>
        <th><div style="width:100px;">Remark 1</div></th>
        <th><div style="width:100px;">Remark 2</div></th>
        <th><div style="width:100px;">W/H Remarks</div></th>
        <th><div style="width:125px;">Inventory Type</div></th>
      </tr>
</thead>
<tbody id="getDataTable">

<?php
$yy=1;

foreach($result as $rows) {


$getLog = $this->db->query("Select product_id,inbound_id,type,quantity from tbl_product_serial_log where type = 'Demo Return' and product_id='$rows->product_id' and inbound_id='$rows->returnhdr' ");


//$getLog = $this->db->query("Select product_id,inbound_id,type from tbl_product_serial_log where type = 'Demo Return' and product_id='$rows->product_id' and inbound_id='$rows->returnhdr' ");
$logdata = $getLog->row();
//echo $logdata->sqty;

//$logdata->product_id



 if(@$logdata->product_id == @$rows->product_id && @$logdata->inbound_id == @$rows->returnhdr && @$logdata->quantity==@$rows->quantity  ) 
 {

 }

 else
 {

$today=date('Y-m-d');

?>

  <tr class="gradeC record" >
	<th><?php echo $yy++; ?></th>
	<th><?php 
		$dtlhdr=$this->db->query("select * from tbl_return_hdr where returnid='$rows->returnhdr'");
		$alldtlhdr=$dtlhdr->row();
	echo $alldtlhdr->rgp_gate_pass_date;?></th>
	<th><?php echo $today;?></th>
	<th><?php echo $alldtlhdr->return_due_date;?></th>
	<th> <b style="color:#0F0">
	  <?php
	$todays=date('Y-m-d');
	$date1=date_create($todays);
	$date2=date_create($alldtlhdr->return_due_date);
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
	</b></b></b></th>
	<th><?=$alldtlhdr->rgp_gatepass_no;?></th>
	<th><?=$alldtlhdr->manual_gate_pass_no;?></th>
	<th><?=$alldtlhdr->manual_gp_date;?></th>
	<th><?php
		//$pro1=$this->db->query("select * from tbl_return_dtl where returnhdr='$rows->returnid'");
		//$fPro2=$pro1->row();
		$proQ1=$this->db->query("select * from tbl_product_stock where Product_id='$rows->product_id'");
		$fProQ12=$proQ1->row();		
	 echo $fProQ12->pg_group; ?>		
	</th>
	<th><?php 	
		$sql1 = $this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='".$fProQ12->category."' ");
		$sql3 = $sql1->row();
		echo $sql3->prodcatg_name; ?>        </th>
	<th><?php echo $fProQ12->sku_no; ?></th>
	<th><?php echo $fProQ12->productname; ?></th>
	<th><?php echo $logdata->quantity; ?></th>
	<th><?php 
		$proQ122=$this->db->query("select * from tbl_master_data where serial_number='$rows->loc'");
		$fProQ121=$proQ122->row();
	echo $fProQ121->keyvalue; ?> 
	</th>
	<th><?php 
		$ctnm=$this->db->query("select * from tbl_contact_m where code='$alldtlhdr->stock_position'");
		$ctnmdtl=$ctnm->row(); ?>
	   <?php if($ctnmdtl->code!=''){ echo $ctnmdtl->first_name ." - ". $ctnmdtl->city; } else { }?>
	</th>
	<th><?php echo $alldtlhdr->gatepass_issued_name;?></th>
	<th> <?php
		$contactQuery=$this->db->query("select *from tbl_contact_m where contact_id='$alldtlhdr->responsibility'");
		$getContact=$contactQuery->row();
	 echo $getContact->first_name;?> </th>
	<th><?php echo $alldtlhdr->remarks1;?></th>
	<th><?php echo $alldtlhdr->remarks2;?></th>
	<th><?php echo $alldtlhdr->wh_remarks;?></th>
	<th><?php echo $fProQ12->inventoy_type; ?></th>
  </tr>
  <?php } } ?>
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
