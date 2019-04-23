<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class model_report extends CI_Model {


//==========================Professional Stock==========

function getProfessionalStock($last,$strat)
{
	  $query=$this->db->query("Select * from tbl_product_stock where category='202'  limit $strat,$last ");
	  return $result=$query->result();  
}

function filterProfessionalStock($perpage,$pages,$get)
{

	$qry = "Select * from tbl_product_stock where category='202' ";
		  
		 if(sizeof($get) > 0)
		 {
		
		   if($get['p_name'] != "")	
			  $qry .= " AND productname LIKE '%".$get['p_name']."%' ";
		  
		   if($get['sku_no'] != "")					
				$qry .= " AND sku_no = '".$get['sku_no']."' ";
		
		 }
			
		$qry .=" LIMIT $pages,$perpage ";		
				   
	 $data =  $this->db->query($qry)->result();
	 
  return $data;
  
}

function count_professional_stock($perpage,$pages,$get)
{
 	
	$qry = "Select * from tbl_product_stock where category='202' ";
	  
	 if(sizeof($get) > 0)
	 {
	
	   if($get['p_name'] != "")	
		  $qry .= " AND productname LIKE '%".$get['p_name']."%' ";
	  
	   if($get['sku_no'] != "")					
			$qry .= " AND sku_no = '".$get['sku_no']."' ";
	
	 }
	 
	// $qry .= "AND category='204' or category='207'";
 
   $data =  $this->db->query($qry)->num_rows();
  
 return $data;
 
}

//========================PG Group 72====================

function getPgGroup($last,$strat)
{
	 if($this->session->userdata('user_id')=='1')
	 {
	 	$query=$this->db->query("Select * from tbl_product_stock where pg_group='72' limit $strat,$last ");
	 }
	 else
	 {
	 	$query=$this->db->query("Select * from tbl_product_stock where pg_group='72' and comp_id='".$this->session->userdata('comp_id')."'  limit $strat,$last ");
	 }
	 
	 return $result=$query->result();  
}

function filterPgGroup($perpage,$pages,$get)
{

	 if($this->session->userdata('user_id')=='1')
	 {
		$qry = "Select * from tbl_product_stock where pg_group='72'  ";
	 }
	 else
	 {
	 	$qry = "Select * from tbl_product_stock where pg_group='72' and comp_id='".$this->session->userdata('comp_id')."' ";
	 }
					  
		 if(sizeof($get) > 0)
		 {
		
		   if($get['p_name'] != "")	
			  $qry .= " AND productname LIKE '%".$get['p_name']."%' ";
		  
		   if($get['sku_no'] != "")					
				$qry .= " AND sku_no = '".$get['sku_no']."' ";
		
		 }
		
		$qry .=" LIMIT $pages,$perpage ";		
				   
	$data =  $this->db->query($qry)->result();
	
  return $data;
  
}

function count_pg_group($perpage,$pages,$get)
{
	
	  $qry = "Select * from tbl_product_stock where pg_group='72' and comp_id='".$this->session->userdata('comp_id')."' ";
		  
		 if(sizeof($get) > 0)
		 {
		
		   if($get['p_name'] != "")	
			  $qry .= " AND productname LIKE '%".$get['p_name']."%' ";
		  
		   if($get['sku_no'] != "")					
				$qry .= " AND sku_no = '".$get['sku_no']."' ";
		
		 }
		
		// $qry .= "AND category='204' or category='207'";
 
    $data =  $this->db->query($qry)->num_rows();
	
 return $data;
 
}

//===============================Consumer Stock=========================

function getConsumerStock($last,$strat)
{
	  $query=$this->db->query("Select * from tbl_product_stock where category='204' or category='207'  limit $strat,$last ");
	  return $result=$query->result();  
}

function filterConsumerStock($perpage,$pages,$get)
{

	$qry = "Select * from tbl_product_stock where status='A'";
		  
		 if(sizeof($get) > 0)
		 {
		
		   if($get['p_name'] != "")	
			  $qry .= " AND productname LIKE '%".$get['p_name']."%' ";
		  
		   if($get['sku_no'] != "")					
				$qry .= " AND sku_no = '".$get['sku_no']."' ";
		
		 }
		 
		 $qry .= "AND category='204' or category='207'";
		 
	  $qry .=" LIMIT $pages,$perpage ";
				   
	$data =  $this->db->query($qry)->result();
	
  return $data;
  
}

function count_consumer_stock($perpage,$pages,$get)
{
 	
		  $qry = "Select * from tbl_product_stock where status='A'";
		  
		 if(sizeof($get) > 0)
		 {
		
		   if($get['p_name'] != "")	
			  $qry .= " AND productname LIKE '%".$get['p_name']."%' ";
		  
		   if($get['sku_no'] != "")					
				$qry .= " AND sku_no = '".$get['sku_no']."' ";
		
		 }
		 
		 $qry .= "AND category='204' or category='207'";
 
    $data =  $this->db->query($qry)->num_rows();
	
 return $data;
 
}

//=================================Complete Stock With BLR==========

function getCompleteStock($last,$strat)
{
	$query=$this->db->query("Select * from tbl_product_stock where status='A'  limit $strat,$last ");
	return $result=$query->result();  
}

function filterCompleteStock($perpage,$pages,$get)
{

	$qry = "Select * from tbl_product_stock where status='A'";
					  
		 if(sizeof($get) > 0)
		 {
		
		   if($get['p_name'] != "")	
			  $qry .= " AND productname LIKE '%".$get['p_name']."%' ";
		  
		   if($get['sku_no'] != "")					
				$qry .= " AND sku_no = '".$get['sku_no']."' ";
		
		 }
		
		$qry .=" LIMIT $pages,$perpage";
				   
	$data =  $this->db->query($qry)->result();
	
 return $data;

}

function count_complete_stock($perpage,$pages,$get)
{
 	
  $qry = "Select * from tbl_product_stock where status='A'";
					  
	 	 if(sizeof($get) > 0)
		 {
		
		   if($get['p_name'] != "")	
			  $qry .= " AND productname LIKE '%".$get['p_name']."%' ";
		  
		   if($get['sku_no'] != "")					
				$qry .= " AND sku_no = '".$get['sku_no']."' ";
		
		 }
 
    $data =  $this->db->query($qry)->num_rows();
	
 return $data;
 
}



//==============================PI Report==================

function getPI($last,$strat)
{	
	
	$crdate=date('Y-m-d');
	if($this->session->userdata('user_id')=='1')
	{
		$query=$this->db->query("Select * from tbl_product_serial_log where maker_date='$crdate'  group by product_id order by product_id asc limit $strat,$last ");
	}
	else
	{
		$query=$this->db->query("Select * from tbl_product_serial_log where maker_date='$crdate' AND comp_id='".$this->session->userdata('comp_id')."'  group by product_id order by product_id asc limit $strat,$last ");
	}
 
 	 return $result=$query->result();  
	 
}

function filterPiList($perpage,$pages,$get)
{

		//$crdate=date('Y-m-d');
		if($this->session->userdata('user_id')=='1')
		{
			 $qry = "Select * from tbl_product_serial_log where status='A'   ";
		}
		else
		{
			 $qry = "Select * from tbl_product_serial_log where comp_id='".$this->session->userdata('comp_id')."'  ";
		}

					  
					if(sizeof($get) > 0)
					{
					
					   if($get['location'] != "")					
					     {
					 		$qry .= " AND location_id = '".$get['location']."' ";
						 }
						
					   if($get['f_date']!='' && $get['t_date']!='')
						{
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							$qry .="and maker_date >='$fdate1' and maker_date <='$todate1'";
						}
						
						$qry .="group by product_id order by product_id asc ";
				    }
					
				$qry .=" LIMIT $pages,$perpage ";
				   
	    $data =  $this->db->query($qry)->result();
		
  	return $data;
	
}

function count_pi($perpage,$pages,$get)
{	
	
	//$crdate=date('Y-m-d');
 	if($this->session->userdata('user_id')=='1')
 	{
 		 $qry = "Select * from tbl_product_serial_log where status='A'  ";
 	}
 	else
 	{
 		 $qry = "Select * from tbl_product_serial_log where comp_id='".$this->session->userdata('comp_id')."' ";
 	}
					 
					  
			if(sizeof($get) > 0)
			{
			
			   if($get['location'] != "")					
				 {
					$qry .= " AND location_id = '".$get['location']."' ";
				 }
				
			   if($get['f_date']!='' && $get['t_date']!='')
				{
					$tdate=explode("-",$get['t_date']);
					$fdate=explode("-",$get['f_date']);
		
					$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
					$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
					$qry .="and maker_date >='$fdate1' and maker_date <='$todate1'";
				}
				
				$qry .="group by product_id order by product_id asc ";
			 }
 
    $data =  $this->db->query($qry)->num_rows();
	
 return $data;
 
}

function count_pi_crdate($perpage,$pages,$get)
{	
	$crdate=date('Y-m-d');
 	if($this->session->userdata('user_id')=='1')
 	{
 		 $qry = "Select * from tbl_product_serial_log where maker_date='$crdate' ";
 	}
 	else
 	{
 		 $qry = "Select * from tbl_product_serial_log where maker_date='$crdate' AND comp_id='".$this->session->userdata('comp_id')."' ";
 	}
			
			$qry .="group by product_id order by product_id asc ";

    $data =  $this->db->query($qry)->num_rows();
 return $data;
}


//===============================Delhi Stock============================

function getDelhiStock($last,$strat)
{
	 if($this->session->userdata('user_id')=='1')
	 {
	 	$query=$this->db->query("Select * from tbl_product_serial_log where type != 'Stock In' AND inbound_id !='' ORDER BY serial_number DESC limit $strat,$last ");
	 }
	 else
	 {
	 	$query=$this->db->query("Select * from tbl_product_serial_log where type != 'Stock In' AND inbound_id !='' AND comp_id='".$this->session->userdata('comp_id')."' ORDER BY serial_number DESC limit $strat,$last ");
	 }
	 return $result=$query->result();  
}

function filterDelhiStockList($perpage,$pages,$get)
{

		if($this->session->userdata('user_id')=='1')
		{
			$qry = "Select * from tbl_product_serial_log  where type != 'Stock In' AND inbound_id !='' ";
		}
		else
		{
			$qry = "Select * from tbl_product_serial_log  where type != 'Stock In' AND inbound_id !='' AND comp_id='".$this->session->userdata('comp_id')."' ";
		}
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['location'] != "")	
					     {
						    $qry .= " AND location_id ='".$get['location']."'";
					     }
						
					   if($get['sku_no'] != "")					
					     {	
						 	$sku=$this->db->query("select * from tbl_product_stock where sku_no = '".$get['sku_no']."' ");
						    $getSku=$sku->row();
						    
							$qry .= " AND product_id = '$getSku->Product_id' ";
						 }
					   
					   if($get['f_date']!='' && $get['t_date']!='')
						{
							$tdate=explode("-",$get['t_date']);
							$fdate=explode("-",$get['f_date']);
				
							$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
							$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
							
						   
							$qry .=" and maker_date >= '$fdate1' and maker_date <= '$todate1' ";
						}
						
					  }
            $qry .=" ORDER BY serial_number DESC";								
			$qry .=" LIMIT $pages,$perpage";
					  
	    $data =  $this->db->query($qry)->result();
		
  	return $data;
	
}

