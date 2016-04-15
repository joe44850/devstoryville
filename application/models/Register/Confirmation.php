<?php

	if(!interface_exists("IConfirmation")){ require_once("IConfirmation.php");}
	
	Class Confirmation implements IConfirmation {
		
		public $testing = false;
		public $user;
		private $_confirmation_code;
		
		public function __construct(array $user=null){
			$this->user = $user;
		}
		
		public function CreateCode(){
			$now = date("Y-m-d h:i:s");
			$this->_RemoveConfirmation($this->user['id']);			
			$code = md5($this->user['id'].$this->user['email'].$now);
			$sql = "
					INSERT INTO user_email_confirmation (user_id, creation_date, confirmation_code ) 
					VALUES ('".$this->user['id']."', '$now', '$code') 
				";
			SQL::Query($sql);
		}
		
		public function GetConfirmationCode(){
			return $this->_confirmation_code;
		}
		
		private function _RemoveConfirmation($user_id=""){
			$sql = "DELETE FROM user_email_confirmation ".
					"WHERE user_id = '$user_id' ";
			SQL::Query($sql);
		}
		
		public function SendEmail(){
			if($this->testing){return;}
			
		}
		
		public function Confirm(){
			
			
		}
		
		
	}