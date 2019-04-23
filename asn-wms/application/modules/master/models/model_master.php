<?php
class model_master extends CI_Model {
	
function productCatg_data()
{
	
	  $this->db->select("*");
	  // $this->db->order_by("prodcatg_id","desc");
      $this->db->from('tbl_prodcatg_mst');  
      $query = $this->db->get();
      
	  return $result=$query->result();  
}	

//============================Product=======================================

function product_get($last,$strat)
{
	
	$query=("select *from tbl_product_stock where status='A' Order by Product_id DESC limit $strat,$last ");
	
	$getQuery = $this->db->query($query);
   
    return $result=$getQuery->result();
  
}
function filterProductList($perpage,$pages,$get)
{
 	
   $qry = "select * from tbl_product_stock where status = 'A'";
    
	if(sizeof($get) > 0)
	  {
        
		   if($get['p_id'] != "")
		   	
		      $qry .= " AND Product_id = '".$get['p_id']."'";
		   
		   if($get['sku_no'] != "")
		   	
		      $qry .= " AND sku_no LIKE '%".$get['sku_no']."%'";
           
		   if($get['category'] != "")
		    {
			
			   $unitQuery2=$this->db->query("select * from tbl_prodcatg_mst where prodcatg_name LIKE '%".$get['category']."%'");
		       $getUnit2=$unitQuery2->row();
		       $sr_no2=$getUnit2->prodcatg_id;
		 
			   $qry .= " AND category ='$sr_no2'";
			  
		    }
		   
		   if($get['pg_grp'] != "")
		   	
		      $qry .= " AND pg_group = '".$get['pg_grp']."'";
			
		   if($get['fmly_grp'] != "")
		   	
		     $qry .= " AND family_group = '".$get['fmly_grp']."'";
		   
		   if($get['productname'] != "")
		   	
		      $qry .= " AND productname LIKE '%".$get['productname']."%'";
			  
		   if($get['des2'] != "")
		   	
		      $qry .= " AND description2 LIKE '%".$get['des2']."%'";
		   
		   if($get['usages_unit'] != "")
		    {
			   $unitQuery=$this->db->query("select * from tbl_master_data where keyvalue LIKE '%".$get['usages_unit']."%'");
		       $getUnit=$unitQuery->row();
		       $sr_no=$getUnit->serial_number;
		 	  
			   $qry .= " AND usageunit ='$sr_no'";
            }
	  		
		   if($get['mrp'] != "")
			  $qry .= " AND mrp LIKE '%".$get['mrp']."%'";
			  
	    }
		
		$qry .= " LIMIT $pages,$perpage";
		
 
    $data =  $this->db->query($qry)->result();
  return $data;
}

function count_product($tableName,$status = 0,$get)
{
   
  $qry ="select count(*) as countval from $tableName where status='A'";
    
   if(sizeof($get) > 0)
	  {
        
		   if($get['p_id'] != "")
		   	
		      $qry .= " AND Product_id = '".$get['p_id']."'";
		   
		   if($get['sku_no'] != "")
		   	
		      $qry .= " AND sku_no LIKE '%".$get['sku_no']."%'";
           
		   if($get['category'] != "")
		    {
			
			   $unitQuery2=$this->db->query("select * from tbl_prodcatg_mst where prodcatg_name LIKE '%".$get['category']."%'");
		       $getUnit2=$unitQuery2->row();
		       $sr_no2=$getUnit2->prodcatg_id;
		 
			   $qry .= " AND category ='$sr_no2'";
			  
		    }
		   
		   if($get['pg_grp'] != "")
		   	
		      $qry .= " AND pg_group = '".$get['pg_grp']."'";
			
		   if($get['fmly_grp'] != "")
		   	
		     $qry .= " AND family_group = '".$get['fmly_grp']."'";
		   
		   if($get['productname'] != "")
		   	
		      $qry .= " AND productname LIKE '%".$get['productname']."%'";
			  
		   if($get['des2'] != "")
		   	
		      $qry .= " AND description2 LIKE '%".$get['des2']."%'";
		   
		   if($get['usages_unit'] != "")
		    {
			   $unitQuery=$this->db->query("select * from tbl_master_data where keyvalue LIKE '%".$get['usages_unit']."%'");
		       $getUnit=$unitQuery->row();
		       $sr_no=$getUnit->serial_number;
		 	  
			   $qry .= " AND usageunit ='$sr_no'";
            }
	  		
		   if($get['mrp'] != "")
			  $qry .= " AND mrp LIKE '%".$get['mrp']."%'";
			  
	    }

     $query=$this->db->query($qry,array($status))->result_array();
	 
   return $query[0]['countval'];
   
}

//============================Contact==============================

function contact_get($last,$strat)
{
	$query=$this->db->query("select *from tbl_contact_m where status='A' ORDER BY contact_id DESC limit $strat,$last");
    return $result=$query->result();  
}

function filterContactList($perpage,$pages,$get)
{
      $qry = "select * from tbl_contact_m where status = 'A'";
        
		if(sizeof($get) > 0)
		{
        
		   if($get['code'] != "")
		  	   $qry .= " AND code = '".$get['code']."'";
			  
		   if($get['name'] != "")
		   	   $qry .= " AND first_name LIKE '%".$get['name']."%'";
			  
		   if($get['loc'] !="")
  		 	   $qry .= " and city like '%".$get['loc']."%'";
           
		   if($get['group'] != "")
		   {
			   $unitQuery=$this->db->query("select * from tbl_account_mst where account_name LIKE '%".$get['group']."%'");
		       $getUnit=$unitQuery->row();
		       $sr_no=$getUnit->account_id;
		 
			   $qry .= " AND group_name ='$sr_no'";
  	       }
		   
		   if($get['email'] != "")
 	          $qry .= " AND email LIKE '%".$get['email']."%'";
	  
		   if($get['mobile'] != "")
 		  	  $qry .= " AND mobile LIKE '%".$get['mobile']."%'";
			  
		   if($get['phone'] != "")
		  	  $qry .= " AND phone LIKE '%".$get['phone']."%'";
			  
 		}
		
		$qry .= " LIMIT $pages,$perpage";
 
  $data =  $this->db->query($qry)->result();
  
 return $data;
 
}

function count_contact($tableName,$status = 0,$get)
{
  
   $qry ="select count(*) as countval from $tableName where status='A'";
	 
	 if(sizeof($get) > 0)
		{
        
		   if($get['code'] != "")
		  	   $qry .= " AND code = '".$get['code']."'";
			  
		   if($get['name'] != "")
		   	   $qry .= " AND first_name LIKE '%".$get['name']."%'";
			  
		   if($get['loc'] !="")
  		 	   $qry .= " and city like '%".$get['loc']."%'";
           
		   if($get['group'] != "")
		   {
			   $unitQuery=$this->db->query("select * from tbl_account_mst where account_name LIKE '%".$get['group']."%'");
		       $getUnit=$unitQuery->row();
		       $sr_no=$getUnit->account_id;
		 
			   $qry .= " AND group_name ='$sr_no'";
  	       }
		   
		   if($get['email'] != "")
 	          $qry .= " AND email LIKE '%".$get['email']."%'";
	  
		   if($get['mobile'] != "")
 		  	  $qry .= " AND mobile LIKE '%".$get['mobile']."%'";
			  
		   if($get['phone'] != "")
		  	  $qry .= " AND phone LIKE '%".$get['phone']."%'";
			  
 		}
 
	 $query=$this->db->query($qry,array($status))->result_array();
	 
 	return $query[0]['countval'];
	
}


}
?>