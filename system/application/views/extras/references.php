
    
    <div id="paginate" style="margin-bottom:10px;">
    <?php foreach ($references as $row2): ?>
        <p>
        <img style="float:left; margin-right:3px;" height="28px;" src="<?= base_url() ?>images/icons/speech.png"/><em><?= $row2['testimonial'] ?></em>
        <br/>
        <strong><em>- <?= $row2['author'] ?>   </em></strong>
        </p>

    <?php endforeach; ?>

    </div>
