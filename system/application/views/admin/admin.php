<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php $this->load->view('global/header'); ?>
<?php 

$this->js_array = array(); 

$js_array[] = "test 2";
$js_array[] = "test 3";

?>

<body>
<div class="login"></div>
<?php $this->load->view('global/login'); ?>

<div class="mainwrap">

<div class="header">
<div class="adminlogo"></div>

</div>

<div class="topmenu"><?php $this->load->view('global/admin_menu'); ?></div>
<div style="clear:both;">
<?php

if(isset($company_name)) { echo  "".$company_name.": "; } 
if(isset($user_name)) { echo  "".$user_name.": "; }
		
?>
</div>
<div style="clear:both;"><?php $this->load->view('global/warning'); ?></div>

<div class="main_content">

<?php if(isset($heading)) { ?>

<h2><?=$heading?></h2>

<?php } ?>

<?php if(!isset($left_section))
	{?>
		
		<div class="full_content"><?php $this->load->view($right_main); ?></div>
		<?php 	
	}
else
	{
		?>
		<div class="left_admin">
		<?php $this->load->view($left_section); ?>
		</div>
		<div class="right_content"><?php $this->load->view($right_main); ?></div>
		
		<?php 
	} ?>
</div>
<div style="clear:both;"></div>
<div class="footer">

<?php print_r($js_array); ?>

</div>
</div>
</body>
</html>