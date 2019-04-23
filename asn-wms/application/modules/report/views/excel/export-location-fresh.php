<?php
@extract($_GET);

$contents="SERIAL No,MODEL No,PRODUCT NAME,CATEGORY,PG GROUP,MAIN LOCATION,LOCATION,RACK,QTY IN STOCK,MRP \n";	


if($_GET['filter'] == 'filter')
{
	
   if($this->session->userdata('user_id')=='1') 	
	{
		$qry = "Select * from tbl_product_serial where location_id='54' and comp_id='".$this->session->userdata('comp_id')."'   ";
	}
	else
	{
		$qry = "Select * from tbl_product_serial where location_id='54' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
    
		   if($p_name != "")	
			{					
				$unitQuery=$this->db->query("select * from tbl_product_stock where productname LIKE '%$p_name%' ");
				$getUnit=$unitQuery->row();
				$sr_no=$getUnit->Product_id;
			  	$qry .= " AND product_id ='$sr_no'";
			}
			
		    if($sku_no != "")					
			{					
				$unitQuery=$this->db->query("select * from tbl_product_stock where sku_no = '$sku_no' ");
				$getUnit=$unitQuery->row();
				$sr_no=$getUnit->Product_id;
			    $qry .= " AND product_id ='$sr_no'";
			}
}
		
		
if($_GET['filter'] != 'filter')
{
	
  if($this->session->userdata('user_id')=='1') 	
	{
		$qry = "Select * from tbl_product_serial where location_id='54' ";
	}
	else
	{
		$qry = "Select * from tbl_product_serial where location_id='54' and comp_id='".$this->session->userdata('comp_id')."' ";
	}

}		

$result=$this->db->query($qry);

$i=1;


foreach(@$result->result() as $line)
{
$model=$this->db->query("select * from tbl_product_stock where Product_id='$line->product_id'");
$getModel=$model->row();

$catgry=$this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='$getModel->category' ");
$getCatgry=$catgry->row();

$mainlocation=$this->db->query("select * from tbl_location where id='$line->main_location_id'");
$getMainLocation=$mainlocation->row();

$location=$this->db->query("select * from tbl_master_data where serial_number='$line->location_id'");
$getLocation=$location->row();

$rack=$this->db->query("select * from tbl_location_rack where id='$line->rack_id'");
$getRack=$rack->row();
							
$contents.=str_replace(',',' ',$i).",";
$contents.=str_replace(',',' ',$getModel->sku_no).",";
$contents.=str_replace(',',' ',$getModel->productname).",";
$contents.=str_replace(',',' ',$getCatgry->prodcatg_name).",";
$contents.=str_replace(',',' ',$getModel->pg_group).",";
$contents.=str_replace(',',' ',$getMainLocation->location_name).",";
$contents.=str_replace(',',' ',$getLocation->keyvalue).",";
$contents.=str_replace(',',' ',$getRack->rack_name).",";
$contents.=str_replace(',',' ',$line->quantity).",";
$contents.=str_replace(',',' ',$getModel->mrp).",\n";
	
  $i++;
} 


$filename = "LocationFresh"."_".@date('Y-m-d');
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . @date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $contents;
exit;

?>		
	
