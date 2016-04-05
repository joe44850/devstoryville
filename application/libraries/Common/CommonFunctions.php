<?php
/* common functions that are available globally */

function dirFiles($dir = "", $filetype = "") {
  $root = $_SERVER['DOCUMENT_ROOT'];
  $dir = $root.$dir;
  if (!$dir || !is_dir($dir)) {
	return;
    throw new Exception("Invalid directory");
  }
  try {
    $retval = array();
    $matches = glob($dir . "/*." . $filetype);
    //need to seperate path from file
    foreach ($matches as $file) {      
      $pattern = "#" . $root . "#si";
      $retval[] = preg_replace($pattern, "", $file);
    }
    return $retval;
  } catch (Exception $ex) {
    echo($ex->getMessage());
  }
}

/* Dummy class file so CodeIgniter doesn't choke */
class CommonFunctions{
  
  function __construct(){}  
  
}
