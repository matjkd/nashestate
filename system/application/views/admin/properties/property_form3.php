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



});	
$(function() {
		$( "#sortablethumb" ).sortable({
   update: function(event,ui)
        {
var order = $('#sortablethumb').sortable('serialize');
          $.post("<?=base_url()?>admin/images/ajaxsort", { pageorder: order } );
//alert(order);
        }
  });
		$( "#sortablethumb" ).disableSelection();
var order1 = $('#sortablethumb').sortable('serialize');
$.post("<?=base_url()?>admin/images/ajaxsort", { pageorder: order1 } );	
	});	

			 
	
</script>

<div id="gallery">
<ul id="sortablethumb">
		<?php if (isset($images)):
	
			foreach($images as $image):	?>

			

			<li id="pageorder_<?=$image->image_id?>">
			<div class="thumb" >
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
				<?=form_close()?></div>
                    <div style=" float:left; padding-top:10px;">
                <?=form_open('admin/images/update_watermark')?>
				<?=form_hidden('id', $image->property_id)?>
				<?=form_hidden('image_id', $image->image_id)?>
				<?=form_submit('update', 'update')?>
				<?=form_close()?>
                </div>
				 		
			</div>
			</li>

		
		<?php endforeach; else: ?>
</ul>
			<div id="blank_gallery">Please Upload an Image</div>
		<?php endif; ?>
</div>

<div id="upload">
	<?php 
		echo realpath(APPPATH . '../images/properties');
		echo form_open_multipart('admin/images/upload_image');
		echo form_hidden('id', $property_id);
		echo form_upload('userfile');
		echo form_submit('upload', 'Upload');
		echo form_close();
	?>

</div>

Drag and Drop File upload (this appears to have stopped working since the server move, single upload above should work if this doesn't).

<div id="file-uploader">      
    <noscript><p>Please enable JavaScript to use file uploader.</p></noscript>         
</div> 

<div id="test"></div>
<script>        
$(document).ready(function(){
    $('form.confirm-delete').live('submit',function(){
        var file = $(this).find('input[name=file]').val();
        return confirm('Are you sure you want to delete ' + file + '?');
    });
   
    $('.qq-upload-fail, .qq-upload-success').live('dblclick', function(){
        $(this).fadeOut();
    });
    
    $('input.read-only').live('click',function(){
        $(this).select();
    });
    

        var element = document.getElementById('file-uploader');
        if(element){
            new qq.FileUploader({
                element: element,
                action: base_url + 'uploadr/upload',
               
                
                onComplete: function(id, fileName, responseJSON){
                    if(responseJSON.success == false){
                        var $list = $('.qq-upload-list');
                        //add the error message to the element
                        $list.find('li:nth-child('+(id + 1)+')').append('<span class="error small">'+responseJSON.error+'</span>');
                    } 
                    else
                    {
                        var property_id = <?=$property_id?>;
                        var fullpath = "<?=$config_base_path?>images/uploads/" 

                         $.post('<?=base_url()?>admin/images/convert_image/', 
                                {
                            	id: property_id,
                                path: fullpath,
                                filename: fileName
                                        });
                         
                        $('#test').html("<input type='button' value='Reload Page' onClick='window.location.reload()'>");
                    }

                  
                    }
            });
        }
       
   
});  
</script>