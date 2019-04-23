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

<form id="f1" name="f1" method="POST" action="insertstockrefill" onSubmit="return checkKeyPressed(a)">

<script>
$(function() {
// setTimeout() function will be fired after page is loaded
// it will wait for 5 sec. and then will fire
// $("#successMessage").hide() function
    
 var timeout = 3000; // in miliseconds (3*1000)

$('.hide-it').delay(timeout).fadeOut(300);

});
</script>

<!-- Main content -->
	<div class="main-content">
		
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
<div class="row">
<?php if(@$_GET['popup'] == 'True') {} else {?>
<div class="col-sm-6">
<ol class="breadcrumb breadcrumb-2"> 
<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
<li><a href="#">Internal Stock Transfer</a></li> 
<li class="active"><strong>Add Internal Stock Transfer</strong></li> 
</ol>
</div>
<?php }?>

<div class="col-sm-6 hide-it">
<ol class="breadcrumb breadcrumb-2"> 
<li><i><a style="color:#3c763d;background-color:#dff0d8;border-color:#d6e9c6"><b><?php echo $this->session->flashdata('success'); ?></b></a></i></li> 
</ol>
</div>
</div>
                       
</div>
<div class="panel-body">

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" >
<tbody>
<tr class="gradeA">
<th>Product Code</th>
<th>Description1</th>
<th>Description2</th>
<th>Main Location</th>
<th>Location</th>
<th>Rack</th>
<th>Quantity in Stock</th>
<th>Main Location</th>
<th>Location</th>
<th>Rack</th>
<th>Enter Quantity</th>
</tr>

<tr class="gradeA">
<th style="width:280px;">
<div class="input-group"> 
<div style="width:100%; height:28px;" >
<input type="text" name="prd" tabindex="1"  onkeyup="getdata()" onClick="getdata()"  id="prd" style=" width:230px;"  placeholder=" Search Items..." tabindex="5" >
 <input type="hidden"  name="pri_id" id='pri_id'  value="" style="width:80px;"  />
 
 <input type="hidden"  name="cateidd" id='cateidd'  value="" style="width:80px;"  />
 
<!--<img   src="<?php echo base_url();?>/assets/images/search11.png"  onClick="openProduct();" />--></div>
</div>
<div id="prdsrch" style="color:black;padding-left:0px; width:30%; height:110px; max-height:110px;overflow-x:auto;overflow-y:auto;padding-bottom:5px;padding-top:0px; position:absolute;">
<?php
//include("getproduct.php");
$this->load->view('getproduct');

?>
</div></th>
<th><input type="text" id="desc1" style="width:100px;"   class="form-control" readonly></th>
<th><input type="text" id="desc2" style="width:100px;"   class="form-control" readonly></th>
<th>
<select name="main_loc" id="main_loc" class="form-control" style="width:100px;" >
	<option value="">---select---</option>
	 <?php
	$locQ=$this->db->query("select *from tbl_location");
	foreach($locQ->result() as $location_list){
	?>
   <option value="<?=$location_list->id;?>" <?php if($location_list->id==$branchFetch->location_rack_id){?> selected <?php }?>><?=$location_list->location_name;?></option>
   <?php }?>
</select>
</th>
<th>
<b><input type="hidden" style="border:none" id="lpr" value="" readonly /></b>
<select name="location_id" id="location_id" onchange="location_fun(this.value)" style="width:100px;"   class="form-control"  <?php if(@$_GET['view']!=''){ ?> disabled="disabled" <?php }?> >
    <option value="">----Select ----</option>
    <?php
	$bookingType=$this->db->query("select *from tbl_master_data  where param_id='29'");
	foreach($bookingType->result() as $getBooking){
	?>
   <option value="<?=$getBooking->serial_number;?>" <?php if($getBooking->serial_number==$branchFetch->location_rack_id){?> selected <?php }?>><?=$getBooking->keyvalue;?></option>
   <?php }?>
  </select>
</th>

<th>

<select name="rack_id" class="form-control" id="div_loc_id" onchange="rackOne(this.value)" style="width:100px;" >
    <option value="">----Select ----</option>
  
  </select>
