<script>

$(document).ready(function() {
	var uid = "<?=$contact_id?>";
    $(".edit_contact_detail").editable("<?=site_url('admin/contacts/edit_contact_detail')?>", 
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

    $(".edit_contact_type").editable("<?=site_url('admin/contacts/edit_contact_detail')?>", 
    	    {
		    	
    	 data : {'Home Tel':'Home Tel','Work Tel':'Work Tel','Mobile':'Mobile','Email':'Email','Fax':'Fax'},
    	    type   : "select",
    	    onblur : "submit",
    	    style  : "inherit",
    	    id   : 'elementid',     
    	        submitdata : function() 
    	        {
    		
    	        return {id : uid};
    	        
    	        }
    		
    	    });
    
  
    
   
    
});


</script>	

<?php  foreach($contact_detail as $contactdetail): ?>	
		
	<div>
	
		
<table>
<tr>
		<td class='leftcolumn'>
		Type
		</td>
		<td>
		 <div class='edit_contact_type' id='company_contact_type'><?=$contactdetail->company_contact_type?></div>
		</td>
	</tr>
	
		<?php if($contactdetail->company_contact_detail == NULL)
	{
		?>
		
		<tr>
		<td class='leftcolumn'>
		Detail
		</td>
		<td>
		 <div class='edit_contact_detail' id='company_detail' style="color:#cccccc;"></div>
		</td>
	</tr>
		
		<?php 
		
		
	}
	else
	{
	?>
	<tr>
		<td class='leftcolumn'>
		Detail
		</td>
		<td>
		 <div class='edit_contact_detail' id='company_contact_detail'><?=$contactdetail->company_contact_detail?></div>
		</td>
	</tr>
	<?php }?>
	

 

</table>
		<?php endforeach ?>
	

		
	</div>