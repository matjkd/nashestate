
<!-- Javascript at the bottom for fast page loading -->

<!-- Grab Google CDN's jQuery. fall back to local if necessary -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.js"></script>
<script>!window.jQuery && document.write(unescape('%3Cscript src="<?= base_url() ?>js/libs/jquery-1.5.0.js"%3E%3C/script%3E'))</script>

<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/jquery-ui.js"></script>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=<?= $config_maps_api ?>" type="text/javascript"></script>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script> 

<!-- scripts concatenated and minified via ant build script-->

<script src="<?= base_url() ?>js/wymeditor/jquery.wymeditor.min.js"></script>

<script src="<?= base_url() ?>js/libs/gallerific.js"></script>
<script src="<?= base_url() ?>js/paginate.js"></script>
<script src="<?= base_url() ?>js/plugins.js"></script>

<script src="<?= base_url() ?>js/script.js"></script>

<!-- end concatenated and minified scripts-->


<!--[if lt IE 7 ]>
  <script src="js/libs/dd_belatedpng.js"></script>
  <script> DD_belatedPNG.fix('img, .png_bg'); //fix any <img> or .png_bg background-images </script>
<![endif]-->



<!-- asynchronous google analytics: mathiasbynens.be/notes/async-analytics-snippet 
     change the UA-XXXXX-X to be your site's ID 
<script>
 var _gaq = [['_setAccount', 'UA-XXXXX-X'], ['_trackPageview']];
 (function(d, t) {
  var g = d.createElement(t),
      s = d.getElementsByTagName(t)[0];
  g.async = true;
  g.src = ('https:' == location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  s.parentNode.insertBefore(g, s);
 })(document, 'script');
</script>
-->