<section>

	<?php if ($featured_property != NULL) { ?>
<div class="property_box">
		
		<?php
foreach ($featured_property as $row):
$ref = $row['property_ref_no'];
		?>

		<div id="latestwork-sidebar" class="carousel slide">
			<div class="carousel-inner">
				<?php foreach ($featured_images as $row2):
				?>

				<!-- Slideshow of featured property images now checks s3 incoming -->
        <?php
                
	$imagebase = base_url()."images/properties/";
	$localfile = "images/properties/".$ref."/medium/".$row2->filename; 
                $s3file =   "https://s3-eu-west-1.amazonaws.com/nashhomes/properties/".$ref."/medium/".$row2->filename;      
                if (!file_exists($localfile)) {
                        
                    $imagebase = "https://s3-eu-west-1.amazonaws.com/nashhomes/properties/";
                        
                    } else {
			
                    $imagebase = base_url()."images/properties/";
		}
        
        ?>
				<div class="item"><a href="<?= base_url() ?>property/display/<?= $ref ?>"><img src="<?=imagebase?><?= $ref ?>/medium/<?= $row2 -> filename ?>" alt="photo"/></a>
				</div> 

				<?php endforeach; ?>
			</div>

		</div>

		
<div class="featured_text_box">			
<h3 class="widget-title">Property of the Week</h3>

		<a href="<?= base_url() ?>property/display/<?= $ref ?>"> <?php
			$description = strip_tags($row['description']);
			$description = substr($description, 0, 70);
			echo "" . $description . "...";
		?></a>
		<?php endforeach; ?>
	</div>
	</div>
	<?php } ?>

	<script type="text/javascript">
		$(document).ready(function() {
			$('.carousel').carousel({
				interval : 5000
			})
		});
	</script>
</section>
