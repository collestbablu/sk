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

<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
<h4 class="panel-title">Demo Return</h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
</ul>
</div>
<div class="panel-body">
<form class="form-horizontal panel-body-to" method="get">
<div class="form-group"> 
<label class="col-sm-2 control-label">RGP Gatepass No.</label> 
<div class="col-sm-3"> 
<input type="text" name="rgp_gatepass_no" class="form-control" value="" />
</div>
<label class="col-sm-2 control-label">Manual Gate Pass No.</label> 
<div class="col-sm-3"> 
<input type="text" name="manual_gate_pass_no" value="<?php echo $branchFetch->rgp_gatepass_no; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div>  
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">RESPONSIBILITY</label> 
<div class="col-sm-3"> 
<input type="text" name="responsibility" value="<?php echo $branchFetch->manual_gate_pass_no; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div>
<label class="col-sm-2 control-label">Gatepass Issued Name</label> 
<div class="col-sm-3"> 
<input type="text" name="gatepass_issued_name" value="<?php echo $branchFetch->gatepass_issued_name; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div>  
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">From Date</label> 
<div class="col-sm-3"> 
<input type="date" name="f_date" class="form-control" value="" /> 
</div>
<label class="col-sm-2 control-label">To Date</label> 
<div class="col-sm-3"> 
<input type="date" name="t_date" class="form-control" value="" /> 
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
<a href="<?=base_url('salesDemoReturn/export_demo_return').'?rgp_gatepass_no='.$_GET['rgp_gatepass_no'].'&manual_gate_pass_no='.$_GET['manual_gate_pass_no'].'&responsibility='.$_GET['responsibility'].'&gatepass_issued_name='.$_GET['gatepass_issued_name'].'&f_date='.$_GET['f_date'].'&t_date='.$_GET['t_date'].'&filter='.$_GET['filter'];?>" class="dt-button buttons-excel buttons-html5" style="margin: 0px 30px 0px 0px;"><strong>Excel</strong></a>
</div>
</div>

<div class="dataTables_length" id="DataTables_Table_0_length" style="margin: 0px 0px 0px 30px;">
<label> Show
<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('/salesDemoReturn/demo_return').'?rgp_gatepass_no='.$_GET['rgp_gatepass_no'].'&manual_gate_pass_no='.$_GET['manual_gate_pass_no'].'&responsibility='.$_GET['responsibility'].'&gatepass_issued_name='.$_GET['gatepass_issued_name'].'&f_date='.$_GET['f_date'].'&t_date='.$_GET['t_date'].'&filter='.$_GET['filter'];?>" class="form-control input-sm">
	<option value="10">10</option>
	<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
	<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
	<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
	<option value="500" <?=$entries=='500'?'selected':'';?>>500</option>
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
 		<th><div style="width:75px;">Serial No.</div></th>
	    <th><div style="width:110px;">Responsibility</div></th>
        <th><div style="width:165px;">Gatepass Issued Name</div></th>
        <th><div style="width:140px;">RGP Gatepass Date</div></th>
        <th><div style="width:125px;">Return Due Date</div></th>
		<th><div style="width:140px;">RGP Gatepass No.</div></th>
		<th><div style="width:165px;">Manual Gate Pass No.</div></th>
      	<th><div style="width:175px;">Manual Gate Pass Date</div></th>
		<th><div style="width:120px;">Tenure  (in Days)</div></th>
        <th>Action</th>
</tr>
</thead>
<tbody id="getDataTable">
<?php
@extract($_POST);

/*
if($Show!='')
{
	
  $select_query="select *from tbl_return_hdr where return_type='Demo'";

    if($rgp_gatepass_no!='')
		{				

			 $select_query.=" and rgp_gatepass_no like '%$rgp_gatepass_no%'";	  
		}
		if($manual_gate_pass_no!='')
		{				
			$select_query.=" and manual_gate_pass_no like '%$manual_gate_pass_no%'";	  
		}
		
		if($gatepass_issued_name!='')
		{				
			$select_query.=" and gatepass_issued_name like '%$gatepass_issued_name%'";	  
		}
		if($responsibility!='')
		{				
			$select_query.=" and responsibility like '%$responsibility%'";	  
		}
		if($fdate!='' && $tdate!='')
		{
		
		 $tdate=explode("-",$tdate);
			
			$fdate=explode("-",$fdate);

			$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
	        $fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
			echo $queryy .=" and return_due_date >=$fdate1 and return_due_date <=$todate1";
		}
		
	}else{
			 $select_query = "Select * from tbl_return_hdr where return_type='Demo'";	
		}
	$query = $this->db->query($select_query);
	
*/	

//foreach($query->result() as $rows) {

foreach($result as $rows) {
	
	$returnDtlQ=$this->db->query("select *from tbl_return_dtl where returnhdr='$rows->returnid'");
	$getDtl=$returnDtlQ->num_rows();
	
	$returnSerQ=$this->db->query("select *from tbl_product_serial_log where inbound_id='$rows->returnid' and type='Demo Return'");
	$getSer=$returnSerQ->num_rows();
	
?>
<tr class="gradeC record" <?php if($getDtl==$getSer){?> style="display:none" <?php }?>>
<th><?php echo $rows->returnid;?></th>
<th><?php
	$resQuery=$this->db->query("select *from tbl_contact_m where contact_id='$rows->responsibility'");
	$getRes=$resQuery->row();
    echo $getRes->first_name;?>
</th>

<th><?php echo $rows->gatepass_issued_name;?></th>
<th><?php echo $rows->rgp_gate_pass_date;?></th>
<th><?php echo $rows->return_due_date;?></th>

<th><?=$rows->rgp_gatepass_no;?></th>
<th><?=$rows->manual_gate_pass_no;?></th>
<th><?=$rows->manual_gp_date;?></th>

<th><?php
$todays=date('Y-m-d');
$date1=date_create($todays);
$date2=date_create($rows->return_due_date);
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
</b></th>
<th>
<?php
if($rows->status=='return')
{
	echo "Return";
}
else
{
?>
<a  href="#" onClick="openpopup('<?=base_url();?>salesDemoReturn/stockIn?id',1200,500,'id',<?=$rows->returnid;?>)">Stock In<?=$getSer->quantity;?></a>
<?php  }?>
</th>
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
