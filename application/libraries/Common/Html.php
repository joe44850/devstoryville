<?php

	class Html{
	
		private $site;
		public $title;
		public $cache = false;
	
		public function __construct(){
			$this->site = SITE;
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
			echo $html;
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
			echo $html;
		}
		
		public function NavBar(){
			$html = "
				<div id=\"HeaderTop\">
					<div id=\"HeaderCenter\">			
						<div id=\"LogoMain\">&nbsp;</div>
					</div>
				</div>
			";
			echo $html;
		}
	
	}