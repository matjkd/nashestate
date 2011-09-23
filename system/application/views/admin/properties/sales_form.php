<script>
	$(function() {
		$( "#datepicker" ).datepicker({
			dateFormat : 'DD, d MM, yy',
                        onSelect : function(dateText, inst)
                        {
                            var epoch = $.datepicker.formatDate('@', $(this).datepicker('getDate')) / 1000;

                            $('#alternate').val(epoch);
                        }
                        });

   
});
</script>
<?php $format = 'l jS \of F Y'; ?>
<?php foreach($sales_data as $row): ?>
<br/>

<div id="featured_list">
 <div style="float:left;">Sold on:<?=date($format, $row->sold_date)?></div>


 <?php if($row->unsold > 0) {
     $unsold = date($format, $row->unsold);
     echo "<span style='color:red;'> - Cancelled on $unsold</span>"; } else { ?>

 <a href="<?=base_url()?>admin/properties/unsell/<?=$row->sold_id?>"><span style="float:right;" class="ui-icon ui-icon-close"></span></a>
 <?php } ?>
</div>

<?php $saledate = TRUE;?>
<?php endforeach; ?>


<?php if(!$this->sold || !isset($saledate)) { echo form_open('admin/properties/sold/');?>
<input type="hidden"  name="property_id" value="<?=$property_id?>"/>

Date Sold:<br/>



<input type="text" id="datepicker" name="startdate"/>
<input type="hidden" id="alternate" name="startdate_unix"/>
<?php echo form_submit( 'submit', 'Sold');  ?>
<?php echo form_close(); }?>

