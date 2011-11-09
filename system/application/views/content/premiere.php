<img width="270px" height="23px" src="<?=base_url()?>images/template/standard/titles/<?=$content_menu?>.png"/>
<br/>
<br/>
<div id="paginate" >
		<?php if($properties != NULL)
		{

                    foreach($properties as $property):?>

			

					<div id="search_list" class="result" >

							<div id="search_content">
								<div class="grid_11">
								<strong><?=$property['property_title']?> <br/>
								<?=$property['property_type_name']?> :: <?=$property['area']?></strong><br/>
								Bedrooms: <?=$property['rooms']?><br/>
								<p>
									<?php

								 if($property['alt_description'] == NULL)
									{
										$description = $property['description'];
									}
									else
									{
										$description = $property['alt_description'];
									}


									$description = strip_tags($description);
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

<?php endforeach;

                }?>
</div>