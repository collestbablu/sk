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



/*document.getElementById("qn").onkeydown = function (e) {
var entr =(e.keyCode);
if(entr==13){
var qtyVal=document.getElementById("qn").value;
var qty_stVal=document.getElementById("qty_stock").value;

if(Number(qtyVal)<=Number(qty_stVal))
{

document.getElementById("qty_stock").focus();
}
else
{
	alert("Qty should be less then total qty");
	document.getElementById("qn").focus();
}
}

}
*/


//============================ChkQty=================


document.getElementById("qn").onkeydown = function (e) {

var entr =(e.keyCode);
if(entr==13){

	var enqnty=document.getElementById("qn").value;
	var qty_in_stk=document.getElementById("qty_stock").value;
	var rack_id=document.getElementById("rack_id").value;
	var loc=document.getElementById("loc").value;
	var main_loc=document.getElementById("main_loc").value;
	var prdct_id=document.getElementById("pri_id").value;
	
	     var sumdata='';
		 var inps = document.getElementsByName('row_id[]');
		
		for (var i = 0; i <inps.length; i++) 
		 {
				var inp=inps[i];
			    //alert("pname["+i+"].value="+inp.value);
				var rd=inp.value;
				//alert(rd);
			var entr_rack_id=document.getElementById("rack_id"+rd).value;
			var entr_loc=document.getElementById("loc"+rd).value;
			var entr_main_loc=document.getElementById("main_loc"+rd).value;
			var entr_prdct_id=document.getElementById("main_id"+rd).value;
			var entr_qnty=document.getElementById("qnty"+rd).value;
		    
			if(prdct_id==entr_prdct_id && main_loc==entr_main_loc && loc==entr_loc && rack_id==entr_rack_id  )
		    {
			   sumdata=Number(sumdata)+Number(entr_qnty);
		    }	
			else
			{
				sumdata;
			}
		
		}

			var totalqty='';
			totalqty=Number(sumdata)+Number(enqnty);

			if(Number(enqnty) > Number(qty_in_stk))
			{
				alert("Enter Qty Is Greater Than Qty In Stock");
				document.getElementById("qn").focus();
			}
			else if(Number(totalqty) > Number(qty_in_stk))
			 {	
				alert('Listed Qty + Enter Qty Total Is Greater Than Qty In Stock!');
				document.getElementById('qn').focus();
			 }
			
			 else
			 {
				document.getElementById("qty_stock").focus();
			 }

	  }

}

//===================================================



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






////////////////////////////////// ######################## starts edit code ############################## ////////////////////////////////


function editselectrow(d,r) 
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

document.getElementById("qty_stock").value=qty_stock;
document.getElementById("des1").value=des1;
document.getElementById("des2").value=des2;
		
		
    	var i = r.parentNode.parentNode.rowIndex;
		document.getElementById("invoice").deleteRow(i);
}

////////////////////////////////// ########################## ends edit code ###########################################////////////////////////////////




//////////////////////////////////################################ starts delete code ##################################////////////////////////////////

function deleteselectrow(d,r) //
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
		var discount=document.getElementById("dis"+id).value;
		var disAmt=document.getElementById("disAmount"+id).value;
		var tot=document.getElementById("tot"+id).value;
		var nettot=document.getElementById("nettot"+id).value;
		var pri_id=document.getElementById("main_id"+id).value;
	    var i = r.parentNode.parentNode.rowIndex;
	    var cnf = confirm('Are You Sure..??? you want to Delete line no1.'+(id));
		if (cnf== true)
 		{
 			document.getElementById("invoice").deleteRow(i);
			var sub_total=document.getElementById("sub_total").value;
			sub_total_cal=sub_total-nettot;
			document.getElementById("sub_total").value=sub_total_cal.toFixed(2);
			document.getElementById("grand_total").value=sub_total_cal.toFixed(2);
 
 			editDeleteCalculation();
			serviceChargeCal();	
			grossDiscountCal();
    		slr();
		}
	
}
////////////////////////////////// #################################### ends delete code #########################################////////////////////////////////


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
				cell.style.width="5%";
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
						
						var abc = document.createElement("input");
							abc.type="hidden";
							abc.border ="0";
							abc.value=rid;	
							abc.name='row_id[]';//
							abc.id='row_id'+rid;//
							abc.readOnly = true;
							abc.style="text-align:center";  
							abc.style.width="100%";
							abc.style.border="hidden"; 
							cell.appendChild(abc);
	
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
<body>
<?php
$this->load->view("header.php");
//$tableName='tbl_product_stock';
//$location='manage_item';
		
		$userQuery = $this -> db
           -> select('*')
		   -> where('stockoutid',$_GET['id'])
		   -> or_where('stockoutid',$_GET['view'])
           -> get('tbl_stock_out_hdr');
		  $branchFetch = $userQuery->row();

