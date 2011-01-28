<script type="text/javascript">
	$(function() {
		
		var first_name = $("#first_name1"),
			last_name = $("#last_name1"),
			short_desc = $("#description1"),
			allFields = $([]).add(first_name).add(last_name).add(short_desc),
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
		
		$("#dialog-form5").dialog({
			autoOpen: false,
			height: 220,
			width: 250,
			modal: true,
			show: 'blind',
			hide: 'blind',
			buttons: {
				'Add User': function() {
					var bValid = true;
					allFields.removeClass('ui-state-error');

					bValid = bValid && checkLength(first_name,"first_name",1,56);
					
					
					
					if (bValid) {
						$.post('<?=base_url()?>admin/contacts/create_user', {
							first_name: first_name.val(),
							last_name: last_name.val(),
							short_desc: short_desc.val(),
							id_company: "<?=$company_id?>"
							
							});
						
						$(this).dialog('close');
						$('#ajax_users').load('<?=base_url()?>admin/contacts/user_detail_table/<?=$company_id?>');
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
		
		
		
		$('#create-user')
			.button()
			.click(function() {
				$('#dialog-form5').dialog('open');
			});

	});
	</script>



<div class="demo">

<div id="dialog-form5" title="Add a User">
	

	<form >
	<fieldset>
		<label for="first_name1">First Name</label><br/>
		<input type="text" name="first_name1" id="first_name1" class="text ui-widget-content ui-corner-all" />
		<br/>
		<label for="last_name1">Last Name</label><br/>
		
			
		
		<input type="text" name="last_name1" id="last_name1" class="text ui-widget-content ui-corner-all" />
		<br/>
		<label for="description1">Description</label><br/>
		<input type="text" name="description1" id="description1" class="text ui-widget-content ui-corner-all" />
		</fieldset>
	</form>
</div>



<button style="float:left;" id="create-user">Add User</button>

</div>