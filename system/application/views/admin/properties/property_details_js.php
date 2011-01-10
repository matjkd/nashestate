<script type="text/javascript">
	$(function() {
		$("#tabs").tabs();
	});
	</script>
<?php foreach($property_details as $key => $row): ?>
<script>
$(document).ready(function() {
	var uid = "<?=$property_id?>";

	
    $(".editdetails").editable("<?=site_url('admin/properties/editable_property1')?>", 
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
    

    $(".edittype").editable("<?=site_url('admin/properties/editable_property1')?>", 
    	    {
   	 data : <?php $this->load->view('ajax/property_types'); ?>,
     	    type   : "select",
     	    onblur : "submit",
     	    style  : "inherit",
     	    id   : 'elementid',     
     	        submitdata : function() 
     	        {
     	        return {id : uid};
    }
    
        	        
    	    });

    $(".yesno").editable("<?=site_url('admin/properties/editable_property1')?>", 
    	    {
    	data   : " {'1':'Yes','0':'No', 'selected':'<?php echo $row->active; ?>'}",
     	    type   : "select",
     	    onblur : "submit",
     	    style  : "inherit",
     	    id   : 'elementid',     
     	        submitdata : function() 
     	        {
     	        return {id : uid};
    }
    
        	        
    	    });
   
    
    $(".editarea").editable("<?=site_url('admin/properties/editable_property1')?>", 
    	    {
   	 data : <?php $this->load->view('ajax/general_areas'); ?>,
     	    type   : "select",
     	    onblur : "submit",
     	    style  : "inherit",
     	    id   : 'elementid',     
     	        submitdata : function() 
     	        {
     	        return {id : uid};
    }
    
        	        
    	    });

    
    $(".editperiod").editable("<?=site_url('admin/properties/editable_property1')?>", 
    	    {
   	 data : <?php $this->load->view('ajax/rent_period'); ?>,
     	    type   : "select",
     	    onblur : "submit",
     	    style  : "inherit",
     	    id   : 'elementid',     
     	        submitdata : function() 
     	        {
     	        return {id : uid};
    }
    
        	        
    	    });

    $(".editpayment").editable("<?=site_url('admin/properties/editable_property1')?>", 
    	    {
   	 data : <?php $this->load->view('ajax/sale_payment'); ?>,
     	    type   : "select",
     	    onblur : "submit",
     	    style  : "inherit",
     	    id   : 'elementid',     
     	        submitdata : function() 
     	        {
     	        return {id : uid};
    }
    
        	        
    	    });

    
    $(".editdate").editable('<?=site_url('admin/properties/editable_property1')?>', {
        type: 'datepicker',
        tooltip: 'click to edit...',
        event: 'click',
        submit: 'OK',
        id   : 'elementid',
        cancel: 'Cancel',
        width: '200px',
        submitdata : function() 
        {
            return {id : uid};
}
   });

    $(".editmembers").editable("<?=site_url('admin/properties/editable_property1')?>", 
    	    {
   	 data : <?php $this->load->view('ajax/ajax_members'); ?>,
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