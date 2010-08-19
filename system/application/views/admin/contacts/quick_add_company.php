<?php echo form_open('admin/contacts/quick_add_company'); ?>
Company Name<?php echo form_input('company_name'); ?>
Company Type<select name="company_type" >
<option value='1'>Vendor</option>
<option value='2'>Landlord</option>
<option value='3'>Agent</option>
<option value='4'>Other</option>
</select>
<?php echo form_submit('quickadd', 'Quick Add Company');?>
<?php echo form_close();?>