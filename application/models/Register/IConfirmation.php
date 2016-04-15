<?php

	Interface IConfirmation {
		
		function CreateCode();
		function SendEmail();		
		function Confirm();
		
	}