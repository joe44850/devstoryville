<?php

class SQL {

	public static $last_id;

    public static function connect() {
	
        //$CI = & get_instance();
        //$CI->load->database();
        //echo $CI->db->hostname;
        $conn = mysqli_connect(DBHOST, DBUSER, DBPASS) or die(mysqli_error);
        mysqli_select_db($conn, DBNAME);
        return $conn;
    }

    public static function disconnect($conn) {
        mysqli_close($conn);
    }

    public static function Query($sql, $return_one = false) {
        $conn = self::connect();
        
		if(preg_match("#insert#si", $sql)){
			$sql = mysqli_real_escape_string($conn, $sql);
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
	
	public static function Post($vars="", $table=""){
		$vars = safe($vars);
		if(!$vars){ return; }
		$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.columns WHERE TABLE_NAME = '$table' ";
		$rows = SQL::Query($sql);
		$keys = array();
		$values = array();
		$columns = array();
		foreach($rows as $arr){ foreach($arr as $key=>$val){ echo $columns[] = $val;}}
		foreach($vars as $key=>$val){
			echo "$key = $val";
			if(in_array($key, $columns)){ 
				$keys[] = $key;
				$values[] = $val;
			}
		}
		$sql = "INSERT INTO `$table` (".implode(",", $keys).") VALUES ('".implode("','", $values)."')";
		$conn = self::connect();
		mysqli_query($conn, $sql) or die("<font color='red'>$sql</font> " . mysql_error());
		SQL::Query($sql);
	}

}
