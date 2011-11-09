<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <?php $this->benchmark->mark('code_start'); ?>

    <?php $this->load->view('global/header'); ?>

    <body onload="initialize()"> 
        <?php $this->load->view('global/ie6warning'); ?>

        <div class="login"></div>
        <?php $this->load->view('global/login'); ?>

        <div class="mainwrap">

            <div class="header">
                <div class="logo"></div>
                <div class="tagline"><strong>Tel. +34 971 67 59 69</strong><br/>
                    Property Sales &amp; Rentals in South West Mallorca

                </div>
            </div>

            <div class="topmenu"><?php $this->load->view('global/top_menu'); ?></div>
            <div style="clear:both;"><?php $this->load->view('global/warning'); ?></div>

            <div class="main_content">
                <div class="left_content">


                    <?php
                    $this->load->view($leftbox);
                    if (isset($side1)) {
                        $this->load->view($side1);
                    }
                    if (isset($side2)) {
                        $this->load->view($side2);
                    }
                    ?>

                </div>
            </div>

            <!--
            Determine whether to have wide or narrow text, narrow is for the gallery on a property
            -->
            <?php
            if (isset($narrow)) {
                ?>
                <div class="right_content_narrow"> 
                    <?php
                } else {
                    ?>
                    <div class="right_content">
                    <?php } ?>

                    <!--
                    end of narrow/wide check
                    -->

                    <?php
                    if (isset($slideshow)) {
                        $this->load->view('slideshow/' . $slideshow . '');
                    }
                    ?>


                    <?php $this->load->view($content); ?>
                </div>

            </div>
            <div style="clear:both;"></div>
            <div class="footer">
                <?php
                $this->load->view('global/footer');
                $this->benchmark->mark('code_end');
                echo $this->benchmark->elapsed_time('code_start', 'code_end');
                ?>
            </div>
        </div>

        <!--[if lt IE 7 ]>
            <script src="<?= base_url() ?>/js/dd_belatedpng.js"></script>
            <script> DD_belatedPNG.fix('img, .png_bg'); //fix any <img> or .png_bg background-images </script>
        <![endif]-->

    </body>
</html>