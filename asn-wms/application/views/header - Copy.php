
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="keywords" content="">
<title>Tech Vyas Software</title>
<!-- Site favicon -->
<link rel='shortcut icon' type='image/x-icon' href='<?=base_url();?>assets/images/favicon.ico' />
<!-- /site favicon -->

<!-- Entypo font stylesheet -->
<link href="<?=base_url();?>assets/css/entypo.css" rel="stylesheet">
<!-- /entypo font stylesheet -->

<!-- Font awesome stylesheet -->
<link href="<?=base_url();?>assets/css/font-awesome.min.css" rel="stylesheet">
<!-- /font awesome stylesheet -->

<!-- Bootstrap stylesheet min version -->
<link href="<?=base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
<!-- /bootstrap stylesheet min version -->
<!------------------------report menu-------------------------->

<link href="<?php echo base_url();?>assets/report/report.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url();?>assets/report-js/jquery.min.js" type="text/javascript"></script>

<!------------------------report menu close-------------------------->
<!-- Integral core stylesheet -->
<link href="<?=base_url();?>assets/css/integral-core.css" rel="stylesheet">
<!-- /integral core stylesheet -->

<!--Jvector Map-->
<link href="<?=base_url();?>assets/plugins/jvectormap/css/jquery-jvectormap-2.0.3.css" rel="stylesheet">

<link href="<?=base_url();?>assets/css/integral-forms.css" rel="stylesheet">


 


</head>
<?php $this->load->view("javascriptPage.php");?>
<body <?php if($_GET['view']!=''){?> oncontextmenu='return false;' onkeydown='return false;' onmousedown='return false;' <?php }?>>

<!-- Loader Backdrop -->
	<div class="loader-backdrop">           
	  <!-- Loader -->
		<div class="loader">
			<div class="bounce-1"></div>
			<div class="bounce-2"></div>
		</div>
	  <!-- /loader -->
	</div>
<!-- loader backgrop -->
	
<!-- Page container -->
<div class="page-container">
<?php if($_GET['popup']=='True'){} else {?>

<!-- Page Sidebar -->
<?php 
//require_once(APPPATH.'views/side.php');
$this->load->view("side.php");?>
<!-- /page sidebar -->
  
  <!-- Main container -->
<div class="main-container">

<!-- Main header -->
<div class="main-header row">
<div class="col-sm-6 col-xs-7">

</div>

<div class="col-sm-6 col-xs-5">
<div class="pull-right">
<!-- User info -->
<ul class="user-info pull-left">          
<li class="profile-info dropdown"><a  data-toggle="dropdown" class="dropdown-toggle" href="<?php echo base_url(); ?>master/Item/dashboar" aria-expanded="false"> <img style="display:none" width="44" class="img-circle avatar" alt="" src="<?=base_url();?>assets/images/man-3.jpg"><strong>Admin</strong><span class="caret"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>

<!-- User action menu -->
<ul class="dropdown-menu">

<li style="display:none"><a href="<?php echo base_url();?>master/Item/profile"><i class="icon-user" ></i>My profile</a></li>
<li><a href="<?php echo base_url();?>master/changePassword/changepwd"><i class="icon-cog"></i>Change Password</a></li>
<li><a href="<?php echo base_url();?>master/Item/logout"><i class="icon-logout"></i>Logout</a></li>
</ul>
<!-- /user action menu -->
</li>
</ul>
<!-- /user info -->

</div>
</div>
</div>
<?php }?>
<!-- /main header -->
