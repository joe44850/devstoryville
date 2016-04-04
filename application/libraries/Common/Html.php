<?php

	class Html{
	
		private $site;
		public $title;
		public $cache = false;
		public $loggedin = false;
	
		public function __construct(){
			$this->site = SITE;
			if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']) $this->loggedin = true ;			
		}
	
		//loads every js file in a directory, send a directory that is relative to root, like _js/somejsdir
		public function LoadJavascript($dir=""){
			$js = "";
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
			$html = $this->GetDocType();
			$html.="<head>";
			isset($this->title) ? $title = $this->title : $title = SITE_TITLE;
			$html.="\n<title>$title</title>\n";
			$js = $this->LoadJavascript("_js");			
			$css = $this->LoadCss("_css");			
			$html.= $js . $css;
			if($args){
				if(is_array($args)){ 
					foreach($args as $arg){ $html .= "\n\t".$arg;}
				}
				else{
					$html.= $args;
				}
			}
			$html.="\t<link rel='shortcut icon' type='image/png' href='".FAVICON."' />"; 
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
			$html = "<img src='".SITE."/_images/1x1.png' onload=\"function(){ ".$javascript.";}\" style='height:0px;width:0px;' />";
			return $html;
		}
		
		public function NavBar(){
			$menu_main = $this->MenuMain();
			$html = "
				<div id=\"HeaderTop\">
					<div id=\"HeaderCenter\">			
						<div id=\"LogoMain\">&nbsp;</div>
						$menu_main
					</div>
				</div>
			";
			return $html;
		}
		
		public function MenuMain(){
				$account_text = $this->loggedin ? "My Account" : "Sign Up";
				$html = "
					<div>
						<ul id='menuMain'>
						<li><a>Q&A</a></li>
						<li><a>Chat</a></li>
						<li><a>Stories</a></li>
						<li><a>Search</a>
						<li><a>$account_text</a></li>
					</ul>
				</div>";		
			
			return $html;
		}
	
	}
	
	
	
	//