
<?php
// Change the css classes to suit your needs    

$attributes = array('class' => 'form', 'id' => 'form');

if (isset($company)) {
    //print_r($company);
    foreach ($company as $key => $company_row):

        echo "<label>Company Name:</label>" . $company_row['company_name'] . "<br/><br/>";
        $company_id = $company_row['company_id'];
    endforeach;
}


foreach ($property_details as $key => $row):
    ?>

    <div id="property_forms">

        <?php
        echo form_open('admin/properties/create_property', $attributes);
        $readonly = "";

        echo form_hidden('company_id', $company_id);
        ?>
        <div id="search_heading" ><strong>ONLY USE IF ADDING OLD PROPERTIES:</strong> (also this feature is still in progress)<br/>
            <fieldset><label for="property_ref">Property Ref</label>
                <input id="property_ref" type="text" name="property_ref" maxlength="45" value=""  /></fieldset><br/>
        </div>


        <label for="individuals">Individual</label>

        <select id="user_id"  name="user_id" />
        <?php foreach ($company_users as $company_users): ?>
            
            <?php
            $individual_id = $company_users->user_id;

            if ($row->user_id == $individual_id) {
                $selectedValue ="selected";
            } else {
            	$selectedValue = "";
            }
            ?>

             <option <?=$selectedValue?>   value="<?= $company_users->user_id; ?>"><?= $company_users->firstname; ?> <?= $company_users->lastname; ?></option>
            <?php endforeach; ?>
    </select>

    <br/><label for="sale_rent">For Sale/Rent*</label>
    <select id="sale_rent"  name="sale_rent" <?= $readonly ?>/>
    <?php
        if ($row->sale_rent == 1) {
            $selectedValue1 = "selected";
        } else {
        	$selectedValue1 = "";
        }
            ?>
            
          <option  <?=$selectedValue1?> value="1">For Sale</option>
    <?php
    if ($row->sale_rent == 2) {
      $selectedValue2 = "selected";
    } else {
    	$selectedValue2 = "";
    }
            ?>
            <option <?=$selectedValue2?> value="2">For Rent</option>
    </select>




    <br/> <label for="property_type">Property Type*</label>

    <select id="property_type"  name="property_type" />
    <?php foreach ($property_types as $types): ?>
        <option <?php
        if ($row->property_type == $types['property_type_id']) {
            echo "selected";
        }
        ?> value="<?= $types['property_type_id']; ?>"><?= $types['property_type_name']; ?></option>
        <?php endforeach; ?>
    </select>



    <br/><label for="property_address1">Address1</label>

    <input id="property_address1" type="text" name="property_address1" maxlength="45" value="<?php echo $row->property_address1; ?>"  />



    <br/><label for="property_address2">Address2</label>

    <input id="property_address2" type="text" name="property_address2" maxlength="45" value="<?php echo $row->property_address2; ?>"  />



    <br/><label for="property_address3">Address3</label>

    <input id="property_address3" type="text" name="property_address3" maxlength="45" value="<?php echo $row->property_address3; ?>"  />



    <br/> <label for="property_address4">Address4</label>

    <input id="property_address4" type="text" name="property_address4" maxlength="45" value="<?php echo $row->property_address4; ?>"  />


    <br/><label for="property_address5">Postcode</label>

    <input id="property_address5" type="text" name="property_address5" maxlength="45" value="<?php echo $row->property_address5; ?>"  />


    <br/> <?php echo form_submit('submit', 'Submit'); ?>


    <?php
endforeach;
echo form_close();
?>
</div>