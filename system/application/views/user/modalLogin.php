<a href="#myModal" role="button"  data-toggle="modal">Login</a>	
						<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Login</h3>
  </div>
  
  
  <?php $is_logged_in = $this->session->userdata('is_logged_in');
if(!isset($is_logged_in) || $is_logged_in != true) { ?>
  <div class="modal-body">
  	
    <?=form_open('user/login/validate_credentials')?>
    
    <div class="input-prepend">
  <span class="add-on"><i class="icon-user"></i></span>
  <input class="span2" id="prependedInput" name="username" type="text" placeholder="Username">
</div>
   <div class="input-prepend">
  <span class="add-on"><i class="icon-lock"></i></span>
  <input class="span2" id="prependedInput" name="password" type="password" placeholder="Password">
</div>
    
    
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button type="submit" class="btn btn-primary">Login</button>
    <?=form_close()?>
  </div>
  
  <? } else { ?>
  	 <div class="modal-body">
  	 	<p><?=$this->session->userdata('firstname')?> <?=$this->session->userdata('lastname')?> you are Logged in</p>
  	</div>
  	<div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
   <a href='<?=base_url()?>index.php?user/login/logout'> <span class="btn btn-primary">Log Out</span></a>
    
  </div>
  	
  	<? } ?>
</div>