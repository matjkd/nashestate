<style>
#area_group {
width:170px;
float:left;
padding: 5px;

}
	#sortable { list-style-type: none; margin: 0; padding: 0;  }
	
	#sortable li { list-style-type: none; margin: 0 2px 3px 2px; padding: 0.2em; padding-left: 1.2em; float: left; }
	#sortable li span { position: absolute; margin-left: -1.3em; }
</style>

<?php echo form_open('admin/areas/add_area/');?>
<input type="text" name="area" id="area" style="width:150px; "/>
<?php echo form_submit( 'submit', 'Add Area');  ?>
<?php echo form_close();?>

<?php echo form_open('admin/areas/add_group/');?>
<input type="text" name="group" id="group" style="width:150px; "/>
<?php echo form_submit( 'submit', 'Add Group');  ?>
<?php echo form_close();?>
	
	
	<div id="sortable">
		<ul>
			<?php foreach($areas as $row):?>
					
						<li class="ui-state-default">
						<span></span><?=$row['area']?><div style="float:right;" class="ui-icon ui-icon-circle-close"></div>
						</li>
					
			<?php endforeach;?>
		</ul>
	</div>	
	
	<div style="clear:both;"></div>
	<?php foreach($groups as $row):?>
	
					<div id="area_group"> 
					<h1 class="ui-widget-header"><?=$row['group_name']?></h1> 
					<div class="ui-widget-content"> 
						
					<?php echo form_open('admin/areas/assign_area/'.$row['general_area_group_id'].'');?>
					
					<?php $options = array();
					foreach ($areas as $row2):
					
					$options[$row2['general_area_id']] = $row2['area'];
					
					endforeach;
					
					
					echo form_dropdown('area', $options);
					
					?>
					
					
					<?php echo form_submit( 'submit', 'Assign Area');  ?>
					<?php echo form_close();?>
					
					
						<ul>
						<?php foreach($areas_groups as $row3):?>
						
						<?php if($row3['group_id'] == $row['general_area_group_id']) {?>
					
							<li>
							
								<?=$row3['area']?>
							
							</li>
							
						<?php } ?>
					
						<?php endforeach;?>
		</ul>
						</div> 
					
						</div> 
	<?php endforeach;?>
	


 
 
 
