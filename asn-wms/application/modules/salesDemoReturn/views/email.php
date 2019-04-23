<?php
$id=$id;
if($id!="")
{
	
$invice12=$this->db->query("select * from tbl_return_hdr where returnid='$id'");
$inviceres=$invice12->row();

$fetchrecord=$this->db->query("select * from tbl_contact_m where contact_id='".$inviceres->stock_position."'");
$fetchrecords=$fetchrecord->row();
 
$fetchcomp=$this->db->query("select * from tbl_contact_m where contact_id='".$inviceres->responsibility."'");
$fetchcompany=$fetchcomp->row(); 
  
$fetchaddress=$this->db->query("select * from tbl_state_m where stateid='".$fetchrecords->state_id."'");
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

<title></title>



<style>
/*
	 CSS-Tricks Example
	 by Chris Coyier
	 http://css-tricks.com
*/

* { margin: 0; padding: 0; }
body { font: 14px/1.4 Georgia, serif; font-family:Arial, Helvetica, sans-serif; font-size:12px; }
#page-wrap { width: 810px; margin: 0 auto; }
h1{text-align:center;}
h2{text-align:center;}
h3{text-align:center;}

#bg{background-color:#f0f0f0;}

.th-border{
    border: 1px solid black;
    padding: 3px;
    border-top: none;
    border-bottom: none;
}

.td-rl{
	border-right: 1px solid #000;
    border-left: 1px solid #000;
}

.td-l{
	 border-left: 1px solid #000;
}

.td-r{
	border-right: 1px solid #000;
    }


.tr-t{
	border-top: 1px solid #000;
}


.tr-b{
    border-bottom: 1px solid #000;
}

textarea { border: 0; font: 14px Georgia, Serif; overflow: hidden; resize: none; }
table { border-collapse: collapse; }
table td, table th { border: 1px solid black; padding:3px; border:none; }

#header { height: 15px; width: 100%; margin: 20px 0; background: #222; text-align: center; color: white; font: bold 15px Helvetica, Sans-Serif; text-decoration: uppercase; letter-spacing: 20px; padding: 8px 0px; }

#address { width: 250px; height: 150px; float: left; }
#customer { overflow: hidden; }

#logo { text-align: right; float: right; position: relative; margin-top: 25px; border: 1px solid #fff; max-width: 540px; max-height: 100px; overflow: hidden; }
#logo:hover, #logo.edit { border: 1px solid #000; margin-top: 0px; max-height: 125px; }
#logoctr { display: none; }
#logo:hover #logoctr, #logo.edit #logoctr { display: block; text-align: right; line-height: 25px; background: #eee; padding: 0 5px; }
#logohelp { text-align: left; display: none; font-style: italic; padding: 10px 5px;}
#logohelp input { margin-bottom: 5px; }
.edit #logohelp { display: block; }
.edit #save-logo, .edit #cancel-logo { display: inline; }
.edit #image, #save-logo, #cancel-logo, .edit #change-logo, .edit #delete-logo { display: none; }
#customer-title { font-size: 20px; font-weight: bold; float: left; }

#meta { margin-top: 1px; width: 300px; float: right; }
#meta td { text-align: right;  }
#meta td.meta-head { text-align: left; background: #eee; }
#meta td textarea { width: 100%; height: 20px; text-align: right; }

#items { clear: both; width: 100%; margin:0 0 0 0; border: 1px solid black; }
#items th { background: #eee; }
#items textarea { width: 80px; height: 50px; }
#items tr.item-row td { border: 0; vertical-align: top; }
#items td.description { width: 300px; }
#items td.item-name { width: 175px; }
#items td.description textarea, #items td.item-name textarea { width: 100%; }
#items td.total-line { border-right: 0; text-align: right; }
#items td.total-value { border-left: 0; padding: 10px; }
#items td.total-value textarea { height: 20px; background: none; }
#items td.balance { background: #eee; }
#items td.blank { border: 0; }

#terms { text-align: center; margin: 20px 0 0 0; }
#terms h5 { font: 13px Helvetica, Sans-Serif; padding: 0 0 8px 0; margin: 0 0 8px 0; text-align:left; }
#terms textarea { width: 100%; text-align: center;}

textarea:hover, textarea:focus, #items td.total-value textarea:hover, #items td.total-value textarea:focus, .delete:hover { background-color:#EEFF88; }

.delete-wpr { position: relative; }
.delete { display: block; color: #000; text-decoration: none; position: absolute; background: #EEEEEE; font-weight: bold; padding: 0px 3px; border: 1px solid; top: -6px; left: -22px; font-family: Verdana; font-size: 12px; }
</style>








<link rel='stylesheet' type='text/css' href='<?=base_url();?>assets/gatepass_print_css/css/style.css' />
</head>

<body>

<div id="page-wrap">
<table id="items">
<tbody>
<tr>
<td colspan="13" class="blank">
<p>
<strong>Dear</strong> &nbsp; <?=$fetchcompany->first_name;?><br /> <br /> 
Today, we have issued the material issued via RGP No:<?=$inviceres->rgp_gatepass_no;?>, Dated:<?=$inviceres->rgp_gate_pass_date;?> and with Returnable Date:<?=$inviceres->return_due_date;?>. Please find below details:</p></td>
</tr>


<tr>
  <td colspan="13" class="blank">  </td>
</tr>

<tr class="tr-t tr-b">
<td colspan="2" class="td-rl-">RGP NO<br /> DELIVERY TO</td>
<td><?=$inviceres->rgp_gatepass_no;?> <br /><?=$fetchrecords->city;?>(<?=$fetchrecords->first_name;?>)</td>
<td class="td-rl-">REFERENCE DATE<br /> RETURN DATE</td>
<td class="td-r"><?=$inviceres->rgp_gate_pass_date;?><br /> 	<?=$inviceres->return_due_date;?></td>
</tr>

<tr id="bg" class="tr-t tr-b">
<td class="td-rl"><strong>LINE ID</strong></td>
<td colspan="-2" class="td-rl"><strong>MODEL</strong></td>
<td><strong>MODEL DESCRIPTION</strong></td>
<td class="td-rl"><strong>QUANTITY RETURNED</strong></td>
<td class="td-rl"><strong>UOM</strong></td>
</tr>
 <?php
extract($_POST);
$n=1;
$inviceQ=$this->db->query("select * from tbl_return_dtl where returnhdr='$id'");
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
<td class="td-rl"><strong><?=$invoiceFetch->quantity;?></strong></td>
<td class="td-rl"><?=$pfetch1->keyvalue;?></td>
</tr>
<?php $n++; }?>

</tbody>
</table>

<div id="terms">
<h5><strong>Note:</strong> UOM stand for Unit of measure</h5>
</div>

</div>

</body>

</html>