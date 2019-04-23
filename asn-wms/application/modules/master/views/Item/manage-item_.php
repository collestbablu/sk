<?php
$this->load->view("header.php");
require_once(APPPATH.'modules/master/controllers/Item.php');
$objj=new Item();
$CI =& get_instance();
$list='';
$list=$objj->item_list();	
//require_once(APPPATH.'core/my_controller.php');
//$obj=new my_controller();
//$CI =& get_instance();
/*
$a = new Item;
$a->test2();
echo $a->test3();

*/
$tableName='tbl_product_stock';

?>
	 <!-- Main content -->
	 <div class="main-content">
			
			<ol class="breadcrumb breadcrumb-2"> 
				 
				<?php 
				if($add!='')
				{ ?>
				<li><a class="btn btn-success" href="<?=base_url();?>master/Item/add_item">Add Product</a></li> 
				<?php }?>
				<li> <a type="button" class="btn btn-danger delete_all">Delete Selected</a></li>
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
						<div class="panel-body">
							<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<tr>
		<th><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>
	   <th>Serial No. </th>
		<th>Model No.</th>
        <th>Category</th>
        <th>PG Group</th>
        <th>Family Group</th>
        <th>Description 1</th>
        <th>Description 2</th>
		<th>Usages Unit</th>
        
		 <th >Mrp</th>
		  <th>Image</th>
		 <th>Action</th>
</tr>
</thead>

<tbody>
<?php
  for($i=0,$j=1;$i<count($list);$i++,$j++)
  {
  ?>

<tr class="gradeC record" data-row-id="<?php echo $list[$i]['7']; ?>">
<th>
<?php
										$productId= $list[$i]['7'];

										$checkProduct= $obj->product_check($productId);
   if($checkProduct=='1')
{
?><input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?php echo $list[$i]['7']; ?>" value="<?php echo $list[$i]['7'];?>" />
<?php } else{
	?>
	<spam data-id="" title="Invoice already ctrated for this product.you can not delete ?"   />*</spam>
	
<?php }?>
</th>
<th><?=$list[$i]['1'];?></th>
<th><?=$list[$i]['18'];?></th>
<th>
<?php  $catg=$list[$i]['2'];?>
<?php 

$query = $this->db->query("SELECT * FROM tbl_prodcatg_mst where status='A' and prodcatg_id ='$catg'");
foreach($query->result() as $getCat)
{
 echo $after=$getCat->prodcatg_name; 
 
}?></th>

<th>
<?=$list[$i]['19'];?>
 </th>
<th><?=$list[$i]['20'];?></th>
<th><?=$list[$i]['3'];?></th>
<th><?=$list[$i]['10'];?></th>
<th><?=$list[$i]['8'];?></th>
<th ><?=$list[$i]['6'];?></th>
<th><?php if($list[$i]['9']!=''){?><img src="<?php echo base_url().'assets/image_data/'.$list[$i]['9'];?>" height="100" width="100" /> <?php } else {?><img src="<?php echo base_url()?>assets/images/no_image.png" height="100" width="100" /><?php }?> </th>
<th>
<?php if($view!=''){ ?>
<a href="#" onClick="openpopup('add_item',1200,500,'view',<?=$list[$i]['7'];?>)"><i class="glyphicon glyphicon-zoom-in"></i></a>&nbsp;&nbsp;&nbsp;
<?php } if($edit!=''){ ?>
<a href="#" onClick="openpopup('add_item',1200,500,'id',<?=$list[$i]['7'];?>)"><i class="glyphicon glyphicon-pencil"></i>
<?php }
$pri_col='Product_id';
$table_name='tbl_product_stock';
if($delete!=''){ 
if($checkProduct=='1')
{
?>
	&nbsp;&nbsp;&nbsp;<a href="#" id="<?php echo $list[$i]['7']."^".$table_name."^".$pri_col ; ?>" class="delbutton icon"><i class="glyphicon glyphicon-remove"></i></a> 
<?php
}
else

{
?>
<a href="#" id="<?php echo $list[$i]['7']."^".$table_name."^".$pri_col ; ?>" onclick="return confirm('Invoice already ctrated for this product.you can not delete ?');" class="delbutton icon"><i class="glyphicon glyphicon-remove"></i></a>
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
</div>
</div>
</div>
</div>
</div>
<?php

$this->load->view("footer.php");
?>