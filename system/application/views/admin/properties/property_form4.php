<?=$this->load->view('admin/properties/sales_data_js')?>

	<?php foreach($property_details as $key => $row): ?>
<div class="admin_left">
 <table>
 
 	<tr>
	        <td class='leftcolumn'>
	        	Active on Site
	        </td>
			<td>
				<div class="yesno" id="active" style="width:150px; float:left;">
				<?php 
				if($row->active==0) {echo "No";}; 
				if($row->active==1) {echo "Yes";};?>
				</div>
			</td>
	</tr>
	
	<tr>
	        <td class='leftcolumn'>
			Sign Board 
	        </td>
			<td>
				<div class="yesnojeditable" id="sign_board" style="width:150px; float:left;">
				<?php 
				if($row->sign_board==0) {echo "No";}; 
				if($row->sign_board==1) {echo "Yes";};
				?>
				</div>
			</td>
	</tr>
		<tr>
	        <td class='leftcolumn'>
			Advertising
	        </td>
			<td>
				<div class="yesnojeditable" id="advertising" style="width:150px; float:left;">
				<?php 
				if($row->advertising==0) {echo "No";}; 
				if($row->advertising==1) {echo "Yes";};
				?>
				</div>
			</td>
	</tr>
	
	<tr>
	        <td class='leftcolumn'>
			Signed Sales Contract
	        </td>
			<td>
				<div class="yesnojeditable" id="signed_sales_contract" style="width:150px; float:left;">
				<?php 
				if($row->signed_sales_contract==0) {echo "No";}; 
				if($row->signed_sales_contract==1) {echo "Yes";};
				?>
				</div>
			</td>
	</tr>
	
	<tr>
	        <td class='leftcolumn'>
			Nash homes Exclusive
	        </td>
			<td>
				<div class="yesnojeditable" id="exclusive" style="width:150px; float:left;">
				<?php 
				if($row->exclusive==0) {echo "No";}; 
				if($row->exclusive==1) {echo "Yes";};
				?>
				</div>
			</td>
	</tr>
	
	<tr>
	        <td class='leftcolumn'>
			Premiere Property 
	        </td>
			<td>
				<div class="yesnojeditable" id="premiere" style="width:150px; float:left;">
				<?php 
				if($row->premiere==0) {echo "No";}; 
				if($row->premiere==1) {echo "Yes";};
				?>
				</div>
			</td>
	</tr>

</table>	
</div>
<div class="admin_left">
<?=$this->load->view('admin/properties/featured_property_form')?>


  <?php if($row->sale_rent==1){ ?>

    Sale Form
  <?=$this->load->view('admin/properties/sales_form')?>
    <?php } ?>


      <?php if($row->sale_rent==2){ ?>
    Rental Form
  <?=$this->load->view('admin/properties/rental_form')?>
        <?php } ?>
</div>
	<?php endforeach; ?>
<div style="clear:both;"></div>


