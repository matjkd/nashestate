<?php 
// Count Rooms
$bedrooms = 0;
$parking = 0;
$bathrooms = 0;

if(isset($property_rooms)){
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


	//Count Bathrooms bathroom is room type 2 and en suite bathroom is room type 11
	if($rooms['room_type'] == 2 || $rooms['room_type'] == 11)
	{
		$bathrooms = $bathrooms + 1;
	}

	//get size of terrace
	if($rooms['room_type'] == 7 || $rooms['room_type'] == 8)
	{
		$terrace_size = $rooms['room_size'];
	}
	endforeach;
}?>

<?php foreach($property_details as $property):?>
<h1>
	<?=$property->property_title?> 

</h1>
<strong>Ref: <?=$property->property_ref_no?>
</strong>
<br />

<?php 
if($property->sale_rent == 1) {?>
<strong>Price: <?=number_format($property->sale_price)?>&euro;
</strong>
<?php 
if($property->sold_rented == 1) {?>
<br/>
<span class="soldrented">SOLD</span>
<?php } else {
	if($property->status == 1) {
		?>
		<span class="soldrented">RESERVED</span>
		<?php }
} ?>
<?php } 
if($property->sale_rent == 2) {?>
<strong>Price: <?=number_format($property->rent_price)?>&euro; <?=$property->rent_period?>
</strong>
<br />

<?php if(isset($security_deposit)) { ?>
<strong>Security Deposit: <?=number_format($property->security_deposit)?>&euro;
</strong>
<?php } ?>

<?php 
if($property->sold_rented == 1) {?>
<span class="soldrented">RENTED</span>
<?php  } else {
	if($property->status == 1) {
		?>
		<span class="soldrented">RESERVED</span>
		<?php }
} ?>
<?php } ?>


<p style="text-align: justify;">

	<?=$property->description?>
</p>
<br />

<table class="table table-striped">
		<tr>
			<td>Type</td>
			<td><?=$property->property_type_name?></td>
		</tr>
		
<tr>
	<td>Location</td>
	<td><?=$property->area?></td>
</tr>
		

		



<?php if($bedrooms > 0) {?>
<tr>
	
	<td>Number of Bedrooms</td>
	<td><?=$bedrooms?></td>
</tr>
		
<?php }?>

<?php if($bathrooms > 0) {?>
	
<tr>
	<td>Number of Bathrooms</td>
	<td><?=$bathrooms?></td>
</tr>
	
<?php }?>

<?php if($parking > 0) {?>
<tr>
	<td>Parking Spaces</td>
	<td><?=$parking?></td>
</tr>
	
<?php } ?>

<tr>
	<td>Plot Size  </td>
	<td><?=$property->plot_size?> m<sup>2</sup></td>
</tr>

<tr>
		<td>Build Size </td>
		<td><?=$property->build_size?> m<sup>2</sup></td>
</tr>
<?php if($property->community_fees != NULL) { ?>
<tr>
		<td>Community Fees Per Month</td>
		<td><?=floor($property->community_fees)?> &euro;</td>
</tr>
<?php } ?>


<tr>
		<td>Energy Rating</td>
		<?php if($property->energy_rating != NULL) { ?>
		<td><?=$property->energy_rating?></td>
		<?php } else { ?>
			<td>In Progress</td>
			<?php } ?>
</tr>


<?php endforeach;?>
</table>

<strong>Property Features</strong>
<p>
	<?php foreach($property_features as $features): ?>



	<?=$features['features']?>
	|


	<?php endforeach; ?>
</p>
<h3><a href="<?=base_url()?>property/pdf/<?=$property_id?>"><sup><i class="icon-print"></i></sup></a></h3>
