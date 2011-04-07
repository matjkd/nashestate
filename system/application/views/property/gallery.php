
<link rel="stylesheet" href="<?=base_url()?>css/gallerific.css">
<div class="slideshow-container"> 
	<div id="loading" class="loader" style="display: none"></div>
	<div id="slideshow" class="slideshow"></div> 
</div>
<div id="caption" class="caption-container"></div>
<div id="thumbs" >
    <ul class="thumbs noscript">
    	<?php foreach($property_images as $image):?>
        <li>
            <a class="thumb" name="optionalCustomIdentifier" href="<?=base_url()?>images/properties/<?=$image->property_id?>/<?=$image->filename?>" title="<?=$image->filename?>">
                <img  src="<?=base_url()?>/images/properties/<?=$image->property_id?>/thumbs/<?=$image->filename?>" alt="<?=$image->filename?>" />
            </a>
           <?php if(isset($image->image_description)) { echo "<div class='caption'>".$image->image_description."</div>"; }?>
        </li>
        <?php endforeach;?>
       
    </ul>
</div>



