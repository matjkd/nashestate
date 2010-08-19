<script type="text/javascript">
	$(function() {
		$("#tabs").tabs();
	});
	</script>

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Create Property</a></li>
		<li><a href="#">Details 2</a></li>
		<li><a href="#">Pictures</a></li>
	</ul>
	<div id="tabs-1">
	
	<?=$this->load->view('admin/properties/property_form1')?>
	
	</div>
	<div id="tabs-2">
	</div>
	<div id="tabs-3">
		</div>
</div>
	

