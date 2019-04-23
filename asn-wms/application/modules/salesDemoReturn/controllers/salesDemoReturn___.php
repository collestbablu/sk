<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class salesDemoReturn extends my_controller {

function __construct()
{
    parent::__construct();
    $this->load->model('model_returndemo');
    $this->load->library('pagination');
}     

public function addDemoOutBound()
{
	if($this->session->userdata('is_logged_in'))
	{
		$this->load->view('add-demo-outbound');
	}
	else
	{
		redirect('index');
	}		
}

public function getproductcase_fun()
{
	if($this->session->userdata('is_logged_in'))
	{
	 	$data['main_menu'] = $_GET['con'];
		$this->load->view('getmonth',$data);
	}
	else
	{
		redirect('index');
	}
}

public function export_demo_outbound()
{
	if($this->session->userdata('is_logged_in'))
	{
		$this->load->view('export-demo-outbound-data');
	}
	else
	{
		redirect('index');
	}
}

public function manageDemoOutbound()
{
	if($this->session->userdata('is_logged_in'))
	{
		//$data=$this->user_function();// call permission fnctn
		//$data['result'] = $this->model_returndemo->returnDemo_data();
		$data = $this->Demo_Outbond_Data();
		$this->load->view('manage-demo-outbound',$data);
	}
	else
	{
		redirect('index');
	}	
}

public function Demo_Outbond_Data()
{

     	$table_name='tbl_return_hdr';
     	$data['result'] = "";
	    //$url   = site_url('/salesDemoReturn/manageDemoOutbound?');
	    $sgmnt = "4";
	    
		if($_GET['entries']!="")
		  {
			  $showEntries = $_GET['entries'];
		  }
		 else
		  {
			  $showEntries =10;
		  }
		
        $totalData   = $this->model_returndemo->count_demo_outbound($table_name,'A',$this->input->get());
        
        if($_GET['entries']!="" && $_GET['filter']!='filter')
	     {
	       $url   = site_url('/salesDemoReturn/manageDemoOutbound?entries='.$_GET['entries']);
	     }
	     elseif($_GET['filter']=='filter' || $_GET['entries'] != '')
	     {
	       $url = site_url('/salesDemoReturn/manageDemoOutbound?returnid='.$_GET['returnid'].'&respblty='.$_GET['respblty'].'&g_p_date='.$_GET['g_p_date'].'&rt_due_date='.$_GET['rt_due_date'].'&g_p_no='.$_GET['g_p_no'].'&m_g_p_no='.$_GET['m_g_p_no'].'&m_g_p_date='.$_GET['m_g_p_date'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
		 }
	     else
	     {
	       $url   = site_url('/salesDemoReturn/manageDemoOutbound?');
	     }
         
		 $pagination = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
         $data=$this->user_function();
     	 
		 $data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
		 $data['pagination'] = $this->pagination->create_links();
	
		 if($this->input->get('filter') == 'filter') 
        	$data['result'] = $this->model_returndemo->filterDemoOutbondData($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_returndemo->get_return_demo_data($pagination['per_page'],$pagination['page']);

   		return $data;

}


public function stockIn()
{
	if($this->session->userdata('is_logged_in'))
	{
		$data=$this->user_function();// call permission fnctn
		$this->load->view('stockInProduct',$data);
	}
	else
	{
		redirect('index');
	}	
}





public function edit_demo_outbound_order()
{
	if($this->session->userdata('is_logged_in'))
	{
		$this->load->view('edit-demo-outbound-order');
	}
	else
	{
		redirect('index');
	}		
}

	

public function insertOutbound(){
		
		extract($_POST);
		$table_name ='tbl_return_hdr';
		$table_name_dtl ='tbl_return_dtl';
		$pri_col ='returnid';
		$pri_col_dtl ='returnhdr';
		$table_name_sr='tbl_product_serial_log';
		
		$sess = array(
					
					'maker_id' => $this->session->userdata('user_id'),
					'maker_date' => date('y-m-d'),
					
					'comp_id' => $this->session->userdata('comp_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'divn_id' => $this->session->userdata('divn_id')
		);
	
		$data = array(
	
					'rgp_gate_pass_date' => $this->input->post('rgp_gate_pass_date'),
					'return_due_date' => $this->input->post('return_due_date'),
					'rgp_gatepass_no' => $this->input->post('rgp_gatepass_no'),
					'manual_gate_pass_no' => $this->input->post('manual_gate_pass_no'),
					'manual_gp_date' => $this->input->post('manual_gp_date'),
					'gatepass_issued_name' => $this->input->post('gatepass_issued_name'),
					'responsibility' => $this->input->post('responsibility'),
					'remarks1' => $this->input->post('remarks1'),
					'remarks2' => $this->input->post('remarks2'),
					'wh_remarks' => $this->input->post('wh_remarks'),
					'stock_position' => $this->input->post('stock_position'),
					'location_to' => $this->input->post('location_to'),
					
					'return_type' => 'Demo'
					
					
					
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
				// $data_dtl['list_price']=$this->input->post('list_price')[$i];
				 $data_dtl['main_loc']=$this->input->post('main_loc')[$i];
				 $data_dtl['loc']=$this->input->post('loc')[$i];
				 $data_dtl['rack_id']=$this->input->post('rack_id')[$i];
				 $data_dtl['quantity']=$this->input->post('qty')[$i];
				 //$data_dtl['discount']=$this->input->post('discount')[$i];
				 //$data_dtl['discount_amount']=$this->input->post('disAmount')[$i];
				 $data_dtl['hsn_code']=$this->input->post('hsn_code')[$i];
				 //$data_dtl['total']=$this->input->post('tot')[$i];
				
				 //$data_dtl['net_price']=$this->input->post('nettot')[$i];
				 $data_dtl['maker_id']=$this->session->userdata('user_id');
				 $data_dtl['maker_date']=date('y-m-d');
				 $data_dtl['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl['brnh_id']=$this->session->userdata('brnh_id');
				
				
				$productQty=$this->input->post('qty')[$i];
				$this->db->query("update tbl_product_serial set quantity=quantity-'$productQty' where product_id='".$main_id[$i]."' and main_location_id='".$main_loc[$i]."' and location_id='".$loc[$i]."' and rack_id='".$rack_id[$i]."'");
				
				$this->db->query("update tbl_product_stock set quantity=quantity-'$productQty' where product_id='$main_id[$i]'");
				
				
				$dataSerial=array(
				'main_location_id' => $main_loc[$i],
				'location_id' => $loc[$i],
				'rack_id' => $rack_id[$i],
				'quantity' => $qty[$i],
				'product_id' => $main_id[$i],
				'type' => 'Demo Outbound',
				'inbound_id' => $lastHdrId,
				'maker_id' => $this->session->userdata('user_id'),

				 'maker_date' => date('y-m-d'),
				 'comp_id' => $this->session->userdata('comp_id'),
				 'zone_id' => $this->session->userdata('zone_id'),
				 'brnh_id' => $this->session->userdata('brnh_id')
				 
				
				);
				$this->Model_admin_login->insert_user($table_name_sr,$dataSerial);	
				//$this->stock_refill_qty($qty[$i],$main_id[$i],$sizeval[$i]);
				
				$this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);		
							}
					}
				//$this->paymentAmount($grand_total,$vendor_id,$lastHdrId,$id);	
			//$this->paymentAmount($grand_total,$vendor_id,$lastHdrId,$id);	
			//$this->updateTermAndCondition($lastHdrId,$vendor_id,$grand_total,$date);
				//$this->software_log_insert($lastHdrId,$vendor_id,$grand_total,'Sales Order added');
				
			 $rediectInvoice="salesDemoReturn/manageDemoOutbound";
		redirect($rediectInvoice);	
	   
}

	
	
public function updateInbound(){
		
		extract($_POST);
		$table_name ='tbl_return_hdr';
		$table_name_dtl ='tbl_return_dtl';
		$pri_col ='returnid';
		$pri_col_dtl ='returnhdr';
		
		
		// $this->refil_qnty_del($id);

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
	
					'rgp_gate_pass_date' => $this->input->post('rgp_gate_pass_date'),
					'return_due_date' => $this->input->post('return_due_date'),
					'rgp_gatepass_no' => $this->input->post('rgp_gatepass_no'),
					'manual_gate_pass_no' => $this->input->post('manual_gate_pass_no'),
					'manual_gp_date' => $this->input->post('manual_gp_date'),
					'gatepass_issued_name' => $this->input->post('gatepass_issued_name'),
					'responsibility' => $this->input->post('responsibility'),
					'remarks1' => $this->input->post('remarks1'),
					'remarks2' => $this->input->post('remarks2'),
					'wh_remarks' => $this->input->post('wh_remarks'),
					'stock_position' => $this->input->post('stock_position'),
					'location_to' => $this->input->post('location_to'),
					'return_type' => 'Demo'
					
					
					);
			
			$data_merge = array_merge($data,$sess);					
		   
			$this->load->model('Model_admin_login');	
		$this->Model_admin_login->update_user($pri_col,$table_name,$id,$data_merge);

		
		for($i=0; $i<=$rows; $i++)
				{
				 				
			    
			
				
				if($qty[$i]!=''){

				 $data_dtl['returnhdr']= $id;
				 $data_dtl['product_id']=$this->input->post('main_id')[$i];				 
				// $data_dtl['list_price']=$this->input->post('list_price')[$i];
				 $data_dtl['main_loc']=$this->input->post('main_loc')[$i];
				 $data_dtl['loc']=$this->input->post('loc')[$i];
				 $data_dtl['rack_id']=$this->input->post('rack_id')[$i];
				 $data_dtl['quantity']=$this->input->post('qty')[$i];
				 //$data_dtl['discount']=$this->input->post('discount')[$i];
				 //$data_dtl['discount_amount']=$this->input->post('disAmount')[$i];
				 $data_dtl['hsn_code']=$this->input->post('hsn_code')[$i];
				 //$data_dtl['total']=$this->input->post('tot')[$i];
				 $data_dtl['maker_id']=$this->session->userdata('user_id');
				 $data_dtl['maker_date']=date('y-m-d');
				 $data_dtl['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl['brnh_id']=$this->session->userdata('brnh_id');
				
				$this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);		
				//$this->updata_stock($qty[$i],$main_id[$i],$main_loc[$i],$loc[$i],$rack_id[$i]);
	
							}
					}
					//$this->paymentAmount($grand_total,$vendor_id,$lastHdrId,$id);
					//$this->software_log_insert($id,$vendor_id,$grand_total,'Sales Order Updated');
	   echo "<script type='text/javascript'>";
					echo "window.close();";
					echo "window.opener.location.reload();";
					echo "</script>";
					
	
}
	
function refil_qnty_del($id)
{
	 $data= $this->db->query("select * from tbl_sales_order_dtl where salesid='$id'");
	 foreach($data->result() as $update)
	 {
		  $this->db->query("update tbl_product_stock set quantity=quantity+'".$update->quantity."' where   Product_id='".$update->product_id."'");
		  $this->db->query("update tbl_product_serial set quantity=quantity+'".$update->quantity."' where product_id='".$update->product_id."' and main_location_id='".$update->main_loc."' and location_id='".$update->loc."' and rack_id='".$update->rack_id."' ");
		
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
	
	
function updata_stock($qty,$main_id,$main_loc,$loc,$rack_id)
{
									
		$selectQuery = "select quantity from tbl_product_serial where product_id='$main_id' and main_location_id='$main_loc' and location_id='$loc' and $rack_id='$rack_id'";
		$selectQuery1=$this->db->query($selectQuery);
		$num= $selectQuery1->num_rows();
						
		
		if($num>0){
			//echo "update tbl_product_serial set quantity=quantity-'$qty' where product_id='$main_id' and main_location_id='$main_loc' and location_id='$loc' and rack_id='$rack_id'";die;
			$this->db->query("update tbl_product_serial set quantity=quantity-'$qty' where product_id='$main_id' and main_location_id='$main_loc' and location_id='$loc' and rack_id='$rack_id'");
			//$this->db->query("update tbl_product_stock set quantity=quantity-'$qty' where Product_id='$main_id'");
			
		}else{
			  								
				$comp_id = $this->session->userdata('comp_id');
				$divn_id = $this->session->userdata('divn_id');
				$zone_id = $this->session->userdata('zone_id');
				$brnh_id = $this->session->userdata('brnh_id');
				$maker_date= date('y-m-d');
				$author_date= date('y-m-d');
											
				$this->db->query("insert into tbl_product_serial set size='$sizent',quantity='$qtynt',location_id='$location_id',product_id='$main_id',comp_id='$comp_id',divn_id='$divn_id',zone_id='$zone_id',brnh_id='$brnh_id',maker_date='$maker_date',author_date='$author_date'");
					
		}
	 
	//echo   $sumqtynt; 
	$this->db->query("update tbl_product_stock set quantity=quantity-'$qty' where Product_id='$main_id'");
	
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

public function getproduct()
{
	if($this->session->userdata('is_logged_in'))
	{
		$this->load->view('getproduct');
	}
	else
	{
		redirect('index');
	}
}

	
public function all_product_function()
{
	$this->load->view('all-product',$data);
}

public function viewSalesOrder()
{
	if($this->session->userdata('is_logged_in'))
	{
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

function delete_updata_stock($qty,$main_id)
{
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

		 $selectQuery = "select * from tbl_product_serial where product_id='$product_id[$i]' and main_location_id='$main_loc[$i]' and location_id='$location_id[$i]' and rack_id='$rack_id[$i]'";
		$selectQuery1=$this->db->query($selectQuery);

		 $num= $selectQuery1->num_rows();

		if($num >0)

		{	

		$secode=$product_id[$i]."_".$location_id1;
	
$this->db->query("update tbl_product_serial set quantity =quantity+$new_quantity[$i] where product_id='".$product_id[$i]."' and location_id='".$location_id[$i]."' and rack_id='$rack_id[$i]' and main_location_id='$main_loc[$i]'");

$p_Q=$this->db->query("update tbl_product_stock set quantity =quantity+$new_quantity[$i] where Product_id='".$product_id[$i]."' ");

 $sqlProdLoc1="insert into tbl_product_serial_log set quantity ='$new_quantity[$i]',location_id='$location_id[$i]',rack_id='$rack_id[$i]',type='$type',product_id='$product_id[$i]',main_location_id='$main_loc[$i]',inbound_id='$inbound_id', maker_date='".date('Y-m-d')."', author_date=now(), author_id='".$this->session->userdata('user_id')."', maker_id='".$this->session->userdata('user_id')."', divn_id='".$this->session->userdata('divn_id')."', comp_id='".$this->session->userdata('comp_id')."', zone_id='".$this->session->userdata('zone_id')."', brnh_id='".$this->session->userdata('brnh_id')."' ";
$this->db->query($sqlProdLoc1);



 		}else{
			$sqlProdLoc2="insert into tbl_product_serial set product_id='$product_id[$i]',serial_number='$serialno', quantity ='$new_quantity[$i]', location_id='$location_id[$i]',rack_id='$rack_id[$i]',main_location_id='$main_loc[$i]', maker_date=NOW(), author_date=now(), author_id='".$this->session->userdata('user_id')."', maker_id='".$this->session->userdata('user_id')."', divn_id='".$this->session->userdata('divn_id')."', comp_id='".$this->session->userdata('comp_id')."', zone_id='".$this->session->userdata('zone_id')."', brnh_id='".$this->session->userdata('brnh_id')."'"; 
$this->db->query($sqlProdLoc2);

 $this->db->query("update tbl_product_stock set quantity =quantity+$new_quantity[$i] where Product_id='".$product_id[$i]."' ");

 
$sqlProdLoc1="insert into tbl_product_serial_log set quantity ='$new_quantity[$i]',location_id='$location_id[$i]',main_location_id='$main_loc[$i]',rack_id='$rack_id[$i]',type='$type',product_id='$product_id[$i]', maker_date='".date('Y-m-d')."', author_date=now(), author_id='".$this->session->userdata('user_id')."',inbound_id='$inbound_id', maker_id='".$this->session->userdata('user_id')."', divn_id='".$this->session->userdata('divn_id')."', comp_id='".$this->session->userdata('comp_id')."', zone_id='".$this->session->userdata('zone_id')."', brnh_id='".$this->session->userdata('brnh_id')."' ";
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



//===================================Demo Return================

public function export_demo_return()
{
	if($this->session->userdata('is_logged_in'))
	{
		$this->load->view('export-demo-return');
	}
	else
	{
		redirect('index');
	}
}

public function demo_return()
 {
 
 	if($this->session->userdata('is_logged_in'))
	{
		$data = $this->Demo_Return_Data();
		$this->load->view('demo-return',$data);
	}
	else
	{
		redirect('index');
	}		
 }

public function Demo_Return_Data(){

     	$table_name='tbl_return_hdr';
     	$data['result'] = "";
	    //$url   = site_url('/salesDemoReturn/demo_return?');
	    $sgmnt = "4";
	    
		if($_GET['entries'] != '')
		 {
			$showEntries = $_GET['entries'];
		 }
		 else
		 {
			$showEntries =10;
         }
		
		 $totalData   = $this->model_returndemo->count_demo_return($table_name,'A',$this->input->get());
        
         if($_GET['entries'] != "" && $_GET['filter'] != "filter")
		  {
           //$showEntries = $_GET['entries'];
           $url   = site_url('/salesDemoReturn/demo_return?entries='.$_GET['entries']);
          }
		  elseif($_GET['filter'] == 'filter' || $_GET['entries'] != '')
		  {
			 $url   = site_url('/salesDemoReturn/demo_return?rgp_gatepass_no='.$_GET['rgp_gatepass_no'].'&manual_gate_pass_no='.$_GET['manual_gate_pass_no'].'&responsibility='.$_GET['responsibility'].'&gatepass_issued_name='.$_GET['gatepass_issued_name'].'&f_date='.$_GET['f_date'].'&t_date='.$_GET['t_date'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
		  
		  }
		  else
		  {
		    $url   = site_url('/salesDemoReturn/demo_return?');
		  }
       
		 $pagination = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
         $data=$this->user_function();
     	
		 $data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
		 $data['pagination'] = $this->pagination->create_links();
	
		 if($this->input->get('filter') == 'filter') 
        	$data['result'] = $this->model_returndemo->filterDemoReturnData($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_returndemo->get_demo_return_data($pagination['per_page'],$pagination['page']);

     return $data;


}
 
//=======================================End===================

public function get_rack()
{
	if($this->session->userdata('is_logged_in'))
	{
		$data=array(
		'loc' => $_GET['loc'],
		'rack_id' => $_GET['rack_id'],
		'main_loc' => $_GET['main_loc']
		);
		//$data['$loc']=$_GET["proPall"];
		$this->load->view('get-rack',$data);
	}
	else
	{
		redirect('index');
	}		
}	



public function get_rack_qty()
{
	if($this->session->userdata('is_logged_in'))
	{
		
		$data=array(
		'loc' => $_GET['loc'],
		'rack_id' => $_GET['rack_id'],
		'main_loc' => $_GET['main_loc']
		);
	
	$queryCnt=$this->db->query("select SUM(quantity) as qnt from tbl_product_serial where rack_id='".$_GET['rack_id']."' and main_location_id='".$_GET['main_loc']."' and location_id='".$_GET['loc']."' and product_id='".$_GET['pri_id']."'  ");
	$cnt=$queryCnt->row();
	echo $cnt->qnt;
	
	}
	else
	{
		redirect('index');
	}		
}



public function getPalletQty()
{

$qtySerial=$this->db->query("select * from tbl_product_serial where main_location_id='".$_GET['main_loc']."' and location_id='".$_GET['loc']."' and product_id='".$_GET['pri_id']."'");
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

public function send_res_mail()
{
	@extract($_POST);



	$iddd=$_GET['id'];
	$this->load->library('email');
	$this->email->initialize(array(
			'protocol' => 'smtp',
			'smtp_host' => '103.211.216.225',
			'smtp_user' => 'info@techvyaserp.in',
			'smtp_pass' => 'info@123#',
			'smtp_port' => 587,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'wordwrap' => TRUE
		));
		
		
		$data = array(
			 'id' => $_GET['id']
			 );
		
		$this->email->from('info@techvyaserp.in');
		$this->email->to('prahladhsingh.in@gmail.com');
		$this->email->to('RAGHUVENDERA.YADAV.EXT@GEODIS.COM');
		$this->email->cc('collestbablu@gmail.com');
		$this->email->subject('Mail');
		$template=$this->load->view('email', $data, true);
		$this->email->message($template);
		if($this->email->send()) {
			
			
			$this->db->query("update tbl_return_hdr set mail_send_status='Mail Sent' where returnid='".$_GET['id']."'");
		 echo "<script type='text/javascript'>";
					//echo "window.close();";
					
					echo "alert('Mail send sucessfully');";
					echo "window.location.href='manageDemoOutbound'";
					//echo "window.opener.location.reload();";
					echo "</script>";
			
		} 
	
}


public function test_m()
{
	echo "hi";	
}



public function print_gatepass()
{
	$this->load->view("print-gatepass");
}





public function getCity_fun()
{
	if($this->session->userdata('is_logged_in'))
	{
		$data=array(
		'id' => $_GET['con'] 
		);
		$this->load->view('get_city',$data);
	}
	else
	{
		redirect('index');
	}
	
}


public function send_remainder_mail_()
{
	@extract($_POST);



	//$iddd=$_GET['id'];
	$this->load->library('email');
	$this->email->initialize(array(
			'protocol' => 'smtp',
			'smtp_host' => '103.211.216.225',
			'smtp_user' => 'info@techvyaserp.in',
			'smtp_pass' => 'info@12345##',
			'smtp_port' => 587,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'wordwrap' => TRUE
		));	
		/*$data = array(
			 'id' => $_GET['id']
			 );*/
		
		$remQuery=$this->db->query("select *from tbl_contact_m where group_name='6' and status='A'");
		foreach($remQuery->result() as $getResult){
//	$resultstr[]=$getResult->contact_id;
	
			//$idd=implode(",",$resultstr);
			//$data=array(
			//'id' => $idd
			//);
			
			$data=array(
			'id' => $getResult->contact_id
			);
			//$email_id=$getResult->email_id;
		$this->email->from('info@techvyaserp.in');
		//$this->email->to('prahladhsingh.in@gmail.com');
		$this->email->to('prahalad.singh.ext@geodis.com');
		$this->email->to('jatin.chopra@sennheiser.com');

		//$this->email->to($getResult->email);
		//$this->email->to('bablukkhan@gmail.com');
		
		$this->email->cc('raghuvendera.yadav.ext@geodis.com');
		$this->email->bcc('collestbablu@gmail.com');
		
		$this->email->subject('Mail');
		$template=$this->load->view('email-remainder', $data, true);
		$this->email->message($template);
		
		if($this->email->send())
		{
			
		echo "dd";	
			
		}
		
		}
		/*
		
			$this->db->query("update tbl_return_hdr set mail_send_status='Mail Sent' where returnid='".$_GET['id']."'");
		 echo "<script type='text/javascript'>";
					//echo "window.close();";
					
					echo "alert('Mail send sucessfully');";
					echo "window.location.href='manageDemoOutbound'";
					//echo "window.opener.location.reload();";
					echo "</script>";
			
		} 
	
		}*/

}


public function send_remainder_mail_cli()

{

	@extract($_POST);







	//$iddd=$_GET['id'];

	$this->load->library('email');

	$this->email->initialize(array(

			'protocol' => 'smtp',

			'smtp_host' => '103.211.216.225',

			'smtp_user' => 'info@techvyaserp.in',

			'smtp_pass' => 'info@12345##',

			'smtp_port' => 587,

			'mailtype' => 'html',

			'charset' => 'utf-8',

			'wordwrap' => TRUE

		));	

		/*$data = array(

			 'id' => $_GET['id']

			 );*/

		

		$remQuery=$this->db->query("select *from tbl_contact_m where group_name='6' and status='A'");

		foreach($remQuery->result() as $getResult){

//	$resultstr[]=$getResult->contact_id;

	

			//$idd=implode(",",$resultstr);

			//$data=array(

			//'id' => $idd

			//);

			

			$data=array(

			'id' => $getResult->contact_id

			);

			//$email_id=$getResult->email_id;

		$this->email->from('info@techvyaserp.in');

		//$this->email->to('prahladhsingh.in@gmail.com');

		//$this->email->to('prahalad.singh.ext@geodis.com');



		//$this->email->to($getResult->email);

		//$this->email->to('bablukkhan@gmail.com');

		

		//$this->email->cc('raghuvendera.yadav.ext@geodis.com');

	

//echo "select * from tbl_return_hdr where responsibility='$id'";

$inviceQ1=$this->db->query("select * from tbl_return_hdr where responsibility='$getResult->contact_id'");

foreach($inviceQ1->result() as $getQ)

{

$resultstr[]=$getQ->returnid;

}



@$hdrridd=implode(",",$resultstr);

if($hdrridd!=''){

$hdrrid=$hdrridd;

}

else{

$hdrrid='0';

}



$inviceQ=$this->db->query("select * from tbl_return_dtl where returnhdr in ($hdrrid)");

foreach($inviceQ->result() as $invoiceFetch){



$productQ=$this->db->query("select *from tbl_product_stock where Product_id='$invoiceFetch->product_id'");



$pfetch=$productQ->row();





$hdrQuery=$this->db->query("select *from tbl_return_hdr where returnid='$invoiceFetch->returnhdr'");



$hdrFetch=$hdrQuery->row();





@extract($invoiceFetch);



//this query for geting usage unit form tbl_master_data



$productQ1=$this->db->query("select *from tbl_master_data where serial_number ='$pfetch->usageunit'");



$pfetch1=$productQ1->row();







$getLog = $this->db->query("Select product_id,inbound_id,type from tbl_product_serial_log where type = 'Demo Return' and product_id='$invoiceFetch->product_id' and inbound_id='$invoiceFetch->returnhdr' ");

$logdata = $getLog->row();



if(@$logdata->product_id = @$invoiceFetch->product_id && @$logdata->inbound_id = @$invoiceFetch->returnhdr) 

{

	echo "hi";

}

else{


	$this->email->to('jatin.chopra@sennheiser.com');

	$this->email->cc('raghuvendera.yadav.ext@geodis.com');

	$this->email->bcc('collestbablu@gmail.com');

		

		$this->email->subject('Mail');

		$template=$this->load->view('email-remainder', $data, true);

		$this->email->message($template);

		if($this->email->send())

		{

			

		echo "dd";	

			

		}

	}	

		}

		

		}

		/*

		

			$this->db->query("update tbl_return_hdr set mail_send_status='Mail Sent' where returnid='".$_GET['id']."'");

		 echo "<script type='text/javascript'>";

					//echo "window.close();";

					

					echo "alert('Mail send sucessfully');";

					echo "window.location.href='manageDemoOutbound'";

					//echo "window.opener.location.reload();";

					echo "</script>";

			

		} 

	

		}*/



}





public function send_remainder_mail()
{
	@extract($_POST);



	//$iddd=$_GET['id'];
	$this->load->library('email');
	$this->email->initialize(array(
			'protocol' => 'smtp',
			'smtp_host' => '103.211.216.225',
			'smtp_user' => 'info@techvyaserp.in',
			'smtp_pass' => 'info@12345##',
			'smtp_port' => 587,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'wordwrap' => TRUE
		));	
		/*$data = array(
			 'id' => $_GET['id']
			 );*/
		
		$remQuery=$this->db->query("select *from tbl_contact_m where group_name='6' and status='A'");
		foreach($remQuery->result() as $getResult){

			
			$data=array(
			'id' => $getResult->contact_id
			);
			//$email_id=$getResult->email_id;
		$this->email->from('info@techvyaserp.in');
		//$this->email->to('prahladhsingh.in@gmail.com');
		//$this->email->to('prahalad.singh.ext@geodis.com');

		//$this->email->to($getResult->email);
		//$this->email->to('bablukkhan@gmail.com');
		
		//$this->email->cc('raghuvendera.yadav.ext@geodis.com');
	

	//send mail
		//echo "select *from tbl_return_hdr where responsibility='$getResult->contact_id' ";
	$sendMailQ=$this->db->query("select *from tbl_return_hdr where responsibility='$getResult->contact_id' ");
$cntContact=$sendMailQ->row();

if($cntContact->responsibility==$getResult->contact_id){

	$emailId=$getResult->email;
	$this->email->to($emailId);
	//$this->email->to('jatin.chopra@sennheiser.com');
	$this->email->cc('raghuvendera.yadav.ext@geodis.com,jatin.chopra@sennheiser.com');
	$this->email->bcc('collestbablu@gmail.com');
		
		$this->email->subject('Mail');
		$template=$this->load->view('email-remainder', $data, true);
		$this->email->message($template);
		$this->email->send();
		
		}
}
}










public function mail_champ()
{

 $email = 'gaurav.taneja1801@gmail.com';
//$list_id = 'LIST_ID';
$api_key = 'e4b2e2d3726aeff78514a2f18df5d606cd11098a6ac6263476';
 
$data_center = substr($api_key,strpos($api_key,'-')+1);
 
$url = 'https://'. $data_center .'.api.mailchimp.com/3.0/lists/'. $LIST_ID .'/members';
 
$json = json_encode([
    'email_address' => $email,
    'status'        => 'subscribed', //pass 'subscribed' or 'pending'
]);
 
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
$result = curl_exec($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo $status_code;
print_r(json_decode($result));
}


public function send_remainder_mail_clii()
{
	@extract($_POST);



	//$iddd=$_GET['id'];
	$this->load->library('email');
	$this->email->initialize(array(
			'protocol' => 'smtp',
			'smtp_host' => '103.211.216.225',
			'smtp_user' => 'info@techvyaserp.in',
			'smtp_pass' => 'info@12345##',
			'smtp_port' => 587,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'wordwrap' => TRUE
		));	
		/*$data = array(
			 'id' => $_GET['id']
			 );*/
		
		$remQuery=$this->db->query("select *from tbl_contact_m where group_name='6' and status='A'");
		foreach($remQuery->result() as $getResult){

			
			$data=array(
			'id' => $getResult->contact_id
			);
			//$email_id=$getResult->email_id;
		$this->email->from('info@techvyaserp.in');
		//$this->email->to('prahladhsingh.in@gmail.com');
		//$this->email->to('prahalad.singh.ext@geodis.com');

		//$this->email->to($getResult->email);
		//$this->email->to('bablukkhan@gmail.com');
		
		//$this->email->cc('raghuvendera.yadav.ext@geodis.com');
	

	//send mail
	$sendMailQ=$this->db->query("select *from tbl_contact_m where contact_id='$hdrFetch->responsibility' and status='A'");
$getSendMail=$sendMailQ->row();
	$this->email->to($getResult->email);
	$this->email->cc('raghuvendera.yadav.ext@geodis.com');
	$this->email->bcc('collestbablu@gmail.com');

		
		$this->email->subject('Mail');
		$template=$this->load->view('email-remainder', $data, true);
		$this->email->message($template);
		
		
		if($this->email->send())
		{
			
		echo "dd";	
			
		}
		}

}		
}