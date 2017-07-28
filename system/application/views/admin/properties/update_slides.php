<?=$this->load->view('admin/properties/property_details_js')?>




<h2><?php echo $property_id;?></h2>

<div style="clear:both;"></div>
<div id="tabs">
		<ul>
			
			<li><a href="#tabs-3">Pictures</a></li>
			
		</ul>
		
		<div id="tabs-3">
		<?=$this->load->view('admin/properties/property_form3')?>
		</div>
		
</div>
<div style="clear:both;"></div>

		

