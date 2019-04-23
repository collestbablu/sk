<?php
$id=$_GET['id'];
if($id!="")
{
$invice12=$this->db->query("select * from tbl_stock_in_hdr where stockinid='$id'");
$inviceres=$invice12->row();

$fetchrecord=$this->db->query("select * from tbl_contact_m where contact_id='".$inviceres->origin."'");
$fetchrecords=$fetchrecord->row();
 
$fetchcomp=$this->db->query("select * from tbl_contact_m where contact_id='".$fetchrecords->company_id."'");
$fetchcompany=$fetchcomp->row(); 
  
$fetchaddress=$this->db->query("select * from tbl_address_m where entityid='".$inviceres->vendor_id."'");
$fetchaddresss=$fetchaddress->row();


function tax($tax_retail){
if($tax_retail=='retail_invoice') {  $tax="Retail Invoice";  }
if($tax_retail=='tax_invoice') {  $tax="Tax Invoice";  }
if($tax_retail=='normal_invoice') {  $tax="Normal Invoice";  }
if($tax_retail=='performa_invoice') {  $tax="Performa Invoice";  }
if($tax_retail=='delivery_invoice') {  $tax="Delivery Invoice";  }
if($tax_retail=='sale_invoice') {  $tax="Sale Invoice";  }
return $tax;
}


function getSingleResult($sql){
 	$ci =& get_instance();
	$class = $ci->db->query($sql);
    $class = $class->result_array();
    $ac =$class->keyvalue;
	return $ac;
}



function words_repues($num)
{ 
  $numberF=$num;
   $action34=explode(".",$numberF);
$balance10=$action34[0];
   $balance11=$action34[1];
   $no = $balance10;
   $point = $balance11;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? '' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    " " . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
   strtoupper($result . "Rupees " . $points . " Paise");
      $grandexplode=number_format((float)$num, 2, '.', '');
 	  $action23=explode(".",$grandexplode);
	  $groundA=$action23[0];
	  $groundV=$action23[1];	
	if($groundV >=1 ){
	$goundStr=strtoupper($result . "Rupees and" . $points . " Paise");
			
	}else{
		  $goundStr=strtoupper($result . "Rupees");
	}	
	 return $goundStr;
	}
}

?>  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<title>MRN</title>
<link rel='stylesheet' type='text/css' href='<?=base_url();?>assets/mrn_print_css/css/style.css' />
</head>

<body>

<div id="page-wrap">
<div id="header">
<h2>MATERIAL RECEIVED NOTE</h2>
<h3>(PHYSICALLY RECD AT W/H)</h3>
</div>		
		
<div id="customer">
<div id="customer-left">
<?php echo $fetchrecords->first_name." ".$fetchrecords->middle_name." ".$fetchrecords->last_name;?><br>
Address: <br>
<?php  
  $newout= array();
echo  $outtext=  $fetchrecords->address1;
echo "<br/>";
	//echo  $outtext1=  $fetchaddresss->address3;
?>
Assesseable value : <br />
Exchange rate <?=$inviceres->exchange_rate;?>
</div>

<table id="meta-right">
<tr>
<td>Date</td>
<td><?=$inviceres->date;?></td>
</tr>
<tr>

<td>Received At </td>
<td><?=$inviceres->date;?></td>
</tr>
<tr>
<td>BOE NO. & DATE:</td>
<td><?=$inviceres->boe_no;?> / <?=$inviceres->boe_date;?></td>
</tr>
<tr>
<td>INVOICE NO</td>
<td><?=$inviceres->invoice_no;?> / <?=$inviceres->invoice_date;?></td>
</tr>
<tr>
<td>PO NO : </td>
<td><?=$inviceres->order_no;?></td>
</tr>
<tr>
<td>DATE</td>
<td><?=$inviceres->order_date;?></td>
</tr>
<tr>
<td>HAWB NO.</td>
<td><?=$inviceres->hawb;?></td>
</tr>
<tr>
<td>CONTROL NO:</td>
<td>DEL1700178</td>
</tr>
</table>
</div>
		
<table id="items">
<tr>
<th>Sr. No.</th>
<th>PRODUCT CODE</th>
<th>DESCRIPTION</th>
<th>UNIT PRICE (FC)</th>
<th>QTY INVOICED</th>
<th>TOTAL PRICE (FC) USD/EURO</th>
<th>UNIT PRICE (INR)</th>
<th>QTY RECD.</th>
<th>TOTAL PRICE (INR)</th>
<th>DIFFERENCE QUANTITY</th>
<th>NETT DIFF. IN INVOICE ($)</th>
</tr>
<?php
extract($_POST);
$n=1;
$inviceQ=$this->db->query("select * from tbl_stock_in_dtl where stockinhdr='$id'");
foreach($inviceQ->result() as $invoiceFetch){

$productQ=$this->db->query("select *from tbl_product_stock where Product_id='$invoiceFetch->product_id'");

$pfetch=$productQ->row();
@extract($invoiceFetch);

//this query for geting usage unit form tbl_master_data

$productQ1=$this->db->query("select *from tbl_master_data where serial_number ='$pfetch->usageunit'");

$pfetch1=$productQ1->row();


?>
<tr>
<td><?=$n;?></td>
<td><?php echo $pfetch->sku_no;?></td>
<td><?php echo $pfetch->productname;?></td>
<td><?php echo $pfetch1->keyvalue;?></td>
<td><?php echo $invoiceFetch->quantity;?></td>
<td><?php echo $invoiceFetch->list_price;?></td>
<td><?php echo $invoiceFetch->list_price;?></td>
<td><?=$invoiceFetch->discount?></td>
<td><?php echo $invoiceFetch->net_price;?></td>
<td><?php echo $invoiceFetch->discount_amount;?></td>
<td><?php echo $invoiceFetch->list_price*$invoiceFetch->discount_amount;?></td>
</tr>

<?php $qtySum= $qtySum+$invoiceFetch->quantity;
?>
<?php $listPSum=$listPSum+$invoiceFetch->list_price;?>
<?php $netSum=$netSum+$invoiceFetch->net_price;?>

<?php $recdSum=$recdSum+$invoiceFetch->discount;?>
<?php $difSum=$difSum+$invoiceFetch->discount_amount;?>

<?php $diffInv=$diffInv+$invoiceFetch->list_price*$invoiceFetch->discount_amount;?>


<?php  $n++;}?>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><?=$qtySum;?></td>
<td><?=$listPSum;?></td>
<td>&nbsp;</td>
<td><?=$recdSum;?></td>
<td><?=$netSum;?></td>
<td><?=$difSum;?></td>
<td>
<?php echo $diffInv;?></td>
</tr>
<tr>
<td colspan="2">DISCREPANCY ACTION PLAN</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td colspan="4">CHECKED BY NAME &amp; SIGNATURE</td>
<td>&nbsp;</td>
<td>VALUE IMPACT</td>
</tr>
<tr>
<td colspan="2">CHECKED BY</td>
<td colspan="8">&nbsp;</td>
<td>CHECKED BY</td>
</tr>

</table>


		
		
	
</div>	
</body>

</html>