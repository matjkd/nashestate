<?php foreach($property_details as $key => $row): ?>


<script>
$(document).ready(function() {
	var uid = "<?=$property_id?>";

	
	 $(".signboard").editable("<?=site_url('admin/properties/editable_salesdata')?>", 
	    	    {
	    		data   : " {'1':'Yes','0':'No', 'selected':'<?php echo $row->sign_board; ?>'}",
	     	    type   : "select",
	     	    onblur : "submit",
	     	    style  : "inherit",
	     	    id   : 'elementid',     
	     	        submitdata : function() 
	     	        {
	     	        return {id : uid};
	    }
	    
	        	        
	    	    });
	 $(".advertising").editable("<?=site_url('admin/properties/editable_salesdata')?>", 
	    	    {
	    		data   : " {'1':'Yes','0':'No', 'selected':'<?php echo $row->advertising; ?>'}",
	     	    type   : "select",
	     	    onblur : "submit",
	     	    style  : "inherit",
	     	    id   : 'elementid',     
	     	        submitdata : function() 
	     	        {
	     	        return {id : uid};
	    }
	    
	        	        
	    	    });

	 $(".signed_contract").editable("<?=site_url('admin/properties/editable_salesdata')?>", 
	    	    {
	    		data   : " {'1':'Yes','0':'No', 'selected':'<?php echo $row->signed_sales_contract; ?>'}",
	     	    type   : "select",
	     	    onblur : "submit",
	     	    style  : "inherit",
	     	    id   : 'elementid',     
	     	        submitdata : function() 
	     	        {
	     	        return {id : uid};
	    }
	    
	        	        
	    	    });

	 $(".exclusive").editable("<?=site_url('admin/properties/editable_salesdata')?>", 
	    	    {
	    		data   : " {'1':'Yes','0':'No', 'selected':'<?php echo $row->exclusive; ?>'}",
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
<?php endforeach; ?>