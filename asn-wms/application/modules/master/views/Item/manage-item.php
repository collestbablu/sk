<?php
$this->load->view("header.php");
require_once(APPPATH.'modules/master/controllers/Item.php');
$objj=new Item();
$CI =& get_instance();
$list='';
$list=$objj->item_list();	

$tableName='tbl_product_stock';

$entries = "";
if($this->input->get('entries')!=""){
  $entries = $this->input->get('entries');
}


?>
<div class="main-content">

<ol class="breadcrumb breadcrumb-2"> 
	<?php 
	if($add!='')
	{ ?>
	<li><a class="btn btn-success btn-sm" href="<?=base_url();?>master/Item/add_item">Add Product</a></li> 
	<?php }?>
	<li> <a type="button" class="btn btn-danger delete_all btn-sm">Delete Selected</a></li>
</ol>

<ol class="breadcrumb breadcrumb-2"> 
	<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
	<li><a href="#">Master</a></li> 
	<li><a href="#">Product</a></li> 
	<li class="active"><strong><a href="#">Manage Product</a></strong></li> 
</ol>
			
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
	<h4 class="panel-title"><strong>Manage Product</strong></h4>
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
<a href="<?=base_url('master/Item/export_product_item').'?p_id='.$_GET['p_id'].'&sku_no='.$_GET['sku_no'].'&category='.$_GET['category'].'&pg_grp='.$_GET['pg_grp'].'&fmly_grp='.$_GET['fmly_grp'].'&productname='.$_GET['productname'].'&des2='.$_GET['des2'].'&usages_unit='.$_GET['usages_unit'].'&mrp='.$_GET['mrp'].'&filter='.$_GET['filter'];?>" class="dt-button buttons-excel buttons-html5" style="margin: 0px 30px 0px 0px;"><strong>Excel</strong></a>
</div>
</div>

<div class="dataTables_length" id="DataTables_Table_0_length" style="margin: 0px 0px 0px 30px;">
<label>Show
<select name="DataTables_Table_0_length" url="<?=base_url('master/Item/manage_item').'?p_id='.$_GET['p_id'].'&sku_no='.$_GET['sku_no'].'&category='.$_GET['category'].'&pg_grp='.$_GET['pg_grp'].'&fmly_grp='.$_GET['fmly_grp'].'&productname='.$_GET['productname'].'&des2='.$_GET['des2'].'&usages_unit='.$_GET['usages_unit'].'&mrp='.$_GET['mrp'].'&filter='.$_GET['filter'];?>" aria-controls="DataTables_Table_0" id="entries" class="form-control input-sm">
	<option value="10"<?=$entries=='10'?'selected':'';?>>10</option>
	<option value="25"<?=$entries=='25'?'selected':'';?>>25</option>
	<option value="50"<?=$entries=='50'?'selected':'';?>>50</option>
	<option value="100"<?=$entries=='100'?'selected':'';?>>100</option>
	<option value="500"<?=$entries=='500'?'selected':'';?>>500</option>
	<option value="<?=$dataConfig['total'];?>" <?=$entries==$dataConfig['total']?'selected':'';?>>ALL</option>
</select>
Entries</label>
<div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite" style="margin-top:-6px;margin-left:12px;float:right;">Showing <?=$dataConfig['page']+1;?> to 
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
		<th><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>
  	    <th><div style="width:115px;">Product Id </div> </th>
		<th><div style="width:80px;">Model No.</div></th>
        <th><div style="width:90px;">Category</div></th>
        <th><div style="width:75px;">PG Group</div></th>
        <th><div style="width:105px;">Family Group</div></th>
        <th><div style="width:140px;">Description 1</div></th>
        <th><div style="width:140px;">Description 2</div></th>
		<th><div style="width:105px;">Usages Unit</div></th>
        <th><div style="width:90px;">Mrp</div></th>
		<th>Image</th>
	    <th>Action</th>
</tr>
</thead>

<tbody id="getDataTable" >

