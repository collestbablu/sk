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
<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
<li><a href="#">Adjustment</a></li> 
<li class="active"><strong><a href="#">Manage Adjustment</a></strong></li>

<div class="pull-right">
<?php 
		if($add!='')
{ ?>
<a class="btn btn-success btn-sm" href="<?=base_url();?>stockAdj/add_stock_adj">Add Adjustment</a>
<?php }?>
</div> 
</ol>
			
<div class="row">
<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading clearfix">
			<h4 class="panel-title"><strong>Adjustment</strong></h4>
			<ul class="panel-tool-options"> 
				<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
			</ul>
		</div>
<div class="panel-body">
<div class="table-responsive">
<div class="panel-body">
<form class="form-horizontal" method="get">

</div>

<div class="row">
<div class="col-sm-12" id="listingData">
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
<div class="html5buttons">
<div class="dt-buttons">
<a class="dt-button buttons-excel buttons-html5" style="display:none;" tabindex="0" aria-controls="DataTables_Table_0"><span>Excel</span></a>
<button class="dt-button buttons-excel buttons-html5" onclick="exportTableToExcel('tblData')">Excel</button>
</div>
</div>

<div class="dataTables_length" id="DataTables_Table_0_length">
<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Show
<select name="DataTables_Table_0_length" url="<?=base_url();?>outbound/manageOutbound" aria-controls="DataTables_Table_0" id="entries" class="form-control input-sm">
	<option value="10" <?=$entries=='10'?'selected':'';?>>10</option>
	<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
	<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
	<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
	<option value="500" <?=$entries=='500'?'selected':'';?>>500</option>
	<option value="<?=$dataConfig['total'];?>" <?=$entries==$dataConfig['total']?'selected':'';?>>ALL</option>
</select>
entries</label>
<div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite" style="    margin-top: -8px;margin-left: 12px;float: right;">Showing <?=$dataConfig['page']+1;?> to 
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
<br />

<table class="table table-striped table-bordered table-hover dataTables-example1" id="tblData" >
<thead>
<tr>
<th style="display:none"><input type="checkbox" /></th>
	    <th style="display:none;">Sr.No.</th>
	    <th>Date</th>
        <th style="width:145px;">Original Invoice Received Time</th>
		<th>Customer </th>
		<th>Order No</th>
        <th>Invoice No</th>
        <th style="width:110px;">To Location</th>
        <th>Type</th>
        <th>Action</th>
</tr>
</thead>

<tbody id="getDataTable">
<tr>
	
	<td><input name="date"  type="date"  class="form-control input-sm"  value="" /></td>
	<td><input name="original_inv_rec_time"  type="time"  class="form-control input-sm"  value="" /></td>
	<td><input name="customer"  type="text"  class="form-control input-sm"  value="" /></td>
	<td><input name="order_no"  type="text"  class="form-control input-sm"  value="" /></td>
	<td><input name="invoice_no"  type="text"  class="form-control input-sm"  value="" /></td>
	<td><input name="location"  type="text"  class="form-control input-sm"  value="" /></td>
	<td><input name="type"  type="text"  class="form-control input-sm"  value="" /></td>
	<td><button type="submit" class="btn btn-success" name="filter" value="filter"><span>Search</span></button></td>
</tr>
</form>
<?php

$i=1;
/*@extract($_POST);
if($Show=='')
{
$select_query = "Select * from tbl_stock_out_hdr where  comp_id='".$this->session->userdata('comp_id')."' order by stockoutid desc ";
}
else
{
$sq1 = $this->db->query("select * from tbl_product_stock where sku_no = '$p_code' ");
			$sq2 = $sq1->row();	
			
			$out = array();
			$sq3 = $this->db->query("select * from tbl_stock_out_dtl where product_id='$sq2->Product_id' ");
			foreach($sq3->result() as $sq4)
			{
			 $hdrData=$sq4->stockouthdr;
			 array_push($out,$hdrData);
			
			}	
			
$numCnt=$sq1->num_rows();
if($numCnt>0)
			{
		
			$hdrDataa= implode(', ', $out);

			}
else
{
$hdrDataa='9999999';
}
		

$select_query = "Select * from tbl_stock_out_hdr where stockoutid in ($hdrDataa)";



}
$select_query1= $this->db->query($select_query);


foreach($select_query1->result() as $sales) {
*/
foreach($result as $sales){
?>

<tr class="gradeC record">
<th style="display:none"><input type="checkbox" /></th>
<th style="display:none"><?php echo $sales->stockoutid;?></th>

<th><?php echo $obj->explode_date($sales->date);?></th>
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
<a href="#" onClick="openpopup('<?=base_url();?>outbound/edit_OutBound',1400,600,'view',<?=$sales->stockoutid;?>)"><i class="glyphicon glyphicon-zoom-in"></i>
</a>&nbsp;&nbsp;&nbsp;<a href="#" onClick="openpopup('<?=base_url();?>outbound/edit_OutBound',1400,600,'id',<?=$sales->stockoutid;?>)"><i class="glyphicon glyphicon-pencil"></i>
<?php
$pri_col='stockoutid';
$table_name='tbl_stock_out_hdr';

$pri_col_dtl='stockoutdtlid';
$table_name_dtl='tbl_stock_out_dtl';
	?>
	&nbsp;&nbsp;&nbsp;<a href="#" id="<?php echo $sales->stockoutid."^".$table_name."^".$pri_col."^".$tbl_stock_out_dtl."^".$pri_col_dtl ; ?>" class="delbuttonPurchase icon"><i class="glyphicon glyphicon-remove"></i></a> 

<?php
if($sales->type=='68')
{
?>
<a target="_blank" href="<?=base_url();?>outbound/print_gatepass?id=<?php echo $sales->stockoutid;?>">Print</a>

<?php }


if($sales->type=='67')
{
	?>
<a href="#" onClick="openpopup('<?=base_url();?>outbound/stockIn',1400,600,'id',<?=$sales->stockoutid;?>)">Sales Return</i>
</a>
<?php } ?>
</th>
</tr>
<?php $i++; } ?>
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

<script>
function exportTableToExcel(tableID, filename = ''){
 
 	//alert();
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'OutboundPreAlert_<?php echo date('d-m-Y');?>.xls';
    
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