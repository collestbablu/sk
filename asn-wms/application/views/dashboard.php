<?php $this->load->view("header.php");?>
<div class="main-content">

<h1 class="page-title">Dashboard</h1>
<br>

<!-- Row-->
<div class="row">

<!-- Online Signup -->
<div class="col-lg-3 col-sm-6">
<div class="panel minimal secondary-bg">
<div class="panel-body">
<h2 class="no-margins"><strong>2,397</strong></h2>
<p>Online Signups</p>
<div class="float-chart-sm pt-15">
<div id="online-signup" class="flot-chart-content"></div>
</div>
</div>
</div>
</div>
<!-- /Online Signup -->

<!-- Last Month Sale -->
<div class="col-lg-3 col-sm-6">
<div class="panel minimal royalblue-bg">
<div class="panel-body">
<h2 class="no-margins"><strong>$8,790</strong></h2>
<p>Last Month Sale</p>
</div>
<div class="float-chart-sm">
<div class="last-month-outer">
<div id="last-month-sale" class="flot-chart-content"></div>
</div>
</div>
</div>
</div>
<!-- /last month sale -->

<!-- New Visits -->
<div class="col-lg-3 col-sm-6">
<div class="panel minimal teal-bg">
<div class="panel-body">
<h2 class="no-margins"><strong>296</strong></h2>
<p>New visits this month</p>

<!-- Mini Progress -->
<div class="mini-progress">

<!-- Progress Media -->
<div class="progress-media">
<div class="progress-label">
<small>136 Web</small>									
</div>
<div class="progress-wrap">
<div class="progress sm-progress"> 
<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%"> 
	<span class="sr-only">136 Web</span>											
</div> 
</div>
</div>
</div>
<!-- /progress media -->

<!-- Progress Media -->
<div class="progress-media">
<div class="progress-label">
<small>60 Android</small>									
</div>
<div class="progress-wrap">
<div class="progress sm-progress"> 
<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%"> 
	<span class="sr-only">60 Android</span>											
</div> 
</div>
</div>
</div>
<!-- /progress media -->

<!-- Progress Media -->
<div class="progress-media">
<div class="progress-label">
<small>40 iOS</small>									
</div>
<div class="progress-wrap">
<div class="progress sm-progress"> 
<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width:30%"> 
	<span class="sr-only">40 iOS</span>											
</div> 
</div>
</div>
</div>
<!-- /progress media -->
</div>
<!-- /mini progress -->
</div>
</div>
</div>
<!-- /new visits -->

<!-- Total Revenu -->
<div class="col-lg-3 col-sm-6">
<div class="panel minimal info-bg">
<div class="panel-body">
<h2 class="no-margins"><strong>$87,356</strong></h2>
<p>Total revenue this year</p>
<div class="float-chart-sm pt-15">
<div id="total-revenue" class="flot-chart-content"></div>
</div>
</div>
</div>
</div>
<!-- /total revenu -->
</div>
<!-- /row-->

<!-- Row -->

<!-- /row-->

<!-- Row-->

<!-- /row-->

<!-- Row-->

<!-- /row-->

<!-- Row-->
<div class="row">

<div class="col-md-12"> 
<div class="panel panel-default">

<!-- Panel body --> 
<div class="panel-body"> 
<div class="jvectormap-section" id="world-map-markers" style="height: 400px"></div>
</div> 
<!-- /panel body -->
</div> 
</div>
</div>
<?php $this->load->view("footer.php");?>