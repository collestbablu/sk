<?php
//echo "select * from tbl_product_serial  where rack_id='$id' and product_id='$pri_id' and main_location_id='$main_loc' and location_id='$loc";
$rackQ=$this->db->query("select * from tbl_product_serial  where rack_id='$id' and product_id='$pri_id' and main_location_id='$main_loc' and location_id='$loc'");
$fetchrackQ=$rackQ->row();
?>
<input type="text" id="quantity_idd"  style="width:100px;" value="<?php echo $fetchrackQ->quantity; ?>"   class="form-control" readonly>