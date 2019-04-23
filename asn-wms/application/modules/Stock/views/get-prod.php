<?php
$prodType=$_GET['prod'];
  ?>

  <Select class="form-control" name="tech_prod" required>

    <option value="">--Select--</option>

  <?php
			$cateQuery=$this->db->query("select *from tbl_technical_product where technical_sub_type='$prodType'");
			  foreach($cateQuery->result() as $getTypeQuery ){
			  ?>
			  <option value="<?php echo $getTypeQuery->technical_pro_id;?>"><?php echo $getTypeQuery->tech_pro_name;?></option>
              
			  <?php }?>
  </Select>
