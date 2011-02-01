Image import page

<?php foreach($images as $row):?>

<?php 
$filename = "../public_html/images/fotos/".$row->Foto;
$filenamethumb = "../public_html/images/fotos/th_".$row->Foto;
$fullpath = "/home/nh001/public_html/images/fotos/";
if(!file_exists($filename))
{
  if(file_exists($filenamethumb)){
   ?>
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
else
{
   echo "display file";
 

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

<?php } ?>


<?php endforeach;?>