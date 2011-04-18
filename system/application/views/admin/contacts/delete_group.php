<?php foreach($group as $key => $row):?>
	<?php 
	$groupname = $row['company_name'];
	$group_id = $row['company_id'];
	?>
	<h1><?=$groupname?></h1>
<?php endforeach; ?>

<strong>The following properties will be deleted (if you wish to keep the property, click the id and change the group):</strong><br/>

<?php
if ($properties == NULL)
{
	echo "There are no property details listed here.";
}
else
{	
 foreach($properties as $key => $row):?>
	<a target="_blank" href="<?=base_url()?>admin/properties/update/<?=$row['property_ref_no']?>"><?=$row['property_ref_no']?></a><br/>
<?php endforeach; } ?>
<br/>
<br/>

<strong>The following users will be deleted:</strong><br/>

<?php 
if ($company_users == NULL)
{
	echo "There are no contact details listed here.";
}
else
{
foreach($company_users as $key => $row): ?>


<?=$row['firstname']?> <?=$row['lastname']?><br/>


<?php endforeach; } ?>
<br/>
<br/>

Are you sure you want to delete the <?=$groupname?> group and all of the above data (this can't be undone)?

<br/>
<br/>
<?=form_open('admin/contacts/delete_group_confirm')?>
<?=form_hidden('group_id', $group_id)?>
<?=form_submit('submit', 'Delete '.$group_id.'')?>
<?=form_close()?>
