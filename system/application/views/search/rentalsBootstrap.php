<form name="search" action="<?=base_url()?>search/content" method="post">

   <!-- <div class="searchinput">
<?=form_dropdown('beds', $bedsnumbers, 0)?>   <span class="searchlabel"> Min Bedrooms</span>
</div>
    <div class="searchinput">
<?=form_dropdown('maxbeds', $maxbedsnumbers, 0)?><span class="searchlabel">Max Bedrooms</span>
</div>


    <div class="searchinput">
<?=form_dropdown('rentfrom', $rentprices)?><span class="searchlabel">Min Monthly Rent</span>
</div>

    <div class="searchinput">
<?=form_dropdown('rentto', $rentprices, $max_rent_round)?><span class="searchlabel">Max Monthly Rent</span>
</div> -->
<?=form_hidden('search_type', '2')?>
    
  <!--  <div class="searchinput">
<select name="location">
	<option value="any">Any</option>
	<?php  foreach($general_areas as $area):?>
	<option value="<?=$area['general_area_id']?>"><?=$area['area']?></option>
	<?php endforeach; ?>
	
	</select><span class="searchlabel"> Location</span>
    </div> -->
    
    
     <div class="searchinput">
    <select name="location">
	<option value="any">Any</option>
	<?php  foreach($area_groups as $areagroup):?>
	<option value="<?=$areagroup['general_area_id']?>"><?=$areagroup['area']?></option>
	<?php endforeach; ?>
	
	</select><span class="searchlabel"> Location</span>
         </div>

<input class="btn btn-welcome pull-right submitsearch" type="submit" value="Submit" />
</form>