<?php
@extract($_GET);

$contents="SERIAL NO.,PG GROUP,CATEGORY,MODEL NO.,DESCRIPTION 1,DESCRIPTION 2,BLOCK,DELHI,BANGALORE,DEL PALLET,SERVICE,SALES RETURN,TOTAL,MRP,INVENTORY TYPE Q1,REMARKS \n";	


if($_GET['filter'] == 'filter')
{
	
  	$qry = "Select * from tbl_product_stock where status='A'";
    
		    if($p_name != "")	
			  $qry .= " AND productname LIKE '%$p_name%' ";
		  
		   if($sku_no != "")					
				$qry .= " AND sku_no = '$sku_no' ";
				
				 $qry .= "AND category='204' or category='207'";
}
		
		
if($_GET['filter'] != 'filter')
{
	
 $qry = "Select * from tbl_product_stock where category='204' or category='207' ";

}		

$result=$this->db->query($qry);

$i=1;


foreach(@$result->result() as $line)
{
$sql1 = $this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='".$line->category."' ");
$sql3 = $sql1->row();

$blockD=$this->db->query("select *,SUM(S.quantity) as sum_qty from tbl_product_serial S where S.product_id='".$line->Product_id."' AND S.location_id='76' AND comp_id='1' ")->row();
$blockB=$this->db->query("select *,SUM(S.quantity) as sum_qty from tbl_product_serial S where S.product_id='".$line->Product_id."' AND S.location_id='76' AND comp_id='3' ")->row();
$ttlblock = $blockD->sum_qty + $blockB->sum_qty;

$delhi=$this->db->query("select *,SUM(S.quantity) as sum_qty from tbl_product_serial S where S.product_id='".$line->Product_id."' AND S.location_id='54' AND comp_id='1' ")->row();
$ttldelhi = $delhi->sum_qty;
if($delhi->sum_qty!='') { $ttldelhi = $delhi->sum_qty; } else { $ttldelhi=0; }

$bangalore=$this->db->query("select *,SUM(S.quantity) as sum_qty from tbl_product_serial S where S.product_id='".$line->Product_id."' and S.location_id='54' AND S.main_location_id='3' ")->row();
if($bangalore->sum_qty!='') { $ttlbangalore = $bangalore->sum_qty; } else { $ttlbangalore=0; }

$dellPallet=$this->db->query("select *,SUM(S.quantity) as sum_qty from tbl_product_serial S where S.product_id='".$line->Product_id."' AND S.location_id='55' AND comp_id='".$this->session->userdata('comp_id')."' ")->row();
if($dellPallet->sum_qty!=''){ $ttldellpallet = $dellPallet->sum_qty; } else { $ttldellpallet=0;}

$service=$this->db->query("select *,SUM(S.quantity) as sum_qty from tbl_product_serial S where S.product_id='".$line->Product_id."' AND S.location_id='58' AND comp_id='".$this->session->userdata('comp_id')."' ")->row();
if($service->sum_qty!=''){ $ttlservice = $service->sum_qty; } else { $ttlservice=0; }

$sales_return=$this->db->query("select *,SUM(S.quantity) as sum_qty from tbl_product_serial S where S.product_id='".$line->Product_id."' AND S.location_id='57' AND comp_id='".$this->session->userdata('comp_id')."' ")->row();
if($sales_return->sum_qty!=''){ $ttl_sales_return = $sales_return->sum_qty; } else { $ttl_sales_return=0; }

$total = $ttlblock + $ttldelhi + $ttlbangalore + $ttldellpallet + $ttlservice + $ttl_sales_return ;
							
$contents.=str_replace(',',' ',$i).",";
$contents.=str_replace(',',' ',$line->pg_group).",";
$contents.=str_replace(',',' ',$sql3->prodcatg_name).",";
$contents.=str_replace(',',' ',$line->sku_no).",";
$contents.=str_replace(',',' ',$line->productname).",";
$contents.=str_replace(',',' ',$line->description2).",";

$contents.=str_replace(',',' ',$ttlblock).",";
$contents.=str_replace(',',' ',$ttldelhi).",";
$contents.=str_replace(',',' ',$ttlbangalore).",";
$contents.=str_replace(',',' ',$ttldellpallet).",";
$contents.=str_replace(',',' ',$ttlservice).",";
$contents.=str_replace(',',' ',$ttl_sales_return).",";
$contents.=str_replace(',',' ',$total).",";

$contents.=str_replace(',',' ',$line->mrp).",";
$contents.=str_replace(',',' ',$line->inventoy_type).",\n";
	
  $i++;
} 


$filename = "ConsumerStock"."_".@date('Y-m-d');
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . @date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $contents;
exit;

?>		
	
