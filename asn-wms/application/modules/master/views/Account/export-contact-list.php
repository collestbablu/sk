<?php
@extract($_GET);

$contents="CODE,NAME,LOCATION,GROUP NAME,EMAIL ID,MOBILE No.,PHONE No. \n";	

if($_GET['filter'] != '')
{
	
    $qry = "select * from tbl_contact_m where status = 'A'";
    
		   if($code != "")
		  	   $qry .= " AND code = '$code' ";
			  
		   if($name != "")
		   	   $qry .= " AND first_name LIKE '%$name%' ";
			  
		   if($loc !="")
  		 	   $qry .= " and city like '%$loc%'";
           
		   if($group != "")
		   {
			   $unitQuery=$this->db->query("select * from tbl_account_mst where account_name LIKE '%$group%' ");
		       $getUnit=$unitQuery->row();
		       $sr_no=$getUnit->account_id;
		 
			   $qry .= " AND group_name ='$sr_no'";
  	       }
		   
		   if($email != "")
 	          $qry .= " AND email LIKE '%$email%' ";
	  
		   if($mobile != "")
 		  	  $qry .= " AND mobile LIKE '%$mobile%' ";
			  
		   if($phone != "")
		  	  $qry .= " AND phone LIKE '%$phone%' ";

}
		
		
if($_GET['filter'] == '')
{
	$qry = "select * from tbl_contact_m where status='A' ORDER BY contact_id DESC ";
}		

$result=$this->db->query($qry);

$i=1;


foreach(@$result->result() as $line)
{

$contQuery=$this->db->query("select * from tbl_account_mst where account_id='$line->group_name'");
$contRow=$contQuery->row();
							
$contents.=str_replace(',',' ',$line->code).",";
$contents.=str_replace(',',' ',$line->first_name).",";
$contents.=str_replace(',',' ',$line->city).",";
$contents.=str_replace(',',' ',$contRow->account_name).",";
$contents.=str_replace(',',' ',$line->email).",";
$contents.=str_replace(',',' ',$line->mobile).",";
$contents.=str_replace(',',' ',$line->phone).",\n";
	
  $i++;
} 


$filename = "ContactList"."_".@date('Y-m-d');
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . @date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $contents;
exit;

?>		
	
