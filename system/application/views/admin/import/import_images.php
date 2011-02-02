<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<?php $this->load->view('global/header'); ?>

<body onload="initialize()"> 
<?=$this->load->view('global/warning')?>

Image import page
<?php $x = 0;?>
<?php foreach($images as $row):?>

<?php 
$filename = "../public_html/images/fotos/".$row->Foto;
$filenamethumb = "../public_html/images/fotos/th_".$row->Foto;
$fullpath = "/home/nh001/public_html/images/fotos/";
$newlocation = "/home/nh001/public_html/images/properties/".$row->id_property."/thumbs/".$row->Foto;
$newlocationthumb = "/home/nh001/public_html/images/properties/".$row->id_property."/thumbs/th_".$row->Foto;

echo $filename;
?>

<?php 

echo "<br/>";
if(!file_exists($newlocation))
{

	
	
	
if(!file_exists($filename))
{
	if(!file_exists($newlocationthumb))
	{
	
	if(file_exists($filenamethumb)){
   ?>
   <?php $x = $x + 1; echo $x;?>
   <img  src="<?=base_url()?>images/fotos/th_<?=$row->Foto?>"><br/>
   <br/>
   <?php $thumbfile = "th_".$row->Foto; ?>
	<?=form_open('admin/import/convert_images')?>
	
	<?=form_input('property_id', $row->id_property)?><br/>
	<?=form_input('fullpath', $fullpath)?><br/>
	<?=form_input('filename', $thumbfile)?><br/>
	<?=form_input('image_id', $row->Cod_img)?><br/>
	<?=form_submit('submit', 'Import')?><br/>
<?=form_close()?>
   
   
   
   <?php }
	}
}
else
{
echo "display file ";
	$x = $x + 1; echo $x;
	
 

?>
<br/>
<?=$row->id_property?> - <?=$filename?> - <?=$row->Cod_not?><br/>
<img width="100px" src="<?=base_url()?>images/fotos/<?=$row->Foto?>"><br/>

<br/>
<?=form_open('admin/import/convert_images')?>

<?=form_input('property_id', $row->id_property)?><br/>
<?=form_input('fullpath', $fullpath)?><br/>
<?=form_input('filename', $row->Foto)?><br/>
<?=form_input('image_id', $row->Cod_img)?><br/>
<?=form_submit('submit', 'Import')?><br/>
<?=form_close()?>

<?php } 
}?>


<?php endforeach;?>
</body>
</html>