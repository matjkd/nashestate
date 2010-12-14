
<script type="text/javascript">
var oUsersTable;
$(document).ready(function() {
	oUsersTable = $('#users_table').dataTable({
		"bPaginate": false,
		"bInfo": false,
		"bJQueryUI": false,
		"bAutoWidth": false,
		"sDom": 't'
	});

});


</script>
<script >
function userconfirm(id) {
	var answer = confirm("are you sure you want to delete this user?")
	if (answer){
		
		$.post('<?=base_url()?>admin/contacts/delete_user/', {id: id});
			
	}
	else{
		alert("nothing deleted!")
	}
	$('#ajax_users').load('<?=base_url()?>admin/contacts/user_detail_table/<?=$company_id?>');
}
</script>
<script type="text/javascript">
$(document).ready(function() {
	var uid = "<?=$segment_id?>";
	var cid = "<?=$company_id?>";
$(".editcompany").editable("<?=site_url('/admin/contacts/edit_company')?>", 
	    {
	
	    	indicator : 'Saving...',
	    	id   : 'elementid',
	    	onblur : 'submit',
	        tooltip   : 'Click to edit...',
	        submitdata : function() 
	        {
	        return {id : cid};
}

    	        
	    });
$(".editcompanytype").editable("<?=site_url('/admin/contacts/edit_company')?>", 
	    {
	
	 		data : {'1':'vendor','2':'landlord','3':'agent','4':'other'},
 			type : 'select',
	    	id   : 'elementid',
	    	onblur : 'submit',
	      
	        submitdata : function() 
	        {
	        return {id : cid};
}

    	        
	    });
});
</script>
<?php foreach($contact_detail as $row): ?>


<div class='leftcolumn'>
			Group Name:
			</div>
			
			 	<div class='editcompany' id='company_name'><?=$row['company_name']?></div>
<div class='leftcolumn'>
			Group Type:
			</div>
			
			 	<div class='editcompanytype' id='company_type_id'><?=$row['company_type']?></div>			 	


<?php endforeach; ?>
<div style="clear:both;"></div>
<?php 
if ($company_users == NULL)
{
	echo "There are no users listed here. Add some.";
}
else
{ ?>
<table id="users_table"  width="100%" style="clear:both; ">
	<thead>
		<tr>
			<th>Name</th>
			<th>Description</th>
			
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php 


	
foreach($company_users as $key => $row):

?>
		<tr>
			<td style="padding:5px;"><?=$row['firstname']?> <?=$row['lastname']?></td>
					
			
			<td style="padding:5px;"><?=$row['short_desc']?></td>
		
				
			<td style="padding:5px;"><a href="../details/<?=$row['user_id']?>">edit</a> | <?="<a href='#' onclick='userconfirm(".$row['user_id'].")'>Delete</a>"?></td>
		
		</tr>
		<?php

		endforeach;

}?>
	</tbody>
</table>




		