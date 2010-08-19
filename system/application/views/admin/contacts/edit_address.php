<script>
$(document).ready(function() {
	var uid = "<?=$address_id?>";
    $(".editaddress").editable("<?=site_url('admin/contacts/edit_address')?>", 
    	    {
    	    	indicator : 'Saving...',
    	    	id   : 'elementid',
    	    	onblur : 'submit',
    	        tooltip   : 'Click to edit...',
    	        submitdata : function() 
    	        {
    	            return {id : uid};
    }
    
        	        
    	    });

   
    
});
</script>	

<?php  foreach($address as $addressdetail): ?>	
		
	<div>
	
		
<table>
<tr>
		<td class='leftcolumn'>
		Address 1
		</td>
		<td>
		 <div class='editaddress' id='company_address1'><?=$addressdetail->company_address1?></div>
		</td>
	</tr>
	
		<?php if($addressdetail->company_address2 == NULL)
	{
		?>
		
		<tr>
		<td class='leftcolumn'>
		Address 2
		</td>
		<td>
		 <div class='editaddress' id='company_address2' style="color:#cccccc;"></div>
		</td>
	</tr>
		
		<?php 
		
		
	}
	else
	{
	?>
	<tr>
		<td class='leftcolumn'>
		Address 2
		</td>
		<td>
		 <div class='editaddress' id='company_address2'><?=$addressdetail->company_address2?></div>
		</td>
	</tr>
	<?php }?>
	
	<?php if($addressdetail->company_address3 == NULL)
	{
		?>
		
		<tr>
		<td class='leftcolumn'>
		Address 3
		</td>
		<td>
		 <div class='editaddress' id='company_address3' style="color:#cccccc;"></div>
		</td>
	</tr>
		
		<?php 
		
		
	}
	else
	{
	?>
	<tr>
		<td class='leftcolumn'>
	Address 3
		</td>
		<td>
		 <div class='editaddress' id='company_address3'><?=$addressdetail->company_address3?></div>
		</td>
	</tr>
	<?php }?>
	<tr>
		<td class='leftcolumn'>
	Address 4
		</td>
		<td>
		 <div class='editaddress' id='company_address4'><?=$addressdetail->company_address4?></div>
		</td>
	</tr>

<tr>
		<td class='leftcolumn'>
		Postcode
		</td>
		<td>
		 <div class='editaddress' id='company_address5'><?=$addressdetail->company_address5?></div>
		</td>
	</tr>
 

</table>
		<?php endforeach ?>
	

		
	</div>

		