function count_delhi_stock($perpage,$pages,$get)
{
 		
		if($this->session->userdata('user_id')=='1')
		{
			$qry = "Select * from tbl_product_serial_log  where type != 'Stock In' AND inbound_id !='' ";
		}
		else
		{
			$qry = "Select * from tbl_product_serial_log  where type != 'Stock In' AND inbound_id !='' AND comp_id='".$this->session->userdata('comp_id')."' ";
		}
					  
				 if(sizeof($get) > 0)
				 {
				
				   if($get['location'] != "")	
					 {
						$qry .= " AND location_id ='".$get['location']."'";
					 }
					
				   if($get['sku_no'] != "")					
					 {	
						$sku=$this->db->query("select * from tbl_product_stock where sku_no = '".$get['sku_no']."' ");
						$getSku=$sku->row();
						
						$qry .= " AND product_id = '$getSku->Product_id' ";
					 }
				   
				   if($get['f_date']!='' && $get['t_date']!='')
					{
						$tdate=explode("-",$get['t_date']);
						$fdate=explode("-",$get['f_date']);
			
						$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
						$fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
						
					   
						$qry .=" and maker_date >= '$fdate1' and maker_date <= '$todate1' ";
					}
					
				  }

				$qry .=" ORDER BY serial_number DESC";
 
    $data =  $this->db->query($qry)->num_rows();
	
 return $data;
 
}

/*$dateqry = $this->db->query("select D.product_id from tbl_stock_out_hdr H,tbl_stock_out_dtl D  where H.stockoutid = D.stockouthdr AND H.date >='$fdate1' and H.date <='$todate1' order by  H.date DESC");
							$dateqryresult =$dateqry->result_array();
							  
							foreach($dateqryresult as $dt)
							{
							     $Pid[]  = $dt['product_id'];
							}
							$imp = implode(',',$Pid);
							$qry .=" and L.product_id IN ($imp)";*/


//===============================Product Stock======================

