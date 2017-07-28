<div id="mainslider" class="flexslider hidden-phone">
	<ul class="slides">
        <?php foreach($slideshow_images as $image):?>
        
         <li>
			<img src="<?=base_url() ?>images/slideshow/large/<?=$image->filename?>" alt="" />

		</li>
            <?=$image->filename?>
        <?php endforeach;?>
        
		
	</ul>

</div>

<div class="hidden-phone" style="position: relative;
background: rgba(51, 51, 51, 0.76);
padding: 10px;
color: #eee;
bottom: 48px;">
	<a href="<?=base_url() ?>premiere"><span class="btn btn-welcome">Premiere Properties</span></a>
	<i class="icon-arrow-left"></i> Click here to view our premiere properties

</div>


