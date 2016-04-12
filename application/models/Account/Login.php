<?php

	if(!interface_exists("ILogin")){ require_once("ILogin.php");}
	if(!class_exists("Authenticate")){ require_once("Authenticate.php");}
	
	class Login implements ILogin {
		
		var $username;
		var $email;
		var $pwd;
		
		public function __construct(){
			
		}
		
		public function Attempt($username="", $pwd=""){
			return Authenticate::Check($username, $pwd);
		}
		
		public function Create(){
			
		}
		
		/* is the user logged in? */
		public function Read(){
			
		}
		
		public function Update(){
			
		}
		
		public function Delete(){
			
		}
		
		private function _Authenticate($email="", $pwd=""){
					
		}
		
	}