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
<h4 class="panel-title">TRANSACTION REPORT </h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
</ul>
</div>
<div class="panel-body">
<form class="form-horizontal panel-body-to" method="get">

<div class="form-group"> 
<label class="col-sm-2 control-label">Location</label> 
<div class="col-sm-3"> 
<select name="location" class="form-control">
<option value="">--Select--</option>
<?php
$masterData=$this->db->query("select *from tbl_master_data where param_id='29'");
foreach($masterData->result() as $getData){
?>
<option value="<?=$getData->serial_number;?>"><?=$getData->keyvalue;?></option>
<?php }?>
</select>
</div>
<label class="col-sm-2 control-label">Product Code</label> 
<div class="col-sm-3"> 
<input type="text" name="sku_no" class="form-control" value="" /> 
</div>
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">From Date</label> 
<div class="col-sm-3"> 
<input type="date" name="f_date" class="form-control"/> 
</div>
<label class="col-sm-2 control-label">To Date</label> 
<div class="col-sm-3"> 
<input type="date" name="t_date" class="form-control" /> 
</div>
<label class="col-sm-2 control-label"><button type="submit" name="filter" value="filter" class="btn btn-info">Search</button></label>  
</div>

</form>
</div>

<div class="row">
<div class="col-sm-12">
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
<div class="html5buttons">
<div class="dt-buttons">
<button class="dt-button buttons-excel buttons-html5" onclick="exportTableToExcel('tblData')">Excel</button>
<a class="dt-button buttons-excel buttons-html5" style="display:none" tabindex="0" aria-controls="DataTables_Table_0" onclick="exportTableToExcel('tblData')"><span>Excel</span></a>
</div>
</div>

<div class="dataTables_length" id="DataTables_Table_0_length">
<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Show
<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('/report/Report/searchDelhiStock');?>" class="form-control input-sm">
	<option value="10">10</option>
	<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
	<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
	<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
	<option value="500" <?=$entries=='500'?'selected':'';?>>500</option>
	<option value="1000" <?=$entries=='1000'?'selected':'';?>>1000</option>
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
		<th><div style="width:70px;">Date</div></th>
        <th><div style="width:110px;">Original Invoice Received Time</div></th>   
		<th><div style="width:150px;">Customer</div></th>
		<th><div style="width:115px;">From Location</div></th>
		<th><div style="width:75px;">Type</div></th>
		<th><div style="width:80px;">Order No</div></th>
		<th><div style="width:100px;">Invoice No.</div></th>
		<th><div style="width:100px;">To Location</div></th>
		<th><div style="width:100px;">Product Code</div></th>
		<th><div style="width:100px;">Qty Receipt</div></th>
		<th><div style="width:120px;">Qty Dispatched</div></th>
		<th><div style="width:100px;">Availability</div></th>
		<th><div style="width:190px;">Description-1</div></th>
		<th><div style="width:190px;">Description-2</div></th>
		<th><div style="width:100px;">Total Pcs</div></th>
		<th><div style="width:115px;">Warehouse Remarks</div></th>
</tr>
</thead>
<tbody id="getDataTable">
<?php
$yy=1;

