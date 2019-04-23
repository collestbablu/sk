<?php
@extract($_GET);

$contents="Product Id,Model No.,Category,PG Group,Family Group,Description 1,Description 2,Usages Unit,Mrp \n";	

if($_GET['filter'] != '')
{
	
    $qry = "select * from tbl_product_stock where status = 'A'";
    
		   if($p_id != '')
		      $qry .= " AND Product_id = '$p_id' ";
		   
		   if($sku_no != '')
		      $qry .= " AND sku_no LIKE '%$sku_no%' ";
           
		   if($category != '')
		    {
			   $unitQuery2=$this->db->query("select * from tbl_prodcatg_mst where prodcatg_name LIKE '%$category%'");
		       $getUnit2=$unitQuery2->row();
		       $sr_no2=$getUnit2->prodcatg_id;
		 
			   $qry .= " AND category ='$sr_no2'";
		    }
		   
		   if($pg_grp != '')
		      $qry .= " AND pg_group = '$pg_grp'";
			
		   if($fmly_grp != '')
		     $qry .= " AND family_group = '$fmly_grp' ";
		   
		   if($productname != '')
		   	 $qry .= " AND productname LIKE '%$productname%' ";
			  
		   if($des2 != '')
		 	 $qry .= " AND description2 LIKE '%$des2%' ";
		   
		   if($usages_unit != '')
		    {
			   $unitQuery=$this->db->query("select * from tbl_master_data where keyvalue LIKE '%$usages_unit%'");
		       $getUnit=$unitQuery->row();
		       $sr_no=$getUnit->serial_number;
		 	  
			   $qry .= " AND usageunit ='$sr_no'";
            }
	  		
		   if($mrp != '')
			  $qry .= " AND mrp LIKE '%$mrp%'";

}
		
		
if($_GET['filter'] == '')
{
	$qry = "select * from tbl_product_stock where status='A' Order by Product_id DESC ";
}		

$result=$this->db->query($qry);

$i=1;


foreach(@$result->result() as $line)
{

$contQuery=$this->db->query("select * from tbl_master_data where serial_number='$line->usageunit'");
$contRow=$contQuery->row();

$saleQuery=$this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='$line->category'");
$saleRow=$saleQuery->row();							 	

							
$contents.=str_replace(',',' ',$line->Product_id).",";
$contents.=str_replace(',',' ',$line->sku_no).",";
$contents.=str_replace(',',' ',$saleRow->prodcatg_name).",";
$contents.=str_replace(',',' ',$line->pg_group).",";
$contents.=str_replace(',',' ',$line->family_group).",";
$contents.=str_replace(',',' ',$line->productname).",";
$contents.=str_replace(',',' ',$line->description2).",";
$contents.=str_replace(',',' ',$contRow->keyvalue).",";
$contents.=str_replace(',',' ',$line->mrp).",\n";
	
  $i++;
} 

//$supplier = "ProductList"
$filename = "ProductList"."_".@date('Y-m-d');
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . @date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $contents;
exit;

?>		
	
