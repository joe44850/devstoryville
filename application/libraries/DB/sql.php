<?php

class SQL {

	public static $last_id;

    public static function connect() {
	
        $CI = & get_instance();
        $CI->load->database();
        //echo $CI->db->hostname;
        $conn = mysqli_connect($CI->db->hostname, $CI->db->username, $CI->db->password) or die(mysqli_error);
        mysqli_select_db($conn, $CI->db->database);
        return $conn;
    }

    public static function disconnect($conn) {
        mysqli_close($conn);
    }

    public static function Query($sql, $return_one = false) {
        $conn = self::connect();
        
		if(preg_match("#insert#si", $sql)){
			$sql = mysqli_real_escape_string($conn);
			mysqli_query($conn, $sql) or die("<font color='red'>$sql</font> " . mysql_error());
			SQL::$last_id = mysqli_insert_id($conn);
			return;
		}
		$res = mysqli_query($conn, $sql) or die("<font color='red'>$sql</font> " . mysql_error());
        while ($rows[] = mysqli_fetch_array($res)) {
            
        };
        array_pop($rows);
        self::disconnect($conn);
        if ($return_one) {
            return @$rows[0];
        }
        return $rows;
    }

}
