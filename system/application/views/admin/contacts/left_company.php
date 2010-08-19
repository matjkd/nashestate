
	<script type="text/javascript">
	$(function() {
		$("#accordion1").accordion({
			collapsible: true,
			autoHeight: false,
			navigation: true
		});
	});
	</script>

	<script>
	function fnClickRefresh() {
		
		$('#ajax_contacts').load('<?=base_url()?>admin/contacts/company_contact_detail_table/<?=$company_id?>');

		
		}
	
	</script>



<div id="accordion1">
	<h3><a href="#">Company Detail</a></h3>
	<div>
		<p>
		<div id="ajax_users"><?php  $this->load->view('admin/contacts/users_list'); ?></div>
		</p>
<div style="float:left;"><?php $this->load->view('admin/contacts/add_user_popup'); ?></div>
<div style="float:left;"><button>Delete Company(coming soon)</button></div>
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
		Table of properties this contact has for rent or sale, plus sold
		</p>
		<br/><button>Add Property</button>
			</div>
</div>