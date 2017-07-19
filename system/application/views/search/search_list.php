<h1>Search Results</h1>
<div class="search_list_heading">
	<?= $search_desc ?> 
</div>

<br style="clear: both;" />

<div id="paginate">
	<?php
    if($search_type == 1 || $search_type == 3) {
	if ($properties != NULL) {

		// Start of list main purchase
		foreach ($properties as $property):
		?>

	<?php
	if ($property['rooms'] >= $beds && $maxbeds >= $property['rooms']) {
		?>

	<div  class="result row">

		<div class="span8 search_list  " id="search_content">
			<div class="row">
			<div class="span6">
				<p class="lead"><?= $property['property_title'] ?></p>
				 <?= $property['property_type_name'] ?>
					:: <?= $property['area'] ?> <br/> Bedrooms:
				<?= $property['rooms'] ?>
				<?php 
if($property['sold_rented'] == 1) {?>
				<span style="color: #a80000;">: SOLD SUBJECT TO CONTRACT</span>
				<?php } ?>
				
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
					?><br/>
					<a 
						href="<?= base_url() ?>property/display/<?= $property['property_ref_no'] ?>"><span class="btn btn-welcome">Read
						More</span></a> <br />
				</p>




				<strong>Ref: &#35;<?= $property['property_ref_no'] ?> &nbsp; &nbsp;
					&nbsp; &nbsp; &nbsp; Price: <?= number_format($property['sale_price']) ?>
					&euro;
				</strong>
			</div>

			<div class="span2">
				<?php if (isset($property['filename'])) { ?>
				<img width="100%" 
					src="<?= base_url() ?>images/properties/<?= $property['property_ref_no'] ?>/<?= $property['filename'] ?>">
				<?php } ?>
			</div>
			</div>
		</div>



	</div>

	<?php
	} else {

	}

	endforeach;

	//end of list main purchase
	}
    
	echo "<br/> ";

	// Start of list nearby purchase
	if (isset($nearby) && $nearby != NULL) {
		foreach ($nearby as $property):
		?>

	<?php
	if ($property['rooms'] >= $beds && $maxbeds >= $property['rooms']) {
		?>

	<div  class="result row">

		<div class="span8 search_list  " id="search_content">
			<div class="row">
			<div class="span6">
				<p class="lead"><?= $property['property_title'] ?> </p> 
				<?= $property['property_type_name'] ?>
					:: <?= $property['area'] ?> <br /> Bedrooms:
				<?= $property['rooms'] ?>
				<br />
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
					?><br/>
					<a   href="<?= base_url() ?>property/display/<?= $property['property_ref_no'] ?>">
						<span class="btn btn btn-welcome">Read More</span>
						</a> <br />
				</p>




				<strong>Ref: &#35;<?= $property['property_ref_no'] ?> &nbsp; &nbsp;
					&nbsp; &nbsp; &nbsp; Price: <?= number_format($property['sale_price']) ?>
					&euro;
				</strong>
			</div>

				<div class="span2">
				<?php if (isset($property['filename'])) { ?>
				<img width="100%" 
					src="<?= base_url() ?>images/properties/<?= $property['property_ref_no'] ?>/<?= $property['filename'] ?>">
				<?php } ?>
			</div>
			</div>
		</div>



	</div>

	<?php
	} else {

	}

	endforeach;
	}
}
	//end of list main purchase
	
	?>

	<?php
    if ($search_type == 2 || $search_type == 3) {
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
	<div  class="result row">

		<div class="span8 search_list  " id="search_content">
			<div class="row">
			<div class="span6">
				<p class="lead"><?= $rentals['property_title'] ?> </p>
				<?= $rentals['property_type_name'] ?>
				::
				<?= $rentals['area'] ?>
				<br /> Bedrooms:
				<?= $rentals['rooms'] ?>
				<br />
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
					?><br/>
					<a 
						href="<?= base_url() ?>property/display/<?= $rentals['property_ref_no'] ?>">
						<span class="btn btn btn-welcome">Read More</span></a> <br />
				</p>




				<strong>Ref: &#35;<?= $rentals['property_ref_no'] ?> &nbsp; &nbsp;
					&nbsp; &nbsp; &nbsp; Price: <?= number_format($rentals['rent_price']) ?>&euro;
					per <?= $rental_period ?>
				</strong>
			</div>

			<div class="span2">
				<?php if (isset($rentals['filename'])) { ?>
				<img width="180px" height="140px"
					src="<?= base_url() ?>images/properties/<?= $rentals['property_ref_no'] ?>/medium/<?= $rentals['filename'] ?>">
				<?php } ?>
			</div>
			</div>
		</div>




	</div>
	<?php
	} else {

	}

	endforeach;

	//end of main rentals
	}
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
	<div  class="result row">

		<div class="span8 search_list  " id="search_content">
			<div class="row">
			<div class="span6">
				<p class="lead"><?= $rentals['property_title'] ?> </p>
				<?= $rentals['property_type_name'] ?>
				::
				<?= $rentals['area'] ?>
				<br /> Bedrooms:
				<?= $rentals['rooms'] ?>
				<br />
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
					?><br/>
					<a 
						href="<?= base_url() ?>property/display/<?= $rentals['property_ref_no'] ?>"><span class="btn">Read
						More</span></a> <br />
				</p>




				<strong>Ref: &#35;<?= $rentals['property_ref_no'] ?> &nbsp; &nbsp;
					&nbsp; &nbsp; &nbsp; Price: <?= number_format($rentals['rent_price']) ?>&euro;
					per <?= $rental_period ?>
				</strong>
			</div>

			<div class="span2">
				<?php if (isset($rentals['filename'])) { ?>
				<img width="180px" height="140px"
					src="<?= base_url() ?>images/properties/<?= $rentals['property_ref_no'] ?>/medium/<?= $rentals['filename'] ?>">
				<?php } ?>
			</div>
			</div>
		</div>




	</div>
	<?php
	} else {

	}

	endforeach;
	}
    }
	//end of nearby rentals
	
	?>
</div>
