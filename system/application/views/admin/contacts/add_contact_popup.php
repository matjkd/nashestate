<script type="text/javascript">
	$(function() {
		
		var contact_type = $("#contact_type1"),
		contact_detail = $("#contact_detail1"),
			
			allFields = $([]).add(contact_type).add(contact_detail),
			tips = $(".validateTips");
		
		var companyid = "<?=$company_id?>";

		function updateTips(t) {
			tips
				.text(t)
				.addClass('ui-state-highlight');
			setTimeout(function() {
				tips.removeClass('ui-state-highlight', 1500);
			}, 500);
		}

		function checkLength(o,n,min,max) {

			if ( o.val().length > max || o.val().length < min ) {
				o.addClass('ui-state-error');
				updateTips("Length of " + n + " must be between "+min+" and "+max+".");
				return false;
			} else {
				return true;
			}

		}

		function checkRegexp(o,regexp,n) {

			if ( !( regexp.test( o.val() ) ) ) {
				o.addClass('ui-state-error');
				updateTips(n);
				return false;
			} else {
				return true;
			}

		}
		
		$("#dialog-form4").dialog({
			autoOpen: false,
			height: 220,
			width: 250,
			modal: true,
			show: 'blind',
			hide: 'blind',
			buttons: {
				'Add Detail': function() {
					var bValid = true;
					allFields.removeClass('ui-state-error');

					bValid = bValid && checkLength(contact_detail,"contact_detail",1,56);
					
					
					
					if (bValid) {
						$.post('<?=base_url()?>admin/contacts/create_contact_detail', {
							contact_type: contact_type.val(),
							contact_detail: contact_detail.val(),
							id_company: "<?=$company_id?>",
							company_userid: "<?=$user_id?>"
							});
						
						$(this).dialog('close');
						$('#ajax_contacts').load('<?=base_url()?>admin/contacts/<?=$add_contact_table?>/<?=$company_id?>');
					}
				},
				Cancel: function() {
					$(this).dialog('close');
				}
			},
			close: function() {
				allFields.val('').removeClass('ui-state-error');
			}
		});
		
		
		
		$('#create-contact')
			.button()
			.click(function() {
				$('#dialog-form4').dialog('open');
			});

	});
	</script>



<div class="demo">

<div id="dialog-form4" title="Add a Contact Detail">
	<p class="validateTips"></p>

	<form>
	<fieldset>
		<label for="contact_type1">Contact Type</label><br/>
		<select id="contact_type1" name="contact_type1">
		<option value="Home Tel">Home Tel</option>
		<option value="Work Tel">Work Tel</option>
		<option value="Mobile">Mobile</option>
		<option value="Email">Email</option>
		<option value="Fax">Fax</option>
		</select><br/>
		<label for="contact_detail1">Contact Detail</label>
		<input type="text" name="contact_detail1" id="contact_detail1" class="text ui-widget-content ui-corner-all" />
		</fieldset>
	</form>
</div>



<button style="float:left;" id="create-contact">Add Contact Detail</button>

</div>