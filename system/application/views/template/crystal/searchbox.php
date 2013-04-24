<?php $this -> searchVisible = 1; ?>

<div >
	<div class="accordion" id="accordion2">

		<div class="accordion-group">
			<div class="accordion-heading">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2"> <i class="icon-plus icon-white"></i> Search Properties for Sale </a>
			</div>
			<div id="collapse2" class="accordion-body collapse in">
				<div class="accordion-inner">
					<?=$this -> load -> view('search/salesBootstrap') ?>
				</div>
			</div>
		</div>
		<div class="accordion-group">
			<div class="accordion-heading">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse3"> <i class="icon-plus icon-white"></i> Search Properties for Rent </a>
			</div>
			<div id="collapse3" class="accordion-body collapse">
				<div class="accordion-inner">
					<?=$this -> load -> view('search/rentalsBootstrap') ?>
				</div>
			</div>
		</div>

		<div class="accordion-group">
			<div class="accordion-heading">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse1"> <i class="icon-minus icon-white"></i> Search All Properties </a>
			</div>
			<div id="collapse1" class="accordion-body collapse ">
				<div class="accordion-inner">
					<?=$this -> load -> view('search/bothBootstrap') ?>
				</div>
			</div>
		</div>
	</div>

</div>

<div style="background:#FF6827; padding:10px; height:30px; margin-bottom:5px;">
	<div>
	<form class="top-search pull-right" name="search" action="<?=base_url() ?>search/property_id" method="post">
		<input name="property_id" type="text" placeholder="Search for Property by ID" class="searchBox" style="margin:0px;  background:#fff;">
		<button type="submit" class="btn" style="height: 28px;
		 padding:0 5px;">
			<i class="icon-search"></i>
		</button>
	</form>
	</div>
</div>