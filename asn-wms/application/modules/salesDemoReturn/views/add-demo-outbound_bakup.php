<body>
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

//if(countids==''){
//countids=1;
//}

for(n=1;n<=countids;n++)
{


document.getElementById("tyd"+n).onkeyup  = function (e) {
var entr =(e.keyCode);
if(entr==13){
	
	
document.getElementById("main_loc").focus();
document.getElementById("prdsrch").innerHTML=" ";

}
}
}

document.getElementById("main_loc").onkeydown = function (e) {
var entr =(e.keyCode);
if(entr==13){

document.getElementById("loc").focus();
}
}



document.getElementById("loc").onkeydown = function (e) {
var entr =(e.keyCode);
if(entr==13){

document.getElementById("rack_id").focus();
}
}





document.getElementById("rack_id").onkeydown = function (e) {
var entr =(e.keyCode);
if(entr==13){

var rack_id=document.getElementById("rack_id").value;
if(rack_id=='')
{
alert("Please Select Rack");	
document.getElementById("rack_id").focus();
}
else{
document.getElementById("qn").focus();
}

}
}



document.getElementById("qn").onkeydown = function (e) {
var entr =(e.keyCode);
if(entr==13){

document.getElementById("qty_stock").focus();
}
}







document.getElementById("qty_stock").onkeyup = function (e) {
var entr =(e.keyCode);
if(document.getElementById("qty_stock").value=="" && entr==08){

}
   if (e.keyCode == "13")
	 {
	
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
				var unit=document.getElementById("usunit").value;
				var hsn_code=document.getElementById("hsn_code").value;
				var main_loc=document.getElementById("main_loc").value;	
				var loc=document.getElementById("loc").value;		
		        var rack_id=document.getElementById("rack_id").value;
				var qn=document.getElementById("qn").value;
				var qty_stock=document.getElementById("qty_stock").value;
				var des1=document.getElementById("des1").value;
				var des2=document.getElementById("des2").value;
				
			
				
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
				cell.style.width="4%";
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
							
							
							var unitt = document.createElement("input");
							unitt.type="hidden";
							unitt.border ="0";
							unitt.value=unit;	
							unitt.name='unit[]';//
							unitt.id='unit'+rid;//
							unitt.readOnly = true;
							unitt.style="text-align:center";  
							unitt.style.width="100%";
							unitt.style.border="hidden"; 
							cell.appendChild(unitt);
					
						// ends here
	
	
	//#################cell 2nd starts here####################//
	
	
	
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;
        cell = row.insertCell(indexcell);
				cell.style.width="8%";
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
	
	
	
	
	
	//#################cell 2nd starts here####################//
	
	
	
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
					
	
	//########s#########//
	
	//#################cell 2nd starts here####################//
	
	
	
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;
        cell = row.insertCell(indexcell);
				cell.style.width="3%";
				//cell.style.display="none";
				cell.align="center"
				var hsn_codeS = document.createElement("input");
							hsn_codeS.type="text";
							hsn_codeS.border ="0";
							hsn_codeS.value=hsn_code;	    
							hsn_codeS.name ='hsn_code[]';
							hsn_codeS.id='hsn_code'+rid;
							hsn_codeS.readOnly = true;
							hsn_codeS.style="text-align:center";
							hsn_codeS.style.width="100%";
							hsn_codeS.style.border="hidden"; 
							cell.appendChild(hsn_codeS);
					
	
	//########s#########//
	
	
	
	
	
	//#################cell 2nd starts here####################//
	
	
	
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;
        cell = row.insertCell(indexcell);
				cell.style.width="3%";
				//cell.style.display="none";
				cell.align="center"
				var main_locS = document.createElement("input");
							main_locS.type="text";
							main_locS.border ="0";
							main_locS.value=main_loc;	    
							main_locS.name ='main_loc[]';
							main_locS.id='main_loc'+rid;
							main_locS.readOnly = true;
							main_locS.style="text-align:center";
							main_locS.style.width="100%";
							main_locS.style.border="hidden"; 
							cell.appendChild(main_locS);
					
	
	//########s#########//
	
	
	
	//########s#########//
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;
        cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center"
				var locS = document.createElement("input");
							locS.type="text";
							locS.border ="0";
							locS.value=loc;	    
							locS.name ='loc[]';
							locS.id='loc'+rid;
							locS.readOnly = true;
							locS.style="text-align:center";
							locS.style.width="100%";
							locS.style.border="hidden"; 
							cell.appendChild(locS);
					

	
	
	
	
	
		//==============================close 2nd cell =========================================
	
	//===================================start 4th cell================================
		indexcell=Number(indexcell+1);		
		var cell=cell+indexcell;		
	    cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center"	
				
												
				var rack_idS = document.createElement("input");
							rack_idS.type="text";
							rack_idS.border ="0";
							rack_idS.value=rack_id;	
							rack_idS.name ='rack_id[]';
							rack_idS.id='rack_id'+rid;
							rack_idS.readOnly = true;
							rack_idS.style="text-align:center";
							rack_idS.style.width="100%";
							rack_idS.style.border="hidden"; 
							cell.appendChild(rack_idS);
		//===============================close 4th cell=================================

	
	
		
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
							qtty.value=qn;	    
							qtty.name ='qty[]';
							qtty.id='qnty'+rid;
							qtty.readOnly = true;
							qtty.style="text-align:center";
							qtty.style.width="100%";
							qtty.style.border="hidden"; 
							cell.appendChild(qtty);
								
		//======================================close 3rd cell========================================
		
		
		
	
	//#################cell 2nd starts here####################//
	
	
	
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;
        cell = row.insertCell(indexcell);
				cell.style.width="3%";
				//cell.style.display="none";
				cell.align="center"
				var qty_stockK = document.createElement("input");
							qty_stockK.type="text";
							qty_stockK.border ="0";
							qty_stockK.value=qty_stock;	    
							qty_stockK.name ='qty_stock[]';
							qty_stockK.id='qty_stock'+rid;
							qty_stockK.readOnly = true;
							qty_stockK.style="text-align:center";
							qty_stockK.style.width="100%";
							qty_stockK.style.border="hidden"; 
							cell.appendChild(qty_stockK);
					
	//###########33	
		
		
		
		
		
		
		
		
		
		
		
		//cell 3st
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
						//delt.style.width="30%";
						//delt.style.height="20%";
						delt.name ='dlt';
						delt.id='dlt'+rid;
						delt.style.border="hidden"; 
						delt.onclick= function() { deleteselectrow(delt.id,delt); };
					    cell.appendChild(delt);
	var edt = document.createElement("img");
						edt.src ="<?=base_url();?>/assets/images/edit.png";
						edt.class ="icon";
						//edt.style.width="60%";
						//edt.style.height="40%";
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
		document.getElementById("usunit").value='';
		document.getElementById("hsn_code").value='';
		//document.getElementById("main_loc").value ='';
		//document.getElementById("loc").value='';
		//document.getElementById("rack_id").value='';
		document.getElementById("qn").value='';
		document.getElementById("pri_id").value='';
		document.getElementById("qty_stock").value='';
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

		var unit=document.getElementById("unit"+id).value;
		var qn=document.getElementById("qnty"+id).value;
		var hsn_code=document.getElementById("hsn_code"+id).value;
		var main_loc=document.getElementById("main_loc"+id).value;
		var loc=document.getElementById("loc"+id).value;
		var rack_id=document.getElementById("rack_id"+id).value;
		var qty_stock=document.getElementById("qty_stock"+id).value;
		var des1=document.getElementById("des1"+id).value;
		var des2=document.getElementById("des2"+id).value;
		var pri_id=document.getElementById("main_id"+id).value;

// ####### ends ##############//

// ####### starts ##############//
document.getElementById("pri_id").value=pri_id;
document.getElementById("qn").focus();
document.getElementById("prd").value=pd;
document.getElementById("usunit").value=unit;
document.getElementById("qn").value=qn;
document.getElementById("hsn_code").value=hsn_code;
document.getElementById("main_loc").value=main_loc;
document.getElementById("loc").value=loc;
document.getElementById("rack_id").value=rack_id;
document.getElementById("qn").value=qn;

document.getElementById("qty_stock").value=qty_stock;
document.getElementById("des1").value=des1;
document.getElementById("des2").value=des2;


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
		var hsn_code=document.getElementById("hsn_code"+id).value;
		var main_loc=document.getElementById("main_loc"+id).value;
		var loc=document.getElementById("loc"+id).value;
		var rack_id=document.getElementById("rack_id"+id).value;
		var qty_stock=document.getElementById("qty_stock"+id).value;
		var des1=document.getElementById("des1"+id).value;
		var des2=document.getElementById("des2"+id).value;
		var pri_id=document.getElementById("main_id"+id).value;

	    var i = r.parentNode.parentNode.rowIndex;
     var cnf = confirm('Are You Sure..??? you want to Delete line no1.'+(id));
if (cnf== true)
 {
 document.getElementById("invoice").deleteRow(i);
  slr();
  
 //editDeleteCalculation();
	//serviceChargeCal();	
	//grossDiscountCal();
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

      
</script>
<?php
$this->load->view("header.php");
$tableName='tbl_product_stock';
$location='manage_item';
		
		$userQuery = $this -> db
           -> select('*')
		   -> where('Product_id',$_GET['id'])
		   -> or_where('Product_id',$_GET['view'])
           -> get('tbl_product_stock');
		  $branchFetch = $userQuery->row();

?>
	<!-- Main content -->
	<div class="main-content">
		
		<?php if(@$_GET['popup'] == 'True') {} else {?>
		<ol class="breadcrumb breadcrumb-2"> 
			
			<li><a class="btn btn-success" href="<?=base_url();?><?=base_url();?>salesDemoReturn/manageDemoOutbound">Manage Demo Outbound</a></li> 
			
		</ol>
		<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
				<li><a href="#">Demo Outbound</a></li> 
				<li><a href="#">Demo Outbound</a></li> 
				<li class="active"><strong><a href="#">Add Demo Outbound</a></strong></li> 
			</ol>
		<?php }?>

<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
<?php if($_GET['id']!=''){ ?>
		<h4 class="panel-title">Update Outbound</h4>
		<?php }elseif($_GET['view']!=''){ ?>
		<h4 class="panel-title">View Outbound</h4>
		<?php }else{ ?> 
		<h4 class="panel-title"><strong>Add Outbound</strong></h4>
		<?php } ?>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
</ul>
</div>
<div class="panel-body">
<form class="form-horizontal" onSubmit="return checkKeyPressed(a)" method="post" action="insertOutbound" enctype="multipart/form-data">
<div class="form-group"> 
<label class="col-sm-2 control-label">*RGP Gate Pass Dt:</label> 
<div class="col-sm-4" id="regid"> 
<input type="date" name="rgp_gate_pass_date" value="<?php echo $branchFetch->rgp_gate_pass_date; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" required>
</div>  
<label class="col-sm-2 control-label">*RETURN DUE DATE:</label> 
<div class="col-sm-4" id="regid"> 
<input type="date"  name="return_due_date" value="<?php echo $branchFetch->return_due_date; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" required>
</div> 
</div>


<div class="form-group"> 
<div class="field">

<label class="col-sm-2 control-label">RGP Gatepass No:</label> 
<div class="col-sm-4">

<?php    
       $qr=$this->db->query("select (auto_increment-1) as lastId
from information_schema.tables
where table_name = 'tbl_return_hdr'
");

$getQr=$qr->row();

//=============

$rgp=$this->db->query("select * from tbl_return_hdr  ORDER BY returnid DESC LIMIT 0,1 ");
$rgpData=$rgp->row();

$cr=date('Y');
$fyr="{$cr}-04";
$checkDataQuery=$this->db->query("select * from tbl_return_hdr where rgp_gate_pass_date like '%$fyr%' ");
$cntData=$checkDataQuery->num_rows();


$mnth=date('m');
if($mnth==01 || $mnth==02 || $mnth==03 )
{
$year=date("y");
$lastyear=$year - 1;
$nextyear= $year;
}
else
{
$year=date("y");
$nextyear=$year + 1;
$lastyear= $year;
}
$ss=$rgpData->rgp_gatepass_no;
$pieces = explode("/", $ss);
$snum=$pieces[3];
$ttl = $snum + 1;
$var = str_pad($ttl,1,'0',STR_PAD_LEFT);
$numbercase = sprintf('%05d',$var);
//echo "DEL"."/".$lastyear."-".$nextyear."/"."DEMO"."/".$numbercase;

?>
 <input type="text" name="rgp_gatepass_no" value="<?php if($cntData!='0'){?><?php echo "DEL"."/".$lastyear."-".$nextyear."/"."DEMO"."/".$numbercase; } else { echo "DEL"."/".$lastyear."-".$nextyear."/"."DEMO"."/00001"; }?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
  </div> 
</div>
<div class="field">
<label class="col-sm-2 control-label">*Manual Gate Pass No.:</label> 
<div class="col-sm-4" id="regid"> 
 <input type="text" name="manual_gate_pass_no" value="<?php echo $branchFetch->manual_gate_pass_no; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" ></div> 
</div>
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">Manual GP Date:</label> 
<div class="col-sm-4" id="regid"> 
<input type="date" name="manual_gp_date"  value="<?php if($branchFetch->manual_gp_date==''){ echo date('Y-m-d'); } else { echo $branchFetch->manual_gp_date;}?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div>  
<label class="col-sm-2 control-label">Gatepass Issued Name:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="gatepass_issued_name" value="<?php echo $branchFetch->gatepass_issued_name; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div> 
</div>












<div class="form-group"> 
<div class="field">
<label class="col-sm-2 control-label">RESPONSIBILITY:</label> 
<div class="col-sm-4">

<select name="responsibility" class="form-control ui fluid search dropdown email" required  >
    <option value="">----Select ----</option>
  
  <?php
  $responsibilityQuery=$this->db->query("select *from tbl_contact_m where group_name='6'");
  foreach($responsibilityQuery->result() as $getResponsibility){
  ?>
   <option value="<?=$getResponsibility->contact_id;?>" <?php if($getResponsibility->contact_id==$branchFetch->responsibility){ ?> selected <?php }?>><?=$getResponsibility->first_name;?></option>
  <?php }?>
  </select>
 </div> 
</div>
<div class="field">
<label class="col-sm-2 control-label">Stock Position</label> 
<div class="col-sm-4" id="regid"> 

<select name="stock_position" id="contact_id"  onChange="getOrg(this.value);"  class="form-control ui fluid search dropdown email"  <?php if(@$_GET['view']!=''){ ?> disabled="disabled" <?php }?> >
    <option value="">----Select ----</option>
    <?php
	$bookingType=$this->db->query("select *from tbl_contact_m  where group_name='4'");
	foreach($bookingType->result() as $getBooking){
	?>
   <option value="<?=$getBooking->code;?>" <?php if($getBooking->code==$branchFetch->contact_id){?> selected <?php }?>><?=$getBooking->first_name;?></option>
   <?php }?>
  </select>
</div> 
</div>
</div>





<div class="form-group"> 
<div class="field">
<label class="col-sm-2 control-label">Location:</label> 
<div class="col-sm-4">
  <select name="location_to" id='div_con_id'  class="form-control ui fluid search dropdown email1"  <?php if(@$_GET['view']!=''){ ?> disabled="disabled" <?php }?> >
    <option value="">----Select ----</option>
   
  </select>
  </div> 
</div>
<div class="field">
<label class="col-sm-2 control-label">W/H Remarks::</label> 
<div class="col-sm-4" id="regid"> 
 <textarea type="text" class="form-control" name="wh_remarks" ><?=$branchFetch->wh_remarks;?></textarea>
</div> 
</div>
</div>




<div class="form-group"> 
<div class="field">
<label class="col-sm-2 control-label">Remarks1:</label> 
<div class="col-sm-4">
  <textarea type="text" class="form-control" name="remarks1" ><?=$branchFetch->remarks1;?></textarea>
  </div> 
</div>
<div class="field">
<label class="col-sm-2 control-label">Remarks2:</label> 
<div class="col-sm-4" id="regid"> 
 <textarea type="text" class="form-control" name="remarks2" ><?=$branchFetch->remarks2;?></textarea>
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


<th>Unit of Measurment</th>
<th>Hsn Code</th>

<th>Main Location</th>
<th>Location</th>
<th>Rack No.</th>
<th>Enter Qty</th>
<th>Qty In Stock</th>
</tr>

<tr class="gradeA">
<th style="width:280px;">
<div class="input-group"> 
<div style="width:100%; height:28px;" >
<input type="text" name="prd"  onkeyup="getdata()" class="form-control" onClick="getdata()" id="prd" style=" width:100px;"  placeholder=" Search Items..." tabindex="5" >
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
<input type="text" readonly="" id="des1" style="width:90px;" class="form-control"> 
</th>
<th>
<input type="text" readonly="" id="des2" style="width:250px;" class="form-control"> 
</th>



<th>
<input type="text" readonly="" id="usunit" style="width:70px;" class="form-control"> 
</th>
<th><input type="number" id="hsn_code" min="1" style="width:70px;"   class="form-control"></th>


<th><select  name="saleamnt" id="main_loc" class="form-control"  style="width:70px;"/ >

<?php
$queryMainLocation=$this->db->query("select *from tbl_location where status='A'");
foreach($queryMainLocation->result() as $getMainLocation){
?>
<option value="<?=$getMainLocation->id;?>"><?=$getMainLocation->location_name;?></option>
<?php }?>
</select></th><th><select name="saleamnt" id="loc" onChange="getPallet(this.value);" onFocus="getPallet(this.value);"   class="form-control"   style="width:70px;"/ >


<?php
$queryMainLocation=$this->db->query("select *from tbl_master_data where status='A' and param_id='29'");
foreach($queryMainLocation->result() as $getMainLocation){
?>
<option value="<?=$getMainLocation->serial_number;?>"><?=$getMainLocation->keyvalue;?></option>
<?php }?>

</select>
<p id="qty_pallet"></p>
</th>

<th><select name="saleamnt11" id="rack_id" onChange="getrackQty1(this.value);" class="form-control"   style="width:70px;"/ >

<?php
$queryMainLocation1=$this->db->query("select *from tbl_location_rack where status='A'");
foreach($queryMainLocation1->result() as $getMainLocation1){
?>
<option value="<?php echo $getMainLocation1->id;?>"><?=$getMainLocation1->rack_name;?>

</option>
<?php }?>

</select></th>
<th>
<input type="text"   style="width:70px;" id="qn" class="form-control"> 
</th>
<th>
<input type="text" readonly="" id="qty_stock" style="width:70px;" class="form-control"> 
</th>

</tr>
</tbody>
</table>
</div>
<div style="width:100%; background:#dddddd; padding-left:0px; color:#000000; border:2px solid ">
<table id="invo" style="width:100%;  background:#dddddd;  height:70%;" title="Invoice"  >
<tr>
<td style="width:1%;"><div align="center"><u>Sl No</u>.</div></td>
<td style="width:5%;"><div align="center"><u>Product Code</u></div></td>
<td style="width:8%;"><div align="center"><u>Description1</u></div></td>
<td style="width:8%;"><div align="center"><u>Description2</u></div></td>
<td style="width:3%;"> <div align="center"><u>Hsn Code</u></div></td>
<td style="width:3%;"><div align="center"><u>Main Location</u></div></td>
<td style="width:3%;"> <div align="center"><u>Location</u></div></td>
<td style="width:3%;"> <div align="center"><u>Rack No.</u></div></td>

<td style="width:3%;"> <div align="center"><u>Qty</u></div></td>
<td style="width:3%;"> <div align="center"><u>Qty In Stock</u></div></td>
<td style="width:3%;"> <div align="center"><u>Action</u></div></td>
</tr>
</table>


<div style="width:100%; background:white;   color:#000000;  max-height:170px; overflow-x:auto;overflow-y:auto;" id="m">
<table id="invoice"  style="width:100%;background:white;margin-bottom:0px;margin-top:0px;min-height:30px;" title="Invoice" class="table table-bordered blockContainer lineItemTable ui-sortable"  >

<tr></tr>
</table>



</div>


<input type="hidden" name="rows" id="rows">
<!--//////////ADDING TEST/////////-->
<input type="hidden" name="spid" id="spid" value="d1"/>
<input type="hidden" name="ef" id="ef" value="0" />

</div>



<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" >


<tbody>
<tr class="gradeA" style="display:none;">
<th>Sub Total</th>
<th>&nbsp;</th>
<th><input type="text" placeholder="Placeholder" id="sub_total" readonly="" name="sub_total" class="form-control"></th>
</tr>

<tr class="gradeA" style="display:none">
<th>Service Charge</th>
<th><input type="number" step="any" min="1" id="service_charge" onKeyUp="serviceChargeCal();" name="service_charge_per" placeholder="0%" class="form-control"></th>
<th><input type="text" readonly="" id="service_charge_total" name="service_charge_total" placeholder="Placeholder" class="form-control"></th>
</tr>

<tr class="gradeA" style="display:none">
<th>Gross Discount</th>
<th><input type="number" name="gross_discount_per" onKeyUp="grossDiscountCal()" id="gross_discount_per" step="any" min="1" placeholder="%" class="form-control"></th>
<th><input type="number" readonly="" name="gross_discount_total" id="gross_discount_total" step="any" placeholder="Placeholder" class="form-control"></th>
</tr>

<tr class="gradeA" style="display:none;">
<th>Grand Total</th>
<th>&nbsp;</th>
<th><input type="number" readonly="" step="any" id="grand_total" name="grand_total" placeholder="Placeholder" class="form-control"></th>
</tr>

<tr class="gradeA">
<th>

<th>&nbsp;</th>
<th><input class="btn btn-primary" type="button" value="SAVE"   id="sv1" onClick="fsv(this)" >&nbsp;<a href="<?=base_url();?>salesDemoReturn/manageDemoOutbound" class="btn btn-blue">Cancel</a></th></th>
</tr>
</tbody>
</table>
</div>



</form>
</div>
</div>
</div>
</div>


<script>
function getPallet(loc){
	
var rack_id=document.getElementById("rack_id").value;
var main_loc=document.getElementById("main_loc").value;
var pri_id=document.getElementById("pri_id").value;
	getPalletQty(main_loc,loc,pri_id);
		var strURL="get_rack?loc="+loc+"&rack_id="+rack_id+"&main_loc="+main_loc;

		var req = getXMLHTTP();

		if (req) {

			req.onreadystatechange = function() {

				if (req.readyState == 4) {

					if (req.status == 200) {

					//var price=mtr*ext_per;
					//alert(req.responseText);
						document.getElementById('rack_id').innerHTML=req.responseText;
							
										
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










function getrackQty1(rack_id){
	
var loc=document.getElementById("loc").value;
var main_loc=document.getElementById("main_loc").value;
var pri_id=document.getElementById("pri_id").value;

		var strURL="get_rack_qty?loc="+loc+"&rack_id="+rack_id+"&main_loc="+main_loc+"&pri_id="+pri_id;

		var req = getXMLHTTP();

		if (req) {

			req.onreadystatechange = function() {

				if (req.readyState == 4) {

					if (req.status == 200) {

					//var price=mtr*ext_per;
					//alert(req.responseText);
					if(req.responseText=='' || req.responseText=='0')
					{
						
						alert("There is no qty in this rack");
						var elements = document.getElementById("rack_id").selectedOptions;

    for(var i = 0; i < elements.length; i++){
      elements[i].selected = false;
	}
						document.getElementById('rack_id').focus();
						
						
					}
						document.getElementById('qty_stock').value=req.responseText;
							
										
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






function getPalletQty(main_loc,loc,pri_id)
{
		var strURL="getPalletQty?main_loc="+main_loc+"&loc="+loc+"&pri_id="+pri_id;
		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.status == 200) {
					//var price=mtr*ext_per;
					//alert(req.responseText);
					
					if(req.responseText=='No Record found' || req.responseText=='0')
					{
					
						document.getElementById("qn").readOnly = true;
						

					}
					else
					{
						document.getElementById("qn").readOnly = false;
					}
					document.getElementById('qty_pallet').innerHTML=req.responseText;
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




</script>


<script>
function getOrg(contact_id)
{
	var xhttp = new XMLHttpRequest();
	xhttp.open("GET", "getCity_fun?con="+contact_id, false);
	xhttp.send();
	document.getElementById("div_con_id").innerHTML = xhttp.responseText;
}

</script>

<?php
$this->load->view("footer.php");

?>
</body>





