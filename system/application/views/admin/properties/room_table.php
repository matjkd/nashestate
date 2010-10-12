<div id="ajax_table">
<script type="text/javascript" charset="utf-8"> 
			/* Global variable for the DataTables object */
			var oTable;
			
			/* Global var for counter */
			var giCount = 2;
			
			$(document).ready(function() {
				/* Apply the jEditable handlers to the table */
				
				
				$(".editfield").editable("<?=site_url('admin/properties/edit_room_table')?>",
						{
					
	    	    	indicator : 'Saving...',
	    	    	id  : 'elementid',
	    	    
	    	    	onblur : 'submit',
	    	    	tooltip  : 'Click to edit...',
	    	        submitdata : function() 
	    	        {
	    	            return {"id" : this.parentNode.getAttribute('id')
	    	            };
	    			},
					height: "14px"
						});

				$(".roomtypes").editable("<?=site_url('admin/properties/edit_room_table')?>",
						{
					
	    	    	indicator : 'Saving...',
	    	    	id  : 'elementid',
	    	    	data : <?php $this->load->view('ajax/ajax_rooms'); ?>,
	    	    	type   : "select",
	    	    	onblur : 'submit',
	    	    	tooltip  : 'Click to edit...',
	    	        submitdata : function() 
	    	        {
	    	            return {"id" : this.parentNode.getAttribute('id')
	    	            };
	    			},
					height: "14px"
						});
				

				$(".additional").editable("<?=site_url('admin/properties/edit_room_table')?>",
						{
					
	    	    	indicator : 'Saving...',
	    	    	id  : 'elementid',
	    	    	data : <?php $this->load->view('ajax/ajax_additional'); ?>,
	    	    	type   : "select",
	    	    	onblur : 'submit',
	    	    	tooltip  : 'Click to edit...',
	    	        submitdata : function() 
	    	        {
	    	            return {"id" : this.parentNode.getAttribute('id')
	    	            };
	    			},
					height: "14px"
						});
				
				
				oTable = $('#quote_table').dataTable({
					"bJQueryUI": true,
					"aoColumns": [ 
					  			/* id */   {"bVisible":    false },
					  			/* quantity */  null,
					  			/* ref */ null,
					  			/* desc */  null,
					  			/* actions */    null
					  		],
					"aaSorting": [[ 0, "asc" ]],
					"bSort": true,
					"bPaginate": false,
					"sDom": 'rt'
				});

			
			} );
</script>

<table id="quote_table"  width="100%" style="clear:both;">
	<thead>
		<tr>
			<th>ID</th>
			<th>Room Type</th>
			<th>Size (m2)</th>
			<th>Additional</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
<?php 
$rollingtotal = 0;
if (!isset($room_table))
{
	
}
else
{
foreach($room_table as $key => $row):?>	
		

		<tr id='<?=$row['property_room_id']?>'>
		
		<td><?=$row['property_room_id']?></td>
			
			<td id='<?=$row['property_room_id']?>'><div class='roomtypes' id='room_type'><?=$row['room_name']?></div></td>
					
			<td id='<?=$row['property_room_id']?>'><div class='editfield' id='room_size'><?=$row['room_size']?></div></td>
			
			<td id='<?=$row['property_room_id']?>'><div class='additional' id='room_additional'><?=$row['additional']?></div></td>
					
		<td><a href='#' onclick="roomconfirm(<?=$row['property_room_id']?>)">Delete Room</a></td>
		</tr>
		<?php endforeach;
}
?>	
		
	</tbody>
</table>
</div>
