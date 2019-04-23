<body>
<?php
$this->load->view("header.php");
$tableName='tbl_product_stock';
$location='manage_item';
		
		$userQuery = $this -> db
           -> select('*')
		   -> where('Product_id',$_GET['id'])
		   -> or_where('Product_id',$_GET['view'])
           -> get('tbl_product_stock');
		  $branchFetch = $userQuery->row();

?>
	<!-- Main content -->
	<div class="main-content">
		
		<?php if(@$_GET['popup'] == 'True') {} else {?>
		<ol class="breadcrumb breadcrumb-2"> 
			
			<li><a class="btn btn-success" href="<?=base_url();?>master/Item/manage_item">Manage Product</a></li> 
			
		</ol>
		<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
				<li><a href="#">Master</a></li> 
				<li><a href="#">Product</a></li> 
				<li class="active"><strong><a href="#">Add Product</a></strong></li> 
			</ol>
		<?php }?>

<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
<?php if($_GET['id']!=''){ ?>
		<h4 class="panel-title">Update Product</h4>
		<?php }elseif($_GET['view']!=''){ ?>
		<h4 class="panel-title">View Product</h4>
		<?php }else{ ?> 
		<h4 class="panel-title"><strong>Add Product</strong></h4>
		<?php } ?>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
</ul>
</div>
<div class="panel-body">
<form class="form-horizontal" method="post" action="insert_item" enctype="multipart/form-data">
<div class="form-group"> 
<label class="col-sm-2 control-label">*Model No.:</label> 
<div class="col-sm-4"> 
	<?php 
					$query=$this->db->query("select * from tbl_product_stock order by Product_id desc");
					$fetchR=$query->row();
					
					$productId=$fetchR->Product_id+1;
	?>
			
<input type="hidden"  name="Product_id" value="<?php echo $branchFetch->Product_id; ?>" />
<input type="text" required class="form-control" name="sku_no" value="<?php echo $branchFetch->sku_no;?>" > 
</div> 
<label class="col-sm-2 control-label">*Description1:</label> 
<div class="col-sm-4"> 
<input name="item_name"  type="text" value="<?php echo $branchFetch->productname; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> required> 
</div> 
</div>
<div class="form-group"> 
<div class="field">

<label class="col-sm-2 control-label">Category:</label> 
<div class="col-sm-4">
  <select name="category" id="contact_id_copy" class="form-control ui fluid search dropdown email"   <?php if(@$_GET['view']!=''){ ?> disabled="disabled" <?php }?> >
    <option value="">----Select ----</option>
    <?php 
						$sqlgroup=$this->db->query("select * from tbl_prodcatg_mst where main_prodcatg_id='121'");
						foreach ($sqlgroup->result() as $fetchgroup){
						
					?>
    <option value="<?php echo $fetchgroup->prodcatg_id; ?>"<?php if(@$_GET['id']!='' || @$_GET['view']!=''){ if($fetchgroup->prodcatg_id==$branchFetch->category){ ?> selected <?php } }?>><?php echo $fetchgroup->prodcatg_name ; ?></option>
    <?php } ?>
  </select>
  <a onClick="openpopup('<?=base_url();?>master/ProductCategory/add_itemctg',900,630,'mid','121')"><img src="<?php echo base_url();?>/assets/images/addcontact.png" style="display:none" width="25px" height="25px"/></a> </div> 
</div>
<div class="field">
<label class="col-sm-2">*Usages Unit:</label> 
<div class="col-sm-4" id="regid"> 
<select name="unit" id="contact_id_copy1" required class="form-control ui fluid search dropdown email"  <?php if(@$_GET['view']!=''){ ?> disabled="disabled" <?php }?>>
					<option value="" selected disabled>----Select Unit----</option>
				<?php 
						$sqlunit=$this->db->query("select * from tbl_master_data where param_id=16");
						foreach ($sqlunit->result() as $fetchunit){
						
					?>
				<option value="<?php echo $fetchunit->serial_number;?>" <?php if(@$_GET['id']!='' || @$_GET['view']!=''){ if($fetchunit->serial_number==$branchFetch->usageunit){ ?> selected <?php } }?>><?php echo $fetchunit->keyvalue; ?></option>
					<?php } ?>
			</select>
</div> 
</div>
</div>


<div class="form-group"> 
<label class="col-sm-2 control-label">PG Group:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" name="pg_group" min="1" step="any" value="<?php echo $branchFetch->pg_group; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div>  
<label class="col-sm-2 control-label">Manufacturer Code:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" name="manufacturer_code" value="<?php echo $branchFetch->manufacturer_code; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div> 
</div>


<div class="form-group"> 
<label class="col-sm-2 control-label">Family Group:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" name="family_group" min="1" step="any" value="<?php echo $branchFetch->family_group; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div>  
<label class="col-sm-2 control-label">Description 2:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="description2" value="<?php echo $branchFetch->description2; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div> 
</div>
<div class="form-group"> 
<div class="field">
<label class="col-sm-2 control-label">Inventory Type:</label> 
<div class="col-sm-4">
  <select name="inventoy_type"  class="form-control ui fluid"  <?php if(@$_GET['view']!=''){ ?> disabled="disabled" <?php }?> >
    <option value="">----Select ----</option>
   <option value="Slow Moving" <?php if($branchFetch->inventoy_type=='Slow Moving'){?> selected <?php }?>>Slow Moving</option>
   <option value="Phased Out" <?php if($branchFetch->inventoy_type=='Phased Out'){?> selected<?php }?>>Phased Out</option>
  </select>
  <a onClick="openpopup('<?=base_url();?>master/ProductCategory/add_itemctg',900,630,'mid','121')"><img src="<?php echo base_url();?>/assets/images/addcontact.png" style="display:none" width="25px" height="25px"/></a> </div> 