?>
	<!-- Main content -->
	<div class="main-content">
		
		<?php if(@$_GET['popup'] == 'True') {} else {?>
		<ol class="breadcrumb breadcrumb-2"> 
			
			<li><a class="btn btn-success" href="<?=base_url();?><?=base_url();?>inbound/manageInbound">Manage OutBound</a></li> 
			
		</ol>
		<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
				<li><a href="#">OutBound</a></li> 
				
				<li class="active"><strong><a href="#">Update OutBound</a></strong></li> 
			</ol>
		<?php }?>

<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
<?php if($_GET['id']!=''){ ?>
		<h4 class="panel-title">Update OutBound</h4>
		<?php }elseif($_GET['view']!=''){ ?>
		<h4 class="panel-title">View OutBound</h4>
		<?php }else{ ?> 
		<h4 class="panel-title"><strong>Add OutBound</strong></h4>
		<?php } ?>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
</ul>
</div>
<div class="panel-body">
<form class="form-horizontal" onSubmit="return checkKeyPressed(a)" method="post" action="updateInbound" enctype="multipart/form-data">
<div class="form-group"> 
<label class="col-sm-2 control-label">Date:</label> 
<div class="col-sm-4" id="regid"> 

<input type="hidden" name="id" value="<?=$_GET['id'];?>">
<input type="date" name="date" min="1" step="any" value="<?php echo $branchFetch->date; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div>  
<label class="col-sm-2 control-label">Original Invoice Received Time:</label> 
<div class="col-sm-4" id="regid"> 
<input type="time" name="original_inv_rec_time" value="<?php echo $branchFetch->original_inv_rec_time; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div> 
</div>




<div class="form-group"> 
<div class="field">

<label class="col-sm-2 control-label">Customer:</label> 
<div class="col-sm-4">
  <select name="contact_id" id="contact_id"  onChange="getOrg(this.value);"  class="form-control ui fluid search dropdown email"  <?php if(@$_GET['view']!=''){ ?> disabled="disabled" <?php }?> >
    <option value="">----Select ----</option>
    <?php
	$bookingType=$this->db->query("select *from tbl_contact_m  where group_name='4'");
	foreach($bookingType->result() as $getBooking){
	?>
   <option value="<?=$getBooking->code;?>" <?php if($getBooking->code==$branchFetch->contact_id){?> selected <?php }?>><?=$getBooking->first_name;?></option>
   <?php }?>
  </select>
  <a onClick="openpopup('<?=base_url();?>master/ProductCategory/add_itemctg',900,630,'mid','121')"><img src="<?php echo base_url();?>/assets/images/addcontact.png" style="display:none" width="25px" height="25px"/></a> </div> 
</div>
<div class="field">
<label class="col-sm-2 control-label">Type:</label> 
<div class="col-sm-4" id="regid"> 
 
