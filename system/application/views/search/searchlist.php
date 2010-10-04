<div id="search_heading">
		Minimum Beds:<?=$beds?>
		<br/><br/>
		
		<?php if($buyto > 0)
		{
		?>
		<strong>Buying</strong><br/>
		From: €<?=$buyfrom?>
		<br/>
		To: €<?=$buyto?>
		<br/><br/>
		<?php 
		}
		?>
		
		<?php if($rentto > 0)
		{
		?>
		<strong>Renting</strong><br/>
		From: €<?=$rentfrom?>
		<br/>
		To: €<?=$rentto?>
		<br/><br/>
		<?php 
		}
		?>
		
		<?=$list?>
</div>


		<?php foreach($properties as $property):?>
				<div id="search_list">
						<h3><?=$property['property_title']?></h3>
						<?=$property['sale_price']?><br/>
				</div>
		<?php endforeach;?>
