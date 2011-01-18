<?php $x=0;?>
<?php foreach($old_properties as $row):?>
<div style="background:#dddddd; margin:5px; padding:5px;">
<?php $x = $x + 1;?>

<?php $address = $row->address; ?>

 <span style="color:#bbbbbb;"><?=$x?></span><br/> 
<strong>Property ID:</strong> <?=$row->id_property?><br/>
<strong>Area:</strong> "<?=$address?>" - <span style="color:red;"> <?=$row->general_area_id?>. "<?=$row->area?>"</span><br/>
<strong>Title:</strong> <?=$row->name?><br/>
<strong>Description:</strong><?=$row->description?><br/>
<strong>Size:</strong><?=$row->sq_m?><br/>
<strong>Plot Size:</strong><?=$row->sq_m_plot?><br/>
<strong>Number of Bedrooms:</strong><?=$row->n_brooms?><br/>
<strong>Price:</strong><?=$row->price_euro?>&euro;<br/>
</div>
<?php endforeach;?>