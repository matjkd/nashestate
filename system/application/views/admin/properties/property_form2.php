<script type="text/javascript">
jQuery(function() {
    jQuery('.wymeditor2').wymeditor();
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


<?php 
echo "<label>Company Name:</label>".$row->company_name."<br/><br/>";
$this->load->view('admin/properties/features_autocomplete');?>
<?php 
$description = $row->description;

endforeach;
$readonly = "DISABLED";


echo form_open('admin/properties/update_property2/'.$property_id.'', $attributes);

?>




<br/><br/>

<textarea name="description" id="description"  class="wymeditor2" style="width:100%;"><?=$description?></textarea>
		
	



    

<br/><input type="submit" class="wymupdate" />


<?php echo form_close(); ?>
