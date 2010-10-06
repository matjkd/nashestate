<?php echo form_open('admin/contacts/quick_add_company'); 
$datagroup = 'style="width:100px;"';?>
Group Name: <?php echo form_input('company_name', '', $datagroup); ?>&nbsp;&nbsp;
Group Type: <select name="company_type" >
<option value='1'>Vendor</option>
<option value='2'>Landlord</option>
<option value='3'>Agent</option>
<option value='4'>Other</option>
</select>
<div style="float:right;"><?php echo form_submit('quickadd', 'Quick Add Group');?></div>
<?php echo form_close();?>
<div style="clear:both; font-size: 0.7em;">Note: Adding a group like this will have no people in it. You have to add them by clicking the group name in the table below then adding people using the menu on the left titled 'Group Detail'.</div>