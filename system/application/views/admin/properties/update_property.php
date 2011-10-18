<?=$this->load->view('admin/properties/property_details_js')?>




<h2>Property ID: <?php echo $property_id;?></h2>
<div style="float:left;">
<?php echo form_open('admin/properties/change_property_ref/'.$property_id.'');?>

<?php



echo form_input('property_ref', $property_id); 
 
?>
<?php echo form_submit( 'submit', 'change property ref');  ?>
<?php echo form_close();?>
</div>
<div style="float:right;"><a href="<?=base_url()?>property/window_pdf/<?=$property_id?>">Print Window Display</a> | <a href="<?=base_url()?>property/pdf/<?=$property_id?>">standard pdf</a></div>
<div style="clear:both;"></div>
<div id="tabs">
		<ul>
			<li><a href="#tabs-1">Main Details</a></li>
			<li><a href="#tabs-2">Details 2</a></li>
			<li><a href="#tabs-3">Pictures</a></li>
			<li><a href="#tabs-4">Sales Data</a></li>
			<li><a href="#tabs-5">Create User</a></li>
		</ul>
		<div id="tabs-1">
	
		<?=$this->load->view('admin/properties/update_property_1')?>
	
		</div>
		<div id="tabs-2">
		<?=$this->load->view('admin/properties/property_form2')?>
		</div>
		<div id="tabs-3">
		<?=$this->load->view('admin/properties/property_form3')?>
		</div>
		<div id="tabs-4">
		<?=$this->load->view('admin/properties/property_form4')?>
		</div>
		<div id="tabs-5">
		<?=$this->load->view('admin/properties/property_form5')?>
		</div>
</div>
<div style="clear:both;"></div>

		<?=$this->load->view('admin/properties/rooms')?>
	<div style="clear:both;"></div>	
		<?=$this->load->view('admin/controls/property_controls')?>

