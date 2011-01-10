<script type="text/javascript">
$(document).ready(function(){	
			
			 $(".printable").editable("<?=site_url('admin/properties/editable_images')?>", 
			    	    {
			    	data   : " {'1':'Yes','0':'No'}",
			     	    type   : "select",
			     	    onblur : "submit",
			     	    style  : "inherit",
			     	    id   : "elementid",     
			     	        submitdata : function() 
			     	        {
			     	        return {id : "elementid"};
			    }
			    
			        	        
			    	    });

			 $(".image_order").editable("<?=site_url('admin/properties/image_order')?>", 
			    	    {
			    	
					 indicator : 'Saving...',
	    	    	id   : 'elementid',
	    	    	onblur : 'submit',
	    	        tooltip   : 'Click to edit...',
			     	        submitdata : function() 
			     	        {
			     	        return {id : "elementid"};
			    }
			    
			        	        
			    	    });

});	
			
</script>

<div id="gallery">
		<?php if (isset($images)):
			foreach($images as $image):	?>

			
			
			<div class="thumb">
				<a href="#">
					<img src="<?=base_url()?>images/properties/<?=$image->property_id?>/thumbs/<?=$image->filename?>" />
				</a>
				<div style="float:left;">On Printout:</div> <div  style="float:left;" class="printable" id="<?=$image->image_id?>" style="width:150px; float:left;">
				<?php 
				if($image->printable==0) {echo "No";}; 
				if($image->printable==1) {echo "Yes";};
				?>
				</div>
				
				<div style="clear:both; float:left;">Order:</div> 	<div  style="float:left;" class="image_order" id="<?=$image->image_id?>" style="width:150px; float:left;"></div>
				<div style="clear:both; float:left;">Delete</div> 		
			</div>
		
		<?php endforeach; else: ?>
			<div id="blank_gallery">Please Upload an Image</div>
		<?php endif; ?>
</div>

<div id="upload">
	<?php 
		echo realpath(APPPATH . '../images/properties');
		echo form_open_multipart('admin/properties/upload_image');
		echo form_hidden('id', $property_id);
		echo form_upload('userfile');
		echo form_submit('upload', 'Upload');
		echo form_close();
	?>

</div>

	