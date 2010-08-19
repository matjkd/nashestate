<script type="text/javascript">
$(document).ready(function() {
	$("div.panel_button").animate({top: "0px"});
	$("div.panel_button").click(function(){
		$("div#panel").animate({height: "55px"}).animate({height: "48px"}, "fast");
		$("div.panel_button").animate({top: "48px"}).toggle();

		
	});	
	
   $("div#hide_button").click(function(){
		$("div#panel").animate({height: "0px"}, "fast");
		$("div.panel_button").animate({top: "0px"});
	
   });	
	
});


</script>


 
  
  
  <div id="toppanel"> 
    <div id="panel"> 
      <div id="panel_contents">   <div> 
        <?php $this->load->view('user/login'); ?>
      </div> </div> 
     
    
    </div> 
    <div class="panel_button" style="margin:0 0 0 800px; position:absolute;  top:0px; "> <a href="#"><img src="<?=base_url()?>images/panel/panel_button.png"  alt="expand"/></a> </div> 
    <div class="panel_button" id="hide_button" style="display:none; top:48px; margin:0 0 0 800px; position:absolute;"><a href="#"><img src="<?=base_url()?>images/panel/panel_button.png" alt="collapse" /> </a> </div> 
  </div> 