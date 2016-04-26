<?php

	class Html{
	
		private $site;
		public $title;
		public $cache = false;
		public $loggedin = false;
		public $favicon;
		public $is_mobile = false;
	
		public function __construct(){
			$this->site = SITE;
			$this->favicon = BASE."/_images/site/favicon.png";
			if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']) $this->loggedin = true ;	
			$this->is_mobile = isMobile();
		}
	
		//loads every js file in a directory, send a directory that is relative to root, like _js/somejsdir
		public function LoadJavascript($dir_string_array=""){
			$js = "";
			$dirs = explode(",", $dir_string_array);
			foreach($dirs as $dir){
				$root_dir = ROOT."/".$dir;
				$files = Common::LoadFiles($root_dir, "js");
				if(is_array($files)){
					foreach($files as $file){
						//remove root and replace with site	
						$f = $dir."/".$file;
						$js.="\n\t<script type='text/javascript' src='". SITE."/".$f ."'></script>";
					}				
					$js.="\n";
				}
			}
			return $js;
		}
		
		//loads every css file in a directory; send a dir that is relative to root, like _css/some_css_dir
		public function LoadCss($dir){			
			$uncache = (!$this->cache) ? $this->_Uncache() : "";				
			$css = "";
			$root_dir = ROOT."/".$dir;
			$files = Common::LoadFiles($root_dir, "css");
			if(is_array($files)){
				foreach($files as $file){
					//remove root and replace with site	
					$f = $dir."/".$file;
					$css.="\n\t<link rel='stylesheet' type='text/css' href='". SITE."/".$f ."?".$uncache."' />";
				}
				$css.="\n";
			}
			return $css;
		}
		
		public function GetDocType(){
			$html = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' ".
				" 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>\n ";	
			$html = "<!DOCTYPE html>\n<html>";
			return $html;
		}
		
		public function HeadStart($args=null){
			$css_dir = ($this->is_mobile) ? "_css/mobile" : "_css/pc";
			$html = $this->GetDocType();
			$html.="<head>";
			isset($this->title) ? $title = $this->title : $title = SITE_TITLE;
			$html.="\n<title>$title</title>\n";
			$js = $this->LoadJavascript("_js");			
			$css = $this->LoadCss($css_dir);			
			$html.= $js . $css;
			if($args){
				if(is_array($args)){ 
					foreach($args as $arg){ $html .= "\n\t".$arg;}
				}
				else{
					$html.= $args;
				}
			}
			$html.="\t<link rel='shortcut icon' type='image/png' href='".$this->favicon."' />"; 
			$html.="
					<meta charset=\"utf-8\">
					<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
					<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
					";
			return $html;
		}		
		
		public function BodyStart(){
			$html = "
				\n\t</head>
				\n\t<body>
			";
			return $html;
			
		}
		
		private function _Uncache(){
			$t = time();
			return "t=".$t;
		}
		
		/* Static methods */
		public static function OnLoad($javascript=""){
			if(!$javascript){ return;}
			$html = "<img src='".SITE."/_images/blank.gif' onload=\"".$javascript."\" style='height:0px;width:0px;' />";
			return $html;
		}
		
		public function NavBar(){
			$menu_main = $this->MenuMain();
			$html = "
				<div id=\"HeaderTop\" class='grd-orange-blue'>
					<div id=\"HeaderCenter\" onclick=\"document.location.href='".SITE."'\">			
						<div id=\"LogoMain\">&nbsp;</div>
						$menu_main
					</div>
				</div>
			";
			return $html;
		}
		
		public function LogoHeader(){
			$html = "
				<div id=\"HeaderTop\" onclick=\"document.location.href='".SITE."'\">
					<div id=\"HeaderCenter\" onclick=\"document.location.href='".SITE."'\">			
						<div id=\"LogoMain\">&nbsp;</div>						
					</div>
				</div>
			";
			return $html;
		}
		
		public function MenuMain(){
				$menu = $this->_GetMenu();
				$account_text = $this->loggedin ? "My Account" : "Sign Up";
				$html = "
					<div id='menuMainDiv'>
						<ul id='menuMain'>
				";
				foreach($menu as $menu_item){
					$html.="<li><a href='{$menu_item['url']}'>{$menu_item['label']}</a></li>";
				}
				$html.="
					</ul>
				</div>";		
			
			return $html;
		}
		
		private function _GetMenu(){
			
			$base = BASE;
			$menu = array();
			$menu[0]['url'] = $base."questions";
			$menu[0]['label'] = "Q & A";
			
			$menu[1]['url'] = $base."stories";
			$menu[1]['label'] = "Stories";
			
			$menu[2]['url'] = $base."search";
			$menu[2]['label'] = "Search";
			
			$menu[3]['url'] = $base."login";
			$menu[3]['label'] = "Login";
			
			if(Login::IsLoggedIn()){ 
				$menu[3]['url'] = $base."account";
				$menu[3]['label'] = "My Account";
			}
			return $menu;
		}
		
		public function GetSubMenu(){
			$html = "
					<div id='notifications-bar'>
						<div>
							<ul id='notify'>								
								<li id='notify-questions'>
									<a href='".SITE."/questions'>
										<span id='notify-questions-icon'>&nbsp;</span>
										<span>Questions</span>
									</a>
								</li>
								<li id='notify-response'>
									<a href='".SITE."/questions/my'>
										<span id='notify-responses-icon'>&nbsp;</span>
										<span>Responses</span>
									</a>
								</li>
								<li id='notify-messages'>									
									<a href='".SITE."/messages'>
										<span id='notify-messages-icon'>&nbsp;</span>
										<span>Messages</span>
									</a></li>
							</ul>
						</div>
					</div>
			";
			return $html;
		}
	}
	
	
	
	//