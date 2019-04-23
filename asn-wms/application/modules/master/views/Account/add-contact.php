<?php
$this->load->view("header.php");
$tableName='tbl_contact_m';
$location='manage_contact';
		
		$userQuery = $this -> db
           -> select('*')
		   -> where('contact_id',$_GET['id'])
		   -> or_where('contact_id',$_GET['view'])
           -> get('tbl_contact_m');
		  $branchFetch = $userQuery->row();

?>
	<!-- Main content -->
	<div class="main-content">
		
		<?php if(@$_GET['popup'] == 'True') {} else {?>
		<ol class="breadcrumb breadcrumb-2"> 
			 
			<li><a class="btn btn-success btn-sm" href="<?=base_url();?>master/Account/manage_contact">Manage Contact</a></li> 
			
		</ol>
		<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
				<li><a href="#">Master</a></li> 
				<li><a href="#">Contact</a></li> 
				<li class="active"><strong><a href="#">Add Contact</a></strong></li> 
			</ol>
		<?php }?>
		
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
<?php if($_GET['id']!=''){ ?>
		<h4 class="panel-title"><strong>Update Contact</strong></h4>
		<?php }elseif($_GET['view']!=''){ ?>
		<h4 class="panel-title"><strong>View Contact</strong></h4>
		<?php }else{ ?> 
		<h4 class="panel-title"><strong>Add Contact</strong></h4>
		<?php } ?>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
</ul>
</div>
<div class="panel-body">
<form class="form-horizontal" method="post" action="insert_contact">
<div class="form-group"> 
<label class="col-sm-2 control-label">*Name:</label> 
<div class="col-sm-4"> 				
<input type="hidden" name="contact_id" value="<?php echo $branchFetch->contact_id; ?>" />
<input type="text" name="first_name" value="<?php echo $branchFetch->first_name; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" required>
</div> 
<label class="col-sm-2 control-label">*Group Name:</label> 
<div class="col-sm-4"> 
<?php
	   	 $hdrQuery=$this->db->query("select * from tbl_contact_m where contact_id='".$_GET['id']."' or contact_id='".$_GET['view']."'");
         $hrdrow=$hdrQuery->row();
	  
	  ?>
      
      <input type="hidden" name="popup" value="<?php echo $_GET['popup']?>" />
	  <input type="hidden" name="grpname" value="<?php echo $hrdrow->contact_id;?>" />
<select name="maingroupname" class="form-control" required id="contact_id_copy5" <?php if(@$_GET['view']!=''){ ?> disabled <?php }?>>

<option value="">-------select---------</option>

<?php
if($_GET['popup']=='True' and $_GET['con']!=''  ){



$ugroup2=$this->db->query("SELECT * FROM tbl_account_mst where account_id= '".$_GET['con']."' " );

}

else
{


$ugroup2=$this->db->query("select * from tbl_account_mst where status='A'");
}
foreach ($ugroup2->result() as $fetchunit){



?>

<option value="<?php  echo $fetchunit->account_id ;?>"<?php if($fetchunit->account_id==$hrdrow->group_name){ ?> selected <?php } ?>><?php echo $fetchunit->account_name;?></option>
<?php } ?>
</select>
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Contact Person:</label> 
<div class="col-sm-4"> 
<input type="text" name="contact_person" value="<?php echo $branchFetch->contact_person?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div> 
<label class="col-sm-2 control-label">Email Id:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="email" value="<?php echo $branchFetch->email; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Mobile No.:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="mobile" value="<?php echo $branchFetch->mobile; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div> 
<label class="col-sm-2 control-label">Phone No.:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="phone" value="<?php echo $branchFetch->phone; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div> 

</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Gst No:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="gst_no" value="<?php echo $branchFetch->gst; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div> 
<label class="col-sm-2 control-label">Fax:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="fax" value="<?php echo $branchFetch->fax; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div> 
</div>
<div class="form-group"> 

<label class="col-sm-2 control-label">IT Pan:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="it_pan" value="<?php echo $branchFetch->IT_Pan; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div>


