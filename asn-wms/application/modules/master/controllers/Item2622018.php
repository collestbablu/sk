<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class Item extends my_controller {

public function manage_item(){
	
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	$this->load->view('Item/manage-item',$data);
	}
	else
	{
	redirect('index');
	}
		
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
		$this->db->query("insert into tbl_product_stock set sku_no='".$getData[0]."',category='".$catRow->prodcatg_id."',usageunit='".$unitRow->serial_number."',productname='".addslashes($getData[1])."',pg_group='".$getData[3]."',manufacturer_code='".$getData[4]."',inventoy_type='".$getData[5]."',tariff='".$getData[6]."',hsn_code='".$getData[7]."',gst='".$getData[8]."',family_group='".$getData[9]."',description2='".addslashes($getData[10])."',ean_number='".$getData[11]."',upc_code='".$getData[12]."',mrp='".$getData[13]."',length='".$getData[14]."',width='".$getData[15]."',height='".$getData[16]."',sales_pack_wt='".$getData[17]."',moq='".$getData[18]."',carton_weight='".$getData[19]."',carton_dimensions='".$getData[20]."',master_carton_weight='".$getData[21]."',master_carton_quantity='".$getData[22]."',master_carton_dimensions='".$getData[23]."',crossre_ference='".$getData[24]."',country_origin='".$getData[25]."',inner_master_carton_weight='".$getData[26]."',inner_master_carton_quantity='".$getData[27]."',inner_master_carton_w_h_d='".$getData[28]."',comp_id='".$this->session->userdata('comp_id')."'");
			   
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