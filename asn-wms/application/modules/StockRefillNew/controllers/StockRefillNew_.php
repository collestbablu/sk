<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class StockRefillNew extends my_controller {
function __construct(){
   parent::__construct(); 
}     

public function add_multiple_qty(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('contact-product-price-mapping');
	}
	else
	{
	redirect('index');
	}		
}

public function insertstockrefill(){

extract($_POST);
$table_name='tbl_product_serial';

$table_name_log='tbl_product_serial_log';
$pri_col='product_id';

 $ccc=sizeof($rows);

 for($i=0; $i<=$ccc;$i++){
		$ddd=$this->input->post('entQty')[$i];
		 
		if($ddd!=''){
		
						  
					$main_id=$this->input->post('main_id')[$i];
					$main_loc=$this->input->post('main_loc')[$i];
					$location_id=$this->input->post('location_id')[$i];
					$rack_id=$this->input->post('rack_id')[$i];
					$quantity_idd=$this->input->post('quantity_idd')[$i];
					$main_loc_two=$this->input->post('main_loc_two')[$i];
					$location_two_id=$this->input->post('location_two_id')[$i];
					$rack_two_id=$this->input->post('rack_two_id')[$i];
					$newqty=$this->input->post('entQty')[$i];
					
		
										    $comp_id = $this->session->userdata('comp_id');
											$divn_id = $this->session->userdata('divn_id');
											$zone_id = $this->session->userdata('zone_id');
											$brnh_id = $this->session->userdata('brnh_id');
											$maker_date= date('y-m-d');
											$author_date= date('y-m-d');
											
			$selectQuery = "select quantity from tbl_product_serial where product_id='$main_id' and main_location_id='$main_loc_two' and location_id='$location_two_id' and rack_id='$rack_two_id'";
					$selectQuery1=$this->db->query($selectQuery);
					
					$num= $selectQuery1->num_rows();
			
			if($num >0)
				{
				
			$this->db->query("update tbl_product_serial set quantity=quantity+'$newqty' where product_id='$main_id' and main_location_id='$main_loc_two' and location_id='$location_two_id' and rack_id='$rack_two_id'");
			
			$this->db->query("update tbl_product_serial set quantity=quantity-'$newqty' where product_id='$main_id' and main_location_id='$main_loc' and location_id='$location_id' and rack_id='$rack_id'");
						
				}else{
					
	
	$this->db->query("update tbl_product_serial set quantity=quantity-'$newqty' where product_id='$main_id' and rack_id='$rack_id'");
	
	$this->db->query("insert into tbl_product_serial set quantity='$newqty',product_id='$main_id',main_location_id='$main_loc_two' ,location_id='$location_two_id',rack_id='$rack_two_id',comp_id='$comp_id',divn_id='$divn_id',zone_id='$zone_id',brnh_id='$brnh_id',maker_date='$maker_date',author_date='$author_date'");
	
	
				}
 $this->db->query("insert into tbl_product_serial_log set main_location_two='$main_loc_two',location_two_id='$location_two_id',rack_two_id='$rack_two_id',quantity='$quantity_idd',type='Transfer', quantity_two='$newqty',product_id='$main_id',main_location_id='$main_loc' ,location_id='$location_id',rack_id='$rack_id',comp_id='$comp_id',divn_id='$divn_id',zone_id='$zone_id',brnh_id='$brnh_id',maker_date='$maker_date',author_date='$author_date'");
		
	} 
}

$this->session->set_flashdata('success', 'Internal Stock Transfer successfully');

//echo "kko";die;
echo "<script>
window.location.href='add_multiple_qty';
</script>"; 




}

public function getmainloc()
{
$data=array(
'id' =>$_GET['main_location_id']
);
	
$this->load->view('getMainLocation',$data);	
}

public function getLocationTwo()
{
$data=array(
'id' =>$_GET['location_two_id']
);
	
$this->load->view('getRack',$data);	
}

public function getRackOne()
{
$data=array(
'id' =>$_GET['rack_one_id'],
'main_loc'=>$_GET['main_loc'],
'loc'=>$_GET['loc'],
'pri_id'=>$_GET['pri_id']

);
	
$this->load->view('getRackQty',$data);	
}


public function getproduct(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('getproduct');
	}
	else
	{
	redirect('index');
	}
}

	
public function all_product_function(){
	
		$this->load->view('all-product',$data);
	
	}

	
	public function getPalletQty()
{


$qtySerial=$this->db->query("select *from tbl_product_serial where main_location_id='".$_GET['main_loc']."' and location_id='".$_GET['loc']."' and product_id='".$_GET['pri_id']."'");
$getData1=$qtySerial->row();
$numCnt=$qtySerial->num_rows();
if($numCnt>0)
{
foreach($qtySerial->result() as $getData){

$queryLocation=$this->db->query("select *from tbl_location_rack where id='$getData->rack_id'");
$getLocation=$queryLocation->row();
$numCnt=$queryLocation->num_rows();

$sum=$getData->quantity;
//echo "select * from tbl_product_serial where main_location_id='".$_GET['main_loc']."' and location_id='".$_GET['loc']."' and product_id='".$_GET['pri_id']."'";
//if($numCnt>0)
//{
echo "Rack Name Is : ".$getLocation->rack_name." and Qty is : ".$sum;
//}
//else
//{
//echo "No Record found";	
//}
}
}
else
{
echo "No Record found";	
}
}

public function getPalletQty1()
{

$qtySerial=$this->db->query("select SUM(quantity) as qty,rack_id from tbl_product_serial where main_location_id='".$_GET['main_loc']."' and location_id='".$_GET['loc']."' and product_id='".$_GET['pri_id']."'");
$getData=$qtySerial->row();

$queryLocation=$this->db->query("select *from tbl_location_rack where id='$getData->rack_id'");
$getLocation=$queryLocation->row();
$numCnt=$queryLocation->num_rows();
if($numCnt>0)
{
echo "Rack Name Is:-".$getLocation->rack_name." and Qty is:-".$getData->qty;
}
else
{
echo "No Record found";	
}
}


}	
		
