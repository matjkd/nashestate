<style type="text/css">
    .ui-autocomplete {
        max-height: 200px;
        overflow-y: auto;
    }
    /* IE 6 doesn't support max-height
     * we use height instead, but this forces the menu to always be this tall
    */
    * html .ui-autocomplete {
        height: 200px;
    }
    #sortable { list-style-type: none; margin: 0; padding: 0; width: 400px; }
    #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em;  }
    #sortable li span { position: absolute; margin-left: -1.3em; }
</style>

<script type="text/javascript">
    $(function() {
        var availableTags = [<?php $this->load->view('ajax/ajax_features'); ?>];
        $("#features").autocomplete({
            source: availableTags
        });
    });
    
    
    //autocomplete features
    $(function() {
        $( "#autocompletefeatures" ).autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "/datasource/json_features",
                    data: {
                        term: $("#autocompletefeatures").val()
                    },
                    dataType: "json",
                    type: "POST",
                    success: function(data){
                        response($.map(data, function(item){
                            return {
                                label: item.label,
                                value: item.label
                            } 
                        
                        }));
                    }
                });
            },
            minLength: 1
        
        });
    });
    
    
   
    
    $(function() {
 	
    $("#sortable").sortable({
        update: function(event,ui)
        {
// loadergif = $('<img class="gifloader" src="/images/load.gif" />');
 //   $('#create_list').append(loadergif);
            $.post("<?= base_url() ?>admin/features/sortlist", {
                pages: $('#sortable').sortable('serialize')
            }
            );
          // $('.gifloader').remove(); 
           
        }
   

 });
    $("#sortable1").disableSelection();
  	
  	
});
    
    
    
 
    function deletefeature(id) {
        var answer = confirm("are you sure you want to delete feature?")
        if (answer){
			
            window.location = "<?= base_url() ?>admin/properties/delete_property_feature/"+ id;
        }
        else{
            alert("nothing deleted!")
        }
    }
   
</script>

<?php echo form_open('admin/properties/add_feature/' . $property_id . ''); ?>
<input type="text" name="feature" id="features" style="width:150px; "/>
<?php echo form_submit('submit', 'Add Feature'); ?>
<?php echo form_close(); ?>
<div id='features' style="padding-top:10px;">
    This is where you add features such "Air Conditioning" "Potential to Extend" or any additional info that isn't included in other areas of the form. Use the "Room Table" for adding rooms.
    <ul id='sortable'>
        <?php foreach ($assigned_features as $key => $featurerow): ?>
            <li class="ui-state-default" id="page_<?= $featurerow['pf_id'] ?>" > 
                <span class="ui-icon ui-icon-arrowthick-2-n-s"></span><?= $featurerow['features'] ?><a href="<?= base_url() ?>admin/properties/delete_property_feature/<?= $featurerow['pf_id'] ?>" ><div style="float:right;" class="ui-icon ui-icon-circle-close"></div></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>