<select name="type"  class="form-control ui fluid search dropdown email1"  <?php if(@$_GET['view']!=''){ ?> disabled="disabled" <?php }?> >
    <option value="">----Select ----</option>
    <?php
	$bookingType=$this->db->query("select *from tbl_master_data  where param_id='31'");
	foreach($bookingType->result() as $getBooking){
	?>
   <option value="<?=$getBooking->serial_number;?>" <?php if($getBooking->serial_number==$branchFetch->type){?> selected <?php }?>><?=$getBooking->keyvalue;?></option>
   <?php }?>
  </select>
</div> 
</div>
</div>


<div class="form-group"> 
<label class="col-sm-2 control-label">Order No.:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="order_no" min="1" step="any" value="<?php echo $branchFetch->order_no; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div>  
<label class="col-sm-2 control-label">Invoice No.:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="invoice_no" value="<?php echo $branchFetch->invoice_no; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div> 
</div>


<div class="form-group"> 
<label class="col-sm-2 control-label">To Location:</label> 
<div class="col-sm-4" id="regid"> 
<select name="location_to" id='div_con_id'  class="form-control ui fluid search dropdown email1"  <?php if(@$_GET['view']!=''){ ?> disabled="disabled" <?php }?> >
    <option value="">----Select ----</option>
    <?php
	$bookingType=$this->db->query("select *from tbl_contact_m  where contact_id='$branchFetch->location_to'");
	foreach($bookingType->result() as $getBooking){
	?>
   <option value="<?=$getBooking->contact_id;?>" <?php if($getBooking->contact_id==$branchFetch->location_to){?> selected <?php }?>><?=$getBooking->city;?></option>
   <?php }?>
  </select>
</div>  
<label class="col-sm-2 control-label">Invoice Amount:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="invoice_amount" value="<?php echo $branchFetch->invoice_amount; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div> 
</div>





<div class="form-group" style="display:none"> 
<label class="col-sm-2 control-label">Name:</label> 
<div class="col-sm-4" id="regid"> 
<select name="responsibility" class="form-control ui fluid search dropdown"  >
    <option value="">----Select ----</option>
  
  <?php
  $responsibilityQuery=$this->db->query("select *from tbl_contact_m where group_name='6'");
  foreach($responsibilityQuery->result() as $getResponsibility){
  ?>
   <option value="<?=$getResponsibility->contact_id;?>" <?php if($getResponsibility->contact_id==$branchFetch->responsibility){ ?> selected <?php }?>><?=$getResponsibility->first_name;?></option>
  <?php }?>
  </select>
</div>  
<label class="col-sm-2 control-label">&nbsp;</label> 
<div class="col-sm-4" id="regid"> 
&nbsp;
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
<th style="width:130px;">
<div class="input-group"> 
<div style="width:100%; height:28px;" >
<input type="text" name="prd"  onkeyup="getdata()" class="form-control" onClick="getdata()" id="prd" style=" width:100px;"  placeholder=" Search Items..." tabindex="5" >
 <input type="hidden"  name="pri_id" id='pri_id'  value="" style="width:80px;"  />
</div>

</div>
<div id="prdsrch" style="color:black;padding-left:0px; width:19%; height:110px; max-height:110px;overflow-x:auto;overflow-y:auto;padding-bottom:5px;padding-top:0px; position:absolute;">
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
</select></th><th><select name="saleamnt" id="loc" onChange="getPallet(this.value);" onFocus="getPallet(this.value);"  class="form-control"   style="width:70px;"/ >


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

</select>

</th>
<th>
<input type="text"   style="width:70px;" id="qn" class="form-control"> 
</th>
<th>
<input type="text"  id="qty_stock" style="width:70px;" class="form-control"> 
</th>

