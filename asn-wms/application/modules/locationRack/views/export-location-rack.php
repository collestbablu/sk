<?php
@extract($_GET);

$contents="MAIN LOCATION,LOCATION NAME,RACK NAME \n";	

if($_GET['filter'] != '')
{
	
    $qry = "select * from tbl_location_rack where status='A' ";
    
		   if($main_loc != "")
			{
			   $unitQuery2=$this->db->query("select * from tbl_location where location_name LIKE '%$main_loc%'");
		       $getUnit2=$unitQuery2->row();
		       $sr_no2=$getUnit2->id;
		 
			   $qry .= " AND location_id ='$sr_no2'";
		    }
		      
		  if($location != "")
		   {
			   $unitQuery=$this->db->query("select * from tbl_master_data where keyvalue LIKE '%$location%'");
		       $getUnit=$unitQuery->row();
		       $sr_no=$getUnit->serial_number;
		 
			   $qry .= " AND location_rack_id ='$sr_no'";
           }
	  		
		  if($rack_name != "")
			  $qry .= " AND rack_name LIKE '%$rack_name%'";

}
		
		
if($_GET['filter'] == '')
{
	$qry = "select * from tbl_location_rack where status='A' Order by id desc ";
}		

$result=$this->db->query($qry);

$i=1;


foreach(@$result->result() as $line)
{
$locationQuery=$this->db->query("select *from tbl_location where id='$line->location_id'");
$getLocationData=$locationQuery->row();

$locationRackQuery=$this->db->query("select *from tbl_master_data where serial_number='$line->location_rack_id'");
$getLocationRackData=$locationRackQuery->row();
							
$contents.=str_replace(',',' ',$getLocationData->location_name).",";
$contents.=str_replace(',',' ',$getLocationRackData->keyvalue).",";
$contents.=str_replace(',',' ',$line->rack_name).",\n";
	
  $i++;
} 


$filename = "LocationRack"."_".@date('Y-m-d');
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . @date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $contents;
exit;

?>		
	
