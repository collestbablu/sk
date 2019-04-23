<?php
$this->load->view("header.php");
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
<h4 class="panel-title">TOTAL PRODUCT STOCK REPORT </h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
</ul>
</div>
<div class="panel-body">
<form class="form-horizontal" method="post" action="totalsearchStock">
<div class="form-group panel-body-to"> 
<label class="col-sm-2 control-label">Product Name</label> 
<div class="col-sm-3"> 
<input type="text" name="p_name" class="form-control" value="" />
</div>
<label class="col-sm-2 control-label">Sku No</label> 
<div class="col-sm-3"> 
<input type="text" name="sku_no" class="form-control" value="" /> 
</div>
<label class="col-sm-2 control-label"><button type="submit" name="Show" class="btn btn-info btn-sm" value="Show">Show</button></label>  
</div>
</form>
</div>

<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<tr>
 		<th>Serial No.</th>
		<th>Model No</th>
        <th>Product Name</th>   
		<th>Category</th>
		<th>Main Location</th>
		<th>Location</th>
		<th>Rack</th>
		<th>Qty In Stock</th>
</tr>
</thead>
<tbody>
<?php
$yy=1;
if(!empty($totalSearchStock)) {
foreach($totalSearchStock as $rows) {
?>
<tr class="gradeC record">
<th><?php echo $yy++; ?></th>
<th><?php 
	$proQ1=$this->db->query("select * from tbl_product_stock where Product_id='$rows->product_id'");
		$fProQ12=$proQ1->row();
echo $fProQ12->sku_no; ?></th>
<th><?php echo $fProQ12->productname; ?></th>
<th><?php
$sql1 = $this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='".$fProQ12->category."' ");
			$sql3 = $sql1->row();
			echo $sql3->prodcatg_name; 
		?></th>
<th>
<?php 
	$proQ2=$this->db->query("select * from tbl_location where id='$rows->main_location_id'");
		$fProQ11=$proQ2->row();
echo $fProQ11->location_name;?>
</th>	
<th><?php 
	$proQ122=$this->db->query("select * from tbl_master_data where serial_number='$rows->location_id'");
		$fProQ121=$proQ122->row();
	echo $fProQ121->keyvalue;?></th>	
<th><?php 
	$proQ112=$this->db->query("select * from tbl_location_rack where id='$rows->rack_id'");
		$fProQ111=$proQ112->row();
	echo $fProQ111->rack_name;?></th>
<th><?php echo $rows->quantity; ?></th>
</tr>
<?php } } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<?php
$this->load->view("footer.php");
?>