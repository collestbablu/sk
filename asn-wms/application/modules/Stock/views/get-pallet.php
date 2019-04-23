<?php
$loc=$_GET['proPall'];
  ?>

  <Select class="form-control" name="pallet" id="pallet" onchange="getPallet(this.value)">

    <option value="">--Select--</option>

  <?php
			$cateQuery=$this->db->query("select DISTINCT location_rack_id from tbl_location_rack where location_id='$loc'");
			  foreach($cateQuery->result() as $getTypeQuery ){
			  $cateQuery1=$this->db->query("select *from tbl_master_data where serial_number='$getTypeQuery->location_rack_id'");
			  $palletsr = $cateQuery1->row();
			  ?>
			  <option value="<?php echo $palletsr->serial_number;?>"><?php echo $palletsr->keyvalue;?></option>
              
			  <?php }?>
  </Select>
