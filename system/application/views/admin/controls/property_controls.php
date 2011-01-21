<style>
	#toolbar {
		padding:0px 0px;
		
		margin: 10px 0px 0px;
		
		background: #F6A828;
		font-size:0.8em;
	}
	#forward {
	float:right;
	}
	
	</style>
<script>

	$(function() {
		$( "#beginning" ).button({
			text: false,
			icons: {
				primary: "ui-icon-seek-start"
			}
		});
		$( "#rewind" ).button({
			text: false,
			icons: {
				primary: "ui-icon-seek-prev"
			}
		});
		$( "#play" ).button({
			text: false,
			icons: {
				primary: "ui-icon-play"
			}
		})
		
		$( "#stop" ).button({
			text: false,
			icons: {
				primary: "ui-icon-stop"
			}
		})
		.click(function() {
			$( "#play" ).button( "option", {
				label: "play",
				icons: {
					primary: "ui-icon-play"
				}
			});
		});
		$( "#forward" ).button({
			text: false,
			icons: {
				primary: "ui-icon-seek-next"
			}
		});
		$( "#end" ).button({
			text: false,
			icons: {
				primary: "ui-icon-seek-end"
			}
		});

		
		
		
	
		
		$( "#add_address" ).button().click(function() {
			$( "#dialog_address" ).dialog( "open" );
			return false;
		});
		
		
		
		$( "#repeat" ).buttonset();

		
	});

	
	
	</script>
<div id="toolbar" class="ui-widget-header ui-corner-all">
<a href="<?=base_url()?>admin/properties/update/<?=$previous_id?>"><button id="rewind">Previous Record</button></a>
<a href="<?=base_url()?>admin/properties/update/<?=$next_id?>"><button id="forward">Next Record</button></a>
</div>