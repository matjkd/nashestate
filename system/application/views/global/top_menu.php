
<div id="menu">
       <ul class="menu">
       
       
       
       
      
       

		
 		<li <?php if($page=='0'){echo "class='current'";}?>>
        <a href="<?=base_url()?>index.php?welcome/content/home"><span>Home</span></a></li>
		
        <li <?php if($page=='1'){echo "class='current'";}?>>
        <a href="<?=base_url()?>index.php?welcome/content/about_us"><span>About Us</span></a></li>   
       
       <li <?php if($page=='2'){echo "class='current'";}?>>
        <a href="<?=base_url()?>index.php?welcome/content/what_we_can_do_for_you"><span>What we can do for you</span></a>
        
        
						<ul>
						<li><a href="<?=base_url()?>index.php?welcome/content/services_buyers"><span>Services to Buyers</span></a></li>
						<li><a href="<?=base_url()?>index.php?welcome/content/services_sellers"><span>Services to Sellers</span></a></li>
						<li><a href="<?=base_url()?>index.php?welcome/content/services_landlords"><span>Services to Landlords</span></a></li>
						<li><a href="<?=base_url()?>index.php?welcome/content/services_tenants"><span>Services to Tenants</span></a></li>
						
						
						</ul>
        
        </li>   
           
           <li <?php if($page=='3'){echo "class='current'";}?>>
        <a href="<?=base_url()?>index.php?welcome/content/where_we_are"><span>Where we are</span></a></li>   
        
           <li <?php if($page=='4'){echo "class='current'";}?>>
        <a href="<?=base_url()?>index.php?welcome/content/guide_to_buying_or_selling"><span>Guide to Buying or Selling</span></a></li>   
        
           <li <?php if($page=='8'){echo "class='current'";}?>>
        <a href="<?=base_url()?>index.php?welcome/content/references"><span>References</span></a></li>   
        
           <li <?php if($page=='6'){echo "class='current'";}?>>
        <a href="<?=base_url()?>index.php?welcome/content/contact_us"><span>Contact Us</span></a></li>        
       
       <?php 
       
       $role = $this->session->userdata('role');
				if(!isset($role) || $role != 1)
					{
						?>
						
					<?php 
					}
					else
					{
					?>
				
					<li <?php if($page=='admin')
						{
							echo "class='current last'";
						}
						else
						{
							echo "class='last'";
						}
					
						?>>
						<a href="<?=base_url()?>admin/contacts">
						<span >Admin</span></a>
						
						<ul>
						<li><a href="<?=base_url()?>admin/contacts"><span>Contacts</span></a></li>
						<li><a href="<?=base_url()?>admin/properties/view_all"><span>Properties</span></a></li>
						
						
						
						</ul>
						
						
						</li> 
						
					<?php 	
						
					}
						
					?>
		
       </ul>
   </div>