</th>
<th>
<div id="div_quantity">
<input type="text" id="quantity_idd"  style="width:100px;"   class="form-control" readonly>
</div>
</th>
<th>
<select name="main_loc_two" id="main_loc_two" class="form-control" style="width:100px;" >
	<option value="">---select---</option>
	 <?php
	$locQ=$this->db->query("select *from tbl_location");
	foreach($locQ->result() as $location_list){
	?>
   <option value="<?=$location_list->id;?>" <?php if($location_list->id==$branchFetch->location_rack_id){?> selected <?php }?>><?=$location_list->location_name;?></option>
   <?php }?>
</select>
</th>
<th><select name="location_two_id" id="location_two_id" style="width:100px;"  onchange="getRackFun(this.value);"  class="form-control"  <?php if(@$_GET['view']!=''){ ?> disabled="disabled" <?php }?> >
    <option value="">----Select ----</option>
    <?php
	$bookingType=$this->db->query("select *from tbl_master_data  where param_id='29'");
	foreach($bookingType->result() as $getBooking){
	?>
   <option value="<?=$getBooking->serial_number;?>" <?php if($getBooking->serial_number==$branchFetch->location_rack_id){?> selected <?php }?>><?=$getBooking->keyvalue;?></option>
   <?php }?>
  </select></th>
<th>

<select name="rack_two_id" class="form-control" id="div_rack_id" style="width:100px;" >
    <option value="">----Select ----</option>
  
  </select>
  </th>
<th><input type="text" id="entQty" style="width:100px;"   class="form-control"></th>
</tr>
</tbody>

</table>
<script>
function location_fun(id){

	var pri=id;
 	var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "getmainloc?main_location_id="+pri, false);
  xhttp.send();
  document.getElementById("div_loc_id").innerHTML = xhttp.responseText;
 
}

function getRackFun(id){

	var pri=id;
 	var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "getLocationTwo?location_two_id="+pri, false);
  xhttp.send();
  document.getElementById("div_rack_id").innerHTML = xhttp.responseText;
 
}

function rackOne(id){

	var pri=id;
 	var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "getRackOne?rack_one_id="+pri, false);
  xhttp.send();
  document.getElementById("div_quantity").innerHTML = xhttp.responseText;
 
}
</script>
</div>
<div>

</div>
<div>&nbsp;</div>
<div class="table-to" style="width:100%; background:white;   color:#000000;  max-height:170px; overflow-x:auto;overflow-y:auto;">
<div class="table-responsive">
<table id="invoice" style="width:100%;">
<tr>
<td style="width:1%;"><div align="center"><u>Sl No</u>.</div></td>
<td style="width:11%;"><div align="center"><u>Product Code</u></div></td>
<td style="width:3%;"> <div align="center"><u>Description1</u></div></td>
<td style="width:3%;"> <div align="center"><u>Description2</u></div></td>
<td style="width:3%;"> <div align="center"><u>Main Location</u></div></td>
<td style="width:3%;"> <div align="center"><u>Location</u></div></td>
<td style="width:3%;"><div align="center"><u>Rack</u></div></td>
<td style="width:3%;"><div align="center"><u>Quantity in Stock</u></div></td>

<td style="width:3%;"><div align="center"><u>Main Location</u></div></td>
<td style="width:3%;"><div align="center"><u>Location</u></div></td>
<td style="width:3%;"><div align="center"><u>Rack</u></div></td>
<td style="width:3%;"><div align="center"><u>Enter Quantity</u></div></td>

<td style="width:3%; display:none"> <div align="center"><u>Action</u></div></td>
</tr>
</table>

</div>
</div>

<input type="hidden" name="rows" id="rows">
<!--//////////ADDING TEST/////////-->
<input type="hidden" name="spid" id="spid" value="d1"/>
<input type="hidden" name="ef" id="ef" value="0" />

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">


</table>
</div>
<tbody>

<tr class="gradeA">
<th><input class="btn btn-primary" type="button" value="SAVE"   id="sv1" onclick="fsv(this)" ></th>
</tr>
</tbody>
</div>
</div>
</div>
</div>

