<h1>Premiere Properties</h1>

<div id="paginate" >
		<?php if($properties != NULL)
		{

                    foreach($properties as $property):?>

			

					<div  class="result row">

						<div class="span8 search_list  " id="search_content">
							<div class="row">
							<div class="span5">
								<p class="lead"><?=$property['property_title']?> </p>
								<?=$property['property_type_name']?> :: <?=$property['area']?><br/>
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

									?><br/>
										<a href="<?=base_url()?>property/display/<?=$property['property_ref_no']?>"><span class="btn btn btn-welcome">Read
						More</span></a>
									<br/>
								</p>




								<strong>Ref: &#35;<?=$property['property_ref_no']?> 	Price: <?=number_format($property['sale_price'])?> &euro;</strong>
								</div>

								<div  class="span3">
								<?php if(isset($property['filename'])) { ?>
								<img width="100%"  src="<?=base_url()?>images/properties/<?=$property['property_ref_no']?>/<?=$property['filename']?>">
								<?php  }?>
								</div>
								</div>
							</div>



					</div>

<?php endforeach;

                }?>
</div>