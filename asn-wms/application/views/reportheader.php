<style>
.navbar-nav > li > a {
   color: #ffffff;
   background-color:#212B4F!important; 
   font-size: 16px;
   font-weight: 300;
   padding-left: 30px;
}
.container-fluid.nav-bg{
    background-color: #59648A;
    border-bottom: 5px solid #212B4F;
}
.navbar-collapse{
    padding: 0;
}
.navbar-nav > li > a {
    color: #ffffff;
    background-color: #59648A;
    font-size: 16px;
    font-weight: 300;
	padding-left:30px;
}
.navbar-nav > li > a:hover,
.navbar-nav > li > a:focus {
    color: #ffffff;
    background-color:  #4aaaa5;
}
.navbar-nav > .active > a,
.navbar-nav > .active > a:hover,
.navbar-nav > .active > a:focus {
    color: #ffffff;
    background-color: #4aaaa5;
}
.navbar-nav > .open > a,
.navbar-nav > .open > a:hover,
.navbar-nav > .open > a:focus {
    color: #ffffff;
    background-color: #4aaaa5;
}
.navbar-toggle .icon-bar {
    display: block;
    width: 22px;
    height: 3px;
    background-color: #cccccc;
}
.dropdown-menu{
    border-radius: 0;
}

.hoves:hover > .dropdown-menu {
display:block !important;
        -webkit-transition: height .5s ease;
        -webkit-transition-delay: .4s;
}
.dropdown-submenu{position:relative; z-index: 999;}
.dropdown-submenu>.dropdown-menu{top:0;left:100%;margin-top:-6px;margin-left:-1px;-webkit-border-radius:0 6px 6px 6px;-moz-border-radius:0 6px 6px 6px;border-radius:0 6px 6px 6px;        -webkit-transition: height .5s ease;
        -webkit-transition-delay: .4s;}
.dropdown-submenu>a:after{display:block;content:" ";float:right;width:0;height:0;border-color:transparent;border-style:solid;border-width:5px 0 5px 5px;border-left-color:#cccccc;margin-top:5px;margin-right:-10px;}
.dropdown-submenu:hover>a:after{border-left-color:#555;}
.dropdown-submenu.pull-left{float:none;}.dropdown-submenu.pull-left>.dropdown-menu{left:-100%;margin-left:10px;-webkit-border-radius:6px 0 6px 6px;-moz-border-radius:6px 0 6px 6px;border-radius:6px 0 6px 6px;}

.dropdown-submenu {
    position: relative;
}

</style>





<div class="row">
<div class="col-lg-12">
<nav class="navbar navbar-inverse navbar-static-top marginBottom-0" role="navigation">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
</div>

<div class="collapse navbar-collapse" id="navbar-collapse-1">
<ul class="nav navbar-nav">
<li class="dropdown hoves"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Stock<b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="<?=base_url();?>report/Report/searchDelhiStock/">Transaction Report</a></li>
<?php
if($this->session->userdata('comp_id')=='1')
{

?>

<li><a href="<?=base_url();?>report/Report/searchCompleteStock/">Complete Stock With BLR Report</a></li>
<?php
}
if($this->session->userdata('comp_id')=='3')
{

?>
<li><a href="<?=base_url();?>report/Report/searchCompleteStockBLR/">Complete Stock Of BLR Report</a></li>
<?php }?>
<?php
if($this->session->userdata('comp_id')=='1')
{

?>

<li><a href="<?=base_url();?>report/Report/searchConsumerStock/">Consumer Stock Report</a></li>

<?php } if($this->session->userdata('comp_id')=='3')
 {?>
<li><a href="<?=base_url();?>report/Report/searchConsumerBLRStock/">Consumer Stock Report</a></li>
<?php }?>
<?php
if($this->session->userdata('comp_id')=='1')
{
?>
<li><a href="<?=base_url();?>report/Report/searchProfessionalStock/">Professional Stock Report</a></li>

<?php } if($this->session->userdata('comp_id')=='3'){?>
<li><a href="<?=base_url();?>report/Report/searchProfessionalBLRStock/">Professional Stock Report</a></li>
<?php }?>
</ul>
</li>
<li class="dropdown hoves"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Location <b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="<?=base_url();?>report/Report/searchLocation/">Location All Report</a></li>
<li><a href="<?=base_url();?>report/Report/searchLocationFresh/">Location Fresh Report</a></li>
<li><a href="<?=base_url();?>report/Report/searchLocationBlock/">Location Block Report</a> </li>
<?php
if($this->session->userdata('comp_id')=='1')
{
?>
<li><a href="<?=base_url();?>report/Report/searchLocationDellPallet/">Location Dell Pallet Report</a> </li>
<li><a href="<?=base_url();?>report/Report/searchLocationDemo/">Location Demo Report</a> </li>
<li><a href="<?=base_url();?>report/Report/searchLocationSRN/">Location SRN Report</a> </li>
<li><a href="<?=base_url();?>report/Report/searchLocationService/">Location Service Report</a> </li>
<li><a href="<?=base_url();?>report/Report/searchLocationMkt/">Location MKT FOC Report</a> </li>
<li><a href="<?=base_url();?>report/Report/searchLocationBrochure/">Location Brochure Report</a></li>
<li><a href="<?=base_url();?>report/Report/searchLocationRgp/">Location RGP Report</a> </li>
<?php }?>
</ul>
</li>
<li class="dropdown hoves"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Import Compliance <b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="<?=base_url();?>report/Report/searchImportCompliance/">Import Compliance Report</a></li>
</ul>
</li>
<li class="dropdown hoves"><a href="#" class="dropdown-toggle" data-toggle="dropdown">PI <b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="<?=base_url();?>report/Report/searchPI/">PI Report</a></li>
</ul>
</li>
<li class="dropdown hoves"><a href="#" class="dropdown-toggle" data-toggle="dropdown">PG Group 72 <b class="caret"></b></a>
<ul class="dropdown-menu">
<li style="display:none;"><a href="<?=base_url();?>report/Report/searchPgGroup/">72 Report</a></li>
<?php
if($this->session->userdata('comp_id')=='1')
{
?>
<li><a href="<?=base_url();?>report/Report/searchPgGroup72/">PG Group 72 Report</a></li>
<?php
}
if($this->session->userdata('comp_id')=='3')
{
?>
<li><a href="<?=base_url();?>report/Report/searchPgGroup72blr/">PG Group 72 Report</a></li>
<?php }?>
</ul>
</li>
</ul>
</div><!-- /.navbar-collapse -->
</nav>
</div>
</div>
<script>
(function($){
	$(document).ready(function(){
		$('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
			event.preventDefault(); 
			event.stopPropagation(); 
			$(this).parent().siblings().removeClass('open');
			$(this).parent().toggleClass('open');
		});
	});
})(jQuery);
</script>

