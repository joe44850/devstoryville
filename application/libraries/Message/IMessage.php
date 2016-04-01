<?php

	Interface IMessage {
		
		public function GetDefaultMessage();
		public function GetSiteMessages();
		public function GetNumberOfNewMessages();
		public function GetMessagesByUser($userid);
				
	}