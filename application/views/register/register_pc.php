<?php
	$site = SITE;
?>

<div class='centered div-420'>
	<br />
	<center>
		<p><a href='<?php echo $site;?>/login'>Already a member? Login here</a></p>
	</center>
</div>
<div class='signup-wrapper'>					
	<form id='signup' name='signup' method='post' action='<?php echo $site;?>/registeruser/attempt' data-callback=CompleteRegistration>
		<div class='headline-large'>Join StoryVille today.</div>
		<fieldset class="form-group">
			<label for="username">Username</label>
			<input type='text' name="username" class="form-control" id="username" 
			placeholder="Enter a username" 
			data-validation="{min:3}">
			<small class='text-muted'>Must be at least 5 characters long</small>
		</fieldset>
		
		<fieldset class='form-group'>
			<label for="email">Email</label>
			<input type='text' name='email' class='form-control' id='email' 
			placeholder='Email address' 
			data-validation="{min:5, rules: ['email']}"
			>
			<small class='text-muted'>We will never share your email</small>
		</fieldset>
		
		<fieldset class='form-group'>
			<label for="password">Password</label>
			<input type="password" name="pwd" class="form-control" id="password" 
			data-validation="{min:7}"
			>
			<small class='text-muted'>Password must be at least 7 characters long</small>
		</fieldset>
		
		<a nohref class='btn btn-default' id='sbmit' name='sbmit'>Register</a>
		
	</form>
	<script>
		MyRegister = new Register();
		MyRegister.InitSignup();						
	</script>
</div>