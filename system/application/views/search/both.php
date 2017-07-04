<form name="search" action="<?=base_url()?>search/content" method="post">

  <div id="searchinput">
<?=form_dropdown('beds', $bedsnumbers, 0)?> <span id="searchlabel">Min Bedrooms</span>
    </div>

        <div id="searchinput">
<?=form_dropdown('maxbeds', $maxbedsnumbers, 0)?> <span id="searchlabel">Max Bedrooms</span>
 </div>


    <div id="searchinput">
<?=form_dropdown('buyfrom', $saleprices, $saleincrements)?><span id="searchlabel"> Minimum Cost</span>
 </div>



    <div id="searchinput">
<?=form_dropdown('buyto', $saleprices, "$max_sale_round")?> <span id="searchlabel">Maximum Cost</span>
 </div>






    <div id="searchinput">
<?=form_dropdown('beds', $bedsnumbers, 0)?> <span id="searchlabel">Number of Bedrooms</span>
 </div>


    <div id="searchinput">
<?=form_dropdown('rentfrom', $rentprices)?><span id="searchlabel"> Minimum Monthly Rent</span>
 </div>

    <div id="searchinput">
<?=form_dropdown('rentto', $rentprices, $max_rent_round)?><span id="searchlabel"> Maximum Monthly Rent</span>
 </div>

    <div id="searchinput">
<select name="location">
	<option value="any">Any</option>
	<?php  foreach($general_areas as $area):?>
	<option value="<?=$area['general_area_id']?>"><?=$area['area']?></option>
	<?php endforeach; ?>
	
	</select><span id="searchlabel"> Location</span>
         </div>
  
<input  type="submit" value="Submit" id="submitsearch" />
</form>