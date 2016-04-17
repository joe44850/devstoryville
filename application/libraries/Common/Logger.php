<?php

	class Logger {
		
		public static function Write($msg, $logfile=""){
			$path = ROOT."/application/logs";			
			if(!$logfile){ $logfile = "error_log.txt";}
			$file = $path."/".$logfile;
			$handle = fopen($file, "a");
			$now = date("F j, Y h:i a");
			fwrite($handle, "\r $now");
			fwrite($handle, "\t $msg");
			fwrite($handle, " \r");
			fclose($handle);
		}
		
	}