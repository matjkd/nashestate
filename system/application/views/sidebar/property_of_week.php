<?php if ($featured_property != NULL) { ?>
<div id="property_box">

        <?php
        foreach ($featured_property as $row):
            $ref = $row['property_ref_no'];
            ?>

          
<div id="featuredproperty" class="featuredcycle" style="display:none; height:230px;">
        <?php foreach ($featured_images as $row2): ?>

                    <!-- Slideshow of featured property images-->

                    <img width="305px" height="227px;" src="<?= base_url() ?>images/properties/<?= $ref ?>/medium/<?= $row2->filename ?>">



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
