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
			if($this->_SessionAuthenticate()){ return true;}
			if(!$username || !$pwd){ return false;}
			if(Authenticate::Check($username, $pwd)){				
				$this->_setSession($username, $pwd);
				return true;
			}
			else $this->Delete();
			return false;
		}
		
		public function AttemptByToken($username="", $token=""){
			$userinfo = Authenticate::ByToken($username, $token);
			if($userinfo["id"]){
				$this->_SetSession($userinfo['username'], $userinfo['pwd']);
			}			
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
		
		public static function SetSession($user="", $pwd=""){
			if(!$user || !$pwd){
				throw new Exception("You cannot call Login::SetSession without user and pwd");
			}
			$_SESSION[USER] = $user;			
			$_SESSION['loggedin'] = true;
		}
		
		public function Delete(){			
			unset($_SESSION[USER]);
			unset($_SESSION[PWD]);
			$this->is_logged_in = false;
		}	

		public function Logout(){
			unset($_SESSION[USER]);
			unset($_SESSION[PWD]);
			unset($_SESSION['loggedin']);
		}
		
		public static function IsLoggedIn(){
			$obj = new static();
			return $obj->_SessionAuthenticate();
		}
		
		private function _SessionAuthenticate(){
			if(!isset($_SESSION['loggedin'])){ return false;}
			if($_SESSION['loggedin']){ return true;}
		}
		
		private function _setSession($user="", $pwd=""){
			if(!$user || !$pwd){ $this->Delete();}
			else{
				Login::SetSession($user, $pwd);				
			}
		}
		
	}