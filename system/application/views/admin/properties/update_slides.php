<script type="text/javascript">
    $(function() {
        $("#tabs").tabs();
    });
</script>



<h2><?php echo $property_id;?></h2>

<div style="clear:both;"></div>
<div id="tabs">
		<ul>
			
			<li><a href="#tabs-3">Pictures</a></li>
			
		</ul>
		
		<div id="tabs-3">
		<?=$this->load->view('admin/properties/slideshow_form')?>
		</div>
		
</div>
<div style="clear:both;"></div>

		

