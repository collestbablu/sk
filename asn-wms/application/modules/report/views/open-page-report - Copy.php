<?php
$this->load->view("header.php");
?>
<div class="main-content">
	
<?php
$this->load->view("reportheader.php");
?>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
<h4 class="panel-title">REPORT </h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
</ul>
</div>
<div class="panel-body">
<div class="form-group"> 
<div class="wizard-navbar">
<ul class="wizard-steps">
<li class=""><a href="#tab1" data-toggle="tab" aria-expanded="false"><span>1</span><a href="<?=base_url();?>report/Report/searchStock/">Product Stock Report</a></a></li>
<li class=""><a href="#tab3" data-toggle="tab" aria-expanded="true"><span>2</span><a href="<?=base_url();?>report/Report/searchProductStockSummery/">Stock Summary Report</a></a></li>
<li class=""><a href="#tab2" data-toggle="tab" aria-expanded="false"><span>3</span><a href="<?=base_url();?>report/Report/searchImportCompliance/">Import Compliance Report</a></a></li>
<li class=""><a href="#tab2" data-toggle="tab" aria-expanded="false"><span>4</span><a href="<?=base_url();?>report/Report/searchLocation/">Location Wise Report</a></a></li>
<li class=""><a href="#tab2" data-toggle="tab" aria-expanded="false"><span>5</span><a href="<?=base_url();?>report/Report/searchLocationFresh/">Location Fresh Report</a></a></li>
<li class=""><a href="#tab2" data-toggle="tab" aria-expanded="false"><span>6</span><a href="<?=base_url();?>report/Report/searchLocationDellPallet/">Location Dell Pallet Report</a></a></li>
<li class=""><a href="#tab2" data-toggle="tab" aria-expanded="false"><span>7</span><a href="<?=base_url();?>report/Report/searchLocationDemo/">Location Demo Report</a></a></li>
<li class=""><a href="#tab2" data-toggle="tab" aria-expanded="false"><span>8</span><a href="<?=base_url();?>report/Report/searchLocationSRN/">Location SRN Report</a></a></li>
<li class=""><a href="#tab2" data-toggle="tab" aria-expanded="false"><span>9</span><a href="<?=base_url();?>report/Report/searchLocationService/">Location Service Report</a></a></li>
<li class=""><a href="#tab2" data-toggle="tab" aria-expanded="false"><span>10</span><a href="<?=base_url();?>report/Report/searchLocationMkt/">Location MKT FOC Report</a></a></li>
<li class=""><a href="#tab2" data-toggle="tab" aria-expanded="false"><span>11</span><a href="<?=base_url();?>report/Report/searchLocationBrochure/">Location BROCHURE Report</a></a></li>
<li class=""><a href="#tab2" data-toggle="tab" aria-expanded="false"><span>12</span><a href="<?=base_url();?>report/Report/searchLocationRgp/">Location RGP Report</a></a></li>
<li class="" style="display:none"><a href="#tab2" data-toggle="tab" aria-expanded="false"><span>12</span><a href="<?=base_url();?>report/Report/searchLocationBlock/">Location Block Report</a></a></li>

</ul>
</div>
</div>
</div>
</div>
</div>
</div>

<?php
$this->load->view("footer.php");
?>

