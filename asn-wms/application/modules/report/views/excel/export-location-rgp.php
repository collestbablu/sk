<?php
@extract($_GET);

$contents="SERIAL NO.,RGP GATEPASS DATE,CURRENT DATE,RETURN DUE DATE,TENURE(IN DAYS),RGP GATEPASS NO.,MANUAL GATE PASS NO.,MANUAL GATE PASS DATE,PG GROUP,CATEGORY,MODEL NO.,DESCRIPTION,QTY,LOCATION,STOCK POSITION,GATEPASS ISSUED NAME,RESPONSIBILITY,REMARK 1,REMARK 2,W/H REMARKS,INVENTORY TYPE \n";	

/*
if($_GET['filter'] == 'filter')
{
	
	if($this->session->userdata('user_id')=='1') 	
	{
		$qry = "select * from tbl_return_dtl where status = 'A' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
	else
	{
		$qry = "select * from tbl_return_dtl where status = 'A' and comp_id='".$this->session->userdata('comp_id')."' ";
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
		
	*/	
if($_GET['filter'] != 'filter')
{
	
	if($this->session->userdata('user_id')=='1') 	
	{
		$qry = "select * from tbl_return_dtl where status = 'A' ";
	}
	else
	{
		$qry = "select * from tbl_return_dtl where status = 'A' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
		

$result=$this->db->query($qry);

$i=1;


foreach(@$result->result() as $line)
{



$getLog = $this->db->query("Select product_id,inbound_id,type,quantity from tbl_product_serial_log where type = 'Demo Return' and product_id='$line->product_id' and inbound_id='$line->returnhdr' ");
$logdata = $getLog->row();



if($logdata->quantity!='')
{
$qnt=$logdata->quantity;	
}
else
{
$qnt=$line->quantity;	
}

 if(@$logdata->product_id == @$line->product_id and  @$logdata->inbound_id == @$line->returnhdr and  @$logdata->quantity==@$line->quantity) 
 {
}

 else
 {
$today=date('Y-m-d');

$dtlhdr=$this->db->query("select * from tbl_return_hdr where returnid='$line->returnhdr'");
$alldtlhdr=$dtlhdr->row();

$proQ1=$this->db->query("select * from tbl_product_stock where Product_id='$line->product_id'");
$fProQ12=$proQ1->row();

$sql1 = $this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='".$fProQ12->category."' ");
$sql3 = $sql1->row();

$proQ122=$this->db->query("select * from tbl_master_data where serial_number='$line->loc'");
$fProQ121=$proQ122->row();

$ctnm=$this->db->query("select * from tbl_contact_m where code='$alldtlhdr->stock_position'");
$ctnmdtl=$ctnm->row();
if($ctnmdtl->code!=''){  $stkPosition = $ctnmdtl->first_name ." - ". $ctnmdtl->city; } else { }

$contactQuery=$this->db->query("select *from tbl_contact_m where contact_id='$alldtlhdr->responsibility'");
$getContact=$contactQuery->row();


	$todays=date('Y-m-d');
	$date1=date_create($todays);
	$date2=date_create($alldtlhdr->return_due_date);
	$diff=date_diff($date1,$date2);
	if($date1<=$date2)
	{
		$tenure = $diff->format("%a days");
	}
	else
	{
		$tenure = $diff->format("%a days");	
	}

							
$contents.=str_replace(',',' ',$i).",";
$contents.=str_replace(',',' ',$alldtlhdr->rgp_gate_pass_date).",";
$contents.=str_replace(',',' ',$today).",";
$contents.=str_replace(',',' ',$alldtlhdr->return_due_date).",";
$contents.=str_replace(',',' ',$tenure).",";
$contents.=str_replace(',',' ',$alldtlhdr->rgp_gatepass_no).",";
$contents.=str_replace(',',' ',$alldtlhdr->manual_gate_pass_no).",";
$contents.=str_replace(',',' ',$alldtlhdr->manual_gp_date).",";
$contents.=str_replace(',',' ',$fProQ12->pg_group).",";
$contents.=str_replace(',',' ',$sql3->prodcatg_name).",";
$contents.=str_replace(',',' ',$fProQ12->sku_no).",";
$contents.=str_replace(',',' ',$fProQ12->productname).",";
$contents.=str_replace(',',' ',$qnt).",";
$contents.=str_replace(',',' ',$fProQ121->keyvalue).",";
$contents.=str_replace(',',' ',$stkPosition).",";
$contents.=str_replace(',',' ',$alldtlhdr->gatepass_issued_name).",";
$contents.=str_replace(',',' ',$getContact->first_name).",";
$contents.=str_replace(',',' ',$alldtlhdr->remarks1).",";
$contents.=str_replace(',',' ',rtrim($alldtlhdr->remarks2,',')).",";
$contents.=str_replace(',',' ',$alldtlhdr->wh_remarks).",";
$contents.=str_replace(',',' ',$fProQ12->inventoy_type).",\n";
	
   $i++;
 } 
}
}
$filename = "LocationRgp"."_".@date('Y-m-d');
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . @date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $contents;
exit;

?>		
	
