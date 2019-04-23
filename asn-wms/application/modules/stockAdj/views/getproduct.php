<?php

//echo "df".$Productctg_id=$_REQUEST['Productctg_id'];

 //$con1=$_REQUEST['con'];
$con1=$_GET['con'];
$_GET['con_id'];
//echo "fff".$con1;

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


		  function abc(pt,pr,tid,pid,sku_no,des2){
		  				
						//var pid=pt.split("^");
		  				//var pids=pid[1];
						//alert(pr);
						
					document.getElementById("pri_id").value=pid;
				   document.getElementById("prd").value=sku_no;
				   document.getElementById("des1").value=pt;
				   document.getElementById("des2").value=des2;

					
		  }



  </script>
</head>
<body>
<?php

 if($con1!="")
 {


  $sel=$this->db->query("select * from tbl_product_stock where productname like '%$con1%' or sku_no like '%$con1%'");


  $i=0;

  foreach($sel->result() as $arr)
  {
  $i++;
  $id='d'; 

  $id.=$i; 
$countid+= count($id);
?>

<input type="text" id="ty<?php echo $id;?>"  class="prds form-control" value="<?php echo $arr->productname.'' ?>" name="<?php echo $id;?>"
onClick="abc(this.value,'<?php echo $arr->productname; ?>',this.id,'<?php echo $arr->Product_id; ?>','<?php echo $arr->sku_no; ?>','<?php echo $arr->description2; ?>')"
onFocus="abc(this.value,'<?php echo $arr->productname; ?>',this.id,'<?php echo $arr->Product_id; ?>','<?php echo $arr->sku_no; ?>','<?php echo $arr->description2; ?>')"
 style="width:240px;border:1px solid;" tabindex="-1"  readonly >


<?php

 }

}


?>
<input type="hidden" value="<?php echo $i;?>" id="ttsp" >
<input type="hidden" id="countid" value="<?php echo $countid;?>">
</body>
</html>