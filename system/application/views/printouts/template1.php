<style>
body {
  margin: 0pt 22pt 24pt 22pt;
   font-family: 'Helvetica';
  font-size: 9px;
}
</style>
<body>
<img style="width: 240px; " src="/home/nh001/www/images/pdf/logo.jpg"/>
<img style="width: 560px;" src="/home/nh001/www/images/properties/65/ratio_3to2.jpg"/>
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
<strong>Price: &#0128;<?=$property->sale_price?></strong>
<?php } 
if($property->sale_rent == 2) {?>
<strong>Price: &#0128;<?=$property->rent_price?> <?=$property->rent_period?></strong>
<?php } ?>

<?=$property->description?>

<br/>
<table width=100%>
<tr>
	<td width=80px>
	<strong>Type</strong>
	</td>
	
	<td>
	<?=$property->property_type_name?>
	</td>
	
	
	<td width=80px>
	<strong>Location</strong>
	</td>
	
	
	<td>
	<?=$property->area?>
	</td>


</tr>

</table>
<div id="property_features" style="float:left; width:200px;">
	<div id="property_features_L">
	<strong>Type</strong>
	</div>
	<div id="property_features_L">
	<?=$property->property_type_name?>
	</div>
</div>

<div id="property_features" style="float:left; width:200px;">
	<div id="property_features_L">
	<strong>Location</strong>
	</div>
	<div id="property_features_L">
	<?=$property->area?>
	</div>
</div>


<div id="property_features" style="float:left; width:200px;">
	<div id="property_features_L">
	<strong>Number of floors</strong>
	</div>
	<div id="property_features_L">
	<?=$property->floors?>
	</div>
</div>

<?php if($bedrooms > 0) {?>
<div id="property_features" style="float:left; width:200px;">
	<div id="property_features_L">
	<strong>Number of Bedrooms</strong>
	</div>
	<div id="property_features_L">
	<?=$bedrooms?>
	</div>
</div>
<?php }?>

<?php if($bathrooms > 0) {?>
<div id="property_features" style="float:left; width:200px;">
	<div id="property_features_L">
	<strong>Number of Bathrooms</strong>
	</div>
	<div id="property_features_L">
	<?=$bathrooms?>
	</div>
</div>
<?php }?>

<?php if($parking > 0) {?>
<div id="property_features" style="float:left; width:200px;">
	<div id="property_features_L">
	<strong>Parking Spaces</strong>
	</div>
	<div id="property_features_L">
	<?=$parking?>
	</div>
</div>
<?php } ?>

<div id="property_features" style="float:left; width:200px;">
	<div id="property_features_L">
	<strong>Plot Size (m<sup>2</sup>)</strong>
	</div>
	<div id="property_features_L">
	<?=$property->plot_size?>
	</div>
</div>

<div id="property_features" style="float:left; width:200px;">
	<div id="property_features_L">
	<strong>Build Size (m<sup>2</sup>)</strong>
	</div>
	<div id="property_features_L">
	<?=$property->build_size?>
	</div>
</div>

<?php endforeach;?>

<?php foreach($property_features as $features): ?>


<div id="property_features" style="float:left; width:200px;">
	<div id="property_features_L">
	<strong><?=$features['features']?></strong>
	</div>
	<div id="property_features_L">
	Yes
	</div>
</div>

<?php endforeach; ?>
</body>
