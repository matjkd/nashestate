<div  id="ref" class="cycle" style="display:none;">

<?php
/*
 * alternating shortened testimonials
 * 
 */
foreach ($references as $row):
    ?>
<div>

<img style="float:left; margin-right:3px;" height="28px;" src="<?= base_url() ?>images/icons/speech.png"/>

    <?php
    $shortnews = substr($row['testimonial'], 0, 200);
    $shortnews = substr($shortnews, 0, strrpos($shortnews, " "));
    $shortnews = strip_tags($shortnews, '<em><strong>');
    echo "<em>";
    echo trim($shortnews);
    echo "...";
    echo "</em>";
    ?> 

    <a href="<?= base_url() ?>welcome/show/references/<?= $row['testimonial_id'] ?>">Read More</a>
</div>
    <?php
endforeach;
?>
</div>