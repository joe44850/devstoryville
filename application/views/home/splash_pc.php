<?php

	echo $head_start;
	echo $body_start;
	$imgdir = SITE."/_images/site/home";
	$site = SITE;
	
?>
	<div id='splash-top-fix' class='grd-orange-blue'></div>
	<div id='splash-buttons-container'>
		<div class='centered' style='text-align:right;'>
			<a href='<?php echo $site;?>/registeruser'>Signup</a>&nbsp;
			<a href='<?php echo $site;?>/login'>Login</a>&nbsp;
		</div>		
	</div>	
	
	<div id='header-splash' class='grd-orange-blue'>
		<div class='centered'>
			<div><br /></div>
			<div id="LogoMain">&nbsp;</div>
			<div id='splash-msg-main'>
				Because the pervs, crossdressers, obsessive-compulsives and sad teenagers needed somehwere to go. <br />
				We are here for you BillyMadison, JuicyAngel, MoonlightTheSolitary, and that annoying question-girl that I blocked
				<br /><br />
			</div>					
		</div>		
	</div>	
	
	<div id='splashMenuContainer' class='grd-orange-blue'>		
		<div class='centered' id='splash-menu'>		
				<ul>
					<li><a href='#'>Groups</a><a nohref>&#8226;</a></li>
					<li><a href='#'>Questions</a><a nohref>&#8226;</a><li>
					<li><a href='#'>Stories</a></li>
				</ul>
			</div>
	</div>
	
	
	<div>
		<div class='centered' id='splash-content'>
		
		<div id='capsuleHeader'>
			<h3>The lastest from StoryVille</h3>
		</div>
		
		<div id='capsuleContainer'>
			<ul id='capsuleUL'>
				<li>
					<div>
						<h3>Groups of like-minded peoples</h3>
					</div>
					<div>
						<img src='<?php echo $imgdir?>/home-1.jpg' />
					</div>
				</li>
				
				<li>
					<div>
						<h3>Insightful questions & answers...</h3>
					</div>
					<div>
						<img src='<?php echo $imgdir?>/home-2.jpg' />
					</div>
				</li>
				
				<li>
					<div>
						<h3>User stories & experiences</h3>
					</div>
					<div>
						<img src='<?php echo $imgdir?>/home-3.jpg' />
					</div>
					
				</li>
				
				<li>
					<div id='splashLoginContainer'>
						<?php include(VIEW."/login/loginform.php");?>
					</div>					
				</li>
				
			</ul>
		</div>
		</div>
	
	</div>
	
	<div style='min-height:2800px;'>
		<p>&nbsp;</p>
	</div>	
	
	<script>
		_Splash = new Splash();
		_Splash.InitSplashMenu();
	</script>


