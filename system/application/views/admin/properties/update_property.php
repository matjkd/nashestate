<script type="text/javascript">
	$(function() {
		$("#tabs").tabs();
	});
	</script>
Please Note, all these pages are looking messy for the moment while I populate the fields and get the functionality working. It will be all neat and tidy by the time of completion.
<h2>Property ID: <?php echo $property_id;?></h2>
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Main Details</a></li>
		<li><a href="#tabs-2">Details 2</a></li>
		<li><a href="#tabs-3">Pictures</a></li>
		<li><a href="#tabs-4">Sales Data</a></li>
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
</div>
<div style="clear:both;"></div>

		<?=$this->load->view('admin/properties/rooms')?>

