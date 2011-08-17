<script>
	$(function() {
		$( "#rentaldatepicker" ).datepicker({
		dateFormat: "D, dd M yy"
		});
	});
	</script>
<?php echo form_open('admin/properties/rented/'.$property_id.'');?>
Date Rented:<br/>
<input type="text" name="date" id="rentaldatepicker" style="width:150px; "/><br/>
For <br/>
<input type="text" name="length"  style="width:150px; "/> Months
<?php echo form_submit( 'submit', 'Rented');  ?>
<?php echo form_close();?>

