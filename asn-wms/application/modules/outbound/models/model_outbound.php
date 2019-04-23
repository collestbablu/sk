<?php
class model_outbound extends CI_Model {
	
function outbound_data(){
	
	if($this->session->userdata('user_id')=='1')
	{
	  $query=$this->db->query("select * from tbl_stock_out_hdr  Order by stockoutid desc ");
	}
	else
	{
		 $query=$this->db->query("select * from tbl_stock_out_hdr where  comp_id='".$this->session->userdata('comp_id')."'  Order by stockoutid desc ");
	}
	  
      
	  return $result=$query->result();  
}
//=====================================Out Bound========================

function get_outbond_data($last,$strat)
{
	if($this->session->userdata('user_id')=='1')
	{
		
		//echo "select * from tbl_stock_out_hdr Order by stockoutid desc limit $strat,$last";
		$query=$this->db->query("select * from tbl_stock_out_hdr where comp_id='".$this->session->userdata('comp_id')."' Order by stockoutid desc limit $strat,$last");
	}
	else
	{
		$query=$this->db->query("select * from tbl_stock_out_hdr where comp_id='".$this->session->userdata('comp_id')."' Order by stockoutid desc limit $strat,$last");
	}
	return $result=$query->result();  
}
 
function filterOutbondData($perpage,$pages,$get)
{
 	if($this->session->userdata('user_id')=='1')
	{
    	$qry = "select * from tbl_stock_out_hdr where  comp_id='".$this->session->userdata('comp_id')."' ";
	}
	else
	{
		$qry = "select * from tbl_stock_out_hdr where comp_id='".$this->session->userdata('comp_id')."' ";
	}
    
	     if(sizeof($get) > 0)
		 {
         
			 //====================Product Search=======================
			 if($get['p_code'] != "")
			 {
					$sq1 = $this->db->query("select * from tbl_product_stock where sku_no = '".$get['p_code']."' ");
					$sq2 = $sq1->row();	
					
					$out = array();
					$sq3 = $this->db->query("select * from tbl_stock_out_dtl where product_id='$sq2->Product_id' ");
					foreach($sq3->result() as $sq4)
					{
					 $hdrData=$sq4->stockouthdr;
					 array_push($out,$hdrData);
					
					}	
					
					$numCnt=$sq1->num_rows();
					if($numCnt>0)
								{
							
								$hdrDataa= implode(', ', $out);
					
								}
					else
					{
					$hdrDataa='9999999';
					}
				
		
				 $qry .= "and stockoutid in ($hdrDataa)";
	
			 }
			 //=========================End=====================
		 
		 
		    if($get['date'] != "")
				$qry .= " AND date LIKE '%".$get['date']."%'";
			  
		    if($get['original_inv_rec_time'] != "")
				$qry .= " AND original_inv_rec_time LIKE '%".$get['original_inv_rec_time']."%'";
        	
		    if($get['customer'] != "")
		     {
				   $unitQuery=$this->db->query("select * from tbl_contact_m where first_name LIKE '%".$get['customer']."%'");
				   $getUnit=$unitQuery->row();
				   $sr_no=$getUnit->code;
				   $qry .= " AND contact_id = '$sr_no'";
		     }	  
		   
		    if($get['order_no'] != "")
				$qry .= " AND order_no LIKE '%".$get['order_no']."%'";
		
		    if($get['invoice_no'] != "")
				$qry .= " AND invoice_no LIKE '%".$get['invoice_no']."%'";

			if($get['location'] != "")
			  {
				 $location=$this->db->query("select * from tbl_contact_m where city like '%".$get['location']."%' ");
				 $getLocation=$location->row();		 
				 $qry .= " AND location_to = '$getLocation->contact_id'";
			  }
		  
			if($get['type'] != "")
			  {
				  $type=$this->db->query("select * from tbl_master_data where keyvalue like '%".$get['type']."%'");
				  $getType=$type->row();
				  $qry .= " AND type = '$getType->serial_number'";
			  }
	     }
		 	
		 $qry .= " LIMIT $pages,$perpage";
 
    $data =  $this->db->query($qry)->result();
	
  return $data;
  
}

function count_outbound($tableName,$status = 0,$get)
{
   if($this->session->userdata('user_id')=='1')
	{
   		$qry ="select count(*) as countval from $tableName where divn_id='1' and comp_id='".$this->session->userdata('comp_id')."' ";
	}
	else
	{
		$qry ="select count(*) as countval from $tableName where comp_id='".$this->session->userdata('comp_id')."'";
	}
    
			 //====================Product Search=======================
			 
			 if($get['p_code'] != "")
			 {
					$sq1 = $this->db->query("select * from tbl_product_stock where sku_no = '".$get['p_code']."' ");
					$sq2 = $sq1->row();	
					
					$out = array();
					$sq3 = $this->db->query("select * from tbl_stock_out_dtl where product_id='$sq2->Product_id' ");
					foreach($sq3->result() as $sq4)
					{
					 $hdrData=$sq4->stockouthdr;
					 array_push($out,$hdrData);
					
					}	
					
					$numCnt=$sq1->num_rows();
					if($numCnt>0)
								{
							
								$hdrDataa= implode(', ', $out);
					
								}
					else
					{
					$hdrDataa='9999999';
					}
				
		
				 $qry .= "and stockoutid in ($hdrDataa)";
	
			 }
			 //=========================End=====================
		 
		   if($get['date'] != "")
		   		$qry .= " AND date LIKE '%".$get['date']."%'";
			  
		   if($get['original_inv_rec_time'] != "")
		   		$qry .= " AND original_inv_rec_time LIKE '%".$get['original_inv_rec_time']."%'";
        	
		   if($get['customer'] != "")
		    {
			   $unitQuery=$this->db->query("select * from tbl_contact_m where first_name LIKE '%".$get['customer']."%'");
		       $getUnit=$unitQuery->row();
		       $sr_no=$getUnit->code;
	 		   $qry .= " AND contact_id = '$sr_no'";
		    }	  
		   
		   if($get['order_no'] != "")
			  $qry .= " AND order_no LIKE '%".$get['order_no']."%'";
		
		   if($get['invoice_no'] != "")
			  $qry .= " AND invoice_no LIKE '%".$get['invoice_no']."%'";

		   if($get['location'] != "")
		    {
			   $location=$this->db->query("select * from tbl_contact_m where city like '%".$get['location']."%' ");
			   $getLocation=$location->row();		 
			   $qry .= " AND location_to = '$getLocation->contact_id'";
		    }
		  
		   if($get['type'] != "")
		    {
		   	   $type=$this->db->query("select * from tbl_master_data where keyvalue like '%".$get['type']."%'");
		 	   $getType=$type->row();
			   $qry .= " AND type = '$getType->serial_number'";
		    }
	 
     
  	 $query=$this->db->query($qry,array($status))->result_array();
   
   return $query[0]['countval'];

} 


}
?>