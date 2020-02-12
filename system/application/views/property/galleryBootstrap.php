<!-- Place somewhere in the <body> of your page -->
<div id="slider" class="flexslider">
  <ul class="slides">
    <?php foreach($property_images as $image):?>
    	
    	<li>
        <?php
          
            $imagefilename = "images/properties/".$image->property_id."/large/".$image->filename;
           if(file_exists($imagefilename)){
              
               $filelocation = "/large/".$image->filename;
           } else {
               $filelocation = "/medium/".$image->filename;
           }
           $localimage = "images/properties/".$image->property_id.$filelocation;
	   $baselocalimage = base_url().$localimage;	
		
        ?>
	<!-- <?=$baselocalimage?>-->	
    	<img  src="<?=base_url()?>images/properties/<?=$image->property_id?><?=$filelocation?>" alt="<?=$image->filename?>" />	
    	</li>
    	<?php endforeach; ?>
    <!-- items mirrored twice, total of 12 -->
  </ul>
</div>
<div id="carousel" class="flexslider">
  <ul class="slides slidethumbs">
    <?php foreach($property_images as $image):?>
    	<li>
    	<img  src="<?=base_url()?>/images/properties/<?=$image->property_id?>/thumbs/<?=$image->filename?>" alt="<?=$image->filename?>" />
    	</li>
    	
    	<?php endforeach; ?>
    <!-- items mirrored twice, total of 12 -->
  </ul>
</div>

<script type="text/javascript">
	$(window).load(function() {
  // The slider being synced must be initialized first
  $('#carousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 110,
    itemMargin: 0,
    asNavFor: '#slider'
  });
   
  $('#slider').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    sync: "#carousel"
  });
});
</script>
