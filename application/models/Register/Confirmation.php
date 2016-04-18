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
			$sql = "INSERT INTO users_email_confirmation ".
					"(user_id, creation_date, confirmation_code ) ".
					"VALUES ('".$this->user['id']."', '$now', '$code')";
			
			SQL::Query($sql);
		}
		
		public function GetConfirmationCode(){
			return $this->_confirmation_code;
		}
	
		public function DisplayBadCode(){
			$html = "<div>".
					"<form id='resend-confirm'>".
					"<span class='error'>Bad confirmation code</span><br />".
					"Resend confirmation code to: <input type='text' name='email' value=''>".
					"<a href=#>Send</a>".
					"</form>".
					"</div><div><p>&nbsp;</p></div>";
			return $html;
		}
		
		public function ResendConfirmation(){
			
		}
		
		private function _RemoveConfirmation($user_id=""){
			$sql = "DELETE FROM users_email_confirmation ".
					"WHERE user_id = '$user_id' ";
			SQL::Query($sql);
		}
		
		public function SendEmail(){
			if($this->testing){return;}
			
		}
		
		public function Confirm($code){
			$sql = "SELECT * FROM users_email_confirmation WHERE confirmation_code = '$code' ";
			$row = SQL::Query($sql, true);			
			if($row){ 
				$this->_UpdateUser($row);
				return true;
			}
			return false;			
		}
		
		private function _UpdateUser($row=""){
			$sql = "UPDATE users SET confirmed = 1 where id = '".$row['user_id']."' ";
			SQL::Query($sql);
		}
		
		
	}