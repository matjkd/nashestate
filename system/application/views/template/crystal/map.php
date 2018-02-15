
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=<?= $config_maps_api ?>" type="text/javascript"></script>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script> 
<script type="text/javascript"> 
  var nash = new google.maps.LatLng(39.535222, 2.571909);
  var parliament = new google.maps.LatLng(39.535222, 2.571909);
  var marker;
  var map;
 
  function initialize() {
    var mapOptions = {
      zoom: 16,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      center: nash
    };
 
    map = new google.maps.Map(document.getElementById("map_canvas"),
            mapOptions);
          
    marker = new google.maps.Marker({
      map:map,
      draggable:true,
      animation: google.maps.Animation.DROP,
      position: parliament
    });
    google.maps.event.addListener(marker, 'click', toggleBounce);
  }
 
  function toggleBounce() {
 
    if (marker.getAnimation() != null) {
      marker.setAnimation(null);
    } else {
      marker.setAnimation(google.maps.Animation.BOUNCE);
    }
  }
</script> 
<section id="map">
			<div class="container">
				<div class="row">
					<div id="sidebar" class=" pull-left span4 searchbox">
						<?=$this -> load -> view('template/crystal/searchbox') ?>
					</div>

					

					<div class="span8 searchbox">
						<div id="map_canvas" style="width: 100%; height: 303px;">
<iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.uk/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=nash+homes+mallorca&amp;aq=&amp;sll=38.284226,-2.921077&amp;sspn=13.646525,20.148926&amp;t=m&amp;ie=UTF8&amp;hq=nash+homes+mallorca&amp;hnear=&amp;ll=39.535424,2.571756&amp;spn=0.002896,0.00456&amp;z=17&amp;iwloc=B&amp;output=embed"></iframe><br /><small><a href="https://maps.google.co.uk/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=nash+homes+mallorca&amp;aq=&amp;sll=38.284226,-2.921077&amp;sspn=13.646525,20.148926&amp;t=m&amp;ie=UTF8&amp;hq=nash+homes+mallorca&amp;hnear=&amp;ll=39.535424,2.571756&amp;spn=0.002896,0.00456&amp;z=17&amp;iwloc=B" style="color:#0000FF;text-align:left">View Larger Map</a></small>

					</div>
				</div>
			</div>
    </div>
		</section>
