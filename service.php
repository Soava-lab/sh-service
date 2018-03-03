<?php
require_once 'config.php';
$token = "";
if(defined("REMOTE_TOKEN")){
	$token = REMOTE_TOKEN;
}
$data = json_decode(file_get_contents("php://input"));
if($data!="" && isset($data->token) && $data->token!=""){
	header("Access-Control-Allow-Origin: *");
	header("HTTP/1.1 200");
	header("Content-Type: application/json");
	if(($data->token == $token) || $token==""){
		die(json_encode(array("auth_key"=>"sh","auth_token"=>md5($data->token),"status"=>200)));
	}else{
		die(json_encode(array("auth_key"=>"","auth_token"=>"","status"=>500)));
	}
}
# check auth key token here
if(isset($_GET['key'],$_GET['token']) && $_GET['key']!='' && $_GET['token']!=''){
	if(($_GET['token'] == md5($token)) || $token==""){
		if(isset($_GET['cmd']) && $_GET['cmd']!=''){
			 $cmd = strtolower($_GET['cmd']);
			 $explode = explode("/",$cmd);
			 if(count($explode) > 0){ $base_cmd = $explode[0];
				if($base_cmd == 'curl'){
					die("Sorry, Remote curl not allowed.");
				}
				if($base_cmd == 'rm' || $base_cmd == 'remove'){
					$cmd = $cmd." y";
				}
			}
			$cmd = str_replace("/"," ",$cmd);
			echo shell_exec("php sh ".$cmd);
			die;
		}
	}else{
		die("Sorry, your token is invalid. please check it.");
	}
}
echo "sh";
?>
