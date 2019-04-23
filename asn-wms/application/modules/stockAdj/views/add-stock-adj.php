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

<form id="f1" name="f1" method="POST" action="insertStockAdj" onSubmit="return checkKeyPressed(a)" enctype="multipart/form-data">
<!-- Main content -->
	<div class="main-content">
		
		
		<?php if(@$_GET['popup'] == 'True') {} else {?>
		<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
				<li><a href="#">Stock In</a></li> 
				
				<li class="active"><strong><a href="#">Add Stock Adjustment</a></strong></li> 
			</ol>
		<?php }?>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h4 class="panel-title"><strong>Add Adjustment</strong></h4>
							<ul class="panel-tool-options"> 
								<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							</ul>
						</div>
<div class="panel-body">

<div class="row">
<div class="panel-body">

<div class="form-group"> 
<label class="col-sm-2 control-label">*Transation No.:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="transation_no" value="<?php echo $branchFetch->transation_no; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" required>
</div>  
<label class="col-sm-2 control-label">*DATE:</label> 
<div class="col-sm-4" id="regid"> 
<input type="date"  name="date" value="<?php echo $branchFetch->date; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" required>
</div> 
</div>



</div>
</div>

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
<th>Adjustment</th>

<th>Quantity</th>

</tr>

<tr class="gradeA">
<th>
<div class="input-group"> 
<div>
<input type="text" name="prd"  onkeyup="getdata()" class="form-control" onClick="getdata()" id="prd" placeholder=" Search Items..." tabindex="5" >
 <input type="hidden"  name="pri_id" id='pri_id'  value="" style="width:80px;"  />
</div>

</div>
<div id="prdsrch" style="color:black;padding-left:0px; width:30%; height:110px; max-height:110px;overflow-x:auto;overflow-y:auto;padding-bottom:5px;padding-top:0px; position:absolute;">
<?php
//include("getproduct.php");
$this->load->view('getproduct');

?>
</div>
</th>
<th>
<input type="text" readonly="" id="des1" class="form-control"> 
</th>
<th>
<input type="text" readonly="" id="des2" class="form-control"> 
</th>
<th>
<select id="loc" class="form-control" onchange="getLoc(this.value)">
<option value="">----select----</option>
<?php $locQuery=$this->db->query("select * from tbl_location order by 'id' asc");
foreach($locQuery->result() as $getLoc){?>
<option value="<?php echo $getLoc->id;?>"><?php echo $getLoc->location_name;?></option>
<?php }?>
</select> 
<input type="hidden" id="loc_id" value="" class="form-control">
</th>

<th>
<select id="pallet" class="form-control" onchange="getPallet(this.value)"> 
<option value="">----select----</option>
<?php $palletQuery=$this->db->query("select * from tbl_master_data where param_id='29'");
foreach($palletQuery->result() as $getPallet){?>
<option value="<?php echo $getPallet->serial_number;?>"><?php echo $getPallet->keyvalue;?></option>
<?php }?>
</select>
<input type="hidden" id="pallet_id" value="" class="form-control">
</th>


<th><select id="rack" class="form-control" onchange="getRack(this.value)">
<option value="">----select----</option>
<?php $rackQuery=$this->db->query("select * from tbl_location_rack order by 'id' asc");
foreach($rackQuery->result() as $getRack){?>
<option value="<?php echo $getRack->id;?>"><?php echo $getRack->rack_name;?></option>
<?php }?>
</select> 
<input type="hidden" id="rack_id" value="" class="form-control">
</th>

<th><select name="adjustment" id="adjustment" class="form-control">
<option value="">--Select--</option>
<option value="Plus">+</option>
<option value="Minus">-</option>

</select>
</th>

<th><input type="number" id="qn" min="1" class="form-control"></th>




</tr>
</tbody>
</table>
</div>
<div style="width:100%; background:#dddddd; padding-left:0px; color:#000000; border:2px solid ">
<table id="invo" style="width:100%;  background:#dddddd;  height:70%;" title="Invoice"  >
<tr>
<td style="width:1%;"><div align="center"><u>Sl No</u>.</div></td>
<td style="width:3%;"><div align="center"><u>Product Code</u></div></td>
<td style="width:7%;"><div align="center"><u>Description1</u></div></td>
<td style="width:8%;"><div align="center"><u>Description2</u></div></td>
<td style="width:3%;"> <div align="center"><u>Main Location</u></div></td>
<td style="width:3%;"><div align="center"><u>Location</u></div></td>
<td style="width:3%;"> <div align="center"><u>Rack</u></div></td>
<td style="width:3%;"> <div align="center"><u>Adjustment</u></div></td>
<td style="width:3%;"> <div align="center"><u>Quantity</u></div></td>
<td style="width:3%;"> <div align="center"><u>Action</u></div></td>
</tr>
</table>


