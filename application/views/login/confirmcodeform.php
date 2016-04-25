<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$actionurl = BASE."confirm";
$actionresend = BASE."confirm/resend";
?>

	<p>&nbsp;</p>
	<div class='centered-rows'>	
		<div id='div-confirm' class='div-500'>
			<div style='display:<?php echo $display_badcode;?>;' id='div-bad-confirm'>
				<form id='confirm-resend' action="<?php echo $actionresend;?>" class='body-bg' >
					<span class='error'>Bad confirmation code</a></span><br />
					<div class='headline-large'>Need us to re-send confirmation code?</div>
					<fieldset>
						<label for='token2'>Email confirmation code to :</label>
						<input type='text' name='resendemail' id='resendemail' data-validation="{min:5,rules:['email']}" size='40'> 
					</fieldset>
					
					<fieldset>
						<a href='#' id='sbmit2' class='btn btn-default' name='sbmit2'>Submit</a>
					</fieldset>
				</form>
				<script>
				MyRegister1 = new Register();
				MyRegister1.InitConfirmResend();
				</script>
				<p>&nbsp;</p>
			</div>
			
			<div class='headline-large'>Try entering your confirmation code again</div>
			
			<div>Please enter the confirmation code from your email</div>
			<form id='confirm-code' action="<?php echo $actionurl;?>" Method="Post" class='body-bg'>
				<fieldset class='form-group'>
					<label for='token'>Confirmation code:</label>
					<input type='text' id='token' name='token' data-validation="{min:25}" size='25' maxlength='100' /> 
				</fieldset>
				
				<fieldset>
					<a href='#' id='sbmit' class='btn btn-default' id='sbmit' name='sbmit'>Submit</a>
				</fieldset>
			</form>
			<script>
				MyRegister = new Register();
				MyRegister.InitConfirmForm();
			</script>
			</div>
		</div>
	</div>
	
</body>
</html>