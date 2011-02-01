
<div id="menu">
       <ul class="menu">
        <li <?php if($page=='back to site'){echo "class='current'";}?>>
        <a href="<?=base_url()?>" class="parent"><span>Back to Site</span></a></li>
           
        <li <?php if($page=='contacts'){echo "class='current'";}?>>
        <a href="<?=base_url()?>index.php?admin/contacts"><span>Contacts</span></a></li>
         
        <li <?php if($page=='properties'){echo "class='current'";}?>> <a href="<?=base_url()?>index.php?admin/properties/view_all"><span>Properties</span></a>
	        <ul>
	        <li>
	        <a href="<?=base_url()?>index.php?admin/properties/view_sales"><span>For Sale</span></a></li>
	       	
	       	 <li>
	        <a href="<?=base_url()?>index.php?admin/properties/view_rentals"><span>Rentals</span></a></li>
	       	
	       	 <li>
	        <a href="<?=base_url()?>index.php?admin/properties/view_all"><span>All Properties</span></a></li>
	        	
	       	 <li>
	        <a href="<?=base_url()?>index.php?admin/properties/view_deleted"><span>Deleted Properties</span></a></li>
            </ul>
          </li>  
            
       	 <li <?php if($page=='content'){echo "class='current'";}?>>
        <a href="<?=base_url()?>index.php?admin/content"><span>Content</span></a></li>
        
         	 <li <?php if($page=='config'){echo "class='current'";}?>>
        <a href="<?=base_url()?>index.php?admin/areas/area_config"><span>Config</span></a>
	        <ul>
	        <li <?php if($page=='config'){echo "class='current'";}?>>
	        <a href="<?=base_url()?>index.php?admin/areas/area_config"><span>Areas</span></a></li>
	        
	        <li <?php if($page=='config'){echo "class='current'";}?>>
	        <a href="<?=base_url()?>index.php?admin/features/view_features"><span>Features</span></a></li>
	        
	         <li <?php if($page=='config'){echo "class='current'";}?>>
	        <a href="<?=base_url()?>index.php?admin/import/images"><span>Import Photos</span></a></li>
	        </ul>
        
        
        
        </li>
        
        
         <li <?php if($page=='config'){echo "class='current'";}?>>
        <a target="_blank" href="https://github.com/matjkd/nashestate/issues"><span>Support Page</span></a></li>
		
       </ul>
   </div>