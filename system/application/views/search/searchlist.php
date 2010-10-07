<div id="search_heading">
		Minimum Beds:<?=$beds?>
		<br/><br/>
		
		<?php if($buyto > 0)
		{
		?>
		<strong>Buying</strong><br/>
		From: €<?=$buyfrom?>
		<br/>
		To: €<?=$buyto?>
		<br/><br/>
		<?php 
		}
		?>
		
		<?php if($rentto > 0)
		{
		?>
		<strong>Renting</strong><br/>
		From: €<?=$rentfrom?>
		<br/>
		To: €<?=$rentto?>
		<br/><br/>
		<?php 
		}
		?>
		
		<?=$list?>
</div>


		<?php if($properties != NULL)
		{
			  	foreach($properties as $property):?>
					
					<div id="search_list">
							
							<div id="search_content">
							<div style="height:85px;">
							<strong><?=$property['property_title']?></strong><br/>
							<p>
								<?php 
								$description = strip_tags($property['description']);
								$description = substr($description, 0, 180);
								echo "".$description."...";
								
								?>
									<a href="<?=base_url()?>property/display/<?=$property['property_ref_no']?>">Read More</a>
								<br/>
							</p>	
							</div>	
								
								
							
							<div style="float:left;"><strong>Ref: &#35;<?=$property['property_ref_no']?> 	Price: &euro;<?=$property['sale_price']?></strong></div>
							
							</div>
							
							<div id="search_thumb">
							<?php if(isset($property['filename'])) { ?>
							<img src="<?=base_url()?>images/properties/<?=$property['property_ref_no']?>/thumbs/<?=$property['filename']?>">
							<?php  }?>
							</div>
					<div style="clear:both;"></div>
					</div>
					
		<?php 
				endforeach;
		}
		?>
		
		<?php 	if($rentals != NULL)
		{
				foreach($rentals as $rentals):?>
				<div id="search_list">
						<div id="search_content">
						<div style="height:85px;">
						<strong><?=$rentals['property_title']?></strong><br/>
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
						<div style="float:left;"><strong>Ref: &#35;<?=$rentals['property_ref_no']?> 	Price: &euro;<?=$rentals['rent_price']?>  <?=$rentals['rent_period']?></strong></div>
						
				</div>
				<div id="search_thumb">
							<?php if(isset($rentals['filename'])) { ?>
							<img src="<?=base_url()?>images/properties/<?=$rentals['property_ref_no']?>/thumbs/<?=$rentals['filename']?>">
							<?php  }?>
							</div>
					<div style="clear:both;"></div>
					</div>
		<?php 
				endforeach;
		}
		?>
