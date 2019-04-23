<?php
$con1=$_GET['con'];
$con2=explode("^",$con1);
$con3=$con2[0];
$Productctg_id=$con2[1];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script>
 var x = document.getElementsByClassName("prds");
    function ChangeCurrentCell() {

    }

    ChangeCurrentCell();

    $(document).keydown(function(e){

        if (e.keyCode == 37) { 

           currentCell--;

		   alert(currentCell);

          // ChangeCurrentCell();

           return false;

        }

        if (e.keyCode == 39)

		 { 

           currentCell++;

         //  ChangeCurrentCell();

           return false;

        }
	

        if (e.keyCode == 38)

		 { 
 

		 if(currentCell>0)

		{

		currentCell--;

		//alert(currentCell);

		 x[currentCell].focus();

         x[currentCell].select();

		}

		else

		{

		var mx = document.getElementById("ttsp").value;

		currentCell=mx;


		 x[currentCell].focus();

         x[currentCell].select();

		 currentCell--;

		 //alert("Last...");

		}

		//  alert(currentCell);

              return false;

        }

		
        if (e.keyCode == 40) 

		{ 

		var mx = document.getElementById("ttsp").value;


		if(currentCell<mx)

		{

		 x[currentCell].focus();

         x[currentCell].select();

		currentCell++;

		 e.preventDefault();

		 e.stopPropagation();

		e.returnValue = false;

//Window.focus()

		 //break; 

		//alert(currentCell);

		}

		else

		{

		currentCell=0;

		 x[currentCell].focus();

         x[currentCell].select();

				//alert('rowCount'); 		          

	document.getElementById('prdsrch').scrollTop =0;

		}

		}

	    });


var xobj;

   //modern browers

   if(window.XMLHttpRequest)

    {

	  xobj=new XMLHttpRequest();

	  }
	  //for ie

    else if(window.ActiveXObject)

	   {
	    xobj=new ActiveXObject("Microsoft.XMLHTTP");
		}

		else

		{

	  alert("Your broweser doesnot support ajax");

		  }
         /*   function abc(pt,pr,tid,qs,lq)
		  {
	       		   document.getElementById("prd").value=pt;
					document.getElementById("qn").value=1;
					document.getElementById("lpr").innerHTML=pr;
					document.getElementById("lph").value=pr;
		//document.getElementById("spid").value=tid;
				/*if(qs<lq)
					{
					///alert('The city of ' + city + ' is located in ' + country + '.');
				alert(pt+ '- has Reached to Re-Order Level (' + lq + '). \n Please Re-Order...! ');
					}
			}*/


		  function abc(pt,pr,tid,q,u,quantity,pid,sku_no,des2,tariff,doms_tariff_no){
			 
			
		  				
						//var pid=pt.split("^");
		  				//var pids=pid[1];
					document.getElementById("qty_stock").value=quantity;	
					document.getElementById("pri_id").value=pid;
				 // document.getElementById("sku_no").value=pt;
				   document.getElementById("des1").value=pt;
				   document.getElementById("des2").value=des2;
					document.getElementById("int_tariff").value=tariff;
					document.getElementById("tariff_no").value=tariff;
					document.getElementById("doms_tariff_no").value=doms_tariff_no;
					
					
					document.getElementById("qn").value=1;
					
					document.getElementById("prd").value=sku_no;
					document.getElementById("lpr").innerHTML=pr;
					//document.getElementById("lph").value=pr;
					
					
					document.getElementById("spid").value=tid;
					document.getElementById("usunit").value=u;
					document.getElementById("tpr").innerHTML=pr;
					document.getElementById("tph").value=pr;
					document.getElementById("np").innerHTML=pr;
					document.getElementById("nph").value=pr;
				    document.getElementById("quantity").value=q;					
					document.getElementById("abqt").value=q;
					
		  }



  </script>
</head>
<body>
<?php

 if($con1!="")
 {


  $sel=$this->db->query("select * from tbl_product_stock where productname like '%$con1%' or sku_no like '%$con1%' ");


  $i=0;

  foreach($sel->result() as $arr)
  {
  $usageunit=$arr->usageunit;
  $qty=$arr->quantity;

$product_det1 = $this->db->query("Select * from tbl_master_data where serial_number= '$arr->usageunit'");

	$prod_Details1 = $product_det1->row();

	  $usunit=$prod_Details1->keyvalue;		


// product count

$productCntQuery=$this->db->query("select SUM(quantity) as qty from tbl_product_serial where product_id='".$arr->Product_id."' and comp_id='".$this->session->userdata('comp_id')."'");

$getProductCnt=$productCntQuery->row();
//


  $i++;
  $id='d'; 

  $id.=$i; 
$countid+= count($id);


?>

<input type="text" id="ty<?php echo $id;?>"  class="prds" value="<?php echo $arr->productname.'' ?>" name="<?php echo $id;?>"
 onFocus="abc(this.value,'<?php echo $arr->mrp; ?>',this.id,'<?php echo $qty; ?>','<?php echo $usunit; ?>','<?php echo $getProductCnt->qty; ?>','<?php echo $arr->Product_id; ?>','<?php echo $arr->sku_no; ?>','<?php echo $arr->description2; ?>','<?php echo $arr->tariff; ?>','<?php echo $arr->hsn_code; ?>')"
 onClick="abc(this.value,'<?php echo $arr->mrp; ?>',this.id,'<?php echo $qty; ?>','<?php echo $usunit; ?>','<?php echo $getProductCnt->qty; ?>','<?php echo $arr->Product_id; ?>','<?php echo $arr->sku_no; ?>','<?php echo $arr->description2; ?>','<?php echo $arr->tariff; ?>','<?php echo $arr->hsn_code; ?>')" style="width:240px;border:1px solid;" tabindex="-1"  readonly >


<?php

 }

}


?>
<input type="hidden" value="<?php echo $i;?>" id="ttsp" >
<input type="hidden" id="countid" value="<?php echo $countid;?>">
</body>
</html>