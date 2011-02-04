<style>
body {
  margin: 0pt 22pt 24pt 22pt;
   font-family: 'Helvetica';
  font-size: 9px;
}

</style>
<body>
<img style="width: 240px; " src="/home/nh001/www/images/pdf/logo.jpg"/>

<div style="clear:both; height:5px;">&nbsp;</div>

<div style="height: 20px; width: 554px; margin-bottom:5px; margin-top:5px; padding:3px; color:#ffffff;  background-color: #444444"> 
	Villa: Test
</div> 

<div style="clear:both; height:5px;">&nbsp;</div>
<?php 
		$x = 0;
	foreach($property_images as $image):
		
		$x = $x + 1;
		
		$mainImage[$x] = "$image->property_id"."/"."$image->filename"; 
	
	endforeach;
?>

<?php 

if(count($property_images) < 4) 	
	{
	$imagecount = 1;
	} 
if(count($property_images) < 6 && count($property_images) >= 4) 	
	{
	$imagecount = 4;
	}
if(count($property_images) >= 6) 	
	{
	$imagecount = 6;
	}
	
?>

<?php 
switch ($imagecount) {
	
	case 1:
		
		?>
		<img style="width: 560px;" src="/home/nh001/www/images/properties/<?=$mainImage[1]?>"/>
		<?php
		break;
	
	case 4:
		?>
		<img style="width: 275px; padding-right:10px; padding-bottom:10px; float:left;" src="/home/nh001/www/images/properties/<?=$mainImage[1]?>"/>
		<img style="width: 275px; padding-bottom:10px; float:left;" src="/home/nh001/www/images/properties/<?=$mainImage[2]?>"/>
		<img style="width: 275px; padding-right:10px; float:left;" src="/home/nh001/www/images/properties/<?=$mainImage[3]?>"/>
		<img style="width: 275px; float:left;" src="/home/nh001/www/images/properties/<?=$mainImage[4]?>"/>
		<?php 
		break;
	
	case 6:
		?>
		<img style="width: 275px; height:183px; padding-right:10px; padding-bottom:10px; float:left;" src="/home/nh001/www/images/properties/<?=$mainImage[1]?>"/>
		<img style="width: 275px; height:183px; padding-bottom:10px; float:left;" src="/home/nh001/www/images/properties/<?=$mainImage[2]?>"/>
		<img style="width: 133px; height:92px; padding-right:10px;  float:left;" src="/home/nh001/www/images/properties/<?=$mainImage[3]?>"/>
		<img style="width: 132px; height:92px; padding-right:10px;  float:left;" src="/home/nh001/www/images/properties/<?=$mainImage[4]?>"/>
		<img style="width: 133px; height:92px; padding-right:10px;  float:left;" src="/home/nh001/www/images/properties/<?=$mainImage[5]?>"/>
		<img style="width: 132px; height:92px; float:left;" src="/home/nh001/www/images/properties/<?=$mainImage[6]?>"/>
		<?php		
		break;
	
}

?>


<div style="clear:both; height:5px;">&nbsp;</div>

<table width=560px border="0" style="padding: 0; margin: 0;  border-collapse: collapse;">
	<tr>
		<td width=268px>
			<div style="height: 230px; width: 268px; float:left; padding:3px; color:#444444;  background-color: #ffffff"> 
				left box
			</div> 
		</td>
		<td width=10px>
		</td>
		<td width=268px>
			<div style="height: 230px; width: 268px; float:right; padding:3px; color:#000000;  background-color: #f9dba8"> 
				right box
			</div>
		</td> 
	</tr>
</table>

<div style="clear:both; height:5px;">&nbsp;</div>

<div style="height: 3px; width: 560px; margin-bottom:0px; margin-top:0px; padding:0px; color:#ffffff;  background-color: #f15c22"> 
&nbsp;
</div> 
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