</div>
<div class="field">
<label class="col-sm-2 control-label">Tariff:</label> 
<div class="col-sm-4" id="regid"> 
<input name="tariff"  type="text" value="<?php echo $branchFetch->tariff; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> >
</div> 
</div>
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Hsn Code:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" name="hsn_code" min="1" step="any" value="<?php echo $branchFetch->hsn_code; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div>  
<label class="col-sm-2 control-label">GST Tax:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" name="gst_tax" value="<?php echo $branchFetch->gst_tax; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div> 
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">EAN Number:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" name="ean_number" min="1" step="any" value="<?php echo $branchFetch->ean_number; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div>  
<label class="col-sm-2 control-label">UPC Code:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" name="upc_code" value="<?php echo $branchFetch->upc_code; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div> 
</div>


<div class="form-group"> 
<label class="col-sm-2 control-label">MOQ:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" name="moq" min="1" step="any" value="<?php echo $branchFetch->moq; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div>  
<label class="col-sm-2 control-label">Sales Pack Wt (In Kg):</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" name="sales_pack_wt" value="<?php echo $branchFetch->sales_pack_wt; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Length:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" name="length" min="1" step="any" value="<?php echo $branchFetch->length; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div>  
<label class="col-sm-2 control-label">Width:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" name="width" value="<?php echo $branchFetch->width; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div> 
</div>
<div class="form-group">   
<label class="col-sm-2 control-label">Height:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" name="height" min="1" step="any" value="<?php echo $branchFetch->height; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div>  
<label class="col-sm-2 control-label">MRP:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" name="mrp" min="1" step="any" value="<?php echo $branchFetch->mrp; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div>  
</div>

<div class="form-group">   
<label class="col-sm-2 control-label">Carton Weight:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" name="carton_weight" min="1" step="any" value="<?php echo $branchFetch->carton_weight; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div>  
<label class="col-sm-2 control-label">Carton Dimensions:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="carton_dimensions" min="1" step="any" value="<?php echo $branchFetch->carton_dimensions; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div>  
</div>

<div class="form-group">   
<label class="col-sm-2 control-label">Master Carton Weight:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" name="master_carton_weight" min="1" step="any" value="<?php echo $branchFetch->master_carton_weight; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div>  
<label class="col-sm-2 control-label">Master Carton Quantity
:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="master_carton_quantity" min="1" step="any" value="<?php echo $branchFetch->master_carton_quantity; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div>  
</div>

<div class="form-group">   
<label class="col-sm-2 control-label">Master Carton Dimensions:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="master_carton_dimensions" min="1" step="any" value="<?php echo $branchFetch->master_carton_dimensions; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div>  
<label class="col-sm-2 control-label">Crossre Ference:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="crossre_ference" min="1" step="any" value="<?php echo $branchFetch->crossre_ference; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div>  
</div>
<div class="form-group">   
<label class="col-sm-2 control-label">Country Origin:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="country_origin" min="1" step="any" value="<?php echo $branchFetch->country_origin; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div>  
<label class="col-sm-2 control-label">Inner Master Carton Weight:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="inner_master_carton_weight" min="1" step="any" value="<?php echo $branchFetch->inner_master_carton_weight; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div>  
</div>
<div class="form-group">   
<label class="col-sm-2 control-label">Inner Master Carton Quantity:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" name="inner_master_carton_quantity" min="1" step="any" value="<?php echo $branchFetch->inner_master_carton_quantity; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div>  
<label class="col-sm-2 control-label">Inner Master Carton W H D:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="inner_master_carton_w_h_d" min="1" step="any" value="<?php echo $branchFetch->inner_master_carton_w_h_d; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div>  
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Minimum Reorder Level:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" name="min_re_level" min="1" step="any" value="<?php echo $branchFetch->min_re_level;?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div>  

<label class="col-sm-2 control-label">Image:</label> 
<div class="col-sm-4" id="regid"> 
<input type="file" name="image_name" accept="image/*" onChange="loadFile(event)" /><?php if(@$_GET['id']!='' || @$_GET['view']!=''){ ?> <img id="output" src="<?php if(@$_GET['id']!='' || @$_GET['view']!=''){ echo base_url().'assets/image_data/'.$branchFetch->product_image; }?>"  width = "100" height = "100"/><?php } else { ?><img id="output" src="<?php echo base_url()?>assets/images/no_image.png"  width = "100" height = "100"/><?php }?>
</div> 
</div>
<div class="form-group">
<div class="col-sm-4 col-sm-offset-2">
<?php if(@$_GET['popup'] == 'True') {
if($_GET['id']!=''){
?>
<input type="submit" class="btn btn-primary" value="Save">
<?php } ?>
<a href="" onClick="popupclose(this.value)"  title="Cancel" class="btn btn-blue"> Cancel</a>

	   	 <?php }else {  ?>
		 
		<input type="submit" class="btn btn-primary" value="Save">
       <a href="<?=base_url();?>master/Item/manage_item" class="btn btn-blue">Cancel</a>

       <?php } ?>

</div>
</div>
</form>
</div>
</div>
</div>
</div>
<?php
$this->load->view("footer.php");

?>
</body>
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };

function abc(val)
{

if(val=='new')
{
  newwindow=window.open('<?=base_url();?>SalesOrder/all_product_function?&popup=True&id='+val,'name','height=500,width=1200');
if (window.focus) {newwindow.focus()}
return false;

 // openpopup('<?=base_url();?>SalesOrder/all_product_function',1200,500,'view',<?=$sales[$i]['1'];?>)
  //alert();
}
}
</script>
