<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class Stock extends my_controller {
function __construct(){
   parent::__construct();
   $this->load->model('model_stock');
}     



public function view_stock(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('print_stock');
	}
	else
	{
	redirect('index');
	}		
}

public function stock_status_approved(){
	if($this->session->userdata('is_logged_in')){
		$id=$_GET["id"];
		$this->db->query("update tbl_bom_hdr set Approval_status='Approved' where bom_id_hdr='$id'");
		redirect('Stock/manage_stock');
	}
	else
	{
	redirect('index');
	}		
}


public function view_technical(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('view-technical');
	}
	else
	{
	redirect('index');
	}
}

public function get_pallet(){
	if($this->session->userdata('is_logged_in')){
		//$data['$loc']=$_GET["proPall"];
		$this->load->view('get-pallet');
	}
	else
	{
	redirect('index');
	}		
}

public function get_rack(){
	if($this->session->userdata('is_logged_in')){
		//$data['$loc']=$_GET["proPall"];
		$this->load->view('get-rack');
	}
	else
	{
	redirect('index');
	}		
}

public function get_prod(){
	if($this->session->userdata('is_logged_in')){
		$data['prod']=$_GET['prod'];
		$this->load->view('get-prod',$data);
	}
	else
	{
	redirect('index');
	}
}

public function add_stock(){
	
	if($this->session->userdata('is_logged_in')){
		$this->load->view('add-stock');
	}
	else
	{
		redirect('index');
	}	
}
	
