<?php
$this->load->view("header.php");

$entries = "";
if($this->input->get('entries')!="")
{
  $entries = $this->input->get('entries');
}

?>

<div class="main-content">

<?php 
$this->load->view("reportheader");

?>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
<h4 class="panel-title">PRODUCT STOCK REPORT </h4>
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
<label class="col-sm-2 control-label">Product Code</label> 
<div class="col-sm-3"> 
<input type="text" name="p_code" class="form-control" value="" /> 
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
<button class="dt-button buttons-excel buttons-html5" onclick="exportTableToExcel('tblData')">Excel</button>
<a class="dt-button buttons-excel buttons-html5" style="display:none" tabindex="0" aria-controls="DataTables_Table_0" onclick="exportTableToExcel('tblData')"><span>Excel</span></a>
</div>
</div>

<div class="dataTables_length" id="DataTables_Table_0_length">
<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Show
<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('/report/Report/searchStock');?>" class="form-control input-sm">
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
<table class="table table-striped table-bordered table-hover dataTables-example1" id="tblData">
<thead>
<tr>
 		<th>Serial No.</th>
		<th>Model NO</th>
        <th>Product Name</th>   
		<th>Category</th>
		<th>Unit</th>
		<th>Unit Price Purchase</th>
		<th>Unit Price Sale</th>
		<th>Quantity In Stock</th>
</tr>
</thead>
<tbody id="getDataTable">
<?php
$yy=1;
//if(!empty($stockSearch)) {
foreach($result as $rows) {
?>
<tr class="gradeC record">
<th><?php echo $yy++; ?></th>
<th><?php echo $rows->sku_no; ?></th>
<th><?php echo $rows->productname; ?></th>
<th><?php 

	$sql1 = $this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='".$rows->category."' ");
			$sql2 = $sql1->row();
			echo $sql2->prodcatg_name;
			
		?></th>
<th>
<?php
		$proQ1=$this->db->query("select * from tbl_master_data where serial_number='$rows->usageunit'");
		$fProQ12=$proQ1->row();
 echo $fProQ12->keyvalue;
 ?>
</th>	
<th><?php echo $rows->unitprice_purchase;?></th>	
<th><?php echo $rows->unitprice_sale;?></th>
<th><?php echo $rows->quantity; ?></th>
</tr>
<?php } //} ?>
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
    filename = filename?filename+'.xls':'ProductStockReport_<?php echo date('d-m-Y');?>.xls';
    
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