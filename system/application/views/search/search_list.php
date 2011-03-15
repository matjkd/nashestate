<img width="270px" height="23px" src="<?=base_url()?>images/template/standard/titles/search_results.png"/>
  <div id="Searchresult"></div>
   
  <div id="Pagination" class="pagination"></div>
   <br style="clear:both;" />
  
	<div id="hiddenresult" style="display:none;">
		<?php if($properties != NULL)
		{
			  	foreach($properties as $property):?>
				
				<?php 
				
				if($beds <= $property['rooms'] )
				{
					
				
				?>
			
					<div id="search_list" class="result" >
							
							<div id="search_content">
							<div class="grid_11">
							<strong><?=$property['property_title']?> </strong><br/>
							Bedrooms: <?=$property['rooms']?><br/>
							<p>
								<?php 
								$description = strip_tags($property['description']);
								$description = substr($description, 0, 180);
								echo "".$description."...";
								
								?>
									<a href="<?=base_url()?>property/display/<?=$property['property_ref_no']?>">Read More</a>
								<br/>
							</p>	
							
								
								
							
							<strong>Ref: &#35;<?=$property['property_ref_no']?> 	Price: <?=number_format($property['sale_price'])?> &euro;</strong>
							</div>	
							
							<div  id="thumb">
							<?php if(isset($property['filename'])) { ?>
							<img width="180px" height="140px" src="<?=base_url()?>images/properties/<?=$property['property_ref_no']?>/medium/<?=$property['filename']?>">
							<?php  }?>
							</div>
							</div>
							
							
					<div style="clear:both;"></div>
					</div>
					
		<?php 
		}
				else
				{
				}
				
				endforeach;
		}
		?>
		
		<?php 	if($rentals != NULL)
		{
				foreach($rentals as $rentals):?>
				
				<?php 
				
				if($beds <= $rentals['rooms'] )
				{
				
				?>
				<div id="search_list" class="result" >
						<div id="search_content">
						<div style="height:85px;">
						<strong><?=$rentals['property_title']?></strong><br/>
						Bedrooms: <?=$rentals['rooms']?><br/>
						<p>
								<?php 
								$description = strip_tags($rentals['description']);
								$description = substr($description, 0, 180);
								echo "".$description."...";
								
								?>
								<a href="<?=base_url()?>property/display/<?=$rentals['property_ref_no']?>">Read More</a>
								<br/>
						</p>
						</div>	
						<div style="float:left;"><strong>Ref: &#35;<?=$rentals['property_ref_no']?> 	Price: &euro;<?=$rentals['rent_price']?> 
							 <?php 
							 if(isset($rentals['rent_period']))
							 {
							 	$rentals['rent_period'];
							 }
							 else
							 {
							 	echo "Monthly";
							 }
							 ?></strong></div>
						
				</div>
				<div id="search_thumb">
							<?php if(isset($rentals['filename'])) { ?>
							<img width="134px" height="100px" src="<?=base_url()?>images/properties/<?=$rentals['property_ref_no']?>/thumbs/<?=$rentals['filename']?>">
							<?php  }?>
							</div>
					<div style="clear:both;"></div>
					</div>
		<?php 
				}
				else
				{
				}
				
				endforeach;
		}
		?>
	</div>	
