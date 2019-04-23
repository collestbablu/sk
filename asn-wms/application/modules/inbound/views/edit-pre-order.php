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
document.getElementById("tariff_no").focus();
}
}

/*
document.getElementById("hsn_code").onkeyup = function (e) {
var entr =(e.keyCode);
if(entr==13){


document.getElementById("tariff_no").focus();
}
}
*/

document.getElementById("tariff_no").onkeyup = function (e) {
var entr =(e.keyCode);
if(entr==13){


document.getElementById("doms_tariff_no").focus();
}
}





document.getElementById("doms_tariff_no").onkeyup = function (e) {
var entr =(e.keyCode);
if(document.getElementById("doms_tariff_no").value=="" && entr==08){

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
		var grn_datee=document.getElementById("grn_datee"+id).value;
		var grn_noo=document.getElementById("grn_noo"+id).value;
		var no_of_dayss=document.getElementById("no_of_dayss"+id).value;
		var unit=document.getElementById("unit"+id).value;
		var qn=document.getElementById("qnty"+id).value;
		
		var lph=document.getElementById("lph"+id).value;
		
		var discount=document.getElementById("dis"+id).value;
		var disAmt=document.getElementById("disAmount"+id).value;
		
		var tot=document.getElementById("tot"+id).value;
		var nettot=document.getElementById("nettot"+id).value;
		
		var pri_id=document.getElementById("main_id"+id).value;
		
		var qty_stock=document.getElementById("qty_stock"+id).value;
		var hsn_code=document.getElementById("hsn_code"+id).value;
		var tariff_no=document.getElementById("tariff_no"+id).value;
		var des1=document.getElementById("des1"+id).value;
		var des2=document.getElementById("des2"+id).value;
		var doms_tariff_no=document.getElementById("doms_tariff_no"+id).value;
		
		
		// ####### ends ##############//

		// ####### starts ##############//
		
		document.getElementById("pri_id").value=pri_id;
		document.getElementById("grn_datee").value=grn_datee;
		document.getElementById("grn_noo").value=grn_noo;
		document.getElementById("no_of_dayss").value=no_of_days;
		document.getElementById("qn").focus();
		document.getElementById("prd").value=pd;
		document.getElementById("usunit").value=unit;
		document.getElementById("qn").value=qn;
		document.getElementById("lpr").innerHTML=lph;
		document.getElementById("lph").value=lph;
		document.getElementById("discount").value=discount;
		document.getElementById("disAmt").value=disAmt;
		document.getElementById("tot").value=tot;
		document.getElementById("nettot").value=nettot;
document.getElementById("qty_stock").value=qty_stock;
document.getElementById("hsn_code").value=hsn_code;
document.getElementById("tariff_no").value=tariff_no;
document.getElementById("des1").value=des1;
document.getElementById("des2").value=des2;
document.getElementById("doms_tariff_no").value=doms_tariff_no;


		// ####### ends ##############//
		
		// ####   EDIT CALCULATION      ##############//
		
		var sub_total=document.getElementById("sub_total").value;
		sub_total_cal=sub_total-nettot;
		document.getElementById("sub_total").value=sub_total_cal.toFixed(2);
		document.getElementById("grand_total").value=sub_total_cal.toFixed(2);

        //####    EDIT CALCULATION       ############//
		
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
				
				var grn_datee=document.getElementById("grn_datee").value;
				var grn_noo=document.getElementById("grn_noo").value;
				var no_of_dayss=document.getElementById("no_of_dayss").value;				
				var unit=document.getElementById("usunit").value;
				var lph=document.getElementById("lph").value;
				var dis=document.getElementById("discount").value;	
				var disAmount=document.getElementById("disAmt").value;		
		        var tot=document.getElementById("tot").value;
				var nettot=document.getElementById("nettot").value;
			  	var qty_stock=document.getElementById("qty_stock").value;
				var hsn_code=document.getElementById("hsn_code").value;
				var tariff_no=document.getElementById("tariff_no").value;
				var des1=document.getElementById("des1").value;
				var des2=document.getElementById("des2").value;
				var doms_tariff_no=document.getElementById("doms_tariff_no").value;
			
				
				//default
				var rows=document.getElementById("rows").value;
				var pri_id=document.getElementById("pri_id").value;
				var pd=document.getElementById("prd").value;
				
		   	   var table = document.getElementById("invoice");
					var rid =Number(rows)+1;
					document.getElementById("rows").value=rid;
					
						
							totalSum();	
							serviceChargeCal();
							grossDiscountCal();				
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
	
	
	
	
	
	
	
	
		
	//#################cell 2nd starts here####################//
	
	
	
	
	
	
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;
        cell = row.insertCell(indexcell);
				cell.style.width="8%";
				//cell.style.display="none";
				cell.align="center"
				var grnN = document.createElement("input");
							grnN.type="text";
							grnN.border ="0";
							grnN.value=grn_noo;	    
							grnN.name ='grn_noo[]';
							grnN.id='grn_noo'+rid;
							//grnN.readOnly = true;
							grnN.style="text-align:center";
							grnN.style.width="100%";
							grnN.style.border="hidden"; 
							cell.appendChild(grnN);
					
	
	//########s#########//
	
	//#################cell 2nd starts here####################//
	
	
	
	
	
	
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;
        cell = row.insertCell(indexcell);
				cell.style.width="8%";
				//cell.style.display="none";
				cell.align="center"
				var grnD = document.createElement("input");
							grnD.type="text";
							grnD.border ="0";
							grnD.value=grn_datee;	    
							grnD.name ='grn_datee[]';
							grnD.id='grn_datee'+rid;
							//grnD.readOnly = true;
							grnD.style="text-align:center";
							grnD.style.width="100%";
							grnD.style.border="hidden"; 
							cell.appendChild(grnD);
					
	
	//########s#########//

	
	//#################cell 2nd starts here####################//
	
	
	
	
	
	
	indexcell=Number(indexcell+1);		
	var cell=cell+indexcell;
        cell = row.insertCell(indexcell);
				cell.style.width="8%";
				//cell.style.display="none";
				cell.align="center"
				var grnNO = document.createElement("input");
							grnNO.type="text";
							grnNO.border ="0";
							grnNO.value=no_of_dayss;	    
							grnNO.name ='no_of_dayss[]';
							grnNO.id='no_of_dayss'+rid;
							//grnNO.readOnly = true;
							grnNO.style="text-align:center";
							grnNO.style.width="100%";
							grnNO.style.border="hidden"; 
							cell.appendChild(grnNO);
					
	
	//########s#########//
	
	
	
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
		
		
		
		//===================================start 5th cell================================
		indexcell=Number(indexcell+1);		
		var cell=cell+indexcell;		
	    cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.style.display="none";
				cell.align="center"	
				
												
				var disAmtt = document.createElement("input");
							disAmtt.type="text";
							disAmtt.border ="0";
							disAmtt.value=hsn_code;	
							disAmtt.name ='hsn_code[]';
							disAmtt.id='hsn_code'+rid;
							disAmtt.readOnly = true;
							disAmtt.style="text-align:center";
							disAmtt.style.width="100%";
							disAmtt.style.border="hidden"; 
							cell.appendChild(disAmtt);
		//===============================close 5th cell=================================
		
		
		

//===================================start 5th cell================================
		indexcell=Number(indexcell+1);		
		var cell=cell+indexcell;		
	    cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center"	
				
												
				var disAmtt = document.createElement("input");
							disAmtt.type="text";
							disAmtt.border ="0";
							disAmtt.value=tariff_no;	
							disAmtt.name ='tariff_no[]';
							disAmtt.id='tariff_no'+rid;
							disAmtt.readOnly = true;
							disAmtt.style="text-align:center";
							disAmtt.style.width="100%";
							disAmtt.style.border="hidden"; 
							cell.appendChild(disAmtt);
		//===============================close 5th cell=================================
		
		
		

//===================================start 5th cell================================
		indexcell=Number(indexcell+1);		
		var cell=cell+indexcell;		
	    cell = row.insertCell(indexcell);
				cell.style.width="3%";
				cell.align="center"	
				
												
				var doms_tariff_noD = document.createElement("input");
							doms_tariff_noD.type="text";
							doms_tariff_noD.border ="0";
							doms_tariff_noD.value=doms_tariff_no;	
							doms_tariff_noD.name ='doms_tariff_no[]';
							doms_tariff_noD.id='doms_tariff_no'+rid;
							doms_tariff_noD.readOnly = true;
							doms_tariff_noD.style="text-align:center";
							doms_tariff_noD.style.width="100%";
							doms_tariff_noD.style.border="hidden"; 
							cell.appendChild(doms_tariff_noD);
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
		document.getElementById("lph").value='';
		document.getElementById("lpr").innerHTML ='';
		document.getElementById("discount").value='';
		document.getElementById("disAmt").value='';
		document.getElementById("tot").value='';
		document.getElementById("nettot").value='';
		document.getElementById("qn").value='';
		document.getElementById("pri_id").value='';
		document.getElementById("qty_stock").value='';
		document.getElementById("hsn_code").value='';
		document.getElementById("tariff_no").value='';
		document.getElementById("des1").value='';
		document.getElementById("des2").value='';
		document.getElementById("doms_tariff_no").value='';
		
		
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
$tableName='tbl_product_stock';
$location='manage_item';
		
		$userQuery = $this -> db
           -> select('*')
		   -> where('stockinid',$_GET['id'])
		   -> or_where('stockinid',$_GET['view'])
           -> get('tbl_stock_in_hdr');
		  $branchFetch = $userQuery->row();


$international_tat = (strtotime($branchFetch->ata_date) - strtotime($branchFetch->eta_date))  / (60 * 60 * 24);
$lead_time_from_ata = (strtotime($branchFetch->date_of_receipt_at_warehose) - strtotime($branchFetch->ata_date))  / (60 * 60 * 24);
$lead_time_from_hawb = (strtotime($branchFetch->date_of_receipt_at_warehose) - strtotime($branchFetch->HAWB_booking_date))  / (60 * 60 * 24);
$no_of_days = (strtotime($branchFetch->date_of_receipt_at_warehose) - strtotime($branchFetch->grn_date))  / (60 * 60 * 24);

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
		<h4 class="panel-title">Update Pre Alert</h4>
		<?php }elseif($_GET['view']!=''){ ?>
		<h4 class="panel-title">View Pre Alert</h4>
		<?php }else{ ?> 
		<h4 class="panel-title"><strong>Add Pre Alert</strong></h4>
		<?php } ?>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
</ul>
</div>
<div class="panel-body">
<form class="form-horizontal" onSubmit="return checkKeyPressed(a)" method="post" action="updateInbound" enctype="multipart/form-data">
<div class="form-group"> 
<label class="col-sm-2 control-label">*HAWB:</label> 
<div class="col-sm-4" id="regid"> 
<input type="hidden" name="id" value="<?=$_GET['id'];?>">
<input type="text" name="hawb" min="1" step="any" value="<?php echo $branchFetch->hawb; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" required>
</div>  
<label class="col-sm-2 control-label">*HAWB Booking date:</label> 
<div class="col-sm-4" id="regid"> 
<input name="HAWB_booking_date"  type="date" id="hawb_date" onChange="orderdate()" value="<?php echo $branchFetch->HAWB_booking_date; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> required>
</div> 
</div>




<div class="form-group"> 
<div class="field">

<label class="col-sm-2 control-label">*MAWB No:</label> 
<div class="col-sm-4">
  <input name="mawb_no"  type="text" value="<?php echo $branchFetch->mawb_no; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> required>
  <a onClick="openpopup('<?=base_url();?>master/ProductCategory/add_itemctg',900,630,'mid','121')"><img src="<?php echo base_url();?>/assets/images/addcontact.png" style="display:none" width="25px" height="25px"/></a> </div> 
</div>
<div class="field">
<label class="col-sm-2 control-label">*Date:</label> 
<div class="col-sm-4" id="regid"> 
 

<input type="date" name="date" value="<?php echo $branchFetch->date; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" required>

</div> 
</div>
</div>


<div class="form-group"> 
<label class="col-sm-2 control-label">*Origin:</label> 
<div class="col-sm-4" id="regid">

<select name="origin"  class="form-control ui fluid search dropdown email" required <?php if(@$_GET['view']!=''){ ?> disabled="disabled" <?php }?> >
     <option value="">----Select ----</option>
    <?php
	$bookingType=$this->db->query("select *from tbl_master_data  where param_id='25'");
	foreach($bookingType->result() as $getBooking){
	?>
   <option value="<?=$getBooking->serial_number;?>" <?php if($getBooking->serial_number==$branchFetch->origin){?> selected <?php }?>><?=$getBooking->keyvalue;?></option>
   <?php }?>

  </select> 

</div>  
<label class="col-sm-2 control-label">*Port Of Loading:</label> 
<div class="col-sm-4" id="regid"> 
<select name="port_of_loading"  class="form-control ui fluid search dropdown email" required <?php if(@$_GET['view']!=''){ ?> disabled="disabled" <?php }?> >
    <option value="">----Select ----</option>
    <?php
	$bookingType=$this->db->query("select *from tbl_master_data  where param_id='32'");
	foreach($bookingType->result() as $getBooking){
	?>
   <option value="<?=$getBooking->serial_number;?>" <?php if($getBooking->serial_number==$branchFetch->port_of_loading){?> selected <?php }?>><?=$getBooking->keyvalue;?></option>
   <?php }?>
  </select>
</div> 
</div>







<div class="form-group"> 
<div class="field">
<label class="col-sm-2 control-label">*Gross Weight(KG):</label> 
<div class="col-sm-4">
<input type="text" class="form-control" name="gross_weight" value="<?=$branchFetch->gross_weight;?>">
 
  </div> 
</div>
<div class="field">
<label class="col-sm-2 control-label">*Pallet:</label> 
<div class="col-sm-4" id="regid"> 
 <input name="pallet"  type="text" value="<?php echo $branchFetch->pallet; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> required>
</div> 
</div>
</div>







<div class="form-group"> 
<div class="field">
<label class="col-sm-2 control-label">ETA Date:</label> 
<div class="col-sm-4">
 <input type="date" name="eta_date" id="eta_date" min="1" step="any" onChange="atafun()" value="<?php echo $branchFetch->eta_date; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" required>
  </div> 
</div>
<div class="field">
<label class="col-sm-2 control-label">Destination</label> 
<div class="col-sm-4" id="regid"> 
<select name="destination"  class="form-control ui fluid search dropdown email" required <?php if(@$_GET['view']!=''){ ?> disabled="disabled" <?php }?> >
    <option value="">----Select ----</option>
    <?php
	$bookingType=$this->db->query("select *from tbl_master_data  where param_id='25'");
	foreach($bookingType->result() as $getBooking){
	?>
   <option value="<?=$getBooking->serial_number;?>" <?php if($getBooking->serial_number==$branchFetch->destination){?> selected <?php }?>><?=$getBooking->keyvalue;?></option>
   <?php }?>
  </select>
 
</div> 
</div>

</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">ATA Date:</label> 
<div class="col-sm-4" id="regid"> 
<input type="date" class="form-control" name="ata_date" id="ata_date" onChange="atafun();atastatusfun()" value="<?=$branchFetch->ata_date;?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> >

</div>  
<label class="col-sm-2 control-label">*Pre Alert Date:</label> 
<div class="col-sm-4" id="regid"> 
<input type="date" name="pre_alert_date" value="<?php echo $branchFetch->pre_alert_date; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" required>
</div> 
</div>
<script>
function atastatusfun(){
document.getElementById("statuss").value='37';	
}
function gestatusfun(){
document.getElementById("statuss").value='38';	
}
function mrnstatusfun(){
document.getElementById("statuss").value='39';	
}
function grnstatusfun(){
document.getElementById("statuss").value='41';	
}
</script>
<div class="form-group"> 
<label class="col-sm-2 control-label">*Invoice No.:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="invoice_no" min="1" step="any" value="<?php echo $branchFetch->invoice_no; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" required>
</div>  
<label class="col-sm-2 control-label">*Order No.:</label> 
<div class="col-sm-4" id="regid"> 
 <input type="text" name="order_no" value="<?php echo $branchFetch->order_no; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" required></div> 
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">Status</label> 
<div class="col-sm-4" id="regid"> 
<select name="status"  id="statuss" class="form-control"  <?php if(@$_GET['view']!=''){ ?> disabled="disabled" <?php }?> >
  
    <?php
	$bookingType=$this->db->query("select *from tbl_master_data  where param_id='27' ");
	foreach($bookingType->result() as $getBooking){
	?>
   <option value="<?=$getBooking->serial_number;?>" <?php if($getBooking->serial_number==$branchFetch->status){?> selected <?php }?>><?=$getBooking->keyvalue;?></option>
   <?php }?>
  </select>
</div>  
<label class="col-sm-2 control-label">Invoice Date</label> 
<div class="col-sm-4" id="regid"> 
  <input type="date" name="invoice_date" value="<?php echo $branchFetch->invoice_date; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" ></div> 
</div>

<div class="form-group" style="display:none"> 
<div class="field">
<label class="col-sm-2 control-label">&nbsp;</label> 
<div class="col-sm-4">
 &nbsp;
  </div> 
</div>
<div class="field">
<label class="col-sm-2 control-label">Order Date:</label> 
<div class="col-sm-4" id="regid"> 
  <input type="date" class="form-control" name="order_date" id="order_date"   value="<?=$branchFetch->order_date;?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?>>
</div> 
</div>
</div>

<div class="form-group"> 
<div class="field">
<label class="col-sm-2 control-label">Duty Amount:</label> 
<div class="col-sm-4">
<input name="duty_amount"  type="number" step="any" value="<?php echo $branchFetch->duty_amount; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> >
 
  </div> 
</div>
<div class="field">
<label class="col-sm-2 control-label">IGST Amount:</label> 
<div class="col-sm-4" id="regid"> 
 <input name="igst_amount"  type="text" value="<?php echo $branchFetch->igst_amount; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> >
</div> 
</div>
</div>
<div class="form-group"> 
<div class="field">
<label class="col-sm-2 control-label">Gate Entry:</label> 
<div class="col-sm-4">
<input name="gate_entry"  type="text" value="<?php echo $branchFetch->gate_entry; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> >
 
  </div> 
</div>
<div class="field">
<label class="col-sm-2 control-label">GE Date:</label> 
<div class="col-sm-4" id="regid"> 
 <input name="ge_date"  type="date" onChange="gestatusfun()" value="<?php echo $branchFetch->ge_date; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> >
</div> 
</div>
</div>
<div class="form-group"> 
<div class="field">
<label class="col-sm-2 control-label">GE Time:</label> 
<div class="col-sm-4">

<input name="ge_time"  type=time  value="<?php echo $branchFetch->ge_time; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> >
 
  </div> 
</div>
<div class="field">
<label class="col-sm-2 control-label">Vehicle Number:</label> 
<div class="col-sm-4" id="regid"> 
 <input name="vehicle_number"  type="text" value="<?php echo $branchFetch->vehicle_number; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> >
</div> 
</div>
</div>
<div class="form-group"> 
<div class="field">
<label class="col-sm-2 control-label">Unloading Date:</label> 
<div class="col-sm-4">
<input name="unloading_date"  type="date" value="<?php echo $branchFetch->unloading_date; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> >
 
  </div> 
</div>
<div class="field">
<label class="col-sm-2 control-label">*Unloading Time:</label> 
<div class="col-sm-4" id="regid"> 
 <input name="unloading_time"  type=time  value="<?php echo $branchFetch->unloading_time; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> >
</div> 
</div>
</div>

<div class="form-group"> 
<div class="field">
<label class="col-sm-2 control-label">Date Of Receipt at warehouse:</label> 
<div class="col-sm-4">
<input name="date_of_receipt_at_warehose" id="date_of_receipt_at_warehose"  type="date" onChange="atafun();orderdate();grnfun()" value="<?php echo $branchFetch->date_of_receipt_at_warehose; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> >
 
  </div> 
</div>

<script>
/*
function datefun(){
//alert(v);
//var from =v;
//var n = new Date(Date.parse(v)); // Sat May 02 2015 00:00:00
// var dor = Date.parse(v);
var date_of_receipt_at_warehoses=document.getElementById("date_of_receipt_at_warehose").value;
var date_of_receipt_at_warehosesno = Date.parse(date_of_receipt_at_warehoses);
var ata_date=document.getElementById("ata_date").value;
var atano = Date.parse(ata_date);
var leadtime=date_of_receipt_at_warehosesno-atano;
var daysDiffl = leadtime / 1000 / 60 / 60 / 24;
document.getElementById("lead_time_from_ata").value=daysDiffl;	
//======================================================================
var order_date=document.getElementById("order_date").value;
var odrno = Date.parse(order_date);
var leadtimehawb=dor-odrno;
var daysDiffhawb = leadtimehawb / 1000 / 60 / 60 / 24;
document.getElementById("lead_time_from_hawb").value=daysDiffhawb;
//==================

var monthid=n.getMonth()+1;

if(monthid==1){
		var monthname="January";
}else if(monthid==2){
		var monthname="February";
}else if(monthid==3){
		var monthname="March";
}else if(monthid==4){
		var monthname="April";
}else if(monthid==5){
		var monthname="May";
}else if(monthid==6){
		var monthname="June";
}else if(monthid==7){
		var monthname="July";
}else if(monthid==8){
		var monthname="August";
}else if(monthid==9){
		var monthname="September";
}else if(monthid==10){
		var monthname="October";
}else if(monthid==11){
		var monthname="November";
}else if(monthid==12){
		var monthname="December";
}

var pro=monthname;
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "getproductcase_fun?con="+pro, false);
  xhttp.send();
  document.getElementById("dividm").innerHTML = xhttp.responseText;
  
  }*/
</script>
<script>
function atafun(){
//alert("hello");
		var eta=document.getElementById("eta_date").value;	
		var ata=document.getElementById("ata_date").value;
		var seta = new Date(Date.parse(eta)); 
		var sata = new Date(Date.parse(ata)); 
		var msDiff=sata-seta;
		var daysDiff = msDiff / 1000 / 60 / 60 / 24;
		document.getElementById("international_tat").value=daysDiff;
		
		var atano = Date.parse(ata);
		var date_of_receipt_at_warehoses=document.getElementById("date_of_receipt_at_warehose").value;
		var date_of_receipt_at_warehosesno = Date.parse(date_of_receipt_at_warehoses);
		var leadtime=date_of_receipt_at_warehosesno-atano;
		var daysDifflo = leadtime / 1000 / 60 / 60 / 24;
		document.getElementById("lead_time_from_ata").value=daysDifflo;
		
}

function orderdate(){
var date_of_receipt_at_warehoses=document.getElementById("date_of_receipt_at_warehose").value;
var date_of_receipt_at_warehosesno = Date.parse(date_of_receipt_at_warehoses);
var order_date=document.getElementById("hawb_date").value;
var odrno = Date.parse(order_date);
var leadtimehawb=date_of_receipt_at_warehosesno-odrno;
var daysDiffhawb = leadtimehawb / 1000 / 60 / 60 / 24;
document.getElementById("lead_time_from_hawb").value=daysDiffhawb;
}
function grnfun(){
var date_of_receipt_at_warehoses=document.getElementById("date_of_receipt_at_warehose").value;
var date_of_receipt_at_warehosesno = Date.parse(date_of_receipt_at_warehoses);
var order_date=document.getElementById("grn_datee").value;
var odrno = Date.parse(order_date);
var leadtimehawb=odrno-date_of_receipt_at_warehosesno;
var daysDiffhawb = leadtimehawb / 1000 / 60 / 60 / 24;
document.getElementById("no_of_dayss").value=daysDiffhawb;
}

function grnfun1(v){
var zz=document.getElementById(v).id;
var myarra = zz.split("grn_date");
var asx= myarra[1];
var pri=document.getElementById("grn_date"+asx).value;
//alert(pri);
var odrno = Date.parse(pri);
//alert(odrno);
var date_of_receipt_at_warehoses=document.getElementById("date_of_receipt_at_warehose").value;
var date_of_receipt_at_warehosesno = Date.parse(date_of_receipt_at_warehoses);
//var order_date=document.getElementById("grn_date1").value;
//var odrno = Date.parse(order_date);
var leadtimehawb=odrno-date_of_receipt_at_warehosesno;
var daysDiffhawb = leadtimehawb / 1000 / 60 / 60 / 24;
//alert(daysDiffhawb);
document.getElementById("no_of_days"+asx).value=daysDiffhawb;
}



</script>
<div class="field">
<label class="col-sm-2 control-label">International TAT(ATA-ETA):</label> 
<div class="col-sm-4" id="regid"> 
 <input name="international_tat" id="international_tat"  type="text" value="<?php echo  $international_tat;//$branchFetch->international_tat; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> >
</div> 
</div>
</div>
<div class="form-group"> 
<div class="field">
<label class="col-sm-2 control-label">Lead Time(from ATA Del to Recipt at warehouse):</label> 
<div class="col-sm-4">
<input name="lead_time_from_ata" id="lead_time_from_ata"  type="text" value="<?php echo $lead_time_from_ata;//$branchFetch->lead_time_from_ata; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> >
 
  </div> 
</div>
<div class="field">
<label class="col-sm-2 control-label">Lead time(from HAWB to Recipt at w/h):</label> 
<div class="col-sm-4" id="regid"> 
 <input name="lead_time_from_hawb" id="lead_time_from_hawb"  type="text" value="<?php echo $lead_time_from_hawb;//$branchFetch->lead_time_from_hawb; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> >
</div> 
</div>
</div>

<div class="form-group"> 
<div class="field">
<label class="col-sm-2 control-label">Receipt of Month:</label> 
<div class="col-sm-4">
<div id="dividm">
<select name="receipt_of_month"  class="form-control ui fluid search dropdown email"  <?php if(@$_GET['view']!=''){ ?> disabled="disabled" <?php }?> >
    <option value="">----Select ----</option>
    <?php
	$bookingType=$this->db->query("select *from tbl_master_data  where param_id='28'");
	foreach($bookingType->result() as $getBooking){
	?>
   <option value="<?=$getBooking->serial_number;?>" <?php if($getBooking->serial_number==$branchFetch->receipt_of_month){?> selected <?php }?>><?=$getBooking->keyvalue;?></option>
   <?php }?>
  </select>

 </div>
  </div> 
</div>
<div class="field">
<label class="col-sm-2 control-label">BOE NO.</label> 
<div class="col-sm-4" id="regid"> 
 <input name="boe_no"  type="text" value="<?php echo $branchFetch->boe_no; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> >
</div> 
</div>
</div>


<div class="form-group"> 
<div class="field">
<label class="col-sm-2 control-label">Exchange Rate 1 USD/EURO:</label> 
<div class="col-sm-4">
<input name="exchange_rate"  type="text" value="<?php echo $branchFetch->exchange_rate; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> > 
  </div> 
</div>
<div class="field">
<label class="col-sm-2 control-label">BOE Date:</label> 
<div class="col-sm-4" id="regid"> 
 <input name="boe_date"  type="date" value="<?php echo $branchFetch->boe_date; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> >
</div> 
</div>
</div>

<div class="form-group"> 
<div class="field">
<label class="col-sm-2 control-label">Control No.:</label> 
<div class="col-sm-4">
<input name="control_no"  type="text" value="<?php echo $branchFetch->control_no; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> >
 
  </div> 
</div>
<div class="field">
<label class="col-sm-2 control-label">MRN Date:</label> 
<div class="col-sm-4" id="regid"> 
 <input name="mrn_date"  type="date" onChange="mrnstatusfun()" value="<?php echo $branchFetch->mrn_date; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> >
</div> 
</div>
</div>
<div class="form-group"> 
<div class="field">
<label class="col-sm-2 control-label">MRN Sent Time:</label> 
<div class="col-sm-4">
<input name="mrn_sent_time"  type=time  value="<?php echo $branchFetch->mrn_sent_time; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> >
 
  </div> 
</div>
<div class="field">
<label class="col-sm-2 control-label">&nbsp;</label> 
<div class="col-sm-4" id="regid"> 
 &nbsp;
</div> 
</div>
</div>

<div class="form-group"> 
<div class="field">
<label class="col-sm-2 control-label">Pkg:</label> 
<div class="col-sm-4">
<input name="pkg"  type="text" value="<?php echo $branchFetch->pkg; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> >
 
  </div> 
</div>
<div class="field">
<label class="col-sm-2 control-label">Currency</label> 
<div class="col-sm-4" id="regid"> 
 <input name="currency"  type="text" value="<?php echo $branchFetch->currency; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> >
</div> 
</div>
</div>


<div class="form-group" style="display:none"> 
<div class="field">
<label class="col-sm-2 control-label">GRN NO.:</label> 
<div class="col-sm-4">
<input name="grn_no"  type="text" onKeyUp="grnstatusfun()" value="<?php echo $branchFetch->grn_no; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> >
 
  </div> 
</div>
<div class="field">
<label class="col-sm-2 control-label">GRN Date:</label> 
<div class="col-sm-4" id="regid"> 
 <input name="grn_date"  type="date" id="grn_date" onChange="grnfun()"  value="<?php echo $branchFetch->grn_date; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> >
</div> 
</div>
</div>

<div class="form-group" style="display:none"> 
<div class="field">
<label class="col-sm-2 control-label">NO OF DAYS FROM W-H RECIPT TO GRN DATE:</label> 
<div class="col-sm-4">
<input name="no_of_days"  id="no_of_days" type="text" value="<?php echo $no_of_days; //$branchFetch->no_of_days; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> >
 
  </div> 
</div>
<div class="field">
<label class="col-sm-2 control-label">&nbsp;</label> 
<div class="col-sm-4" id="regid"> 
&nbsp;
</div> 
</div>
</div>

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" <?php if($_GET['view']!=''){?> oncontextmenu='return false;' onkeydown='return false;' onmousedown='return false;' <?php }?> >
<tbody>
<tr class="gradeA">
<th>Product Code</th>
<th>Description1</th>
<th>Description2</th>
<th>Quantity In Stock</th>
<th>Unit of Measurment</th>
<th>MRP</th>
<th>Unit Price</th>
<th>Qty</th>
<th>Qty Rec.</th>
<th>Diff. Qty</th>

<th>GRN No.</th>
<th>GRN Date</th>
<th style="width:200px;">NO OF DAYS </th>

<th style="display:none">HSN</th>
<th>International Tariff No.</th>
<th>HSN Code</th>
<th>Total</th>
<th>Net Price</th>
</tr>

<tr class="gradeA">
<th style="width:280px;">
<div class="input-group"> 
<div style="width:100%; height:28px;" >
<input type="text" name="prd"  onkeyup="getdata()" class="form-control" onClick="getdata()" id="prd" style=" width:100px;"  placeholder=" Search Items..." tabindex="5" >
 <input type="hidden"  name="pri_id" id='pri_id'  value="" style="width:80px;"  />
 <input type="hidden"  name="dtl_idd" id='dtl_idd'  value="" style="width:80px;"  />
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
<input type="text" readonly="" id="qty_stock" style="width:70px;" class="form-control"> 
</th>

<th>
<input type="text" readonly="" id="usunit" style="width:70px;" class="form-control"> 
</th>
<th>
<b id="lpr"></b>
</th>
<th><input type="number" step="any" id="lph" min="1"  value="" class="form-control" style="width:90px;">
</th>
<th><input type="number" id="qn" min="1" style="width:70px;"   class="form-control"></th>

<th><input type="number" step="any" name="saleamnt" id="discount" class="form-control"  style="width:70px;"/ ></th>
<th><input type="number" step="any" name="saleamnt" id="disAmt" class="form-control"   style="width:70px;"/ ></th>


<th><input type="text" step="any" name="saleamnt" id="grn_noo" onKeyUp="grnstatusfun()" class="form-control"   style="width:110px;"/ ></th>
<th><input type="date"  name="saleamnt" id="grn_datee" onChange="grnfun()" class="form-control"   style="width:110px;"/ ></th>

<th><input type="number" step="any" name="saleamnt" id="no_of_dayss" class="form-control"   style="width:60px;"/ readonly="" ></th>

<th style="display:none"><input type="text" step="any" name="saleamnt" id="hsn_code" class="form-control"  style="width:90px;"/ ></th>
<input type="hidden" step="any" name="saleamnt" id="int_tariff" class="form-control"   style="width:90px;"/ >
<th><input type="number" step="any" name="saleamnt" id="tariff_no" class="form-control"   style="width:110px;"/ ></th>

<th><input type="number" step="any" name="saleamnt" id="doms_tariff_no" class="form-control"   style="width:110px;"/ ></th>

<th><input type="text" name="saleamnt" readonly="" id="tot" class="form-control"  style="width:70px;"/ ></th>
<th><input type="text" name="saleamnt" readonly="" id="nettot" class="form-control"  style="width:70px;"/ ></th>
</tr>
</tbody>
</table>
</div>
<div style="width:100%; background:#dddddd; padding-left:0px; color:#000000; border:2px solid ">
<table id="invo" style="width:100%;  background:#dddddd;  height:70%;" title="Invoice"  >
<tr>
<td style="width:1%;"><div align="center"><u>Sl No</u>.</div></td>
<td style="width:5%;"><div align="center"><u>Product Code</u></div></td>
<td style="width:8%;"><div align="center"><u>GRN Number</u></div></td>
<td style="width:8%;"><div align="center"><u>GRN Date</u></div></td>
<td style="width:2%;"><div align="center"><u>Number Of days</u></div></td>
<td style="width:8%;"><div align="center"><u>Description1</u></div></td>
<td style="width:8%;"><div align="center"><u>Description2</u></div></td>
<td style="width:3%;"> <div align="center"><u>Unit Price</u></div></td>
<td style="width:3%;"><div align="center"><u>Qty</u></div></td>
<td style="width:3%;"> <div align="center"><u>Qty Rec.</u></div></td>
<td style="width:3%;"> <div align="center"><u>Qty Diff.</u></div></td>
<td style="width:3%; display:none"><div align="center"><u>HSN Code</u></div></td>
<td style="width:3%;"><div align="center"><u>Int.Tariff</u></div></td>
<td style="width:3%;"><div align="center"><u>HSN Code</u></div></td>

<td style="width:3%;"> <div align="center"><u>Total</u></div></td>
<td style="width:3%;"> <div align="center"><u>Net Price</u></div></td>
<td style="width:3%;"> <div align="center"><u>Action</u></div></td>
</tr>
</table>


<div style="width:100%; background:white;   color:#000000;  max-height:170px; overflow-x:auto;overflow-y:auto;" id="m">
<table id="invoice"  style="width:100%;background:white;margin-bottom:0px;margin-top:0px;min-height:30px;" title="Invoice" class="table table-bordered blockContainer lineItemTable ui-sortable"  >

<tr></tr>
<?php
$z=1;
$query_dtl=$this->db->query("select * from tbl_stock_in_dtl where stockinhdr='".$_GET['id']."' or stockinhdr='".$_GET['view']."' ");
foreach($query_dtl->result() as $invoiceFetch)
{

$productQuery=$this->db->query("select *from tbl_product_stock where Product_id='$invoiceFetch->product_id'");
$getProductName=$productQuery->row();



$unitQuery=$this->db->query("select *from tbl_master_data where serial_number='$getProductName->usageunit'");
$getunitName=$unitQuery->row();

?>
<tr>
<td align="center" style="width: 1%;"><?php echo $z;?></td>

<td align="center" style="width: 5%;"><input type="text" name="pd[]" id="pd<?php echo $z;?>" value="<?php echo $getProductName->sku_no;?>" readonly="" style="text-align: center; width: 100%; border:hidden;"></td>

<td align="center" style="width: 5%;"><input type="text" class="form-control" name="grn_noo[]" id="grn_noo<?php echo $z;?>" onKeyUp="grnstatusfun()" value="<?php echo $invoiceFetch->grn_no;?>"  style="text-align: center; width: 100%; border:hidden1;"></td>


<td align="center" style="width: 5%;"><input type="date" class="form-control" name="grn_datee[]" id="grn_datee<?php echo $z;?>" onChange="grnfun1(this.id)" value="<?php echo $invoiceFetch->grn_date;?>"  style="text-align: center; width: 100%; border:hidden1;"></td>


<td align="center" style="width: 4%;"><input type="text" class="form-control" name="no_of_dayss[]" id="no_of_dayss<?php echo $z;?>" value="<?php echo $invoiceFetch->no_of_days;?>"  style="text-align: center; width: 100%; border:hidden1;" readonly=""></td>


<td align="center" style="width: 6%;"><input type="text" name="pdfsdf[]" id="des1<?php echo $z;?>" value="<?php echo $getProductName->productname;?>" readonly="" style="text-align: center; width: 100%; border:hidden;">


<td align="center" style="width: 6%;"><input type="text" name="pdfsd[]" id="des2<?php echo $z;?>" value="<?php echo $getProductName->description2;?>" readonly="" style="text-align: center; width: 100%; border:hidden;">

<input type="hidden" name="main_id[]" id="main_id<?php echo $z;?>" value="<?php echo $invoiceFetch->product_id;?>" readonly="" style="text-align: center; width: 100%; border:hidden;"><input type="hidden" value="<?=$getunitName->keyvalue;?>" name="unit[]" id="unit<?php echo $z;?>" readonly="" style="text-align: center; width: 100%; border: hidden;">
<input type="hidden" value="<?=$getProductName->quantity;?>" name="qty_stockggjh[]" id="qty_stock<?php echo $z;?>" readonly="" style="text-align: center; width: 100%; border: hidden;">
</td>

<td align="center" style="width: 3%;">
<input type="text" name="list_price[]" id="lph<?php echo $z;?>" value="<?php echo $invoiceFetch->list_price;?>" readonly="" style="text-align: center; width: 100%; border: hidden;">


<td align="center" style="width: 3%;"><input type="text" name="qty[]" id="qnty<?php echo $z;?>" value="<?php echo $invoiceFetch->quantity;?>"readonly="" style="text-align: center; width: 100%; border: hidden;"></td>


<td align="center" style="width: 3%;"><input type="text" name="discount[]" id="dis<?php echo $z;?>" value="<?php echo $invoiceFetch->discount;?>"readonly="" style="text-align: center; width: 100%; border: hidden;">
</td>

<td align="center" style="width: 3%;"><input type="text" name="disAmount[]" id="disAmount<?php echo $z;?>" value="<?php echo $invoiceFetch->discount_amount;?>"readonly="" style="text-align: center; width: 100%; border: hidden;">
</td>

<td align="center" style="width: 3%; display:none"><input type="text" name="hsn_code[]" id="hsn_code<?php echo $z;?>" value="<?php echo $invoiceFetch->hsn_code;?>"readonly="" style="text-align: center; width: 100%; border: hidden;"></td>
<td align="center" style="width: 3%;"><input type="text" name="doms_tariff_no[]" id="doms_tariff_no<?php echo $z;?>" value="<?php echo $invoiceFetch->int_tariff;?>"readonly="" style="text-align: center; width: 100%; border: hidden;"></td>
<td align="center" style="width: 3%;"><input type="text" name="tariff_no[]" id="tariff_no<?php echo $z;?>" value="<?php echo $invoiceFetch->tariff_no;?>"readonly="" style="text-align: center; width: 100%; border: hidden;"></td>

<td align="center" style="width: 3%;">
<input type="text" name="tot[]" id="tot<?php echo $z;?>" value="<?php echo $invoiceFetch->total;?>" readonly="" style="text-align: center; width: 100%; border: hidden;">

</td>

<td align="center" style="width: 3%;">

<input type="text" name="nettot[]" id="nettot<?php echo $z;?>" value="<?php echo $invoiceFetch->net_price;?>"readonly="" style="text-align: center; width: 100%; border: hidden;">
</td>

<td align="center" style="width: 3%;"><img src="<?php echo base_url();?>assets/images/delete.png" border="0" name="dlt" id="dlt<?php echo $z;?>" onClick="deleteselectrow(this.id,this);"  readonly style="border: hidden;"><img src="<?php echo base_url();?>assets/images/edit.png" border="0" name="ed" id="ed<?php echo $z;?>" onClick="editselectrow(this.id,this);" style="border: hidden;"></td>
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
<tr class="gradeA">
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

<tr class="gradeA">
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
