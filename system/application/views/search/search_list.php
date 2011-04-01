<img width="270px" height="23px" src="<?=base_url()?>images/template/standard/titles/search_results.png"/>
<div class="search_list_heading">
<?=$search_desc?>
</div>

    <br style="clear:both;" />
  <div id="Searchresult"></div>
   <div id="Pagination" class="pagination"></div> 
  
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
								<strong><?=$property['property_title']?> <br/>
								<?=$property['property_type_name']?> :: <?=$property['area']?></strong><br/>
								Bedrooms: <?=$property['rooms']?><br/>
								<p>
									<?php 
									$description = strip_tags($property['description']);
									$description = substr($description, 0, 130);
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
				//convert period if it is set
				if($rentals['rent_period'] == "weekly")
				{
				$rental_period = "week";	
				}
				if($rentals['rent_period'] == "yearly")
				{
				$rental_period = "year";	
				}
				
				
				if($beds <= $rentals['rooms'] )
				{
				
				?>
				<div id="search_list" class="result" >
						
						
						<div id="search_content">
								<div class="grid_11">
								<strong><?=$rentals['property_title']?> </strong><br/>
								<?=$rentals['property_type_name']?> :: <?=$rentals['area']?></strong><br/>
								Bedrooms: <?=$rentals['rooms']?><br/>
								<p>
									<?php 
									$description = strip_tags($rentals['description']);
									$description = substr($description, 0, 130);
									echo "".$description."...";
									
									?>
										<a href="<?=base_url()?>property/display/<?=$rentals['property_ref_no']?>">Read More</a>
									<br/>
								</p>	
								
									
									
								
								<strong>Ref: &#35;<?=$rentals['property_ref_no']?> 	Price: <?=number_format($rentals['rent_price'])?>&euro; per <?=$rental_period?> </strong>
								</div>	
								
								<div  id="thumb">
								<?php if(isset($rentals['filename'])) { ?>
								<img width="180px" height="140px" src="<?=base_url()?>images/properties/<?=$rentals['property_ref_no']?>/medium/<?=$rentals['filename']?>">
								<?php  }?>
								</div>
							</div>
						
						
						
						
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
