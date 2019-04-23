<?php
$this->load->view("header.php");
$obj=new my_controller();
$CI =& get_instance();

$entries = "";
if($this->input->get('entries')!="")
{
  $entries = $this->input->get('entries');
}

?>
<!-- Main content -->
<div class="main-content">

<ol class="breadcrumb breadcrumb-2"> 
	 <?php 
	if($add!='')
	{ ?>
	<li><a class="btn btn-success btn-sm" href="<?=base_url();?>locationRack/add_location_rack">Add Location Rack</a></li> 
	<?php } ?>
	<li> <a type="button" class="btn btn-danger delete_all btn-sm">Delete Selected</a></li>
</ol>

<ol class="breadcrumb breadcrumb-2"> 
	<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
	<li><a href="#">Location</a></li> 
	<li class="active"><strong><a href="#">Manage Location</a></strong></li> 
</ol>
			
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
	<h4 class="panel-title"><strong>Manage Location</strong></h4>
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
<a href="<?=base_url('locationRack/export_location_rack').'?main_loc='.$_GET['main_loc'].'&location='.$_GET['location'].'&rack_name='.$_GET['rack_name'].'&filter='.$_GET['filter'];?>" class="dt-button buttons-excel buttons-html5" style="margin: 0px 30px 0px 0px;"><strong>Excel</strong></a>
</div>
</div>

<div class="dataTables_length" id="DataTables_Table_0_length" style="margin: 0px 0px 0px 30px;">
<label>Show
<select name="DataTables_Table_0_length" url="<?=base_url('locationRack/manage_location_rack').'?main_loc='.$_GET['main_loc'].'&location='.$_GET['location'].'&rack_name='.$_GET['rack_name'].'&filter='.$_GET['filter'];?>" aria-controls="DataTables_Table_0" id="entries" class="form-control input-sm">
	<option value="10" <?=$entries=='10'?'selected':'';?>>10</option>
	<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
	<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
	<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
	<option value="500" <?=$entries=='500'?'selected':'';?>>500</option>
	<option value="<?=$dataConfig['total'];?>" <?=$entries==$dataConfig['total']?'selected':'';?>>ALL</option>
</select>
entries</label>
<div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite" style="margin-top:-6px;margin-left:12px;float:right;">
	Showing <?=$dataConfig['page']+1;?> to 
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
<table class="table table-striped table-bordered table-hover dataTables-example1" id="tblData"  >
<thead>
<tr>
		<th><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>
	    <th><div style="width:115px;">Main Location</div></th>
		<th><div style="width:115px;">Location Name</div></th>
        <th><div style="width:85px;">Rack Name</div></th>
		<th>Action</th>
</tr>
</thead>

<tbody id="getDataTable">
<form method="get">
<tr>
	<td>&nbsp;</td>
	<td><input name="main_loc"  type="text"  class="form-control"  value="" /></td>
	<td><input name="location"  type="text"  class="form-control"  value="" /></td>
	<td><input name="rack_name"  type="text"  class="form-control"  value="" /></td>
	<td><button type="submit" class="btn btn-success btn-sm" name="filter" value="filter"><span>Search</span></button></td>
</tr>
</form>

<?php

$i=1;
foreach($result as $getLocation)
{
?>

<tr class="gradeC record" data-row-id="<?php echo $getLocation->id; ?>">
<th><input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?php echo $getLocation->id; ?>" value="<?php echo $getLocation->id; ?>" /></th>
<th><?php
$locationQuery=$this->db->query("select *from tbl_location where id='$getLocation->location_id'");
$getLocationData=$locationQuery->row();
echo $getLocationData->location_name; 
?></th>
<th><?php
$locationRackQuery=$this->db->query("select *from tbl_master_data where serial_number='$getLocation->location_rack_id'");
$getLocationRackData=$locationRackQuery->row();
echo $getLocationRackData->keyvalue;
?></th>
<th><?php echo $getLocation->rack_name; ?></th>
<th>
<?php if($view!=''){ ?>
<a href="#" onClick="openpopup('add_location_rack',1200,500,'view',<?php echo $getLocation->id; ?>)"><i class="glyphicon glyphicon-zoom-in"></i></a>&nbsp;&nbsp;&nbsp;
<?php } if($edit!=''){ ?>
<a href="#" onClick="openpopup('add_location_rack',1200,500,'id',<?php echo $getLocation->id; ?>)"><i class="glyphicon glyphicon-pencil"></i>
<?php }
$pri_col='id';
$table_name='tbl_location_rack';
if($delete!=''){ 
?>
&nbsp;&nbsp;&nbsp;<a href="#" id="<?php echo $getLocation->id."^".$table_name."^".$pri_col ; ?>" class="delbutton icon"><i class="glyphicon glyphicon-remove"></i></a> 
<?php } ?>
</th>
</tr>
<?php } ?>
</tbody>
<input type="text" style="display:none;" id="table_name" value="tbl_location">  
<input type="text" style="display:none;" id="pri_col" value="id">
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
