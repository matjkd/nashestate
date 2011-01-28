
<?php // Change the css classes to suit your needs    

$attributes = array('class' => 'form', 'id' => 'form');



	foreach($property_details as $key => $row):
echo "<label>Company Name:</label>".$row->company_name."<br/><br/>";

?>
<!--
dropdown for selecting different company
-->

<?php echo form_open('admin/properties/change_owner/'.$property_id.'');?>
<?php
$options = array(
                  $row->company_id  => $row->company_name
                );

                
foreach($list_groups as $groups):  

	$group_id = $groups['company_id'];        
	$options[$group_id] = $groups['company_name'];
	
endforeach;
echo form_dropdown('groups', $options, $row->company_name); 
 
?>
<?php echo form_submit( 'submit', 'change group');  ?>
<?php echo form_close();?>


<div style="clear:both;"></div>
<div id='property_info'>



       <div class="admin_title">For Sale/Rent*</div>
       	<select id="sale_rent" name="sale_rent" DISABLED/>
		<option <?php if($row->sale_rent==1){echo "selected";} ?>value="1">For Sale</option>
		<option <?php if($row->sale_rent==2){echo "selected";} ?> value="2">For Rent</option>
		</select>



</div>  
<div style="clear:both;"></div>

<div class="admin_title">Title</div>
	<div class="admin_field" style="width:645px">
		<div class="editdetails" id="property_title" style="width:645px"  ><?php echo $row->property_title; ?></div>
	</div>
<div style="clear:both;"></div>


<div class="admin_left">

	
	
	<div class="admin_title">Individual:</div>
	<div class="admin_field">
		<div class="editmembers" id="user_id" ><?php echo $individual; ?></div>
	</div>
	
	<div class="admin_title">Date of Instruction:</div>
	<div class="admin_field">
		<div class="editdate" id="date_of_instruction"><?php echo $row->date_of_instruction; ?></div>
	</div>

	<div class="admin_title">Property Type:</div>
	<div class="admin_field">
		<div class="edittype" id="property_type" ><?php echo $row->property_type_name; ?></div>
	</div>
	
	<div class="admin_title">	Address 1:</div>
	<div class="admin_field">
		<div class="editdetails" id="property_address1"><?php echo $row->property_address1; ?></div>
	</div>

	<div class="admin_title">	Address 2:</div>
	<div class="admin_field">
		<div class="editdetails" id="property_address2"><?php echo $row->property_address2; ?></div>
	</div>
	
	<div class="admin_title">	Address 3:</div>
	<div class="admin_field">
		<div class="editdetails" id="property_address3"><?php echo $row->property_address3; ?></div>
	</div>
	
	<div class="admin_title">	Address 4:</div>
	<div class="admin_field">
		<div class="editdetails" id="property_address4"><?php echo $row->property_address4; ?></div>
	</div>
	
	<div class="admin_title">	Postcode:</div>
	<div class="admin_field">
		<div class="editdetails" id="property_address5"><?php echo $row->property_address5; ?></div>
	</div>


</div>

<div class="admin_right">

		
	<?php if($row->sale_rent==1){?>
	<div class="admin_title">Sale Price (&euro;)</div>
	<div class="admin_field">
		<div class="editdetails" id="sale_price" ><?php echo $row->sale_price; ?></div>
	</div>
	<div class="admin_title">Sale Payment</div>
	<div class="admin_field">
		<div class="editpayment" id="sale_payment" ><?php echo $row->sale_payment; ?></div>
	</div>
	<?php } ?>
	
	<?php if($row->sale_rent==2){?>
	<div class="admin_title">Rent Price (&euro;)</div>
	<div class="admin_field">
		<div class="editdetails" id="rent_price"><?php echo $row->rent_price; ?></div>
	</div>
				
	
	
	<div class="admin_title">Rent Period</div>
	<div class="admin_field">
		<div class="editperiod" id="rent_period" ><?php echo $row->rent_period; ?></div>
	</div>
	
	
		<div class="admin_title">Security Deposit</div>
	<div class="admin_field">
		<div class="editdetails" id="security_deposit" ><?php echo $row->security_deposit; ?></div>
	</div>	
	
		<div class="admin_title">Agency Commission</div>
	<div class="admin_field">
		<div class="editdetails" id="agency_commission" ><?php echo $row->agency_commission; ?></div>
	</div>				
		
	<?php } ?>
	
	<div class="admin_title">Community Fees</div>
	<div class="admin_field">
		<div class="editdetails" id="community_fees" ><?php echo $row->community_fees; ?></div>
	</div>
	
	<div class="admin_title">Available From</div>
	<div class="admin_field">
		<div class="editdate" id="available_from" ><?php echo $row->available_from; ?></div>
	</div>
	
	<div class="admin_title">Build Size (m2)</div>
	<div class="admin_field">
			<div class="editdetails" id="build_size"><?php echo $row->build_size; ?></div>
	</div>
	
	
	<div class="admin_title">Plot Size (m2)</div>
	<div class="admin_field">
			<div class="editdetails" id="plot_size" ><?php echo $row->plot_size; ?></div>
	</div>
	
	<div class="admin_title">Number of Floors</div>
	<div class="admin_field">
		<div class="editdetails" id="floors" ><?php echo $row->floors; ?></div>
	</div>
	
	<div class="admin_title">General Area</div>
	<div class="admin_field">
		<div  class="editarea" id="general_area"><?php echo $row->area; ?></div>
	</div>

	
</div>
  <div style="clear:both;"></div>




<div style="clear:both;"></div>
<?php 
endforeach;
?>
