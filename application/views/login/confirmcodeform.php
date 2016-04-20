<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$actionurl = BASE."confirm";
$actionresend = BASE."confirmresend";
?>
<?php 
	echo $head_start;
	echo $body_start;
	echo $nav_bar;
	
?>
	<p>&nbsp;</p><p>&nbsp;</p>
	<div class='centered-rows'>	
		<div id='div-confirm'>
			<div style='display:<?php echo $display_badcode;?>;' id='div-bad-confirm'>
				<form id='confirm-resend' action="<?php echo $actionresend;?>" >
					<span class='error'>Bad confirmation code</a></span><br />
					<fieldset>
						<label for='token2'>Re-send confirmation code to :</label>
						<input type='text' name='resend-email' data-validation="{min:5,rules:['email']}" size='40'> 
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
			
			<div>Please enter the confirmation code from your email</div>
			<form id='confirm-code' action="<?php echo $actionurl;?>" Method="Post">
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