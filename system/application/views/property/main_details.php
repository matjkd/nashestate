<?php 
// Count Rooms
$bedrooms = 0;
$parking = 0;
$bathrooms = 0;

foreach($property_rooms as $rooms):

//Count Bedrooms
if($rooms['room_type'] == 1)
{
	$bedrooms = $bedrooms + 1;
}

//Count Parking Spaces
if($rooms['room_type'] == 13)
{
	$parking = $parking + 1;
}

//Count Bathrooms
if($rooms['room_type'] == 2)
{
	$bathrooms = $bathrooms + 1;
}

endforeach; ?>

<?php foreach($property_details as $property):?>
<h1><?=$property->property_title?> </h1>
<strong>Ref: <?=$property->property_ref_no?></strong>
<br/>
<?php 
if($property->sale_rent == 1) {?>
<strong>Price: &euro;<?=number_format($property->sale_price)?></strong>
<?php } 
if($property->sale_rent == 2) {?>
<strong>Price: &euro;<?=number_format($property->rent_price)?> <?=$property->rent_period?></strong>
<?php } ?>
<p>

<?=$property->description?>
</p>
<br/>

<div id="property_features">
	<div id="property_features_L">
	<strong>Type</strong>
	</div>
	<div id="property_features_L">
	<?=$property->property_type_name?>
	</div>
</div>

<div id="property_features">
	<div id="property_features_L">
	<strong>Location</strong>
	</div>
	<div id="property_features_L">
	<?=$property->area?>
	</div>
</div>


<?php if($bedrooms > 0) {?>
<div id="property_features">
	<div id="property_features_L">
	<strong>Number of Bedrooms</strong>
	</div>
	<div id="property_features_L">
	<?=$bedrooms?>
	</div>
</div>
<?php }?>

<?php if($bathrooms > 0) {?>
<div id="property_features">
	<div id="property_features_L">
	<strong>Number of Bathrooms</strong>
	</div>
	<div id="property_features_L">
	<?=$bathrooms?>
	</div>
</div>
<?php }?>

<?php if($parking > 0) {?>
<div id="property_features">
	<div id="property_features_L">
	<strong>Parking Spaces</strong>
	</div>
	<div id="property_features_L">
	<?=$parking?>
	</div>
</div>
<?php } ?>

<div id="property_features">
	<div id="property_features_L">
	<strong>Plot Size (m<sup>2</sup>)</strong>
	</div>
	<div id="property_features_L">
	<?=$property->plot_size?>
	</div>
</div>

<div id="property_features">
	<div id="property_features_L">
	<strong>Build Size (m<sup>2</sup>)</strong>
	</div>
	<div id="property_features_L">
	<?=$property->build_size?>
	</div>
</div>

<?php endforeach;?><br/>

<strong>Property Features</strong>
<p>
<?php foreach($property_features as $features): ?>



	<?=$features['features']?> |  


<?php endforeach; ?>
</p>
<br/>
<a href="<?=base_url()?>property/pdf/<?=$property_id?>">pdf</a>