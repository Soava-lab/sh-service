<?php
#############################################
	 # DO NOT REMOVE ANYTHONG HERE #
#############################################
define("SH_KEY","API");
define("SH_VALUE","SH");
$SH_AUTH = [
			"HEAD"=>[
						"API"=>"SH",
						"AUTHOR"=>"bala"
					],
			"AUTH"=>[
					"access_token"=>"shservice"
					]
		   ];

$_GLOBALS['SH_AUTH'] = $SH_AUTH;

/* CONTROLLER */
#=================================#
define("CONTROLLER_PATH","controller/");
define("MODEL_PATH","model/");
define("HTML_PATH","html/");
define("LIBRARY_PATH","library/");
define("LANG_PATH","language/");
define("EXT_PATH","extender/");
define("CMS_PATH","cms/");

#=================================#
define("APPPATH",""); 				 # __DIR__     
define("ENVIRONMENT","");			 # DEVELOPMENT
define("BASEPATH","");				 # APPPATH."/" 
#=================================#

/* DATABASE */
define("HOST","localhost");
define("USERNAME","root");
define("PASSWORD","root");
define("DATABASE","3p-php");
define("DATABASE_TYPE","mysqli");
define("DB_STATUS",true); #

# ADDITIONAL OPTIONS
define("DNS","");
define("DATABASE_PREFIX","");
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
#############################################
	 # DO NOT REMOVE ANYTHONG HERE #
#############################################