<label class="col-sm-2 control-label">Tax Id</label> 
<div class="col-sm-4" id="regid"> 
<input type="text"  name="code" value="<?php echo $branchFetch->code; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div> 
</div>
<div class="form-group"> 

<label class="col-sm-2 control-label">Country:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="country" value="<?php echo $branchFetch->country; ?>" class="form-control" />
<select  name="state_id" class="form-control" style="display:none" >
<option value="">--Select--</option>
<?php
$stateQquery=$this->db->query("select *from tbl_state_m where status='A'");
foreach($stateQquery->result() as $getState){
?>

<option value="<?=$getState->stateid;?>" <?php if($getState->stateid==$branchFetch->state_id){ ?> selected="selected" <?php }?>><?=$getState->stateName;?></option>
<?php
}
?>
</select>
</div>


<label class="col-sm-2 control-label">City:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="city" value="<?php echo $branchFetch->city; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div> 
</div>

<div class="form-group"> 

<label class="col-sm-2 control-label">Pin Code:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" min="0" name="pin_code" value="<?php echo $branchFetch->pin_code; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div>


<label class="col-sm-2 control-label">Department</label> 
<div class="col-sm-4" id="regid"> 
<input type="text"  name="department" value="<?php echo $branchFetch->department; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control"></div> 
</div>



<div class="form-group"> 

<label class="col-sm-2 control-label">Code:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text"  name="codeP" value="<?php echo $branchFetch->code; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control">
</div>


<label class="col-sm-2 control-label">&nbsp;</label> 
<div class="col-sm-4" id="regid"> 
&nbsp;</div> 
</div>

<div class="form-group"> 
<div class="well">
<div class="col-sm-12">Add Address Details</div>
</div> 
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">Address1:</label> 
<div class="col-sm-4" id="regid"> 
<textarea class="form-control" style="height:150px; width:299px;" name="address1"  <?php if(@$_GET['view']!=""){?> readonly <?php } ?>><?php if(@$_GET['id']!='' || @$_GET['view']!=''){ echo $branchFetch->address1 ;} ?> </textarea>
</div> 
<label class="col-sm-2 control-label">Address2:</label> 
<div class="col-sm-4" id="regid"> 
<textarea class="form-control" name="address3" style="height:150px; width:299px;"  <?php if(@$_GET['view']!=""){?> readonly <?php } ?>><?php if(@$_GET['id']!='' || @$_GET['view']!=''){ echo $branchFetch->address3 ;} ?> </textarea>
</div> 
</div>


<div class="form-group"> 
<label class="col-sm-2 control-label">Address3:</label> 
<div class="col-sm-4" id="regid"> 
<textarea class="form-control" style="height:150px; width:299px;" name="address4"  <?php if(@$_GET['view']!=""){?> readonly <?php } ?>><?php if(@$_GET['id']!='' || @$_GET['view']!=''){ echo $branchFetch->address4 ;} ?> </textarea>
</div> 
<label class="col-sm-2 control-label">Address4:</label> 
<div class="col-sm-4" id="regid"> 
<textarea class="form-control" name="address5" style="height:150px; width:299px;"  <?php if(@$_GET['view']!=""){?> readonly <?php } ?>><?php if(@$_GET['id']!='' || @$_GET['view']!=''){ echo $branchFetch->address5 ;} ?> </textarea>
</div> 
</div>
<div class="form-group">
<div class="col-sm-4 col-sm-offset-2">
<?php if(@$_GET['popup'] == 'True') {
if($_GET['id']!='' or $_GET['popup']!=''){
?>
<input type="submit" class="btn btn-primary btn-sm" value="Save">
<?php } ?>
<a href="" onclick="popupclose(this.value)"  title="Cancel" class="btn btn-blue btn-sm"> Cancel</a>

	   	 <?php }else {  ?>
		 
		<input type="submit" class="btn btn-primary btn-sm" value="Save">
       <a href="<?=base_url();?>master/Account/manage_contact" class="btn btn-blue btn-sm">Cancel</a>

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