<script type="text/javascript">
	$(function() {
		
		var company_name = $("#company_name1"),
			company_desc = $("#company_desc1"),
			company_phone = $("#company_phone1"),
			company_email = $("#company_email1"),
			company_website = $("#company_website1"),
			company_fax = $("#company_fax1"),
			company_type = $("#company_type1"),
			address1 = $("#address1a"),
			address2 = $("#address2a"),
			address3 = $("#address3a"),
			address4 = $("#address4a"),
			postcode = $("#postcodea"),
			firstname = $("#firstname1"),
			lastname = $("#lastname1"),
			email = $("#email1"),
			phone = $("#phone1"),
			mobile = $("#mobile1"),
			allFields = $([]).add(company_name).add(company_desc).add(company_phone).add(company_email).add(company_website).add(company_fax).add(company_type).add(address1).add(address2).add(address3).add(address4).add(postcode).add(firstname).add(lastname).add(email).add(phone).add(mobile),
			tips = $(".validateTips");

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
		
		$("#dialog-form2").dialog({
			autoOpen: false,
			height: 470,
			width: 650,
			modal: false,
			show: 'blind',
			hide: 'blind',
			buttons: {
				'Create an account': function() {
					var bValid = true;
					allFields.removeClass('ui-state-error');

					bValid = bValid && checkLength(company_name,"company_name",3,100);
					
				
					// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
					bValid = bValid && checkRegexp(company_email,/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i,"eg. ui@jquery.com");
					
					if (bValid) {
						
						$.post('<?=base_url()?>contacts/create_company', {company_name: company_name.val(),
							company_type: company_type.val(),
							company_desc: company_desc.val(),
							company_phone: company_phone.val(),
							company_fax: company_fax.val(),
							company_email: company_email.val(),
							company_website: company_website.val(),
							address1: address1.val(),
							address2: address2.val(),
							address3: address3.val(),
							address4: address4.val(),
							postcode: postcode.val(),
							firstname: firstname.val(),
							lastname: lastname.val(),
							email: email.val(),
							phone: phone.val(),
							mobile: mobile.val()
							});
						
						$(this).dialog('close');
						$('#ajax_table').load('<?=base_url()?>contacts/company_table');
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
		
		
		
		$('#create-company')
			.button()
			.click(function() {
				$('#dialog-form2').dialog('open');
				
			});
		
	});
	</script>



<div class="demo2">

<div id="dialog-form2" title="Create Company">
	<p class="validateTips">All form fields are required.</p>

	<?php echo form_open('contacts/create_company'); ?>
	<div style="float:left; width:200px;">
	<fieldset> <legend>Main Details.</legend>
		<p><label for="company_type">Company Type</label><select id="company_type1" name="company_type1">
		<option value="1">Customer</option>
		<option value="2">Supplier</option>
		<option value="3">Other</option>
		</select></p>
		<label for="company_name">Company Name</label>
		<input type="text" name="company_name1" id="company_name1" class="text ui-widget-content ui-corner-all" />
		<label for="company_desc">Company Description</label>
		<input type="text" name="company_desc1" id="company_desc1" value="" class="text ui-widget-content ui-corner-all" />
		
		
		
		<label for="company_phone">Phone</label>
		<input type="text" name="company_phone1" id="company_phone1" value="" class="text ui-widget-content ui-corner-all" />
		<label for="company_fax">Fax</label>
		<input type="text" name="company_fax1" id="company_fax1" value="" class="text ui-widget-content ui-corner-all" />
		<label for="company_email">Email</label>
		<input type="text" name="company_email1" id="company_email1" value="" class="text ui-widget-content ui-corner-all" />
	 <label for="company_website">Website</label>
		<input type="text" name="company_website1" id="company_website1" value="" class="text ui-widget-content ui-corner-all" />
	
	</fieldset>
	</div>
	
	<div style="float:left; width:200px;">
	<fieldset> <legend>Main Address (optional).</legend>
		<label for="firstname">Address 1</label>
		<input type="text" name="address1a" id="address1a" class="text ui-widget-content ui-corner-all" />
		
		<label for="lastname">Address 2</label>
		<input type="text" name="address2a" id="address2a" class="text ui-widget-content ui-corner-all" />
		
		<label for="email">Address 3</label>
		<input type="text" name="address3a" id="address3a" value="" class="text ui-widget-content ui-corner-all" />
			
		<label for="email">Address 4</label>
		<input type="text" name="address4a" id="address4a" value="" class="text ui-widget-content ui-corner-all" />
		
			
		<label for="email">Postcode</label>
		<input type="text" name="postcodea" id="postcodea" value="" class="text ui-widget-content ui-corner-all" />
			</fieldset>
	</div>
	<div style="float:left; width:206px;">
	<fieldset> <legend>Employee Detail (optional).</legend>
		<label for="firstname">First Name</label>
		<input type="text" name="firstname1" id="firstname1" class="text ui-widget-content ui-corner-all" />
		
		<label for="lastname">Last Name</label>
		<input type="text" name="lastname1" id="lastname1" class="text ui-widget-content ui-corner-all" />
		
		<label for="email">Email</label>
		<input type="text" name="email1" id="email1" value="" class="text ui-widget-content ui-corner-all" />
			
		<label for="email">Phone</label>
		<input type="text" name="phone1" id="phone1" value="" class="text ui-widget-content ui-corner-all" />
		
			
		<label for="email">Mobile</label>
		<input type="text" name="mobile1" id="mobile1" value="" class="text ui-widget-content ui-corner-all" />
			</fieldset>
	</div>
<?php echo form_close(); ?>
</div>



<button id="create-company">Create New Company</button>

</div>