<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php 
	echo $head_start;
	echo $body_start;	
	
?>
	<p>&nbsp;</p><p>&nbsp;</p>
	<div class='centered-rows'>		
		<p>&nbsp;</p>
		<div class='signup-wrapper modal-container'>
			<div class='default-popup-header'>
				<div id='LogoMain'></div>
			</div>
			
			<small class='text-muted'>Login</small>
			<form id='login' name='login' method='post' action='".BASE."loginattempt' data-callback=LoginAttempt>
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
	
</body>
</html>