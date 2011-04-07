<img width="270px" height="23px" src="<?=base_url()?>images/template/standard/titles/<?=$content_menu?>.png"/>
<br/>
<br/>

<?=$main_text?>

<?php if($extra != "") {?>
	<br/><br/>
	<?=$this->load->view($extra)?>
	
<?php } ?>
