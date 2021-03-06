<!DOCTYPE HTML>
<html>
<head>
	<title>Printout</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
body {
 
   font-family: 'Helvetica', 'Arial', 'Sans-serif';
  font-size: 16px;
  
}
p {

    margin-top:0px;
}

div.absolute {
	
	position: fixed;
	padding: 0.5em;
	text-align: center;
	vertical-align: middle;
}


</style>
</head>
<body> 
	
<div><img style="width: 320px;" alt="logo" src="<?=$config_base_path?>images/pdf/logo.jpg" /></div>

<div style="clear:both; height:5px;">&nbsp;</div>


<div style="height: 25px; width: 100%; margin-bottom:5px; margin-top:5px; padding:3px; color:#ffffff;  background-color: #444444; font-size:18px;">

	
	<?php foreach($property_details as $header):?>
		<table width="100%">
			<tr>
				<td width="300px">
					<?=$header->property_type_name?> :: <?=$header->area?>
				</td>
		
				<td width="240px" align="right">
					<?php 
					if($header->sale_rent == 1) { ?>
					Price: <?=number_format($header->sale_price)?>   &#0128;
					<?php } 
					if($header->sale_rent == 2) {?>
					Price: <?=number_format($header->rent_price)?>  &#0128;&nbsp;&nbsp;
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
	$bodyheight = "65px";
	} 
if(count($property_images) < 4 && count($property_images) >= 2) 	
	{
	$imagecount = 2;
	$bodyheight = "270px";
	}
if(count($property_images) < 6 && count($property_images) >= 4) 	
	{
	$imagecount = 4;
	$bodyheight = "100px";
	}
if(count($property_images) >= 6) 	
	{
	$imagecount = 6;
	$bodyheight = "200px";
	}
	

//determine features layout based on number of features
if(count($property_features) < 3)
	{
		$featurecount = 1;
	}
if(count($property_features) > 2)
	{
		$featurecount = 2;
	}
?>

<?php 
switch ($imagecount) {
	
	case 1:
		
		?>

		<img style="width: 724px; height:440px;" src="<?=$config_base_path?>images/properties/<?=$mainImage[1]?>"/>

		<?php
		break;
	
	case 2:
		?>

		<img alt="<?=$mainImage[1]?>" style="width: 357px; height:270px;  padding-right:10px; padding-bottom:10px; float:left;" src="<?=$config_base_path?>images/properties/<?=$mainImage[1]?>"/>
		<img alt="<?=$mainImage[2]?>" style="width: 357px; height:270px;  padding-bottom:10px; float:left;" src="<?=$config_base_path?>images/properties/<?=$mainImage[2]?>"/>

		
		<?php 
		break;
	
	case 4:
		?>

		<img alt="<?=$mainImage[1]?>" style="width: 357px; height:270px;  padding-right:10px; padding-bottom:10px; float:left;" src="<?=$config_base_path?>images/properties/<?=$mainImage[1]?>"/>
		<img alt="<?=$mainImage[2]?>" style="width: 357px; height:270px;  padding-bottom:10px; float:left;" src="<?=$config_base_path?>images/properties/<?=$mainImage[2]?>"/>
		<img alt="<?=$mainImage[3]?>" style="width: 357px; height:270px;  padding-right:10px; float:left;" src="<?=$config_base_path?>images/properties/<?=$mainImage[3]?>"/>
		<img alt="<?=$mainImage[4]?>" style="width: 357px; height:270px;  float:left;" src="<?=$config_base_path?>images/properties/<?=$mainImage[4]?>"/>

		<?php 
		break;
	
	case 6:
		?>

		<img alt="<?=$mainImage[1]?>" style="width: 357px; height:270px; padding-right:10px; padding-bottom:10px; float:left;" src="<?=$config_base_path?>images/properties/<?=$mainImage[1]?>"/>
		<img alt="<?=$mainImage[2]?>" style="width: 357px; height:270px; padding-bottom:10px; float:left;" src="<?=$config_base_path?>images/properties/<?=$mainImage[2]?>"/>
		<img alt="<?=$mainImage[3]?>"  style="width: 173px; height:132px; padding-right:10px;  float:left;" src="<?=$config_base_path?>images/properties/<?=$mainImage[3]?>"/>
		<img alt="<?=$mainImage[4]?>"  style="width: 173px; height:132px; padding-right:10px;  float:left;" src="<?=$config_base_path?>images/properties/<?=$mainImage[4]?>"/>
		<img alt="<?=$mainImage[5]?>"  style="width: 173px; height:132px; padding-right:10px;  float:left;" src="<?=$config_base_path?>images/properties/<?=$mainImage[5]?>"/>
		<img alt="<?=$mainImage[6]?>"  style="width: 174px; height:132px; float:left;" src="<?=$config_base_path?>images/properties/<?=$mainImage[6]?>"/>

		<?php		
		break;
	
}

