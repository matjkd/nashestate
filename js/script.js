// remap jQuery to $
(function($){

 
})(this.jQuery);



// usage: log('inside coolFunc',this,arguments);
// paulirish.com/2009/log-a-lightweight-wrapper-for-consolelog/
window.log = function(){
  log.history = log.history || [];   // store logs to an array for reference
  log.history.push(arguments);
  if(this.console){
    console.log( Array.prototype.slice.call(arguments) );
  }
};



// catch all document.write() calls
(function(doc){
  var write = doc.write;
  doc.write = function(q){ 
    log('document.write(): ',arguments); 
    if (/docwriteregexwhitelist/.test(q)) write.apply(doc,arguments);  
  };
})(document);


  jQuery(function(){ jQuery("#paginate").pagination(); });

//wymeditor
jQuery(function() {
    jQuery('.wymeditor').wymeditor();
});

         

  





		

	 
//slideshow
$(document).ready(function() {

//searchbox fader

		var fadedelay = 300;
	    $('#button1').click(function () {
	        $('.original').fadeOut(fadedelay);
	         $('#back').fadeIn(fadedelay);
	         $('.one').delay(fadedelay).fadeIn(fadedelay);
	    });
	     $('#button2').click(function () {
	        $('.original').fadeOut(fadedelay);
	         $('#back').fadeIn(fadedelay);
	         $('.two').delay(fadedelay).fadeIn(fadedelay);
	    });
	     $('#button3').click(function () {
	        $('.original').fadeOut(fadedelay);
	         $('#back').fadeIn(fadedelay);
	         $('.three').delay(fadedelay).fadeIn(fadedelay);
	    });
	    
	    $('#back').click(function () {
	        $('.one').fadeOut(fadedelay); 
	         $('.two').fadeOut(fadedelay);
	         $('.three').fadeOut(fadedelay);
	          $('#back').fadeOut(fadedelay);
	         $('.original').delay(fadedelay).fadeIn(fadedelay);
	    });
	 

if ($("#s1").length > 0){
  // do something here

    $('#s1').cycle({
		fx: 'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...
		speedIn:  2000, 
	    speedOut: 2000, 
	   timeout:   5000 
	});
	$('.cycle').css("display", "block");
}

//slideshow
if ($("#ref").length > 0){
  // do something here
    $('#ref').cycle({
		fx: 'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...
		speedIn:  2000,
	    speedOut: 2000,
	   timeout:   25000
	});
	$('.cycle').css("display", "block");

}

//featured propertyslideshow
if ($("#featuredproperty").length > 0){
  // do something here
    $('#featuredproperty').cycle({
		fx: 'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...
		speedIn:  2000,
	    speedOut: 2000,
	   timeout:   5000
	});
	$('.featuredcycle').css("display", "block");
	
	}
if ($("#s2").length > 0){
    // run the code in the markup!
	$('#s2').cycle({ 
	    fx: 'blindX',
	    speed:    500, 
	    timeout:  7000  
	});
	
	}
    


//login dropdown

	$("div.panel_button").animate({top: "0px"});
	$("div.panel_button").click(function(){
		$("div#panel").animate({height: "55px"}).animate({height: "48px"}, "fast");
		$("div.panel_button").animate({top: "48px"}).toggle();

		
	});	
	
   $("div#hide_button").click(function(){
		$("div#panel").animate({height: "0px"}, "fast");
		$("div.panel_button").animate({top: "0px"});
	
   });
   
   
   

	




   
   // gallerific
   if ($("#thumbs").length > 0){
  // do something here

				// We only want these styles applied when javascript is enabled
				$('div.navigation').css({'width' : '300px', 'float' : 'left'});
				$('div.content').css('display', 'block');
				
 
				// Initially set opacity on thumbs and add
				// additional styling for hover effect on thumbs
				var onMouseOutOpacity = 0.67;
				$('#thumbs ul.thumbs li').opacityrollover({
					mouseOutOpacity:   onMouseOutOpacity,
					mouseOverOpacity:  1.0,
					fadeSpeed:         'fast',
					exemptionSelector: '.selected'
				});
				
				// Initialize Advanced Galleriffic Gallery
				var gallery = $('#thumbs').galleriffic({
					delay:                     2500,
					numThumbs:                 15,
					preloadAhead:              10,
					enableTopPager:            true,
					enableBottomPager:         true,
					maxPagesToShow:            7,
					imageContainerSel:         '#slideshow',
					controlsContainerSel:      '#controls',
					captionContainerSel:       '#caption',
					loadingContainerSel:       '#loading',
					renderSSControls:          true,
					renderNavControls:         true,
					playLinkText:              'Play Slideshow',
					pauseLinkText:             'Pause Slideshow',
					prevLinkText:              '&lsaquo; Previous Photo',
					nextLinkText:              'Next Photo &rsaquo;',
					nextPageLinkText:          'Next &rsaquo;',
					prevPageLinkText:          '&lsaquo; Prev',
					enableHistory:             false,
					autoStart:                 false,
					syncTransitions:           true,
					defaultTransitionDuration: 900,
					onSlideChange:             function(prevIndex, nextIndex) {
						// 'this' refers to the gallery, which is an extension of $('#thumbs')
						this.find('ul.thumbs').children()
							.eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
							.eq(nextIndex).fadeTo('fast', 1.0);
					},
					onPageTransitionOut:       function(callback) {
						this.fadeTo('fast', 0.0, callback);
					},
					onPageTransitionIn:        function() {
						this.fadeTo('fast', 1.0);
					}
				});
			
			
			}
			});
			
			
			//map
			if ($("#map_canvas").length > 0){
  // do something here
			var map;


 var nash = new google.maps.LatLng(39.535222, 2.571909);

/**
 * The HomeControl adds a control to the map that simply
 * returns the user to Chicago. This constructor takes
 * the control DIV as an argument.
 */

function HomeControl(controlDiv, map) {

  // Set CSS styles for the DIV containing the control
  // Setting padding to 5 px will offset the control
  // from the edge of the map
  controlDiv.style.padding = '5px';

  // Set CSS for the control border
  var controlUI = document.createElement('div');
  controlUI.style.backgroundColor = 'white';
  controlUI.style.borderStyle = 'solid';
  controlUI.style.borderWidth = '2px';
  controlUI.style.cursor = 'pointer';
  controlUI.style.textAlign = 'center';
  controlUI.title = 'Click to set the map to Home';
  controlDiv.appendChild(controlUI);

  // Set CSS for the control interior
  var controlText = document.createElement('div');
  controlText.style.fontFamily = 'Arial,sans-serif';
  controlText.style.fontSize = '12px';
  controlText.style.paddingLeft = '4px';
  controlText.style.paddingRight = '4px';
  controlText.innerHTML = '<b>Home</b>';
  controlUI.appendChild(controlText);

  // Setup the click event listeners: simply set the map to
  // Chicago
  google.maps.event.addDomListener(controlUI, 'click', function() {
    map.setCenter(seedbed)
  });

}



function initialize() {
  var myLatlng = new google.maps.LatLng(39.535222, 2.571909);
  var myOptions = {
      zoom: 16,
    center: nash,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
  
  var marker = new google.maps.Marker({
      position: nash, 
      map: map,
      title:"Nash Homes"
  });   
}

 google.maps.event.addDomListener(window, 'load', initialize);
 }




