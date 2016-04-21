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
			<?php include("loginform.php");?>
		</div>	
		
	</div>
	