<form method="get">
<tr>
	<td>&nbsp;</td>
	<td><input name="p_id"  type="text"  class="form-control"  value="" /></td>
	<td><input name="sku_no"  type="text"  class="form-control"  value="" /></td>
	<td><input name="category"  type="text"  class="form-control"  value="" /></td>
	<td><input name="pg_grp"  type="text"  class="form-control"  value="" /></td>
	<td><input name="fmly_grp"  type="text"  class="form-control"  value="" /></td>
	<td><input name="productname" type="text"  class="form-control"  value="" /></td>
	<td><input name="des2" type="text"  class="form-control"  value="" /></td>
	<td><input name="usages_unit" type="text"  class="form-control"  value="" /></td>
	<td><input name="mrp" type="text"  class="form-control"  value="" /></td>
	<td>&nbsp;</td>
	<td><button type="submit" class="btn btn-success btn-sm" name="filter" value="filter"><span>Search</span></button></td>
</tr>
</form>

<?php
foreach($result as $fetch_list)	
// for($i=0,$j=1;$i<count($list);$i++,$j++)
{
?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->Product_id; ?>">
<th>
<?php
$productId= $fetch_list->Product_id;
$checkProduct= $obj->product_check($productId);

if($checkProduct=='1'){  ?>
<input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?php echo $fetch_list->Product_id; ?>" value="<?php echo $fetch_list->Product_id;?>" />
<?php } else{ ?>
<spam data-id="" title="Invoice already ctrated for this product.you can not delete ?"   />*</spam>
<?php }?>
</th>

<th><?=$fetch_list->Product_id;?></th>
<th><?=$fetch_list->sku_no;?></th>
<th>
<?php 

$query = $this->db->query("SELECT * FROM tbl_prodcatg_mst where status='A' and prodcatg_id ='$fetch_list->category'");
foreach($query->result() as $getCat)
{
 echo $after=$getCat->prodcatg_name; 
}
?>
</th>

<th><?=$fetch_list->pg_group;?></th>
<th><?=$fetch_list->family_group;?></th>
<th><?=$fetch_list->productname;?></th>
<th><?=$fetch_list->description2;?></th>
<th><?php 
	  $compQuery1 = $this -> db
	   -> select('*')
	   -> where('serial_number',$fetch_list->usageunit)
	   -> get('tbl_master_data');
	  $keyvalue1 = $compQuery1->row();

	echo $keyvalue1->keyvalue
?>
</th>
<th ><?=$fetch_list->mrp;?></th>
<th><?php if($fetch_list->product_image!=''){?><img src="<?php echo base_url().'assets/image_data/'.$fetch_list->product_image;?>" height="50" width="50" /> <?php } else {?><img src="<?php echo base_url()?>assets/images/no_image.png" height="50" width="50" /><?php }?> </th>
<th>
<?php if($view!=''){ ?>
<a href="#" onClick="openpopup('add_item',1200,500,'view',<?=$fetch_list->Product_id;?>)"><i class="glyphicon glyphicon-zoom-in"></i></a>&nbsp;&nbsp;&nbsp;
<?php } if($edit!=''){ ?>
<a href="#" onClick="openpopup('add_item',1200,500,'id',<?=$fetch_list->Product_id;?>)"><i class="glyphicon glyphicon-pencil"></i>
<?php }
$pri_col='Product_id';
$table_name='tbl_product_stock';
if($delete!=''){ 
if($checkProduct=='1')
{
?>
	&nbsp;&nbsp;&nbsp;<a href="#" id="<?php echo $fetch_list->Product_id."^".$table_name."^".$pri_col ; ?>" class="delbutton icon"><i class="glyphicon glyphicon-remove"></i></a> 
<?php
}
else

{
?>
<a href="#" id="<?php echo $fetch_list->Product_id."^".$table_name."^".$pri_col ; ?>" onclick="return confirm('Invoice already ctrated for this product.you can not delete ?');" class="delbutton icon"><i class="glyphicon glyphicon-remove"></i></a>
<?php

}

 } ?>
</th>
</tr>
<?php } ?>
</tbody>
<input type="text" style="display:none;" id="table_name" value="tbl_product_stock">  
<input type="text" style="display:none;" id="pri_col" value="Product_id">
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
