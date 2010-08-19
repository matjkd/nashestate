<div align=center><h1>Add Company</h1></div>

<fieldset>  
<?php
 
echo form_open('contacts/create_company');
echo form_label('Company Name', 'company_name');
echo form_input('company_name', set_value('company_name'));

echo form_label('Type', 'company_type');
$options = array(
					'1'  => 'Vendor',
					'2'    => 'Landlord',
					'3'   => 'Agent',
 					'4'   => 'Other',
                  
                );
echo form_dropdown('company_type', $options, set_value('company_type', '1'));

echo form_label('Company Description', 'company_desc');
echo form_input('company_desc', set_value('company_desc'));

echo form_label('email', 'company_nationality');
echo form_input('company_nationality', set_value('company_nationality'));


echo form_label('Phone', 'company_language');
echo form_input('company_language', set_value('company_language'));

echo form_label('Fax', 'resident');
echo form_input('resident', set_value('resident'));


echo form_submit('submit', 'add company');
?>

</fieldset>  


<?php echo validation_errors('<p class="error">'); ?>
