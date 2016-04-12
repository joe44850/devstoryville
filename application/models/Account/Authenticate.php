<?php

	class Authenticate {
		
		public static function Check($user="", $email=""){
			if(!$user){ return false;}
			if(!$email){ return false;}
			$sql = "
				SELECT * FROM `users` 
				WHERE email = '".$email."'
				AND pwd = '".$pwd."' 
			";
			$row = SQL::Query($sql, true);
			return $row;
		}
		
	}