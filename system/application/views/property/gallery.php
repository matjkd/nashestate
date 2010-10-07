<script language="javascript">
			<!--
			$(document).ready(
				function (){
					$("#pikame").PikaChoose();

					$("#pikame").jcarousel({scroll:4,					
						initCallback: function(carousel) 
						{
					        $(carousel.list).find('img').click(function() {
					        	//console.log($(this).parents('.jcarousel-item').attr('jcarouselindex'));
					            carousel.scroll(parseInt($(this).parents('.jcarousel-item').attr('jcarouselindex')));
					        });
					    }
				    });

				});
				
			-->
</script>
		
		
<div >

<ul id="pikame" class="jcarousel-skin-pika">
<?php foreach($property_images as $image):?>

<li><a alt="an image" href="<?=base_url()?>images/properties/<?=$image->property_id?>/<?=$image->filename?>" target="_blank"><img src="<?=base_url()?>/images/properties/<?=$image->property_id?>/medium/<?=$image->filename?>"/></a>

<?php if(isset($image->image_description)) { echo "<span>".$image->image_description."</span>"; }?></li>


<?php endforeach;?>
	
	
</ul>



</div>
<div style="clear:both;"></div>