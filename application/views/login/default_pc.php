<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$site = SITE;
echo $logo_header;

?>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	
	<div class='centered-rows'>	
		<div class='div-420'>			
			<b>Need an account?</b><br />
			<a href='<?php echo SITE;?>/registeruser' class='link-big'>Click here to register</a>
		</div>	
		
		<div class='signup-wrapper modal-container'>			
			<div class='big-font'>Login</div>
			<form id='login' name='login' method='post' action='<?php echo $site; ?>/loginattempt' data-callback=LoginAttempt>
				<fieldset class="form-group">
					<label for="username">Username</label>
					<input type='text' name="username" class="form-control" id="username" 
					placeholder="Enter a username" 
					data-validation="{min:3}">							
				</fieldset>						
				
				<fieldset class='form-group'>
					<label for="password">Password</label>
					<input type="password" name="pwd" class="form-control" id="password" 
					data-validation="{min:7}"
					>							
				</fieldset>
				
				<a href='#' class='btn btn-default' id='sbmit' name='sbmit'>Login</a>
				
			</form>
			<script>
				MyLogin = new Login();
				MyLogin.InitForm();
			</script>
		</div>	
		
		
	</div>
	
