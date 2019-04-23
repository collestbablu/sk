<?php
$id=$id;
if($id!="")
{
	
/*$invice12=$this->db->query("select * from tbl_return_hdr where returnid='$id'");
$inviceres=$invice12->row();

$fetchrecord=$this->db->query("select * from tbl_contact_m where code='".$inviceres->id."'");
$fetchrecords=$fetchrecord->row();
 */
$fetchcomp=$this->db->query("select * from tbl_contact_m where code='$id'");
$fetchcompany=$fetchcomp->row(); 
  
$fetchaddress=$this->db->query("select * from tbl_state_m where stateid='".$fetchrecords->state_id."'");
$fetchaddresss=$fetchaddress->row();


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
Please find below returnable item/items issued which are more than your Demo Period/No. of days against requisition.:</p></td>
</tr>


<tr>
  <td colspan="13" class="blank">  </td>
</tr>



<tr id="bg" class="tr-t tr-b">
<td class="td-rl"><strong>RGP GATEPASS NO.</strong></td>
<td colspan="-2" class="td-rl"><strong>RGP GATEPASS DATE</strong></td>
<td><strong>EXP RETURN DATE</strong></td>
<td class="td-rl"><strong>OVER DUE DAY(S)</strong></td>
<td class="td-rl"><strong>MODEL</strong></td>
<td class="td-rl"><strong>MODEL DESCRIPTION</strong></td>
<td class="td-rl"><strong>QUANTITY ORDERED</strong></td>
<td class="td-rl"><strong>QUANTITY RETURNED</strong></td>
<td class="td-rl"><strong>QUANTITY BALANCE</strong></td>
<td class="td-rl"><strong>STOCK POSITION AS PER GATE PASS</strong></td>
</tr>
 <?php
extract($_POST);
$n=1;
//echo "select * from tbl_return_hdr where responsibility='$id'";
$inviceQ1=$this->db->query("select * from tbl_return_hdr where responsibility='$id'");
foreach($inviceQ1->result() as $getQ)
{
$resultstr[]=$getQ->returnid;
}
$hdrrid=implode(",",$resultstr);


$inviceQ=$this->db->query("select * from tbl_return_dtl where returnhdr in ($hdrrid)");
foreach($inviceQ->result() as $invoiceFetch){

$productQ=$this->db->query("select *from tbl_product_stock where Product_id='$invoiceFetch->product_id'");

$pfetch=$productQ->row();


$hdrQuery=$this->db->query("select *from tbl_return_hdr where returnid='$invoiceFetch->returnhdr'");

$hdrFetch=$hdrQuery->row();


@extract($invoiceFetch);

//this query for geting usage unit form tbl_master_data

$productQ1=$this->db->query("select *from tbl_master_data where serial_number ='$pfetch->usageunit'");

$pfetch1=$productQ1->row();



$getLog = $this->db->query("Select product_id,inbound_id,type from tbl_product_serial_log where type = 'Demo Return' and product_id='$invoiceFetch->product_id' and inbound_id='$invoiceFetch->returnhdr' ");
$logdata = $getLog->row();

if(@$logdata->product_id = @$invoiceFetch->product_id && @$logdata->inbound_id = @$invoiceFetch->returnhdr) 
{
}
else{

?>

<?php
$todays=date('Y-m-d');
$date1=date_create($todays);
$date2=date_create($hdrFetch->return_due_date);
$diff=date_diff($date1,$date2);
?>
<tr class="tr-t tr-b" <?php if($date1<=$date2){?> style="display:none;" <?php }?>>
<td class="td-rl"><?=$hdrFetch->rgp_gatepass_no;?></td>
<td colspan="-2" class="td-rl"><?=$hdrFetch->rgp_gate_pass_date;?></td>
<td><?=$hdrFetch->return_due_date;?></td>
<td class="td-rl"><strong><?php
$todays=date('Y-m-d');
$date1=date_create($todays);
$date2=date_create($hdrFetch->return_due_date);
$diff=date_diff($date1,$date2);
if($date1<=$date2)
{
	?>
     <b style="color:#0F0;">
    <?php
echo $diff->format("%a days");
}

else
{
	?>
    <b style="color:#F00;">
    <?php
echo $diff->format("%a days");	
}
?>
</strong></td>
<td class="td-rl"><?=$pfetch->sku_no;?></td>
<td class="td-rl"><?=$pfetch->productname;?></td>
<td class="td-rl"><?=$invoiceFetch->quantity;?></td>
<td class="td-rl"><?=$invoiceFetch->quantity-$invoiceFetch->quantity;?></td>
<td class="td-rl"><?=$invoiceFetch->quantity;?></td>

<td class="td-rl">

<?php 
		$ctnm=$this->db->query("select * from tbl_contact_m where code='$hdrFetch->stock_position'");
		$ctnmdtl=$ctnm->row(); ?>
	   <?php if($ctnmdtl->code!=''){ echo $ctnmdtl->first_name ." - ". $ctnmdtl->city; } else { }?>

<?php //$hdrFetch->stock_pos;?></td>
</tr>
<?php $n++; } }?>

</tbody>
</table>

<div style="margin:15px 0 0 0px;">
<p>
Hence, you are requested to arrange " return back " the same at warehouse address or get it " invoiced "
or " write off " to close this open DEMO.
</p>
<p class="MsoNormal" style="margin:0px 0cm;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif"><span lang="EN-US" style="font-size:9pt">Regards,<br>
  Warehouse Team</span><span style="font-size:11pt;font-family:Calibri,sans-serif;color:rgb(31,73,125)"><u></u><u></u></span></p>
<div>
  <p class="MsoNormal" style="margin:0px 0cm;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:rgb(34,34,34);font-style:normal;font-variant-ligatures:normal;font-variant-caps:normal;font-weight:400;letter-spacing:normal;text-align:start;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;background-color:rgb(255,255,255);text-decoration-style:initial;text-decoration-color:initial"><b><i><span lang="EN-US" style="font-size:11pt;font-family:Calibri,sans-serif;color:rgb(159,41,54)">The above is for your information.<u></u><u></u></span></i></b></p>
  <p class="MsoNormal" style="margin:0px 0cm;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:rgb(34,34,34);font-style:normal;font-variant-ligatures:normal;font-variant-caps:normal;font-weight:400;letter-spacing:normal;text-align:start;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;background-color:rgb(255,255,255);text-decoration-style:initial;text-decoration-color:initial"><b><i><span lang="EN-US" style="font-size:11pt;font-family:Calibri,sans-serif;color:rgb(159,41,54)"><u></u>&nbsp;<u></u></span></i></b></p>
  <p class="MsoNormal" style="margin:0px 0cm;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:rgb(34,34,34);font-style:normal;font-variant-ligatures:normal;font-variant-caps:normal;font-weight:400;letter-spacing:normal;text-align:start;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;background-color:rgb(255,255,255);text-decoration-style:initial;text-decoration-color:initial"><b><i><span lang="EN-US" style="font-size:11pt;font-family:Calibri,sans-serif;color:rgb(159,41,54)">Thanks &amp; Regards,<u></u><u></u></span></i></b></p>
  <p class="MsoNormal" style="margin:0px 0cm;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:rgb(34,34,34);font-style:normal;font-variant-ligatures:normal;font-variant-caps:normal;font-weight:400;letter-spacing:normal;text-align:start;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;background-color:rgb(255,255,255);text-decoration-style:initial;text-decoration-color:initial"><b><i><span lang="EN-US" style="font-size:11pt;font-family:Calibri,sans-serif;color:rgb(159,41,54)">Raghuvendra Yadav<u></u><u></u></span></i></b></p>
  <p class="MsoNormal" style="margin:0px 0cm;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:rgb(34,34,34);font-style:normal;font-variant-ligatures:normal;font-variant-caps:normal;font-weight:400;letter-spacing:normal;text-align:start;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;background-color:rgb(255,255,255);text-decoration-style:initial;text-decoration-color:initial"><b><i><span lang="EN-US" style="font-size:11pt;font-family:Calibri,sans-serif;color:rgb(159,41,54)">Geodis Overseas Private Limited<u></u><u></u></span></i></b></p>
  <p class="MsoNormal" style="margin:0px 0cm;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:rgb(34,34,34);font-style:normal;font-variant-ligatures:normal;font-variant-caps:normal;font-weight:400;letter-spacing:normal;text-align:start;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;background-color:rgb(255,255,255);text-decoration-style:initial;text-decoration-color:initial"><b><i><span lang="EN-US" style="font-size:11pt;font-family:Calibri,sans-serif;color:rgb(159,41,54)">Khasra No 36/1, VPO Bamnoli<u></u><u></u></span></i></b></p>
  <p class="MsoNormal" style="margin:0px 0cm;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:rgb(34,34,34);font-style:normal;font-variant-ligatures:normal;font-variant-caps:normal;font-weight:400;letter-spacing:normal;text-align:start;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;background-color:rgb(255,255,255);text-decoration-style:initial;text-decoration-color:initial"><b><i><span lang="EN-US" style="font-size:11pt;font-family:Calibri,sans-serif;color:rgb(159,41,54)">Near Pole No 646<u></u><u></u></span></i></b></p>
  <p class="MsoNormal" style="margin:0px 0cm;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:rgb(34,34,34);font-style:normal;font-variant-ligatures:normal;font-variant-caps:normal;font-weight:400;letter-spacing:normal;text-align:start;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;background-color:rgb(255,255,255);text-decoration-style:initial;text-decoration-color:initial"><b><i><span lang="EN-US" style="font-size:11pt;font-family:Calibri,sans-serif;color:rgb(159,41,54)">Main Bijwasan Road, New Delhi-110075.<u></u><u></u></span></i></b></p>
  <p class="MsoNormal" style="margin:0px 0cm;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:rgb(34,34,34);font-style:normal;font-variant-ligatures:normal;font-variant-caps:normal;font-weight:400;letter-spacing:normal;text-align:start;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;background-color:rgb(255,255,255);text-decoration-style:initial;text-decoration-color:initial"><b><i><span lang="EN-US" style="font-size:11pt;font-family:Calibri,sans-serif;color:rgb(159,41,54)">Email :-<span>&nbsp;</span></span></i></b><a href="mailto:raghuvendera.yadav.ext@geodis.com" style="color:rgb(17,85,204)" target="_blank"><b><i><span lang="EN-US" style="font-size:11pt;font-family:Calibri,sans-serif;color:rgb(159,41,54)">raghuvendera.yadav.ext@<wbr>geodis.com</span></i></b></a><b><i><span lang="EN-US" style="font-size:11pt;font-family:Calibri,sans-serif;color:rgb(159,41,54)"><u></u><u></u></span></i></b></p>
  <p class="MsoNormal" style="margin:0px 0cm;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:rgb(34,34,34);font-style:normal;font-variant-ligatures:normal;font-variant-caps:normal;font-weight:400;letter-spacing:normal;text-align:start;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;background-color:rgb(255,255,255);text-decoration-style:initial;text-decoration-color:initial"><b><i><span lang="EN-US" style="font-size:11pt;font-family:Calibri,sans-serif;color:rgb(159,41,54)">Mobile:- 9711004150<u></u><u></u></span></i></b></p>
  <p  class="MsoNormal" style="margin:0px 0cm;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:rgb(34,34,34);font-style:normal;font-variant-ligatures:normal;font-variant-caps:normal;font-weight:400;letter-spacing:normal;text-align:start;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;background-color:rgb(255,255,255);text-decoration-style:initial;text-decoration-color:initial"><b><i><span style="font-size:11pt;font-family:Calibri,sans-serif;color:rgb(159,41,54)"><img style="display:none" border="0" width="auto" height="50" style="margin:7px 0 7px 0px;" id="m_2548247801898391343gmail-m_3734831870759319263Picture_x0020_1" src="https://gm1.ggpht.com/Q-tF2sPldJ1ndcc9IOpy8omZKo5Oo3n_cCb2BqZwE66sO1Qw05JeUtpJTo0cEv54DsRcCMISJzm9YzLWT8CWCkJ-bwhh63BKypO2WjpfEnoTFwJw2iTu6nolEXX7ee6L68PdCbo70z93zvIr6ECLvIDRIgULAf1Vb66TTSsAKFu6aJGzy03H1QKa7bBMnx_Kuy0Aw6FYAeWAxjHoMs2r7tyzhyR3yT2X9irSjY9y5oM3TUIoOXA5S1_mdnVPu3niTNq5sYRFlYs3xIgYpfjwo26Rb5ClA9Dtf3FTkGq4HqZVDL08ovHXuODFf9ur7ToCWqk_fN3ZhL8WOmYOn1Q8fctjLmnhhPWCpEUzSEvSGira1Uzzh--ehQAxlO-kCATYwfDqmzmnNb2i0R1UEPBsM95Xe33AOMcP6gNHI9jZnCQlS2DqRydz-0iPi2j6KVAgR6G7PFgAFNErG7Ajb8kyde6_wbuJX4HvhVvgw5CpGs_M2g-QJRaDpN6MnJF6ukliZY5_nQvHIqWyqJCMos1i3GgVJ0N14KVXmHtqEfIm3yqqlhYmATj1Coo-xOewm7Zz8oPEQNGjW-JJv_NrwBr6G0IIEeAQYj-Lwc5SixmMrYryywsMN4hYGoVzOn_x9qXfDsB3G75zLd3kimI3zGFHlV5eYzC_tPYgLOGI20VCmOAJam8lKY2yHx5DJjL-Sw=w244-h100-l75-ft"><font color="#888888"><b><i><span lang="EN-US" style="font-size:11pt;font-family:Calibri,sans-serif;color:rgb(159,41,54)"><u></u><u></u></span></i></b></font></span></p>
</div>
</div>

</div>

</body>

</html>