<!doctype html>  

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ --> 
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>

        <?= $this->load->view('template/standard/header') ?>

    </head>

    <body>
        <?php $this->load->view('global/ie6warning'); ?>

        <div class="login"></div>
        <?php $this->load->view('global/login'); ?>




        <div id="container">


            <header>
                <div class="container_24">

                    <div class="grid_15">
                        <div class="logo"></div>
                    </div>

                    <div class="grid_9">
                        <div class="contacts"><img width="304px" height="49px" src="<?= base_url() ?>images/template/standard/titles/tel.png"/></div>
                    </div>
                </div>

            </header>




            <div class="container_24">
                <div class="topmenu"><?php $this->load->view('global/top_menu'); ?></div>
            </div>

            <div id="content" class="container_24">

                <div id="" class="grid_8 ">
                    <?= $this->load->view('search/search_box') ?>
                    <?php $this->load->view('global/warning'); ?>
                    <div style="height:8px;" class="clear">		</div>	
                    <div class="property_week">

                        <img width="250px" height="23px" src="<?= base_url() ?>images/template/standard/titles/property_of_the_week.png"/>
                        <?= $this->load->view('sidebar/property_of_week') ?>
                    </div>
                    <div style="height:8px;" class="clear">	</div>		



                </div>


                <div id="" class="grid_16 ">


                    <?php if (isset($slideshow)) { ?>
                        <div class="slidebox">
                            <?= $this->load->view('slideshow/' . $slideshow . '') ?> 


                        </div>

                        <div style="height:8px;" class="clear">	</div> 
                    <?php }
                    ?>	
                    <div class="contentbox">
   <?php $this->load->view('global/warning'); ?>
                    <?php $this->load->view($content); ?>
                    </div>


                </div>



            </div>



            <footer>
                <div class="container_24">
                    <div class="grid_24">
                        <div class="footerbox">
                            <div class="grid_8">
                                    <?php if(isset($references)) { $this->load->view('global/testimonials'); } ?>
                          &nbsp;
                            </div>
                              <div class="grid_15" style="width:620px;">
                     <?=$this->load->view('global/social_icons')?>
                                    &nbsp;
                            </div>
                        
                        </div>
                    </div>


                    <div class="grid_24">
<?= $this->load->view('template/standard/links') ?>
                    </div>

                </div>
            </footer>

        </div> 

        <!--! end of #container -->
<?= $this->load->view('template/standard/footer') ?>

    </body>
</html>


