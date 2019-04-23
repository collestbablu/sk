<?php
$this->load->view("header.php");
require_once(APPPATH.'modules/master/controllers/Account.php');
$objj=new Account();
$CI =& get_instance();

//$list='';
//$list=$objj->contact_list_m();	
require_once(APPPATH.'core/my_controller.php');
$obj=new my_controller();
$CI =& get_instance();
$tableName='tbl_contact_m';

$entries = "";
if($this->input->get('entries')!="")
{
  $entries = $this->input->get('entries');
}


?>
<!-- Main content -->
<div class="main-content">
	<ol class="breadcrumb breadcrumb-2"> 
		<li><a class="btn btn-success btn-sm" href="<?=base_url();?>master/Account/add_contact">Add Contact</a></li> 
		<li><a type="button" class="btn btn-danger delete_all btn-sm">Delete Selected</a></li>	
	</ol>
	<ol class="breadcrumb breadcrumb-2"> 
		<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
		<li><a href="#">Master</a></li> 
		<li><a href="#">Contact</a></li> 
		<li class="active"><strong><a href="#">Manage Contact</a></strong></li> 
	</ol>
			
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
	<h4 class="panel-title"><strong>Manage Contact</strong></h4>
	<ul class="panel-tool-options"> 
		<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
	</ul>
</div>
			
<br />
<div class="row">
<div class="col-sm-12">
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
<div class="html5buttons">
<div class="dt-buttons">
<a href="<?=base_url('master/Account/export_contact').'?code='.$_GET['code'].'&name='.$_GET['name'].'&loc='.$_GET['loc'].'&group='.$_GET['group'].'&contact='.$_GET['contact'].'&email='.$_GET['email'].'&mobile='.$_GET['mobile'].'&phone='.$_GET['phone'].'&filter='.$_GET['filter'];?>" class="dt-button buttons-excel buttons-html5" style="margin: 0px 30px 0px 0px;"><strong>Excel</strong></a>
</div>
</div>

<div class="dataTables_length" id="DataTables_Table_0_length" style="margin: 0px 0px 0px 30px;">
<label>Show
<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  url="<?=base_url('master/Account/manage_contact').'?code='.$_GET['code'].'&name='.$_GET['name'].'&loc='.$_GET['loc'].'&group='.$_GET['group'].'&contact='.$_GET['contact'].'&email='.$_GET['email'].'&mobile='.$_GET['mobile'].'&phone='.$_GET['phone'].'&filter='.$_GET['filter'];?>" class="form-control input-sm">
	<option value="10">10</option>
	<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
	<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
	<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
	<option value="500" <?=$entries=='500'?'selected':'';?>>500</option>
	<option value="<?=$dataConfig['total'];?>" <?=$entries==$dataConfig['total']?'selected':'';?>>ALL</option>
</select>
entries</label>

<div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite" style="    margin-top: -6px;margin-left: 12px;float: right;">
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
		<th><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>
	    <th>Code</th>
        <th>Name</th>
		<th>Location</th>
        <th><div style="width:95px;">Group Name</div></th>
        <th>Email Id</th>
		<th><div style="width:95px;">Mobile No.</div></th>
		<th><div style="width:95px;">Phone No.</div></th>
		<th>Action</th>
</tr>
</thead>

<tbody id="getDataTable">
<form method="get">
<tr>
	<td>&nbsp;</td>
	<td><input name="code"  type="text"  class="form-control"  value="" /></td>
	<td><input name="name"  type="text"  class="form-control"  value="" /></td>
	<td><input name="loc"  type="text"  class="form-control"  value="" /></td>
	<td><input name="group"  type="text"  class="form-control"  value="" /></td>
	<td><input name="email"  type="text"  class="form-control"  value="" /></td>
	<td><input name="mobile"  type="text"  class="form-control"  value="" /></td>
	<td><input name="phone"  type="text"  class="form-control"  value="" /></td>
	<td><button type="submit" class="btn btn-success btn-sm" name="filter" value="filter"><span>Search</span></button></td>
</tr>
</form>
 
<?php
//for($i=0,$j=1;$i<count($list);$i++,$j++)
foreach($result as $fetch_list)
{
?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->contact_id; ?>">
<th><input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?php echo $fetch_list->contact_id; ?>" value="<?php echo $fetch_list->contact_id;?>" /></th>
<th><?=$fetch_list->code;?></th>

<th><?=$fetch_list->first_name;?></th>
<th><?=$fetch_list->city;?></th>
<th><?php
		$compQuery = $this -> db
	   -> select('*')
	   -> where('account_id',$fetch_list->group_name)
	   -> get('tbl_account_mst');
	   $compRow = $compQuery->row();
	   
	echo $compRow->account_name;
?>
</th>
<th><?=$fetch_list->email;?></th>
<th><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:9716127292"><?=$fetch_list->mobile;?></a></th>
<th><?=$fetch_list->phone;?></th>
<th>
<a href="#" onClick="openpopup('add_contact',1200,500,'view',<?=$fetch_list->contact_id;?>)"><i class="glyphicon glyphicon-zoom-in"></i></a>
&nbsp;&nbsp;&nbsp;<a href="#" onClick="openpopup('add_contact',1200,500,'id',<?=$fetch_list->contact_id;?>)"><i class="glyphicon glyphicon-pencil"></i>
<?php
$pri_col='contact_id';
$table_name='tbl_contact_m';
?>
&nbsp;&nbsp;&nbsp;<a href="#" id="<?php echo $fetch_list->contact_id."^".$table_name."^".$pri_col ; ?>" class="delbutton icon"><i class="glyphicon glyphicon-remove"></i></a> 
</th>
</tr>
<?php } ?>
</tbody>
<input type="text" style="display:none;" id="table_name" value="tbl_contact_m">  
<input type="text" style="display:none;" id="pri_col" value="contact_id">
</table>

<div class="row">
 <div class="col-md-12 text-right">
   <div class="col-md-6 text-left"></div>
   <div class="col-md-6"> <?=$pagination; ?> </div>
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
