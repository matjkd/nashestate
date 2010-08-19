
<div id="menu">
       <ul class="menu">
       
       
       
       
      
        <?php foreach($menu as $menu):?>

		
 		<li <?php if($page==$menu['content_menu']){echo "class='current'";}?>>
        <a href="<?=base_url()?>index.php?welcome/content/<?=$menu['content_menu']?>"><span><?=$menu['content_title'];?></span></a></li>
		<?php endforeach;
		?>
           
       
           
             
       
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
						<li><a href="<?=base_url()?>admin/properties"><span>Properties</span></a></li>
						
						
						
						</ul>
						
						
						</li> 
						
					<?php 	
						
					}
						
					?>
		
       </ul>
   </div>