<script>
function allqty(checkboxElem){

if (checkboxElem.checked) {


var allsizeval=document.getElementById("lph").value;

var qnval=document.getElementById("qn").value;

var allsizevals=allsizeval.split(" ");
var totalsizeall=allsizevals.length;

var allqnval=qnval.split(" ")[0];

	var sumq="";
for(var i=0;i<totalsizeall;i++){

	sumq +=Number(allqnval)+" ";
}
//alert(sumq.trim());

document.getElementById("qn").value=sumq.trim( );
  } else {



var allsizeval=document.getElementById("lph").value;

var qnval=document.getElementById("qn").value;

var allsizevals=allsizeval.split(" ");
var totalsizeall=allsizevals.length;

var allqnval=qnval.split(" ")[0];

  document.getElementById("qn").value=allqnval;
  
}
}
</script>

<script>
//add item into showling list
window.addEventListener("keydown", checkKeyPressed, false);
//funtion to select product
function checkKeyPressed(e) {
var s=e.keyCode;

var ppp=document.getElementById("prd").value;
var sspp=document.getElementById("spid").value;//
var ef=document.getElementById("ef").value;
		ef=Number(ef);
		
var countids=document.getElementById("countid").value;

for(n=1;n<=countids;n++)
{


document.getElementById("tyd"+n).onkeyup  = function (e) {
var entr =(e.keyCode);

if(entr==13 ){
document.getElementById("main_loc").focus();
document.getElementById("prdsrch").innerHTML=" ";

}
}
}

document.getElementById("main_loc").onkeydown = function (e) {
var entr =(e.keyCode);
if(entr==13){
	var main_locss=document.getElementById("main_loc").value;
	if(main_locss==''){	
	alert("Please Select Main Location");
document.getElementById("main_loc").focus();	
	}else{		
document.getElementById("location_id").focus();
}
}
}

document.getElementById("location_id").onkeydown = function (e) {
var entr =(e.keyCode);
if(entr==13){
	var loctone=document.getElementById("location_id").value;
	if(loctone==''){
		alert("Please Select Location");
	document.getElementById("location_id").focus();
	}else{
		document.getElementById("div_loc_id").focus();
		}
}
}

document.getElementById("div_loc_id").onkeydown = function (e) {
var entr =(e.keyCode);
if(entr==13){
			
		var qtyin=document.getElementById("quantity_idd").value;
		var rackk=document.getElementById("div_loc_id").value;
		if(rackk!=''){	
			if(qtyin=='' || qtyin=='0'){
				
				alert("Stock Quantity is Zero");			
		document.getElementById("div_loc_id").focus();	
			}else{
		document.getElementById("main_loc_two").focus();		
		}
	}else{
		alert("Please Select Rack");
	document.getElementById("div_loc_id").focus();	
		}
}
}

document.getElementById("main_loc_two").onkeydown = function (e) {
var entr =(e.keyCode);
if(entr==13){
		var main_locsstwo=document.getElementById("main_loc_two").value;
		if(main_locsstwo==''){
		alert("Please Select Main Location");
		document.getElementById("main_loc_two").focus();
		}else{
		document.getElementById("location_two_id").focus();
		}
}
}


document.getElementById("location_two_id").onkeydown = function (e) {
var entr =(e.keyCode);
if(entr==13){
	
	var locttwo=document.getElementById("location_two_id").value;
	if(locttwo==''){
			alert("Please Select Location");
			document.getElementById("location_two_id").focus();
	}else{
		document.getElementById("div_rack_id").focus();
		}
}
}


document.getElementById("div_rack_id").onkeydown = function (e) {
var entr =(e.keyCode);
if(entr==13){
	
	var mainoneidd=document.getElementById("main_loc").value;
	var location_one_idd=document.getElementById("location_id").value;
	var rackkoneiddd=document.getElementById("div_loc_id").value;
	
	var mainloc_iddd=document.getElementById("main_loc_two").value;
	var locationtwo_idd=document.getElementById("location_two_id").value;
	var racktwo_idd=document.getElementById("div_rack_id").value;
	
	if(mainoneidd==mainloc_iddd){
			if(location_one_idd==locationtwo_idd){
				if(rackkoneiddd==racktwo_idd){
					alert("Same Location");
				}else{
					document.getElementById("entQty").focus();
				}
			}else{
					document.getElementById("entQty").focus();
			}
	}else{
			
			if(location_one_idd==locationtwo_idd){
					document.getElementById("entQty").focus();
				if(rackkoneiddd==racktwo_idd){
					document.getElementById("entQty").focus();
				}
			}
	}
	
	
}
}

document.getElementById("entQty").onkeydown = function (e) {
var entr =(e.keyCode);
if(document.getElementById("entQty").value=="" && entr==08){
		
}
		
		
	var qtyinstockkk=document.getElementById("quantity_idd").value;
	var enterqtyyy=document.getElementById("entQty").value;

		
   if (e.keyCode == "13")
	 {
		if(Number(qtyinstockkk)>=Number(enterqtyyy)){

	 e.preventDefault();
     e.stopPropagation();
	
	  if(ppp!=='' || ef==1)
	 {

			adda();	  	
			
				
		var ddid=document.getElementById("spid").value;
		var ddi=document.getElementById(ddid);
		ddi.id="d";
		
			}
	       else
			{
	   alert("Enter Correct Product");
			}
		return false;
   			}else{
				alert("Enter Quantity Is greater than");
			}
		}
	}
}
/////////////////////////////////////////////

