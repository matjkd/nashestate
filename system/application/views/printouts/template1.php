<style>
body {
  margin: 0pt 22pt 24pt 22pt;
   font-family: 'Helvetica';
  font-size: 12px;
}

</style>
<body>
<img style="width: 240px; " src="<?=$config_base_path?>images/pdf/logo.jpg"/>

<div style="clear:both; height:5px;">&nbsp;</div>

<div style="height: 20px; width: 554px; margin-bottom:5px; margin-top:5px; padding:3px; color:#ffffff;  background-color: #444444; font-size:14px;"> 
	
	<?php foreach($property_details as $header):?>
		<table width="560px">
			<tr>
				<td width="300px">
					<?=$header->property_type_name?> :: <?=$header->area?>
				</td>
		
				<td width="240px" align="right">
					<?php 
					if($header->sale_rent == 1) { ?>
					<strong>Price: <?=$header->sale_price?>  &#0128;</strong>
					<?php } 
					if($header->sale_rent == 2) {?>
					<strong>Price: <?=$header->rent_price?>  &#0128;</strong>&nbsp;&nbsp;
					 <?php 
									 if(isset($rentals['rent_period']))
									 {
									 	$rentals['rent_period'];
									 }
									 else
									 {
									 	echo "Monthly";
									 }
					 } ?>
				</td>
			</tr>
		</table>
		
	<?php endforeach; ?>
	
	
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
//determine image layout based on number of prinatbale images
if(count($property_images) < 2) 	
	{
	//number of images and therefore the case number	
	$imagecount = 1;
	
	//height of body
	$bodyheight = "90px";
	} 
if(count($property_images) < 4 && count($property_images) >= 2) 	
	{
	$imagecount = 2;
	$bodyheight = "270px";
	}
if(count($property_images) < 6 && count($property_images) >= 4) 	
	{
	$imagecount = 4;
	$bodyheight = "90px";
	}
if(count($property_images) >= 6) 	
	{
	$imagecount = 6;
	$bodyheight = "182px";
	}
	

//determine features layout based on number of features
if(count($property_features) < 9)
	{
		$featurecount = 1;
	}
if(count($property_features) > 8)
	{
		$featurecount = 2;
	}
?>

<?php 
switch ($imagecount) {
	
	case 1:
		
		?>
		<img style="width: 560px;" src="<?=$config_base_path?>images/properties/<?=$mainImage[1]?>"/>
		<?php
		break;
	
	case 2:
		?>
		<img style="width: 275px; height:183px;  padding-right:10px; padding-bottom:10px; float:left;" src="<?=$config_base_path?>images/properties/<?=$mainImage[1]?>"/>
		<img style="width: 275px; height:183px;  padding-bottom:10px; float:left;" src="<?=$config_base_path?>images/properties/<?=$mainImage[2]?>"/>
		
		<?php 
		break;
	
	case 4:
		?>
		<img style="width: 275px; height:183px;  padding-right:10px; padding-bottom:10px; float:left;" src="<?=$config_base_path?>images/properties/<?=$mainImage[1]?>"/>
		<img style="width: 275px; height:183px;  padding-bottom:10px; float:left;" src="<?=$config_base_path?>images/properties/<?=$mainImage[2]?>"/>
		<img style="width: 275px; height:183px;  padding-right:10px; float:left;" src="<?=$config_base_path?>images/properties/<?=$mainImage[3]?>"/>
		<img style="width: 275px; height:183px;  float:left;" src="<?=$config_base_path?>images/properties/<?=$mainImage[4]?>"/>
		<?php 
		break;
	
	case 6:
		?>
		<img style="width: 275px; height:183px; padding-right:10px; padding-bottom:10px; float:left;" src="<?=$config_base_path?>images/properties/<?=$mainImage[1]?>"/>
		<img style="width: 275px; height:183px; padding-bottom:10px; float:left;" src="<?=$config_base_path?>images/properties/<?=$mainImage[2]?>"/>
		<img style="width: 133px; height:92px; padding-right:10px;  float:left;" src="<?=$config_base_path?>images/properties/<?=$mainImage[3]?>"/>
		<img style="width: 132px; height:92px; padding-right:10px;  float:left;" src="<?=$config_base_path?>images/properties/<?=$mainImage[4]?>"/>
		<img style="width: 133px; height:92px; padding-right:10px;  float:left;" src="<?=$config_base_path?>images/properties/<?=$mainImage[5]?>"/>
		<img style="width: 132px; height:92px; float:left;" src="<?=$config_base_path?>images/properties/<?=$mainImage[6]?>"/>
		<?php		
		break;
	
}

