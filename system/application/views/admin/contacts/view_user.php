<script>
    $(document).ready(function() {
        var uid = "<?= $user_id ?>";
        var cid = "<?= $company_id ?>";
	
        $(".editcompany").editable("<?= site_url('/admin/contacts/edit_company') ?>", 
        {
	
            indicator : 'Saving...',
            id   : 'elementid',
            onblur : 'submit',
            tooltip   : 'Click to edit...',
            submitdata : function() 
            {
                return {id : cid};
            }

    	        
        });

	
        $(".editclient").editable("<?= site_url('/admin/contacts/edit_user') ?>", 
        {
            indicator : 'Saving...',
            id   : 'elementid',
            onblur : 'submit',
            tooltip   : 'Click to edit...',
            submitdata : function() 
            {
                return {id : uid};
            }
    
        	        
        });
        $(".edit_nationality").editable("<?= site_url('/admin/contacts/edit_user') ?>", 
        {
		    	
            data : <?php $this->load->view('ajax/nationality'); ?>,
            type   : "select",
            onblur : "submit",
            style  : "inherit",
            id   : 'elementid',     
            submitdata : function() 
            {
                return {id : uid};
            }
    
        	        
        });
    
        $(".edit_language").editable("<?= site_url('/admin/contacts/edit_user') ?>", 
        {
		    	
            data : {'English':'English','Spanish':'Spanish','German':'German','French':'French'},
            type   : "select",
            onblur : "submit",
            style  : "inherit",
            id   : 'elementid',     
            submitdata : function() 
            {
                return {id : uid};
            }
    
        	        
        });
    

   
    
    });
</script>


<div>
    <?php foreach ($contact_detail as $row):
        ?>
        <div class='leftcolumn'>
            First Name:
        </div>

        <div class='editclient' id='firstname'><?= $row['firstname'] ?></div>



        <div class='leftcolumn'>
            Last Name:
        </div>

        <div class='editclient' id='lastname'><?= $row['lastname'] ?></div>

        <div class='leftcolumn'>
            Short Description:
        </div>

        <div class='editclient' id='short_desc'><?= $row['short_desc'] ?></div>

        <div class='leftcolumn'>
            Skype ID:
        </div>

        <div class='editclient' id='skype_id'><?= $row['skype_id'] ?></div>

        <div  class='leftcolumn'>
            Nationality:
        </div>

        <div  class='edit_nationality' id='nationality'><?= $row['nationality'] ?></div>

        <div  class='leftcolumn'>
            Language:
        </div>

        <div class='edit_language' id='language'><?= $row['language'] ?></div>


        <div class='leftcolumn'>
            <a href="<?= base_url() ?>admin/contacts/view_company/<?= $row['company_id'] ?>">Group Name:</a>
        </div>

        <div class='editcompany' id='company_name' style="color:#666666;"><?= $row['company_name'] ?></div>


    <?php endforeach; ?>

</div>