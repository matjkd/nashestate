<script type="text/javascript">

$(document).ready(function() {
	oTable = $('#features').dataTable({
		"bJQueryUI": true,
		
		"sPaginationType": "full_numbers"
	});
} );

function makeDefault(id) {
	var answer = confirm("are you sure you want to make this a default feature?")
	if (answer){
		
		window.location = "<?=base_url()?>admin/features/make_default/"+ id;
	}
	else{
		alert("nothing changed!")
	}
}

function defaultRemove(id) {
	var answer = confirm("Are you sure you want to remove from default features?")
	if (answer){
		
		window.location = "<?=base_url()?>admin/features/remove_default/"+ id;
	}
	else{
		alert("nothing changed!")
	}
}
function deleteFeature(id) {
	var answer = confirm("Are you sure you want to delete this feature?")
	if (answer){
		
		window.location = "<?=base_url()?>admin/features/delete_feature/"+ id;
	}
	else{
		alert("nothing changed!")
	}
}
</script>


<div style="width:410px; float:left;">
<table id="features"  style="clear:both; width:400px;">
	<thead>
		<tr>
			<th>Default</th>
			<th>Feature Name</th>
			<th>Actions</th>
			
		</tr>
	</thead>
	<tbody>
	
<?php foreach($features as $row):?>

<tr>
<td>
<?php if($row['default_feature'] == 1) { ?>
<a href="#" onclick='defaultRemove("<?=$row['features_id']?>")'>
<span  class="ui-icon ui-state-error ui-icon-circle-check"></span>
</a>
<?php }
else { ?>
<a href="#" onclick='makeDefault("<?=$row['features_id']?>")'>
<span  class="ui-icon ui-state-highlight ui-icon-circle-check"></span>
</a>
<?php }?>
</td>
	
<td>
	<?=$row['features']?> 
</td>

	<td>
					<a href="#" onclick='deleteFeature("<?=$row['features_id']?>")'>
						<span style="float:right;" class="ui-icon ui-icon-circle-close"></span>
					</a>
					
					<a href="#" onclick='edit("<?=$row['features_id']?>")'>
						<span style="float:right;" class="ui-icon ui-icon-pencil"></span>
					</a>
	</td>
</tr>
<?php endforeach;?>
</tbody>
</table>
</div>
<div style="float:left; padding-left:20px; width:460px;">
forms
</div>