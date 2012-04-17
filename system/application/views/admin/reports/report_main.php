<?php 

$total = $saleactive + $salenotactive +$rentactive + $rentnotactive;

?>
Total Properties in Database <?=$total?>

<h4>Properties for Sale</h4>
<strong>Active Properties: <?=$saleactive?></strong> (of which <?=$sold?> are Sold)
<br/>
<strong>Non Active Properties:<?=$salenotactive?></strong>  (of which <?=$soldnotactive?> are Sold)

<h4>Properties for Rent</h4>
<strong>Active Properties: <?=$rentactive?></strong> (of which <?=$rented?> are Rented)
<br/>
<strong>Non Active Properties:<?=$rentnotactive?></strong> (of which <?=$rentednotactive?> are Rented)