<style>
    
    .searchselection { display:none;}
     .one { display:none;}
     .two { display:none; }
     .three { display:none; }
     #back { height:23px; width:23px; background:transparent; float:right; display:none;}
</style>

<div class="searchbox">
<img width="250px" height="23px" src="<?=base_url()?>images/template/standard/titles/property_search.png"/>		
<div id="back" style="cursor:pointer;"><img src="<?=base_url()?>images/template/standard/graphic/left_arrow.png" /></div>
			<div class="original">
				
					
					<div class="searchbox_content" id="button1" style="cursor:pointer;">
					Search All Properties
					</div>
					<div class="searchbox_content" id="button2" style="cursor:pointer;">
					Properties for Sale
					</div>
					<div class="searchbox_content" id="button3" style="cursor:pointer;">
					Properties for Rent
					</div>
					<div style="height:142px;"class="searchbox_content">
					&nbsp;
					</div>
					
					<div class="searchbox_content2">
					Search by ID
			</div>
			</div>
				
				
				<div class="one">	
				
					<div class="searchbox_content">
					Search All Properties
					</div>
				
					<div style="height:196px;"class="searchbox_content">
					&nbsp;
					</div>
						<div class="searchbox_content2">
					Search by ID
			</div>
				</div>
		
			
		
				<div class="two">	
					
					<div class="searchbox_content">
					Properties for sale
					</div>
				
					<div style="height:196px;"class="searchbox_content">
					<?=$this->load->view('search/sales')?>
					</div>
					<div class="searchbox_content2">
					Search by ID
			</div>
				</div>
			
			
			
				<div class="three">	
			
					<div class="searchbox_content">
					Properties for Rent
					</div>
				
					<div style="height:196px;"class="searchbox_content">
					&nbsp;
					</div>
					<div class="searchbox_content2">
					Search by ID
			</div>
				</div>
				
		
		
			
</div>


     