</tr>
</tbody>
</table>
</div>
<div style="width:100%; background:#dddddd; padding-left:0px; color:#000000; border:2px solid ">
<table id="invo" style="width:100%;  background:#dddddd;  height:70%;" title="Invoice"  >
<tr>
<td style="width:1%;"><div align="center"><u>Sl No</u>.</div></td>
<td style="width:4%;"><div align="center"><u>Product Code</u></div></td>
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
<?php
$z=1;
$query_dtl=$this->db->query("select * from tbl_stock_out_dtl where stockouthdr='".$_GET['id']."' or stockouthdr='".$_GET['view']."' ");
foreach($query_dtl->result() as $invoiceFetch)
{

$productQuery=$this->db->query("select *from tbl_product_stock where Product_id='$invoiceFetch->product_id'");
$getProductName=$productQuery->row();



$unitQuery=$this->db->query("select *from tbl_master_data where serial_number='$getProductName->usageunit'");
$getunitName=$unitQuery->row();

?>
<tr>
<td align="center" style="width: 0.2%;"><?php echo $z;?></td>

<td align="center" style="width: 3%;"><input type="text" name="pd[]" id="pd<?php echo $z;?>" value="<?php echo $getProductName->sku_no;?>" readonly="" style="text-align: center; width: 100%; border:hidden;">

<td align="center" style="width: 8%;"><input type="text" name="pdfsdf[]" id="des1<?php echo $z;?>" value="<?php echo $getProductName->productname;?>" readonly="" style="text-align: center; width: 100%; border:hidden;">


<td align="center" style="width: 8%;"><input type="text" name="pdfsd[]" id="des2<?php echo $z;?>" value="<?php echo $getProductName->description2;?>" readonly="" style="text-align: center; width: 100%; border:hidden;">

</td>


<td align="center" style="width: 3%;">
<input type="hidden" name="main_id[]" id="main_id<?php echo $z;?>" value="<?php echo $invoiceFetch->product_id;?>" readonly="" style="text-align: center; width: 100%; border:hidden;">

<input type="hidden" value="<?=$getunitName->keyvalue;?>" name="unit[]" id="unit<?php echo $z;?>" readonly="" style="text-align: center; width: 100%; border: hidden;">
<input type="text" name="hsn_code[]" id="hsn_code<?php echo $z;?>" value="<?php echo $getProductName->hsn_code;?>" readonly="" style="text-align: center; width: 100%; border: hidden;">
</td>
<td align="center" style="width: 3%;">

<?php
$locationQuery=$this->db->query("select *from tbl_location where id='$invoiceFetch->main_loc'");
$getLoc=$locationQuery->row();
?>

<input type="text" name="main67_loc[]" id="main_loc77<?php echo $z;?>" value="<?php echo $getLoc->location_name;?>" readonly="" style="text-align: center; width: 100%; border: hidden;">

<input type="hidden" name="main_loc[]" id="main_loc<?php echo $z;?>" value="<?php echo $invoiceFetch->main_loc;?>" readonly="" style="text-align: center; width: 100%; border: hidden;"></td>


<td align="center" style="width: 3%;">

<?php
$locationMQuery=$this->db->query("select *from tbl_master_data where serial_number='$invoiceFetch->loc'");
$getMLoc=$locationMQuery->row();
?>

<input type="text" name="main6777_loc[]" id="main_loc77<?php echo $z;?>" value="<?php echo $getMLoc->keyvalue;?>" readonly="" style="text-align: center; width: 100%; border: hidden;">



<input type="hidden" name="loc[]" id="loc<?php echo $z;?>" value="<?php echo $invoiceFetch->loc;?>" readonly="" style="text-align: center; width: 100%; border: hidden;"></td>

<td align="center" style="width: 3%;">



<?php
$locationRQuery=$this->db->query("select *from tbl_location_rack where id='$invoiceFetch->rack_id'");
$getRLoc=$locationRQuery->row();
?>

<input type="text" name="main6777_loc[]" id="main_loc77<?php echo $z;?>" value="<?php echo $getRLoc->rack_name;?>" readonly="" style="text-align: center; width: 100%; border: hidden;">






<input type="hidden" name="rack_id[]" id="rack_id<?php echo $z;?>" value="<?php echo $invoiceFetch->rack_id;?>" readonly="" style="text-align: center; width: 100%; border: hidden;">


<td align="center" style="width: 3%;"><input type="text" name="qty[]" id="qnty<?php echo $z;?>" value="<?php echo $invoiceFetch->quantity;?>"readonly="" style="text-align: center; width: 100%; border: hidden;"></td>

<td align="center" style="width: 3%;"><input type="text" name="qty_stock[]" id="qty_stock<?php echo $z;?>" value="<?php echo $invoiceFetch->quantity;?>"readonly="" style="text-align: center; width: 100%; border: hidden;"></td>

<td align="center" style="width: 3%;"><img src="<?php echo base_url();?>assets/images/delete.png" border="0" name="dlt" id="dlt<?php echo $z;?>" onClick="deleteselectrow(this.id,this);"  readonly style="width: 30%; height: 20%; border: hidden;"><img src="<?php echo base_url();?>assets/images/edit.png" border="0" name="ed" id="ed<?php echo $z;?>" onClick="editselectrow(this.id,this);" style="width: 30%; height: 20%; border: hidden;"></td>
</tr>
<?php $row=$z; $z++;  } ?>

