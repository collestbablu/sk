<!-- Footer -->
<footer class="footer-main"> 
Copyright &copy; <?php echo date('Y'); ?> <a target="_blank" href="http://www.techvyas.com/"> Tech vyas</a> All rights reserved.
</footer>	
<!-- /footer -->
</div>
<!-- /main content -->
</div>
  <!-- /main container -->
</div>
<!-- /page container -->

<!--Load JQuery-->

<script src="<?=base_url();?>assets/js/jquery.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/plugins/metismenu/js/jquery.metisMenu.js"></script>
<script src="<?=base_url();?>assets/plugins/blockui-master/js/jquery-ui.js"></script>
<script src="<?=base_url();?>assets/plugins/blockui-master/js/jquery.blockUI.js"></script>

<!--Knob Charts-->
<script src="<?=base_url();?>assets/plugins/knob/js/jquery.knob.min.js"></script>

<!--Jvector Map-->
<script src="<?=base_url();?>assets/plugins/jvectormap/js/jquery-jvectormap-2.0.3.min.js"></script>
<script src="<?=base_url();?>assets/plugins/jvectormap/js/jquery-jvectormap-world-mill-en.js"></script>


<!--ChartJs-->
<script src="<?=base_url();?>assets/plugins/chartjs/js/Chart.min.js"></script>

<!--Morris Charts-->
<script src="<?=base_url();?>assets/plugins/morris/js/raphael-min.js"></script>
<script src="<?=base_url();?>assets/plugins/morris/js/morris.min.js"></script>

<!--Float Charts-->
<script src="<?=base_url();?>assets/plugins/flot/js/jquery.flot.min.js"></script>
<script src="<?=base_url();?>assets/plugins/flot/js/jquery.flot.tooltip.min.js"></script>
<script src="<?=base_url();?>assets/plugins/flot/js/jquery.flot.resize.min.js"></script>
<script src="<?=base_url();?>assets/plugins/flot/js/jquery.flot.pie.min.js"></script>
<script src="<?=base_url();?>assets/plugins/flot/js/jquery.flot.time.min.js"></script>

<!--Functions Js-->
<script src="<?=base_url();?>assets/js/functions.js"></script>

<!--Dashboard Js-->
<script src="<?=base_url();?>assets/js/dashboard.js"></script>

<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/dropdown-customer/semantic.js"></script>
<link type="text/css" href="<?php echo base_url();?>assets/dropdown-customer/semantic.css" rel="stylesheet" />
<script>

$('.email.dropdown').dropdown();

$('.emails.form').form({
    fields: {
        email: {
            identifier: 'country',
            rules: [
                {
                    type   : 'empty',
                    prompt : 'Please select or add at least one to email address'
                }
            ]
        }
    }
});


</script>


</body>

</html>
<!-- starts here this javascript code is for multiple delete -->


<script type="text/javascript">
$(document).ready(function(){
	jQuery('#master').on('click', function(e) {
		if($(this).is(':checked',true))  
		{
			$(".sub_chk").prop('checked', true);  
		}  
		else  
		{  
			$(".sub_chk").prop('checked',false);  
		}  
	});
	
	
	jQuery('.delete_all').on('click', function(e) { 
		var allVals = [];  
		$(".sub_chk:checked").each(function() {  
			allVals.push($(this).attr('data-id'));
		});  
		//alert(allVals.length); return false;  
		if(allVals.length <=0)  
		{  
			alert("Please select row.");  
		}  
		else {  
			//$("#loading").show(); 
			WRN_PROFILE_DELETE = "Are you sure you want to delete this row?";  
			var check = confirm(WRN_PROFILE_DELETE);  
			if(check == true){  
				//for server side
				
				var table_name=document.getElementById("table_name").value;
				var pri_col=document.getElementById("pri_col").value;
				var join_selected_values = allVals.join(","); 
			//alert(join_selected_values);
				$.ajax({   
				  
					type: "POST",  
					url: "multiple_delete_two_table",  
					cache:false,  
					data: "ids="+join_selected_values+"&table_name="+table_name+"&pri_col="+pri_col,  
					success: function(response)  
					{   
						$("#loading").hide();  
						$("#msgdiv").html(response);
						//referesh table
					}   
				});
              //for client side
			  $.each(allVals, function( index, value ) {
				  $('table tr').filter("[data-row-id='" + value + "']").remove();
			  });
				

			}  
		}  
	});
	jQuery('.remove-row').on('click', function(e) {
		WRN_PROFILE_DELETE = "Are you sure you want to delete this row?";  
			var check = confirm(WRN_PROFILE_DELETE);  
			if(check == true){
				$('table tr').filter("[data-row-id='" + $(this).attr('data-id') + "']").remove();
			}
	});
});
</script> 

