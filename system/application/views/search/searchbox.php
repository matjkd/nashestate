<script type="text/javascript">
	$(function() {
		$("#slider-range").slider({
			range: true,
			min: 0,
			max: 1000000,
			step: 25000,
			values: [0, 0],
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
			max: 1000,
			step: 25,
			values: [0, 0],
			slide: function(event, ui) {
				$("#rent").val('€' + ui.values[0] + ' - €' + ui.values[1]);
			}
		});
		$("#rent").val('€' + $("#slider-range-rent").slider("values", 0) + ' - €' + $("#slider-range-rent").slider("values", 1));
	});
	
	$(function() {
		$("#slider-range-beds").slider({
			range: "max",
			min: 1,
			max: 10,
			value: 2,
			slide: function(event, ui) {
				$("#beds").val(ui.value);
			}
		});
		$("#beds").val($("#slider-range-beds").slider("value"));
	});
	</script>
<div id="search_box">
<form name="search" action="<?=base_url()?>search/content" method="post">
<span id="search_title">Property Search</span><br/>
Use the sliders below to select criteria

<fieldset>
<legend>Minimum number of bedrooms:</legend>


<div id="slider-range-beds"></div>
<input type="text" id="beds" style="border:0; " />
</fieldset>

<fieldset>

<legend>Buying Price Range:</legend>


<div id="slider-range"></div>
<input type="text" id="amount" style="border:0;  " />
</fieldset>

<fieldset>

<legend>Rent Price Range Per Month:</legend>


<div id="slider-range-rent"></div>
<input type="text" id="rent" style="border:0; " />
</fieldset>

<fieldset>
<legend>Location</legend>
<div style="width:130px; float:left;">
Location:<br/><select name="location">
<option value="location">Locations here</option>
</select>
</div>

<div style="width:130px; float:left;">
Category:<br/><select name="category">
<option value="category">1</option>
</select>
</div>
</fieldset>


<input type="submit" value="Submit" />
</form>
</div>