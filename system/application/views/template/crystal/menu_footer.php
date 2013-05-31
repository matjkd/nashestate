	<li <?php if($page=='0'){echo "class=''";}?>>
        <a href="<?=base_url()?>"><span>Home</span></a></li>
		
        <li <?php if($page=='1'){echo "class=''";}?>>
        <a href="<?=base_url()?>about_us"><span>About Us</span></a>
        
       				
        
        
        </li>   
       
       <li <?php if($page=='2'){echo "class=''";}?>>
        <a href="<?=base_url()?>what_we_can_do_for_you"><span>What we can do for you</span></a>
        
        
					
        
        </li>   

         <li <?php if($page=='7'){echo "class=''";}?>>
        <a href="<?=base_url()?>premiere"><span>Premiere Properties</span></a></li>
        
       
        
           <li <?php if($page=='4'){echo "class=''";}?>>
        <a href="<?=base_url()?>guide_to_buying_or_selling"><span>Guide to Buying or Selling</span></a>

         


           </li>
        
        <li><a href="<?=base_url()?>index.php?welcome/content/epc"><span>EPC regulations in Spain</span></a></li>
           
        
           <li <?php if($page=='3'){echo "class=''";}?>>
        <a href="<?=base_url()?>where_we_are"><span>Contact Us</span></a></li>
       
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
							echo "class=' last'";
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