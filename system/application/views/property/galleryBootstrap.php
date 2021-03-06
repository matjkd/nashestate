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
		if(file_exists($localimage)){
			
		$theImage = $baselocalimage;
		$imageBase = base_url()."images/properties/";
		
		} else {
			
		
		$checklarge = "https://nashhomes.s3-eu-west-1.amazonaws.com/properties/".$image->property_id."/large/".$image->filename;
		if(file_exists($checklarge)){
			$theImage = "https://nashhomes.s3-eu-west-1.amazonaws.com/properties/".$image->property_id."/large/".$image->filename;
		} else {
		$theImage = "https://nashhomes.s3-eu-west-1.amazonaws.com/properties/".$image->property_id."/medium/".$image->filename;
		
		$imageBase = "https://nashhomes.s3-eu-west-1.amazonaws.com/properties/";
		}
		
		
		}
        ?>
	<!-- <?=$baselocalimage?>-->	
    	<img  src="<?=$theImage?>" alt="<?=$image->filename?>" />	
    	</li>
    	<?php endforeach; ?>
    <!-- items mirrored twice, total of 12 -->
  </ul>
</div>
<div id="carousel" class="flexslider">
  <ul class="slides slidethumbs">
    <?php foreach($property_images as $image):?>
    	<li>
    	<img  src="<?=$imageBase?><?=$image->property_id?>/thumbs/<?=$image->filename?>" alt="<?=$image->filename?>" />
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
