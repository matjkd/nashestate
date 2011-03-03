<?php
$options = array(
					'1'  => 'Vendor',
					'2'    => 'Landlord',
					'3'   => 'Agent',
 					'4'   => 'Other',
                  
                );
?>
<br/>


<?php echo form_open('admin/properties/add_contact/'.$property_id.'');?>

	<?=form_label('Firstname', 'firstname')?>
	<input type="text" name="firstname" id="features" style="width:150px; "/><br/>
	
	<?=form_label('Lastname', 'lastname')?>
	<input type="text" name="lastname" id="features" style="width:150px; "/><br/>
	
	
	<?=form_label('Type', 'company_type')?>
	<?=form_dropdown('company_type', $options, set_value('company_type', '1'))?><br/>
	
	<?=form_label('Email', 'email')?>
	<input type="text" name="email" id="email" style="width:150px; "/><br/>
	
	<?=form_label('Home Phone', 'home_phone')?>
	<input type="text" name="home_phone" id="home_phone" style="width:150px; "/><br/>
	
	<?=form_label('Work Phone', 'work_phone')?>
	<input type="text" name="work_phone" id="work_phone" style="width:150px; "/><br/>
	
	<?=form_label('Mobile', 'mobile')?>
	<input type="text" name="mobile" id="mobile" style="width:150px; "/><br/>
<?php echo form_hidden('company_name', 'N/A'); ?>
<?php echo form_submit( 'submit', 'Add New Contact to this property');  ?>

<?php echo form_close();?>
