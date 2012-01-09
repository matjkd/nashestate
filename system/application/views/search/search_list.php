<img width="270px" height="23px" src="<?= base_url() ?>images/template/standard/titles/search_results.png"/>
<div class="search_list_heading">
    <?= $search_desc ?>
</div>

<br style="clear:both;" />

<div id="paginate" >
    <?php
    if ($properties != NULL) {

        // Start of list main purchase
        foreach ($properties as $property):
            ?>

            <?php
            if ($property['rooms'] >= $beds && $maxbeds >= $property['rooms']) {
                ?>

                <div id="search_list" class="result" >

                    <div id="search_content">
                        <div class="grid_11">
                            <strong><?= $property['property_title'] ?>
                 <br/>
                                <?= $property['property_type_name'] ?> :: <?= $property['area'] ?></strong><br/>
                            Bedrooms: <?= $property['rooms'] ?> <?php 
if($property['sold_rented'] == 1) {?>
<span style="color:#a80000;">: SOLD SUBJECT TO CONTRACT</span>
<?php } ?><br/>
                            <p>
                                <?php
                                if ($property['alt_description'] == NULL) {
                                    $description = $property['description'];
                                } else {
                                    $description = $property['alt_description'];
                                }


                                $description = strip_tags($description);
                                $description = substr($description, 0, 130);
                                echo "" . $description . "...";
                                ?>
                                <a href="<?= base_url() ?>property/display/<?= $property['property_ref_no'] ?>">Read More</a>
                                <br/>
                            </p>	




                            <strong>Ref: &#35;<?= $property['property_ref_no'] ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;	Price: <?= number_format($property['sale_price']) ?> &euro;</strong>
                        </div>	

                        <div  id="thumb">
                            <?php if (isset($property['filename'])) { ?>
                                <img width="180px" height="140px" src="<?= base_url() ?>images/properties/<?= $property['property_ref_no'] ?>/medium/<?= $property['filename'] ?>">
                            <?php } ?>
                        </div>
                    </div>



                </div>

                <?php
            } else {
                
            }

        endforeach;

        //end of list main purchase
        echo "<br/> ";

        // Start of list nearby purchase
        if (isset($nearby) && $nearby != NULL) {
            foreach ($nearby as $property):
                ?>

                <?php
                if ($property['rooms'] >= $beds && $maxbeds >= $property['rooms']) {
                    ?>

                    <div id="search_list" class="result" >

                        <div id="search_content">
                            <div class="grid_11">
                                <strong><?= $property['property_title'] ?> <br/>
                                    <?= $property['property_type_name'] ?> :: <?= $property['area'] ?></strong><br/>
                                Bedrooms: <?= $property['rooms'] ?><br/>
                                <p>
                                    <?php
                                    if ($property['alt_description'] == NULL) {
                                        $description = $property['description'];
                                    } else {
                                        $description = $property['alt_description'];
                                    }


                                    $description = strip_tags($description);
                                    $description = substr($description, 0, 130);
                                    echo "" . $description . "...";
                                    ?>
                                    <a href="<?= base_url() ?>property/display/<?= $property['property_ref_no'] ?>">Read More</a>
                                    <br/>
                                </p>




                                <strong>Ref: &#35;<?= $property['property_ref_no'] ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;	Price: <?= number_format($property['sale_price']) ?> &euro;</strong>
                            </div>

                            <div  id="thumb">
                                <?php if (isset($property['filename'])) { ?>
                                    <img width="180px" height="140px" src="<?= base_url() ?>images/properties/<?= $property['property_ref_no'] ?>/medium/<?= $property['filename'] ?>">
                                <?php } ?>
                            </div>
                        </div>



                    </div>

                    <?php
                } else {
                    
                }

            endforeach;
        }

        //end of list main purchase
    }
    ?>

    <?php
    if ($rentals != NULL) {

        //start of main rentals
        foreach ($rentals as $rentals):
            ?>

            <?php
            //convert period if it is set
            if ($rentals['rent_period'] == "Weekly") {
                $rental_period = "week";
            }
            if ($rentals['rent_period'] == "Yearly") {
                $rental_period = "year";
            }
            if ($rentals['rent_period'] == "Monthly" || $rentals['rent_period'] == NULL) {
                $rental_period = "month";
            }

            if ($rentals['rooms'] >= $beds && $maxbeds >= $rentals['rooms']) {
                ?>
                <div id="search_list" class="result" >


                    <div id="search_content">
                        <div class="grid_11">
                            <strong><?= $rentals['property_title'] ?> </strong><br/>
                            <?= $rentals['property_type_name'] ?> :: <?= $rentals['area'] ?></strong><br/>
                            Bedrooms: <?= $rentals['rooms'] ?><br/>
                            <p>
                                <?php
                                if ($rentals['alt_description'] == NULL) {
                                    $description = $rentals['description'];
                                } else {
                                    $description = $rentals['alt_description'];
                                }


                                $description = strip_tags($description);
                                $description = substr($description, 0, 130);
                                echo "" . $description . "...";
                                ?>
                                <a href="<?= base_url() ?>property/display/<?= $rentals['property_ref_no'] ?>">Read More</a>
                                <br/>
                            </p>	




                            <strong>Ref: &#35;<?= $rentals['property_ref_no'] ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;	Price: <?= number_format($rentals['rent_price']) ?>&euro; per <?= $rental_period ?></strong>
                        </div>	

                        <div  id="thumb">
                            <?php if (isset($rentals['filename'])) { ?>
                                <img width="180px" height="140px" src="<?= base_url() ?>images/properties/<?= $rentals['property_ref_no'] ?>/medium/<?= $rentals['filename'] ?>">
                            <?php } ?>
                        </div> 
                    </div>




                </div>
                <?php
            } else {
                
            }

        endforeach;

        //end of main rentals
        //start of nearby rentals

        if (isset($nearbyrentals) && $nearbyrentals != NULL) {
            foreach ($nearbyrentals as $rentals):
                ?>

                <?php
                //convert period if it is set
                if ($rentals['rent_period'] == "Weekly") {
                    $rental_period = "week";
                }
                if ($rentals['rent_period'] == "Yearly") {
                    $rental_period = "year";
                }
                if ($rentals['rent_period'] == "Monthly" || $rentals['rent_period'] == NULL) {
                    $rental_period = "month";
                }

                if ($rentals['rooms'] >= $beds && $maxbeds >= $rentals['rooms']) {
                    ?>
                    <div id="search_list" class="result" >


                        <div id="search_content">
                            <div class="grid_11">
                                <strong><?= $rentals['property_title'] ?> </strong><br/>
                                <?= $rentals['property_type_name'] ?> :: <?= $rentals['area'] ?></strong><br/>
                                Bedrooms: <?= $rentals['rooms'] ?><br/>
                                <p>
                                    <?php
                                    if ($rentals['alt_description'] == NULL) {
                                        $description = $rentals['description'];
                                    } else {
                                        $description = $rentals['alt_description'];
                                    }


                                    $description = strip_tags($description);
                                    $description = substr($description, 0, 130);
                                    echo "" . $description . "...";
                                    ?>
                                    <a href="<?= base_url() ?>property/display/<?= $rentals['property_ref_no'] ?>">Read More</a>
                                    <br/>
                                </p>




                                <strong>Ref: &#35;<?= $rentals['property_ref_no'] ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;	Price: <?= number_format($rentals['rent_price']) ?>&euro; per <?= $rental_period ?></strong>
                            </div>

                            <div  id="thumb">
                                <?php if (isset($rentals['filename'])) { ?>
                                    <img width="180px" height="140px" src="<?= base_url() ?>images/properties/<?= $rentals['property_ref_no'] ?>/medium/<?= $rentals['filename'] ?>">
                                <?php } ?>
                            </div>
                        </div>




                    </div>
                    <?php
                } else {
                    
                }

            endforeach;
        }
        //end of nearby rentals
    }
    ?>
</div>	