<div style="width:100%; background:white;   color:#000000;  max-height:170px; overflow-x:auto;overflow-y:auto;" id="m">
<table id="invoice"  style="width:100%;background:white;margin-bottom:0px;margin-top:0px;min-height:30px;" title="Invoice" class="table table-bordered blockContainer lineItemTable ui-sortable"  >

<tr></tr>
</table>
</div>
</div>
<div class="table-responsive">
<table>
<tr class="gradeA">
<th>

<th>&nbsp;</th>
<th>&nbsp;</th>
</tr>
</table>
</div>

<input class="btn btn-primary" type="button" value="SAVE"   id="sv1" onclick="fsv(this)" >

<input type="hidden" name="rows" id="rows">
<!--//////////ADDING TEST/////////-->
<input type="hidden" name="spid" id="spid" value="d1"/>
<input type="hidden" name="ef" id="ef" value="0" />


</div>
</div>
</div>
<script>
//add item into showling list
function getLoc(loc){
//alert(loc);
document.getElementById("loc_id").value=loc;	
}
function getPallet(pallet){
document.getElementById("pallet_id").value=pallet;
//var location=document.getElementById("loc").value;
//alert(location);
		var strURL="get_rack?prorack="+pallet;

		var req = getXMLHTTP();

		if (req) {

			req.onreadystatechange = function() {

				if (req.readyState == 4) {

					if (req.status == 200) {

					//var price=mtr*ext_per;
					//alert(req.responseText);
						document.getElementById('rack').innerHTML=req.responseText;
							
										
//alert(idm);

					} else {

						alert("There was a problem while using XMLHTTP:\n" + req.statusText);

					}

				}				

			}			

			req.open("GET", strURL, true);

			req.send(null);

		}
}
function getRack(rack){
document.getElementById("rack_id").value=rack;
}
window.addEventListener("keydown", checkKeyPressed, false);
//funtion to select product
function checkKeyPressed(e) {
var s=e.keyCode;

var ppp=document.getElementById("prd").value;
var pri=document.getElementById("pri_id").value;
var sspp=document.getElementById("spid").value;//
var ef=document.getElementById("ef").value;
		ef=Number(ef);
		
var countids=document.getElementById("countid").value;

//if(countids==''){
//countids=1;
//}

for(n=1;n<=countids;n++)
{


document.getElementById("tyd"+n).onkeyup  = function (e) {
var entr =(e.keyCode);
if(entr==13){
//alert(pri);
document.getElementById("loc").focus();
document.getElementById("prdsrch").innerHTML=" ";

}
}
}

document.getElementById("loc").onkeydown = function (e) {
var entr =(e.keyCode);
if(entr==13){
var check=document.getElementById("loc").value;
if(check!=''){
document.getElementById("pallet").focus();
}else{
alert("first fill Main Location");
document.getElementById("loc").focus();
}
}
}



document.getElementById("pallet").onkeydown = function (e) {
var entr =(e.keyCode);
if(entr==13){
var check=document.getElementById("pallet").value;
if(check!=''){
document.getElementById("rack").focus();
}else{
alert("first fill Location");
document.getElementById("pallet").focus();
}
}
}

document.getElementById("rack").onkeydown = function (e) {
var entr =(e.keyCode);
if(entr==13){
var check=document.getElementById("rack").value;
if(check!=''){
document.getElementById("adjustment").focus();
}else{
alert("first fill Rack");
document.getElementById("rack").focus();
}
}
}

document.getElementById("adjustment").onkeydown = function (e) {
var entr =(e.keyCode);
if(entr==13){
var check=document.getElementById("adjustment").value;
if(check!=''){
document.getElementById("qn").focus();
}else{
alert("first select Adjustment");
document.getElementById("adjustment").focus();
}
}
}



document.getElementById("qn").onkeydown = function (e) {
var entr =(e.keyCode);
if(document.getElementById("qn").value=="" && entr==08){
//alert("Quantity");
}

   if (e.keyCode == "13")
	 {
	
	 e.preventDefault();
     e.stopPropagation();
	
	  if(ppp!=='' || ef==1)
	 {
		var check=document.getElementById("qn").value;
		if(check!=''){
	
			adda();	  	
			
		}else{
		alert("Quantity can't be Zero");
		document.getElementById("qn").focus;
		}
			
		
		var ddid=document.getElementById("spid").value;
		var ddi=document.getElementById(ddid);
		ddi.id="d";
		
			}
	       else
			{
	   alert("Enter Correct Product");
			}
		return false;
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



//////////////////////////////////////////////////////////////



     var rw=0;
	 
 function adda()
		  { 
		   		 

				var qn=document.getElementById("qn").value;
				var pallet=document.getElementById('pallet').options[document.getElementById('pallet').selectedIndex].text;
				var rack=document.getElementById('rack').options[document.getElementById('rack').selectedIndex].text;
				var loc=document.getElementById('loc').options[document.getElementById('loc').selectedIndex].text;
				var loc_id=document.getElementById("loc_id").value;
				var pallet_id=document.getElementById("pallet_id").value;
				var rack_id=document.getElementById("rack_id").value;
				var des1=document.getElementById("des1").value;
				var des2=document.getElementById("des2").value;
				var adjustment=document.getElementById("adjustment").value;
			  	
			
				
				//default
				var rows=document.getElementById("rows").value;
				var pri_id=document.getElementById("pri_id").value;
				var pd=document.getElementById("prd").value;
		   	   var table = document.getElementById("invoice");
					var rid =Number(rows)+1;
					document.getElementById("rows").value=rid;
					
						
							//totalSum();	
							//serviceChargeCal();
							//grossDiscountCal();	
							//alert("alert1");			
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
				
				
				//cell 1st item name
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;	
			
	    cell = row.insertCell(indexcell);
				cell.style.width="3%";
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
	////======================end 1st cell=====================================
		////======================start 2nd cell=====================================	
		
		
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;
        cell = row.insertCell(indexcell);
				cell.style.width="7%";
				//cell.style.display="none";
				cell.align="center"
				var desS = document.createElement("input");
							desS.type="text";
							desS.border ="0";
							desS.value=des1;	    
							desS.name ='des1[]';
							desS.id='des1'+rid;
							desS.readOnly = true;
							desS.style="text-align:center";
							desS.style.width="100%";
							desS.style.border="hidden"; 
							cell.appendChild(desS);
					
	
	//########s#########//
	
	
	
	
	
	//#################cell 3nd starts here####################//
	
	
	
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;
        cell = row.insertCell(indexcell);
				cell.style.width="8%";
				//cell.style.display="none";
				cell.align="center"
				var desS1 = document.createElement("input");
							desS1.type="text";
							desS1.border ="0";
							desS1.value=des2;	    
							desS1.name ='des2[]';
							desS1.id='des2'+rid;
							desS1.readOnly = true;
							desS1.style="text-align:center";
							desS1.style.width="100%";
							desS1.style.border="hidden"; 
							cell.appendChild(desS1);

		//==========================cell 4th starts here=======================		
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;
        cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center"
				var locNmae = document.createElement("input");
							locNmae.type="text";
							locNmae.border ="0";
							locNmae.value=loc;	    
							locNmae.name ='loc_name[]';
							locNmae.id='loc_name'+rid;
							locNmae.readOnly = true;
							locNmae.style="text-align:center";
							locNmae.style.width="100%";
							locNmae.style.border="hidden"; 
							cell.appendChild(locNmae);
				var locidid = document.createElement("input");
							locidid.type="hidden";
							locidid.border ="0";
							locidid.value=loc_id;	
							locidid.name='locId[]';//
							locidid.id='locId'+rid;//
							locidid.readOnly = true;
							locidid.style="text-align:center";  
							locidid.style.width="100%";
							locidid.style.border="hidden"; 
							cell.appendChild(locidid);
					
						// ends here
	
	
	//#################cell 5nd starts here####################//
	
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;
        cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center"				
							var pallett = document.createElement("input");
							pallett.type="text";
							pallett.border ="0";
							pallett.value=pallet;	
							pallett.name='pallet_name[]';//
							pallett.id='pallet_name'+rid;//
							pallett.readOnly = true;
							pallett.style="text-align:center";  
							pallett.style.width="100%";
							pallett.style.border="hidden"; 
							cell.appendChild(pallett);
				var palletid = document.createElement("input");
							palletid.type="hidden";
							palletid.border ="0";
							palletid.value=pallet_id;	
							palletid.name='palletId[]';//
							palletid.id='palletId'+rid;//
							palletid.readOnly = true;
							palletid.style="text-align:center";  
							palletid.style.width="100%";
							palletid.style.border="hidden"; 
							cell.appendChild(palletid);
	
	
		//=============end here=========================================
	//=============start 6th cell here=========================================
	
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;
        cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center"
				var rackkk = document.createElement("input");
							rackkk.type="text";
							rackkk.border ="0";
							rackkk.value=rack;	    
							rackkk.name ='rack_name[]';
							rackkk.id='rack_name'+rid;
							rackkk.readOnly = true;
							rackkk.style="text-align:center";
							rackkk.style.width="100%";
							rackkk.style.border="hidden"; 
							cell.appendChild(rackkk);
				var rackid = document.createElement("input");
							rackid.type="hidden";
							rackid.border ="0";
							rackid.value=rack_id;	
							rackid.name='rackId[]';//
							rackid.id='rackId'+rid;//
							rackid.readOnly = true;
							rackid.style="text-align:center";  
							rackid.style.width="100%";
							rackid.style.border="hidden"; 
							cell.appendChild(rackid);
					

	//=======================end here=======================================
	
	
		//==============================start 7th cell =========================================
					
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;		
	    cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center"
				var adjustmentt = document.createElement("input");
							adjustmentt.type="text";
							adjustmentt.border ="0";
							adjustmentt.value=adjustment;	    
							adjustmentt.name ='adjustment[]';
							adjustmentt.id='adjustment'+rid;
							adjustmentt.readOnly = true;
							adjustmentt.style="text-align:center";
							adjustmentt.style.width="100%";
							adjustmentt.style.border="hidden"; 
							cell.appendChild(adjustmentt);
								

		//======================================close 7th cell========================================

	
	
	
		//==============================start 7th cell =========================================
					
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;		
	    cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center"
				var qtty = document.createElement("input");
							qtty.type="text";
							qtty.border ="0";
							qtty.value=qn;	    
							qtty.name ='qty[]';
							qtty.id='qnty'+rid;
							qtty.readOnly = true;
							qtty.style="text-align:center";
							qtty.style.width="100%";
							qtty.style.border="hidden"; 
							cell.appendChild(qtty);
								

		//======================================close 7th cell========================================
					
		//=====================start here============================
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;
	var imageloc="/mr_bajaj/";
	var cell = row.insertCell(indexcell);
				cell.style.width="3%";
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
			
	//=====================end here=======================================
			
			}
			else
			{
			if(qn==0)
				{
					alert('***Quantity Can not be Zero ***');
					document.getElementById("qn").focus;
					
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
		document.getElementById("pallet").value='';
		document.getElementById("rack").value='';
		document.getElementById("loc_id").value='';
		document.getElementById("pallet_id").value='';
		document.getElementById("rack_id").value='';
		
		document.getElementById("qn").value='';
		document.getElementById("pri_id").value='';
		document.getElementById("loc").value='';
		document.getElementById("des1").value='';
		document.getElementById("des2").value='';
		
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
		var palletId=document.getElementById("palletId"+id).value;
		var qn=document.getElementById("qnty"+id).value;
		var rackId=document.getElementById("rackId"+id).value;
		var des1=document.getElementById("des1"+id).value;
		var des2=document.getElementById("des2"+id).value;
		
		
		
		var locId=document.getElementById("locId"+id).value;
		
		
		var pri_id=document.getElementById("main_id"+id).value;
// ####### ends ##############//

// ####### starts ##############//
document.getElementById("pri_id").value=pri_id;
document.getElementById("qn").focus();
document.getElementById("prd").value=pd;
document.getElementById("pallet").value=palletId;
document.getElementById("qn").value=qn;
document.getElementById("rack").value=rackId;
document.getElementById("loc").value=locId;
document.getElementById("des1").value=des1;
document.getElementById("des2").value=des2;


// ####### ends ##############//
//editDeleteCalculation();

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
		var pallet_name=document.getElementById("pallet_name"+id).value;
		var qn=document.getElementById("qnty"+id).value;
		var rack_name=document.getElementById("rack_name"+id).value;
		var loc_name=document.getElementById("loc_name"+id).value;


		

		
		var pri_id=document.getElementById("main_id"+id).value;

	    var i = r.parentNode.parentNode.rowIndex;
     var cnf = confirm('Are You Sure..??? you want to Delete line no1.'+(id));
if (cnf== true)
 {
 document.getElementById("invoice").deleteRow(i);
  slr();
  
 //editDeleteCalculation();
	//serviceChargeCal();	
	//();
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



   }



      
</script>


</form>



<?php
$this->load->view("footer.php");
?>