foreach($result as $rows) {

$dtl=$this->db->query("select * from tbl_stock_out_dtl where product_id='$rows->product_id' AND stockouthdr = '$rows->inbound_id '");
$getDtl=$dtl->row();

$hdr=$this->db->query("select * from tbl_stock_out_hdr where stockoutid='$getDtl->stockouthdr'");
$getHdr=$hdr->row();

$stock=$this->db->query("select * from tbl_product_stock where Product_id='$rows->product_id'");
$getStock=$stock->row();
?>
<tr class="gradeC record">
<th><?php echo $yy++; ?></th>

<th><?php echo $rows->maker_date; ?></th>

<th><?php echo $getHdr->original_inv_rec_time; ?></th>
<th><?php
		$sql1 = $this->db->query("select * from tbl_contact_m where contact_id='$getHdr->contact_id' ");
		$sql2 = $sql1->row();
		echo $sql2->first_name;	?>
</th>
<th><?php
		$org=$this->db->query("select * from tbl_stock_in_dtl where product_id='$rows->product_id'");
		$org1=$org->row();
		
		$org2=$this->db->query("select * from tbl_stock_in_hdr where stockinid='$org1->stockinhdr'");
		$org3=$org2->row();
		
		$org4=$this->db->query("select * from tbl_master_data where serial_number='$org3->origin' ");
		$org5=$org4->row();
		
		$proQ1=$this->db->query("select * from tbl_master_data where serial_number='$getHdr->type'");
		$fProQ12=$proQ1->row();
		
		
		if($fProQ12->keyvalue!='')
		{
		//echo $org5->keyvalue;
		
		}?> 
</th>
<th><?php
		$proQ1=$this->db->query("select * from tbl_master_data where serial_number='$getHdr->type'");
		$fProQ12=$proQ1->row();
		if($fProQ12->keyvalue=='')
		{
		echo "Stock In";	
		}
		else
		{
 		echo $fProQ12->keyvalue;
		}
		 ?>
</th>	
<th><?php echo $getHdr->order_no;?></th>	
<th><?php echo $getHdr->invoice_no;?></th>

<th><?php
if($rows->type=='Inbound-mul' or $rows->type=='Inbound')
{
	$hdrQueryStockIn=$this->db->query("select *from tbl_stock_in_hdr where stockinid='$rows->inbound_id'");
	$getStockIn=$hdrQueryStockIn->row();
	
		$bookingTypeQuery=$this->db->query("select *from tbl_contact_m where contact_id='$getStockIn->location_to'");
		$getBookingType=$bookingTypeQuery->row();
		echo $getBookingType->city; 
}
else
{
	
	$hdrQueryStockInn=$this->db->query("select *from tbl_stock_out_hdr where stockoutid='$rows->inbound_id'");
	$getStockInn=$hdrQueryStockInn->row();
	//echo "select *from tbl_contact_m where contact_id='$getStockInn->location_to'";
		$bookingTypeQueryy=$this->db->query("select *from tbl_contact_m where contact_id='$getStockInn->location_to'");
		$getBookingTypee=$bookingTypeQueryy->row();
		echo $getBookingTypee->city; 
}
		?>
</th>

<th><?php echo $getStock->sku_no;  ?></th>
<th><?php 	 
	    $qtyin=$this->db->query("select * from tbl_stock_in_dtl where product_id='$rows->product_id'");
		$qtyindtl=$qtyin->row();
		
		if($fProQ12->keyvalue=='Inbound' or $fProQ12->keyvalue=='Inbound-mul' )
		{
		
 		echo $rows->quantity;  
        }
        else{}
        //echo $rows->quantity;   ?>
</th>
<th><?php	

 		if($fProQ12->keyvalue=='STNOUT' or $fProQ12->keyvalue=='Outbound' or $fProQ12->keyvalue=='STNOUT' or $fProQ12->keyvalue=='Invoice')
		{
		
 		echo $rows->quantity;  
        }
        else{}
		?>
</th>
<th><?php 
 		$avalty= $qtyindtl->quantity - $qtyoutdtl->quantity; 
		//echo $avalty; 	?>
</th>

<th><?php echo $getStock->productname; ?></th>
<th><?php echo $getStock->description2; ?></th>
<th><?php   ?></th>
<th><?php 
 		$dest=$this->db->query("select * from tbl_return_dtl where product_id='$rows->product_id'");
		$dest1=$dest->row();
		$dest3=$this->db->query("select * from tbl_return_hdr where returnid='$dest1->returnhdr'");
		$dest4=$dest3->row();
	 echo $dest4->wh_remarks; ?></th>
</tr>
<?php }  ?>
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
<script>

function exportTableToExcel(tableID, filename = ''){
 
 	//alert();
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'TransactionReport_<?php echo date('d-m-Y');?>.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{

        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>