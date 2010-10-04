<style type="text/css">
	.ui-autocomplete {
		max-height: 200px;
		overflow-y: auto;
	}
	/* IE 6 doesn't support max-height
	 * we use height instead, but this forces the menu to always be this tall
	 */
	* html .ui-autocomplete {
		height: 200px;
	}
	#sortable { list-style-type: none; margin: 0; padding: 0; width: 400px; }
	#sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em;  }
	#sortable li span { position: absolute; margin-left: -1.3em; }
	</style>
	
<script type="text/javascript">
	$(function() {
		var availableTags = [<?php $this->load->view('ajax/ajax_features');?>];
		$("#features").autocomplete({
			source: availableTags
		});
	});
	$(function() {
		$("#sortable").sortable();
		$("#sortable").disableSelection();
		
	});
<!--
	function deletefeature(id) {
		var answer = confirm("are you sure you want to delete feature?")
		if (answer){
			
			window.location = "<?=base_url()?>admin/properties/delete_property_feature/"+ id;
		}
		else{
			alert("nothing deleted!")
		}
	}
//-->
</script>

<?php echo form_open('admin/properties/add_feature/'.$property_id.'');?>
<input type="text" name="feature" id="features" style="width:150px; "/>
<?php echo form_submit( 'submit', 'Add Feature');  ?>
<?php echo form_close();?>
<div id='features' style="padding-top:10px;">
Sorting doesn't work yet, I'll add this in future.
<ul id='sortable'>
<?php foreach($assigned_features as $key => $featurerow):?>
<li class="ui-state-default">
<span class="ui-icon ui-icon-arrowthick-2-n-s"></span><?=$featurerow['features']?><a href="<?=base_url()?>admin/properties/delete_property_feature/<?=$featurerow['pf_id']?>" ><div style="float:right;" class="ui-icon ui-icon-circle-close"></div></a>
</li>
<?php endforeach;?>
</ul>
</div>