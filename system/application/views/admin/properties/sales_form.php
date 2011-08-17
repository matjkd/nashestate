<script>
	$(function() {
		$( "#salesdatepicker" ).datepicker({
		dateFormat: "D, dd M yy"
		});
	});
	</script>
<?php echo form_open('admin/properties/sold/'.$property_id.'');?>
Date Sold:<br/>
<input type="text" name="date" id="salesdatepicker" style="width:150px; "/>
<?php echo form_submit( 'submit', 'Sold');  ?>
<?php echo form_close();?>

