<?php
$this->load->view("header.php");
$this->load->view("javascriptPage.php");
require_once(APPPATH.'modules/admin/controllers/masterdata.php');
$objj=new Masterdata();
$CI =& get_instance();

$list='';

$list=$objj->masterdata_list();	
require_once(APPPATH.'core/my_controller.php');
$obj=new my_controller();
$CI =& get_instance();
$tableName='tbl_master_data';

?>
	 <!-- Main content -->
	 <div class="main-content">
			
			<ol class="breadcrumb breadcrumb-2"> 
				
				<?php 
				if($add!='')
				{ ?>
				<li><a class="btn btn-success btn-sm" href="<?=base_url();?>admin/masterdata/add_master_data">Add Master Data</a></li> 
				<?php }?>	
				<li>
				<a type="button" class="btn btn-danger delete_all btn-sm">Delete Selected</a>
			</li>
			</ol>
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
				<li><a href="#">Admin Setup</a></li> 
				<li><a href="#">Master Data</a></li>
				
				<li class="active"><strong><a href="#">Manage Master Data</a></strong></li> 
			</ol>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h4 class="panel-title"><strong>Manage Master Data</strong></h4>
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
 		<th>Value Name</th>
		<th>Added value</th>
		<th>Description</th>
        <th>Action</th>
</tr>
</thead>

<tbody>
<?php
  for($i=0,$j=1;$i<count($list);$i++,$j++)
  {
  ?>

<tr class="gradeC record" data-row-id="<?php echo $list[$i]['4']; ?>">
<td><input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?php echo $list[$i]['4']; ?>" value="<?php echo $list[$i]['4'];?>" /></td>
 	  	
		
<th><?=$list[$i]['1'];?></th>
<th><?=$list[$i]['2'];?></th>
<th><?=$list[$i]['3'];?></th>
<th>
<?php if($view!=''){ ?>
<a href="#" onClick="openpopup('add_master_data',1200,500,'view',<?=$list[$i]['4'];?>)"><i class="glyphicon glyphicon-zoom-in"></i></a>
&nbsp;&nbsp;&nbsp;
<?php } if($edit!=''){ ?>
<a href="#" onClick="openpopup('add_master_data',1200,500,'id',<?=$list[$i]['4'];?>)"><i class="glyphicon glyphicon-pencil"></i>
<?php } if($delete!=''){
$pri_col='serial_number';
$table_name='tbl_master_data';
?>
	&nbsp;&nbsp;&nbsp;
	<a href="#" id="<?php echo $list[$i]['4']."^".$table_name."^".$pri_col ; ?>" class="delbutton icon"><i class="glyphicon glyphicon-remove"></i></a> 
<?php } ?>
</th>
</tr>
<?php } ?>
</tbody>
<input type="text" style="display:none;" id="table_name" value="tbl_master_data">  
<input type="text" style="display:none;" id="pri_col" value="serial_number">
</table>
</div>
</div>
</div>
</div>
</div>
<?php

$this->load->view("footer.php");
?>