function getProduct($last,$strat){
	  $query=$this->db->query("Select * from tbl_product_stock where status='A'  limit $strat,$last ");
	  return $result=$query->result();  
}
function filterProductList($perpage,$pages,$get){

					  $qry = "Select * from tbl_product_stock where status='A'";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['p_name'] != "")						
						  $qry .= " AND productname like '%".$get['p_name']."%' ";
					  
					   if($get['p_code'] != "")					
					     $qry .= " AND Product_id = '".$get['p_code']."'";
					
				   }
				   
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_product($perpage,$pages,$get){
 	
					  $qry = "Select * from tbl_product_stock where status='A'";
					  
					 if(sizeof($get) > 0){
					
					   if($get['p_name'] != "")						
						  $qry .= " AND productname like '%".$get['p_name']."%' ";
					  
					   if($get['p_code'] != "")					
					     $qry .= " AND Product_id = '".$get['p_code']."'";
					   
				 }
 
    $data =  $this->db->query($qry)->num_rows();
 return $data;
}


//=====================================End=======================
function getSearchPayment($contactid,$payment_mode) {
	if($contactid!='' || $payment_mode!=''){
   
		$select_query="select * from tbl_invoice_payment where status='payment'";
		
		if($contactid!='')
		{				
			$select_query.=" and contact_id  = '$contactid'";	  
		}
		
		if($payment_mode!='')
		{				
			$select_query.=" and payment_mode  = '$payment_mode'";	  
		}
		  
    	}else{
	$select_query = "Select * from tbl_invoice_payment where status='payment'";	
		}
	$query = $this->db->query($select_query);
    return $query->result();
}


function getSearchPaymentReceived($contactid,$payment_mode) {
	if($contactid!='' || $payment_mode!=''){
   
		$select_query="select * from tbl_invoice_payment where status='PaymentReceived'";
		
		if($contactid!='')
		{				
			$select_query.=" and contact_id  = '$contactid'";	  
		}
		
		if($payment_mode!='')
		{				
			$select_query.=" and payment_mode  = '$payment_mode'";	  
		}
		  
    	}else{
	$select_query = "Select * from tbl_invoice_payment where status='PaymentReceived'";	
		}
	$query = $this->db->query($select_query);
    return $query->result();
}

//=====================72 Report================

function getSeventyTwo($last,$strat){
	
		  $query=$this->db->query("Select S.* from tbl_product_serial S,tbl_product_stock P where P.Product_id = S.product_id AND P.pg_group=72 AND (S.location_id='54' or S.location_id = '76') limit $strat,$last ");
	
		  return $result=$query->result();  
}

function filterSeventyTwoList($perpage,$pages,$get){

		  $qry = "Select S.* from tbl_product_serial S,tbl_product_stock P where P.Product_id = S.product_id AND P.pg_group=72 AND (S.location_id='54' or S.location_id = '76')  ";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['p_name'] != "")					
					     	$qry .= " AND P.productname like '%".$get['p_name']."%' ";
						
						if($get['sku_no'] != "")					
					     	$qry .= " AND P.sku_no like '%".$get['sku_no']."%' ";
						 
				   }
				   
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_seventy_two($perpage,$pages,$get){
 	
		 $qry = "Select S.* from tbl_product_serial S,tbl_product_stock P where P.Product_id = S.product_id AND P.pg_group=72 AND (S.location_id='54' or S.location_id = '76') ";
					  
					 if(sizeof($get) > 0)
					 {
						if($get['p_name'] != "")					
					     	$qry .= " AND P.productname like '%".$get['p_name']."%' ";
						
						if($get['sku_no'] != "")					
					     	$qry .= " AND P.sku_no like '%".$get['sku_no']."%' ";
					   
				     }
 
    $data =  $this->db->query($qry)->num_rows();
 return $data;
}


//===================================Location All==============================

function getLocation($last,$strat)
{
	 if($this->session->userdata('user_id')=='1')
	 {
	    $query=$this->db->query("Select * from tbl_product_serial where status='A'  limit $strat,$last ");
	 }
	 else
	 {
	 	$query=$this->db->query("Select * from tbl_product_serial where status='A' AND comp_id='".$this->session->userdata('comp_id')."'  limit $strat,$last ");
	 }
	  return $result=$query->result();  
}


function filterLocationList($perpage,$pages,$get)
{

		if($this->session->userdata('user_id')=='1')
		{
			$qry = "Select * from tbl_product_serial where status='A' ";
		} 
		else
		{
			$qry = "Select * from tbl_product_serial where status='A' AND comp_id='".$this->session->userdata('comp_id')."' ";
		}
					
					
			 if(sizeof($get) > 0)
			 {
			
			   if($get['p_name'] != "")	
				{					
					$unitQuery=$this->db->query("select * from tbl_product_stock where productname LIKE '%".$get['p_name']."%'");
					$getUnit=$unitQuery->row();
					$sr_no=$getUnit->Product_id;
			 
				  $qry .= " AND product_id ='$sr_no'";
				}
				
			   if($get['sku_no'] != "")					
				{					
					$unitQuery=$this->db->query("select * from tbl_product_stock where sku_no = '".$get['sku_no']."'");
					$getUnit=$unitQuery->row();
					$sr_no=$getUnit->Product_id;
			 
				  $qry .= " AND product_id ='$sr_no'";
				}
				
			   if($get['main_location'] != "")
				   $qry .= " AND main_location_id = '".$get['main_location']."' ";
			
			   if($get['location'] != "")
				   $qry .= " AND location_id = '".$get['location']."' ";
			 }
			 
			$qry .=" LIMIT $pages,$perpage";
				   
	    $data =  $this->db->query($qry)->result();
		
  	return $data;

}

function count_location($perpage,$pages,$get)
{

		if($this->session->userdata('user_id')=='1') 	
		{
			$qry = "Select * from tbl_product_serial where status='A' ";
		}	  
		else
		{
			$qry = "Select * from tbl_product_serial where status='A' AND comp_id='".$this->session->userdata('comp_id')."' ";
		}
				
			if(sizeof($get) > 0)
			 {
			   if($get['p_name'] != "")	 
				{					
					$unitQuery=$this->db->query("select * from tbl_product_stock where productname LIKE '%".$get['p_name']."%'");
					$getUnit=$unitQuery->row();
					$sr_no=$getUnit->Product_id;
			 
				  $qry .= " AND product_id ='$sr_no'";
				}
				
			   if($get['sku_no'] != "")					
				{					
					$unitQuery=$this->db->query("select * from tbl_product_stock where sku_no = '".$get['sku_no']."'");
					$getUnit=$unitQuery->row();
					$sr_no=$getUnit->Product_id;
			 
				  $qry .= " AND product_id ='$sr_no'";
				}
			   
			   if($get['main_location'] != "")
				   $qry .= " AND main_location_id = '".$get['main_location']."' ";
			
			   if($get['location'] != "")
				   $qry .= " AND location_id = '".$get['location']."' ";
			   
			 }
 
    $data =  $this->db->query($qry)->num_rows();
	
 return $data;
 
}

//=============================Location Fresh=================

