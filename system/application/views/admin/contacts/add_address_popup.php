<script type="text/javascript">
	$(function() {
		
		var address1 = $("#address1a"),
			address2 = $("#address2a"),
			address3 = $("#address3a"),
			address4 = $("#address4a"),
			postcode = $("#postcodea"),
			allFields = $([]).add(address1).add(address2).add(address3).add(address4).add(postcode),
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
		
		$("#dialog-form3").dialog({
			autoOpen: false,
			height: 350,
			width: 250,
			modal: true,
			show: 'blind',
			hide: 'blind',
			buttons: {
				'Add Address': function() {
					var bValid = true;
					allFields.removeClass('ui-state-error');

					bValid = bValid && checkLength(address1,"address1",1,56);
					
					
					
					if (bValid) {
						$.post('<?=base_url()?>admin/contacts/create_address', {
							address1: address1.val(),
							address2: address2.val(),
							address3: address3.val(),
							address4: address4.val(),
							postcode: postcode.val(),
							id_company: "<?=$company_id?>",
							company_userid: "<?=$user_id?>"
							});
						
						$(this).dialog('close');
						$('#ajax_addresses').load('<?=base_url()?>admin/contacts/<?=$address_table?>/<?=$company_id?>');
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
		
		
		
		$('#create-address')
			.button()
			.click(function() {
				$('#dialog-form3').dialog('open');
			});

	});
	</script>



<div class="demo">

<div id="dialog-form3" title="Add an Address">
	<p class="validateTips"></p>

	<form>
	<fieldset>
		<label for="address1a">Address 1</label>
		<input type="text" name="address1a" id="address1a" class="text ui-widget-content ui-corner-all" />
		<br/>
		<label for="address2a">Address 2</label>
		<input type="text" name="address2a" id="address2a" class="text ui-widget-content ui-corner-all" />
		<br/>
		<label for="address3a">Address 3</label>
		<input type="text" name="address3a" id="address3a" value="" class="text ui-widget-content ui-corner-all" />
			<br/>
		<label for="address4a">Address 4</label>
		<input type="text" name="address4a" id="address4a" value="" class="text ui-widget-content ui-corner-all" />
		<br/>
			
		<label for="postcodea">Postcode</label>
		<input type="text" name="postcodea" id="postcodea" value="" class="text ui-widget-content ui-corner-all" />
			</fieldset>
	</form>
</div>



<button id="create-address">Add Address</button>

</div>