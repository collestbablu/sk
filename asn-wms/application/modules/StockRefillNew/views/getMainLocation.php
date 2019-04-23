
<select name="rack_id" id="div_loc_id" onchange="rackOne(this.value)" class="form-control" style="width:100px;">
    <option value="">--select--</option>
	<?php
	$bookingType=$this->db->query("select * from tbl_location_rack  where location_rack_id='$id'");
	foreach($bookingType->result() as $getBooking){
	?>
	
   <option value="<?=$getBooking->id;?>"><?=$getBooking->rack_name;?></option>
   <?php }?>
  </select>