<?php

	class Authenticate {
		
		public static function Check($username="", $pwd=""){
			if(!$username){ return false;}
			if(!$pwd){ return false;}
			$pwd = MD5($pwd);
			$sql = "
				SELECT * FROM `users` 
				WHERE username = '".$username."'
				AND pwd = '".$pwd."' 
			";
			$row = SQL::Query($sql, true);
			return $row;
		}

		public static function ByToken($username="", $token=""){
			if(!$username || !$token){ return null;}
			$sql = "SELECT * FROM users ".
				   "WHERE LOWER(username) = LOWER('$username') ".
				   "AND token = '$token' ";
			$row = SQL::Query($sql, true);
			return $row;
		}	
		
		
	}