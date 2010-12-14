
<script type="text/javascript">
var oContactTable;
$(document).ready(function() {
	oContactTable = $('#property_details').dataTable({
		"bPaginate": false,
		"bInfo": false,
		"bJQueryUI": false,
		"bAutoWidth": false,
		"sDom": 't'
	});

});
</script>
	
<?php 
if ($contact_details == NULL)
{
	echo "There are no property details listed here.";
}
else
{ ?>
<table id="property_details"  width="100%" style="clear:both; ">
	<thead>
		<tr>
			<th>Property ID</th>
			<th>Contact</th>
			<th>Detail</th>
			
			
		</tr>
	</thead>
	<tbody>
	<?php 


	
foreach($properties as $key => $row):

?>
		<tr>
			<td style="padding:5px;"><a href="<?=base_url()?>admin/properties/update/<?=$row['property_ref_no']?>"><?=$row['property_ref_no']?></a></td>
			<td style="padding:5px;"><?=$row['firstname']?> <?=$row['lastname']?></td>
			<td style="padding:5px;"><?=$row['property_title']?></td>
			
			
				
		
		
		</tr>
		<?php

		endforeach;

}?>
	</tbody>
</table>



	
		