<div id="login_form">

 			
	     <?php 

$is_logged_in = $this->session->userdata('is_logged_in');
if(!isset($is_logged_in) || $is_logged_in != true)
		{
			echo form_open('user/login/validate_credentials');
			echo "USERNAME";
			echo form_input('username', '');?>
			
			<?php 
			echo "PASSWORD";
			echo form_password('password', '');?>
			
			<?php
			echo form_submit('submit', 'Login');
			echo form_close();
	
			
		}	

		else
			{
				echo 'Hello '; 
				echo $this->session->userdata('firstname');
				echo ' '; 
				echo $this->session->userdata('lastname');
				echo ' | ';?>
				 
				 
				<a href='<?=base_url()?>index.php?user/login/logout' style="color:#ffffff">Logout</a>
				
			
				<?php 
			}
?>
	  
	       
</div>