function fsv(v)
{
var rc=document.getElementById("rows").value;

if(rc!=0)
{
v.type="submit";
}
else
{
	alert('No Item To Save..');	
}
}


function getdata()
		  {
		  
		 currentCell = 0;
		 var product1=document.getElementById("prd").value;	 
		 var product=product1;
		
		    if(xobj)
			 {
			 var obj=document.getElementById("prdsrch");
			
			 xobj.open("GET","getproduct?con="+product,true);
			 xobj.onreadystatechange=function()
			  {
			  if(xobj.readyState==4 && xobj.status==200)
			   {
				  
			    obj.innerHTML=xobj.responseText;
			   }
			  }
			 }
			 xobj.send(null);
		  }
  
////////////////////////////////////////////////////

 function slr(){
		var table = document.getElementById('invoice');
        var rowCount = table.rows.length;
		  for(var i=1;i<rowCount;i++)
		  {    
              table.rows[i].cells[0].innerHTML=i;
		  }
			 
}  


     var rw=0;
	 
 function adda()
		  { 
		 	 
			 	var desc1=document.getElementById("desc1").value;
				var desc2=document.getElementById("desc2").value;
			 
				var main_loc=document.getElementById("main_loc").value;
				var main_loc_name=document.getElementById("main_loc");
				var getmain_loc_name= main_loc_name.options[main_loc_name.selectedIndex].text;
		
				var location_id=document.getElementById("location_id").value;
				var location_id_name=document.getElementById("location_id");
				var get_location_name=location_id_name.options[location_id_name.selectedIndex].text;
				
				var rack_id=document.getElementById("div_loc_id").value;
				var rack_id_name=document.getElementById("div_loc_id");
				var get_rack_id_name=rack_id_name.options[rack_id_name.selectedIndex].text;
				
				var quantity_idd=document.getElementById("quantity_idd").value;				
				
				var main_loc_two=document.getElementById("main_loc_two").value;
				var main_loc_two_name=document.getElementById("main_loc_two");
				var get_main_loc_two_name=main_loc_two_name.options[main_loc_two_name.selectedIndex].text;
				
				var location_two_id=document.getElementById("location_two_id").value;
				var location_two_id_name=document.getElementById("location_two_id");
				var get_location_two_id_name=location_two_id_name.options[location_two_id_name.selectedIndex].text;
								
				var rack_two_id=document.getElementById("div_rack_id").value;		
				var div_rack_id_name=document.getElementById("div_rack_id");
				var get_div_rack_id_name=div_rack_id_name.options[div_rack_id_name.selectedIndex].text;

				var qn=document.getElementById("entQty").value;
				var entQty=document.getElementById("entQty").value;
				var rows=document.getElementById("rows").value;
				var pri_id=document.getElementById("pri_id").value;
				var pd=document.getElementById("prd").value;
		   	   var table = document.getElementById("invoice");
					var rid =Number(rows)+1;
					document.getElementById("rows").value=rid;
					
             				clear();
				
					 currentCell = 0;
	if(pd!="" && qn!=0)
					{
				     var indexcell=0;
								var row = table.insertRow(-1);
						rw=rw+0;
					
						//cell 0st
	 var cell=cell+indexcell;		
 	 cell = row.insertCell(0);
	 cell.style.width=".20%";
	 cell.align="center"
	cell.innerHTML=rid;
				
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;	
			
	    cell = row.insertCell(indexcell);
				cell.style.width="11%";
				cell.align="center";
				
				//============================item text ============================
				var prd = document.createElement("input");
							prd.type="text";
							prd.border ="0";
							prd.value=pd;	
							prd.name='pd[]';//
							prd.id='pd'+rid;//
							prd.readOnly = true;
							prd.style="text-align:center";  
							prd.style.width="100%";
							prd.style.border="hidden"; 
							cell.appendChild(prd);
				var priidid = document.createElement("input");
							priidid.type="hidden";
							priidid.border ="0";
							priidid.value=pri_id;	
							priidid.name='main_id[]';//
							priidid.id='main_id'+rid;//
							priidid.readOnly = true;
							priidid.style="text-align:center";  
							priidid.style.width="100%";
							priidid.style.border="hidden"; 
							cell.appendChild(priidid);
	
	//============================close item text ============================
	
		//============================item text ============================
					indexcell=Number(indexcell+1);		
					var cell=cell+indexcell;
					cell = row.insertCell(indexcell);
					cell.style.width="3%";
					cell.align="center"		
		
				var prd = document.createElement("input");
							prd.type="text";
							prd.border ="0";
							prd.value=desc1;	
							prd.name='desc1[]';//
							prd.id='desc1'+rid;//
							prd.readOnly = true;
							prd.style="text-align:center";  
							prd.style.width="100%";
							prd.style.border="hidden"; 
							cell.appendChild(prd);
							
				indexcell=Number(indexcell+1);		
					var cell=cell+indexcell;
					cell = row.insertCell(indexcell);
					cell.style.width="3%";
					cell.align="center"	
							
				var priidid = document.createElement("input");
							priidid.type="text";
							priidid.border ="0";
							priidid.value=desc2;	
							priidid.name='desc2[]';//
							priidid.id='desc2'+rid;//
							priidid.readOnly = true;
							priidid.style="text-align:center";  
							priidid.style.width="100%";
							priidid.style.border="hidden"; 
							cell.appendChild(priidid);
	
	//============================close item text ============================
							
					indexcell=Number(indexcell+1);		
					var cell=cell+indexcell;
					cell = row.insertCell(indexcell);
					cell.style.width="3%";
					cell.align="center"		
							var unitt = document.createElement("input");
							unitt.type="text";
							unitt.border ="0";
							unitt.value=getmain_loc_name;	
							unitt.name='getmain_loc_name[]';//
							unitt.id='getmain_loc_name'+rid;//
							unitt.readOnly = true;
							unitt.style="text-align:center";  
							unitt.style.width="100%";
							unitt.style.border="hidden"; 
							cell.appendChild(unitt);
					
						// ends here
						var categ = document.createElement("input");
							categ.type="hidden";
							categ.border ="0";
							categ.value=main_loc;	
							categ.name='main_loc[]';//
							categ.id='main_loc'+rid;//
							categ.readOnly = true;
							categ.style="text-align:center";  
							categ.style.width="100%";
							categ.style.border="hidden"; 
							cell.appendChild(categ);
	
	//#################cell 2nd starts here####################//
	
	
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;
        cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center"
				var salepr = document.createElement("input");
							salepr.type="text";
							salepr.border ="0";
							salepr.value=get_location_name;	    
							salepr.name ='get_location_name[]';
							salepr.id='get_location_name'+rid;
							salepr.readOnly = true;
							salepr.style="text-align:center";
							salepr.style.width="100%";
							salepr.style.border="hidden"; 
							cell.appendChild(salepr);
	
	// ends here
						var categ = document.createElement("input");
							categ.type="hidden";
							categ.border ="0";
							categ.value=location_id;	
							categ.name='location_id[]';//
							categ.id='location_id'+rid;//
							categ.readOnly = true;
							categ.style="text-align:center";  
							categ.style.width="100%";
							categ.style.border="hidden"; 
							cell.appendChild(categ);
	
		//==============================close 2nd cell =========================================
		
		//#################cell 3rd starts here####################//					
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;		
	    cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center"
		//========================================start qnty===================================	
				var qtty = document.createElement("input");
							qtty.type="text";
							qtty.border ="0";
							qtty.value=get_rack_id_name;	    
							qtty.name ='get_rack_id_name[]';
							qtty.id='get_rack_id_name'+rid;
							qtty.readOnly = true;
							qtty.style="text-align:center";
							qtty.style.width="100%";
							qtty.style.border="hidden"; 
							cell.appendChild(qtty);
				
				// ends here
						var categ = document.createElement("input");
							categ.type="hidden";
							categ.border ="0";
							categ.value=rack_id;	
							categ.name='rack_id[]';//
							categ.id='rack_id'+rid;//
							categ.readOnly = true;
							categ.style="text-align:center";  
							categ.style.width="100%";
							categ.style.border="hidden"; 
							cell.appendChild(categ);
					
		//======================================close 3rd cell========================================
		
		indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;		
	    cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center"
		//========================================start total qnty===================================	
				var qttytotal = document.createElement("input");
							qttytotal.type="text";
							qttytotal.border ="0";
							qttytotal.value=quantity_idd;	    
							qttytotal.name ='quantity_idd[]';
							qttytotal.id='quantity_idd'+rid;
							qttytotal.readOnly = true;
							qttytotal.style="text-align:center";
							qttytotal.style.width="100%";
							qttytotal.style.border="hidden"; 
							cell.appendChild(qttytotal);
				
				
		//======================================close 4rd cell========================================
		
//========================================================
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;		
	    cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center"
		//========================================start total qnty===================================	
				var qttytotal = document.createElement("input");
							qttytotal.type="text";
							qttytotal.border ="0";
							qttytotal.value=get_main_loc_two_name;	    
							qttytotal.name ='get_main_loc_two_name[]';
							qttytotal.id='get_main_loc_two_name'+rid;
							qttytotal.readOnly = true;
							qttytotal.style="text-align:center";
							qttytotal.style.width="100%";
							qttytotal.style.border="hidden"; 
							cell.appendChild(qttytotal);
				
				// ends here
						var categ = document.createElement("input");
							categ.type="hidden";
							categ.border ="0";
							categ.value=main_loc_two;	
							categ.name='main_loc_two[]';//
							categ.id='main_loc_two'+rid;//
							categ.readOnly = true;
							categ.style="text-align:center";  
							categ.style.width="100%";
							categ.style.border="hidden"; 
							cell.appendChild(categ);
													
		//======================================close 4rd cell========================================
		
		
		indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;		
	    cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center"
		//========================================start total qnty===================================	
				var qttytotal = document.createElement("input");
							qttytotal.type="text";
							qttytotal.border ="0";
							qttytotal.value=get_location_two_id_name;	    
							qttytotal.name ='get_location_two_id_name[]';
							qttytotal.id='get_location_two_id_name'+rid;
							qttytotal.readOnly = true;
							qttytotal.style="text-align:center";
							qttytotal.style.width="100%";
							qttytotal.style.border="hidden"; 
							cell.appendChild(qttytotal);
				
				// ends here
						var categ = document.createElement("input");
							categ.type="hidden";
							categ.border ="0";
							categ.value=location_two_id;	
							categ.name='location_two_id[]';//
							categ.id='location_two_id'+rid;//
							categ.readOnly = true;
							categ.style="text-align:center";  
							categ.style.width="100%";
							categ.style.border="hidden"; 
							cell.appendChild(categ);
																	
		//======================================close 4rd cell========================================
		
		indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;		
	    cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center"
		//========================================start total qnty===================================	
				var qttytotal = document.createElement("input");
							qttytotal.type="text";
							qttytotal.border ="0";
							qttytotal.value=get_div_rack_id_name;	    
							qttytotal.name ='get_div_rack_id_name[]';
							qttytotal.id='get_div_rack_id_name'+rid;
							qttytotal.readOnly = true;
							qttytotal.style="text-align:center";
							qttytotal.style.width="100%";
							qttytotal.style.border="hidden"; 
							cell.appendChild(qttytotal);
				
				// ends here
						var categ = document.createElement("input");
							categ.type="hidden";
							categ.border ="0";
							categ.value=rack_two_id;	
							categ.name='rack_two_id[]';//
							categ.id='rack_two_id'+rid;//
							categ.readOnly = true;
							categ.style="text-align:center";  
							categ.style.width="100%";
							categ.style.border="hidden"; 
							cell.appendChild(categ);
													
		//======================================close 4rd cell========================================
		
		indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;		
	    cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center"
		//========================================start total qnty===================================	
				var qttytotal = document.createElement("input");
							qttytotal.type="text";
							qttytotal.border ="0";
							qttytotal.value=entQty;	    
							qttytotal.name ='entQty[]';
							qttytotal.id='entQty'+rid;
							qttytotal.readOnly = true;
							qttytotal.style="text-align:center";
							qttytotal.style.width="100%";
							qttytotal.style.border="hidden"; 
							cell.appendChild(qttytotal);
								
		//======================================close 4rd cell========================================
					
//=========================================================	========================================================	
		//cell 3st
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;
	var imageloc="/mr_bajaj/";
	var cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.style.display="none";
				cell.align="center";
				var delt =document.createElement("img");
						delt.src ="<?=base_url();?>assets/images/delete.png";
						delt.class ="icon";
						delt.border ="0";
						delt.style.width="30%";
						delt.style.height="20%";
						delt.name ='dlt';
						delt.id='dlt'+rid;
						delt.style.border="hidden"; 
						delt.onclick= function() { deleteselectrow(delt.id,delt); };
					    cell.appendChild(delt);
	var edt = document.createElement("img");
						edt.src ="<?=base_url();?>/assets/images/edit.png";
						edt.class ="icon";
						edt.style.width="60%";
						edt.style.height="40%";
						edt.border ="0";
						edt.name ='ed';
						edt.id='ed'+rid;
						edt.style.border="hidden"; 
						edt.onclick= function() { editselectrow(delt.id,edt); };
						cell.appendChild(edt);
			

			
			}
			else
			{
			if(qn==0)
				{
					alert('***Quantity Can not be Zero ***');
					
					
				}
				else
				{
				
			alert('***Please Select PRODUCT ***');
			
			}
			}

function clear()
{

// this finction is use for clear data after adding invoice
		document.getElementById("prd").value='';
		document.getElementById("desc1").value='';
		document.getElementById("desc2").value='';
		document.getElementById("main_loc").value='';
		document.getElementById("location_id").value='';
		document.getElementById("div_loc_id").value ='';
		document.getElementById("quantity_idd").value='';
		document.getElementById("main_loc_two").value='';		
		document.getElementById("location_two_id").value='';
		document.getElementById("div_rack_id").value='';
		document.getElementById("entQty").value='';		
		document.getElementById("pri_id").value='';
		document.getElementById("prdsrch").innerHTML=" ";
		document.getElementById("prd").focus();	
		
		
}


////////////////////////////////// starts edit code ////////////////////////////////


function editselectrow(d,r) //modify dyanamicly created rows or product detail
 {
 
var regex = /(\d+)/g;
nn= d.match(regex)
id=nn;
if(document.getElementById("prd").value!=''){
document.getElementById("qn").focus();
alert("Product already in edit Mode");
return false;
}


// ####### starts ##############//
var pd=document.getElementById("pd"+id).value;
		var unit=document.getElementById("unit"+id).value;
		var qn=document.getElementById("qnty"+id).value;
		var lph=document.getElementById("lph"+id).value;
		
		var pri_id=document.getElementById("main_id"+id).value;
// ####### ends ##############//

// ####### starts ##############//
document.getElementById("pri_id").value=pri_id;
document.getElementById("qn").focus();
document.getElementById("prd").value=pd;
document.getElementById("usunit").value=unit;
document.getElementById("qn").value=qn;


// ####### ends ##############//
editDeleteCalculation();

    var i = r.parentNode.parentNode.rowIndex;
	document.getElementById("invoice").deleteRow(i);
}

////////////////////////////////// ends edit code ////////////////////////////////


////////////////////////////////// starts delete code ////////////////////////////////

function deleteselectrow(d,r) //delete dyanamicly created rows or product detail
 {
 
var regex = /(\d+)/g;

nn= d.match(regex)
	id=nn;
	if(document.getElementById("prd").value!=''){
 		document.getElementById("qn").focus();
     alert("Product already in edit Mode");
return false;
}


		var pd=document.getElementById("pd"+id).value;
		var unit=document.getElementById("unit"+id).value;
		var qn=document.getElementById("qnty"+id).value;
		var lph=document.getElementById("lph"+id).value;
		
		var pri_id=document.getElementById("main_id"+id).value;

	    var i = r.parentNode.parentNode.rowIndex;
     var cnf = confirm('Are You Sure..??? you want to Delete line no1.'+(id));
if (cnf== true)
 {
 document.getElementById("invoice").deleteRow(i);
  slr();
  
 editDeleteCalculation();
	serviceChargeCal();	
	grossDiscountCal();
	}
	
	}
////////////////////////////////// ends delete code ////////////////////////////////


function totalSum(){

var subb=document.getElementById("sub_total").value;
			var tol=(Number(nettot));
			var total=Number(tol)+Number(subb);
	
			document.getElementById("sub_total").value=total.toFixed(2);
			document.getElementById("grand_total").value=total.toFixed(2);	

}

// ###### starts when item we edit or delete ##########//
function editDeleteCalculation()
{
var sub_total=document.getElementById("sub_total").value;

sub_total_cal=sub_total-nettot;
document.getElementById("sub_total").value=sub_total_cal.toFixed(2);
document.getElementById("grand_total").value=sub_total_cal.toFixed(2);
}
// ##### ends ###########

   }

