
<script type="text/javascript">
var oContactTable;
$(document).ready(function() {
	oContactTable = $('#contact_details').dataTable({
		"bPaginate": false,
		"bInfo": false,
		"bJQueryUI": false,
		"bAutoWidth": false,
		"sDom": 't'
	});

});
</script>
<script type="text/javascript">
function contactconfirm(id) {
	var answer = confirm("are you sure you want to delete this contact?")
	if (answer){
		
		$.post('<?=base_url()?>admin/contacts/delete_contact_detail/', {id: id});
			
	}
	else{
		alert("nothing deleted!")
	}
	$('#ajax_contacts').load('<?=base_url()?>admin/contacts/contact_detail_table/<?=$company_id?>');
}

function companycontactconfirm(id) {
	var answer = confirm("are you sure you want to delete this contact?")
	if (answer){
		
		$.post('<?=base_url()?>admin/contacts/delete_contact_detail/', {id: id});
			
	}
	else{
		alert("nothing deleted!")
	}
	$('#ajax_contacts').load('<?=base_url()?>admin/contacts/company_contact_detail_table/<?=$company_id?>');
}



function showcontact(id2) {
	
	$('#view_contact').load('<?=base_url()?>admin/contacts/view_contact_detail/' + id2);
}



</script>
	
<?php 
if ($contact_details == NULL)
{
	echo "There are no contact details listed here.";
}
else
{ ?>
<table id="contact_details"  width="100%" style="clear:both; ">
	<thead>
		<tr>
			<th>Type</th>
			<th>Contact</th>
			<th>Detail</th>
			
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
	<?php 


	
foreach($contact_details as $key => $row):

?>
		<tr>
			<td style="padding:5px;"><a href='#' onclick='showcontact(<?=$row['company_contact_id']?>)'><?=$row['company_contact_type']?></a> </td>
			<td style="padding:5px;"><?=$row['firstname']?> <?=$row['lastname']?></td>
			<td style="padding:5px;"><?=$row['company_contact_detail']?></td>
			
			
				
			<td style="padding:5px;"><a href='#' onclick='<?=$contact_table?>(<?=$row['company_contact_id']?>)'><span class="ui-icon ui-icon-close"></span></a> <a href='#' onclick='showcontact(<?=$row['company_contact_id']?>)'><span class="ui-icon ui-icon-pencil"></span></a></td>
		
		</tr>
		<?php

		endforeach;
?>

	</tbody>
</table>
You may have to click "update" after adding or deleting something in order to refresh the table
<?php }?>

	
		