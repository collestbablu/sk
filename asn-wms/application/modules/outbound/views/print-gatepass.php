<?php
$id=$_GET['id'];
if($id!="")
{
$invice12=$this->db->query("select * from tbl_stock_out_hdr where stockoutid='$id'");
$inviceres=$invice12->row();

$fetchrecord=$this->db->query("select * from tbl_contact_m where code='".$inviceres->contact_id."'");
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

<title>Gate Pass Print</title>


<link rel='stylesheet' type='text/css' href='<?=base_url();?>assets/gatepass_print_css/css/style.css' />
</head>

<body>

<div id="page-wrap">
<table id="items">
<tbody>
<tr>
<td colspan="13" class="blank" align="center"><img src="<?=base_url();?>assets/gatepass_print_css/images/logo.jpg" alt="" /></td>
</tr>

<tr>
<td colspan="13" class="blank" align="center">
 <h1>DELIVERY CHALLAN</h1> 
 <h3>Original for Recipient<br /> Duplicate for Transporter<br /> Triplicate for Supplier</h3> </td>
</tr>


<tr>
  <td colspan="13" class="blank">  </td>
</tr>

<tr class="tr-t">
<td colspan="5" class="td-r"><strong>Detail of Consigner </strong></td>
<td colspan="4">&nbsp;</td>
<td colspan="4">&nbsp;</td>
</tr>

<tr>
<td colspan="5" class="td-r"><strong>Sennheiser Electronics India Pvt. Ltd. </strong></td>
<td colspan="4"><strong>Ref. NO.</strong></td>
<td colspan="4"><strong><?=$inviceres->order_no;?></strong></td>
</tr>

<tr>
<td colspan="5" class="td-r"><strong>C/O Geodis Overseas Private Limited</strong></td>
<td colspan="4"><strong>MKT OUT NO.</strong></td>
<td colspan="4"><strong>: <?=$inviceres->invoice_no;?></strong></td>
</tr>

<tr>
<td colspan="5" class="td-r"><strong>Khasra No 36/1, VPO Bamnoli , Near Pole No 646</strong></td>
<td colspan="4"><strong>Date</strong></td>
<td colspan="4"><strong>: <?=$inviceres->date;?></strong></td>
</tr>

<tr>
<td colspan="5" class="td-r"><strong>Main Bijwasan Road, New Delhi-110075.</strong></td>
<td colspan="4"><strong>Mode of Transport</strong></td>
<td colspan="4"><strong>: Courier</strong></td>
</tr>

<tr class="tr-t tr-b-">
<td colspan="5" class="td-r"><strong>Details of Consignee / Jobworker</strong></td>
<td colspan="8">Register Address</td>
</tr>

<tr class="tr-t- tr-b-">
<td colspan="5" class="td-r"><strong><?=$fetchrecords->first_name;?></strong></td>
<td colspan="8">Sennheiser Electronics India Pvt. Ltd.</td>
</tr>

<tr class="tr-t- tr-b-">
<td colspan="5" class="td-r"><strong><?php  
  $newout= array();
echo  $outtext=  $fetchrecords->address1;
echo "<br/>";
	//echo  $outtext1=  $fetchaddresss->address3;
?></strong></td>
<td colspan="8">104-ABC, 1st Floor, Time Tower, M.G Road, Gurgaon-122002. Haryana.</td>
</tr>

<tr class="tr-t- tr-b-">
<td colspan="5" class="td-r"><strong>Phone: <?=$fetchrecords->phone;?></strong></td>
<td colspan="8">Phone: +91 (0) 124 4187800</td>
</tr>

<tr class="tr-t- tr-b-">
<td colspan="5" class="td-r"><strong>&nbsp;&nbsp;</strong></td>
<td colspan="8">Mobile: +91 (0) 9717177319</td>
</tr>

<tr class="tr-t- tr-b-">
<td colspan="5" class="td-r"><strong>&nbsp;</strong></td>
<td colspan="8">CIN-U32106HR2007PTC036535</td>
</tr>

<tr class="tr-t- tr-b">
<td colspan="5" class="td-r"><strong>GSTIN # <?=$fetchrecords->gst;?></strong></td>
<td colspan="8">GSTIN # 06AAKCS4629Q1ZM</td>
</tr>


<tr>
<td colspan="13" class="tr-t tr-b">For the purpose of - MKT OUT</td>
</tr>















<tr id="bg" class="tr-t tr-b">
<td class="td-rl"><strong>S. No.</strong></td>
<td colspan="-2" class="td-rl"><strong>Item Code</strong></td>
<td><strong>Description of Goods</strong></td>
<td class="td-rl"><strong>HSN Code</strong></td>
<td class="td-rl"><strong>Qty.</strong></td>
<td class="td-rl"><strong>Unit Price</strong></td>
<td><strong>Gross Value</strong></td>
<td class="td-rl"><strong>IGST</strong></td>
<td colspan="2" class="td-rl"><strong>Tax Rate</strong></td>
<td class="td-rl"><strong>Tax Amount</strong></td>
<td class="td-rl"><strong>Net Value</strong></td>
</tr>
 <?php
extract($_POST);
$n=1;
$inviceQ=$this->db->query("select * from tbl_stock_out_dtl where stockouthdr='".$_GET['id']."'");
foreach($inviceQ->result() as $invoiceFetch){

$productQ=$this->db->query("select *from tbl_product_stock where Product_id='$invoiceFetch->product_id'");

$pfetch=$productQ->row();
@extract($invoiceFetch);

//this query for geting usage unit form tbl_master_data

$productQ1=$this->db->query("select *from tbl_master_data where serial_number ='$pfetch->usageunit'");

$pfetch1=$productQ1->row();


?>
<tr class="tr-t tr-b">
<td class="td-rl"><?=$n;?></td>
<td colspan="-2" class="td-rl"><?=$pfetch->sku_no;?></td>
<td><?=$pfetch->productname;?></td>
<td class="td-rl"><strong><?=$pfetch->hsn_code;?></strong></td>
<td class="td-rl"><?=$invoiceFetch->quantity;?></td>
<td class="td-rl"><?php echo  $cal=$pfetch->mrp*70/100;?></td>
<td><?=$cal;?></td>
<td class="td-rl">IGST</td>
<td colspan="2" class="td-rl"><?=$pfetch->gst;?></td>
<td class="td-rl">
<?php $gstChop=chop($pfetch->gst,"%");?>


<?=$taxTot=$cal*$gstChop/100;?></td>
<td class="td-rl"><?php echo $tSum= $cal*$invoiceFetch->quantity+$taxTot;?></td>
</tr>
<?php
$tQty=$tQty+$invoiceFetch->quantity;
$grossVal=$grossVal+$cal;
$gSum=$gSum+$tSum;

$n++;
 }?>








<tr class="tr-t tr-b">
<td colspan="4" align="right" class="td-rl"><strong>Total</strong></td>
<td class="td-rl"><strong><?=$tQty;?></strong></td>
<td class="td-rl">&nbsp;</td>
<td><strong><?=$grossVal;?></strong></td>
<td class="td-rl">&nbsp;</td>
<td colspan="2" class="td-rl">&nbsp;</td>
<td class="td-rl">&nbsp;</td>
<td class="td-rl"><strong><?=$gSum;?></strong></td>
</tr>


<tr class="tr-t">
<td colspan="13" align="right">
<strong>Authorised Signatory</strong>
<br /><br /><br /><br />
</td>
</tr>
</tbody>
</table>

<div id="terms">

</div>

</div>

</body>

</html>