?>

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

//Count Bathrooms bathroom is room type 2 and en suite bathroom is room type 11
if($rooms['room_type'] == 2 || $rooms['room_type'] == 11)
{
	$bathrooms = $bathrooms + 1;
}

endforeach; ?>





<div style="clear:both; height:5px;">&nbsp;</div>
<?php foreach($property_details as $property):?>
	
<table width=560px border="0px" style="padding: 0; margin: 0;  border-collapse: collapse;">
	<tr>
			<td bgcolor="#dddddd" width=272px height=130px valign=top>
			<div style="height: 130px; width: 268px; float:left; padding:3px; color:#444444; " > 
				
				<table width=99%>
					
					
					
					<?php if(isset($bedrooms))  {   ?>
					<tr>
						<td width=133px><strong>Number of Bedrooms:</strong></td>		<td><?=$bedrooms?></td>
					</tr>
					<?php } ?>
					
					<?php if(isset($bathrooms))  {   ?>
					<tr>
						<td width=133px><strong>Number of Bathrooms:</strong></td>		<td><?=$bathrooms?></td>
					</tr>
					<?php } ?>
					
					<?php if(isset($property->plot_size))  {   ?>
					<tr>
						<td width=133px><strong>Plot Size:</strong></td>		<td><?=$property->plot_size?></td>
					</tr>
					<?php } ?>
					
					
					<?php if(isset($property->build_size))  {   ?>
					<tr>
						<td width=133px><strong>Build Size:</strong></td>		<td><?=$property->build_size?></td>
					</tr>
					<?php } ?>
					
					<?php if(isset($property->community_fees))  {   ?>
					<tr>
						<td width=133px><strong>Community Fees:</strong></td>		<td><?=$property->community_fees?> &#0128;</td>
					</tr>
					<?php } ?>
					
					
					<?php if($property->sale_rent == 2) {?>
					
						<?php if(isset($property->security_deposit))  {   ?>
						<tr>
							<td width=133px><strong>Security Deposit:</strong></td>		<td><?=$property->security_deposit?> &#0128;</td>
						</tr>
						<?php } ?>
						
						
						<?php if(isset($property->agency_commission))  {   ?>
						<tr>
							<td width=133px><strong>Agency Commission:</strong></td>		<td><?=$property->agency_commission?> &#0128;</td>
						</tr>
						<?php } ?>
						
					<?php } ?>
				</table>

			</div> 
		</td>
		<td width=10px>
		</td>
		<td bgcolor="#f9dba8" width=272px height=130px valign=top>
			<div style="height: 130px; width: 268px; float:right; padding:3px; margin-top:0px; color:#000000;"  > 
				<table width=99%>
					<tr>
						<td>
					<strong>Features</strong><br/>
					
					<?php switch ($featurecount) { 
case 1:
					echo "<ul>";
					foreach($property_features as $feature): ?>
					
						<li><?=$feature['features']?></li>
												
					<?php endforeach; 
					echo "</ul>";
break;

case 2:
					echo "<ul style='padding-left:2px;'>";
					foreach($property_features as $feature): ?>
					
						<li style='display: inline; padding-right: 3px;' ><?=$feature['features']?>,</li>
												
					<?php endforeach; 
					echo "</ul>";
break;
}
?>
					
					
						</td>
					</tr>
			</table>	
			</div>
		</td> 
	</tr>
</table>



<div style="clear:both; height:5px;">&nbsp;</div>
<div style="height: <?=$bodyheight?>; width: 560px; margin-bottom:0px; margin-top:0px; padding:0px;"> 

<?php if($property->alt_description == NULL)
{
	echo $property->description;
}
else
	{
	echo $property->alt_description;	
	}

?>


</div> 


<?php endforeach; ?>
<div align="center" style="height: 3px; width: 560px; margin-bottom:0px; margin-top:0px; padding:0px; color:#ffffff;  background-color: #f15c22; font-size:10px;"> 
No information herein constitutes the basis for a purchase/sale contract. The sale price is that indicated uppermost above. Other currencies are for guide purposes
only.<br/>
Local 13, Ctra. Palma Andratx 43, Portals Nous, 07181 Calvia, Mallorca<br/>
Tel: +34 971 67 59 69, Email: info@nashwhitehomes.com, www.nashwhitehomes.com
</div> 




</body>
