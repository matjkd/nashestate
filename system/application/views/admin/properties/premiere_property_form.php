<script>
	$(function() {
		$( "#featureddatepicker2" ).datepicker({
		dateFormat: "yy-mm-dd"
		});
	});

	$(function() {
		$( "#featureddatepicker3" ).datepicker({
		dateFormat: "yy-mm-dd"
		});
	});
	</script>
<br/>
<?php echo form_open('admin/properties/premiere_property/'.$property_id.'');?>
<strong>Dates for inclusion in premiere properties:</strong><br/>
Start:<br/>
<input type="text" name="datestart" id="featureddatepicker2" style="width:150px; "/>

<br/>End:<br/>
<input type="text" name="dateend" id="featureddatepicker3" style="width:150px; "/>
<?php echo form_submit( 'submit', 'Make Premiere');  ?>
<?php echo form_close();?>

<?php foreach($premiere_properties as $row2):?>

<?php
$datestartformatted = date('D jS \of M Y', $row2['date_featured']);
$dateendformatted = date('D jS \of M Y', $row2['date_ends']);


?>  
<div id="featured_list">
	<div style="float:left;"><?=$datestartformatted?> until <?=$dateendformatted?></div><a href="<?=base_url()?>admin/properties/delete_premiere_property/<?=$row2['premiere_property_id']?>"><span style="float:right;" class="ui-icon ui-icon-close"></span></a> 
</div>
<div style="clear:both;"></div>

<?php endforeach;?>