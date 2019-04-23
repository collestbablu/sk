<select name="location_to">



 <?php 
						$sqlgroup=$this->db->query("select * from tbl_contact_m where code='$id'");
						foreach ($sqlgroup->result() as $fetchgroup){
						
					?>
    <option value="<?php echo $fetchgroup->contact_id; ?>"<?php if(@$_GET['id']!='' || @$_GET['view']!=''){ if($fetchgroup->contact_id==$branchFetch->origin){ ?> selected <?php } }?>><?php echo $fetchgroup->city ; ?></option>
    <?php } ?>

</select>