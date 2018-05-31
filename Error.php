<?php
 # Exception Handling
 class Error
 { 	
 	public function __call($name,$args){
 		# IF DB STAUS FALSE
 		$queries = ['db','query','insert','delete','update','get_where','select'];
 		if(in_array($name, $queries)){
 			die(Http::setHeader(500,"Enable DB_STATUS in config.php"));
 		}
 		# IF DB STAUS FALSE
 	}
 }