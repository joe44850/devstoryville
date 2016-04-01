<?php
	require_once "IMessage.php";
	
	class Message implements IMessage {
		
		public function GetDefaultMessage(){
			$html = "<div>Default message!</div>";
			return $html;
		}
		
		public function GetNumberOfNewMessages(){
			
		}
		
		
		public function GetMessagesByUser($userid){
			
			
		}
		
		public function GetSiteMessages(){
			
		}
		
		
	}