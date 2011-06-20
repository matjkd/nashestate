<form name="search" action="<?=base_url()?>search/content" method="post">
Min Bedrooms
<?=form_dropdown('beds', $bedsnumbers, 0)?>
<br/>
Max Bedrooms
<?=form_dropdown('maxbeds', $bedsnumbers, 0)?>
<br/>


Minimum Monthly Rent:
<?=form_dropdown('rentfrom', $rentprices)?>
<br/>

Maximum Monthly Rent:
<?=form_dropdown('rentto', $rentprices, $max_rent_round)?>
<br/>

Location:
<select name="location">
	<option value="any">Any</option>
	<?php  foreach($general_areas as $area):?>
	<option value="<?=$area['general_area_id']?>"><?=$area['area']?></option>
	<?php endforeach; ?>
	
	</select>

<input type="submit" value="Submit" />
</form>