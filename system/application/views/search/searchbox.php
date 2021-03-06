<?php 
	if(!isset($buyto))
			{
				$buyfrom = 0;
				$buyto = 0;
			}
			
	if(!isset($rentto))
			{
				$rentfrom = 0;
				$rentto = 0;
			}
	if(!isset($beds))
			{
				$beds = 0;
			}
?>

<script type="text/javascript">
	$(function() {
		$("#slider-range").slider({
			range: true,
			min: 0,
			max: 10000000,
			step: 25000,
			values: [<?=$buyfrom?>, <?=$buyto?>],
			slide: function(event, ui) {
				$("#amount").val('€' + ui.values[0] + ' - €' + ui.values[1]);
			}
		});
		$("#amount").val('€' + $("#slider-range").slider("values", 0) + ' - €' + $("#slider-range").slider("values", 1));
	});

	$(function() {
		$("#slider-range-rent").slider({
			range: true,
			min: 0,
			max: 5000,
			step: 25,
			values: [<?=$rentfrom?>, <?=$rentto?>],
			slide: function(event, ui) {
				$("#rent").val('€' + ui.values[0] + ' - €' + ui.values[1]);
			}
		});
		$("#rent").val('€' + $("#slider-range-rent").slider("values", 0) + ' - €' + $("#slider-range-rent").slider("values", 1));
	});
	
	$(function() {
		$("#slider-range-beds").slider({
			range: "max",
			min: 0,
			max: 10,
			value: <?=$beds?>,
			slide: function(event, ui) {
				$("#beds").val(ui.value);
			}
		});
		$("#beds").val($("#slider-range-beds").slider("value"));
	});
	</script>
<div id="search_box">
<form name="search" action="<?=base_url()?>search/content" method="post">
<span id="search_title">Property Search</span>


<fieldset>
<legend>Minimum number of bedrooms:</legend>


<div id="slider-range-beds"></div>
<input type="text" name="beds" id="beds" style="border:0; " />
</fieldset>

<?php 
if(isset($search_type) && $search_type == 2) 
	{
	echo form_hidden('search_type', '2');	
	}
	else
	{
	?>
<fieldset>

	<legend>Buying Price Range:</legend>
	
	
	<div id="slider-range"></div>
	<input type="text" name="amount" id="amount" style="border:0;  " />
	</fieldset>
		<?php 
	}
?>
	


<?php 
if(isset($search_type) && $search_type == 1) 
	{
 echo form_hidden('search_type', '1');	
	}
	else
	{
	?>
	
	<fieldset>
<legend>Rent Price Range Per Month:</legend>


<div id="slider-range-rent"></div>
<input type="text" name="rent" id="rent" style="border:0; " />
</fieldset>
	<?php 
	}
?>

<fieldset>
	<legend>Other</legend>
	<div style="width:190px; float:left;">
	Location:<br/><select name="location">
	<option value="any">Any</option>
	<?php  foreach($general_areas as $area):?>
	<option value="<?=$area['general_area_id']?>"><?=$area['area']?></option>
	<?php endforeach; ?>
	
	</select>
	</div>

	


	<div style="width:80px; float:left;">
	<input type="submit" value="Submit" />
	</div>
</fieldset>
</form>


</div>