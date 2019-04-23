<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class ProductCategory extends my_controller {


public function pcategory_list()
	{
		$info=array();
		
		$res = $this -> db
           -> select('*')
           -> where('status','A','comp_id',$this->session->userdata('comp_id'))
           -> get('tbl_prodcatg_mst');
		   
		$i='0';
		
		foreach($res->result() as $row)
		{
	
		  $compQuery = $this -> db
           -> select('*')
           -> where('status','A','prodcatg_id',$row->main_prodcatg_id)
           -> get('tbl_prodcatg_mst');
		  $compRow = $compQuery->row();
		
		  if($row->main_prodcatg_id==1){$Primary="Y";}else{$Primary="N";}
				
			$info[$i]['1']=$row->prodcatg_name;
			$info[$i]['2']=$Primary;
			 if($row->main_prodcatg_id!='1'){
			$info[$i]['3']=$compRow->prodcatg_name;
			}
			$info[$i]['4']=$row->prodcatg_id;				
				$i++;
			
		}
		return $info;
	
	}


	public function insert_itemctg(){	
			extract($_POST);
			$table_name ='tbl_prodcatg_mst';
		 	$pri_col ='prodcatg_id';
	 		$id= $this->input->post('prodcatg_id');
			$mid1= $this->input->post('mid1');
			//echo $mid1;die;
			$midd1= $this->input->post('midd1');
			$midd2= $midd1-1;
			if($midd2==1){
			$mid= $midd2;
			}else if($mid1==''){
			$mid= $this->input->post('mid');
			}else{
			$mid= $this->input->post('mid1');
			}
			$data=array(
					
					'prodcatg_name' => $this->input->post('prodcatg_name'),
					'printname' => $this->input->post('printname'),
					'alias' => $this->input->post('alias'),
					'Description' => $this->input->post('description'),
					'main_prodcatg_id' => $mid
					
					);
					
			$sesio = array(
					
					'comp_id' => $this->session->userdata('comp_id'),
					'divn_id' => $this->session->userdata('divn_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'maker_id' => $this->session->userdata('user_id'),
					'author_id' => $this->session->userdata('user_id'),
					'maker_date'=> date('y-m-d'),
					'author_date'=> date('y-m-d')
					);
			$dataall=array_merge($data,$sesio);
					$this->load->model('Model_admin_login');
			if($id!=''){
					$this->Model_admin_login->update_user($pri_col,$table_name,$id,$dataall);
					echo "<script type='text/javascript'>";
					echo "window.close();";
					echo "window.opener.location.reload();";
					echo "</script>";
					}
		else
				{
					if($midd1==2){
					
					$this->Model_admin_login->insert_user($table_name,$dataall);
					
					
					echo "<script type='text/javascript'>";
					echo "window.close();";
					echo "window.opener.location.reload();";
					echo "</script>";
					}
					else if($mid==1){
					$this->Model_admin_login->insert_user($table_name,$dataall);
					redirect('/master/ProductCategory/manage_itemctg');
					}
					else{
					$this->Model_admin_login->insert_user($table_name,$dataall);
					$lastid=$this->db->insert_id();
					$this->fillselect($prodcatg_name,$lastid,'contact_id_copy');
					echo "<script type='text/javascript'>";
					echo "window.close();";
					//echo "window.opener.location.reload();";
					echo "</script>";
			
				}
				}
				
			}	
			
	

public function add_itemctg(){
	
	if($this->session->userdata('is_logged_in')){
		$this->load->view('ProductCategory/add-itemctg');
	}
	else
	{
	redirect('index');
	}
	
	
}
	
	public function manage_itemctg(){
	
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	$this->load->view('ProductCategory/manage-itemctg',$data);
	}
	else
	{
	redirect('index');
	}
	
	
}

	
public function aliesfunction(){
	
		$data['alias_idd']=$_GET['alias_idd'];
		$this->load->view('get-alies-itemctg',$data);
	
	}

	public function prodcatefunction(){
	
		$data['prodcatg_id']=$_GET['prodcatg_id'];
		$this->load->view('get-alies-itemctg',$data);
	
	}
	
}
?>