<?php echo form_open('admin/contacts/quick_add_user'); 
$datauser = 'style="width:80px;"';

?>

First Name: <?php echo form_input('firstname', '', $datauser); ?>&nbsp;&nbsp;
Last Name: <?php echo form_input('lastname', '', $datauser); ?>
<?php echo form_hidden('company_name', 'N/A'); ?>&nbsp;&nbsp;
Type: <select name="company_type" >
<option value='1'>Vendor</option>
<option value='2'>Landlord</option>
<option value='3'>Agent</option>
<option value='4'>Other</option>
</select>


<div style="float:right;"><?php echo form_submit('quickadd', 'Quick Add Individual');?></div>
<?php echo form_close();?>
<div style="clear:both; font-size: 0.9em;">Note: Adding an individual also creates a Group for that person, though it will be called N/A. This is so you can still create related individuals.</div>