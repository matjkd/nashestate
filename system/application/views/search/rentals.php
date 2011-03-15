<form name="search" action="<?=base_url()?>search/content" method="post">
Number of Bedrooms
<?=form_dropdown('beds', $bedsnumbers, 0)?>
<br/>


Minimum Monthly Rent:
<?=form_dropdown('rentfrom', $rentprices)?>
<br/>

Maximum Monthly Rent:
<?=form_dropdown('rentto', $rentprices, $max_rent_round)?>
<br/>

<input type="submit" value="Submit" />
</form>