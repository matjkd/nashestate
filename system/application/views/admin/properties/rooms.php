<p>This table will be where you add rooms, you will be able to pick the room type (bedroom, kitchen, roof terrace etc) and enter the size. It saves the information as you go, so no need for a submit button on this table.</p>
<script type="text/javascript" charset="utf-8"> 
		function fnClickAddRow() {
				
				$('#ajax_table').load('<?=base_url()?>admin/properties/rooms_add_row/<?=$property_id?>').oTable.fnDraw();
				
				}
		
			function fnClickRefresh() {
				
				$('#ajax_table').load('<?=base_url()?>admin/properties/rooms_table/<?=$property_id?>').oTable.fnDraw();
				
				}

				

			function roomconfirm(id) {
				var answer = confirm("are you sure you want to delete this row?")
				if (answer){
					
					$.post('<?=base_url()?>admin/properties/delete_room/', {id: id
						
						});
						
				}
				else{
					alert("nothing deleted!")
				}
				$('#ajax_table').load('<?=base_url()?>admin/properties/rooms_table/<?=$property_id?>').oTable.fnDraw();
			}
		
			
			
</script> 


	<?=$this->load->view('admin/properties/room_table')?>


<div style="float:right;"><a href="javascript:void(0);" onclick="fnClickAddRow();"><button>Click to add a Room</button></a></div> 
<div style="float:right;"><a href="javascript:void(0);" onclick="fnClickRefresh();"><button>Refresh Table</button></a></div>