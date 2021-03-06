<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
<style>
body {
  margin: 0pt 22pt 24pt 22pt;
   font-family: 'Helvetica', 'Arial', 'Sans-serif';
  font-size: 12px;
}

</style>
</head>
<body>
	
<img style="width: 240px;" src="<?=$config_base_path?>images/pdf/logo.jpg" />

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
					<strong>Price: <?=number_format($header->sale_price)?>   &#0128;</strong>
					<?php } 
					if($header->sale_rent == 2) {?>
					<strong>Price: <?=number_format($header->rent_price)?>  &#0128;</strong>&nbsp;&nbsp;
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
	$bodyheight = "55px";
	} 
if(count($property_images) < 4 && count($property_images) >= 2) 	
	{
	$imagecount = 2;
	$bodyheight = "250px";
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

endforeach; ?>





<div style="clear:both; height:5px;">&nbsp;</div>
<?php foreach($property_details as $property):?>
	
<table width="560px" border="0px" style="padding: 0; margin: 0;  border-collapse: collapse;">
	<tr>
			<td bgcolor="#dddddd" width="272px" height="130px" valign="top">
			<div style="height: 130px; width: 268px; float:left; padding:3px; color:#444444; " > 
				
				<table width="99%">
					
					<tr>
						<td width="133px"><strong>Reference Number:</strong></td>		<td><?=$property->property_ref_no?></td>
					</tr>
					
					<?php if(isset($bedrooms))  {   ?>
					<tr>
						<td width="133px"><strong>Number of Bedrooms:</strong></td>		<td><?=$bedrooms?></td>
					</tr>
					<?php } ?>
					
					<?php if(isset($bathrooms))  {   ?>
					<tr>
						<td width="133px"><strong>Number of Bathrooms:</strong></td>		<td><?=$bathrooms?></td>
					</tr>
					<?php } ?>
					
					<?php if(isset($property->plot_size))  {   ?>
					<tr>
						<td width="133px"><strong>Plot Size:</strong></td>		<td><?=$property->plot_size?></td>
					</tr>
					<?php } ?>
					
					
					<?php if(isset($property->build_size))  {   ?>
					<tr>
						<td width="133px"><strong>Build Size:</strong></td>		<td><?=$property->build_size?></td>
					</tr>
					<?php } ?>
					
					
					<?php if(isset($terrace_size))  {   ?>
					<tr>
						<td width="133px"><strong>Terrace Size:</strong></td>		<td><?=$terrace_size?></td>
					</tr>
					<?php } ?>
					
					<tr>
						<td width="133px"><strong>Parking:</strong></td>		<td><?php if(isset($parking_type)) { echo $parking_type; } else { echo "None"; }?></td>
					</tr>
					
					
					
					
					<?php if($property->sale_rent == 2) {?>
					
						<?php if(isset($property->security_deposit))  {   ?>
						<tr>
							<td width="133px"><strong>Security Deposit:</strong></td>		<td><?=$property->security_deposit?> &#0128;</td>
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
		<td width="10px">
		</td>
		<td bgcolor="#f9dba8" width="272px" height="130px" valign="top">
			<div style="height: 130px; width: 268px; float:right; padding:3px; margin-top:0px; color:#000000;"  > 
				<table width="99%">
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
<div align="center" style="height: 3px; width: 560px; margin-bottom:0px; margin-top:0px; padding:0px; color:#000000;  background-color: #f15c22; font-size:10px;"> 
For additional information contact Nash Homes on +34 971 67 59 69 or +34 636 47 55 49. Email: info@nashhomesmallorca.com. Office address: We are in the centre of Portals village street on the corner with C. Marina. Ctra. Palma-Andraitx 43, Local 13, Portals Nous, Calvia 07181, Mallorca.
<br/>

No information contained herein constitutes the basis for a purchase/sale contract.
</div> 


<script type="text/php">

if ( isset($pdf) ) {

  $font = Font_Metrics::get_font("verdana");;
  $size = 6;
  $color = array(0,0,0);
  $text_height = Font_Metrics::get_font_height($font, $size);

  $foot = $pdf->open_object();
  
  $w = $pdf->get_width();
  $h = $pdf->get_height();

  // Draw a line along the bottom
  $y = $h - 2 * $text_height - 24;
  $pdf->line(16, $y, $w - 16, $y, $color, 1);

  $y += $text_height;

  $text = "ID: <?php echo $report_id; ?>";
  $pdf->text(16, $y, $text, $font, $size, $color);

  $pdf->close_object();
  $pdf->add_object($foot, "all");

 // global $initials;
 // $initials = $pdf->open_object();
  
  // Add an initals box
  //$text = "Initials:";
  //$width = Font_Metrics::get_text_width($text, $font, $size);
  //$pdf->text($w - 16 - $width - 38, $y, $text, $font, $size, $color);
  //$pdf->rectangle($w - 16 - 36, $y - 2, 36, $text_height + 4, array(0.5,0.5,0.5), 0.5);
    

  //$pdf->close_object();
 // $pdf->add_object($initials);
 
  // Mark the document as a duplicate
  //df->text(110, $h - 240, "DUPLICATE", Font_Metrics::get_font("verdana", "bold"),
   //        110, array(0.85, 0.85, 0.85), 0, -52);

  $text = "Page {PAGE_NUM} of {PAGE_COUNT}";  

  // Center the text
  $width = Font_Metrics::get_text_width("Page 1 of 2", $font, $size);
  $pdf->page_text($w / 2 - $width / 2, $y, $text, $font, $size, $color);
  
}
</script>

</body>
</html>
