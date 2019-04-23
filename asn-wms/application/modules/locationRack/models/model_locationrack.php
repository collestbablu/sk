<?php
class model_locationrack extends CI_Model {
	
function get_locationrack($last,$strat)
{
	  $query=$this->db->query("select * from tbl_location_rack where status='A' Order by id desc limit $strat,$last");
	  return $result=$query->result();  
 }
 
function filterLocationRack($perpage,$pages,$get)
{
     $qry = "select * from tbl_location_rack where status = 'A'";
    
	   if(sizeof($get) > 0)
		{
         
		  if($get['main_loc'] != "")
			{
			   $unitQuery2=$this->db->query("select * from tbl_location where location_name LIKE '%".$get['main_loc']."%'");
		       $getUnit2=$unitQuery2->row();
		       $sr_no2=$getUnit2->id;
		 
			   $qry .= " AND location_id ='$sr_no2'";
		    }
		      
		  if($get['location'] != "")
		   {
			   $unitQuery=$this->db->query("select * from tbl_master_data where keyvalue LIKE '%".$get['location']."%'");
		       $getUnit=$unitQuery->row();
		       $sr_no=$getUnit->serial_number;
		 
			   $qry .= " AND location_rack_id ='$sr_no'";
           }
	  		
		  if($get['rack_name'] != "")
			  $qry .= " AND rack_name LIKE '%".$get['rack_name']."%'";
			  
	 	}
		
		$qry .= " LIMIT $pages,$perpage";
 
    $data =  $this->db->query($qry)->result();
	
  return $data;
  
}

function count_location_rack($tableName,$status = 0,$get)
{
   
   $qry ="select count(*) as countval from $tableName where status='A'";
    
         
	 if(sizeof($get) > 0)
		{
         
		  if($get['main_loc'] != "")
			{
			   $unitQuery2=$this->db->query("select * from tbl_location where location_name LIKE '%".$get['main_loc']."%'");
		       $getUnit2=$unitQuery2->row();
		       $sr_no2=$getUnit2->id;
		 
			   $qry .= " AND location_id ='$sr_no2'";
		    }
		      
		  if($get['location'] != "")
		   {
			   $unitQuery=$this->db->query("select * from tbl_master_data where keyvalue LIKE '%".$get['location']."%'");
		       $getUnit=$unitQuery->row();
		       $sr_no=$getUnit->serial_number;
		 
			   $qry .= " AND location_rack_id ='$sr_no'";
           }
	  		
		  if($get['rack_name'] != "")
			  $qry .= " AND rack_name LIKE '%".$get['rack_name']."%'";
			  
	 	}
			  
	 
  	 $query=$this->db->query($qry,array($status))->result_array();
   
   return $query[0]['countval'];
   
} 
 
}
?>