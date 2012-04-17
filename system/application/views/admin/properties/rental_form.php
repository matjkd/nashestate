<script>
    $(function() {
        $( "#datepicker" ).datepicker({
            dateFormat : 'DD, d MM, yy',
            onSelect : function(dateText, inst)
            {
                var epoch = $.datepicker.formatDate('@', $(this).datepicker('getDate')) / 1000 + 5000;

                $('#alternate').val(epoch);
            }
        });


        $( "#datepicker2" ).datepicker({
            dateFormat : 'DD, d MM, yy',
            onSelect : function(dateText, inst)
            {
                var epoch = $.datepicker.formatDate('@', $(this).datepicker('getDate')) / 1000 + 5000;

                $('#alternate2').val(epoch);
            }
        });


    });
</script>
<?php $format = 'l jS \of F Y'; ?>
<?php if($sales_data != NULL) {  foreach ($sales_data as $row): ?>
    <br/>

    <div id="featured_list">
        <div style="float:left;">Rented from:<?= date($format, $row->rented_date) ?> to <?= date($format, $row->rented_end) ?></div>


        <?php
        if ($row->unsold > 0) {
            $unsold = date($format, $row->unsold);
            echo "<span style='color:red;'> - Cancelled on $unsold</span>";
        } else {
            ?>

            <a href="<?= base_url() ?>admin/properties/unsell/<?= $row->sold_id ?>"><span style="float:right;" class="ui-icon ui-icon-close"></span></a>
    <?php } ?>
        <div style="clear:both;"></div>
    </div>
    <?php $rentaldate = TRUE; ?>
<?php endforeach; } ?>


<?php if (!$this->sold || !isset($rentaldate)) {
    echo form_open('admin/properties/rented/'); ?>
    <input type="hidden"  name="property_id" value="<?= $property_id ?>"/>

    Date Rented From:<br/>



    <input type="text" id="datepicker" name="startdate"/>
    <input type="hidden" id="alternate" name="startdate_unix"/><br/>
    To<br/>
    <input type="text" id="datepicker2" name="enddate"/>
    <input type="hidden" id="alternate2" name="enddate_unix"/>
    <?php echo form_submit('submit', 'Rented'); ?>
    <?php echo form_close();
} ?>


<?php if(isset($endDate)) {echo date($format, $endDate); }?>