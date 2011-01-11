<script type="text/javascript">

$(document).ready(function() {
	oTable = $('#features').dataTable({
		"bJQueryUI": true,
		
		"sPaginationType": "full_numbers"
	});
} );


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
<a href="#" onclick='default("<?=$row['features_id']?>")'>
<span  class="ui-icon ui-state-error ui-icon-circle-check"></span>
</a>
<?php }
else { ?>
<a href="#" onclick='undefault("<?=$row['features_id']?>")'>
<span  class="ui-icon ui-state-highlight ui-icon-circle-check"></span>
</a>
<?php }?>
</td>
	
<td>
	<?=$row['features']?> 
</td>

	<td>
					<a href="#" onclick='delete("<?=$row['features_id']?>")'>
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