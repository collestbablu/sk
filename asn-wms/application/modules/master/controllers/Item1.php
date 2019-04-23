<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class Item extends my_controller {

function __construct(){
   parent::__construct(); 
    $this->load->model('model_master');	
	$this->load->library('pagination'); 
}



public function export_product_item()
{
	if($this->session->userdata('is_logged_in'))
	{
		$this->load->view('Item/export-product');
	}
	else
	{
		redirect('index');
	}
}
public function manage_item()
{
	
	if($this->session->userdata('is_logged_in'))
	{
	 	$data = $this->Manage_ItemJoin();
		$this->load->view('Item/manage-item',$data);
	}
	else
	{
		redirect('index');
	}
		
}

function Manage_ItemJoin()
{
      $table_name='tbl_product_stock';
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
		  
      $totalData = $this->model_master->count_product($table_name,'A',$this->input->get());
	  
    
      if($_GET['entries']!="" && $_GET['filter']!='filter')
	   {
	     $url   = site_url('/master/Item/manage_item?entries='.$_GET['entries']);
	   }
	   elseif($_GET['filter']=='filter' || $_GET['entries'] != '')
	   {
	     $url = site_url('/master/Item/manage_item?p_id='.$_GET['p_id'].'&sku_no='.$_GET['sku_no'].'&category='.$_GET['category'].'&pg_grp='.$_GET['pg_grp'].'&fmly_grp='.$_GET['fmly_grp'].'&productname='.$_GET['productname'].'&des2='.$_GET['des2'].'&usages_unit='.$_GET['usages_unit'].'&mrp='.$_GET['mrp'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
		}
	   else
	    {
	      $url   = site_url('/master/Item/manage_item?');
	    }
	   
        $pagination = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
        $data=$this->user_function();
        
		
	    $data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
		$data['pagination'] = $this->pagination->create_links();
	
	    if($this->input->get('filter') == 'filter')
        	$data['result'] = $this->model_master->filterProductList($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_master->product_get($pagination['per_page'],$pagination['page']);

	   return $data;
}


public function test_3(){
	
	if($this->session->userdata('is_logged_in')){
	$this->load->view('Item/test_3');
	}
	else
	{
	redirect('index');
	}
		
}


private function test1(){
        echo "In test1", PHP_EOL;
    }
    private function test2(){
        echo "test2", PHP_EOL;
    }
    protected function test3(){
        return "test3" . PHP_EOL;
    }
    public function __call($method,$arguments) {
        if(method_exists($this, $method)) {
            $this->test1();
            return call_user_func_array(array($this,$method),$arguments);
        }
    }



public function item_list()
	{
		$info=array();
		
		$res = $this -> db
           -> select('*')
           -> where('status','A')
           -> get('tbl_product_stock');
		   
		$i='0';
		
		foreach($res->result() as $row)
		{		 
		  
		  $compQuery1 = $this -> db
           -> select('*')
           -> where('serial_number',$row->usageunit)
           -> get('tbl_master_data');
		  $keyvalue1 = $compQuery1->row();
		  
		
			$info[$i]['1']=$row->Product_id;
			$info[$i]['18']=$row->sku_no;
			$info[$i]['19']=$row->pg_group;
			$info[$i]['20']=$row->family_group;
			$info[$i]['2']=$row->category;
			$info[$i]['3']=$row->productname;
			$info[$i]['10']=$row->description2;
			
			$info[$i]['4']=$row->unitprice_purchase;
			$info[$i]['5']=$row->unitprice_sale;
			$info[$i]['6']=$row->mrp;
			$info[$i]['7']=$row->Product_id;		
			$info[$i]['8']=$keyvalue1->keyvalue;
			$info[$i]['9']=$row->product_image;
				
				$i++;
			
		}
		return $info;
	
	}
	
public function get_cid(){
	//$data=$this->user_function();// call permission function
	
		$this->load->view('get_cid');
	
	}

public function add_item(){
//echo "";die;
	if($this->session->userdata('is_logged_in')){
		$this->load->view('Item/add-item');
}
	else
	{
	redirect('index');
	}
}


public function insert_item(){
	
		@extract($_POST);
		$table_name ='tbl_product_stock';
		$pri_col ='Product_id';
	 	$id= $this->input->post('Product_id');
		
		
		 @$branchQuery2 = $this->db->query("SELECT * FROM $table_name where status='A' and Product_id='$id'");
					$branchFetch2 = $branchQuery2->row();
		   
			
		 count($this->input->post('color')); 
		  // implode function is used here
 $bb=$this->input->post('color');
  @$ab=implode(',',$bb);  
 $count=sizeof('color');



			
		 count($this->input->post('size')); 
		  // implode function is used here
 $sizeF=$this->input->post('size');
  @$sizeFI=implode(',',$sizeF);  
 $count=sizeof('size');
		

$catg=$this->input->post('category');
		//$catgF=implode(",",$catg);
		
$unit=$this->input->post('unit');
		//$unitF=implode(",",$unit);
		
	$this->load->model('Model_admin_login');
	
		if($id!=''){

					if($_FILES['image_name']['name']!='')
					{
						$target = "assets/image_data/"; 
						$target1 =$target . @date(U)."_".( $_FILES['image_name']['name']);
						$image_name=@date(U)."_".( $_FILES['image_name']['name']);
						move_uploaded_file($_FILES['image_name']['tmp_name'], $target1);
					}
					else
					
					{
					$image_name=$branchFetch2->product_image;
					
					}		
					$data= array(
					'productname' => $this->input->post('item_name'),
					'category' => $catg,
					'product_image' => $image_name,
					'size' => $sizeFI,
					
					'color' => $ab,
					'Product_typeid' => $Product_typeid,
					'sku_no' => $this->input->post('sku_no'),
					//'quantity_stock' => $this->input->post('quantity_stock'),
					
					'unitprice_purchase' => $this->input->post('unitprice_purchase'),
					
					'unitprice_sale' => $this->input->post('unitprice_sale'),
					'usageunit' => $unit,
					'pic_per_box' => $this->input->post('pic_per_box'),
					'min_re_level' => $this->input->post('min_re_level'),
					'mrp' => $this->input->post('mrp'),
					'hsn_code' => $this->input->post('hsn_code'),
					'p_p_unit' => $this->input->post('p_p_unit'),
					'gst' => $this->input->post('gst_no'),
					'gst_tax' => $this->input->post('gst_tax'),
					'style_no' => $this->input->post('style'),	
					//'mrp' => $this->input->post('mrp'),
					//'reorderlevelqty' => $this->input->post('reorderlevelqty'),
					//'product_status' => $this->'A',
					'mrp' => $this->input->post('mrp'),
					'inventoy_type' => $this->input->post('inventoy_type'),
					'tariff' => $tariff,
					'ean_number' => $ean_number,
					'upc_code' => $upc_code,
					'moq' => $moq,
					'carton_weight' => $carton_weight,
					'length' => $length,
					'width' => $width,
					'height' => $height,
					'sales_pack_wt' => $this->input->post('sales_pack_wt'),
					'pg_group' => $this->input->post('pg_group'),
					'manufacturer_code' => $this->input->post('manufacturer_code'),
					'family_group' => $this->input->post('family_group'),
					'description2' => $this->input->post('description2'),
					'carton_dimensions' => $this->input->post('carton_dimensions'),	
					
					'master_carton_weight' => $this->input->post('master_carton_weight'),	
					'master_carton_quantity' => $this->input->post('master_carton_quantity'),	
					'master_carton_dimensions' => $this->input->post('master_carton_dimensions'),	
					'country_origin' => $this->input->post('country_origin'),	
					'inner_master_carton_weight' => $this->input->post('inner_master_carton_weight'),	
					'inner_master_carton_quantity' => $this->input->post('inner_master_carton_quantity'),	
					'inner_master_carton_w_h_d' => $this->input->post('inner_master_carton_w_h_d'),	
					
					
					
		      	);


	$sesio = array(
					
					'comp_id' => $this->session->userdata('comp_id'),
					'divn_id' => $this->session->userdata('divn_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'maker_date'=> date('y-m-d'),
					'author_date'=> date('y-m-d')
					);
		
		$dataall = array_merge($data,$sesio);
		
		
		
		
		
					$this->Model_admin_login->update_user($pri_col,$table_name,$id,$dataall);
					echo "<script type='text/javascript'>";
					echo "window.close();";
					echo "window.opener.location.reload();";
					echo "</script>";
					}             
				else
				{
				if($_FILES['image_name']['name']!='')
					{
						$target = "assets/image_data/"; 
						$target1 =$target . @date(U)."_".( $_FILES['image_name']['name']);
						$image_name=@date(U)."_".( $_FILES['image_name']['name']);
						move_uploaded_file($_FILES['image_name']['tmp_name'], $target1);
					}
					else
					
					{
					$image_name=$branchFetch2->product_image;
					
					}	
					
		$data= array(
					'productname' => $this->input->post('item_name'),
					'category' => $catg,
					'product_image' => $image_name,
					'size' => $sizeFI,
					'color' => $ab,
					'Product_typeid' => $Product_typeid,
					'sku_no' => $this->input->post('sku_no'),
					//'quantity_stock' => $this->input->post('quantity_stock'),
					'unitprice_purchase' => $this->input->post('unitprice_purchase'),
					'unitprice_sale' => $this->input->post('unitprice_sale'),
					'usageunit' => $unit,
					'pic_per_box' => $this->input->post('pic_per_box'),
					'min_re_level' => $this->input->post('min_re_level'),
					'mrp' => $this->input->post('mrp'),
					'hsn_code' => $this->input->post('hsn_code'),
					'p_p_unit' => $this->input->post('p_p_unit'),
					'gst' => $this->input->post('gst_no'),
					'gst_tax' => $this->input->post('gst_tax'),
					'style_no' => $this->input->post('style'),	
					'mrp' => $this->input->post('mrp'),
					'inventoy_type' => $this->input->post('inventoy_type'),
					'tariff' => $tariff,
					'ean_number' => $ean_number,
					'upc_code' => $upc_code,
					'moq' => $moq,
					'carton_weight' => $carton_weight,
					'length' => $length,
					'width' => $width,
					'height' => $height,
					'sales_pack_wt' => $this->input->post('sales_pack_wt'),
					'pg_group' => $this->input->post('pg_group'),
					'manufacturer_code' => $this->input->post('manufacturer_code'),
					'family_group' => $this->input->post('family_group'),
					'description2' => $this->input->post('description2'),
					'carton_dimensions' => $this->input->post('carton_dimensions'),	
					
					'master_carton_weight' => $this->input->post('master_carton_weight'),	
					'master_carton_quantity' => $this->input->post('master_carton_quantity'),	
					'master_carton_dimensions' => $this->input->post('master_carton_dimensions'),	
					'country_origin' => $this->input->post('country_origin'),	
					'inner_master_carton_weight' => $this->input->post('inner_master_carton_weight'),	
					'inner_master_carton_quantity' => $this->input->post('inner_master_carton_quantity'),	
					'inner_master_carton_w_h_d' => $this->input->post('inner_master_carton_w_h_d'),	
					
					
		      	);

	$sesio = array(
					
					'comp_id' => $this->session->userdata('comp_id'),
					'divn_id' => $this->session->userdata('divn_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'maker_date'=> date('y-m-d'),
					'author_date'=> date('y-m-d')
					);
		
		$dataall = array_merge($data,$sesio);

					
		    	$this->Model_admin_login->insert_user($table_name,$dataall);
			
			 redirect('master/Item/manage_item');
		
		
	}
	}

	private function set_barcode($code)
	{
		//load library
		$this->load->library('zend');
		//load in folder Zend
		$this->zend->load('Zend/Barcode');
		//generate barcode
		Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
	}
	
	
	public function bar()
	{
		//I'm just using rand() function for data example
		$temp = rand(10000, 99999);
		$this->set_barcode($temp);
	}

	
public function import_product(){

	
	if($this->session->userdata('is_logged_in')){
	
		$this->load->view('Item/import-product');
}

else{
redirect('index');

}

}


public function import_item(){
 @extract($_POST);
 $filename=$_FILES["file"]["tmp_name"];
 
 
	if($_FILES["file"]["size"] > 0)
	{
 
		$file = fopen($filename, "r");
		$i=1;
		//echo $filename;die;
		while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
		{
		//echo $i;
//print_r($getData);
		if($getData[0]!=''){
		//if($i==2)
		//{
			
			$locationQuery=$this->db->query("select *from tbl_master_data where keyvalue='".$getData[3]."'");
			$getDes=$locationQuery->row();
			
			
			$locationJanQuery=$this->db->query("select *from tbl_master_data where keyvalue='".$getData[22]."'");
			$getJan=$locationJanQuery->row();
			
			$locationOrgQuery=$this->db->query("select *from tbl_master_data where keyvalue='".$getData[24]."'");
			$getOrg=$locationOrgQuery->row();
			
			
			$locationPortQuery=$this->db->query("select *from tbl_master_data where keyvalue='".$getData[5]."'");
			$getPort=$locationPortQuery->row();
		//echo $getData[0].",".$getData[1];
		$this->db->query("insert into tbl_stock_in_hdr set control_no='".$getData[0]."',mrn_date='".$getData[1]."',mrn_sent_time='".$getData[2]."',destination='$getDes->serial_number',HAWB_booking_date='".$getData[4]."',port_of_loading='$getPort->serail_number',pre_alert_date='".$getData[6]."',eta_date='".$getData[7]."',ata_date='".$getData[8]."',duty_amount='".$getData[9]."',igst_amount='".$getData[10]."',order_no='".$getData[11]."',gate_entry='".$getData[12]."',ge_date='".$getData[13]."',ge_time='".$getData[14]."',vehicle_number='".$getData[15]."',unloading_date='".$getData[16]."',unloading_time='".$getData[17]."',date_of_receipt_at_warehose='".$getData[18]."',international_tat='".$getData[19]."',lead_time_from_ata='".$getData[20]."',lead_time_from_hawb='".$getData[21]."',receipt_of_month='".$getJan->serial_number."',mawb_no='".$getData[23]."',origin='$getOrg->serial_number',hawb='".$getData[25]."',pkg='".$getData[26]."',pallet='".$getData[27]."',gross_weight='".$getData[28]."',boe_no='".$getData[29]."',exchange_rate='".$getData[30]."',boe_date='".$getData[31]."',invoice_no='".$getData[32]."',date='".$getData[33]."'");
		$main_id=$this->db->insert_id();
		//}else{
		//echo $getData[0];
		//$this->db->query("insert into tbl_stock_in_dtl set product_id='".$getData[0]."',stockinhdr='".$main_id."',list_price='".$getData[1]."',quantity='".$getData[2]."',due_date='".$getData[3]."',discount='".$getData[4]."',discount_amount='".$getData[5]."'");
		//}
		}

		$i++;}
		
			//die;
			 fclose($file);
		
	}
	         //fclose($file);
echo "<script>
alert('Product Imported Successfully');




window.location.href = 'manage_item';


</script>";
			 
	 
//redirect('/master/manage_item');
	
}



public function import_item1(){
 @extract($_POST);
 $filename=$_FILES["file"]["tmp_name"];
 
 
	if($_FILES["file"]["size"] > 0)
	{
 
		$file = fopen($filename, "r");
		while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
		{
 
//select id of category
 $catId=$this->db->query("select *from tbl_prodcatg_mst where prodcatg_name='".addslashes($getData[2])."'");
 $catRow=$catId->row();
 
//select id of unit id
 $unitId=$this->db->query("select *from tbl_master_data where keyvalue='".$getData[2]."'");
 $unitRow=$unitId->row();
 
if($getData[0]!='Model')
{
		$this->db->query("insert into tbl_product_stock set sku_no='".$getData[0]."',category='".$catRow->prodcatg_id."',usageunit='".$unitRow->serial_number."',productname='".addslashes($getData[1])."',pg_group='".$getData[3]."',manufacturer_code='".$getData[4]."',inventoy_type='".$getData[5]."',tariff='".$getData[18]."',hsn_code='".$getData[6]."',gst='".$getData[7]."',gst_tax='".$getData[7]."',family_group='".$getData[8]."',description2='".addslashes($getData[9])."',ean_number='".$getData[10]."',upc_code='".$getData[11]."',mrp='".$getData[12]."',length='".$getData[13]."',width='".$getData[14]."',height='".$getData[15]."',sales_pack_wt='".$getData[16]."',moq='".$getData[17]."',carton_weight='".$getData[18]."',carton_dimensions='".$getData[19]."',master_carton_weight='".$getData[20]."',master_carton_quantity='".$getData[22]."',master_carton_dimensions='".$getData[23]."',crossre_ference='".$getData[24]."',country_origin='".$getData[25]."',inner_master_carton_weight='".$getData[26]."',inner_master_carton_quantity='".$getData[27]."',inner_master_carton_w_h_d='".$getData[28]."',comp_id='".$this->session->userdata('comp_id')."'");
			   
}		
		}
			 fclose($file);
		
	}
	         //fclose($file);
echo "<script>
alert('Product Imported Successfully');




window.location.href = 'manage_item';


</script>";
			 
	 
//redirect('/master/manage_item');
	
}



public function import_mul_data(){
 @extract($_POST);
 
  @extract($_POST);
 $filename=$_FILES["file"]["tmp_name"];
 
 
		 if($_FILES["file"]["size"] > 0)
		 {
 
		  	$file = fopen($filename, "r");
	         while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
 	
		//echo $getData[0];
		$productQuery=$this->db->query("select *from tbl_product_stock where sku_no='".$getData[1]."'");
			$getProduct=$productQuery->row();
		echo $getProduct->Product_id;
				$nt=$getData[2]*$getData[13];
				$this->db->query("insert into tbl_stock_in_inv_hdr set product_id='$getProduct->Product_id',stockinhdr='$getData[12]',list_price='$getData[13]',total='$nt',net_price='$nt',quantity='$getData[2]',grn_no='$getData[3]',grn_date='$getData[4]',int_tariff='$getProduct->hsn_code',tariff_no='$getProduct->tariff',inv_no='$getData[6]',inv_date='$getData[7]',order_no='$getData[8]',inc_id='$getData[11]'");		
	         }
			 fclose($file);
		
		 }
	         //fclose($file);
echo "<script>
alert('Product Imported Successfully');




window.location.href = 'manage_item';


</script>";
			 
	 
//redirect('/master/manage_item');
		
	}


public function import_mul_data_demo(){
@extract($_POST);

$filename=$_FILES["file"]["tmp_name"];
 
 
		 if($_FILES["file"]["size"] > 0)
		 {
 
		  	$file = fopen($filename, "r");
	         while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
 	
		//echo $getData[0];
		$productQuery=$this->db->query("select *from tbl_contact_m where code='".$getData[7]."'");
			$getProduct=$productQuery->row();
		 $getProduct->Product_id;
		 
		 
		 //echo $getData[0];
		$resQuery=$this->db->query("select *from tbl_contact_m where first_name='".$getData[6]."'");
			$getRes=$resQuery->row();
		 
		 
		 
				
				$this->db->query("insert into tbl_return_hdr set rgp_gate_pass_date='$getData[0]',return_due_date='$getData[1]',rgp_gatepass_no='$getData[2]',manual_gate_pass_no='$getData[3]',manual_gp_date='$getData[4]',gatepass_issued_name='$getData[5]',responsibility='$getRes->contact_id',stock_position='$getProduct->code',remarks1='$getData[8]',remarks2='$getData[9]',wh_remarks='$getData[10]'");			   
	
	         }
			 fclose($file);
		
		 }
	         //fclose($file);
echo "<script>
alert('Product Imported Successfully');




window.location.href = 'manage_item';


</script>";
			 
	 
//redirect('/master/manage_item');
		
	}



public function import_item_update(){
@extract($_POST);
$filename=$_FILES["file"]["tmp_name"];
	if($_FILES["file"]["size"] > 0)
	{
 
		$file = fopen($filename, "r");
		while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
		{
 
//select id of category
 $catId=$this->db->query("select *from tbl_prodcatg_mst where prodcatg_name='".addslashes($getData[2])."'");
 $catRow=$catId->row();
 
//select id of unit id
 $unitId=$this->db->query("select *from tbl_master_data where keyvalue='".$getData[2]."'");
 $unitRow=$unitId->row();
 
if($getData[0]!='Model')
{
		$this->db->query("update  tbl_product_stock set sku_no='".$getData[0]."',category='".$catRow->prodcatg_id."',usageunit='".$unitRow->serial_number."',productname='".addslashes($getData[1])."',pg_group='".$getData[3]."',manufacturer_code='".$getData[4]."',inventoy_type='".$getData[5]."',tariff='".$getData[18]."',hsn_code='".$getData[6]."',gst='".$getData[7]."',gst_tax='".$getData[7]."',family_group='".$getData[8]."',description2='".addslashes($getData[9])."',ean_number='".$getData[10]."',upc_code='".$getData[11]."',mrp='".$getData[12]."',length='".$getData[13]."',width='".$getData[14]."',height='".$getData[15]."',sales_pack_wt='".$getData[16]."',moq='".$getData[17]."',carton_weight='".$getData[18]."',carton_dimensions='".$getData[19]."',master_carton_weight='".$getData[20]."',master_carton_quantity='".$getData[22]."',master_carton_dimensions='".$getData[23]."',crossre_ference='".$getData[24]."',country_origin='".$getData[25]."',inner_master_carton_weight='".$getData[26]."',inner_master_carton_quantity='".$getData[27]."',inner_master_carton_w_h_d='".$getData[28]."',comp_id='".$this->session->userdata('comp_id')."' where sku_no='".$getData[0]."'");
			   
}		
		}
			 fclose($file);
		
	}
	         //fclose($file);
echo "<script>
alert('Product Imported Successfully');




window.location.href = 'manage_item';


</script>";
			 
	 
//redirect('/master/manage_item');
	
}


}

?>