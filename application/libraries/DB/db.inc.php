<?php
	/* we don't want this page to fail, so if it has already been called, we must exit */
	if(!function_exists("dbConnect")){ 
	
	function dbConnect(){					
			$db_host = DBHOST;
			$db_user = DBUSER;
			$db_pass = DBPASS;
			$db_name = DBNAME;			
			//if(!$db_name){ $db_name = DBNAME;}
			if($db_pass == "no"){ $db_pass = "";}					
			$conn = mysql_connect($db_host, $db_user, $db_pass, true) or die("<br />ERROR ".mysql_error());
			@mysqli_select_db($db_name, $conn) or die("ERROR 2".mysql_error());			
			return $conn;			
	}	
	
	//alternative connection script
	function db($db_host="", $db_user="", $db_pass="", $db_name=""){
		if(!$db_pass){ $db_pass = DBPASS;}
		if($db_pass=="no"){ $db_pass = "";}			
		$conn = mysql_connect($db_host, $db_user, $db_pass, true) or die("<font color='red'>Error</font>".mysql_error());			
		mysql_select_db($db_name, $conn) or die(mysql_error());		
		return $conn;
	}
	
	function query($sql="", $conn="", $return_one=false){		
		if(!$sql || !$conn){ return;}
		$res = mysql_query($sql, $conn) or die("<font color='red'>$sql</font> ".mysql_error());				
		while($rows[] = mysql_fetch_array($res)){};
		array_pop($rows);
		if($return_one){ return @$rows[0];}
		return $rows;
	}	
	
	function queryUpdate($sql="", $conn=""){
		mysql_query($sql, $conn) or die("<font color='red'>$sql</font><br />".mysql_error());		
		if(preg_match("#insert#si", $sql)){
			return mysql_insert_id($conn);	
		}
		else return mysql_affected_rows($conn);
	}
	
	function sqlError($sql){
		$html = "<span style='color:red;'>$sql<br /></span>".mysql_error();
		//echo $html;	
	}
	
	function queryFormUpdate($table="", $id_field="", $id_val="", $conn=""){
		if(!$table || !$id_field || !$conn || !$id_val){ return;}
		//first, get fields
		$sql = "DESCRIBE `$table` ";		
		$res = mysql_query($sql, $conn) or die(mysql_error());
		while($row = mysql_fetch_array($res)){
			$fields[] = $row['Field'];
		}
		$sql = "UPDATE `$table` SET ";
		foreach($_POST as $key=>$val){
			if(in_array($key, $fields)){
				$sql.="`$key` = '$val',";	
			}	
		}
		//remove trailing comma
		$sql = substr_replace($sql, "", -1);
		$sql.=" WHERE `$id_field` = '$id_val' ";
		mysql_query($sql, $conn);
	}
	
	function queryFormInsert($table="", $conn=""){
		$sql = "DESCRIBE `$table` ";		
		$res = mysql_query($sql, $conn) or die(mysql_error());
		while($row = mysql_fetch_array($res)){
			$fields[] = $row['Field'];
		}
		$sql = "INSERT INTO `$table` SET ";
		foreach($_POST as $key=>$val){
			$val = mysql_real_escape_string($val);
			if(in_array($key, $fields)){
				if($val == "NOW()"){ $sql.= "`$key` = NOW(),";}
				else{	$sql.="`$key` = '$val',";}	
			}	
		}
		$sql = substr_replace($sql, "", -1);
		//echo("<font color='white'>SQL: $sql</font><br />");
		mysql_query($sql, $conn) or die("ERROR! <font color='red'>$sql</font><br />".mysql_error());
	}
	
	function isDate($val=""){
		$Stamp = strtotime($val);
		$Month = date( 'm', $Stamp );
		$Day   = date( 'd', $Stamp );
		$Year  = date( 'Y', $Stamp );		
		if (checkdate($Month, $Day, $Year)){ 
			echo("Valid date");
			return TRUE;
		}        
    	return;
	}
	
	function getFields($table="", $db=""){
		$sql = "SHOW COLUMNS FROM `$table`";
		$res = mysql_query($sql, $db) or die(mysql_error());
		while($rows = mysql_fetch_array($res)){
			$retval[] = $rows['Field'];	
		}
		return $retval;	
	}
	
	class DataFunctions{
		
		function __construct($db="cms"){
			$this->database = $db;
			$this->db = dbConnect($db);
		}
		
		function moveUp($id="", $table="", $field=""){
			$sql = "SELECT `$field` FROM `$table` WHERE id = '$id' ";
			$res = query($sql, $this->db, true);
			$cur = $res[0];
			$sql = "SELECT id, `$field` FROM `$table` ".			
			"WHERE `$field` < '$cur' ".
			"order by `$field` desc ".
			" LIMIT 1";
			if(($res = query($sql, $this->db, true))){
				$next = $res[$field];
				$swap_id = $res['id'];			
				$sql = "UPDATE `$table` SET `$field` = '$cur' WHERE id = '$swap_id' ";
				mysql_query($sql, $this->db);
				$sql = "UPDATE `$table` SET `$field` = '$next' WHERE id = '$id' ";
				mysql_query($sql, $this->db);
			} //if there are no results, we assume this will be first, make sure all others are 2 or better
			else{
				$sql = "UPDATE `$table` SET `$field` = 2 WHERE `$field` < 2 ";
				$res = mysql_query($sql, $this->db);
				$sql = "UPDATE `$table` SET `$field` = 1 WHERE id = '$id' ";
				mysql_query($sql, $this->db);
			}					
		}
		
		function moveDown($id="", $table="", $field=""){
			$sql = "SELECT `$field` FROM `$table` WHERE id = '$id' ";
			$res = query($sql, $this->db, true);
			$cur = $res[$field];
			$sql = "SELECT id, `$field` FROM `$table` ".
			"WHERE `$field` > '$cur' ".
			"ORDER BY `$field` asc ".
			"LIMIT 1";
			if(($res = query($sql, $this->db, true))){
				$next = $res[$field];
				$swap_id = $res['id'];			
				$sql = "UPDATE `$table` SET `$field` = '$cur' WHERE id = '$swap_id' ";
				mysql_query($sql, $this->db);
				$sql = "UPDATE `$table` SET `$field` = '$next' WHERE id = '$id' ";
				mysql_query($sql, $this->db);
			} //if there are no results, we assume this will be first, make sure all others are 2 or better
			else{
				$sql = "SELECT max(`$field`) as max FROM `$table` ";
				$res = query($sql, $this->db, true);
				$max = $res['max'];
				$next = $max++;
				$sql = "UPDATE `$table` SET `$field` = '$max' WHERE id = '$id' ";
				mysql_query($sql, $this->db);
			}
		}
		
		function sortUnique($table="", $field=""){
			$sql = "SELECT id FROM `$table` ORDER BY `$field` asc ";
			$rows = query($sql, $this->db);
			if($rows){				
				$multiple = 1;
				$n = 1;
				foreach($rows as $row){
					$id = $row['id'];
					$sort = $n * $multiple;
					$sql = "UPDATE `$table` SET `$field` = '$sort' WHERE id = '$id' ";
					mysql_query($sql, $this->db);
					$n++;
				}	
			}
		}
		
		function getPagination($table="", $limit=""){
			
			$retval['start_at'] = self::getStartAt();
			$retval['direction'] = self::getDirection();
			isset($limit) ? $retval['limit'] = $limit : $retval['limit'] = self::getLimit();
			$retval['order_by'] = self::getOrderBy($table);			
			
			//get total 
			$sql = "SELECT count(id) FROM `$table` ";			
			$rows = query($sql, $this->db, true);			
			$retval['total_results'] = $rows[0];
			$retval['pages'] = ceil($retval['total_results']/$retval['limit']);	
			//what is the current page?
			$retval['page_no'] = self::getPageNo($table);	
			
			//reset the session
			$_SESSION[$table.'_start_at'] = $retval['start_at'];				
			return $retval;
		}
		
		function getStartAt($table=""){
			if(!isset($_REQUEST['start_at'])){
				isset($_SESSION[$table."_start_at"]) ? $_SESSION[$table."_start_at"] : $_SESSION[$table."_start_at"] = "0";	
				$_REQUEST['start_at'] = $_SESSION[$table."_start_at"];
				return;
			}
			else{
				isset($_REQUEST['start_at']) ? $start_at = $_REQUEST['start_at'] : $start_at = "0";
				$_SESSION[$table."_start_at"] = $start_at;
				return $start_at;
			}
			return $start_at;
		}
		
		function getDirection($table=""){	
			if(isset($_REQUEST['direction'])){ 
				$direction = $_REQUEST['direction'];			
				$_SESSION[$table."_direction"] = $direction;
			}
			else if(isset($_SESSION[$table."_direction"])){ $direction = $_SESSION[$table."_direction"];}
			else $direction = "asc";			
			return $direction;
		}
		
		function getLimit($table=""){
			isset($_REQUEST['limit']) ? $limit = $_REQUEST['limit'] : $limit = 20;
			$_SESSION[$table."_limit"] = $limit;
			return $limit;
		}
		
		function getPageNo($table=""){			
			isset($_REQUEST['page_no']) ? $page_no = $_REQUEST['page_no'] : $page_no = 1;
			$_SESSION[$table."_page_no"] = $page_no;
			return $page_no;	
		}
		
		function getOrderBy($table=""){							
			if(!isset($_REQUEST['order_by'])){
				if(isset($_SESSION[$table."_order_by"])){					
					return $_SESSION[$table."_order_by"];	
				}	
			}		
			isset($_REQUEST['order_by']) ? $order_by = $_REQUEST['order_by'] : $order_by = "sort_order";			
			$_SESSION[$table."_order_by"] = $order_by;			
			return $order_by;	
		}		
	}
	
	
}
	
?>
