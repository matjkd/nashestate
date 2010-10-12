{ <?php foreach($company_users as $members):?>
'<?=$members->user_id?>':'<?=$members->firstname?> <?=$members->lastname?>', 

<?php $selected = $members->user_id;?>
<?php endforeach; ?>
'selected':'<?=$selected?>'}