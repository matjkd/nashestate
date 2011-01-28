<?php foreach($sales as $row):?>

"<?=$row->property_ref_no?> <?=$row->sale_rent?> "

<?php endforeach;?>
<br/><br/>
<?php foreach($rentals as $row2):?>

"<?=$row2->property_ref_no?> <?=$row2->sale_rent?> "

<?php endforeach;?>