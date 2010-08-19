<script type="text/javascript">
tinyMCE.init({
	mode : "textareas",
	theme : "advanced"
	

		
	
});
</script>
<?php // Change the css classes to suit your needs    

$attributes = array('class' => 'form', 'id' => 'form');

if(isset($company))
{
	//print_r($company);
	foreach($company as $key => $company_row):
	
	echo "<label>Company Name:</label>".$company_row['company_name']."<br/><br/>";
	$company_id =  $company_row['company_id'];
	endforeach;
}


	foreach($property_details as $key => $row):

?>

<div id="property_forms">
<?php 

echo form_open('admin/properties/update_property2', $attributes);
echo form_hidden('property_id', $property_id); 	
$readonly = "DISABLED";
echo "<label>Company Name:</label>".$row->company_name."<br/><br/>";


?>


<?php echo form_fieldset('Tickboxes');
$x=0; ?>
       
       <table>
		<?php  foreach($features as $key => $value){
			$x = $x + 1;
        	if(in_array($key,$assigned_features)){
     		$checked = TRUE;
        	}
        	else
        	{
        	$checked = FALSE;
        	}
	    ?> 
     	<?php if($x==1){echo "<tr>";}?>
	     	<td>
	     	<?=form_checkbox('features[]', $key, $checked) . $value['features']?>
	     	</td>
     	 	<?php if($x==5){echo "</tr>";  $x=0;}?>
     	
	  
     	<?php } ?>
     
    </table>
     <?php echo form_fieldset_close(); ?>

<?php 
$textarea_data = array(
              'name'        => 'description',
              'id'          => 'description',
              'value'       => $row->description,
          
            
              'style'       => 'width:100%',
            );
		echo form_fieldset('Description');
		
		echo form_textarea($textarea_data);
		
		echo form_fieldset_close();
?>


    

       <br/> <?php echo form_submit( 'submit', 'Submit');  ?>


<?php 
endforeach;
echo form_close(); ?>
</div>