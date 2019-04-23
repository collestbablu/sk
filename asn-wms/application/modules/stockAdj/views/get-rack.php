<?php
$prorack=$_GET['prorack'];
//$loc=$_GET['loc'];
  ?>

  <Select class="form-control" name="pallet" id="pallet" onchange="getPallet(this.value)">

    <option value="">--Select--</option>

  <?php
			$cateQuery=$this->db->query("select * from tbl_location_rack where location_rack_id='$prorack'");
			  foreach($cateQuery->result() as $getTypeQuery ){
			  ?>
			  <option value="<?php echo $getTypeQuery->id;?>"><?php echo $getTypeQuery->rack_name;?></option>
              
			  <?php }?>
  </Select>
