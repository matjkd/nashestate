<script type="text/javascript">
jQuery(function() {
    jQuery('.wymeditor').wymeditor();
});
</script>

<?php // Change the css classes to suit your needs    

$attributes = array('class' => 'form', 'id' => 'form');

echo form_open('admin/content/update_testimonial/'.$testimonial_id.'', $attributes);

foreach($edit_testimonial as $row):?>

<h2>Reference</h2><br/>

<?php 		$textarea_data = array(
            'name'        => 'testimonial',
            'id'          => 'testimonial',
            'value'       => $row['testimonial'],
          	'class' => '',
            'style'       => 'width:100%',
            );
	
		
		echo form_textarea($textarea_data);

		
	
?>

<?=form_input('Author', $row['author'])?>
<?php endforeach; ?>
<br/> <input type="submit" class="wymupdate" />
<?=form_close()?>