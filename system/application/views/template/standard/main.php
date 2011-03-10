<!doctype html>  

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ --> 
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
 
<?=$this->load->view('template/standard/header')?>

</head>

<body onload="initialize()" onunload="GUnload()">





  <div id="container">
  	
    <header>
   <header>
    	<div class="container_24">
	    	
	    	<div class="grid_15">
			<div class="logo"></div>
			</div>
		    
			<div class="grid_9">
			<div class="contacts"><img width="304px" height="49px" src="<?=base_url()?>images/template/standard/titles/tel.png"/></div>
			</div>
    	</div>
    		
    </header>
   	
   	<div class="container_24">
		<div class="topmenu"><?php $this->load->view('global/top_menu'); ?></div>
	</div>
     
    <div class="container_24">
		<div class="grid_8">
			<?=$this->load->view('search/search_box')?>
		</div>
		<div class="grid_16">
			<div class="slidebox">
				
				<div id="slide">
					<img src="<?=base_url()?>images/slides/slide1.jpg"/>
				</div>
				
			</div>
		</div>
	</div>    
	
	<div style="height:8px;" class="clear">	</div>
	
	  <div class="container_24">
		<div class="grid_8">
			<div class="property_week">
				<img width="250px" height="23px" src="<?=base_url()?>images/template/standard/titles/property_of_the_week.png"/>
				
			</div>
		</div>
		<div class="grid_16">
			<div class="contentbox">
				
				<img width="245px" height="23px" src="<?=base_url()?>images/template/standard/titles/welcome.png"/>
				
			</div>
		</div>
	</div>   
	<div style="height:8px;" class="clear">	</div> 
    <footer>
		<div class="container_24">
				<div class="grid_24">
					<div class="footerbox"></div>	
				</div>
		</div>
    </footer>
  </div> 

<!--! end of #container -->
<?=$this->load->view('template/standard/footer')?>
  
</body>
</html>


