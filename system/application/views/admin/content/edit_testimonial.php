<script type="text/javascript">
jQuery(function() {
    jQuery('.wymeditor').wymeditor();
});
</script>

<?php // Change the css classes to suit your needs    

$attributes = array('class' => 'form', 'id' => 'form');

echo form_open('admin/content/update_testimonial/'.$testimonial_id.'', $attributes);

foreach($edit_content as $row):?>

<h2><?=$row['content_title']?></h2><br/>

<?php 		$textarea_data = array(
            'name'        => 'testimonial',
            'id'          => 'testimonial',
            'value'       => $row['testimonial'],
          	'class' => '',
            'style'       => 'width:100%',
            );
	
		
		echo form_textarea($textarea_data);
		
	
?>

<?=form_input('extra', $row['extra'])?>
<?php endforeach; ?>
<br/> <input type="submit" class="wymupdate" />
<?=form_close()?>