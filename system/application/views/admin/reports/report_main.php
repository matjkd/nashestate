<?php 

$total = $saleactive + $salenotactive +$rentactive + $rentnotactive;

?>
Total Properties in Database <?=$total?>

<h4>Properties for Sale</h4>
<strong>Active Properties: <?=$saleactive?></strong> (<a href="<?=base_url()?>admin/properties/active_sold">of which <?=$sold?> are Sold</a>)
<br/>
<strong>Non Active Properties:<?=$salenotactive?></strong>  (<a href="<?=base_url()?>admin/properties/notactive_sold">of which <?=$soldnotactive?> are Sold</a>)

<h4>Properties for Rent</h4>
<strong>Active Properties: <?=$rentactive?></strong> (<a href="<?=base_url()?>admin/properties/active_rented">of which <?=$rented?> are Rented</a>)
<br/>
<strong>Non Active Properties:<?=$rentnotactive?></strong> (<a href="<?=base_url()?>admin/properties/notactive_rented">of which <?=$rentednotactive?> are Rented</a>)