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
echo "<label>Company Name:</label>".$row->company_name."<br/><br/>";
$this->load->view('admin/properties/features_autocomplete');?>
<?php 

echo form_open('admin/properties/update_property2', $attributes);
echo form_hidden('property_id', $property_id); 	
$readonly = "DISABLED";



?>




<br/><br/>

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