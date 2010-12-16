{<?php foreach($general_areas as $area):?>
<?php 

$area_clipped = $name = str_replace('\'', ' ', $area['area']);

?>

'<?=$area['general_area_id']?>':'<?=$area_clipped?>', 
<?php endforeach; ?>
'selected':'7'}



