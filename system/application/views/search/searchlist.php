 <script type="text/javascript">
        
            // This is a very simple demo that shows how a range of elements can
            // be paginated.
            // The elements that will be displayed are in a hidden DIV and are
            // cloned for display. The elements are static, there are no Ajax 
            // calls involved.
        
            /**
             * Callback function that displays the content.
             *
             * Gets called every time the user clicks on a pagination link.
             *
             * @param {int} page_index New Page index
             * @param {jQuery} jq the container with the pagination links as a jQuery object
             */
            function pageselectCallback(page_index, jq){
                var new_content = jQuery('#hiddenresult div.result:eq('+page_index+')').clone();
                $('#Searchresult').empty().append(new_content);
                return false;
            }
           
            /** 
             * Initialisation function for pagination
             */
            function initPagination() {
                // count entries inside the hidden content
                var num_entries = jQuery('#hiddenresult div.result').length;
              
                // Create content inside pagination element
                $("#Pagination").pagination(num_entries, {
                    callback: pageselectCallback,
                    items_per_page:'10' // Show only one item per page
                });
             }
            
            // When document is ready, initialize pagination
            $(document).ready(function(){      
                initPagination();
            });
            
            
            
        </script>

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


 <div id="Pagination"></div>
        <br style="clear:both;" />
        <div id="Searchresult">
            This content will be replaced when pagination inits.
        </div>
        
       <div id="hiddenresult" style="display:none;">
		<?php if($properties != NULL)
		{
			  	foreach($properties as $property):?>
				
				<?php 
				
				if($beds <= $property['rooms'] )
				{
					
				
				?>
					<div id="search_list" class="result">
							
							<div id="search_content">
							<div style="height:85px;">
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
							</div>	
								
								
							
							<div style="float:left;"><strong>Ref: &#35;<?=$property['property_ref_no']?> 	Price: &euro;<?=$property['sale_price']?></strong></div>
							
							</div>
							
							<div id="search_thumb">
							<?php if(isset($property['filename'])) { ?>
							<img width="134px" height="100px" src="<?=base_url()?>images/properties/<?=$property['property_ref_no']?>/thumbs/<?=$property['filename']?>">
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
		
		<?php 	if($rentals != NULL)
		{
				foreach($rentals as $rentals):?>
				
				<?php 
				
				if($beds <= $rentals['rooms'] )
				{
				
				?>
				<div id="search_list" class="result">
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
						<div style="float:left;"><strong>Ref: &#35;<?=$rentals['property_ref_no']?> 	Price: &euro;<?=$rentals['rent_price']?>  <?=$rentals['rent_period']?></strong></div>
						
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
