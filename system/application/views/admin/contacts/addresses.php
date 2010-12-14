
<script type="text/javascript">
var oAddressTable;
$(document).ready(function() {
	oAddressTable = $('#addresses').dataTable({
		"bPaginate": false,
		"bInfo": false,
		"bJQueryUI": false,
		"bAutoWidth": false,
		"sDom": 't'
	});

});
</script>
<script type="text/javascript">
function addressconfirm(id) {
	var answer = confirm("are you sure you want to delete this address?")
	if (answer){
		
		$.post('<?=base_url()?>admin/contacts/delete_address/', {id: id});
			
	}
	else{
		alert("nothing deleted!")
	}
	$('#ajax_addresses').load('<?=base_url()?>admin/contacts/<?=$address_table?>/<?=$company_id?>');
}

function showaddress(id2) {
	
	$('#view_address').load('<?=base_url()?>admin/contacts/view_address/' + id2);
}



</script>
<?php 
if ($addresses == NULL)
{
	echo "There are no addresses listed here. Add some.";
}
else
{ ?>
<table id="addresses"  width="100%" style="clear:both; ">
	<thead>
		<tr>
			<th>Address 1</th>
			<th>Address 2</th>
			<th>Postcode</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
	<?php 


	
foreach($addresses as $key => $row):

?>
		<tr>
			<td style="padding:5px;"><?=$row['company_address1']?> </td>
					
			<td style="padding:5px;"><?=$row['company_address2']?></td>
			
			<td style="padding:5px;"><?=$row['company_address5']?></td>
				
			<td style="padding:5px;"><a href='#' onclick='showaddress(<?=$row['company_address_id']?>)'><span class="ui-icon ui-icon-pencil"></span></a><a href='#' onclick='addressconfirm(<?=$row['company_address_id']?>)'><span class="ui-icon ui-icon-close"></span></a></td>
		
		</tr>
		<?php

		endforeach;

}?>
	</tbody>
</table>




		