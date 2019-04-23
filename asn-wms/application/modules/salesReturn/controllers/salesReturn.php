<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class salesReturn extends my_controller {
function __construct(){
   parent::__construct();
   $this->load->model('model_returnsrn');

}     

public function addSRN(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('add-returnSRN');
	}
	else
	{
	redirect('index');
	}		
}

public function getproductcase_fun(){
	if($this->session->userdata('is_logged_in')){
	 $data['main_menu'] = $_GET['con'];
		$this->load->view('getmonth',$data);
	}
	else
	{
	redirect('index');
	}
}


public function manageSRN(){
	
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	$data['result'] = $this->model_returnsrn->returnsrn_data();
	$this->load->view('manage-returnSRN',$data);
	}
	else
	{
	redirect('index');
	}	
}


public function stockIn(){
	
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	
	$this->load->view('stockInProduct',$data);
	}
	else
	{
	redirect('index');
	}	
}





public function edit_SRN(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('edit-returnSRN');
	}
	else
	{
	redirect('index');
	}		
}

	

public function insertStockIn(){
		
		extract($_POST);
		$table_name ='tbl_return_hdr';
		$table_name_dtl ='tbl_return_dtl';
		$pri_col ='returnid';
		$pri_col_dtl ='returnhdr';
		
		$sess = array(
					
					'maker_id' => $this->session->userdata('user_id'),
					'maker_date' => date('y-m-d'),
					
					'comp_id' => $this->session->userdata('comp_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'divn_id' => $this->session->userdata('divn_id')
		);
	
		$data = array(
	
					'date' => $this->input->post('date'),
					'original_inv_rec_time' => $this->input->post('original_inv_rec_time'),
					'contact_id' => $this->input->post('contact_id'),
					'type' => $this->input->post('type'),
					'order_no' => $this->input->post('order_no'),
					'sub_total' => $this->input->post('sub_total'),
					'service_charge_per' => $this->input->post('service_charge_per'),
					'service_charge_total' => $this->input->post('service_charge_total'),
					'gross_discount_per' => $this->input->post('gross_discount_per'),
					'gross_discount_total' => $this->input->post('gross_discount_total'),
					
					'grand_total' => $this->input->post('grand_total'),
					'invoice_no' => $invoice_no,
							
					'remarks' => $remarks
					
					
					);
			
			$data_merge = array_merge($data,$sess);					
		    $this->load->model('Model_admin_login');	
		    $this->Model_admin_login->insert_user($table_name,$data_merge);
			$lastHdrId=$this->db->insert_id();		
			$this->load->model('Model_admin_login');
		
		for($i=0; $i<=$rows; $i++)
				{
				 				
			    
				
				
				if($qty[$i]!=''){

				 $data_dtl['returnhdr']= $lastHdrId;
				 $data_dtl['product_id']=$this->input->post('main_id')[$i];				 
				 $data_dtl['list_price']=$this->input->post('list_price')[$i];
				 $data_dtl['quantity']=$this->input->post('qty')[$i];
				 $data_dtl['discount']=$this->input->post('discount')[$i];
				 $data_dtl['discount_amount']=$this->input->post('disAmount')[$i];
				$data_dtl['hsn_code']=$this->input->post('hsn_code')[$i];
				 $data_dtl['total']=$this->input->post('tot')[$i];
				
				 $data_dtl['net_price']=$this->input->post('nettot')[$i];
				 $data_dtl['maker_id']=$this->session->userdata('user_id');
				 $data_dtl['maker_date']=date('y-m-d');
				 $data_dtl['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl['brnh_id']=$this->session->userdata('brnh_id');
				
				
				
				
				//$this->stock_refill_qty($qty[$i],$main_id[$i],$sizeval[$i]);
				
				
				
				$this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);		
							}
					}
				//$this->paymentAmount($grand_total,$vendor_id,$lastHdrId,$id);	
			//$this->paymentAmount($grand_total,$vendor_id,$lastHdrId,$id);	
			//$this->updateTermAndCondition($lastHdrId,$vendor_id,$grand_total,$date);
				//$this->software_log_insert($lastHdrId,$vendor_id,$grand_total,'Sales Order added');
				
	
				
			 $rediectInvoice="salesReturn/manageSRN";
		redirect($rediectInvoice);	
	   
					
	
	}

	
	
	public function updateInbound(){
		
		extract($_POST);
		$table_name ='tbl_return_hdr';
		$table_name_dtl ='tbl_return_dtl';
		$pri_col ='returnid';
		$pri_col_dtl ='returnhdr';
		
		
 //$this->refil_qnty_del($id);

		 $this->db->query("delete from $table_name_dtl where returnhdr='$id'");	
				
				
				
		$sess = array(
					
					'maker_id' => $this->session->userdata('user_id'),
					'maker_date' => date('y-m-d'),
					'comp_id' => $this->session->userdata('comp_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'divn_id' => $this->session->userdata('divn_id')
		);
	
		$data = array(
	
					'date' => $this->input->post('date'),
					'original_inv_rec_time' => $this->input->post('original_inv_rec_time'),
					'contact_id' => $this->input->post('contact_id'),
					'type' => $this->input->post('type'),
					'order_no' => $this->input->post('order_no'),
					'sub_total' => $this->input->post('sub_total'),
					'service_charge_per' => $this->input->post('service_charge_per'),
					'service_charge_total' => $this->input->post('service_charge_total'),
					'gross_discount_per' => $this->input->post('gross_discount_per'),
					'gross_discount_total' => $this->input->post('gross_discount_total'),
					
					'grand_total' => $this->input->post('grand_total'),
					'invoice_no' => $invoice_no,
							
					'remarks' => $remarks
					
					
					);
			
			$data_merge = array_merge($data,$sess);					
		   
			$this->load->model('Model_admin_login');	
		$this->Model_admin_login->update_user($pri_col,$table_name,$id,$data_merge);

		
		for($i=0; $i<=$rows; $i++)
				{
				 				
			    
			
				
				if($qty[$i]!=''){

				 $data_dtl['returnhdr']= $id;
				 $data_dtl['product_id']=$this->input->post('main_id')[$i];				 
				 $data_dtl['list_price']=$this->input->post('list_price')[$i];
				 $data_dtl['hsn_code']=$this->input->post('hsn_code')[$i];
				 
				 $data_dtl['quantity']=$this->input->post('qty')[$i];
				 $data_dtl['discount']=$this->input->post('discount')[$i];
				 $data_dtl['discount_amount']=$this->input->post('disAmount')[$i];
				 $data_dtl['total']=$this->input->post('tot')[$i];
				
				 $data_dtl['net_price']=$this->input->post('nettot')[$i];
				 $data_dtl['maker_id']=$this->session->userdata('user_id');
				 $data_dtl['maker_date']=date('y-m-d');
				 $data_dtl['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl['brnh_id']=$this->session->userdata('brnh_id');
				
				$this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);		
				//$this->updata_stock($qty[$i],$main_id[$i],$sizeval[$i]);
	
							}
					}
					//$this->paymentAmount($grand_total,$vendor_id,$lastHdrId,$id);
					//$this->software_log_insert($id,$vendor_id,$grand_total,'Sales Order Updated');
	   echo "<script type='text/javascript'>";
					echo "window.close();";
					echo "window.opener.location.reload();";
					echo "</script>";
					
	
	}
	
	function refil_qnty_del($id){
	
		 $data= $this->db->query("select * from tbl_sales_order_dtl where salesid='$id'");
		foreach($data->result() as $update){
		$this->db->query("update tbl_product_stock set quantity=quantity+'".$update->quantity."' where   Product_id='".$update->product_id."'");
		  $this->db->query("update tbl_product_serial set quantity=quantity+'".$update->quantity."' where product_id='".$update->product_id."'");
		
		
		}
return;	
	}
	
	
	
	
	public function stock_refill_qty($qty,$main_id,$sizeval)
	{
	
	 $qtycount=sizeof(explode(',', $qty));
	 $sizecount=sizeof(explode(',', $sizeval));
		  
		  $sizent=0;
		  $qtynt=0;
		  $sumqtynt=0;
		  for($p=0;$p<$sizecount;$p++){
		  
		  $expsize=explode(',', $sizeval);
		  $sizent=$expsize[$p];
		  
		  $exp=explode(',', $qty);
		  $qtynt=$exp[$p];
		  
		   $sumqtynt +=$exp[$p];
		 
		
		  
			$location_id=$this->session->userdata('brnh_id');
									
			$selectQuery = "select quantity from tbl_product_serial where product_id='$main_id' and location_id='$location_id' and size='$sizent'";
					$selectQuery1=$this->db->query($selectQuery);
						$num= $selectQuery1->num_rows();
						
		
		if($num>0){
			
			$this->db->query("update tbl_product_serial set size='$sizent',quantity=quantity-'$qtynt',location_id='$location_id' where product_id='$main_id' and size='$sizent'");
			
			
		}else{
			  								$comp_id = $this->session->userdata('comp_id');
											$divn_id = $this->session->userdata('divn_id');
											$zone_id = $this->session->userdata('zone_id');
											$brnh_id = $this->session->userdata('brnh_id');
											$maker_date= date('y-m-d');
											$author_date= date('y-m-d');
											
				$this->db->query("insert into tbl_product_serial set size='$sizent',quantity='$qtynt',location_id='$location_id',product_id='$main_id',comp_id='$comp_id',divn_id='$divn_id',zone_id='$zone_id',brnh_id='$brnh_id',maker_date='$maker_date',author_date='$author_date'");
					
		}

				
	} 

	$this->db->query("update tbl_product_stock set quantity=quantity-'$sumqtynt' where Product_id='$main_id'");

	}
	
	
	function updata_stock($qty,$main_id,$sizeval){
	
		 
	
	 $qtycount=sizeof(explode(',', $qty));
	 $sizecount=sizeof(explode(',', $sizeval));
		  
		  $sizent=0;
		  $qtynt=0;
		  $sumqtynt=0;
		  for($p=0;$p<$sizecount;$p++){
		  
		  $expsize=explode(',', $sizeval);
		   $sizent=$expsize[$p];
		  
		  $exp=explode(',', $qty);
		  $qtynt=$exp[$p];
		 // echo "<br/>";
			   $sumqtynt +=$exp[$p];
		 
		
		
			$location_id=$this->session->userdata('brnh_id');
									
			$selectQuery = "select quantity from tbl_product_serial where product_id='$main_id' and location_id='$location_id' and size='$sizent'";
					$selectQuery1=$this->db->query($selectQuery);
						$num= $selectQuery1->num_rows();
						
		
		if($num>0){
			
			$this->db->query("update tbl_product_serial set size='$sizent',quantity=quantity-'$qtynt',location_id='$location_id' where product_id='$main_id' and size='$sizent'");
			
			
		}else{
			  								$comp_id = $this->session->userdata('comp_id');
											$divn_id = $this->session->userdata('divn_id');
											$zone_id = $this->session->userdata('zone_id');
											$brnh_id = $this->session->userdata('brnh_id');
											$maker_date= date('y-m-d');
											$author_date= date('y-m-d');
											
				$this->db->query("insert into tbl_product_serial set size='$sizent',quantity='$qtynt',location_id='$location_id',product_id='$main_id',comp_id='$comp_id',divn_id='$divn_id',zone_id='$zone_id',brnh_id='$brnh_id',maker_date='$maker_date',author_date='$author_date'");
					
		}

				
	} 
	//echo   $sumqtynt; 
	$this->db->query("update tbl_product_stock set quantity=quantity-'$sumqtynt' where Product_id='$main_id'");

	 
	
	}	
	

public function paymentAmount($grand_total,$vendor_id,$lastHdrId,$id){
	
	$table_name='tbl_invoice_payment';
	$pri_col='invoiceid';
	if($id!=''){
	$lastHdrId=$id;
	}
	else
	{
		$lastHdrId;
	}
	$data_pay = array(
	
					'contact_id' => $vendor_id,
					'receive_billing_mount' => $grand_total,
					'invoiceid' => $lastHdrId,					
					'date' =>date('Y-m-d H:i:s'),
					'maker_id' => $this->session->userdata('user_id'),
					'maker_date' => date('y-m-d'),
					'comp_id' => $this->session->userdata('comp_id'),
					'status' => 'invoice'					
					
		);
	$this->load->model('Model_admin_login');
	if($id!=''){

		$this->Model_admin_login->update_user($pri_col,$table_name,$id,$data_pay);
	}else{
		
	$this->Model_admin_login->insert_user($table_name,$data_pay);
	}	
	return paymentAmount; 
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

public function viewSalesOrder(){
	if($this->session->userdata('is_logged_in')){
	
	$this->load->view('view-sales-order');
	}
	else
	{
	redirect('index');
	}
		
}



function deleteSalesOrder(){
	$table_name ='tbl_purchase_order_hdr';
	$table_name_dtl ='tbl_purchase_order_dtl';
	$pri_col ='purchase_order_id';	
	$pri_col_dtl ='purchase_order_hdr_id';
	$this->load->model('Model_admin_login');
		$id= $_GET['id'];
		$id_dtl= $_GET['id'];
		$this->Model_admin_login->delete_user($pri_col,$table_name,$id);
		$this->Model_admin_login->delete_user($pri_col_dtl,$table_name_dtl,$id_dtl);
		redirect('SalesOrder/managePurchaseOrder');
}

function delete_updata_stock($qty,$main_id){
	
		 $this->db->query("update tbl_product_stock set quantity=quantity+'$qty' where Product_id='$main_id'");
		 $this->db->query("update tbl_product_serial set quantity=quantity+'$qty' where product_id='$main_id'");
		return;	
	}	




public function getRack()
{
$data=array(
'id' =>$_GET['location_rack_id']
);

	
$this->load->view('getRack',$data);	
}


public function getRackQty()
{



$rackQty=$this->db->query("select SUM(quantity) as s from tbl_product_serial where rack_id='".$_GET['location_rack_id']."' and product_id='".$_GET['pid']."'");
$getQty=$rackQty->row();
echo $getQty->s;
}

public function insertstockreff(){



extract($_POST);
if($save!=''){
//echo "hell";die;

 $a=sizeof($product_id);
for($i=0; $i<$a; $i++){
if($new_quantity[$i]!='')
{

//echo $product_id[$i];

		 $selectQuery = "select * from tbl_product_serial where product_id='$product_id[$i]' and location_id='$location_id[$i]' and rack_id='$rack_id[$i]'";
		$selectQuery1=$this->db->query($selectQuery);

		 $num= $selectQuery1->num_rows();

		if($num >0)

		{	

		$secode=$product_id[$i]."_".$location_id1;
	
$this->db->query("update tbl_product_serial set quantity =quantity+$new_quantity[$i] where product_id='".$product_id[$i]."' and location_id='".$location_id[$i]."' and rack_id='$rack_id[$i]'");

$p_Q=$this->db->query("update tbl_product_stock set quantity =quantity+$new_quantity[$i] where Product_id='".$product_id[$i]."' ");

 $sqlProdLoc1="insert into tbl_product_serial_log set quantity ='$new_quantity[$i]',location_id='$location_id[$i]',rack_id='$rack_id[$i]',product_id='$product_id[$i]',inbound_id='$inbound_id', maker_date=NOW(), author_date=now(), author_id='".$this->session->userdata('user_id')."',type='$type', maker_id='".$this->session->userdata('user_id')."', divn_id='".$this->session->userdata('divn_id')."', comp_id='".$this->session->userdata('comp_id')."', zone_id='".$this->session->userdata('zone_id')."', brnh_id='".$this->session->userdata('brnh_id')."' ";
$this->db->query($sqlProdLoc1);



 		}else{
			$sqlProdLoc2="insert into tbl_product_serial set product_id='$product_id[$i]',serial_number='$serialno', quantity ='$new_quantity[$i]', location_id='$location_id[$i]',rack_id='$rack_id[$i]', maker_date=NOW(), author_date=now(), author_id='".$this->session->userdata('user_id')."', maker_id='".$this->session->userdata('user_id')."', divn_id='".$this->session->userdata('divn_id')."', comp_id='".$this->session->userdata('comp_id')."', zone_id='".$this->session->userdata('zone_id')."', brnh_id='".$this->session->userdata('brnh_id')."'"; 
$this->db->query($sqlProdLoc2);

 $this->db->query("update tbl_product_stock set quantity =quantity+$new_quantity[$i] where Product_id='".$product_id[$i]."' ");

 
$sqlProdLoc1="insert into tbl_product_serial_log set quantity ='$new_quantity[$i]',location_id='$location_id[$i]',rack_id='$rack_id[$i]',product_id='$product_id[$i]',type='$type', maker_date=NOW(), author_date=now(), author_id='".$this->session->userdata('user_id')."',inbound_id='$inbound_id', maker_id='".$this->session->userdata('user_id')."', divn_id='".$this->session->userdata('divn_id')."', comp_id='".$this->session->userdata('comp_id')."', zone_id='".$this->session->userdata('zone_id')."', brnh_id='".$this->session->userdata('brnh_id')."' ";
$this->db->query($sqlProdLoc1);
 
 
  			
				}

	 $lastHdrId=$this->db->insert_id();
		
}
}

?>
<script>
alert('Quantity Added Successfully ');
window.close();
</script>

<?php

 }
//redirect('/StockRefill/add_multiple_qty');
} 
		
}