<!-- ends here this javascript code is for multiple delete -->

<!-- starts here this javascript code is for single delete -->
<script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;

 if(confirm("Are you sure you want to delete ?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_data",
   data: info,
   success: function(){
  
   }
 });

         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
<!-- ends here this javascript code is for single delete -->



<!-- starts here this javascript code is for  sales delete -->
<script type="text/javascript">
$(function() {


$(".delbuttonSales").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;

 if(confirm("Are you sure you want to delete ?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_sales_order_data",
   data: info,
   success: function(){
  
   }
 });

         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
<!-- ends here this javascript code is for purchase delete -->
<!-- starts here this javascript code is for  invoice delete -->
<script type="text/javascript">
$(function() {


$(".delbuttonInvoice").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;

 if(confirm("Are you sure you want to delete ?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_invoice_data",
   data: info,
   success: function(){
  
   }
 });

         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
<!-- ends here this javascript code is for invoice delete -->

<!-- starts here this javascript code is for  sales delete -->
<script type="text/javascript">
$(function() {


$(".delbuttonPurchase").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
//alert(info);
 if(confirm("Are you sure you want to delete ?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_multiple_table_data",
   data: info,
   success: function(){
  
   }
 });

         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
<!-- ends here this javascript code is for purchase delete -->






<script>
function getXMLHTTP() { //fuction to return the xml http object

var xmlhttp=false;

try{

xmlhttp=new XMLHttpRequest();

}

catch(e) {

try{

xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");

}

catch(e){

try{

xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");

}

catch(e1){

xmlhttp=false;

}

}

}

return xmlhttp;

}
</script>


<!-- starts here this javascript code is for  multiple delete -->
<script type="text/javascript">
$(function() {


$(".delbuttonMultiple").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;

 if(confirm("Are you sure you want to delete ?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_multiple_table_data",
   data: info,
   success: function(){
  
   }
 });

         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
<!-- ends here this javascript code is for multiple delete -->




<!-----------------drop down select start here------------->

<script type="text/javascript" src="<?=base_url();?>assets/dropdown-customer/mock.js"></script>

<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/dropdown-customer/jquery.dropdown.css">
<script src="<?=base_url();?>assets/dropdown-customer/jquery.dropdown.js"></script>
<script>

    var Random = Mock.Random;
    var json1 = Mock.mock({
      "data|10-50": [{
        name: function () {
          return Random.name(true)
        },
        "id|+1": 1,
        "disabled|1-2": true,
        groupName: 'Group Name',
        "groupId|1-4": 1,
        "selected": false
      }]
    });

    $('.dropdown-mul-1').dropdown({
      data: json1.data,
      limitCount: 40,
      multipleMode: 'label',
      choice: function () {
        // console.log(arguments,this);
      }
    });

    var json2 = Mock.mock({
      "data|10000-10000": [{
        name: function () {
          return Random.name(true)
        },
        "id|+1": 1,
        "disabled": false,
        groupName: 'Group Name',
        "groupId|1-4": 1,
        "selected": false
      }]
    });

    $('.dropdown-mul-2').dropdown({
      limitCount: 5,
      searchable: false
    });

    $('.dropdown-sin-1').dropdown({
      readOnly: true,
      input: '<input type="text" maxLength="20" placeholder="Search">'
    });

    $('.dropdown-sin-2').dropdown({
      data: json2.data,
      input: '<input type="text" maxLength="20" placeholder="Search">'
    });
</script>

<!--Loader Js-->
<script src="<?=base_url();?>assets/js/loader.js"></script>

<script src="<?=base_url();?>assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/js/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/js/jszip.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/js/pdfmake.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/js/vfs_fonts.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.html5.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.colVis.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/js/dataTables-script.js"></script>

<link href="<?=base_url();?>assets/plugins/datatables/css/jquery.dataTables.css" rel="stylesheet">
<link href="<?=base_url();?>assets/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css" rel="stylesheet">


<script>
$(document).ready(function(){

    setTimeout(function(){

        $('#success-alert').fadeOut();}, 4000);


/*$("#entries").change(function()
    {
      var value=$(this).val();
      var pageurl  = $(this).attr('url');
      url = pageurl+"?entries="+value;
      window.location.href = url;
    });
*/    

$("#entries").change(function()
    {
	//alert("Url  ="+document.location);
      var value=$(this).val();
      var pageurl  = $(this).attr('url');
	  //var url=document.URL;
      //var arr=url.split('?');
      //var myoutput=arr[1];
	   
      comp_url = pageurl+"&entries="+value;
	  //alert(comp_url);
      window.location.href = comp_url;
    });

});

</script>
<!-----------------drop down select ends here------------->

<?php
if($this->uri->segment(2)=='addInbound' )
{
?>
<!-----------------drop down select start here------------->
<script src="<?php echo base_url();?>assets/img-upload-scripts/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/img-upload-scripts/jquery.form.js" type="text/javascript"></script>
<!---------------------ends here------------------->

<?php }

if($this->uri->segment(3)=='addOtherInbound')
{
?>
<script src="<?php echo base_url();?>assets/img-upload-scripts/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/img-upload-scripts/jquery.form.js" type="text/javascript"></script>
<?php }


if($this->uri->segment(2)=='add_multi_invoice')
{
	
?>
<script src="<?php echo base_url();?>assets/img-upload-scripts/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/img-upload-scripts/jquery.form.js" type="text/javascript"></script>
<?php }?>

<?php echo $this->uri->segment(3)?>


<script>

	function searchData(){
		 currentCell = 0;
		 
		 var search_id=document.getElementById("search_id").value;	  
		 var priId=document.getElementById("priId").value;
		 var tableName=document.getElementById("tableName").value;
		 var fieldName=document.getElementById("fieldName").value;	 
		
		
		 	
		    if(xobj)
			 {
				
			 var obj=document.getElementById("prdsrch");
			 
			 xobj.open("GET","getSerachData?search_id="+search_id+"&tableName="+tableName+"&fieldName="+fieldName+"&priId="+priId,true);
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


function clear_data()
{
	document.getElementById("prdsrch").innerHTML='';
}



 ////manage page search script///


function doSearch() {
    //alert('afsdfasdf');
   var abc = document.getElementById('searchTerm').value;
   var searchText=abc.toLowerCase();
   
   var targetTable = document.getElementById('getDataTable');
   var targetTableColCount;
          // alert('aadf');
   //Loop through table rows
   for (var rowIndex = 0; rowIndex < targetTable.rows.length; rowIndex++) {
       var rowData = '';

       //Get column count from header row
       if (rowIndex == 0) {
          targetTableColCount = targetTable.rows.item(rowIndex).cells.length;
          continue; //do not execute further code for header row.
       }
               
       //Process data rows. (rowIndex >= 1)
       for (var colIndex = 0; colIndex < targetTableColCount; colIndex++) {
           rowData += targetTable.rows.item(rowIndex).cells.item(colIndex).textContent.toLowerCase();
       }

       //If search term is not found in row data
       //then hide the row, else show
       if (rowData.indexOf(searchText) == -1)
           targetTable.rows.item(rowIndex).style.display = 'none';
       else
           targetTable.rows.item(rowIndex).style.display = 'table-row';
   }
}




// ends

function ajex_loadListData(){
  ur = "<?=base_url('master/Item/load_item');?>";
  $.ajax({
      url: ur,
      type: "POST",
      success: function(data){
        $("#getDataTable").html(data);

       // console.log(data);
     }
  });
}

 

</script>



<!-----------------drop down select ends here------------->

<?php
if($this->uri->segment(2)=='addInbound' )
{
?>
<!-----------------drop down select start here------------->
<script src="<?php echo base_url();?>assets/img-upload-scripts/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/img-upload-scripts/jquery.form.js" type="text/javascript"></script>
<!---------------------ends here------------------->

<?php }

if($this->uri->segment(3)=='addOtherInbound')
{
?>
<script src="<?php echo base_url();?>assets/img-upload-scripts/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/img-upload-scripts/jquery.form.js" type="text/javascript"></script>
<?php }


if($this->uri->segment(2)=='add_multi_invoice')
{
	
?>
<script src="<?php echo base_url();?>assets/img-upload-scripts/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/img-upload-scripts/jquery.form.js" type="text/javascript"></script>
<?php }?>