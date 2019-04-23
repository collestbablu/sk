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
document.getElementById("lph").focus();
document.getElementById("prdsrch").innerHTML=" ";

}
}
}

document.getElementById("lph").onkeyup = function (e) {
var entr =(e.keyCode);
if(entr==13){

document.getElementById("int_tariff").focus();
}
}




document.getElementById("int_tariff").onkeyup = function (e) {
var entr =(e.keyCode);
if(entr==13){

document.getElementById("qn").focus();
}
}








document.getElementById("qn").onkeyup = function (e) {
var entr =(e.keyCode);
if(entr==13){

var rate=document.getElementById("lph").value;
var qnt=document.getElementById("qn").value;
var total=(Number(rate)*Number(qnt));

document.getElementById("tot").value=total;
document.getElementById("nettot").value=total;
document.getElementById("discount").focus();
}
}

document.getElementById("discount").onkeyup = function (e) {
var entr =(e.keyCode);
if(entr==13){

var qn=document.getElementById("qn").value;
var recQty=document.getElementById("discount").value;
var diffQty=(Number(qn))-Number(recQty);
document.getElementById("disAmt").value=diffQty;
document.getElementById("disAmt").focus();
}
}



document.getElementById("disAmt").onkeyup = function (e) {
var entr =(e.keyCode);
if(document.getElementById("disAmt").value=="" && entr==08){

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
				var lph=document.getElementById("lph").value;
				var lpr=document.getElementById("lpr").innerHTML;
				
				
				var dis=document.getElementById("discount").value;	
				var disAmount=document.getElementById("disAmt").value;		
		        var tot=document.getElementById("tot").value;
				var nettot=document.getElementById("nettot").value;
				var qty_stock=document.getElementById("qty_stock").value;
				var int_tariff=document.getElementById("int_tariff").value;
				var des1=document.getElementById("des1").value;
				var des2=document.getElementById("des2").value;
			  	
			
				
				//default
				var rows=document.getElementById("rows").value;
				var pri_id=document.getElementById("pri_id").value;
				var pd=document.getElementById("prd").value;
		   	   var table = document.getElementById("invoice");
					var rid =Number(rows)+1;
					document.getElementById("rows").value=rid;
					
						
							totalSum();	
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
				cell.style.display="none";
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
					
	
	//########s#########//
	
	
	
	
	
	//########s#########//
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;
        cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center"
				var salepr1 = document.createElement("input");
							salepr1.type="text";
							salepr1.border ="0";
							salepr1.value=lpr;	    
							salepr1.name ='lpr[]';
							salepr1.id='lpr'+rid;
							salepr1.readOnly = true;
							salepr1.style="text-align:center";
							salepr1.style.width="100%";
							salepr1.style.border="hidden"; 
							cell.appendChild(salepr1);
					

	
	
	
	
	
		//==============================close 2nd cell 

	
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;
        cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center"
				var salepr = document.createElement("input");
							salepr.type="text";
							salepr.border ="0";
							salepr.value=lph;	    
							salepr.name ='list_price[]';
							salepr.id='lph'+rid;
							salepr.readOnly = true;
							salepr.style="text-align:center";
							salepr.style.width="100%";
							salepr.style.border="hidden"; 
							cell.appendChild(salepr);
					

	
	
	
	
	
		//==============================close 2nd cell =========================================





















//########s#########//
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;
        cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center"
				var int_tariffF = document.createElement("input");
							int_tariffF.type="text";
							int_tariffF.border ="0";
							int_tariffF.value=int_tariff;	    
							int_tariffF.name ='int_tariff[]';
							int_tariffF.id='int_tariff'+rid;
							int_tariffF.readOnly = true;
							int_tariffF.style="text-align:center";
							int_tariffF.style.width="100%";
							int_tariffF.style.border="hidden"; 
							cell.appendChild(int_tariffF);
					

	
	
	
	
	
		//==============================close 2nd cell 









		
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
		
		
		
		
		
		
		
		
		
		//===================================start 4th cell================================
		indexcell=Number(indexcell+1);		
		var cell=cell+indexcell;		
	    cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center"	
				
												
				var discount = document.createElement("input");
							discount.type="text";
							discount.border ="0";
							discount.value=dis;	
							discount.name ='discount[]';
							discount.id='dis'+rid;
							discount.readOnly = true;
							discount.style="text-align:center";
							discount.style.width="100%";
							discount.style.border="hidden"; 
							cell.appendChild(discount);
		//===============================close 4th cell=================================

		

//===================================start 5th cell================================
		indexcell=Number(indexcell+1);		
		var cell=cell+indexcell;		
	    cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center"	
				
												
				var disAmtt = document.createElement("input");
							disAmtt.type="text";
							disAmtt.border ="0";
							disAmtt.value=disAmount;	
							disAmtt.name ='disAmount[]';
							disAmtt.id='disAmount'+rid;
							disAmtt.readOnly = true;
							disAmtt.style="text-align:center";
							disAmtt.style.width="100%";
							disAmtt.style.border="hidden"; 
							cell.appendChild(disAmtt);
		//===============================close 5th cell=================================
		
		
		
		
		
		
			
	
				
		//===================================start 6th cell================================
		indexcell=Number(indexcell+1);		
		var cell=cell+indexcell;		
	    cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center"	
				
												
				var vatamt = document.createElement("input");
							vatamt.type="text";
							vatamt.border ="0";
							vatamt.value=tot;	
							vatamt.name ='tot[]';
							vatamt.id='tot'+rid;
							vatamt.readOnly = true;
							vatamt.style="text-align:center";
							vatamt.style.width="100%";
							vatamt.style.border="hidden"; 
							cell.appendChild(vatamt);
		//===============================close 5th cell=================================
					
									
		//============================================start 7th cell================================	
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;	
	   cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center"
			
				var netprice = document.createElement("input");
							netprice.type="text";
							netprice.border ="0";
							netprice.value=nettot;	    
							netprice.name ='nettot[]';
							netprice.id='nettot'+rid;
							netprice.readOnly = true;
							netprice.style="text-align:center";
							netprice.style.width="100%";
							netprice.style.align="center";
							netprice.style.border="hidden"; 
							cell.appendChild(netprice);							
											
		//======================================close net price====================================							
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
		document.getElementById("usunit").value='';
		document.getElementById("lph").value='';
		document.getElementById("lpr").innerHTML ='';
		document.getElementById("discount").value='';
		document.getElementById("disAmt").value='';
		document.getElementById("tot").value='';
		document.getElementById("nettot").value='';
		document.getElementById("qn").value='';
		document.getElementById("pri_id").value='';
		document.getElementById("qty_stock").value='';
		document.getElementById("int_tariff").value='';
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
		lpr=document.getElementById("lpr"+id).innerHTML=lpr;
		var lph=document.getElementById("lph"+id).value;
		var discount=document.getElementById("dis"+id).value;
		var disAmt=document.getElementById("disAmount"+id).value;
		var tot=document.getElementById("tot"+id).value;
		var nettot=document.getElementById("nettot"+id).value;
		var qty_stock=document.getElementById("qty_stock"+id).value;
		var int_tariff=document.getElementById("int_tariff"+id).value;
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
document.getElementById("lpr").innerHTML=lpr;
document.getElementById("lph").value=lph;
document.getElementById("discount").value=discount;
document.getElementById("disAmt").value=disAmt;
document.getElementById("tot").value=tot;
document.getElementById("nettot").value=nettot;
document.getElementById("qty_stock").value=qty_stock;
document.getElementById("int_tariff").value=int_tariff;

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
		var lph=document.getElementById("lph"+id).value;
		var ph=document.getElementById("lph"+id).value;
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
  <li><a class="btn btn-success" href="<?=base_url();?><?=base_url();?>inbound/manageInbound">Manage Pre Alert</a></li>
</ol>
<ol class="breadcrumb breadcrumb-2">
  <li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li>
  <li><a href="#">Inbound</a></li>
  <li><a href="#">Pre Alert</a></li>
  <li class="active"><strong><a href="#">Add Pre Alert</a></strong></li>
</ol>
<?php }?>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <?php if($_GET['id']!=''){ ?>
        <h4 class="panel-title">View Invoice</h4>
        <?php }elseif($_GET['view']!=''){ ?>
        <h4 class="panel-title">View Invoice</h4>
        <?php }else{ ?>
        <h4 class="panel-title"><strong>Add Invoice</strong></h4>
        <?php } ?>
        <ul class="panel-tool-options">
          <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
        </ul>
      </div>
      <div class="panel-body">
        <form class="form-horizontal" onSubmit="return checkKeyPressed(a)" method="post" action="insertMultipleInv" enctype="multipart/form-data">
          <?php
$query_dtl=$this->db->query("select * from tbl_stock_in_inv_hdr where stockinhdr='".$_GET['id']."' or stockinhdr='".$_GET['view']."' ");
foreach($query_dtl->result() as $invoiceFetch)
{
?>
          <div class="form-group" style="display:none">
            <label class="col-sm-2 control-label">*Invoice No.:</label>
            <div class="col-sm-4" id="regid">
              <input type="text" class="form-control" name="inv_no" value="<?=$invoiceFetch->inv_no;?>">
              <input type="hidden" name="id" value="<?=$_GET['id'];?>">
            </div>
            <label class="col-sm-2 control-label">*Order No.:</label>
            <div class="col-sm-4" id="regid">
              <input type="text" name="order_no" value="<?php echo $invoiceFetch->order_no; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" required>
            </div>
          </div>
          <?php }?>
          <div style="width:100%; background:#dddddd; padding-left:0px; color:#000000; border:2px solid ">
            
            <div style="width:100%; background:white;   color:#000000;  max-height_:170px; overflow-x:auto;overflow-y:auto;" id="m">
              <table id="invoice"  style="width:100%;background:white;margin-bottom:0px;margin-top:0px;min-height:30px;" title="Invoice" class="table table-bordered blockContainer lineItemTable ui-sortable"  >
<tr>
<td align="center" style="background-color:#dddddd;">Sl No.</td>
<td align="center" style="background-color:#dddddd;">Invoice No..</td>
<td align="center" style="background-color:#dddddd; display:none;">Order No..</td>
<td align="center" style="important; background-color:#dddddd;display:none;">Invoice Date</td>
<td align="center" style="background-color:#dddddd;display:none;">GRN No.</td>
<td align="center" style="background-color:#dddddd;display:none;">GRN Date</td>
<td align="center" style="background-color:#dddddd;">Action</td>
</tr>			  
			  
			  
                <?php
$z=1;
$query_dtl=$this->db->query("select distinct(inv_no),stockinhdr,inc_id from tbl_stock_in_inv_hdr where stockinhdr='".$_GET['id']."' or stockinhdr='".$_GET['view']."' group by stockdtlid");
foreach($query_dtl->result() as $invoiceFetch)
{

$productQuery=$this->db->query("select *from tbl_product_stock where Product_id='$invoiceFetch->product_id'");
$getProductName=$productQuery->row();



$unitQuery=$this->db->query("select *from tbl_master_data where serial_number='$getProductName->usageunit'");
$getunitName=$unitQuery->row();

?>






<tr class="record">
                  <td align="center" ><?php echo $z;?></td>
                 
                  <td align="center" ><input type="text" name="pd[]" id="pd<?php echo $z;?>" value="<?php echo $invoiceFetch->inv_no;?>" readonly="" style="text-align: center; width: 100%; border:hidden;"></td>
                  <td align="center" style="display:none" ><input type="text" name="pd[]" id="pd<?php echo $z;?>" value="<?php echo $invoiceFetch->order_no;?>" readonly="" style="text-align: center; width: 100%; border:hidden;"></td>
                  <td align="center" style="display:none" ><input type="text" name="pd[]" id="pd<?php echo $z;?>" value="<?php echo $invoiceFetch->inv_date;?>" readonly="" style="text-align: center; width: 100%; border:hidden;"></td>
                  <td align="center" style="display:none" ><input type="text" name="pd[]" id="pd<?php echo $z;?>" value="<?php echo $invoiceFetch->grn_no;?>" readonly="" style="text-align: center; width: 100%; border:hidden;"></td>
                  <td align="center" style="display:none" ><input type="text" name="pd[]" id="pd<?php echo $z;?>" value="<?php echo $invoiceFetch->grn_date;?>" readonly="" style="text-align: center; width: 100%; border:hidden;"></td>
                  
                  
                  <td>
                  
                  <a href="#" onClick="JavaScript:popup('inbound/EditInv?&popup=True&id=<?=$_GET['id'];?>&inv_no=<?=$invoiceFetch->inv_no;?>&inc_id=<?=$invoiceFetch->inc_id;?>')">Edit Invoice</a> |  <a href="#" id="<?php echo $invoiceFetch->inv_no."^".tbl_stock_in_inv_hdr."^".inv_no ; ?>" class="delbutton icon"><i class="glyphicon glyphicon-remove"></i></a> 
</td>
                </tr>
                
                <?php $row=$z; $z++;  } ?>
              </table>
            </div>
           
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" >
              <tbody>
                
                
                
                
                
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
<script type="text/javascript">
function popup(url) {
    popupWindow = window.open( url, 'popUpWindow',
        "height=600,width=1298,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes"
    )
}
</script>