</table>



</div>


</div>

<input type="hidden" name="rows" id="rows" value="<?php echo $row;?>">
<!--//////////ADDING TEST/////////-->
<input type="hidden" name="spid" id="spid" value="d1"/>
<input type="hidden" name="ef" id="ef" value="0" />



<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" <?php if($_GET['view']!=''){?> oncontextmenu='return false;' onkeydown='return false;' onmousedown='return false;' <?php }?> >


<tbody>
<tr class="gradeA" style="display:none;">
<th>Sub Total</th>
<th>&nbsp;</th>
<th><input type="text" placeholder="Placeholder" id="sub_total" readonly="" name="sub_total" value="<?php echo $branchFetch->sub_total; ?>" class="form-control"></th>
</tr>

<tr class="gradeA" style="display:none">
<th>Service Charge</th>
<th><input type="number" step="any" min="1" id="service_charge" value="<?php echo $branchFetch->service_charge_per; ?>" onKeyUp="serviceChargeCal();" name="service_charge_per" placeholder="0%" class="form-control"></th>
<th><input type="text" readonly="" id="service_charge_total" value="<?php echo $branchFetch->service_charge_total; ?>" name="service_charge_total" placeholder="Placeholder" class="form-control"></th>
</tr>

<tr class="gradeA" style="display:none">
<th>Gross Discount</th>
<th><input type="number" name="gross_discount_per" onKeyUp="grossDiscountCal()" value="<?php echo $branchFetch->gross_discount_per; ?>" id="gross_discount_per" step="any" min="1" placeholder="%" class="form-control"></th>
<th><input type="number" readonly="" name="gross_discount_total" value="<?php echo $branchFetch->gross_discount_total; ?>" id="gross_discount_total" step="any" placeholder="Placeholder" class="form-control"></th>
</tr>

<tr class="gradeA" style="display:none;">
<th>Grand Total</th>
<th>&nbsp;</th>
<th><input type="number" readonly="" step="any" id="grand_total" value="<?php echo $branchFetch->grand_total; ?>" name="grand_total" placeholder="Placeholder" class="form-control"></th>
</tr>

<tr class="gradeA">
<th>

<th>&nbsp;</th>
<th>
<?php if($_GET['view']!='')
{} else {?>
<input class="btn btn-primary btn-sm" type="button" value="SAVE"   id="sv1" onClick="fsv(this)" >&nbsp;
<?php }?>
<a onClick="popupclose(this.value)" class="btn btn-blue btn-sm">Cancel</a></th></th>
</tr>
</tbody>
</table>
</div>



</form>
</div>
</div>
</div>
</div>
<?php
$this->load->view("footer.php");

?>
</body>
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





function getOrg(contact_id)
{
	
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "getCity_fun?con="+contact_id, false);
  xhttp.send();
  document.getElementById("div_con_id").innerHTML = xhttp.responseText;
 
	
}

</script>




</script>
