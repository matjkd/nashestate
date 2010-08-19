
<div id="menu">
       <ul class="menu">
        <li <?php if($page=='back to site'){echo "class='current'";}?>>
        <a href="<?=base_url()?>" class="parent"><span>Back to Site</span></a></li>
           
        <li <?php if($page=='contacts'){echo "class='current'";}?>>
        <a href="<?=base_url()?>index.php?admin/contacts"><span>Contacts</span></a></li>
           
        <li <?php if($page=='sales'){echo "class='current'";}?>>
        <a href="<?=base_url()?>index.php?admin/properties/view_sales"><span>For Sale</span></a></li>
       	
       	 <li <?php if($page=='rentals'){echo "class='current'";}?>>
        <a href="<?=base_url()?>index.php?admin/properties/view_rentals"><span>Rentals</span></a></li>
       	
       	
       	 <li <?php if($page=='content'){echo "class='current'";}?>>
        <a href="<?=base_url()?>index.php?admin/properties"><span>Content</span></a></li>
		
       </ul>
   </div>