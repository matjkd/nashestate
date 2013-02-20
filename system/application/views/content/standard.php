<h1><?=$title?></h1>

<p>
<?=$main_text?>
</p>

<?php if($extra != "") {?>
	<br/><br/>
	<?=$this->load->view($extra)?>
	
<?php } ?>
