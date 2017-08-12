<script type="text/javascript">
$(document).ready(function() {
	oTable = $('#content').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers"
	});
} );

</script>

<a href="<?=base_url()?>admin/content/add_testimonial">Add New Testimonial</a>

<table id="content"  width="100%" style="clear:both;">
	<thead>
		<tr>
			<th>ID</th>
			
			<th>Author</th>
			<th>Date Added</th>
			<th>Actions</th>
			
		</tr>
	</thead>
	<tbody>
<?php foreach($list_references as $row):?>

<tr>
<td><?=$row['testimonial_id']?></td>

<td><?=$row['author']?></td>
<td><?=$row['date_added']?></td>
<td><a href="<?=base_url()?>admin/content/edit_testimonial/<?=$row['testimonial_id']?>">edit</a></td>
</tr>



<?php endforeach;?>
</tbody>
</table>