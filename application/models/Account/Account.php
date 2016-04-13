<?php

	if(!interface_exists("IAccount")) require_once("IAccount.php");
	
	class Account implements IAccount {		
		
		private $_Login;
		
		public function __construct(Login $_Login){
			$this->_Login = $_Login;			
		}
		
		public function Create(){
			
		}
		
		public function Read(){
			
		}
		
		public function Update(){
			
		}
		
		public function Delete(){
			$this->_Login->Delete();
		}
		
		public function IsLoggedIn(){			
			return $this->_Login->is_logged_in;
		}
		
	}	