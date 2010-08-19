<script>
$(document).ready(function() {
	var uid = "<?=$property_id?>";

	
    $(".editdetails").editable("<?=site_url('admin/properties/editable_property1')?>", 
    	    {
    	    	indicator : 'Saving...',
    	    	id   : 'elementid',
    	    	onblur : 'submit',
    	        tooltip   : 'Click to edit...',
    	        submitdata : function() 
    	        {
    	            return {id : uid};
    }
    
        	        
    	    });
    

    $(".edittype").editable("<?=site_url('admin/properties/editable_property1')?>", 
    	    {
   	 data : <?php $this->load->view('ajax/property_types'); ?>,
     	    type   : "select",
     	    onblur : "submit",
     	    style  : "inherit",
     	    id   : 'elementid',     
     	        submitdata : function() 
     	        {
     	        return {id : uid};
    }
    
        	        
    	    });

    $(".editarea").editable("<?=site_url('admin/properties/editable_property1')?>", 
    	    {
   	 data : <?php $this->load->view('ajax/general_areas'); ?>,
     	    type   : "select",
     	    onblur : "submit",
     	    style  : "inherit",
     	    id   : 'elementid',     
     	        submitdata : function() 
     	        {
     	        return {id : uid};
    }
    
        	        
    	    });
    $(".editperiod").editable("<?=site_url('admin/properties/editable_property1')?>", 
    	    {
   	 data : <?php $this->load->view('ajax/rent_period'); ?>,
     	    type   : "select",
     	    onblur : "submit",
     	    style  : "inherit",
     	    id   : 'elementid',     
     	        submitdata : function() 
     	        {
     	        return {id : uid};
    }
    
        	        
    	    });

    $(".editpayment").editable("<?=site_url('admin/properties/editable_property1')?>", 
    	    {
   	 data : <?php $this->load->view('ajax/sale_payment'); ?>,
     	    type   : "select",
     	    onblur : "submit",
     	    style  : "inherit",
     	    id   : 'elementid',     
     	        submitdata : function() 
     	        {
     	        return {id : uid};
    }
    
        	        
    	    });

    
    $(".editdate").editable('<?=site_url('admin/properties/editable_property1')?>', {
        type: 'datepicker',
        tooltip: 'click to edit...',
        event: 'click',
        submit: 'OK',
        id   : 'elementid',
        cancel: 'Cancel',
        width: '200px',
        submitdata : function() 
        {
            return {id : uid};
}
   });
    

   
    
});
</script>	
<?php // Change the css classes to suit your needs    

$attributes = array('class' => 'form', 'id' => 'form');



	foreach($property_details as $key => $row):
echo "<label>Company Name:</label>".$row->company_name."<br/><br/>";
?>
      <div style="clear:both;"></div>


<div id="property_forms">


<div id='property_info'>



        <label for="sale_rent">For Sale/Rent*</label>
       	<select id="sale_rent" type="text" name="sale_rent" DISABLED/>
		<option <?php if($row->sale_rent==1){echo "selected";} ?>value="1">For Sale</option>
		<option <?php if($row->sale_rent==2){echo "selected";} ?> value="2">For Rent</option>
		</select>





 <table>
 	<tr>
	        <td class='leftcolumn'>
	        	Property Type
	        </td>
			<td>
				<div class="edittype" id="property_type" style="width:150px; float:left;"><?php echo $row->property_type_name; ?></div>
			</td>
	</tr>
	<tr>
	        <td class='leftcolumn'>
	        	Title
	        </td>
			<td>
				<div class="editdetails" id="property_title" style="width:150px; float:left;"><?php echo $row->property_title; ?></div>
			</td>
	</tr>
	<tr>
	        <td class='leftcolumn'>
	        	Address 1
	        </td>
			<td>
				<div class="editdetails" id="property_address1" style="width:150px; float:left;"><?php echo $row->property_address1; ?></div>
			</td>
	</tr>
	
	<tr>
	        <td class='leftcolumn'>
	        	Address 2
	        </td>
			<td>
				<div class="editdetails" id="property_address2" style="width:150px; float:left;"><?php echo $row->property_address2; ?></div>
			</td>
	</tr>
	
	<tr>
	        <td class='leftcolumn'>
	        	Address 3
	        </td>
			<td>
				<div class="editdetails" id="property_address3" style="width:150px; float:left;"><?php echo $row->property_address3; ?></div>
			</td>
	</tr>
	
	<tr>
	        <td class='leftcolumn'>
	        	Address 4
	        </td>
			<td>
				<div class="editdetails" id="property_address4" style="width:150px; float:left;"><?php echo $row->property_address4; ?></div>
			</td>
	</tr>
	
	<tr>
	        <td class='leftcolumn'>
	        	Postcode
	        </td>
			<td>
				<div class="editdetails" id="property_address5" style="width:150px; float:left;"><?php echo $row->property_address5; ?></div>
			</td>
	</tr>
</table> 
</div>  
<div id='property_info'>
Property Info
<table>
	<?php if($row->sale_rent==1){?>
	<tr>
	        <td class='leftcolumn'>
	        	Sale Price (&euro;)
	        </td>
			<td>
				<div class="editdetails" id="sale_price" style="width:150px; float:left;"><?php echo $row->sale_price; ?></div>
			</td>
	</tr>
	<tr>
	        <td class='leftcolumn'>
	        	Sale Payment
	        </td>
			<td>
				<div class="editpayment" id="sale_payment" style="width:150px; float:left;"><?php echo $row->sale_payment; ?></div>
			</td>
	</tr>
	<?php } ?>
	
	<?php if($row->sale_rent==2){?>
	<tr>
	        <td class='leftcolumn'>
	        	Rent Price (&euro;)
	        </td>
			<td>
				<div class="editdetails" id="rent_price" style="width:150px; float:left;"><?php echo $row->rent_price; ?></div>
			</td>
	</tr>
	<tr>
	        <td class='leftcolumn'>
	        	Rent Period
	        </td>
			<td>
				<div class="editperiod" id="rent_period" style="width:150px; float:left;"><?php echo $row->rent_period; ?></div>
			</td>
	</tr>
	<?php } ?>
	<tr>
	        <td class='leftcolumn'>
	        	Available From:
	        </td>
			<td>
				<div class="editdate" id="available_from" style="width:150px; float:left;"><?php echo $row->available_from; ?></div>
			</td>
	</tr>
	
	<tr>
	        <td class='leftcolumn'>
	        	Build Size (m2)
	        </td>
			<td>
				<div class="editdetails" id="build_size" style="width:150px; float:left;"><?php echo $row->build_size; ?></div>
			</td>
	</tr>
	
	<tr>
	        <td class='leftcolumn'>
	        	Plot Size (m2)
	        </td>
			<td>
				<div class="editdetails" id="plot_size" style="width:150px; float:left;"><?php echo $row->plot_size; ?></div>
			</td>
	</tr>
	
	<tr>
	        <td class='leftcolumn'>
	        	General Area
	        </td>
			<td>
				<div class="editarea" id="general_area" style="width:150px; float:left;"><?php echo $row->area; ?></div>
			</td>
	</tr>
</table>
</div> 
<div style="clear:both;"></div>
<?php 
endforeach;
?>
</div>