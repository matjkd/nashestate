<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
	<!--<![endif]-->

	<head>
		<?php $base = base_url() . "css/crystal-theme/"; ?>
		<title><?= $title ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="google-site-verification" content="ux94X6e1wKnxN1VT7Fy2fz260ichCgHg7GvkR7YU7SY" />
		<meta name="viewport" content="width=100%, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
		
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=$base ?>images/apple-touch-icon-144-precomposed.png"/>
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=$base ?>images/apple-touch-icon-114-precomposed.png"/>
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=$base ?>images/apple-touch-icon-72-precomposed.png"/>
		<link rel="apple-touch-icon-precomposed" href="<?=$base ?>images/apple-touch-icon-57-precomposed.png"/>
		
		<link rel="shortcut icon" href="<?= base_url() ?>images/favicon.ico">
		<link rel="apple-touch-icon" href="<?= base_url() ?>images/apple-touch-icon.png">

		<link href="<?=$base ?>css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
		<link href="<?=$base ?>css/style.css" type="text/css" rel="stylesheet"/>
		<link href="<?=$base ?>css/prettyPhoto.css" type="text/css" rel="stylesheet"/>
		<link href="<?=$base ?>css/font-icomoon.css" type="text/css" rel="stylesheet"/>
		<link href="<?=$base ?>css/font-awesome.css" type="text/css" rel="stylesheet"/>
		<link href="<?=$base ?>css/custom.css" type="text/css" rel="stylesheet"/>
		<!--[if IE 7]>
		<link rel="stylesheet" href="assets/css/font-awesome-ie7.css"/>
		<![endif]-->
		<script type="text/javascript" src="//use.typekit.net/mtn4tpv.js"></script>
		<script type="text/javascript">
			try {
				Typekit.load();
			} catch(e) {
			}
		</script>
		
		<script type="text/javascript" src="<?=$base ?>js/jquery.min.js"></script>
		<script type="text/javascript" src="<?=$base ?>js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?=$base ?>js/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="<?=$base ?>js/jquery.quicksand.js"></script>
		<script type="text/javascript" src="<?=$base ?>js/superfish.js"></script>
		<script type="text/javascript" src="<?=$base ?>js/hoverIntent.js"></script>
		<script type="text/javascript" src="<?=$base ?>js/jquery.flexslider.js"></script>
		<script type="text/javascript" src="<?=$base ?>js/jflickrfeed.min.js"></script>
		<script type="text/javascript" src="<?=$base ?>js/jquery.prettyPhoto.js"></script>
		<script type="text/javascript" src="<?=$base ?>js/jquery.elastislide.js"></script>
		<script type="text/javascript" src="<?=$base ?>js/jquery.tweet.js"></script>
		<script type="text/javascript" src="<?=$base ?>js/smoothscroll.js"></script>
		<script type="text/javascript" src="<?=$base ?>js/jquery.ui.totop.js"></script>
		<script type="text/javascript" src="<?=$base ?>js/jquery.cycle.all.min.js"></script>
		<script src="<?= base_url() ?>js/paginate.js?2"></script>
		<script type="text/javascript" src="<?=$base ?>js/main.js"></script>
		<script type="text/javascript" src="<?=$base ?>js/ajax-mail.js"></script>
		
		<!--[if lt IE 9]>
		<script type="text/javascript"
		src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-19623681-10']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
	</head>

	<body>

		<!--top menu-->
		<section id="top-menu">
			<div class="container">
				<div class="row"></div>
			</div>
		</section>

		<!--header-->
		<header id="header">
			<div class="container">
				<div class="row header-top">
					<div class="span5 logo">
						<a class="logo-img" href="<?=base_url()?>" title="Nash Homes Mallorca"><img src="<?=base_url() ?>css/images/logo2.png" alt="Tabulate"></a>

					</div>
					<div class="span7 social-container" >
						<p class=" hidden-phone">
							<h2>Tel. +34 971 67 59 69</h2>
							Property Sales & Rentals in South West Mallorca
						</p>
						
						
						
					</div>
				</div>
				<div class="row header-nav">
					<div class="span12">
						<nav id="menu" class="clearfix">
							<ul>
								<?=$this -> load -> view('template/crystal/menu') ?>
							</ul>
						</nav>
						
					</div>
				</div>
				
			</div>
		</header>

		<!--slider-->
		 <?php if (isset($slideshow)) { ?>
		<?=$this->load->view('template/crystal/'.$slideshow)?>
		<?php } ?>

		<!--container-->
		<section id="container">
			<div class="container">
				
				
				<?php if(isset($property_display)) { ?>
					
					<div class="row">
					<div class="span6">

<?php $this->load->view('property/galleryBootstrap'); ?>
					</div>
					<div class="span6">

						<?=$this->load->view($content)?>

					</div>
				</div>
					
					<?php } else { ?>
				
				
				<div class="row">
					<div class="span4">
<?php if(!isset($this->searchVisible)) {?>
	
						<?=$this -> load -> view('template/crystal/searchbox') ?>
					
<?php } ?>
						<?=$this -> load -> view('sidebar/featured_property') ?>

					</div>
					<div class="span8">

						<?=$this->load->view($content)?>

					</div>
				</div>
				
				
				<?php } ?>

 <?php if (isset($latest_properties)) { ?>
				<div class="row">
					<hr>
					<div class="span12 our-works">
						<h3>Latest Properties</h3>
					</div>
					<div class="span12">
						
					
							
							
						<div id="our-projects" class="carousel bttop">
							<div class="carousel-wrapper">
								<ul class="portfolio">
									
										<?php foreach($latest_properties as $row): ?>
									<li>
										<a href="<?=base_url()?>property/display/<?=$row['property_ref_no']?>">
										<article>
											<div class="inner-image">
												 <img src="<?= base_url() ?>images/properties/<?=$row['property_ref_no']?>/<?=$row['filename']?>" alt=""/> <span class="frame-overlay"></span> 
											</div>
											<div class="sliding">
												<div class="inner-text">
													<h4 class="title"><?=$row['property_title']?></h4>
													
												</div>
											</div>
										</article>
										</a>
									</li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
						<script type="text/javascript">
							$(document).ready(function() {
								$('#our-projects').elastislide({
									imageW : 270,
									border : 0,
									minItems : 1,
									margin : 30
								});
							});
						</script>
					</div>
				</div>
				<?php } ?>

				<div class="row">
					<hr>
					<?=$this->load->view('template/crystal/testimonials')?>
				</div>
			</div>
		</section>

		<!--footer-->
		<footer id="footer">
			<div class="container">
				<div class="row">
					<div class="span4">
						<p><img src="<?=base_url() ?>images/logo2.png" alt="">
						</p>
						<address>

							<p>
								<i class="icon-map-marker"></i> Local 13, Ctra. Palma Andratx 43, Portals Nous, 07181 Calvià, Mallorca, Baleares, Spain.
							</p>
							<p>
								<i class="icon-phone"></i> +34 971 67 59 69
							</p>
							<p>
								<i class="icon-print"></i> +34 971 67 59 05
							</p>
							<p>
								<i class="icon-envelope"></i><a href="mailto:info@nashhomesmallorca.com">info@nashhomesmallorca.com</a>
							</p>
						</address>
					</div>
					<div class="span8">
						<div class="row">
							<div class="span8"></div>
							<div class="span8">

							</div>
						</div>
					</div>
					<div class="span4">
						<p class="heading">
							About Us
						</p>
						<p>
							Nash Homes Mallorca is a specialist property sales and rental agency for the South West of Mallorca, 
							particularly the up-market areas of Puerto Portals, Portals Nous, Bendinat, Costa den Blanes and country homes in Calvia and Capdella.
						</p>
					
					</div>
					<div class="span4">
						<p class="heading">
							Company
						</p>
						<ul class="footer-navigate">
							
							<?=$this->load->view('template/crystal/menu_footer')?>
							
						</ul>
					</div>
				</div>
			</div>
		</footer>

		<!--footer menu-->
		<section id="footer-menu">
			<div class="container">
				<div class="row">
					<div class="span4">
						<p class="copyright">
							&copy; Copyright 2013. Developed by <a href="http://www.redstudio.co.uk/">Redstudio Design Limited</a>.
						</p>
						
					<?=$this->load->view('user/modalLogin')?>




						
					</div>
					<div class="span8 hidden-phone">
						
					</div>
				</div>
			</div>
		</section>

	</body>
</html>