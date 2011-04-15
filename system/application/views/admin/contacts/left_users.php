
	<script type="text/javascript">
	$(function() {
		$("#accordion1").accordion({
			collapsible: true,
			autoHeight: false,
			navigation: true
		});
	
	});
	</script type="text/javascript">
	
	<script>
	function fnClickRefresh() {
		
		$('#ajax_contacts').load('<?=base_url()?>admin/contacts/contact_detail_table/<?=$user_id?>');

		
		}
	
	</script>





<div id="accordion1">
	<h3><a href="#">Individual Detail</a></h3>
	<div>
		<p>
		<?php  $this->load->view($left_main); ?>
		</p>

	</div>
	<h3><a href="#">Contact Details</a></h3>
	<div>
		<div id="view_contact"></div>
		<div id="ajax_contacts"><?php  $this->load->view('admin/contacts/contacts'); ?></div>
		<br/>

		<?php $this->load->view('admin/contacts/add_contact_popup'); ?>
		
		<div style="float:left;"><a href="javascript:void(0);" onclick="fnClickRefresh();"><button>Update</button></a></div>
		</div>
	
	
	
	<h3><a href="#">Address</a></h3>
	<div>
		<div id="view_address"></div>
		<div id="ajax_addresses"><?php  $this->load->view('admin/contacts/addresses'); ?></div>
		<br/><?php $this->load->view('admin/contacts/add_address_popup'); ?>
	</div>
	
	
	
	<h3><a href="#">Properties</a></h3>
	<div>
		<p>
		<?php  $this->load->view('admin/contacts/properties'); ?>
		</p>
		<br/><a href="<?=base_url()?>admin/properties/add/<?=$company_id?>"><button>Add Property</button></a>
			</div>
</div>