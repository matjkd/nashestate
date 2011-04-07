<script type="text/javascript">
jQuery(function() {
    jQuery('.wymeditor').wymeditor();
});
</script>

<?php // Change the css classes to suit your needs    

$attributes = array('class' => 'form', 'id' => 'form');

echo form_open('admin/content/update_content/'.$content_id.'', $attributes);

foreach($edit_content as $row):?>

<h2><?=$row['content_title']?></h2><br/>

<?php 		$textarea_data = array(
            'name'        => 'content',
            'id'          => 'content',
            'value'       => $row['content'],
          	'class' => 'wymeditor',
            'style'       => 'width:100%',
            );
	
		
		echo form_textarea($textarea_data);
		
	
?>

<?=form_input('extra', $row['extra'])?>
<?php endforeach; ?>
<br/> <input type="submit" class="wymupdate" />
<?=form_close()?>