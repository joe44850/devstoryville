<?php
	require_once("IRegister.php");

	class Register implements IRegister {
		
		public $User;
		private $_User;
		
		public function __construct(){
			
		}
		
		public function SignupHtml(){
			
			$html = "
				
			";
			return $html;
		}
		
		public function Create($vars=""){
			$_POST['pwd'] = md5($_POST['pwd']);
			$_POST['token'] = bin2hex(random_bytes(50));
			$this->User = $_POST;
			$this->User["success"] = false;
			Logger::Write($_POST);
			if($this->UsernameExists($this->User['username'])){
				$this->User["create_error"] = "The username {$this->User['username']} already exists in our system";
				return;
			}
			else if($this->EmailExists($this->User['email'])){
				$this->User["create_error"] = "The email address {$this->User['email']} already exists in our system";
				return;
			}
			else{
				/* encrypt the password */
				
				$user_id = SQL::Post($this->User, 'users');
				$this->User['success'] = "true";
				$this->_User = $this->User;
				$this->_User["id"] = $user_id;
				return;
			}
		}		
		
		
		public function GetCreatedUser(){
			if(!$this->_User){ return null;}
			else return $this->_User;
		}
		
		public function CreateResult(){
			return json_encode($this->User);			
		}
		
		public function UsernameExists($user=""){
			$sql = "
					SELECT 1 FROM users 
					where LOWER(username) = LOWER('$user')					
				";
			if(SQL::Query($sql)){ return true;}
			return false;
		}
		
		public function EmailExists($email=""){
			$sql = "
					SELECT 1 FROM users 
					where LOWER(email) = LOWER('$email') 
				";
			if(SQL::Query($sql)){ return true;}
			return false;
		}
		
		public function EmailNewSignup(){
			
		}
		
	}