function getLocationFresh($last,$strat)
{
	if($this->session->userdata('user_id')=='1') 	
	{
		$query=$this->db->query("Select * from tbl_product_serial where location_id='54' and comp_id='".$this->session->userdata('comp_id')."' limit $strat,$last ");
	}
	else
	{
		$query=$this->db->query("Select * from tbl_product_serial where location_id='54' and comp_id='".$this->session->userdata('comp_id')."'  limit $strat,$last ");
	}
	  return $result=$query->result();  
}


function filterLocationFreshList($perpage,$pages,$get)
{

	if($this->session->userdata('user_id')=='1') 	
	{
		$qry = "Select * from tbl_product_serial where location_id='54' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
	else
	{
		$qry = "Select * from tbl_product_serial where location_id='54' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
					  
		 if(sizeof($get) > 0)
		 {
		
		    if($get['p_name'] != "")	
			{					
				$unitQuery=$this->db->query("select * from tbl_product_stock where productname LIKE '%".$get['p_name']."%'");
				$getUnit=$unitQuery->row();
				$sr_no=$getUnit->Product_id;
			  	$qry .= " AND product_id ='$sr_no'";
			}
			
		    if($get['sku_no'] != "")					
			{					
				$unitQuery=$this->db->query("select * from tbl_product_stock where sku_no = '".$get['sku_no']."'");
				$getUnit=$unitQuery->row();
				$sr_no=$getUnit->Product_id;
			    $qry .= " AND product_id ='$sr_no'";
			}
			
		  }
		 
		  $qry .=" LIMIT $pages,$perpage";
				   
	    $data =  $this->db->query($qry)->result();
		
  	return $data;
	
}

function count_location_fresh($perpage,$pages,$get)
{

	if($this->session->userdata('user_id')=='1') 	
	{ 	
		$qry = " Select * from tbl_product_serial where location_id='54' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
	else
	{
		$qry = " Select * from tbl_product_serial where location_id='54' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
					  
		if(sizeof($get) > 0)
		 {
		   if($get['p_name'] != "")	
			{					
				$unitQuery=$this->db->query("select * from tbl_product_stock where productname LIKE '%".$get['p_name']."%'");
				$getUnit=$unitQuery->row();
				$sr_no=$getUnit->Product_id;
			  	$qry .= " AND product_id ='$sr_no'";
			}
			
			if($get['sku_no'] != "")					
			 {					
				$unitQuery=$this->db->query("select * from tbl_product_stock where sku_no = '".$get['sku_no']."'");
				$getUnit=$unitQuery->row();
				$sr_no=$getUnit->Product_id;
			    $qry .= " AND product_id ='$sr_no'";
			 }
		   }
 
    $data =  $this->db->query($qry)->num_rows();
	
 return $data;
 
}


//=====================Location Dell Pallet=================

function getLocationDellPallet($last,$strat)
{

	if($this->session->userdata('user_id')=='1') 	
	{ 
		$query=$this->db->query("Select * from tbl_product_serial where location_id='55' and comp_id='".$this->session->userdata('comp_id')."' limit $strat,$last ");
	}
	else
	{
		$query=$this->db->query("Select * from tbl_product_serial where location_id='55' and comp_id='".$this->session->userdata('comp_id')."'  limit $strat,$last ");
	}
 
  return $result=$query->result();  
	  
}

function filterLocationDellPalletList($perpage,$pages,$get)
{

		if($this->session->userdata('user_id')=='1') 	
		{ 
			$qry = "Select * from tbl_product_serial where location_id='55' and comp_id='".$this->session->userdata('comp_id')."' ";
		}
		else
		{
			$qry = "Select * from tbl_product_serial where location_id='55' and comp_id='".$this->session->userdata('comp_id')."' ";
		}
					  
		if(sizeof($get) > 0)
		 {
		
		   if($get['p_name'] != "")	
			{					
				$unitQuery=$this->db->query("select * from tbl_product_stock where productname LIKE '%".$get['p_name']."%'");
				$getUnit=$unitQuery->row();
				$sr_no=$getUnit->Product_id;
		 
			  $qry .= " AND product_id ='$sr_no'";
			}
			
		   if($get['sku_no'] != "")					
			{					
				$unitQuery=$this->db->query("select * from tbl_product_stock where sku_no = '".$get['sku_no']."'");
				$getUnit=$unitQuery->row();
				$sr_no=$getUnit->Product_id;
		 
			  $qry .= " AND product_id ='$sr_no'";
			}
		  }
				   
	   $qry .=" LIMIT $pages,$perpage";
			   
   $data =  $this->db->query($qry)->result();
	
 return $data;
	
}

function count_location_dellPallet($perpage,$pages,$get)
{

		if($this->session->userdata('user_id')=='1') 	
		{ 	
			$qry = " Select * from tbl_product_serial where location_id='55' and comp_id='".$this->session->userdata('comp_id')."' ";
		}
		else
		{
			$qry = " Select * from tbl_product_serial where location_id='55' and comp_id='".$this->session->userdata('comp_id')."' ";
		}
					  
			if(sizeof($get) > 0)
			 {
			   if($get['p_name'] != "")	
				{					
					$unitQuery=$this->db->query("select * from tbl_product_stock where productname LIKE '%".$get['p_name']."%'");
					$getUnit=$unitQuery->row();
					$sr_no=$getUnit->Product_id;
			 
				  $qry .= " AND product_id ='$sr_no'";
				}
				
			   if($get['sku_no'] != "")					
				{					
					$unitQuery=$this->db->query("select * from tbl_product_stock where sku_no = '".$get['sku_no']."'");
					$getUnit=$unitQuery->row();
					$sr_no=$getUnit->Product_id;
			 
				  $qry .= " AND product_id ='$sr_no'";
				}
			 }
 
    $data =  $this->db->query($qry)->num_rows();
	
 return $data;
 
}


//=====================Location Demo====================


function getLocationDemo($last,$strat)
{
	if($this->session->userdata('user_id')=='1') 	
	{ 
		$query=$this->db->query("Select * from tbl_product_serial where location_id='56' and comp_id='".$this->session->userdata('comp_id')."' limit $strat,$last ");
	}
	else
	{
		$query=$this->db->query("Select * from tbl_product_serial where location_id='56' and comp_id='".$this->session->userdata('comp_id')."'  limit $strat,$last ");
	}
	
	return $result=$query->result();  
}

function filterLocationDemoList($perpage,$pages,$get)
{
	
		if($this->session->userdata('user_id')=='1') 	
		{ 	
			$qry = "Select * from tbl_product_serial where location_id='56' and comp_id='".$this->session->userdata('comp_id')."' ";
		}
		else
		{
			$qry = "Select * from tbl_product_serial where location_id='56' and comp_id='".$this->session->userdata('comp_id')."' ";
		}
					  
		 if(sizeof($get) > 0)
		 {
		
		   if($get['p_name'] != "")	
			{					
				$unitQuery=$this->db->query("select * from tbl_product_stock where productname LIKE '%".$get['p_name']."%'");
				$getUnit=$unitQuery->row();
				$sr_no=$getUnit->Product_id;
		 
			  $qry .= " AND product_id ='$sr_no'";
			}
			
		   if($get['sku_no'] != "")					
			{					
				$unitQuery=$this->db->query("select * from tbl_product_stock where sku_no = '".$get['sku_no']."'");
				$getUnit=$unitQuery->row();
				$sr_no=$getUnit->Product_id;
		 
			  $qry .= " AND product_id ='$sr_no'";
			}
			
		  }
		  
		  $qry .=" LIMIT $pages,$perpage";
				   
	    $data =  $this->db->query($qry)->result();
		
  	return $data;
	
}

function count_location_demo($perpage,$pages,$get)
{

		if($this->session->userdata('user_id')=='1') 	
		{  	
			$qry = " Select * from tbl_product_serial where location_id='56' and comp_id='".$this->session->userdata('comp_id')."' ";
		}
		else
		{
			$qry = " Select * from tbl_product_serial where location_id='56' and comp_id='".$this->session->userdata('comp_id')."' ";
		}
					  
		if(sizeof($get) > 0)
		 {
		   if($get['p_name'] != "")	
			{					
				$unitQuery=$this->db->query("select * from tbl_product_stock where productname LIKE '%".$get['p_name']."%'");
				$getUnit=$unitQuery->row();
				$sr_no=$getUnit->Product_id;
		 
			  $qry .= " AND product_id ='$sr_no'";
			}
			
		   if($get['sku_no'] != "")					
			{					
				$unitQuery=$this->db->query("select * from tbl_product_stock where sku_no = '".$get['sku_no']."'");
				$getUnit=$unitQuery->row();
				$sr_no=$getUnit->Product_id;
		 
			  $qry .= " AND product_id ='$sr_no'";
			}
		 }
 
    $data =  $this->db->query($qry)->num_rows();
	
 return $data;
 
}

//========================Location Block==============

function getLocationBlock($last,$strat)
{
	if($this->session->userdata('user_id')=='1') 	
	{
		$query=$this->db->query("Select * from tbl_product_serial where location_id='76' and comp_id='".$this->session->userdata('comp_id')."' limit $strat,$last ");
	}
	else
	{
		$query=$this->db->query("Select * from tbl_product_serial where location_id='76' and comp_id='".$this->session->userdata('comp_id')."'  limit $strat,$last ");
	}
	  return $result=$query->result();  
}

function filterLocationBlockList($perpage,$pages,$get)
{
	if($this->session->userdata('user_id')=='1') 	
	{
		$qry = "Select * from tbl_product_serial where location_id='76' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
	else
	{
		$qry = "Select * from tbl_product_serial where location_id='76' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
					  
		 if(sizeof($get) > 0)
		 {
		
		   if($get['p_name'] != "")	
			{					
				$unitQuery=$this->db->query("select * from tbl_product_stock where productname LIKE '%".$get['p_name']."%'");
				$getUnit=$unitQuery->row();
				$sr_no=$getUnit->Product_id;
		 
			  $qry .= " AND product_id ='$sr_no'";
			}
			
		   if($get['sku_no'] != "")					
			{					
				$unitQuery=$this->db->query("select * from tbl_product_stock where sku_no = '".$get['sku_no']."'");
				$getUnit=$unitQuery->row();
				$sr_no=$getUnit->Product_id;
		 
			  $qry .= " AND product_id ='$sr_no'";
			}
		 }
				   
		$qry .=" LIMIT $pages,$perpage";
			   
	$data =  $this->db->query($qry)->result();
	
 return $data;
	
}

function count_location_block($perpage,$pages,$get)
{
	if($this->session->userdata('user_id')=='1') 	
	{ 	
		$qry = " Select * from tbl_product_serial where location_id='76' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
	else
	{
		$qry = " Select * from tbl_product_serial where location_id='76' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
	 
					  
	  if(sizeof($get) > 0)
		{
		   if($get['p_name'] != "")	
			{					
				$unitQuery=$this->db->query("select * from tbl_product_stock where productname LIKE '%".$get['p_name']."%'");
				$getUnit=$unitQuery->row();
				$sr_no=$getUnit->Product_id;
		 
			  $qry .= " AND product_id ='$sr_no'";
			}
			
		   if($get['sku_no'] != "")					
			{					
				$unitQuery=$this->db->query("select * from tbl_product_stock where sku_no = '".$get['sku_no']."'");
				$getUnit=$unitQuery->row();
				$sr_no=$getUnit->Product_id;
		 
			  $qry .= " AND product_id ='$sr_no'";
			}
		}

    $data =  $this->db->query($qry)->num_rows();
	
 return $data;
 
}

//===========================Location SRN===============


function getLocationSRN($last,$strat)
{
	if($this->session->userdata('user_id')=='1') 	
	{ 	
		$query=$this->db->query("Select * from tbl_product_serial where location_id='57' and comp_id='".$this->session->userdata('comp_id')."' limit $strat,$last ");
	}
	else
	{
		$query=$this->db->query("Select * from tbl_product_serial where location_id='57' and comp_id='".$this->session->userdata('comp_id')."'  limit $strat,$last ");
	}
	  return $result=$query->result();  
}

function filterLocationSrnList($perpage,$pages,$get)
{

	if($this->session->userdata('user_id')=='1') 	
	{
		$qry = "Select * from tbl_product_serial where location_id='57' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
	else
	{
		$qry = "Select * from tbl_product_serial where location_id='57' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
					  
	 if(sizeof($get) > 0)
	 {
	
	   if($get['p_name'] != "")	
		{					
			$unitQuery=$this->db->query("select * from tbl_product_stock where productname LIKE '%".$get['p_name']."%'");
			$getUnit=$unitQuery->row();
			$sr_no=$getUnit->Product_id;
	 
		  $qry .= " AND product_id ='$sr_no'";
		}
		
	   if($get['sku_no'] != "")					
		{					
			$unitQuery=$this->db->query("select * from tbl_product_stock where sku_no = '".$get['sku_no']."'");
			$getUnit=$unitQuery->row();
			$sr_no=$getUnit->Product_id;
	 
		  $qry .= " AND product_id ='$sr_no'";
		}
	  }
			
	$qry .=" LIMIT $pages,$perpage";
				   
  $data =  $this->db->query($qry)->result();
		
 return $data;

}

function count_location_srn($perpage,$pages,$get)
{
	if($this->session->userdata('user_id')=='1') 	
	{ 	
		$qry = " Select * from tbl_product_serial where location_id='57' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
	else
	{
		$qry = " Select * from tbl_product_serial where location_id='57' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
					  
		if(sizeof($get) > 0)
		 {
		   if($get['p_name'] != "")	
			{					
				$unitQuery=$this->db->query("select * from tbl_product_stock where productname LIKE '%".$get['p_name']."%'");
				$getUnit=$unitQuery->row();
				$sr_no=$getUnit->Product_id;
		 
			  $qry .= " AND product_id ='$sr_no'";
			}
			
		   if($get['sku_no'] != "")					
			{					
				$unitQuery=$this->db->query("select * from tbl_product_stock where sku_no = '".$get['sku_no']."'");
				$getUnit=$unitQuery->row();
				$sr_no=$getUnit->Product_id;
		 
			  $qry .= " AND product_id ='$sr_no'";
			}
		 }
 
    $data =  $this->db->query($qry)->num_rows();
	
 return $data;
 
}

//=======================Location Service==============

function getLocationService($last,$strat)
{
	if($this->session->userdata('user_id')=='1') 	
	{ 
		$query=$this->db->query("Select * from tbl_product_serial where location_id='58' and comp_id='".$this->session->userdata('comp_id')."' limit $strat,$last ");
	}
	else
	{
		$query=$this->db->query("Select * from tbl_product_serial where location_id='58' and comp_id='".$this->session->userdata('comp_id')."'  limit $strat,$last ");
	}
	return $result=$query->result();  
}

function filterLocationServiceList($perpage,$pages,$get)
{
	
		if($this->session->userdata('user_id')=='1') 	
		{ 
			$qry = "Select * from tbl_product_serial where location_id='58' and comp_id='".$this->session->userdata('comp_id')."' ";
		}
		else
		{
			$qry = "Select * from tbl_product_serial where location_id='58' and comp_id='".$this->session->userdata('comp_id')."' ";
		}
						  
		 if(sizeof($get) > 0)
		 {
		
		   if($get['p_name'] != "")	
			{					
				$unitQuery=$this->db->query("select * from tbl_product_stock where productname LIKE '%".$get['p_name']."%'");
				$getUnit=$unitQuery->row();
				$sr_no=$getUnit->Product_id;
		 
			  $qry .= " AND product_id ='$sr_no'";
			}
			
		   if($get['sku_no'] != "")					
			{					
				$unitQuery=$this->db->query("select * from tbl_product_stock where sku_no = '".$get['sku_no']."'");
				$getUnit=$unitQuery->row();
				$sr_no=$getUnit->Product_id;
		 
			  $qry .= " AND product_id ='$sr_no'";
			}
		  }
		 
		 $qry .=" LIMIT $pages,$perpage";
				   
	   $data =  $this->db->query($qry)->result();
		
  	return $data;
	
}

function count_location_service($perpage,$pages,$get)
{
 	if($this->session->userdata('user_id')=='1') 	
	{
	  	$qry = " Select * from tbl_product_serial where location_id='58' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
	else
	{
		$qry = " Select * from tbl_product_serial where location_id='58' and comp_id='".$this->session->userdata('comp_id')."' ";
	}  
					  
	if(sizeof($get) > 0)
	 {
	   if($get['p_name'] != "")	
		{					
			$unitQuery=$this->db->query("select * from tbl_product_stock where productname LIKE '%".$get['p_name']."%'");
			$getUnit=$unitQuery->row();
			$sr_no=$getUnit->Product_id;
	 
		  $qry .= " AND product_id ='$sr_no'";
		}
		
	   if($get['sku_no'] != "")					
		{					
			$unitQuery=$this->db->query("select * from tbl_product_stock where sku_no = '".$get['sku_no']."'");
			$getUnit=$unitQuery->row();
			$sr_no=$getUnit->Product_id;
	 
		  $qry .= " AND product_id ='$sr_no'";
		}
	 }
 
    $data =  $this->db->query($qry)->num_rows();
	
 return $data;
 
}

//========================Location MKT FOC================


function getLocationMktFoc($last,$strat)
{
	if($this->session->userdata('user_id')=='1') 	
	{
		$query=$this->db->query("Select * from tbl_product_serial where location_id='59' and comp_id='".$this->session->userdata('comp_id')."' limit $strat,$last ");
	}
	else
	{
		$query=$this->db->query("Select * from tbl_product_serial where location_id='59' and comp_id='".$this->session->userdata('comp_id')."'  limit $strat,$last ");
	}
	  return $result=$query->result();  
}

function filterLocationMktFocList($perpage,$pages,$get)
{

	if($this->session->userdata('user_id')=='1') 	
	{
		$qry = "Select * from tbl_product_serial where location_id='59' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
	else
	{
		$qry = "Select * from tbl_product_serial where location_id='59' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
					  
		 if(sizeof($get) > 0)
		 {
		
		   if($get['p_name'] != "")	
			{					
				$unitQuery=$this->db->query("select * from tbl_product_stock where productname LIKE '%".$get['p_name']."%'");
				$getUnit=$unitQuery->row();
				$sr_no=$getUnit->Product_id;
		 
			  $qry .= " AND product_id ='$sr_no'";
			}
			
		   if($get['sku_no'] != "")					
			{					
				$unitQuery=$this->db->query("select * from tbl_product_stock where sku_no = '".$get['sku_no']."'");
				$getUnit=$unitQuery->row();
				$sr_no=$getUnit->Product_id;
		 
			  $qry .= " AND product_id ='$sr_no'";
			}
		  }
				   
		$qry .=" LIMIT $pages,$perpage";
				   
	 $data =  $this->db->query($qry)->result();
	 
  return $data;

}

function count_location_mkt($perpage,$pages,$get)
{

	if($this->session->userdata('user_id')=='1') 	
	{ 	
		$qry = " Select * from tbl_product_serial where location_id='59' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
	else
	{
		$qry = " Select * from tbl_product_serial where location_id='59' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
					  
		if(sizeof($get) > 0)
		 {
		   if($get['p_name'] != "")	
			{					
				$unitQuery=$this->db->query("select * from tbl_product_stock where productname LIKE '%".$get['p_name']."%'");
				$getUnit=$unitQuery->row();
				$sr_no=$getUnit->Product_id;
		 
			  $qry .= " AND product_id ='$sr_no'";
			}
			
		   if($get['sku_no'] != "")					
			{					
				$unitQuery=$this->db->query("select * from tbl_product_stock where sku_no = '".$get['sku_no']."'");
				$getUnit=$unitQuery->row();
				$sr_no=$getUnit->Product_id;
		 
			  $qry .= " AND product_id ='$sr_no'";
			}
		 }
 
    $data =  $this->db->query($qry)->num_rows();
	
 return $data;
 
}

//======================Location Brochure================


function getLocationBrochure($last,$strat)
{
	if($this->session->userdata('user_id')=='1') 	
	{
		$query=$this->db->query("Select * from tbl_product_serial where location_id='60' and comp_id='".$this->session->userdata('comp_id')."' limit $strat,$last ");
	}
	else
	{
		$query=$this->db->query("Select * from tbl_product_serial where location_id='60' and comp_id='".$this->session->userdata('comp_id')."'  limit $strat,$last ");
	}
	
   return $result=$query->result();  
}

function filterLocationBrochureList($perpage,$pages,$get)
{

	if($this->session->userdata('user_id')=='1') 	
	{
    	$qry = "Select * from tbl_product_serial where location_id='60' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
	else
	{
		$qry = "Select * from tbl_product_serial where location_id='60' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
					  
	 if(sizeof($get) > 0)
	 {
	
	   if($get['p_name'] != "")	
		{					
			$unitQuery=$this->db->query("select * from tbl_product_stock where productname LIKE '%".$get['p_name']."%'");
			$getUnit=$unitQuery->row();
			$sr_no=$getUnit->Product_id;
	 
		  $qry .= " AND product_id ='$sr_no'";
		}
		
	   if($get['sku_no'] != "")					
		{					
			$unitQuery=$this->db->query("select * from tbl_product_stock where sku_no = '".$get['sku_no']."'");
			$getUnit=$unitQuery->row();
			$sr_no=$getUnit->Product_id;
	 
		  $qry .= " AND product_id ='$sr_no'";
		}
	  }
	  
	$qry .=" LIMIT $pages,$perpage";
		   
   $data =  $this->db->query($qry)->result();
  
  return $data;
  
}

function count_location_brochure($perpage,$pages,$get)
{

	if($this->session->userdata('user_id')=='1') 	
	{ 	
 		$qry = " Select * from tbl_product_serial where location_id='60' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
	else
	{
		$qry = " Select * from tbl_product_serial where location_id='60' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
					  
	if(sizeof($get) > 0)
	 {
	   if($get['p_name'] != "")	
		{					
			$unitQuery=$this->db->query("select * from tbl_product_stock where productname LIKE '%".$get['p_name']."%'");
			$getUnit=$unitQuery->row();
			$sr_no=$getUnit->Product_id;
	 
		  $qry .= " AND product_id ='$sr_no'";
		}
		
	   if($get['sku_no'] != "")					
		{					
			$unitQuery=$this->db->query("select * from tbl_product_stock where sku_no = '".$get['sku_no']."'");
			$getUnit=$unitQuery->row();
			$sr_no=$getUnit->Product_id;
	 
		  $qry .= " AND product_id ='$sr_no'";
		}
	 }
 
    $data =  $this->db->query($qry)->num_rows();
	
 return $data;
 
}

//==========================Location RGP========================


function getLocationRgp($last,$strat)
{
	if($this->session->userdata('user_id')=='1') 	
	{
	
		$query=$this->db->query("select * from tbl_return_dtl where status = 'A' limit $strat,$last ");
	}
	else
	{
	
		$query=$this->db->query("select * from tbl_return_dtl where status = 'A' and comp_id='".$this->session->userdata('comp_id')."'  limit $strat,$last ");
	}
	  return $result=$query->result();  
}


function filterLocationRgpList($perpage,$pages,$get)
{

	if($this->session->userdata('user_id')=='1') 	
	{
		$qry = "select * from tbl_return_dtl where status = 'A' ";
	}
	else
	{
		$qry = "select * from tbl_return_dtl where status = 'A' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
					  
			 if(sizeof($get) > 0)
			 {
			
			   if($get['p_name'] != "")	
				{					
					$unitQuery=$this->db->query("select * from tbl_product_stock where productname LIKE '%".$get['p_name']."%'");
					$getUnit=$unitQuery->row();
					$sr_no=$getUnit->Product_id;
			 
				  $qry .= " AND product_id ='$sr_no'";
				}
				
			   if($get['sku_no'] != "")					
				{					
					$unitQuery=$this->db->query("select * from tbl_product_stock where sku_no = '".$get['sku_no']."'");
					$getUnit=$unitQuery->row();
					$sr_no=$getUnit->Product_id;
			 
				  $qry .= " AND product_id ='$sr_no'";
				}
			  }
				   
			$qry .=" LIMIT $pages,$perpage";
			
	    $data =  $this->db->query($qry)->result();
		
  	return $data;
	
}

function count_location_rgp($perpage,$pages,$get)
{

	if($this->session->userdata('user_id')=='1') 	
	{ 	
		$qry = " select *from tbl_return_dtl where status = 'A' ";
	}
	else
	{
		$qry = "select * from tbl_return_dtl where status = 'A' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
					  
		if(sizeof($get) > 0)
		 {
		   if($get['p_name'] != "")	
			{					
				$unitQuery=$this->db->query("select * from tbl_product_stock where productname LIKE '%".$get['p_name']."%'");
				$getUnit=$unitQuery->row();
				$sr_no=$getUnit->Product_id;
		 
			  $qry .= " AND product_id ='$sr_no'";
			}
			
		   if($get['sku_no'] != "")					
			{					
				$unitQuery=$this->db->query("select * from tbl_product_stock where sku_no = '".$get['sku_no']."'");
				$getUnit=$unitQuery->row();
				$sr_no=$getUnit->Product_id;
		 
			  $qry .= " AND product_id ='$sr_no'";
			}
		 }
 
    $data =  $this->db->query($qry)->num_rows();
	
 return $data;
 
}

//=========================Product Stock Summery=============================

function getStockSummery($last,$strat){
	  $query=$this->db->query("Select * from tbl_product_serial_log where status='A' and comp_id='".$this->session->userdata('comp_id')."'  limit $strat,$last ");
	  return $result=$query->result();  
}
function filterStockList($perpage,$pages,$get){

					  $qry = "Select * from tbl_product_serial_log where status='A' and comp_id='".$this->session->userdata('comp_id')."'";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['p_name'] != "")	
					     {					
						    $unitQuery=$this->db->query("select * from tbl_product_stock where productname LIKE '%".$get['p_name']."%'");
						    $getUnit=$unitQuery->row();
						    $sr_no=$getUnit->Product_id;
					 
						  $qry .= " AND product_id ='$sr_no'";
					  
					    }
						
					   if($get['p_code'] != "")					
					     {
					 		$qry .= " AND product_id = '".$get['p_code']."' ";
						 }
					
				   }
				   
	    $data =  $this->db->query($qry)->result();
  	return $data;
}

function count_stock($perpage,$pages,$get){
 	
					  $qry = "Select * from tbl_product_serial_log where status='A' and comp_id='".$this->session->userdata('comp_id')."'";
					  
					 if(sizeof($get) > 0)
					 {
					
					   if($get['p_name'] != "")	
					     {					
						    $unitQuery=$this->db->query("select * from tbl_product_stock where productname LIKE '%".$get['p_name']."%'");
						    $getUnit=$unitQuery->row();
						    $sr_no=$getUnit->Product_id;
					 
						  $qry .= " AND product_id ='$sr_no'";
					  
					    }
						
					   if($get['p_code'] != "")					
					     {
					 		$qry .= " AND product_id = '".$get['p_code']."' ";
						 }
					
				   }
 
    $data =  $this->db->query($qry)->num_rows();
 return $data;
}
//==============================End=================================

function getSearchPurchaseOrder($p_no,$v_name,$f_date,$t_date,$g_total) {
	if($p_no!='' || $v_name!='' || $f_date!='' || $t_date!='' || $g_total!=''){
   $select_query = "Select * from tbl_purchase_order_hdr";
		if($p_no!='')
		{				
			$select_query.=" where purchaseorderid  = '$p_no'";	  
		}
		
		if($v_name!='')
		{				
			$select_query.=" and vendor_id  = '$v_name'";	  
		}
		
		if($g_total!='')
		{				
			$select_query.=" and grand_total  = '$g_total'";	  
		}
		
		if($f_date!='' && $t_date!='')
		{
		
			$tdate=explode("-",$t_date);
			
			$fdate=explode("-",$f_date);

			$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
	        $fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
			$queryy .="and invoice_date >='$fdate1' and invoice_date <='$todate1'";
		}
    	}else{
	$select_query = "Select * from tbl_purchase_order_hdr";	
		}
	$query = $this->db->query($select_query);
    return $query->result();
}

function getSearchSaleOrder($p_no,$v_name,$f_date,$t_date,$g_total) {
	if($p_no!='' || $v_name!='' || $f_date!='' || $t_date!='' || $g_total!=''){

   $select_query = "Select * from tbl_sales_order_hdr";
		if($p_no!='')
		{				
			$select_query.=" where salesid  = '$p_no'";	  
		}
		
		if($v_name!='')
		{				
			$select_query.=" and vendor_id  = '$v_name'";	  
		}
		
		if($g_total!='')
		{				
			$select_query.=" and grand_total  = '$g_total'";	  
		}
		
		if($f_date!='' && $t_date!='')
		{
		
			$tdate=explode("-",$t_date);
			
			$fdate=explode("-",$f_date);

			$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
	        $fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
			$queryy .="and invoice_date >='$fdate1' and invoice_date <='$todate1'";
		}
    }else{
			$select_query = "Select * from tbl_sales_order_hdr";	
		}
	$query = $this->db->query($select_query);
    return $query->result();
}


//===========================Import Compliance========================


function getImportCompliance($last,$strat)
{

	if($this->session->userdata('user_id')=='1')
	{
	  $query=$this->db->query("select * from tbl_stock_in_hdr H, tbl_stock_in_inv_hdr I where H.stockinid = I.stockinhdr AND H.order_type != 'other_inbound' limit $strat,$last "); 	  $query1=$this->db->query("select * from tbl_stock_in_hdr H, tbl_stock_in_dtl D where H.stockinid = D.stockinhdr AND H.order_type != 'other_inbound' limit $strat,$last ");		 	}
	else
	{
	  $query=$this->db->query("select * from tbl_stock_in_hdr H, tbl_stock_in_inv_hdr I where H.stockinid = I.stockinhdr AND H.order_type != 'other_inbound' AND H.comp_id = '".$this->session->userdata('comp_id')."' limit $strat,$last "); 	  
	  $query1=$this->db->query("select * from tbl_stock_in_hdr H, tbl_stock_in_dtl D where H.stockinid = D.stockinhdr AND H.order_type != 'other_inbound' AND H.comp_id = '".$this->session->userdata('comp_id')."' limit $strat,$last ");			    
	}
	

	 $data=$query->result();  
	 $data1=$query1->result();
	 
	return $result = array_merge($data,$data1);
	 
	// echo "<pre>";
    // print_r(array_merge($data,$data1));
	// echo "</pre>";
	 
	 //return $result;
}

function filterImportCompliance($perpage,$pages,$get)
{
	if($this->session->userdata('user_id')=='1')
	{
		$qry = "select * from tbl_stock_in_hdr H, tbl_stock_in_inv_hdr I where H.stockinid = I.stockinhdr AND H.order_type != 'other_inbound' ";
		$qry1= "select * from tbl_stock_in_hdr H, tbl_stock_in_dtl D where H.stockinid = D.stockinhdr AND H.order_type != 'other_inbound' " ;
	}
	else
	{
		$qry = "select * from tbl_stock_in_hdr H, tbl_stock_in_inv_hdr I where H.stockinid = I.stockinhdr AND H.order_type != 'other_inbound' AND H.comp_id='".$this->session->userdata('comp_id')."' ";
		$qry1= "select * from tbl_stock_in_hdr H, tbl_stock_in_dtl D where H.stockinid = D.stockinhdr AND H.order_type != 'other_inbound' AND H.comp_id='".$this->session->userdata('comp_id')."' " ;
	}
					  
			 if(sizeof($get) > 0)
			 {
			
			   if($get['control_no'] != "")	
				 $qry .= " AND H.control_no = '".$get['control_no']."' ";
				 $qry1 .= " AND H.control_no = '".$get['control_no']."' ";
			  
				
			   //if($get['mawb_no'] != "")					
				 //$qry .= " AND H.mawb_no = '".$get['mawb_no']."' ";
				 //$qry1 .= " AND H.mawb_no = '".$get['mawb_no']."' ";
			 
			 }
				   
		$qry .=" LIMIT $pages,$perpage ";
		$qry1 .=" LIMIT $pages,$perpage ";
			
	    $data =  $this->db->query($qry)->result();
		$data1 =  $this->db->query($qry1)->result();
		
		return $result = array_merge($data,$data1);
		
  	//return $result;
	
}

function count_import_compliance($perpage,$pages,$get)
{

 	if($this->session->userdata('user_id')=='1')
	{
		$qry = "select * from tbl_stock_in_hdr H, tbl_stock_in_inv_hdr I where H.stockinid = I.stockinhdr AND H.order_type != 'other_inbound' ";
		$qry1= "select * from tbl_stock_in_hdr H, tbl_stock_in_dtl D where H.stockinid = D.stockinhdr AND H.order_type != 'other_inbound' " ;
	}
	else
	{
		$qry = "select * from tbl_stock_in_hdr H, tbl_stock_in_inv_hdr I where H.stockinid = I.stockinhdr AND H.order_type != 'other_inbound' AND H.comp_id='".$this->session->userdata('comp_id')."' ";
		$qry1= "select * from tbl_stock_in_hdr H, tbl_stock_in_dtl D where H.stockinid = D.stockinhdr AND H.order_type != 'other_inbound' AND H.comp_id='".$this->session->userdata('comp_id')."' " ;
	}
		  
		 if(sizeof($get) > 0)
		 {
		
		   if($get['control_no'] != "")	
			 $qry .= " AND H.control_no = '".$get['control_no']."' ";
			 $qry1 .= " AND H.control_no = '".$get['control_no']."' ";
		  
			
		   //if($get['mawb_no'] != "")					
			 //$qry .= " AND H.mawb_no = '".$get['mawb_no']."' ";
			 //$qry1 .= " AND H.mawb_no = '".$get['mawb_no']."' ";
		 
		 }
 
    $data =  $this->db->query($qry)->num_rows();
	$data1 =  $this->db->query($qry1)->num_rows();
	
	return $result = $data + $data1 ;
	
 //return $result;
 
}



//=======================End========================
}
?>