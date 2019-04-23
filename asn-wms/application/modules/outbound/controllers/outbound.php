<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class outbound extends my_controller {

function __construct()
{
   parent::__construct();
   $this->load->model('model_outbound');
   $this->load->library('pagination'); 
}     

public function addOutbound()
{
	if($this->session->userdata('is_logged_in'))
	{
		$this->load->view('add-outbound-order');
	}
	else
	{
		redirect('index');
	}		
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

public function export_outbound()
{
	if($this->session->userdata('is_logged_in'))
	{
		$this->load->view('export-outbound-data');
	}
	else
	{
		redirect('index');
	}
}
public function manageOutbound()
{
	if($this->session->userdata('is_logged_in'))
	{
		//$data=$this->user_function();// call permission fnctn
		//$data['result'] = $this->model_outbound->outbound_data();
		$data = $this->Manage_Outbond_Data();
		$this->load->view('manage-outbound',$data);
	}
	else
	{
		redirect('index');
	}	
}


function Manage_Outbond_Data()
{

     	$table_name='tbl_stock_out_hdr';
     	$data['result'] = "";
	    //$url   = site_url('/outbound/manageOutbound?');
	    $sgmnt = "4";
	    
		if($_GET['entries']!="")
		  {
			  $showEntries = $_GET['entries'];
		  }
		 else
		  {
			  $showEntries =10;
		  }
        
		$totalData   = $this->model_outbound->count_outbound($table_name,'A',$this->input->get());
        
		if($_GET['entries']!="" && $_GET['filter']!='filter')
	     {
	       $url   = site_url('/outbound/manageOutbound?entries='.$_GET['entries']);
	     }
	     elseif($_GET['filter']=='filter' || $_GET['entries'] != '')
	     {
	       $url = site_url('/outbound/manageOutbound?p_code='.$_GET['p_code'].'&date='.$_GET['date'].'&original_inv_rec_time='.$_GET['original_inv_rec_time'].'&customer='.$_GET['customer'].'&order_no='.$_GET['order_no'].'&invoice_no='.$_GET['invoice_no'].'&location='.$_GET['location'].'&type='.$_GET['type'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
		 }
	     else
	     {
	       $url   = site_url('/outbound/manageOutbound?');
	     }
		 
         $pagination = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
         $data=$this->user_function();
     	 
		 $data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
		 $data['pagination'] = $this->pagination->create_links();
	
		 if($this->input->get('filter') == 'filter')
        	$data['result'] = $this->model_outbound->filterOutbondData($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_outbound->get_outbond_data($pagination['per_page'],$pagination['page']);

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

public function edit_OutBound()
{
	if($this->session->userdata('is_logged_in'))
	{
		$this->load->view('edit-outbound-order');
	}
	else
	{
		redirect('index');
	}		
}

public function insertStockOut(){
		
		
		extract($_POST);
		$table_name ='tbl_stock_out_hdr';
		$table_name_dtl ='tbl_stock_out_dtl';
		$pri_col ='stockoutid';
		$pri_col_dtl ='stockouthdr';
		
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
					'responsibility' => $this->input->post('responsibility'),
					'original_inv_rec_time' => $this->input->post('original_inv_rec_time'),
					'contact_id' => $this->input->post('contact_id'),
					'type' => $this->input->post('type'),
					'order_no' => $this->input->post('order_no'),
					'invoice_date' => $this->input->post('invoice_date'),
					'invoice_no' => $this->input->post('invoice_no'),
					'invoice_amount' => $this->input->post('invoice_amount'),
					'location_to' => $this->input->post('location_to'),
					
					
					);
			
			$data_merge = array_merge($data,$sess);					
		    $this->load->model('Model_admin_login');	
		    $this->Model_admin_login->insert_user($table_name,$data_merge);
			$lastHdrId=$this->db->insert_id();		
			$this->load->model('Model_admin_login');
		
		for($i=0; $i<=$rows; $i++)
				{
				 				
			    
				
				
				if($qty[$i]!=''){

				 $data_dtl['stockouthdr']= $lastHdrId;
				 $data_dtl['product_id']=$this->input->post('main_id')[$i];
				 $data_dtl['main_loc']=$this->input->post('main_loc')[$i];
				 $data_dtl['loc']=$this->input->post('loc')[$i];
				 $data_dtl['rack_id']=$this->input->post('rack_id')[$i];
				 $data_dtl['hsn_code']=$this->input->post('hsn_code')[$i];				 
				 
				 $data_dtl['quantity']=$this->input->post('qty')[$i];
				 
				 $data_dtl['maker_id']=$this->session->userdata('user_id');
				 $data_dtl['maker_date']=date('y-m-d');
				 $data_dtl['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl['brnh_id']=$this->session->userdata('brnh_id');
				
				
				
				
				$productQty=$this->input->post('qty')[$i];
				$this->db->query("update tbl_product_serial set quantity=quantity-'$productQty' where product_id='".$main_id[$i]."' and main_location_id='".$main_loc[$i]."' and location_id='".$loc[$i]."' and rack_id='".$rack_id[$i]."'");
				
				$this->db->query("insert into  tbl_product_serial_log set quantity='$productQty', product_id='".$main_id[$i]."', main_location_id='".$main_loc[$i]."' ,location_id='".$loc[$i]."' , rack_id='".$rack_id[$i]."',type='Outbond',inbound_id='$lastHdrId',maker_date='".date('Y-m-d')."',comp_id='".$this->session->userdata('comp_id')."'");
				
				$this->db->query("update tbl_product_stock set quantity=quantity-'$productQty' where product_id='$main_id[$i]'");
				
				//$this->stock_refill_qty($qty[$i],$main_id[$i],$sizeval[$i]);
				
				
				
				$this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);		
							}
					}
				//$this->paymentAmount($grand_total,$vendor_id,$lastHdrId,$id);	
			//$this->paymentAmount($grand_total,$vendor_id,$lastHdrId,$id);	
			//$this->updateTermAndCondition($lastHdrId,$vendor_id,$grand_total,$date);
				//$this->software_log_insert($lastHdrId,$vendor_id,$grand_total,'Sales Order added');
				
	//$this->stock_refill_qty($qty[$i],$main_id[$i]);
				
			 $rediectInvoice="outbound/manageOutbound";
		redirect($rediectInvoice);	
	   
}

public function updateTermAndCondition($lastHdrId,$vendor_id,$grand_total,$date){

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
	
public function updateInbound(){
		
		extract($_POST);
		$table_name ='tbl_stock_out_hdr';
		$table_name_dtl ='tbl_stock_out_dtl';
		$pri_col ='stockoutid';
		$pri_col_dtl ='stockouthdr';

		 $this->refil_qnty_del($id);
		 $this->db->query("delete from $table_name_dtl where stockouthdr='$id'");	
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
					'responsibility' => $this->input->post('responsibility'),
					'original_inv_rec_time' => $this->input->post('original_inv_rec_time'),
					'contact_id' => $this->input->post('contact_id'),
					'type' => $this->input->post('type'),
					'order_no' => $this->input->post('order_no'),
					'invoice_date' => $this->input->post('invoice_date'),
					'invoice_no' => $this->input->post('invoice_no'),
					'invoice_amount' => $this->input->post('invoice_amount'),
					'location_to' => $this->input->post('location_to'),
		
					);
    	$data_merge = array_merge($data,$sess);					
		$this->load->model('Model_admin_login');	
		$this->Model_admin_login->update_user($pri_col,$table_name,$id,$data_merge);
		for($i=0; $i<=$rows; $i++)
				{
				if($qty[$i]!=''){

				 $data_dtl['stockouthdr']= $id;
				 $data_dtl['product_id']=$this->input->post('main_id')[$i];
				 $data_dtl['main_loc']=$this->input->post('main_loc')[$i];
				 $data_dtl['loc']=$this->input->post('loc')[$i];
				 $data_dtl['rack_id']=$this->input->post('rack_id')[$i];
				 $data_dtl['hsn_code']=$this->input->post('hsn_code')[$i];				 
				 $data_dtl['quantity']=$this->input->post('qty')[$i];
				 $data_dtl['maker_id']=$this->session->userdata('user_id');
				 $data_dtl['maker_date']=date('y-m-d');
				 $data_dtl['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl['brnh_id']=$this->session->userdata('brnh_id');
				 $this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);		
				$this->updata_stock($qty[$i],$main_id[$i],$main_loc[$i],$loc[$i],$rack_id[$i]);
	
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
	$data= $this->db->query("select * from tbl_stock_out_dtl where stockouthdr='$id'");
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
											
				$this->db->query("insert into tbl_product_serial set quantity='$qty',location_id='$loc',product_id='$main_id',rack_id='$rack_id',comp_id='$comp_id',divn_id='$divn_id',brnh_id='$brnh_id',maker_date='$maker_date',author_date='$author_date'");
					
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

 $sqlProdLoc1="insert into tbl_product_serial_log set quantity ='$new_quantity[$i]',location_id='$location_id[$i]',rack_id='$rack_id[$i]',type='$type[$i]',product_id='$product_id[$i]',main_location_id='$main_loc[$i]',inbound_id='$inbound_id', maker_date=NOW(), author_date=now(), author_id='".$this->session->userdata('user_id')."', maker_id='".$this->session->userdata('user_id')."', divn_id='".$this->session->userdata('divn_id')."', comp_id='".$this->session->userdata('comp_id')."', zone_id='".$this->session->userdata('zone_id')."', brnh_id='".$this->session->userdata('brnh_id')."' ";
$this->db->query($sqlProdLoc1);



 		}else{
			$sqlProdLoc2="insert into tbl_product_serial set product_id='$product_id[$i]',serial_number='$serialno', quantity ='$new_quantity[$i]', location_id='$location_id[$i]',rack_id='$rack_id[$i]',main_location_id='$main_loc[$i]', maker_date=NOW(), author_date=now(), author_id='".$this->session->userdata('user_id')."', maker_id='".$this->session->userdata('user_id')."', divn_id='".$this->session->userdata('divn_id')."', comp_id='".$this->session->userdata('comp_id')."', zone_id='".$this->session->userdata('zone_id')."', brnh_id='".$this->session->userdata('brnh_id')."'"; 
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


public function print_gatepass()
{
	
	$this->load->view("print-gatepass");
}


public function inv_check()
{
	
	$invCheckQuery=$this->db->query("select *from tbl_stock_out_hdr where invoice_no='".$_GET['con']."'");
	echo $cntInv=$invCheckQuery->num_rows();
	//echo "select *from tbl_stock_out_hdr where invoice_no='".$_GET['con']."'";
	
}




		
}