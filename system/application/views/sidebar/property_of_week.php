
<?php 
if($featured_property != NULL) { ?>
<div id="property_box">

<?php foreach($featured_property as $row):?>

<a href="<?=base_url()?>property/display/<?=$row['property_ref_no']?>">
<img width="305px" src="<?=base_url()?>images/properties/<?=$row['property_ref_no']?>/medium/<?=$row['filename']?>">
<div id="property_box_text"><strong>Property of the Week</strong></div>
<?php 
$description = strip_tags($row['description']);
$description = substr($description, 0, 70);
echo "".$description."...";
?>
</a>
<?php
endforeach; ?>
</div>
<?php 
}
?>
