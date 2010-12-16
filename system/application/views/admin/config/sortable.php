<style> 
	h1 { padding: .2em; margin: 0; }
	#products { float:left; width: 150px; margin-right: 2em; }
	#cart { width: 200px; float: left; }
	/* style the list to maximize the droppable hitarea */
	#cart ol { margin: 0; padding: 1em 0 1em 3em; }
	</style> 
	<script> 
	$(function() {
		
		$( "#catalog li" ).draggable({
			appendTo: "body",
			helper: "clone"
		});
		$( "#cart ol" ).droppable({
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			accept: ":not(.ui-sortable-helper)",
			drop: function( event, ui ) {
				$( this ).find( ".placeholder" ).remove();
				$( "<li></li>" ).text( ui.draggable.text() ).appendTo( this );
			}
		}).sortable({
			items: "li:not(.placeholder)",
			sort: function() {
				// gets added unintentionally by droppable interacting with sortable
				// using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options
				$( this ).removeClass( "ui-state-default" );
			}
		});
	});
	</script> 

<?php echo form_open('admin/areas/add_area/');?>
<input type="text" name="area" id="area" style="width:150px; "/>
<?php echo form_submit( 'submit', 'Add Area');  ?>
<?php echo form_close();?>

<?php echo form_open('admin/areas/add_group/');?>
<input type="text" name="group" id="group" style="width:150px; "/>
<?php echo form_submit( 'submit', 'Add Group');  ?>
<?php echo form_close();?>

 
<div class="demo"> 
	
<div id="products"> 
	<h1 class="ui-widget-header">Areas</h1>	
	<div id="catalog"> 
		<h3><a href="#">T-Shirts</a></h3> 
		<div> 
			<ul> 
				<?php foreach($areas as $row):?>
		
					<li><?=$row['area']?></li>
		
				<?php endforeach;?>
			</ul> 
		</div> 
		
	</div> 
</div> 

	<?php foreach($groups as $row):?>
	
	<div id="cart"> 
	<h1 class="ui-widget-header"><?=$row['group_name']?></h1> 
	<div class="ui-widget-content"> 
		<ol> 
			<li class="placeholder">Add your areas here</li> 
		</ol> 
	</div> 
	</div> 
	
	
	
	<?php endforeach;?>




 
</div><!-- End demo --> 
 
 
 
