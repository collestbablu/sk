<?php
$this->load->view("header.php");
$tableName='tbl_product_stock';

?>
<script>


function getCid(pnm,pr,pp,unt)
{

	window.close();
	var pid=pnm.split("^");
	var pids=pid[1];
	window.opener.document.getElementById("prd").value=pnm;
	window.opener.document.getElementById("qn").value=1;
	window.opener.document.getElementById("lpr").innerHTML=pp;
	window.opener.document.getElementById("lph").value=pp;
	window.opener.document.getElementById("tot").value=pp;
	window.opener.document.getElementById("nettot").value=pp;
	window.opener.document.getElementById("pri_id").value=pids;
	window.opener.document.getElementById("usunit").value=unt;
	window.opener.document.getElementById("qn").focus();
	
	
}
</script>
<form action="insertstockreff" method="post">
	 <!-- Main content -->
	 <div class="main-content">
			
			<!-- Breadcrumb -->
			
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h4 class="panel-title">Product List</h4>
							<ul class="panel-tool-options"> 
								<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							</ul>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example1" >
<thead>
<tr>
	   <th style="display:none">&nbsp;</th>
	   <th>Product Code </th>
	<th>Product Name</th>
    <th>Invoice Qty</th>
      	<th>Location</th>
        <th>Rack</th>
        <th>Qty In Stock</th>
        <th>Remaining Qty</th>
        <th>Enter Qty</th>
		 
</tr>
</thead>

<tbody>
<?php
$z=1;
$query_dtl=$this->db->query("select * from tbl_stock_in_dtl where stockinhdr='".$_GET['id']."' or stockinhdr='".$_GET['view']."' ");
foreach($query_dtl->result() as $invoiceFetch)
{

$productQuery=$this->db->query("select *from tbl_product_stock where Product_id='$invoiceFetch->product_id'");
$getProductName=$productQuery->row();

?>
<tr class="gradeC record">
<td style="display:none"><input type="checkbox" id="" name="product_id[]" value="<?php echo $getProductName->Product_id; ?>" checked="checked" style="display:none;" /></td>
<th><?=$getProductName->sku_no;?></th>

<input type="hidden" name="inbound_id" value="<?=$_GET['id'];?>" />
<th><?=$getProductName->productname;?></th>
<th><?=$invoiceFetch->quantity;?></th>

<input type="hidden" id="pid<?=$z;?>" value="<?=$getProductName->Product_id;?>" />

<th><select name="location_id[]" id="location_rack_id<?=$z;?>" onchange="getRackFun(this.id);"  class="form-control ui fluid search dropdown email"  <?php if(@$_GET['view']!=''){ ?> disabled="disabled" <?php }?> >
    <option value="">----Select ----</option>
    <?php
	$bookingType=$this->db->query("select *from tbl_master_data  where param_id='29'");
	foreach($bookingType->result() as $getBooking){
	?>
   <option value="<?=$getBooking->serial_number;?>" <?php if($getBooking->serial_number==$branchFetch->location_rack_id){?> selected <?php }?>><?=$getBooking->keyvalue;?></option>
   <?php }?>
  </select></th>
<th><select name="rack_id[]" class="form-control" id="rack_id<?=$z;?>" onchange="getQty(this.id)"   >
    <option value="">----Select ----</option>
  
  </select></th>
<th><p id="getQn<?=$z;?>"></p></th>

<?php

$queryInbondQtyCnt=$this->db->query("select * from tbl_product_serial_log where product_id='$getProductName->Product_id' and inbound_id='".$_GET['id']."'");


$queryInbondQty=$this->db->query("select SUM(quantity) as qtySum from tbl_product_serial_log where product_id='$getProductName->Product_id' and inbound_id='".$_GET['id']."'");

$getInbundQty=$queryInbondQty->row();
 $getInbundQtyCnt=$queryInbondQtyCnt->num_rows();
if($getInbundQtyCnt>0)
{
$LogSum=$invoiceFetch->quantity-$getInbundQty->qtySum;
}
else
{
	$LogSum=$invoiceFetch->quantity;
}
?>

<th><input type="number" readonly="readonly" step="any" name="rem_quantity" value="<?=$LogSum;?>" id="rem_qty<?=$z;?>" class="form-control" style="width:150px;" /></th>

<th><input type="number" step="any" name="new_quantity[]" onchange="checkQtyVal(this.id);" id="new_qty<?=$z;?>" class="form-control" style="width:150px;" /></th>
</tr>
<?php $z++;}?>

<tr >
<td >&nbsp;</td>
<th>&nbsp;</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
<th><input class="btn btn-primary" name="save"  type="submit" value="Stock In" /></th>
<th><a href="" onclick="popupclose(this.value)"  title="Cancel" class="btn btn-blue"> Cancel</a></th>
</tr>
</tbody>
</table>
</form>
</div>
</div>
</div>
</div>
</div>
<script>
function getRackFun(v) {
	
	var zz=document.getElementById(v).id;
//alert(zz);
	var myarra = zz.split("location_rack_id");

	var asx= myarra[1];

	//alert(asx);

	var pri=document.getElementById("location_rack_id"+asx).value;
	
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "getRack?location_rack_id="+pri, false);
  xhttp.send();
  document.getElementById("rack_id"+asx).innerHTML = xhttp.responseText;
  //alert(xhttp.responseText);
  
}
</script>

<script>
function getQty(v) {
	
	var zz=document.getElementById(v).id;
//alert(zz);
	var myarra = zz.split("rack_id");

	var asx= myarra[1];

	

	var pri=document.getElementById("rack_id"+asx).value;
	var pId=document.getElementById("pid"+asx).value;
 
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "getRackQty?location_rack_id="+pri+"&pid="+pId, false);
  xhttp.send();
  document.getElementById("getQn"+asx).innerHTML = xhttp.responseText;
  //alert(xhttp.responseText);
  
}




function checkQtyVal(v) {
	
	var zz=document.getElementById(v).id;
//alert(zz);
	var myarra = zz.split("new_qty");

	var asx= myarra[1];

	


	var rack_id=document.getElementById("rack_id"+asx).value;
	var location_rack_id=document.getElementById("location_rack_id"+asx).value;
	
	var pri=document.getElementById("new_qty"+asx).value;
	
	var pId=document.getElementById("rem_qty"+asx).value;

if(pri!='')
{
if(location_rack_id=='')
{
alert("Please Select Location");
	document.getElementById("location_rack_id"+asx).focus();
}

if(rack_id=='')
{
alert("Please Select Rack");
document.getElementById("rack_id"+asx).focus();
}
	
}
	if(Number(pId)<Number(pri))
	{
	alert("Please enter less then remaining Qty");
		document.getElementById("new_qty"+asx).focus();
	}
}




</script>

<?php

$this->load->view("footer.php");
?>