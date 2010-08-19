<script type="text/javascript">
$(document).ready(function() {
	oTable = $('#contacts').dataTable({
		"bJQueryUI": true,
		"aoColumns": [null, null, null, {"bSearchable": false}],
		"sPaginationType": "full_numbers"
	});
} );
<!--
function confirmation(id) {
	var answer = confirm("are you sure you want to delete this user?")
	if (answer){
		
		window.location = "<?=base_url()?>admin/contacts/delete_user/"+ id;
	}
	else{
		alert("nothing deleted!")
	}
}
//-->
</script>
<?php $this->load->view('admin/contacts/quick_add_company');?>
<table id="contacts"  width="100%" style="clear:both;">
	<thead>
		<tr>
			<th>User</th>
			<th>Company Name</th>
			<th>Type</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
<?php foreach($contacts as $key => $row):
if($row['company_name']==NULL)
{
	$row['company_name']="N/A";
}



?>
		<tr>
			<td style="padding:5px;"><?="<a href='".base_url()."admin/contacts/view/".$row['user_id']."'>".$row['firstname']?> <?=$row['lastname']?></a></td>
			<td style="padding:5px;"><?="<a href='".base_url()."admin/contacts/view_company/".$row['company_id']."'>".$row['company_name']?></td>
					
			<td style="padding:5px;"><?=$row['company_type']?></td>
			
			<td style="padding:5px;"><?="<a href='#' onclick='confirmation(".$row['user_id'].")'>Delete</a> | <a href='".base_url()."admin/properties/add/".$row['company_id']."'>Add Property"?></a></td>
		</tr>
		<?php endforeach;  ?>
	</tbody>
</table>