public function manage_stock(){
	
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	$data['result'] = $this->model_stock->stock_data();
	$this->load->view('manage-stock',$data);
	}
	else
	{
	redirect('index');
	}	
}
public function insertStock(){
		
		extract($_POST);
				
		for($i=0; $i<=$rows; $i++){
				if($qty[$i]!=''){
				//echo $main_id[$i]."^".$locId[$i]."^".$palletId[$i]."^".$rackId[$i];die;
					 $selectQuery = "select * from tbl_product_serial where product_id='$main_id[$i]' and main_location_id='$locId[$i]' and location_id='$palletId[$i]' and rack_id='$rackId[$i]'";
					 $selectQuery1=$this->db->query($selectQuery);

					 $num= $selectQuery1->num_rows();
					 //echo $num;die;
					if($num>0){
					 	$this->db->query("update tbl_product_serial set quantity =quantity+$qty[$i] where product_id='".$main_id[$i]."' and main_location_id='".$locId[$i]."' and location_id='".$palletId[$i]."' and rack_id='$rackId[$i]'");
					 	
						$this->db->query("update tbl_product_stock set quantity =quantity+$qty[$i] where Product_id='".$main_id[$i]."'");
						
						$sqlProdLoc1="insert into tbl_product_serial_log set quantity ='$qty[$i]',main_location_id='$locId[$i]',location_id='$palletId[$i]',rack_id='$rackId[$i]',product_id='$main_id[$i]',maker_date=NOW(),author_date=now(),author_id='".$this->session->userdata('user_id')."', maker_id='".$this->session->userdata('user_id')."', divn_id='".$this->session->userdata('divn_id')."', comp_id='".$this->session->userdata('comp_id')."', zone_id='".$this->session->userdata('zone_id')."', brnh_id='".$this->session->userdata('brnh_id')."' ";
$this->db->query($sqlProdLoc1);
					 
					}else{
						
						$sqlProdLoc2="insert into tbl_product_serial set product_id='$main_id[$i]',quantity ='$qty[$i]', main_location_id='$locId[$i]',location_id='$palletId[$i]',rack_id='$rackId[$i]', maker_date=NOW(), author_date=now(), author_id='".$this->session->userdata('user_id')."', maker_id='".$this->session->userdata('user_id')."', divn_id='".$this->session->userdata('divn_id')."', comp_id='".$this->session->userdata('comp_id')."', zone_id='".$this->session->userdata('zone_id')."', brnh_id='".$this->session->userdata('brnh_id')."'"; 
$this->db->query($sqlProdLoc2);
				 
						$this->db->query("update tbl_product_stock set quantity =quantity+$qty[$i] where Product_id='".$main_id[$i]."'");
						
						$sqlProdLoc1="insert into tbl_product_serial_log set quantity ='$qty[$i]',main_location_id='$locId[$i]',location_id='$palletId[$i]',rack_id='$rackId[$i]',product_id='$main_id[$i]',maker_date=NOW(),author_date=now(),author_id='".$this->session->userdata('user_id')."', maker_id='".$this->session->userdata('user_id')."', divn_id='".$this->session->userdata('divn_id')."', comp_id='".$this->session->userdata('comp_id')."', zone_id='".$this->session->userdata('zone_id')."', brnh_id='".$this->session->userdata('brnh_id')."' ";
$this->db->query($sqlProdLoc1);
					}
				}
		}
		
		echo "<script>
		alert('Stock Added Sucessfully');
		window.location.href='add_stock';
		</script>";
		
		//$rediectInvoice="Stock/add_stock";
		//redirect($rediectInvoice);	
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
	
	public function updateBom(){
		
		extract($_POST);
		$table_name ='tbl_bom_hdr';
		$table_name_dtl ='tbl_bom_dtl';
		$pri_col ='bom_id_hdr';
		$pri_col_dtl ='bom_id_dtl';
		$id=$this->input->post('bom_id');
	
		

// $this->refil_qnty_del($id);

		
				
		$sess = array(
					
					'maker_id' => $this->session->userdata('user_id'),
					'maker_date' => date('y-m-d'),
					'status' => 'A',
					'comp_id' => $this->session->userdata('comp_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'divn_id' => $this->session->userdata('divn_id')
		);
	
		$data = array(
	
					'contact_name' => $this->input->post('contact_id'),
					'w_odr_no' => $this->input->post('w_odr_no'),
					'strt_date' => $this->input->post('strt_dt'),
					'dlvry_date' => $this->input->post('dlvry_dt'),
					'catg_id' => $this->input->post('catg_id'),
					'swl' => $this->input->post('swl'),
					'hoist_cap' => $this->input->post('hoist_cap'),
					'tot_ht' => $this->input->post('tot_ht'),
					'no_flr' => $this->input->post('no_flr'),
					'spd' => $this->input->post('spd'),
					'gide_rls' => $this->input->post('gide_rls'),
					'flr_dst' => $this->input->post('flr_dst')
					
					
					);
			
			$data_merge = array_merge($data,$sess);					
		   
			$this->load->model('Model_admin_login');	
		$this->Model_admin_login->update_user($pri_col,$table_name,$id,$data_merge);
//echo "delete from tbl_bom_dtl where bom_id_hdr='$id'";die;
		 $this->db->query("delete from tbl_bom_dtl where bom_id_hdr='$id'");	
		//echo $rows;die;
		for($i=0; $i<$rows; $i++)
				{
				 				
			    
				
				
				if($qn[$i]!=''){

				 $data_dtl['bom_id_hdr']= $id;
				 $data_dtl['sub_catg_id']=$this->input->post('pri_id')[$i];		 
				 $data_dtl['quantity']=$this->input->post('qn')[$i];
				 $data_dtl['unit']=$this->input->post('usunit')[$i];
				 $data_dtl['catg_values']=$this->input->post('cate_type_id')[$i];
				 $data_dtl['maker_id']=$this->session->userdata('user_id');
				 $data_dtl['maker_date']=date('y-m-d');
				 $data_dtl['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl['brnh_id']=$this->session->userdata('brnh_id');
				
				$this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);		
				//$this->updata_stock($qty[$i],$main_id[$i]);
				
			
							}
					}
	   echo "<script type='text/javascript'>";
					echo "window.close();";
					echo "window.opener.location.reload();";
					echo "</script>";
					
	
	}
	function refil_qnty_del($id){
	
		 $data= $this->db->query("select * from tbl_bom_dtl where purchaseorderhdr='$id'");
		foreach($data->result() as $update){
		$this->db->query("update tbl_product_stock set quantity=quantity-'".$update->quantity."' where   Product_id='".$update->product_id."'");
		  
		
		
		}
return;	
	}
	
	
	
	
	public function stock_refill_qty($qty,$main_id)
	{
	
	
				$this->db->query("update tbl_product_stock set quantity=quantity+'$qty' where product_id='$main_id'");
	
				
	
	}	
	
	
		
	function updata_stock($qty,$main_id){
	
		 $this->db->query("update tbl_product_stock set quantity=quantity+'$qty' where Product_id='$main_id'");
		
		return;	
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
					'status' => 'Purchaseorder'					
					
		);
	$this->load->model('Model_admin_login');
	if($id!=''){

		//$this->Model_admin_login->update_user($pri_col,$table_name,$id,$data_pay);
	
	$datee=date('Y-m-d H:i:s');
$mkrdate=date('y-m-d');
$this->db->query("update tbl_invoice_payment set contact_id='".$vendor_id."',receive_billing_mount='".$grand_total."',invoiceid='". $lastHdrId."',date='$datee',maker_id='".$this->session->userdata('user_id')."',maker_date='$mkrdate',comp_id='".$this->session->userdata('comp_id')."',status='Purchaseorder' where status='Purchaseorder' and invoiceid='$id'");	
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
	
		 $this->db->query("update tbl_product_stock set quantity=quantity-'$qty' where Product_id='$main_id'");
		 $this->db->query("update tbl_product_serial set quantity=quantity-'$qty' where product_id='$main_id'");
		return;	
	}	



public function import_stockIn(){

	
	if($this->session->userdata('is_logged_in')){
	
		$this->load->view('Stock/import-product-stockIn');
}

else{
redirect('index');

}

}


public function insert_stockIn(){
 @extract($_POST);
 $filename=$_FILES["file"]["tmp_name"];
 
 
	if($_FILES["file"]["size"] > 0)
	{
 
		$file = fopen($filename, "r");
		while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
		{
 
 




$masterId=$this->db->query("select *from tbl_master_data where keyvalue='".$getData[2]."'");
 $masterRow=$masterId->row();

$masterRow->serial_number;




//select id of unit id
//echo "select *from tbl_location_rack where rack_name='".$getData[2]."'";
 $unitId=$this->db->query("select *from tbl_location_rack where rack_name='".$getData[3]."' and location_rack_id='".$masterRow->serial_number."'");
 $unitRow=$unitId->row();



//echo "select *from tbl_location_rack where rack_name='".$getData[2]."'";
 $proId=$this->db->query("select *from tbl_product_stock where sku_no='".$getData[0]."'");
 $proRow=$proId->row();

 
if($getData[0]!='Model')
{
	
	//echo "insert into tbl_product_serial set product_id='$proRow->Product_id',quantity='".$getData[1]."',main_location_id='1',location_id='54',rack_id='$unitRow->id',comp_id='".$this->session->userdata('comp_id')."'";
		
		echo "insert into tbl_product_serial set product_id='$proRow->Product_id',quantity='".$getData[1]."',main_location_id='1',location_id='".$masterRow->serial_number."',rack_id='$unitRow->id',comp_id='".$this->session->userdata('comp_id')."'";
		$this->db->query("update tbl_product_stock set quantity=quantity+'".$getData[1]."' where Product_id='$proRow->Product_id'");
		$this->db->query("insert into tbl_product_serial set product_id='$proRow->Product_id',quantity='".$getData[1]."',main_location_id='1',location_id='".$masterRow->serial_number."',rack_id='$unitRow->id',comp_id='".$this->session->userdata('comp_id')."'");
		
		$this->db->query("insert into tbl_product_serial_log set product_id='$proRow->Product_id',quantity='".$getData[1]."',main_location_id='1',location_id='".$masterRow->serial_number."',rack_id='$unitRow->id',comp_id='".$this->session->userdata('comp_id')."',type='Stock In'");
			   
}		
		}
			 fclose($file);
		
	}
/*	         //fclose($file);
echo "<script>
alert('Product Imported Successfully');




window.location.href = 'import_stockIn';


</script>";
	*/		 
	 
//redirect('/master/manage_item');
	
}		
}