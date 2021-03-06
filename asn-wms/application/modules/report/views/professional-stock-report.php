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
<h4 class="panel-title">PROFESSIONAL STOCK REPORT </h4>
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
<label class="col-sm-2 control-label">Model No.</label> 
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
<a href="<?=base_url('report/Report/export_professional_stock').'?p_name='.$_GET['p_name'].'&sku_no='.$_GET['sku_no'].'&filter='.$_GET['filter'];?>" class="dt-button buttons-excel buttons-html5" style="margin: 0px 30px 0px 0px;"><strong>Excel</strong></a>
</div>
</div>

<div class="dataTables_length" id="DataTables_Table_0_length" style="margin: 0px 0px 0px 30px;">
<label>Show
<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('/report/Report/searchProfessionalStock').'?p_name='.$_GET['p_name'].'&sku_no='.$_GET['sku_no'].'&filter='.$_GET['filter'];?>" class="form-control input-sm">
	<option value="10">10</option>
	<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
	<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
	<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
	<option value="500" <?=$entries=='500'?'selected':'';?>>500</option>
	<option value="<?=$dataConfig['total'];?>" <?=$entries==$dataConfig['total']?'selected':'';?>>ALL</option>
</select>
entries</label>

<div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite" style="    margin-top: -8px;margin-left: 12px;float: right;">
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
		<th><div style="width:65px;">PG Group</div></th>
		<th><div style="width:100px;">Category</div></th>
		<th><div style="width:100px;">Model NO.</div></th>
        <th><div style="width:150px;">Description 1</div></th>   
		<th><div style="width:150px;">Description 2</div></th>
		<th><div style="width:45px;">Block</div></th>
		<th><div style="width:45px;">Delhi</div></th>
		<th><div style="width:70px;">Bangalore</div></th>
		<th><div style="width:70px;">Del Pallet</div></th>
		<th><div style="width:50px;">Service</div></th>
		<th><div style="width:85px;">Sales Return</div></th>
		<th><div style="width:45px;">Total</div></th>
		<th><div style="width:70px;">MRP</div></th>
		<th><div style="width:140px;">Inventory Type Q1</div></th>
		<th><div style="width:100px;">Remarks</div></th>
</tr>
</thead>
<tbody id="getDataTable">
<?php
$yy=1;
foreach($result as $rows) {
?>
<tr class="gradeC record">
<th><?php echo $yy++; ?></th>
<th><?php echo $rows->pg_group; ?></th>
<th><?php
$sql1 = $this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='".$rows->category."' ");
$sql3 = $sql1->row();
echo $sql3->prodcatg_name; ?>
</th>
<th><?php echo $rows->sku_no; ?> </th>
<th><?php echo $rows->productname; ?></th>
<th><?php echo $rows->description2; ?></th>
<th><?php
$ttlblock=0;
$blockD=$this->db->query("select *,SUM(S.quantity) as sum_qty from tbl_product_serial S where S.product_id='".$rows->Product_id."' AND S.location_id='76' AND comp_id='1' ")->row();
$blockB=$this->db->query("select *,SUM(S.quantity) as sum_qty from tbl_product_serial S where S.product_id='".$rows->Product_id."' AND S.location_id='76' AND comp_id='3' ")->row();

echo $ttlblock = $blockD->sum_qty+$blockB->sum_qty;   ?>
</th>	

<th><?php 
$ttldelhi=0;
$delhi=$this->db->query("select *,SUM(S.quantity) as sum_qty from tbl_product_serial S where S.product_id='".$rows->Product_id."' AND S.location_id='54' AND comp_id='1' ")->row();

if($delhi->sum_qty!='')
  echo $ttldelhi = $delhi->sum_qty; 
else
  echo "0"; ?>
</th>

<th><?php 
$ttlbangalore=0;
$bangalore=$this->db->query("select *,SUM(S.quantity) as sum_qty from tbl_product_serial S where S.product_id='".$rows->Product_id."' AND S.location_id='54' AND S.main_location_id='3' ")->row();

if($bangalore->sum_qty!='')
  echo $ttlbangalore = $bangalore->sum_qty; 
else
  echo "0"; ?>
</th>

<th><?php
$ttldellpallet=0;
$dellPallet=$this->db->query("select *,SUM(S.quantity) as sum_qty from tbl_product_serial S where S.product_id='".$rows->Product_id."' AND S.location_id='55' AND comp_id='".$this->session->userdata('comp_id')."'  ")->row();

if($dellPallet->sum_qty!='')
  echo $ttldellpallet = $dellPallet->sum_qty; 
else
  echo "0"; ?>
</th>

<th><?php
$ttlservice=0;
$service=$this->db->query("select *,SUM(S.quantity) as sum_qty from tbl_product_serial S where S.product_id='".$rows->Product_id."' AND S.location_id='58' AND comp_id='".$this->session->userdata('comp_id')."'  ")->row();

// print_r($block);
if($service->sum_qty!='')
  echo $ttlservice = $service->sum_qty;
else
  echo "0";  ?>
</th>

<th><?php 
$ttl_sales_return=0;
$sales_return=$this->db->query("select *,SUM(S.quantity) as sum_qty from tbl_product_serial S where S.product_id='".$rows->Product_id."' AND S.location_id='57' AND comp_id='".$this->session->userdata('comp_id')."' ")->row();

// print_r($block);
if($sales_return->sum_qty!='')
  echo $ttl_sales_return = $sales_return->sum_qty;
else
  echo "0";  ?>
</th>

<th><?php echo $total = $ttlblock + $ttldelhi + $ttlbangalore + $ttldellpallet + $ttlservice + $ttl_sales_return ; ?></th>
<th><?php echo $rows->mrp; ?></th>
<th><?php echo $rows->inventoy_type; ?></th>
<th><?php ?></th>
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
