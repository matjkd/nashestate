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

echo $dateformatted;


?> - <a href="<?=base_url()?>admin/properties/delete_featured_property/<?=$row['featured_property_id']?>">Delete</a> 
<br/>
<?php endforeach;?>