<form name="search" action="<?=base_url()?>search/content" method="post">
Minimum Monthly Rent:
<?=form_dropdown('rentfrom', $rentprices)?>
<br/>
<br/>

Maximum Monthly Rent:
<?=form_dropdown('rentto', $rentprices, $max_rent_round)?>
<br/>

<input type="submit" value="Submit" />
</form>