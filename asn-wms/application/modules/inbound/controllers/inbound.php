<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);

class inbound extends my_controller {

function __construct()
{
   parent::__construct();
   $this->load->model('model_salesorder');
   $this->load->model('model_warehouse');
   $this->load->library('pagination');

}     

public function addInbound()
{
	if($this->session->userdata('is_logged_in'))
	{
		$this->load->view('add-pre-order');
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


public function manageInbound()
{
	if($this->session->userdata('is_logged_in'))
	{
		$data=$this->user_function();// call permission fnctn
		$data = $this->Join_PreAlert_Data();
		$this->load->view('manage-inbound',$data);
	}
	else
	{
		redirect('index');
	}	
}

function Join_PreAlert_Data()
{

     	$table_name='tbl_stock_in_hdr';
     	$data['result'] = "";
	    $sgmnt = "4";
	    
		if($_GET['entries']!="")
		  {
			  $showEntries = $_GET['entries'];
		  }
		 else
		  {
			  $showEntries =10;
		  }
        
		$totalData   = $this->model_salesorder->count_preAlert($table_name,'A',$this->input->get());
        
		if($_GET['entries']!="" && $_GET['filter']!='filter')
	     {
	       $url   = site_url('/inbound/manageInbound?entries='.$_GET['entries']);
	     }
	     elseif($_GET['filter']=='filter' || $_GET['entries'] != '')
	     {
	       $url = site_url('/inbound/manageInbound?stockinid='.$_GET['stockinid'].'&hawb='.$_GET['hawb'].'&mawb_no='.$_GET['mawb_no'].'&origin='.$_GET['origin'].'&destination='.$_GET['destination'].'&HAWB_booking_date='.$_GET['HAWB_booking_date'].'&port_of_loading='.$_GET['port_of_loading'].'&pre_alert_date='.$_GET['pre_alert_date'].'&eta_date='.$_GET['eta_date'].'&status='.$_GET['status'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
		 }
	     else
	     {
	       $url   = site_url('/inbound/manageInbound?');
	     }
		 
         $pagination = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
         $data=$this->user_function();
     	 
		 $data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
		 $data['pagination'] = $this->pagination->create_links();
	
		 if($this->input->get('filter') == 'filter') 
        	$data['result'] = $this->model_salesorder->filterPreAlert($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_salesorder->getPreAlert($pagination['per_page'],$pagination['page']);

   	return $data;

}


public function export_prealert()
{
	if($this->session->userdata('is_logged_in'))
	{
		$this->load->view('export-pre-alert');
	}
	else
	{
		redirect('index');
	}
}

public function manage_warehouse_transfer()
{
	if($this->session->userdata('is_logged_in'))
	{
		$data=$this->user_function();// call permission fnctn
		$data['result'] = $this->model_warehouse->out_data();
		$this->load->view('manage-warehouse-transfer',$data);
	}
	else
	{
		redirect('index');
	}	
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





public function edit_Inbound()
{
	if($this->session->userdata('is_logged_in'))
	{
		$this->load->view('edit-pre-order');
	}
	else
	{
		redirect('index');
	}		
}

	

public function insertStockIn()
{
		
		extract($_POST);
		$table_name ='tbl_stock_in_hdr';
		$table_name_dtl ='tbl_stock_in_dtl';
		$pri_col ='stockinid';
		$pri_col_dtl ='stockinhdr';
		
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
					'order_no' => $this->input->post('order_no'),
					'order_date' => $this->input->post('order_date'),
					'booking_code' => $this->input->post('booking_code'),
					'supplier_id' => $this->input->post('supplier_id'),
					'invoice_date' => $this->input->post('invoice_date'),
					'sub_total' => $this->input->post('sub_total'),
					'service_charge_per' => $this->input->post('service_charge_per'),
					'service_charge_total' => $this->input->post('service_charge_total'),
					'gross_discount_per' => $this->input->post('gross_discount_per'),
					'gross_discount_total' => $this->input->post('gross_discount_total'),
					
					
					
					'grand_total' => $this->input->post('grand_total'),
					'invoice_no' => $this->input->post('invoice_no'),
					'destination' => $this->input->post('destination'),
					'HAWB_booking_date' => $this->input->post('HAWB_booking_date'),
					'port_of_loading' => $this->input->post('port_of_loading'),
					'eta_date' => $this->input->post('eta_date'),
					'mawb_no' => $this->input->post('mawb_no'),
					'hawb' => $this->input->post('hawb'),
					'pallet' => $this->input->post('pallet'),
					
					'origin' => $this->input->post('origin'),
					'booking_type' => $this->input->post('booking_type'),
					'priority' => $this->input->post('priority'),
					'pre_alert_date' => $this->input->post('pre_alert_date'),
					'gross_weight' => $this->input->post('gross_weight'),
					'ata_date' => $this->input->post('ata_date'),
					
					
					'status' => $status
					
					
					);
			
			$data_merge = array_merge($data,$sess);					
		    $this->load->model('Model_admin_login');	
		    $this->Model_admin_login->insert_user($table_name,$data_merge);
			$lastHdrId=$this->db->insert_id();		
			$this->load->model('Model_admin_login');
		
		for($i=0; $i<=$rows; $i++)
				{
				 				
			    
				
				
				if($qty[$i]!=''){

				 $data_dtl['stockinhdr']= $lastHdrId;
				 $data_dtl['product_id']=$this->input->post('main_id')[$i];				 
				 $data_dtl['list_price']=$this->input->post('list_price')[$i];
				 $data_dtl['quantity']=$this->input->post('qty')[$i];
				 $data_dtl['discount']=$this->input->post('discount')[$i];
				 $data_dtl['discount_amount']=$this->input->post('disAmount')[$i];
				 $data_dtl['int_tariff']=$this->input->post('int_tariff')[$i];
				
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
				
			 $rediectInvoice="inbound/manageInbound";
		redirect($rediectInvoice);	
	   
}

public function updateTermAndCondition($lastHdrId,$vendor_id,$grand_total,$date)
{
	$contactQuey=$this->db->query("select *from tbl_contact_m where contact_id='$vendor_id'");
	$getContact=$contactQuey->row();
	
	
	$termandcondition=" 	
<p>&nbsp;</p>
<div style='font-family: 'Times New Roman'; font-size: medium; background: #fbfbfb;'>
<div style='padding: 25.6094px; text-align: center; background: #4190f2;'>
<div style='color: #ffffff; font-size: 20px;'>Invoice # $lastHdrId</div>
</div>
<div style='max-width: 560px; margin: auto; padding: 0px 25.6094px;'>
<div style='padding: 30px 0px; color: #555555; line-height: 1.7;'>Dear $getContact->first_name,&nbsp;<br /><br />Your invoice $lastHdrId is attached.

Thank you for your business.&nbsp;</div>
<br />
<div style='padding: 16.7969px 0px; line-height: 1.6;'>Thanks & Regards
<div style='color: #8c8c8c;'>Gaurav Taneja</div>
<div style='color: #b1b1b1;'>Tech Vyas Solutions Pvt Ltd.</div>
<div style='color: #b1b1b1;'>9990455812</div>
</div>
</div>
</div>
<p>&nbsp;</p>";		
$this->db->query("update tbl_sales_order_hdr set termandcondition='".addslashes($termandcondition)."' where salesid='$lastHdrId'");

	}
	
public function updateInbound()
{
		
		extract($_POST);
		$table_name ='tbl_stock_in_hdr';
		$table_name_dtl ='tbl_stock_in_dtl';
		$pri_col ='stockinid';
		$pri_col_dtl ='stockdtlid';
		
		
 		//$this->refil_qnty_del($id);

		 $this->db->query("delete from $table_name_dtl where stockinhdr='$id'");	
				
				
				
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
					'order_no' => $this->input->post('order_no'),
					'order_date' => $this->input->post('order_date'),
					'booking_code' => $this->input->post('booking_code'),
					'supplier_id' => $this->input->post('supplier_id'),
					'invoice_date' => $this->input->post('invoice_date'),
					'sub_total' => $this->input->post('sub_total'),
					'service_charge_per' => $this->input->post('service_charge_per'),
					'service_charge_total' => $this->input->post('service_charge_total'),
					'gross_discount_per' => $this->input->post('gross_discount_per'),
					'gross_discount_total' => $this->input->post('gross_discount_total'),
					'pallet' => $this->input->post('pallet'),
					'currency' => $this->input->post('currency'),
					
					'grand_total' => $this->input->post('grand_total'),
					'invoice_no' => $this->input->post('invoice_no'),
					'destination' => $this->input->post('destination'),
					'HAWB_booking_date' => $this->input->post('HAWB_booking_date'),
					'port_of_loading' => $this->input->post('port_of_loading'),
					'eta_date' => $this->input->post('eta_date'),
					'mawb_no' => $this->input->post('mawb_no'),
					'hawb' => $this->input->post('hawb'),
					
					'origin' => $this->input->post('origin'),
					'booking_type' => $this->input->post('booking_type'),
					'priority' => $this->input->post('priority'),
					'pre_alert_date' => $this->input->post('pre_alert_date'),
					'gross_weight' => $this->input->post('gross_weight'),
					'ata_date' => $this->input->post('ata_date'),
					
					'duty_amount' => $this->input->post('duty_amount'),
					'igst_amount' => $this->input->post('igst_amount'),
					'gate_entry' => $this->input->post('gate_entry'),
					'ge_date' => $this->input->post('ge_date'),
					'ge_time' => $this->input->post('ge_time'),
					'vehicle_number' => $this->input->post('vehicle_number'),
					'unloading_date' => $this->input->post('unloading_date'),
					'unloading_time' => $this->input->post('unloading_time'),
					'date_of_receipt_at_warehose' => $this->input->post('date_of_receipt_at_warehose'),
					'international_tat' => $this->input->post('international_tat'),
					'lead_time_from_ata' => $this->input->post('lead_time_from_ata'),
					'lead_time_from_hawb' => $this->input->post('lead_time_from_hawb'),
					'receipt_of_month' => $this->input->post('receipt_of_month'),
					'control_no' => $this->input->post('control_no'),
					'mrn_date' => $this->input->post('mrn_date'),
					'mrn_sent_time' => $this->input->post('mrn_sent_time'),
					'pkg' => $this->input->post('pkg'),
					'grn_no' => $this->input->post('grn_no'),
					'grn_date' => $this->input->post('grn_date'),
					'no_of_days' => $this->input->post('no_of_days'),
					
					'boe_no' => $this->input->post('boe_no'),
					'boe_date' => $this->input->post('boe_date'),
					'exchange_rate' => $this->input->post('exchange_rate'),
					'status' => $status
					
					
					);

			
			$data_merge = array_merge($data,$sess);					
		   
			$this->load->model('Model_admin_login');	
		$this->Model_admin_login->update_user($pri_col,$table_name,$id,$data_merge);

		
		for($i=0; $i<=$rows; $i++)
				{
				 				
			    
			
				
				if($qty[$i]!=''){

				 $data_dtl['stockinhdr']= $id;
				 $data_dtl['product_id']=$this->input->post('main_id')[$i];				 
				 $data_dtl['list_price']=$this->input->post('list_price')[$i];
				 $data_dtl['hsn_code']=$this->input->post('hsn_code')[$i];
				  $data_dtl['tariff_no']=$this->input->post('tariff_no')[$i];
				  
				  $data_dtl['grn_no']=$this->input->post('grn_noo')[$i];
				  $data_dtl['grn_date']=$this->input->post('grn_datee')[$i];
				  $data_dtl['no_of_days']=$this->input->post('no_of_dayss')[$i];
				  
				  $data_dtl['int_tariff']=$this->input->post('doms_tariff_no')[$i];
				  
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
	
function refil_qnty_del($id)
{
	
	$data= $this->db->query("select * from tbl_sales_order_dtl where salesid='$id'");
	foreach($data->result() as $update)
	{
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
	
	
function updata_stock($qty,$main_id,$sizeval)
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
	

public function paymentAmount($grand_total,$vendor_id,$lastHdrId,$id)
{
	
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



function deleteSalesOrder()
{
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

public function insertstockreff()
{


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

 $sqlProdLoc1="insert into tbl_product_serial_log set quantity ='$new_quantity[$i]',location_id='$location_id[$i]',rack_id='$rack_id[$i]',type='$type[$i]',product_id='$product_id[$i]',main_location_id='$main_loc[$i]',inbound_id='$inbound_id', maker_date='".date('Y-m-d')."', author_date=now(), author_id='".$this->session->userdata('user_id')."', maker_id='".$this->session->userdata('user_id')."', divn_id='".$this->session->userdata('divn_id')."', comp_id='".$this->session->userdata('comp_id')."', zone_id='".$this->session->userdata('zone_id')."', brnh_id='".$this->session->userdata('brnh_id')."' ";
$this->db->query($sqlProdLoc1);



 		}else{
			$sqlProdLoc2="insert into tbl_product_serial set product_id='$product_id[$i]',serial_number='$serialno', quantity ='$new_quantity[$i]', location_id='$location_id[$i]',rack_id='$rack_id[$i]',main_location_id='$main_loc[$i]', maker_date='".date('Y-m-d')."', author_date=now(), author_id='".$this->session->userdata('user_id')."', maker_id='".$this->session->userdata('user_id')."', divn_id='".$this->session->userdata('divn_id')."', comp_id='".$this->session->userdata('comp_id')."', zone_id='".$this->session->userdata('zone_id')."', brnh_id='".$this->session->userdata('brnh_id')."'"; 
$this->db->query($sqlProdLoc2);

 $this->db->query("update tbl_product_stock set quantity =quantity+$new_quantity[$i] where Product_id='".$product_id[$i]."' ");

 
$sqlProdLoc1="insert into tbl_product_serial_log set quantity ='$new_quantity[$i]',location_id='$location_id[$i]',main_location_id='$main_loc[$i]',rack_id='$rack_id[$i]',type='$type[$i]',product_id='$product_id[$i]', maker_date=NOW(), author_date=now(), author_id='".$this->session->userdata('user_id')."',inbound_id='$inbound_id', maker_id='".$this->session->userdata('user_id')."', divn_id='".$this->session->userdata('divn_id')."', comp_id='".$this->session->userdata('comp_id')."', zone_id='".$this->session->userdata('zone_id')."', brnh_id='".$this->session->userdata('brnh_id')."' ";
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
	
	
	
public function print_mrp()
{
	$data=array(
	'id' => $_GET['id']
	);
	
$this->load->view('mrn-print',$data);	
	
}

public function add_multi_invoice()
{
	$this->load->view('add-multi-invoice');	
	
}








public function insertMultipleInv(){
		
		extract($_POST);
		$table_name ='tbl_stock_in_inv_hdr';
		$table_name_dtl ='tbl_stock_in_inv_hdr';
		$pri_col ='stockinid';
		$pri_col_dtl ='stockinhdr';
		if($rows=='')
		{
			$getRows=$rows11;
		}
		else
		{
			$getRows=$rows;
		}
		
		//$this->db->query("delete from $table_name_dtl where stockinhdr='$id'");
		for($i=0; $i<$getRows; $i++)
				{
				 				
			    
				
				
				if($qty[$i]!=''){

				 $data_dtl['stockinhdr']= $id;
				 $data_dtl['inv_no']= $inv_no;
				  $data_dtl['inc_id']= $inc_id;
				 $data_dtl['order_no']= $order_no;
				 $data_dtl['inv_date']= $inv_date;
				 $data_dtl['grn_no']= $grn_no;
				 $data_dtl['grn_date']= $grn_date;
				 $data_dtl['product_id']=$this->input->post('main_id')[$i];				 
				 $data_dtl['list_price']=$this->input->post('list_price')[$i];
				 $data_dtl['quantity']=$this->input->post('qty')[$i];
				 $data_dtl['discount']=$this->input->post('discount')[$i];
				 $data_dtl['discount_amount']=$this->input->post('disAmount')[$i];
				 $data_dtl['int_tariff']=$this->input->post('int_tariff')[$i];
				 $data_dtl['total']=$this->input->post('tot')[$i];
				 $data_dtl['net_price']=$this->input->post('nettot')[$i];
				 
				 
				
				 $data_dtl['maker_id']=$this->session->userdata('user_id');
				 $data_dtl['maker_date']=date('y-m-d');
				 $data_dtl['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl['brnh_id']=$this->session->userdata('brnh_id');
				
				
				
				
				//$this->stock_refill_qty($qty[$i],$main_id[$i],$sizeval[$i]);
				
				
				$this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);
				//$this->Model_admin_login->insert_user($table_name,$data_dtl);		
							}
					}
				//$this->paymentAmount($grand_total,$vendor_id,$lastHdrId,$id);	
			//$this->paymentAmount($grand_total,$vendor_id,$lastHdrId,$id);	
			//$this->updateTermAndCondition($lastHdrId,$vendor_id,$grand_total,$date);
				//$this->software_log_insert($lastHdrId,$vendor_id,$grand_total,'Sales Order added');
				
	
  echo "<script type='text/javascript'>";
					echo "window.close();";
					echo "window.opener.location.reload();";
					echo "</script>";	   
					
	
	}



public function updateMultipleInv(){
		
		extract($_POST);
		$table_name ='tbl_stock_in_inv_hdr';
		$table_name_dtl ='tbl_stock_in_inv_hdr';
		$pri_col ='stockinhdr';
		$pri_col_dtl ='stockinhdr';
		$cnt=count($nettot);
		$this->db->query("delete from tbl_stock_in_inv_hdr where stockinhdr='$id' and inc_id='$inc_id' ");
		
		for($i=0; $i<$cnt; $i++)
				{
				//if($qty[$i]!=''){

				 $data_dtl['stockinhdr']= $id;
				 $data_dtl['inv_no']= $inv_no;
				  $data_dtl['inc_id']= $inc_id;
				 $data_dtl['order_no']= $order_no;
				 $data_dtl['inv_date']= $inv_date;
				 $data_dtl['grn_no']= $grn_no[$i];
				 $data_dtl['grn_date']= $grn_date[$i];
				 $data_dtl['product_id']=$this->input->post('main_id')[$i];				 
				 $data_dtl['list_price']=$this->input->post('list_price')[$i];
				 $data_dtl['quantity']=$this->input->post('qty')[$i];
				 $data_dtl['discount']=$this->input->post('discount')[$i];
				 $data_dtl['discount_amount']=$this->input->post('disAmount')[$i];
				 $data_dtl['int_tariff']=$this->input->post('tariff_no')[$i];
				  $data_dtl['tariff_no']=$this->input->post('doms_tariff_no')[$i];
				 $data_dtl['total']=$this->input->post('tot')[$i];
				 $data_dtl['net_price']=$this->input->post('nettot')[$i];
				 $data_dtl['maker_id']=$this->session->userdata('user_id');
				 $data_dtl['maker_date']=date('y-m-d');
				 $data_dtl['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl['brnh_id']=$this->session->userdata('brnh_id');
				//$this->stock_refill_qty($qty[$i],$main_id[$i],$sizeval[$i]);
				//echo $this->input->post('qty')[$i]."<br>";
		//$id=$id[$i];		
		//echo $inv_no[$i]."<br>";
				//$this->Model_admin_login->update_user($pri_col,$table_name);
				$this->Model_admin_login->insert_user($table_name,$data_dtl);		
							//}
					}
				//$this->paymentAmount($grand_total,$vendor_id,$lastHdrId,$id);	
			//$this->paymentAmount($grand_total,$vendor_id,$lastHdrId,$id);	
			//$this->updateTermAndCondition($lastHdrId,$vendor_id,$grand_total,$date);
				//$this->software_log_insert($lastHdrId,$vendor_id,$grand_total,'Sales Order added');
				

  echo "<script type='text/javascript'>";
					echo "window.close();";
					echo "window.opener.location.reload();";
					echo "</script>";	   
					


	}



public function ViewInv()
{

$this->load->view('view-multi-inv');	
}


public function EditInv()
{

$this->load->view('edit-multiple-invoice');	
}

public function getPalletQty()
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



public function show_mul_inv()
{
	
if($this->session->userdata('is_logged_in')){
		$this->load->view('show-multi-inv');
	}
	else
	{
	redirect('index');
	}		
	
}

public function importShowFun()
{
	
if($this->session->userdata('is_logged_in')){
	

		$this->load->view('other_inbound/importShowProduct');
	}
	else
	{
	redirect('index');
	}		
	
}



public function stockInTransfer()
{
	
if($this->session->userdata('is_logged_in')){
	

		$this->load->view('inbound/stockInProductTransfer');
	}
	else
	{
	redirect('index');
	}		
	
}




}
?>