?>

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


//get parking type
// 1 private
// 2 shared
// 3 n/a

if($rooms['room_type'] == 13)
{
	if ($rooms['room_additional']==1)
	{
		$parking_type = "Private";
	}
	if ($rooms['room_additional']==2)
	{
		$parking_type = "Community";
	}
}

endforeach; }?>





<div style="clear:both; height:5px;">&nbsp;</div>

<div>
<?php foreach($property_details as $property):?>
	

<table width="723px" height="140px" border="0px" style="padding: 0; margin: 0;  border-collapse: collapse;">
	<tr>
			<td bgcolor="#dddddd" width="354px" height="140px" valign="top">
			<div style="float:left; padding:3px; color:#444444; " >

				
				<table width="99%">
					
					<tr>
						<td width="233px"><strong>Reference Number:</strong></td>		<td><?=$property->property_ref_no?></td>
					</tr>
					
					<?php if(isset($bedrooms))  {   ?>
					<tr>
						<td width="233px"><strong>Number of Bedrooms:</strong></td>		<td><?=$bedrooms?></td>
					</tr>
					<?php } ?>
					
					<?php if(isset($bathrooms))  {   ?>
					<tr>
						<td width="233px"><strong>Number of Bathrooms:</strong></td>		<td><?=$bathrooms?></td>
					</tr>
					<?php } ?>
					
					<?php if(isset($property->plot_size))  {   ?>
					<tr>
						<td width="233px"><strong>Plot Size:</strong></td>		<td><?=$property->plot_size?></td>
					</tr>
					<?php } ?>
					
					
					<?php if(isset($property->build_size))  {   ?>
					<tr>
						<td width="233px"><strong>Living Space:</strong></td>		<td><?=$property->build_size?></td>
					</tr>
					<?php } ?>
					
					
					<?php if(isset($terrace_size))  {   ?>
					<tr>
						<td width="233px"><strong>Terrace Size:</strong></td>		<td><?=$terrace_size?></td>
					</tr>
					<?php } ?>
					
					<tr>
						<td width="233px"><strong>Parking:</strong></td>	<td><?php if(isset($parking)) { echo $parking; } else { echo "None"; }?></td>
					</tr>
					
					<?php if($property->community_fees > 0)  {   ?>
					<tr>
						<td width="233px"><strong>Community Fees Per Month:</strong></td>		<td><?=floor($property->community_fees)?> &euro;</td>
					</tr>
					<?php } ?>
					
					
					
					
					<?php if($property->sale_rent == 2) {?>
					
						<?php if(isset($property->security_deposit))  {   ?>
						<tr>
							<td width="233px"><strong>Security Deposit:</strong></td>		<td><?=$property->security_deposit?> &#0128;</td>
						</tr>
						<?php } ?>
						
						
						<?php if(isset($property->agency_commission))  {   ?>
						<tr>
							<td width="133px"><strong>Agency Commission:</strong></td>		<td><?=$property->agency_commission?> &#0128;</td>
						</tr>
						<?php } ?>
						
					<?php } ?>
				</table>

			</div> 
		</td>
		<td width="8px">
		</td>

		<td bgcolor="#f9dba8" width="354px" height="140px" valign="top">
			
				<table  border="0px" style="padding: 0; margin: 0;  border-collapse: collapse;">

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
?></td>
                                </tr>
</table>
					
					
						</td>
					</tr>
			</table>	
			</div>
	



<div style="clear:both; height:5px;">&nbsp;</div>



<?php endforeach; ?>


 <div style="clear:both; height:0px;">&nbsp;</div>


<div  class="absolute"style="bottom: 0px; left: 0px; right: 0px; color:#000000;  background-color: #f15c22; font-size:12px; height:1.8cm; padding:-0.3cm 0.1cm 0.3cm 0.1cm;">



Nash Homes Mallorca, +34 971 67 59 69 or +34 636 47 55 49, info@nashhomesmallorca.com, www.nashhomesmallorca.com<br/>

WE HAVE MOVED Local no 7, Plaza Portals (1st floor office, behind the taxi rank)
<br/> 07181, Portals Nous, Calvia, Mallorca
	
<br/>
No information contained herein constitutes the basis for a purchase/sale contract.

</div>
</body>
</html>
