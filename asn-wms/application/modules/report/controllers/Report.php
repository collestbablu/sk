<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class Report extends my_controller {

function __construct()
{
    parent::__construct(); 
    $this->load->library('pagination');
	$this->load->model('model_report');	
}     

function report_function() 
{
	extract($_POST);
    if($this->session->userdata('is_logged_in'))
	{
    	$this->load->view('open-page-report');
	}
	else
	{
		redirect('index');
	}
}

//=======================Professional Stock====================

function export_professional_stock()
{
	$this->load->view('excel/export-professional-stock');
}

function searchProfessionalStock() 
{
    
  if($this->session->userdata('is_logged_in'))
  {
  	 $data = $this->Professional_Stock_Data();
     $this->load->view('professional-stock-report', $data);
  }
  else
  {
   	 redirect('index');
  }
  
}

public function Professional_Stock_Data()
{

     $data['result'] = "";
     $table_name  = 'tbl_product_stock';
     //$url        = site_url('/report/Report/searchProfessionalStock?');
     $sgmnt      = "4";
     
	 if($_GET['entries'] != '')
	  {
	  	$showEntries = $_GET['entries'];
	  }
	  else
	  {
	  	$showEntries= 10;
	  }
     
	 $totalData  = $this->model_report->count_professional_stock($pagination['per_page'],$pagination['page'],$this->input->get());
     
	 if($_GET['entries'] != '' && $_GET['filter'] != 'filter')
	  {
         $url = site_url('/report/Report/searchProfessionalStock?entries='.$_GET['entries']);
      }
	  elseif($_GET['filter'] == 'filter' || $_GET['entries'] != '')
	  {
	  	$url = site_url('/report/Report/searchProfessionalStock?p_name='.$_GET['p_name'].'&sku_no='.$_GET['sku_no'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
	  }
	  else
	  {
	  	$url = site_url('/report/Report/searchProfessionalStock?');
	  }
     
	 $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
  
     $data=$this->user_function();      // call permission fnctn
     $data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
     $data['pagination'] = $this->pagination->create_links();
   
     if($this->input->get('filter') == 'filter')   ////filter start ////
          $data['result'] = $this->model_report->filterProfessionalStock($pagination['per_page'],$pagination['page'],$this->input->get());
            else  
        $data['result'] = $this->model_report->getProfessionalStock($pagination['per_page'],$pagination['page']);
      
     return $data;
	 
}

//=============================PG GROUP 72====================

function export_pg_group()
{
	$this->load->view('excel/export-pg-group');
}

function searchPgGroup72() 
{

  if($this->session->userdata('is_logged_in'))
  {
   	$data = $this->PgGroup72_Data();
    $this->load->view('pg-group-72', $data);
  }
  else
  {
    redirect('index');
  }

}

public function PgGroup72_Data()
{

     $data['result'] = "";
     $table_name  = 'tbl_product_stock';
     //$url        = site_url('/report/Report/searchPgGroup72?');
     $sgmnt      = "4";
     
	 if($_GET['entries'] != '')
	  {
	  	$showEntries = $_GET['entries'];
	  }
	  else
	  {
	  	$showEntries= 10;
	  }
     
	 $totalData  = $this->model_report->count_pg_group($pagination['per_page'],$pagination['page'],$this->input->get());
     
	 if($_GET['entries'] != '' && $_GET['filter'] != 'filter')
	  {
         $url = site_url('/report/Report/searchPgGroup72?entries='.$_GET['entries']);
      }
	  elseif($_GET['filter'] == 'filter' || $_GET['entries'] != '')
	  {
	  	$url = site_url('/report/Report/searchPgGroup72?p_name='.$_GET['p_name'].'&sku_no='.$_GET['sku_no'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
	  }
	  else
	  {
	  	$url = site_url('/report/Report/searchPgGroup72?');
	  }
     
	 $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
  
     $data=$this->user_function();      // call permission fnctn
     $data['dataConfig']        = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
     $data['pagination']        = $this->pagination->create_links();
   
     if($this->input->get('filter') == 'filter')   ////filter start ////
          $data['result']       = $this->model_report->filterPgGroup($pagination['per_page'],$pagination['page'],$this->input->get());
          else  
          $data['result'] = $this->model_report->getPgGroup($pagination['per_page'],$pagination['page']);
      
     return $data;
	 
}

//===============================Consumer Stock======================

function export_consumer_stock()
{
	$this->load->view('excel/export-consumer-stock');
}

function searchConsumerStock() 
{

	if($this->session->userdata('is_logged_in'))
	{
		$data = $this->ConsumerStock_Data();
    	$this->load->view('consumer-stock-report', $data);
	}
	else
	{
		redirect('index');
	}
}

public function ConsumerStock_Data()
{

  	  $data['result'] = "";
	  $table_name  = 'tbl_product_stock';
	  //$url        = site_url('/report/Report/searchConsumerStock?');
	  $sgmnt      = "4";
	  
	  if($_GET['entries'] != '')
	  {
	  	$showEntries = $_GET['entries'];
	  }
	  else
	  {
	  	$showEntries= 10;
	  }
      
	  $totalData  = $this->model_report->count_consumer_stock($pagination['per_page'],$pagination['page'],$this->input->get());
      
	  if($_GET['entries'] != '' && $_GET['filter'] != 'filter')
	  {
         $url = site_url('/report/Report/searchConsumerStock?entries='.$_GET['entries']);
      }
	  elseif($_GET['filter'] == 'filter' || $_GET['entries'] != '')
	  {
	  	$url = site_url('/report/Report/searchConsumerStock?p_name='.$_GET['p_name'].'&sku_no='.$_GET['sku_no'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
	  }
	  else
	  {
	  	$url = site_url('/report/Report/searchConsumerStock?');
	  }
      
	  $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
  
      $data=$this->user_function();      // call permission fnctn
      $data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
      $data['pagination'] = $this->pagination->create_links();
	 
	  if($this->input->get('filter') == 'filter')   ////filter start ////
        	$data['result']       = $this->model_report->filterConsumerStock($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_report->getConsumerStock($pagination['per_page'],$pagination['page']);
			
     return $data;

}

//=================================Complete Stock With blr==========

function export_complete_stock_with_blr()
{
	$this->load->view('excel/export-complete-stock');
}

function searchCompleteStock() 
{
    
	if($this->session->userdata('is_logged_in'))
	{
		$data = $this->CompleteStock_Data();
    	$this->load->view('complete-stock-with-blr', $data);
	}
	else
	{
		redirect('index');
	}
	
}

public function CompleteStock_Data()
{

  	  $data['result'] = "";
	  $table_name  = 'tbl_product_stock';
	  //$url        = site_url('/report/Report/searchCompleteStock?');
	  $sgmnt      = "4";
	  
	  if($_GET['entries'] != '')
	  {
	  	$showEntries = $_GET['entries'];
	  }
	  else
	  {
	  	$showEntries= 10;
	  }
      
	  $totalData  = $this->model_report->count_complete_stock($pagination['per_page'],$pagination['page'],$this->input->get());
      
	  if($_GET['entries'] != '' && $_GET['filter'] != 'filter')
	  {
         $url = site_url('/report/Report/searchCompleteStock?entries='.$_GET['entries']);
      }
	  elseif($_GET['filter'] == 'filter' || $_GET['entries'] != '')
	  {
	  	$url = site_url('/report/Report/searchCompleteStock?p_name='.$_GET['p_name'].'&sku_no='.$_GET['sku_no'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
	  }
	  else
	  {
	  	$url = site_url('/report/Report/searchCompleteStock?');
	  }
      
	  $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
  
      $data=$this->user_function();      // call permission fnctn
      $data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
      $data['pagination'] = $this->pagination->create_links();
	 
	  if($this->input->get('filter') == 'filter')   ////filter start ////
        	$data['result'] = $this->model_report->filterCompleteStock($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_report->getCompleteStock($pagination['per_page'],$pagination['page']);
			
     return $data;
	 
}

//========================PI Report=============================

function export_pi()
{
	$this->load->view('excel/export-pi-report');
}

function searchPI() 
{

    if($this->session->userdata('is_logged_in'))
	{
		$data = $this->Manage_PI_Data();
    	$this->load->view('pi-report', $data);
	}
	else
	{
		redirect('index');
	}
}

function Manage_PI_Data()
{

  	  $data['result'] = "";
	  $table_name  = 'tbl_product_serial_log';
	  //$url        = site_url('/report/Report/searchPI?');
	  $sgmnt      = "4";
	  
	  if($_GET['entries'] != '')
	  {
	  	$showEntries = $_GET['entries'];
	  }
	  else
	  {
	  	$showEntries= 10;
	  }
	  
	  if($this->input->get('filter') == 'filter')   ////filter start ////
      		$totalData  = $this->model_report->count_pi($pagination['per_page'],$pagination['page'],$this->input->get());
	  else
	        $totalData  = $this->model_report->count_pi_crdate($pagination['per_page'],$pagination['page'],$this->input->get());
			
      if($_GET['entries'] != '' && $_GET['filter'] != 'filter')
	  {
         $url = site_url('/report/Report/searchPI?entries='.$_GET['entries']);
      }
	  elseif($_GET['filter'] == 'filter' || $_GET['entries'] != '')
	  {
	  	$url = site_url('/report/Report/searchPI?location='.$_GET['location'].'&f_date='.$_GET['f_date'].'&t_date='.$_GET['t_date'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
	  }
	  else
	  {
	  	$url = site_url('/report/Report/searchPI?');
	  }
      
	  $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
  
      $data=$this->user_function();      // call permission fnctn
      $data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
      $data['pagination'] = $this->pagination->create_links();
	 
	  if($this->input->get('filter') == 'filter')   ////filter start ////
        	$data['result'] = $this->model_report->filterPiList($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_report->getPI($pagination['per_page'],$pagination['page']);
			
      return $data;
	  

}

//===============================DelhiStock==================================

function export_transaction()
{
	$this->load->view('excel/export-delhi-stock');
}

function searchDelhiStock() 
{
    if($this->session->userdata('is_logged_in'))
	{
		$data = $this->DelhiStock_Data();
    	$this->load->view('delhi-stock-report', $data);
	}
	else
	{
		redirect('index');
	}
}

function DelhiStock_Data()
{

  	  $data['result'] = "";
	  $table_name  = 'tbl_product_serial_log';
	  //$url        = site_url('/report/Report/searchDelhiStock?');
	  $sgmnt      = "4";
	  
	  if($_GET['entries'] != '')
	  {
	  	$showEntries = $_GET['entries'];
	  }
	  else
	  {
	  	$showEntries= 10;
	  }
      
	  $totalData  = $this->model_report->count_delhi_stock($pagination['per_page'],$pagination['page'],$this->input->get());
      
	  if($_GET['entries'] != '' && $_GET['filter'] != 'filter')
	  {
         $url = site_url('/report/Report/searchDelhiStock?entries='.$_GET['entries']);
      }
	  elseif($_GET['filter'] == 'filter' || $_GET['entries'] != '')
	  {
	  	$url = site_url('/report/Report/searchDelhiStock?location='.$_GET['location'].'&sku_no='.$_GET['sku_no'].'&f_date='.$_GET['f_date'].'&t_date='.$_GET['t_date'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
	  }
	  else
	  {
	  	$url = site_url('/report/Report/searchDelhiStock?');
	  }
      
	  $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
  
      $data=$this->user_function();      // call permission fnctn
      $data['dataConfig']        = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
      $data['pagination']        = $this->pagination->create_links();
	 
	  if($this->input->get('filter') == 'filter')   ////filter start ////
        	$data['result'] = $this->model_report->filterDelhiStockList($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_report->getDelhiStock($pagination['per_page'],$pagination['page']);
			
			//echo count($data['result']);
			
     return $data;

}


//======================================ProductStock============================

function searchStock() {
		extract($_POST);
    if($this->session->userdata('is_logged_in')){
	//$postlist['stockSearch'] = $this->model_report->getSearchStock($p_name,$p_code);
	$data =  $this->manage_productJoin();
    $this->load->view('add-report', $data);
	}
	else
	{
	redirect('index');
	}
}

function manage_productJoin(){
  	 $data['result'] = "";
	  $table_name  = 'tbl_product_stock';
	  $url        = site_url('/report/Report/searchStock?');
	  $sgmnt      = "4";
	  $showEntries= 10;
      $totalData  = $this->model_report->count_product($pagination['per_page'],$pagination['page'],$this->input->get());
      if($_GET['entries']!=""){
         $showEntries = $_GET['entries'];
         $url     = site_url('/report/Report/searchStock?entries='.$_GET['entries']);
      }
     $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
  
    
     $data=$this->user_function();      // call permission fnctn
     $data['dataConfig']        = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
     $data['pagination']        = $this->pagination->create_links();
	 
	 if($this->input->get('filter') == 'filter')   ////filter start ////
        	$data['result']       = $this->model_report->filterProductList($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_report->getProduct($pagination['per_page'],$pagination['page']);
			
     return $data;
}

//===================================End=========================

function searchPgGroup() {
		extract($_POST);
    if($this->session->userdata('is_logged_in')){
	//$postlist['searchPgGroup'] = $this->model_report->getSearchPgGroup($p_name,$sku_no);
	$data = $this->manage_seventy_two_data();
    $this->load->view('seventy-two-report', $data);
	}
	else
	{
	redirect('index');
	}
}

function manage_seventy_two_data(){

  	 $data['result'] = "";
	  $table_name  = 'tbl_product_serial';
	  $url        = site_url('/report/Report/searchPgGroup?');
	  $sgmnt      = "4";
	  $showEntries= 10;
      $totalData  = $this->model_report->count_seventy_two($pagination['per_page'],$pagination['page'],$this->input->get());
      if($_GET['entries']!=""){
         $showEntries = $_GET['entries'];
         $url     = site_url('/report/Report/searchPgGroup?entries='.$_GET['entries']);
      }
     $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
  
    
     $data=$this->user_function();      // call permission fnctn
     $data['dataConfig']        = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
     $data['pagination']        = $this->pagination->create_links();
	 
	 if($this->input->get('filter') == 'filter')   ////filter start ////
        	$data['result'] = $this->model_report->filterSeventyTwoList($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_report->getSeventyTwo($pagination['per_page'],$pagination['page']);
			
     return $data;

}

//===============================All Location=====================

public function export_location_all()
{
	$this->load->view('excel/export-location-all');
}

function searchLocation() 
{
    if($this->session->userdata('is_logged_in'))
	{
		$data = $this->Manage_All_Location();
    	$this->load->view('location-report', $data);
	}
	else
	{
		redirect('index');
	}
}

function Manage_All_Location()
{

  	  $data['result'] = "";
	  $table_name  = 'tbl_product_serial';
	  //$url        = site_url('/report/Report/searchLocation?');
	  $sgmnt      = "4";
	 
	  if($_GET['entries'] != '')
	  {
	  	$showEntries = $_GET['entries'];
	  }
	  else
	  {
	  	$showEntries= 10;
	  }
     
	  $totalData  = $this->model_report->count_location($pagination['per_page'],$pagination['page'],$this->input->get());
      
	  if($_GET['entries'] != '' && $_GET['filter'] != 'filter')
	  {
         //$showEntries = $_GET['entries'];
         $url = site_url('/report/Report/searchLocation?entries='.$_GET['entries']);
      }
	  elseif($_GET['filter'] == 'filter' || $_GET['entries'] != '')
	  {
	  	$url = site_url('/report/Report/searchLocation?p_name='.$_GET['p_name'].'&sku_no='.$_GET['sku_no'].'&main_location='.$_GET['main_location'].'&location='.$_GET['location'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
	  }
	  else
	  {
	  	$url = site_url('/report/Report/searchLocation?');
	  }
     
	 $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
   
     $data=$this->user_function(); 
     $data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
     $data['pagination'] = $this->pagination->create_links();
	 
	 if($this->input->get('filter') == 'filter')
        	$data['result'] = $this->model_report->filterLocationList($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_report->getLocation($pagination['per_page'],$pagination['page']);
			
     return $data;

}

//===================================Location Fresh============================

public function export_location_fresh()
{
	$this->load->view('excel/export-location-fresh');
}

function searchLocationFresh() 
{

    if($this->session->userdata('is_logged_in'))
	{
		$data = $this->Manage_Fresh_Location();
    	$this->load->view('location-fresh-report', $data);
	}
	else
	{
		redirect('index');
	}

}

function Manage_Fresh_Location()
{

  	  $data['result'] = "";
	  $table_name  = 'tbl_product_serial';
	  //$url        = site_url('/report/Report/searchLocationFresh?');
	  $sgmnt      = "4";
	  
	  if($_GET['entries'] != '')
	  {
	  	$showEntries = $_GET['entries'];
	  }
	  else
	  {
	  	$showEntries= 10;
	  }
      
	  $totalData  = $this->model_report->count_location_fresh($pagination['per_page'],$pagination['page'],$this->input->get());
      
	  if($_GET['entries'] != '' && $_GET['filter'] != 'filter')
	  {
         $url = site_url('/report/Report/searchLocationFresh?entries='.$_GET['entries']);
      }
	  elseif($_GET['filter'] == 'filter' || $_GET['entries'] != '')
	  {
	  	$url = site_url('/report/Report/searchLocationFresh?p_name='.$_GET['p_name'].'&sku_no='.$_GET['sku_no'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
	  }
	  else
	  {
	  	$url = site_url('/report/Report/searchLocationFresh?');
	  }
     
	  $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
      
      $data=$this->user_function(); 
      $data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
      $data['pagination'] = $this->pagination->create_links();
	 
	  if($this->input->get('filter') == 'filter') 
        	$data['result'] = $this->model_report->filterLocationFreshList($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_report->getLocationFresh($pagination['per_page'],$pagination['page']);
			
      return $data;

}

//=====================================Location Dell Pallet==============

public function export_location_delPallet()
{
	$this->load->view('excel/export-location-delpallet');
}

function searchLocationDellPallet() 
{

    if($this->session->userdata('is_logged_in'))
	{
		$data = $this->Manage_Location_DellPallet();
    	$this->load->view('location-del-pallet-report', $data);
	}
	else
	{
		redirect('index');
	}
	
}

function Manage_Location_DellPallet()
{

  	  $data['result'] = "";
	  $table_name  = 'tbl_product_serial';
	  //$url        = site_url('/report/Report/searchLocationDellPallet?');
	  $sgmnt      = "4";
	  
	  if($_GET['entries'] != '')
	  {
	  	$showEntries = $_GET['entries'];
	  }
	  else
	  {
	  	$showEntries= 10;
	  }
      
	  $totalData  = $this->model_report->count_location_dellPallet($pagination['per_page'],$pagination['page'],$this->input->get());
      
	  if($_GET['entries'] != '' && $_GET['filter'] != 'filter')
	  {
         $url = site_url('/report/Report/searchLocationDellPallet?entries='.$_GET['entries']);
      }
	  elseif($_GET['filter'] == 'filter' || $_GET['entries'] != '')
	  {
	  	$url = site_url('/report/Report/searchLocationDellPallet?p_name='.$_GET['p_name'].'&sku_no='.$_GET['sku_no'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
	  }
	  else
	  {
	  	$url = site_url('/report/Report/searchLocationDellPallet?');
	  }
     
	  $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
  
    
      $data=$this->user_function();      // call permission fnctn
      $data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
      $data['pagination'] = $this->pagination->create_links();
	 
	  if($this->input->get('filter') == 'filter')   ////filter start ////
        	$data['result'] = $this->model_report->filterLocationDellPalletList($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_report->getLocationDellPallet($pagination['per_page'],$pagination['page']);
			
      return $data;

}

//===========================Location Demo=============

public function export_location_demo()
{
	$this->load->view('excel/export-location-demo');
}

function searchLocationDemo() 
{
    if($this->session->userdata('is_logged_in'))
	{
		$data = $this->Manage_Location_Demo();
    	$this->load->view('location-demo-report', $data);
	}
	else
	{
		redirect('index');
	}
}

function Manage_Location_Demo()
{

  	  $data['result'] = "";
	  $table_name  = 'tbl_product_serial';
	  //$url        = site_url('/report/Report/searchLocationDemo?');
	  $sgmnt      = "4";
	  
	  if($_GET['entries'] != '')
	  {
	  	$showEntries = $_GET['entries'];
	  }
	  else
	  {
	  	$showEntries= 10;
	  }
      
	  $totalData  = $this->model_report->count_location_demo($pagination['per_page'],$pagination['page'],$this->input->get());
      
	  if($_GET['entries'] != '' && $_GET['filter'] != 'filter')
	  {
         $url = site_url('/report/Report/searchLocationDemo?entries='.$_GET['entries']);
      }
	  elseif($_GET['filter'] == 'filter' || $_GET['entries'] != '')
	  {
	  	$url = site_url('/report/Report/searchLocationDemo?p_name='.$_GET['p_name'].'&sku_no='.$_GET['sku_no'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
	  }
	  else
	  {
	  	$url = site_url('/report/Report/searchLocationDemo?');
	  }
      
	  $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
  
      $data=$this->user_function();      // call permission fnctn
      $data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
      $data['pagination'] = $this->pagination->create_links();
	 
	  if($this->input->get('filter') == 'filter')   ////filter start ////
        	$data['result'] = $this->model_report->filterLocationDemoList($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_report->getLocationDemo($pagination['per_page'],$pagination['page']);
			
     return $data;

}

//===========================Location Block============

function export_location_block()
{
	$this->load->view('excel/export-location-block');
}

function searchLocationBlock() 
{

    if($this->session->userdata('is_logged_in'))
	{
		$data = $this->Manage_Location_Block();
    	$this->load->view('location-block-report', $data);
	}
	else
	{
		redirect('index');
	}
}

function Manage_Location_Block()
{

  	  $data['result'] = "";
	  $table_name  = 'tbl_product_serial';
	  //$url        = site_url('/report/Report/searchLocationBlock?');
	  $sgmnt      = "4";
	  
	  if($_GET['entries'] != '')
	  {
	  	$showEntries = $_GET['entries'];
	  }
	  else
	  {
	  	$showEntries= 10;
	  }
      
	  $totalData  = $this->model_report->count_location_block($pagination['per_page'],$pagination['page'],$this->input->get());
      
	  if($_GET['entries'] != '' && $_GET['filter'] != 'filter')
	  {
         $url = site_url('/report/Report/searchLocationBlock?entries='.$_GET['entries']);
      }
	  elseif($_GET['filter'] == 'filter' || $_GET['entries'] != '')
	  {
	  	$url = site_url('/report/Report/searchLocationBlock?p_name='.$_GET['p_name'].'&sku_no='.$_GET['sku_no'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
	  }
	  else
	  {
	  	$url = site_url('/report/Report/searchLocationBlock?');
	  }
     
	 $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
  
     $data=$this->user_function();      // call permission fnctn
     $data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
     $data['pagination'] = $this->pagination->create_links();
	 
	 if($this->input->get('filter') == 'filter')   ////filter start ////
        	$data['result'] = $this->model_report->filterLocationBlockList($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_report->getLocationBlock($pagination['per_page'],$pagination['page']);
			
     return $data;

}


//==================Location SRN==============

public function export_location_srn()
{
	$this->load->view('excel/export-location-srn');
}

function searchLocationSRN() 
{

    if($this->session->userdata('is_logged_in'))
	{
		$data = $this->Manage_Location_SRN();
    	$this->load->view('location-srn-report', $data);
	}
	else
	{
		redirect('index');
	}
	
}

function Manage_Location_SRN()
{

  	  $data['result'] = "";
	  $table_name  = 'tbl_product_serial';
	  //$url        = site_url('/report/Report/searchLocationSRN?');
	  $sgmnt      = "4";
	  
	  if($_GET['entries'] != '')
	  {
	  	$showEntries = $_GET['entries'];
	  }
	  else
	  {
	  	$showEntries= 10;
	  }
      
	  $totalData  = $this->model_report->count_location_srn($pagination['per_page'],$pagination['page'],$this->input->get());
      
	  if($_GET['entries'] != '' && $_GET['filter'] != 'filter')
	  {
         $url = site_url('/report/Report/searchLocationSRN?entries='.$_GET['entries']);
      }
	  elseif($_GET['filter'] == 'filter' || $_GET['entries'] != '')
	  {
	  	$url = site_url('/report/Report/searchLocationSRN?p_name='.$_GET['p_name'].'&sku_no='.$_GET['sku_no'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
	  }
	  else
	  {
	  	$url = site_url('/report/Report/searchLocationSRN?');
	  }
      
	  $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
  
      $data=$this->user_function();      // call permission fnctn
      $data['dataConfig']        = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
      $data['pagination']        = $this->pagination->create_links();
	 
	  if($this->input->get('filter') == 'filter')   ////filter start ////
        	$data['result'] = $this->model_report->filterLocationSrnList($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_report->getLocationSRN($pagination['per_page'],$pagination['page']);
			
     return $data;

}

//====================Location Service=====================


public function export_location_service()
{
	$this->load->view('excel/export-location-service');
}

function searchLocationService() 
{

    if($this->session->userdata('is_logged_in'))
	{
		$data = $this->Manage_Location_Service();
    	$this->load->view('location-service-report', $data);
	}
	else
	{
		redirect('index');
	}
}

function Manage_Location_Service()
{

  	  $data['result'] = "";
	  $table_name  = 'tbl_product_serial';
	  //$url        = site_url('/report/Report/searchLocationService?');
	  $sgmnt      = "4";
	  
	  if($_GET['entries'] != '')
	  {
	  	$showEntries = $_GET['entries'];
	  }
	  else
	  {
	  	$showEntries= 10;
	  }
      
	  $totalData  = $this->model_report->count_location_service($pagination['per_page'],$pagination['page'],$this->input->get());
      
	  if($_GET['entries'] != '' && $_GET['filter'] != 'filter')
	  {
         $url = site_url('/report/Report/searchLocationService?entries='.$_GET['entries']);
      }
	  elseif($_GET['filter'] == 'filter' || $_GET['entries'] != '')
	  {
	  	$url = site_url('/report/Report/searchLocationService?p_name='.$_GET['p_name'].'&sku_no='.$_GET['sku_no'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
	  }
	  else
	  {
	  	$url = site_url('/report/Report/searchLocationService?');
	  }
      
	  $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
  
      $data=$this->user_function();      // call permission fnctn
      $data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
      $data['pagination'] = $this->pagination->create_links();
	 
	  if($this->input->get('filter') == 'filter')   ////filter start ////
        	$data['result'] = $this->model_report->filterLocationServiceList($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_report->getLocationService($pagination['per_page'],$pagination['page']);
			
     return $data;

}

//========================Location MKT FOC======================

public function export_location_mkt_foc()
{
	$this->load->view('excel/export-location-mkt-foc');
}

function searchLocationMkt() 
{

    if($this->session->userdata('is_logged_in'))
	{
		$data = $this->Manage_Location_MktFoc();
    	$this->load->view('location-mkt-report', $data);
	}
	else
	{
		redirect('index');
	}
	
}

function Manage_Location_MktFoc()
{

  	  $data['result'] = "";
	  $table_name  = 'tbl_product_serial';
	  //$url        = site_url('/report/Report/searchLocationMkt?');
	  $sgmnt      = "4";
	  
	  $showEntries= 10;
      
	  $totalData  = $this->model_report->count_location_mkt($pagination['per_page'],$pagination['page'],$this->input->get());
      
	  if($_GET['entries'] != '' && $_GET['filter'] != 'filter')
	  {
         $url = site_url('/report/Report/searchLocationMkt?entries='.$_GET['entries']);
      }
	  elseif($_GET['filter'] == 'filter' || $_GET['entries'] != '')
	  {
	  	$url = site_url('/report/Report/searchLocationMkt?p_name='.$_GET['p_name'].'&sku_no='.$_GET['sku_no'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
	  }
	  else
	  {
	  	$url = site_url('/report/Report/searchLocationMkt?');
	  }
	  
      $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
      
      $data=$this->user_function();      // call permission fnctn
      $data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
      $data['pagination'] = $this->pagination->create_links();
	 
	  if($this->input->get('filter') == 'filter')   ////filter start ////
        	$data['result'] = $this->model_report->filterLocationMktFocList($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_report->getLocationMktFoc($pagination['per_page'],$pagination['page']);
			
     return $data;

}

//=======================Location Brouchure======================

public function export_location_brochure()
{
	$this->load->view('excel/export-location-brochure');
}

function searchLocationBrochure() 
{

    if($this->session->userdata('is_logged_in'))
	{
		$data = $this->Manage_Location_Brochure();
    	$this->load->view('location-brochure-report', $data);
	}
	else
	{
		redirect('index');
	}

}

function Manage_Location_Brochure()
{

  	  $data['result'] = "";
	  $table_name  = 'tbl_product_serial';
	  //$url        = site_url('/report/Report/searchLocationBrochure?');
	  $sgmnt      = "4";
	  
	  if($_GET['entries'] != '')
	  {
	  	$showEntries = $_GET['entries'];
	  }
	  else
	  {
	  	$showEntries= 10;
	  }
      
	  $totalData  = $this->model_report->count_location_brochure($pagination['per_page'],$pagination['page'],$this->input->get());
      
	  if($_GET['entries'] != '' && $_GET['filter'] != 'filter')
	  {
         $url = site_url('/report/Report/searchLocationBrochure?entries='.$_GET['entries']);
      }
	  elseif($_GET['filter'] == 'filter' || $_GET['entries'] != '')
	  {
	  	$url = site_url('/report/Report/searchLocationBrochure?p_name='.$_GET['p_name'].'&sku_no='.$_GET['sku_no'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
	  }
	  else
	  {
	  	$url = site_url('/report/Report/searchLocationBrochure?');
	  }
      
	  $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
  
    
      $data=$this->user_function();      // call permission fnctn
      $data['dataConfig']        = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
      $data['pagination']        = $this->pagination->create_links();
	 
	  if($this->input->get('filter') == 'filter')   ////filter start ////
        	$data['result'] = $this->model_report->filterLocationBrochureList($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_report->getLocationBrochure($pagination['per_page'],$pagination['page']);
			
      return $data;

}


//===========================Location RGP===================

public function export_location_rgp()
{
	$this->load->view('excel/export-location-rgp');
}

function searchLocationRgp() 
{
    if($this->session->userdata('is_logged_in'))
	{
		$data = $this->Manage_Location_Rgp();
    	$this->load->view('location-rgp-report', $data);
	}
	else
	{
		redirect('index');
	}
}

function Manage_Location_Rgp()
{

  	  $data['result'] = "";
	  $table_name  = 'tbl_return_dtl';
	  //$url        = site_url('/report/Report/searchLocationRgp?');
	  $sgmnt      = "4";
	  
	  if($_GET['entries'] != '')
	  {
	  	$showEntries = $_GET['entries'];
	  }
	  else
	  {
	  	$showEntries= 10;
	  }
      
	  $totalData  = $this->model_report->count_location_rgp($pagination['per_page'],$pagination['page'],$this->input->get());
      
	  if($_GET['entries'] != '' && $_GET['filter'] != 'filter')
	  {
         $url = site_url('/report/Report/searchLocationRgp?entries='.$_GET['entries']);
      }
	  elseif($_GET['filter'] == 'filter' || $_GET['entries'] != '')
	  {
	  	$url = site_url('/report/Report/searchLocationRgp?p_name='.$_GET['p_name'].'&sku_no='.$_GET['sku_no'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
	  }
	  else
	  {
	  	$url = site_url('/report/Report/searchLocationRgp?');
	  }
      
	  $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
     
      $data=$this->user_function();      // call permission fnctn
      $data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
      $data['pagination'] = $this->pagination->create_links();
	 
	  if($this->input->get('filter') == 'filter')   ////filter start ////
        	$data['result'] = $this->model_report->filterLocationRgpList($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_report->getLocationRgp($pagination['per_page'],$pagination['page']);
			
     return $data;

}


//==================End===============================

function searchPaymentReport() {
		extract($_POST);
    if($this->session->userdata('is_logged_in')){
	$postlist['totalSearchPayment'] = $this->model_report->getSearchPayment($contactid,$payment_mode);
    $this->load->view('payment-report', $postlist);
	}
	else
	{
	redirect('index');
	}
}

function searchPaymentReceivedReport(){
		extract($_POST);
    if($this->session->userdata('is_logged_in')){
	$postlist['SearchPaymentReceived'] = $this->model_report->getSearchPaymentReceived($contactid,$payment_mode);
    $this->load->view('payment-received-report', $postlist);
	}
	else
	{
	redirect('index');
	}
}

//===================================Product Stock Summery==============================

function searchProductStockSummery() {
		extract($_POST);
    if($this->session->userdata('is_logged_in')){
	//$postlist['searchProductStockSummery'] = $this->model_report->geTSearchProductStockSummery($p_name,$p_code);
	$data = $this->ProductStockSummery_Data();
    $this->load->view('product-stock-summery-report', $data);
	}
	else
	{
	redirect('index');
	}
}

public function ProductStockSummery_Data(){

  	 $data['result'] = "";
	  $table_name  = 'tbl_product_serial_log';
	  $url        = site_url('/report/Report/searchProductStockSummery?');
	  $sgmnt      = "4";
	  $showEntries= 10;
      $totalData  = $this->model_report->count_stock($pagination['per_page'],$pagination['page'],$this->input->get());
      if($_GET['entries']!=""){
         $showEntries = $_GET['entries'];
         $url     = site_url('/report/Report/searchProductStockSummery?entries='.$_GET['entries']);
      }
     $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
  
    
     $data=$this->user_function();      // call permission fnctn
     $data['dataConfig']        = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
     $data['pagination']        = $this->pagination->create_links();
	 
	 if($this->input->get('filter') == 'filter')   ////filter start ////
        	$data['result']       = $this->model_report->filterStockList($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_report->getStockSummery($pagination['per_page'],$pagination['page']);
			
     return $data;
}

//=======================================End====================================

function searchPurchaseOrder() {
		extract($_POST);
    if($this->session->userdata('is_logged_in')){
	$postlist['purchaseOrderSearch'] = $this->model_report->getSearchPurchaseOrder($p_no,$v_name,$f_date,$t_date,$g_total);
    $this->load->view('add-purchaseorder-report', $postlist);
	}
	else
	{
	redirect('index');
	}
}	

function searchSalesOrder() {
		extract($_POST);
    if($this->session->userdata('is_logged_in')){
	$postlist['saleOrderSearch'] = $this->model_report->getSearchSaleOrder($p_no,$v_name,$f_date,$t_date,$g_total);
    $this->load->view('add-saleorder-report', $postlist);
	}
	else
	{
	redirect('index');
	}
}

//===============================Import Compliance==================

function export_import_compliance()
{
	$this->load->view('excel/export-import-compliance');
}

function searchImportCompliance() 
{

    if($this->session->userdata('is_logged_in'))
	{
		$data = $this->ManageImportCompliance();
    	$this->load->view('add-import-compliance',$data);
	}
	else
	{
		redirect('index');
	}
}

public function ManageImportCompliance()
{

   	  $data['result'] = "";
	  $table_name  = 'tbl_stock_in_dtl';
	  //$url        = site_url('/report/Report/searchImportCompliance?');
	  $sgmnt      = "4";
	  
	  if($_GET['entries'] != '')
	  {
	  	$showEntries = $_GET['entries'];
	  }
	  else
	  {
	  	$showEntries= 10;
	  }
      
	  $totalData  = $this->model_report->count_import_compliance($pagination['per_page'],$pagination['page'],$this->input->get());
      
	  if($_GET['entries'] != '' && $_GET['filter'] != 'filter')
	  {
         $url = site_url('/report/Report/searchImportCompliance?entries='.$_GET['entries']);
      }
	  elseif($_GET['filter'] == 'filter' || $_GET['entries'] != '')
	  {
	  	$url = site_url('/report/Report/searchImportCompliance?control_no='.$_GET['control_no'].'&mawb_no='.$_GET['mawb_no'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
	  }
	  else
	  {
	  	$url = site_url('/report/Report/searchImportCompliance?');
	  }
      
	  $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
  
      $data=$this->user_function();      // call permission fnctn
      $data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
      $data['pagination'] = $this->pagination->create_links();
	 
	  if($this->input->get('filter') == 'filter')   ////filter start ////
        	$data['result'] = $this->model_report->filterImportCompliance($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_report->getImportCompliance($pagination['per_page'],$pagination['page']);
			
      return $data;
	  
}

//=============================End================

public function run()
{

$this->load->library('email');
$this->email->initialize(array(
  'protocol' => 'smtp',
  'smtp_host' => '103.211.216.225',
  'smtp_user' => 'info@asnlog.com',
  'smtp_pass' => 'info@123#',
  'smtp_port' => 587,
  'mailtype' => 'html',
		'charset' => 'utf-8',
		'wordwrap' => TRUE
));
		
		
		$this->email->from('info@asnlog.com',"sk");
		$this->email->to("collestbablu@gmail.com");
		
		 $sub='testing';
		$this->email->subject("hello");
		
		$this->email->message("hi welcome");
		$this->email->send();	
}




//=================================Complete Stock Of BLR==========

function export_complete_stock_of_blr()
{
	$this->load->view('excel/export-complete-stock-blr');
}

function searchCompleteStockBLR() 
{
   
	if($this->session->userdata('is_logged_in'))
	{
		$data = $this->CompleteStockBLR_Data();
    	$this->load->view('complete-stock-of-blr', $data);
	}
	else
	{
		redirect('index');
	}
}

public function CompleteStockBLR_Data()
{

  	  $data['result'] = "";
	  $table_name  = 'tbl_product_stock';
	  //$url        = site_url('/report/Report/searchCompleteStockBLR?');
	  $sgmnt      = "4";
	  
	  if($_GET['entries'] != '')
	  {
	  	$showEntries = $_GET['entries'];
	  }
	  else
	  {
	  	$showEntries= 10;
	  }
      
	  $totalData  = $this->model_report->count_complete_stock($pagination['per_page'],$pagination['page'],$this->input->get());
      
	  if($_GET['entries'] != '' && $_GET['filter'] != 'filter')
	  {
         $url = site_url('/report/Report/searchCompleteStockBLR?entries='.$_GET['entries']);
      }
	  elseif($_GET['filter'] == 'filter' || $_GET['entries'] != '')
	  {
	  	$url = site_url('/report/Report/searchCompleteStockBLR?p_name='.$_GET['p_name'].'&sku_no='.$_GET['sku_no'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
	  }
	  else
	  {
	  	$url = site_url('/report/Report/searchCompleteStockBLR?');
	  }
      
	  $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
  
      $data=$this->user_function();      // call permission fnctn
      $data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
      $data['pagination'] = $this->pagination->create_links();
	 
	  if($this->input->get('filter') == 'filter')   ////filter start ////
        	$data['result'] = $this->model_report->filterCompleteStock($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_report->getCompleteStock($pagination['per_page'],$pagination['page']);
			
     return $data;
	 
}


//===============================Consumer Stock report of blr======================

function export_consumer_stock_blr()
{
	$this->load->view('excel/export-consumer-stock-blr');
}

function searchConsumerBLRStock() 
{

	if($this->session->userdata('is_logged_in'))
	{
		$data = $this->ConsumerStock_Data();
    	$this->load->view('consumer-stock-report-blr', $data);
	}
	else
	{
		redirect('index');
	}
}

public function ConsumerBLRStock_Data()
{

  	  $data['result'] = "";
	  $table_name  = 'tbl_product_stock';
	  //$url        = site_url('/report/Report/searchConsumerBLRStock?');
	  $sgmnt      = "4";
	  
	  if($_GET['entries'] != '')
	  {
	  	$showEntries = $_GET['entries'];
	  }
	  else
	  {
	  	$showEntries= 10;
	  }
      
	  $totalData  = $this->model_report->count_consumer_stock($pagination['per_page'],$pagination['page'],$this->input->get());
      
	  if($_GET['entries'] != '' && $_GET['filter'] != 'filter')
	  {
         $url = site_url('/report/Report/searchConsumerBLRStock?entries='.$_GET['entries']);
      }
	  elseif($_GET['filter'] == 'filter' || $_GET['entries'] != '')
	  {
	  	$url = site_url('/report/Report/searchConsumerBLRStock?p_name='.$_GET['p_name'].'&sku_no='.$_GET['sku_no'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
	  }
	  else
	  {
	  	$url = site_url('/report/Report/searchConsumerBLRStock?');
	  }
      
	  $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
  
      $data=$this->user_function();      // call permission fnctn
      $data['dataConfig']        = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
      $data['pagination']        = $this->pagination->create_links();
	 
	  if($this->input->get('filter') == 'filter')   ////filter start ////
        	$data['result']       = $this->model_report->filterConsumerStock($pagination['per_page'],$pagination['page'],$this->input->get());
          	else	
    		$data['result'] = $this->model_report->getConsumerStock($pagination['per_page'],$pagination['page']);
			
     return $data;
	 
}





//=======================Professional Stock of BLR====================

function export_professional_stock_blr()
{
	$this->load->view('excel/export-professional-stock-blr');
}

function searchProfessionalBLRStock() 
{
    
  if($this->session->userdata('is_logged_in'))
  {
   	 $data = $this->Professional_Stock_BLR_Data();
     $this->load->view('professional-stock-blr-report', $data);
  }
  else
  {
   	 redirect('index');
  }
}

public function Professional_Stock_BLR_Data()
{

     $data['result'] = "";
     $table_name  = 'tbl_product_stock';
     //$url        = site_url('/report/Report/searchProfessionalBLRStock?');
     $sgmnt      = "4";
     
	  if($_GET['entries'] != '')
	  {
	  	$showEntries = $_GET['entries'];
	  }
	  else
	  {
	  	$showEntries= 10;
	  }
     
	 $totalData  = $this->model_report->count_professional_stock($pagination['per_page'],$pagination['page'],$this->input->get());
     
	 if($_GET['entries'] != '' && $_GET['filter'] != 'filter')
	  {
         $url = site_url('/report/Report/searchProfessionalBLRStock?entries='.$_GET['entries']);
      }
	  elseif($_GET['filter'] == 'filter' || $_GET['entries'] != '')
	  {
	  	$url = site_url('/report/Report/searchProfessionalBLRStock?p_name='.$_GET['p_name'].'&sku_no='.$_GET['sku_no'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
	  }
	  else
	  {
	  	$url = site_url('/report/Report/searchProfessionalBLRStock?');
	  }
     
	 $pagination = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
  
     $data=$this->user_function();      // call permission fnctn
     $data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
     $data['pagination'] = $this->pagination->create_links();
   
     if($this->input->get('filter') == 'filter')   ////filter start ////
          $data['result'] = $this->model_report->filterProfessionalStock($pagination['per_page'],$pagination['page'],$this->input->get());
     else  
        $data['result'] = $this->model_report->getProfessionalStock($pagination['per_page'],$pagination['page']);
      
     return $data;
	 
}





//=============================PG GROUP 72 BLR====================

function export_pg_group_blr()
{
	$this->load->view('excel/export-pg-group-blr');
}

function searchPgGroup72blr() 
{
    
  if($this->session->userdata('is_logged_in'))
  {
   	 $data = $this->PgGroup72blr_Data();
     $this->load->view('pg-group-72blr', $data);
  }
  else
  {
   	 redirect('index');
  }
  
}

public function PgGroup72blr_Data()
{

    $data['result'] = "";
    $table_name  = 'tbl_product_stock';
    //$url        = site_url('/report/Report/searchPgGroup72blr?');
    $sgmnt      = "4";
    
	 if($_GET['entries'] != '')
	  {
	  	$showEntries = $_GET['entries'];
	  }
	  else
	  {
	  	$showEntries= 10;
	  }
    
	$totalData  = $this->model_report->count_pg_group($pagination['per_page'],$pagination['page'],$this->input->get());
    
	if($_GET['entries'] != '' && $_GET['filter'] != 'filter')
	  {
         $url = site_url('/report/Report/searchPgGroup72blr?entries='.$_GET['entries']);
      }
	  elseif($_GET['filter'] == 'filter' || $_GET['entries'] != '')
	  {
	  	$url = site_url('/report/Report/searchPgGroup72blr?p_name='.$_GET['p_name'].'&sku_no='.$_GET['sku_no'].'&filter='.$_GET['filter'].'&entries='.$_GET['entries']);
	  }
	  else
	  {
	  	$url = site_url('/report/Report/searchPgGroup72blr?');
	  }
	  
    $pagination   = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
  
    $data=$this->user_function();      // call permission fnctn
    $data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
    $data['pagination'] = $this->pagination->create_links();
   
    if($this->input->get('filter') == 'filter')   ////filter start ////
          $data['result'] = $this->model_report->filterPgGroup($pagination['per_page'],$pagination['page'],$this->input->get());
          else  
          $data['result'] = $this->model_report->getPgGroup($pagination['per_page'],$pagination['page']);
      
     return $data;
	 
}







}

?>