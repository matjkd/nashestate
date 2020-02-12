<?php if ($featured_property != NULL) { ?>
<div id="property_box">

        <?php
        foreach ($featured_property as $row):
            $ref = $row['property_ref_no'];
            ?>

          
<div id="featuredproperty" class="featuredcycle" style="display:none; height:230px;">
        <?php foreach ($featured_images as $row2): ?>

                    <!-- Slideshow of featured property images-->
        
        <?php
                $localfile = "images/properties/".$ref."/medium/".$row2->filename; 
                $s3file =   "https://s3-eu-west-1.amazonaws.com/nashhomes/properties/".$ref."/medium/".$row2->filename;;      
                if (!file_exists($localfile)) {
                    $imagebase = "https://s3-eu-west-1.amazonaws.com/nashhomes/properties/";
                        
                    } else {
                        
                    $imagebase = base_url()."images/properties/";
        
        ?>
        

                    <img width="305px" height="227px;" src="<?=$imagebase?><?= $ref ?>/medium/<?= $row2->filename ?>">



                <?php endforeach; ?>
</div>
                 <div id="property_box_text" style="clear:both;"><strong><?php if(isset($featureheading)) { echo $featureheading; } ?> Property of the Week</strong></div>
               <a href="<?= base_url()?>property/display/<?= $ref ?>">   <?php
                $description = strip_tags($row['description']);
                $description = substr($description, 0, 70);
                echo "" . $description . "...";
                ?>
            </a>
    <?php endforeach; ?>
    </div>
    <?php
}
?>
