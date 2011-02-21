<?php
$options = array(
					'1'  => 'Vendor',
					'2'    => 'Landlord',
					'3'   => 'Agent',
 					'4'   => 'Other',
                  
                );
?>
THIS DOESN'T WORK YET. I'LL REMOVE THIS MESSAGE WHEN IT DOES. THANK YOU!<br/>


<?php echo form_open('admin/properties/add_contact/'.$property_id.'');?>

	<?=form_label('Firstname', 'firstname')?>
	<input type="text" name="firstname" id="features" style="width:150px; "/><br/>
	
	<?=form_label('Lastname', 'lastname')?>
	<input type="text" name="lastname" id="features" style="width:150px; "/><br/>
	
	
	<?=form_label('Type', 'company_type')?>
	<?=form_dropdown('company_type', $options, set_value('company_type', '1'))?><br/>
	
	<?=form_label('Email', 'email')?>
	<input type="text" name="email" id="email" style="width:150px; "/><br/>
	
	<?=form_label('Phone', 'phone')?>
	<input type="text" name="phone" id="phone" style="width:150px; "/><br/>
	
	<?=form_label('Mobile', 'mobile')?>
	<input type="text" name="mobile" id="mobile" style="width:150px; "/><br/>

<?php echo form_submit( 'submit', 'Add New Contact to this property');  ?>