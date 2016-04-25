<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php 
	echo $head_start;
	echo $body_start;
	$site = SITE;
?>
<div id="header-top" onclick="document.location.href='<?php echo $site;?>'" class='grd-orange-blue'>
	<div id="header-center" onclick="document.location.href='<?php echo $site;?>'">			
		<div style='text-align:center;width:100%;padding:5px;'>
			<p>
				<a href='<?php echo $site;?>'>
					<img src='<?php echo $site;?>/_images/site/logos/logo-main.png' alt='Storyville Home' style='max-height:30px;'/>
				</a>				
			</p>
		</div>
	</div>
</div>