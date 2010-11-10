<script type="text/javascript">
$(document).ready(function() {
	oTable = $('#contacts').dataTable({
		"bJQueryUI": true,
		"aoColumns": [null, null, null, null, {"bSearchable": false}, {"bSearchable": false}, {"bSearchable": false}, {"bSearchable": false}],
		"sPaginationType": "full_numbers"
	});
} );
<!--
function confirmation(id) {
	var answer = confirm("are you sure you want to delete this property?")
	if (answer){
		
		window.location = "<?=base_url()?>admin/properties/archive_property/"+ id;
	}
	else{
		alert("nothing deleted!")
	}
}
//-->
</script>

<table id="contacts"  width="100%" style="clear:both;">
	<thead>
		<tr>
			<th>ID</th>
			<th>Vendor</th>
			<th>Address 1</th>
			<th>Type</th>
			<th>Price</th>
			<th>Date Available</th>
			<th>Active</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
<?php foreach($properties as $key => $row):

if($row['sale_rent'] == 1)
{
	$price = $row['sale_price'];
}
if($row['sale_rent'] == 2)
{
	$price = $row['rent_price'] ." ". $row['rent_period'];
}

?>
		<tr>
			<td style="padding:5px;"><?=$row['property_ref_no']?></td>
			<td style="padding:5px;"><?=$row['company_name']?></td>
			<td style="padding:5px;"><?=$row['property_address1']?></td>		
			<td style="padding:5px;"><?=$row['property_type_name']?></td>
			<td style="padding:5px;">&euro;<?=$price?></td>
			<td style="padding:5px;"><?=$row['available_from']?></td>
			<td style="padding:5px;"><?php if($row['active']==0) {echo "No";};	if($row['active']==1) {echo "Yes";};?></td>
			<td style="padding:5px;"><?="<a href='#' onclick='confirmation(".$row['property_ref_no'].")'>Delete</a> | <a href='".base_url()."admin/properties/update/".$row['property_ref_no']."'>View Property"?></a></td>
		</tr>
		<?php endforeach;  ?>
	</tbody>
</table>
