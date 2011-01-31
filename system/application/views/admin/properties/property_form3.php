<script type="text/javascript">
$(document).ready(function(){	
			
			 $(".printable").editable("<?=site_url('admin/images/editable_images')?>", 
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

			 $(".image_order").editable("<?=site_url('admin/images/image_order')?>", 
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
					<img height="100px" width="135px" src="<?=base_url()?>images/properties/<?=$image->property_id?>/thumbs/<?=$image->filename?>" />
				</a>
				<div style="float:left;">On Printout:</div> <div  style="float:left;" class="printable" id="<?=$image->image_id?>" style="width:150px; float:left;">
				<?php 
				if($image->printable==0) {echo "No";}; 
				if($image->printable==1) {echo "Yes";};
				?>
				</div>
				
				<div style="clear:both; float:left;">Order:</div> 	<div  style="float:left;" class="image_order" id="<?=$image->image_id?>" style="width:150px; float:left;"><?=$image->print_order?></div>
				<div style="clear:both; float:left; padding-top:10px;">
				
				<?=form_open('admin/images/delete_image')?>
				<?=form_hidden('id', $image->property_id)?>
				<?=form_hidden('image_id', $image->image_id)?>
				<?=form_submit('delete', 'Delete')?>
				<?=form_close()?>
				</div> 		
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

//multi file uploader under development - Do not use

<div id="file-uploader-demo1">      
    <noscript><p>Please enable JavaScript to use file uploader.</p></noscript>         
</div> 
<script>        
    jQuery(function(){
        var uploader = new qq.FileUploader({
            element: document.getElementById('file-uploader-demo1'),
            action: '<?=base_url()?>admin/properties/uploader_image',
            params: {
            id: '<?=$image->property_id?>'
            
        },
        });           
    });     
</script>