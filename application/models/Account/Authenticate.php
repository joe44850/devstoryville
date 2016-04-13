<?php

	class Authenticate {
		
		public static function Check($email="", $pwd=""){
			if(!$email){ return false;}
			if(!$pwd){ return false;}
			$sql = "
				SELECT * FROM `users` 
				WHERE email = '".$email."'
				AND pwd = '".$pwd."' 
			";
			$row = SQL::Query($sql, true);
			return $row;
		}	
		
		
	}