<script language="javascript">
			<!--
			$(document).ready(
				function (){
					$("#pikame").PikaChoose();

					$("#pikame").jcarousel({scroll:4,					
						initCallback: function(carousel) 
						{
					        $(carousel.list).find('img').click(function() {
					        	//console.log($(this).parents('.jcarousel-item').attr('jcarouselindex'));
					            carousel.scroll(parseInt($(this).parents('.jcarousel-item').attr('jcarouselindex')));
					        });
					    }
				    });

				});
				
			-->
		</script>
		
		
<div style="width:400px; height: 300px; background:#333333;">



	<ul id="pikame" class="jcarousel-skin-pika">
		<li><a href="http://www.pikachoose.com"><img src="../1.jpg"/></a><span>Thanks to <a href="http://web.cara-jo.net">Cara Jo</a> for the awesome new themes!</span></li>
		<li><a href="http://www.pikachoose.com"><img src="../2.jpg"/></a><span>jCarousel is supported and integrated with PikaChoose!</span></li>
		<li><a href="http://www.pikachoose.com"><img src="../3.jpg"/></a><span>Let me know at jeremy.m.fry@gmail.com if you find any bugs!</span></li>
		<li><a href="http://www.pikachoose.com"><img src="../4.jpg"/></a><span>Caption</span></li>
		<li><a href="http://www.pikachoose.com"><img src="../5.jpg"/></a><span>Caption</span></li>
		<li><a href="http://www.pikachoose.com"><img src="../1.jpg"/></a><span>Caption</span></li>
		<li><a href="http://www.pikachoose.com"><img src="../2.jpg"/></a><span>Caption</span></li>
		<li><a href="http://www.pikachoose.com"><img src="../3.jpg"/></a><span>Caption</span></li>
		<li><a href="http://www.pikachoose.com"><img src="../4.jpg"/></a><span>Caption</span></li>
		<li><a href="http://www.pikachoose.com"><img src="../5.jpg"/></a><span>Caption</span></li>

	</ul>



</div>