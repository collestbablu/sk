<?php
@extract($_GET);

$contents="SERIAL NO.,PG GROUP,CATEGORY,MODEL NO.,DESCRIPTION 1,DESCRIPTION 2,BLOCK,DELHI,BANGALORE,DEL PALLET,SERVICE,SALES RETURN,TOTAL,MRP,INVENTORY TYPE Q1,REMARKS \n";	


if($_GET['filter'] == 'filter')
{
	
  	 if($this->session->userdata('user_id')=='1')
	 {
		$qry = "Select * from tbl_product_stock where pg_group='72'  ";
	 }
	 else
	 {
	 	$qry = "Select * from tbl_product_stock where pg_group='72' and comp_id='".$this->session->userdata('comp_id')."' ";
	 }
    
	if($p_name != "")	
		$qry .= " AND productname LIKE '%$p_name%' ";
  
	if($sku_no != "")					
		$qry .= " AND sku_no = '$sku_no' ";
		
	
}
		
		
if($_GET['filter'] != 'filter')
{
	
	 if($this->session->userdata('user_id')=='1')
	 {
		$qry = "Select * from tbl_product_stock where pg_group='72'  ";
	 }
	 else
	 {
	 	$qry = "Select * from tbl_product_stock where pg_group='72' and comp_id='".$this->session->userdata('comp_id')."' ";
	 }

}		

$result=$this->db->query($qry);

$i=1;


foreach(@$result->result() as $line)
{
$sql1 = $this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='".$line->category."' ");
$sql3 = $sql1->row();

$block=$this->db->query("select *,SUM(S.quantity) as sum_qty from tbl_product_serial S where S.product_id='".$line->Product_id."' AND S.location_id='76' AND comp_id='".$this->session->userdata('comp_id')."' ")->row();
if($block->sum_qty!=''){ echo $ttlblock = $block->sum_qty; } else { $ttlblock=0; }

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


$filename = "PG_Group_72"."_".@date('Y-m-d');
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . @date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $contents;
exit;

?>		
	
