<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);

class locationRack extends my_controller {

function __construct()
{
   parent::__construct();
   $this->load->model('model_locationrack');
   $this->load->library('pagination'); 

}     

public function export_location_rack()
{
	if($this->session->userdata('is_logged_in'))
	{
		$this->load->view('export-location-rack');
	}
	else
	{
		redirect('index');
	}
}

public function manage_location_rack()
{
	if($this->session->userdata('is_logged_in'))
	{
		$data = $this->ManageLocationRack();
		$this->load->view('manage-location-rack',$data);
	}
	else
	{
		redirect('index');
	}
		
}

function ManageLocationRack()
{

     	 $table_name='tbl_location_rack';
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
        
		 $totalData   = $this->model_locationrack->count_location_rack($table_name,'A',$this->input->get());
        
        
		 if($_GET['entries']!="" && $_GET['filter']!='filter')
	     {
	       $url   = site_url('/locationRack/manage_location_rack?entries='.$_GET['entries']);
	     }
	     elseif($_GET['filter']=='filter' || $_GET['entries'] != '')
	     {
	       $url = site_url('/locationRack/manage_location_rack?main_loc='.$_GET['main_loc'].'&location='.$_GET['location'].'&rack_name='.$_GET['rack_name'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
		 }
	     else
	     {
	       $url   = site_url('/locationRack/manage_location_rack?');
	     }
		
         $pagination = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
        
		 $data=$this->user_function();
     	 $data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
		 $data['pagination'] = $this->pagination->create_links();
	
		 if($this->input->get('filter') == 'filter') 
        	$data['result'] = $this->model_locationrack->filterLocationRack($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_locationrack->get_locationrack($pagination['per_page'],$pagination['page']);

     return $data;
	 
}
	
public function get_cid()
{
	$this->load->view('get_cid');
}

public function add_location_rack()
{
	if($this->session->userdata('is_logged_in'))
	{
		$this->load->view('add-location-rack');
	}
	else
	{
		redirect('index');
	}
}


public function insert_location_rack(){
	
		@extract($_POST);
		$table_name ='tbl_location_rack';
		$pri_col ='id';
	 	$id= $this->input->post('id');
		$data= array(
					'location_id' => $this->input->post('location_id'),
					'location_rack_id' => $this->input->post('location_rack_id'),
					'rack_name' => $this->input->post('rack_name')
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
		
		$dataall = array_merge($data,$sesio);

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
				
					
		    	$this->Model_admin_login->insert_user($table_name,$dataall);
			
			 redirect('/locationRack/manage_location_rack');
		
	}
  }
}

?>