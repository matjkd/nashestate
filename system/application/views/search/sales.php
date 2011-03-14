<form name="search" action="<?=base_url()?>search/content" method="post">
Minimum Cost
<?=form_dropdown('buyfrom', $saleprices, $saleincrements)?>
<br/>



Maximum Cost
<?=form_dropdown('buyto', $saleprices, "$max_sale_round")?>

<input type="submit" value="Submit" />
</form>
