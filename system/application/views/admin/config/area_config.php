<style>
#area_group {
width:190px;
float:left;
margin: 8px;
padding:5px;
background: #dddddd;

}
#scroller {
height: 150px;
overflow:auto;
}
#area_list {
float:left;
display:block;
margin: 5px;
padding:5px;
background: #dddddd;
}
#sortable { list-style-type: none; margin: 0; padding: 0;  }
	
</style>

<?php echo form_open('admin/areas/add_area/');?>
<input type="text" name="area" id="area" style="width:150px; "/>
<?php echo form_submit( 'submit', 'Add Area');  ?>
<?php echo form_close();?>

<?php echo form_open('admin/areas/add_group/');?>
<input type="text" name="group" id="group" style="width:150px; "/>
<?php echo form_submit( 'submit', 'Add Group');  ?>
<?php echo form_close();?>
	

	
	<div style="clear:both;"></div>
	<?php foreach($groups as $row):?>
	
					<div id="area_group"> 
					<div><strong><?=$row['group_name']?></strong>
					
					<a href="<?=base_url()?>admin/areas/delete_group/<?=$row['general_area_group_id']?>" >
					<span style="float:right;" class="ui-icon ui-icon-circle-close"></span>
					</a>
					</div> 
					<br/>
					<div  class="ui-widget-content"> 
						
					<?php echo form_open('admin/areas/assign_area/'.$row['general_area_group_id'].'');?>
					
					
					<?php $options = array();
					foreach ($areas as $row2):
					
					$options[$row2['general_area_id']] = $row2['area'];
					
					endforeach;
					
					
					echo form_dropdown('area', $options);
					
					?>
					
					
					<?php echo form_submit( 'submit', 'Assign Area');  ?>
					<?php echo form_close();?>
					
					
						<div id="scroller">
							<?php foreach($areas_groups as $row3):?>
							
							<?php if($row3['group_id'] == $row['general_area_group_id']) {?>
						
								<div >
										<?=$row3['area']?> 
										<a href="<?=base_url()?>admin/areas/remove_area/<?=$row3['link_id']?>" >
										<span style="float:right;" class="ui-icon ui-icon-circle-close"></span>
										</a>
								</div>	<br/>
							
								
							<?php } ?>
						
							<?php endforeach;?>
						</div>
					</div> 
					
					</div> 
	<?php endforeach;?>
	
	<div style="clear:both;"></div>	
	
	<div id="sortable">
		
			<?php foreach($areas as $row):?>
					
					<div id="area_list">
						<div style="float:left;"><?=$row['area']?></div>
						<a href="<?=base_url()?>admin/areas/delete_area/<?=$row['general_area_id']?>" >
							<span style="float:right;" class="ui-icon ui-icon-circle-close"></span>
						</a>
					</div>
					
					
			<?php endforeach;?>
		
	</div>	

 
 
 
