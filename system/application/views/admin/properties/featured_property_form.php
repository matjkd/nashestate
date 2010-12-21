<script>
	$(function() {
		$( "#featureddatepicker" ).datepicker({
		dateFormat: "yy-mm-dd"
		});
	});
	</script>
<?php echo form_open('admin/properties/featured_property/'.$property_id.'');?>
Date to commence featured property:<br/>
<input type="text" name="date" id="featureddatepicker" style="width:150px; "/>
<?php echo form_submit( 'submit', 'Make Featured');  ?>
<?php echo form_close();?>

<?php foreach($featured_properties as $row):?>

<?php
$dateformatted = date('l jS \of F Y', $row['date_featured']);




?>
<div id="featured_list">
 <div style="float:left;"><?=$dateformatted?></div> <a href="<?=base_url()?>admin/properties/delete_featured_property/<?=$row['featured_property_id']?>"><span style="float:right;" class="ui-icon ui-icon-close"></span></a> 
</div>
<div style="clear:both;"></div>

<?php endforeach;?>