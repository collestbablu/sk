<table class="table table-striped table-bordered table-hover dataTables-example">
<tr>
<td>Sl No</td>
<td>Product Code</td>
<td>Description1</td>
<td>Description2</td>
<td>HSN Code</td>
<td>MRP</td>
<td>Unit Price</td>
<td>International Tariff No.</td>
<td>Qty Invoice</td>
<td>Qty Rec.</td>

<td>Qty Diff.</td>
<td>Total</td>
<td >Net Price</td>
</tr>

<?php
//include('db.php');
 @extract($_POST);
 $filename=$_FILES["file"]["tmp_name"];
 
 
	if($_FILES["file"]["size"] > 0)
	{
 
		$file = fopen($filename, "r");
		$i=1;
		while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
		{
			
 if($getData[0]!='Model')
{

 
 $productQuery=$this->db->query("select *from tbl_product_stock where sku_no='".$getData['0']."'");
 $getProduct=$productQuery->row();
?>
<tr>
<th>
<?php echo $i;?>
</th>
<th>
<input type="hidden" name="main_id[]" class="form-control" value="<?php echo $getProduct->Product_id;?>" />
<input type="text" class="form-control" value="<?php echo $getData[0];?>" />
</th>
<th>
<input type="text" class="form-control" value="<?php echo $getProduct->productname;?>" />
</th>
<th>
<input type="text" class="form-control" value="<?php echo $getProduct->description2;?>" />
</th>
<th>
<input type="text" name="hsn_code[]" class="form-control" value="<?php echo $getProduct->hsn_code;?>" />
</th>


<th>
<input type="text" class="form-control" value="<?php echo $getProduct->mrp;?>" />
</th>
<th>
<input type="text" name="list_price[]" class="form-control" value="<?php echo $getProduct->mrp;?>" />
</th>

<th>
<input type="text" name="int_tariff[]" class="form-control" value="<?php echo $getData[2];?>" />
</th>

<th>
<input type="text" name="qty[]" class="form-control" value="<?php echo $getData[1];?>" />
</th>
<th>
<input type="text" name="discount[]" class="form-control" value="" />
</th>
<th>
<input type="text" name="disAmount[]" class="form-control" value="" />
</th>
<th>
<input type="text" name="nettot[]" class="form-control" value="<?php echo $getData[3];?>" />
</th>

<th>
<input type="text" name="tot[]" class="form-control" value="<?php echo $getData[4];?>" />
</th>

</tr>
<?php
	$sm=$i+1;		   
$i++;
}
		}
			 fclose($file);
		
	}
	     

?>
<input type="hidden" name="rows" class="form-control" value="<?php echo $sm-1;?>" />
</table>