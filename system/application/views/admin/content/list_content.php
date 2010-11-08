<script type="text/javascript">
$(document).ready(function() {
	oTable = $('#content').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers"
	});
} );

</script>

<table id="content"  width="100%" style="clear:both;">
	<thead>
		<tr>
			<th>ID</th>
			<th>Title</th>
			<th>added by</th>
			<th>Order</th>
			<th>Actions</th>
			
		</tr>
	</thead>
	<tbody>
<?php foreach($list_content as $row):?>

<tr>
<td><?=$row['content_id']?></td>
<td><?=$row['content_title']?></td>
<td><?=$row['added_by']?></td>
<td><?=$row['content_order']?></td>
<td><a href="<?=base_url()?>admin/content/edit_content/<?=$row['content_id']?>">edit</a></td>
</tr>



<?php endforeach;?>
</tbody>
</table>