<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php $this->load->view('global/header'); ?>

<body>
<?php $this->load->view('global/ie6warning'); ?>

<div class="login"></div>
<?php $this->load->view('global/login'); ?>

<div class="mainwrap">

<div class="header">
<div class="logo"></div>
<div class="tagline"><strong>Tel. +34 971 67 59 69</strong><br/>
Property Sales &amp; Rentals in South West Mallorca

</div>
</div>

<div class="topmenu"><?php $this->load->view('global/top_menu'); ?></div>
<div style="clear:both;"><?php $this->load->view('global/warning'); ?></div>

<div class="main_content">
<div class="left_content">
<?php $this->load->view('search/searchbox'); ?></div>
</div>
<div class="right_content">
<?php $this->load->view('slideshow/frontpage'); ?>

<?php echo $main_text;?>
</div>

</div>
<div style="clear:both;"></div>
<div class="footer"></div>

</body>
</html>