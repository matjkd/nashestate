<script type="text/javascript">
$(document).ready(function() {
	oTable = $('#contacts').dataTable({
		"bJQueryUI": true,
		"bStateSave": true,
		"bScrollInfinite": true,
		"bScrollCollapse": true,
		"sScrollY": "400px",
		"bPaginate": true,
		"bLengthChange": true,
		"bFilter": true,
		"bSort": true,
		"aoColumns": [null, null, null, {"bSearchable": false}],
		"sPaginationType": "full_numbers",
		"iDisplayLength": 20
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

<!--
function groupconfirmation(id) {
	var answer = confirm("are you sure you want to delete this group (including all users and properties associated with it)?")
	if (answer){
		
		window.location = "<?=base_url()?>admin/contacts/delete_group/"+ id;
	}
	else{
		alert("nothing deleted!")
	}
}
//-->
</script>
<div id="search_heading"><?php $this->load->view('admin/contacts/quick_add_company');?></div>
<div id="search_heading"><?php $this->load->view('admin/contacts/quick_add_user');?></div>
<table id="contacts"  width="100%" style="clear:both;">
	<thead>
		<tr>
			<th>Individual</th>
			<th>Group</th>
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
			<td style="padding:5px;"><?="<a href='".base_url()."admin/contacts/details/".$row['user_id']."'>".$row['firstname']?> <?=$row['lastname']?></a></td>
			<td style="padding:5px;"><?="<a href='".base_url()."admin/contacts/view_company/".$row['company_id']."'>".$row['company_name']?></td>
					
			<td style="padding:5px;"><?=$row['company_type']?></td>
			
			<td style="padding:5px;"><?="<a href='#' onclick='confirmation(".$row['user_id'].")'>Del User</a> | <a href='#' onclick='groupconfirmation(".$row['company_id'].")'>Del Group</a> | <a href='".base_url()."admin/properties/add/".$row['company_id']."'>Add Property"?></a></td>
		</tr>
		<?php endforeach;  ?>
	</tbody>
</table>
