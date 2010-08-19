<div id="gallery">
		<?php if (isset($images) && count($images)):
			foreach($images as $image):	?>
			<div class="thumb">
				<a href="<?php echo $image['url']; ?>">
					<img src="<?php echo $image['thumb_url']; ?>" />
				</a>				
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