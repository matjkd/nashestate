<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<?php $this->load->view('global/header'); ?>

<body onload="initialize()"> 
<?=$this->load->view('global/warning')?>

		<?php $x=0;?>
		<?php foreach($old_properties as $row):?>
		
<?=form_open('admin/import/import_property')?>
		<div style="background:#dddddd; margin:5px; padding:5px;">
		<?php $x = $x + 1;?>
		
		<?php $address = $row->address; ?>
		
		 <span style="color:#bbbbbb;"><?=$x?></span><br/> 
		<strong>Property ID:</strong><?=form_input('property_id', $row->id_property)?><br/>
		<strong>Area:</strong> "<?=$address?>" - 
		
		<span style="color:red;"> <?=$row->general_area_id?>. "<?=$row->area?>"</span><br/>
		<?php
		$options = array(
		                  $row->general_area_id  => $row->area
		                );
		
		                
		foreach($list_areas as $areas):  
		
			$area_id = $areas['general_area_id'];        
			$options[$area_id] = $areas['area'];
			
		endforeach;
		echo form_dropdown('areas', $options, $row->area); 
		 
		?>
		
		<br/>
		<?php 
		if($row->Activo == "Si")
		{
			$active = 1;
		}
		if($row->Activo == "No")
		{
			$active = 0;
		}
		?>
		<strong>Active:</strong><br/><?=form_input('active', $active)?><br/>
		<strong>Title:</strong><br/><?=form_input('title', $row->name)?><br/>
		<strong>Description:</strong><br/><?=form_textarea('description', $row->description)?><br/>
		<strong>Size (m2):</strong><br/><?=form_input('size', $row->sq_m)?><br/>
		<strong>Plot Size:</strong><br/><?=form_input('plot_size', $row->sq_m_plot)?><br/>
		<strong>Number of Bedrooms:</strong><br/><?=form_input('number_of_bedrooms', $row->n_rooms)?><br/>
		<strong>Number of Bathrooms:</strong><br/><?=form_input('number_of_bathrooms', $row->n_brooms)?><br/>
		<strong>Number of Parking Spaces:</strong><br/><?=form_input('number_of_parking', $row->n_garage)?><br/>
		<strong>Price:</strong><br/><?=form_input('price', $row->price_euro)?>&euro;<br/>
		
		
		<strong>View:</strong><br/>
		<?php 
//convert view into a string
$view = $row->id_view;
if($view == 1){	$viewing = "Beach and Sea View";}
if($view == 2){	$viewing = "Countryside Views"; }
if($view == 3){	$viewing = "Frontline Sea Views";}
if($view == 4){	$viewing = "Frontline Golf Course Views";}
if($view == 5){	$viewing = "Garden View";}
if($view == 6){	$viewing = "Golf Course Views";}
if($view == 7){	$viewing = "Marina Views";}
if($view == 8){	$viewing = "View of Mountains";}
if($view == 9){	$viewing = "View of Mountains and Sea";}
if($view == 10){ $viewing = "Panoramic Views";}
if($view == 11){ $viewing = "View of Pool";}
if($view == 12){ $viewing =  "View of Pool and Garden";}
if($view == 13){ $viewing =  "Sea View";}
if($view == 14){ $viewing = "View of Town Centre";}
if($view == 15){ $viewing =  "View of Terrace";}
if($view == 16){ $viewing = "Woodland View";}
//display view as form input
echo form_input('view', $viewing);	?>
	<br/>	
		
		<strong>Pool:</strong><br/>
		<?php 
//convert swimming pool into a string
$pool = $row->s_pool;
if($pool == 1){	$pooltype = "None";}
if($pool == 2){	$pooltype = "Pool, Private (indoor)";}
if($pool == 3){	$pooltype = "Pool, Private (outdoor)"; }
if($pool == 7){	$pooltype = "Pool, Private (outdoor and indoor)";}
if($pool == 4){	$pooltype = "Pool, Community (indoor)";}
if($pool == 5){	$pooltype = "Pool, Community (outdoor)";}
if($pool == 6){	$pooltype = "Pool, Community (outdoor and indoor)";}
//display view as form input
echo form_input('pool', $pooltype);	?>
		<br/>
		
		
	<strong>Property Type:</strong><br/>
		<?php 
//convert property type into a new property type
$type = $row->id_type;
if($type == 1){	$propertytype = "6";}
if($type == 2){	$propertytype = "1";}
if($type == 3){	$propertytype = "7"; }
if($type == 4){	$propertytype = "4";}
if($type == 5){	$propertytype = "8";}
if($type == 6){	$propertytype = "12";}
if($type == 7){	$propertytype = "10";}
if($type == 8){	$propertytype = "9";}
if($type == 9){	$propertytype = "13";}
//display view as form input
echo form_input('property_type', $propertytype);	?>
		<br/>
		
	<strong>Status:</strong><br/>
		<?php 
//convert status into a string
$status = $row->id_status;
if($status == 1){	$sale_rent = "2"; $sold_rented = 0;}
if($status == 2){	$sale_rent = "1"; $sold_rented = 0;}
if($status == 3){	$sale_rent = "2"; $sold_rented = 1;}
if($status == 4){	$sale_rent = "1"; $sold_rented = 1;}
if($status == 5){	$sale_rent = "0"; $sold_rented = 0;}
if($status == 6){	$sale_rent = "0"; $sold_rented = 0;}

//display view as form input
echo form_input('sale_rent', $sale_rent);	?>
<br/>
<strong>Sold/Rented:</strong><br/>
<?php echo form_input('sold_rented', $sold_rented);?>
		<br/>
		
		<?=form_submit('submit', 'Import')?>
	<?=form_close()?>

</div>
		<?php endforeach;?>

</body>
</html>