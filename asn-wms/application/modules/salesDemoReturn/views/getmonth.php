<?php

 $main_menu;
?>
<select name="receipt_of_month"  class="form-control ui fluid search dropdown email" disabled="disabled">
    <option value="">----Select ----</option>
    <?php
	$bookingType=$this->db->query("select *from tbl_master_data  where param_id='28'");
	foreach($bookingType->result() as $getBooking){
	?>
   <option value="<?=$getBooking->serial_number;?>" <?php if($getBooking->keyvalue==$main_menu){?> selected <?php }?>><?=$getBooking->keyvalue;?></option>
   <?php }?>
  </select>