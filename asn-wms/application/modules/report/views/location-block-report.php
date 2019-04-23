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
<h4 class="panel-title">LOCATION BLOCK REPORT </h4>
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
<a href="<?=base_url('report/Report/export_location_block').'?p_name='.$_GET['p_name'].'&sku_no='.$_GET['sku_no'].'&filter='.$_GET['filter'];?>" class="dt-button buttons-excel buttons-html5" style="margin: 0px 30px 0px 0px;"><strong>Excel</strong></a>
</div>
</div>

<div class="dataTables_length" id="DataTables_Table_0_length" style="margin: 0px 0px 0px 30px;">
<label> Show
<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('/report/Report/searchLocationBlock').'?p_name='.$_GET['p_name'].'&sku_no='.$_GET['sku_no'].'&filter='.$_GET['filter'];?>" class="form-control input-sm">
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
		<th><div style="width:80px;">Model No</div></th>
        <th><div style="width:130px;">Product Name</div></th>   
		<th><div style="width:100px;">Category</div></th>
		<th><div style="width:65px;">PG Group</div></th>
		<th><div style="width:100px;">Main Location</div></th>
		<th><div style="width:70px;">Location</div></th>
		<th><div style="width:70px;">Rack</div></th>
		<th><div style="width:85px;">Qty In Stock</div></th>
		<th><div style="width:80px;">MRP</div></th>
</tr>
</thead>
<tbody id="getDataTable">
<?php
$yy=1;

foreach($result as $rows) {
?>
<tr class="gradeC record">

<th><?php echo $yy++; ?></th>

<th><?php 
		$proQ1=$this->db->query("select * from tbl_product_stock where Product_id='$rows->product_id'");
		$fProQ12=$proQ1->row();
	echo $fProQ12->sku_no; ?>
</th>

<th><?php echo $fProQ12->productname; ?></th>

<th><?php
		$sql1 = $this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='".$fProQ12->category."' ");
		$sql3 = $sql1->row();
	echo $sql3->prodcatg_name; 	?>
</th>

<th><?php 
		$fetchQ2=$this->db->query("select *from tbl_product_stock where Product_id='$rows->product_id'");
		$fetchQ3=$fetchQ2->row();
	echo $fetchQ3->pg_group; ?>
</th>

<th><?php 
		$proQ2=$this->db->query("select * from tbl_location where id='$rows->main_location_id'");
		$fProQ11=$proQ2->row();
	echo $fProQ11->location_name;?>
</th>	

<th><?php 
		$proQ122=$this->db->query("select * from tbl_master_data where serial_number='$rows->location_id'");
		$fProQ121=$proQ122->row();
	echo $fProQ121->keyvalue; ?>
</th>	

<th><?php 
		$proQ112=$this->db->query("select * from tbl_location_rack where id='$rows->rack_id'");
		$fProQ111=$proQ112->row();
	echo $fProQ111->rack_name;?>
</th>

<th><?php echo $rows->quantity; ?></th>

<th><?php echo $fetchQ3->mrp; ?></th>
</tr>
<?php } ?>
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
