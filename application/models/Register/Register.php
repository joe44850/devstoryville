<?php
	require_once("IRegister.php");

	class Register implements IRegister {
		
		public function SignupHtml(){
			$html = "
				<div class='signup-wrapper modal-container'>
					<h1>Join StoryVille.me today.</h1>
					<form id='signup' name='signup' method='post' action='".BASE."registeruser/attempt'>
						<fieldset class=\"form-group\">
							<label for=\"username\">Username</label>
							<input type='text' name=\"signup[username]\" class=\"form-control\" id=\"username\" 
							placeholder=\"Enter a username\" 
							data-validation=\"[NOTEMPTY]\">
							<small class='text-muted'>Must be at least 5 characters long</small>
						</fieldset>
						
						<fieldset class='form-group'>
							<label for=\"email\">Email</label>
							<input type='text' name='signup[email]' class='form-control' id='email' 
							placeholder='Email address' 
							data-validation=\"[NOTEMPTY]\"
							>
							<small class='text-muted'>We will never share your email</small>
						</fieldset>
						
						<fieldset class='form-group'>
							<label for=\"password\">Password</label>
							<input type=\"password\" name=\"signup[password]\" class=\"form-control\" id=\"password\" 
							data-validation=\"[NOTEMPTY]\"
							>
							<small class=\"text-muted\">Must be at least 7 characters long</small>
						</fieldset>
						
						<a href='#' class='btn btn-default' id='sbmit' name='sbmit'>Register</a>
						
					</form>
					<script>$('#signup').validate({
						submit: {
							settings: {
								button : 'a#sbmit',
								errorListClass: 'error-list',
							}
						}
					});</script>
				</div>
			";
			return $html;
		}
		
		public function ProcessNewSignup(){
			
		}
		
		public function EmailNewSignup(){
			
		}
		
	}