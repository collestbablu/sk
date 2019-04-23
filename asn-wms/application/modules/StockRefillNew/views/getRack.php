
<select name="rack_two_id" id="div_rack_id" class="form-control" style="width:100px;" >
    <?php
	$bookingType=$this->db->query("select * from tbl_location_rack  where location_rack_id='$id'");
	foreach($bookingType->result() as $getBooking){
	?>
   <option value="<?=$getBooking->id;?>"><?=$getBooking->rack_name;?></option>
   <?php }?>
  </select>