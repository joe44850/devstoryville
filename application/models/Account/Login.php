<?php

	if(!interface_exists("ILogin")){ require_once("ILogin.php");}
	if(!class_exists("Authenticate")){ require_once("Authenticate.php");}
	
	class Login implements ILogin {
		
		var $username;
		var $email;
		var $pwd;
		public $is_logged_in = false;
		
		public function __construct(){
			$this->is_logged_in = $this->_SessionAuthenticate();			
		}
		
		public function Attempt($username="", $pwd=""){
			if(!$username){ isset($_SESSION[USER]) ? $username = $_SESSION[USER] : ""; }
			if(!$pwd){ isset($_SESSION[PWD]) ? $pwd = $_SESSION[PWD] : "";}
			if(!$username || $pwd){ return false;}
			if(Authenticate::Check($username, $pwd)){				
				$this->_setSession($username, $pwd);
			}
			else $this->Delete();
		}
		
		public function AttemptOverride(){
			return $this->Attempt('test10@test.com', 'testerman');
		}
		
		public function Create(){
			
		}
		
		/* is the user logged in? */
		public function Read(){
			
		}
		
		public function Update(){
			
		}
		
		public function Delete(){			
			unset($_SESSION[USER]);
			unset($_SESSION[PWD]);
			$this->is_logged_in = false;
		}		
		
		private function _SessionAuthenticate(){
			if (!isset($_SESSION[USER])) { return false;}
			if (!isset($_SESSION[PWD])) { return false;}
			return Authenticate::Check($_SESSION[USER], $_SESSION[PWD]);
		}
		
		private function _setSession($user="", $pwd=""){
			if(!$user || !$pwd){ $this->Delete();}
			else{
				$_SESSION[USER] = $user;
				$_SESSION[PWD] = $pwd;
			}
		}
		
	}