// ###### starts service charge calculation ##########//
function serviceChargeCal()
{

var sub_total=document.getElementById("sub_total").value;
var service_charge=document.getElementById("service_charge").value;

service_total_per=Number(sub_total)*Number(service_charge)/100;
service_total_cal=Number(sub_total)+Number(service_total_per);

document.getElementById("service_charge_total").value=service_total_per.toFixed(2);
document.getElementById("grand_total").value=service_total_cal.toFixed(2);
return service_total_cal.toFixed(2);
}
// ##### ends ###########
  

// ###### starts gross discount calculation ##########//
function grossDiscountCal()
{

var serviceTotl=serviceChargeCal();

var gross_discount_per=document.getElementById("gross_discount_per").value;
var gross_discount_total=document.getElementById("gross_discount_total").value;
var grand_total=document.getElementById("grand_total").value;


service_total_per=Number(serviceTotl)*Number(service_charge)/100;
service_total_cal=Number(sub_total)+Number(service_total_per);

var totalGross=Number(serviceTotl)*Number(gross_discount_per)/100;
var totalGrossCal=Number(grand_total)-Number(totalGross);

document.getElementById("gross_discount_total").value=totalGross.toFixed(2);
document.getElementById("grand_total").value=totalGrossCal.toFixed(2);
}
// ##### ends ###########

  function openProduct()
  {
 
  newwindow=window.open('<?=base_url();?>PriceMapping/all_product_function?&popup=True&id='+1,'name','height=500,width=1200');
if (window.focus) {newwindow.focus()}
return false;

 // openpopup('<?=base_url();?>SalesOrder/all_product_function',1200,500,'view',<?=$sales[$i]['1'];?>)
  //alert();
  }    
</script>


<script>
function getdataCln()
{
	
alert();	
}
</script>
</form>
<?php
$this->load->view("footer.php");
?>

