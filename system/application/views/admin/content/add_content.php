<script type="text/javascript">
jQuery(function() {
    jQuery('.wymeditor').wymeditor();
});
</script>

<?php // Change the css classes to suit your needs    

$attributes = array('class' => 'form', 'id' => 'form');

echo form_open('admin/content/add_content/', $attributes);

		$textarea_data = array(
            'name'        => 'content',
            'id'          => 'content',
            'value'       =>'',
          	'class' => 'wymeditor',
            'style'       => 'width:100%'
            );
	echo form_input('title');
		echo form_input('menu');
		echo form_textarea($textarea_data);
		
	
?>

<?=form_input('extra')?>

<br/> <input type="submit" class="wymupdate" />
<?=form_close()?>