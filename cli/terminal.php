<?php
require_once 'db.php';
require_once 'is_exist.php';
require_once 'curl.php';
require_once 'get_synch.php';
require_once 'pull_synch.php';
define("GIT_TOKEN", "ebb6a6eaf37ea42851372278954f24ad1b742398");

function remote_sh_cmd($url){ $baseUrl = $url;
		ob_start();
		$parse = parse_url($baseUrl); 
		$scheme= (isset($parse['scheme']))?$parse['scheme']:"";
		$host= (isset($parse['host']))?$parse['host']:"";
		$message   =  "\n".'$'.$scheme.'://'.$host.substr(strstr($parse['path'],'service.php',true),0,-1).':$sh>';
		print $message;
		flush();
		ob_flush();
		$cmd  =  strtolower(trim( fgets( STDIN ) ));
		if(trim($cmd) == "") {
			ob_get_flush();
			remote_sh_cmd($baseUrl);
		}
		if($cmd == 'exit'){ echo "Remote service Closed. \n"; ob_get_flush(); sh_cmd(); }	
		if($cmd == 'clear' || $cmd == 'reset' || $cmd == 'cls'){  
				if(strtoupper(substr(PHP_OS, 0, 3)) == 'WIN'){
					echo shell_exec("cls"); $cmd = '-v'; 
				}else{
					echo shell_exec("reset"); $cmd = '-v';
				}
			}
		$cmd = str_replace(" ","/",$cmd);
		$basecmd = strstr($cmd,"/",true);
		$url = $url.$cmd;
		if(isset($basecmd) && $basecmd == 'curl'){
			echo "Sorry, Remote curl not allowed.\n";
		}else if(isset($basecmd) && $basecmd == 'remote' || $basecmd == '-i'){ 
			echo "Sorry, Remote service not allowed inner of remote.\n";
		}else if(isset($basecmd) && $basecmd == 'push'){
			$dest = $type = "";
			$cmdC = explode("/", $cmd);
			
			if(count($cmdC) == 3){
				$cmd = "/".$cmdC[1];
				$dest = $cmdC[2];
			}
			
			$argv_cmd = ltrim(strstr($cmd,"/"),"/");
			$whatAt = explode(":", $argv_cmd);
			if(count($whatAt) == 2){
				$type = strtolower($whatAt[0]);
				$typeName = strtolower($whatAt[1]);			
			} 
			$remoteUrl = explode("service.php",$url);
			$remoteUrl = $remoteUrl[0]."cli/synch.php";
			switch ($type) {
				case 'controller':
					echo clean_color(getSynch::controller($typeName,$dest,$remoteUrl));
				break;
				case 'model': 
					echo clean_color(getSynch::model($typeName,$dest,$remoteUrl));
				break;
				case 'library':
					echo clean_color(getSynch::library($typeName,$dest,$remoteUrl));
				break;
				case 'extender':
					echo clean_color(getSynch::extender($typeName,$dest,$remoteUrl));
				break;
				case 'package':
					echo clean_color(getSynch::package($typeName,$dest,$remoteUrl));
				break;
				case 'module':
					echo clean_color(getSynch::module($typeName,$dest,$remoteUrl));
				break;
				case 'api':
					echo clean_color(getSynch::api($typeName,$dest,$remoteUrl));
				break;
									
				default:
					echo BAD_FORMAT();
				break;
			}

		}else if(isset($basecmd) && $basecmd == 'pull'){
			$dest = $type = "";
			$cmdC = explode("/", $cmd);
			
			if(count($cmdC) == 3){
				$cmd = "/".$cmdC[1];
				$dest = $cmdC[2];
			}
			
			$argv_cmd = ltrim(strstr($cmd,"/"),"/");
			$whatAt = explode(":", $argv_cmd);
			if(count($whatAt) == 2){
				$type = strtolower($whatAt[0]);
				$typeName = strtolower($whatAt[1]);			
			}
						
			switch ($type) {
				case 'controller':
					echo clean_color(pullSynch::controller($typeName,$dest,$url));
				break;
				case 'model': 
					echo clean_color(pullSynch::model($typeName,$dest,$url));
				break;
				case 'library':
					echo clean_color(pullSynch::library($typeName,$dest,$url));
				break;
				case 'extender':
					echo clean_color(pullSynch::extender($typeName,$dest,$url));
				break;
				case 'package':
					echo clean_color(pullSynch::package($typeName,$dest,$url));
				break;
				case 'module':
					echo clean_color(pullSynch::module($typeName,$dest,$url));
				break;
				case 'api':
					echo clean_color(pullSynch::api($typeName,$dest,$url));
				break;
									
				default:
					echo BAD_FORMAT();
				break;
			}

		}else{ $cmd_output = '';
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$cmd_output = curl_exec($ch);
			curl_close ($ch);
			echo clean_color($cmd_output);
		}
		#$output = ob_get_contents();
		ob_get_flush();
		remote_sh_cmd($baseUrl);
}

if(isset($argv[1]) && $argv[1]!=''){
	if(strtolower($argv[1]) == 'create' || strtolower($argv[1]) == 'mk'){ require_once 'create.php';
		if(isset($argv[2]) && $argv[2]!=''){
			$whatAt = explode(":", $argv[2]);
			if(count($whatAt) == 2 && $whatAt[1]!=""){
				$type = strtolower($whatAt[0]);
				$typeName = strtolower($whatAt[1]);
				switch ($type) {
					case 'controller':
						echo clean_color(create::controller($typeName));
					break;
					case 'model':
						echo clean_color(create::model($typeName));
					break;
					case 'library':
						echo clean_color(create::library($typeName));
					break;
					case 'extender':
						echo clean_color(create::extender($typeName));
					break;
					case 'package':
						echo clean_color(create::package($typeName));
					break;
					case 'api':
						echo clean_color(create::api($typeName));
					break;
										
					default:
						echo BAD_FORMAT();
					break;
				}
			}else{
				echo BAD_FORMAT();
			}
		}else{
			echo BAD_FORMAT();
		}
	}elseif(strtolower($argv[1]) == 'remote' || strtolower($argv[1]) == '-i'){ 

		if(isset($argv[2]) && $argv[2]!=''){
			$token = isset($argv[3])?$argv[3]:"";
			$tokenObj = json_encode(array("token"=>$token));
			$domain = rtrim($argv[2],"/");
			$url = $domain."/service.php";
			$ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$tokenObj);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $status = curl_exec($ch);
            curl_close ($ch);
			if($status != ""){
				$auth = json_decode($status);
				if(isset($auth,$auth->auth_key,$auth->auth_token)){ 
					if($auth->auth_key!="" && $auth->auth_token!=""){
						$key = $auth->auth_key; $token = $auth->auth_token;
						$url = $baseUrl = $url.'?key='.$key.'&token='.$token.'&cmd=';
						echo "Remote sh service connected successfuly.\nFor help enter -h\n";
						remote_sh_cmd($url);
					}else{
						echo "Sorry, your token is invalid. please check it\n";
					}
				}else{
					if($status == 'sh'){
						echo "Security token is missing, Check CMD : remote url token.\n";
					}else{
						echo "Sorry, could not find sh service.\n";
					}
				}
			}else{
					echo "Sorry, could not find sh service.\n";
			}
	 	}else{
			echo BAD_FORMAT();
		}
	 
	}elseif(strtolower($argv[1]) == 'remove' || strtolower($argv[1]) == 'rm'){ require_once 'remove.php';

		if(isset($argv[2]) && $argv[2]!=''){
			$whatAt = explode(":", $argv[2]);
			if(count($whatAt) == 2){
				$type = strtolower($whatAt[0]);
				$typeName = strtolower($whatAt[1]);
				$rm_api = NULL;
				if($type == 'api' && count($argv) == 5){
					$rm_api  = (isset($argv[3]))?$argv[3]:NULL;
					$prompt  = (isset($argv[4]))?$argv[4]:NULL;
				}else{
					$prompt  = (isset($argv[3]))?$argv[3]:NULL;
				}
				switch ($type) {
					case 'controller':
						echo clean_color(remove::controller($typeName,$prompt));
					break;
					case 'model':
						echo clean_color(remove::model($typeName,$prompt));
					break;
					case 'library':
						echo clean_color(remove::library($typeName,$prompt));
					break;
					case 'extender':
						echo clean_color(remove::extender($typeName,$prompt));
					break;
					case 'package':
						echo clean_color(remove::package($typeName,$prompt));
					break;
					case 'module':
						echo clean_color(remove::module($typeName,$prompt));
					break;
					case 'api':
						echo clean_color(remove::api($typeName,$rm_api,$prompt));
					break;
										
					default:
						echo BAD_FORMAT();
					break;
				}
			}else{
				echo BAD_FORMAT();	
			}
		}else{
			echo BAD_FORMAT();
		}

	}elseif(strtolower($argv[1]) == 'import' || strtolower($argv[1]) == 'im'){ require_once 'import.php';
		$import = new import();
		if(isset($argv[2]) && $argv[2]!=''){
			$whatAt = explode(":", $argv[2]);
			if(count($whatAt) == 2){
				$type = strtolower($whatAt[0]);
				$typeName = strtolower($whatAt[1]);
				switch ($type) {
					case 'package':
						echo (trim($type)!="" && $typeName)?clean_color($import->package($typeName)):BAD_FORMAT();
					break;
					case 'module':
						echo (trim($type)!="" && $typeName)?clean_color($import->module($typeName)):BAD_FORMAT();
					break;				
					default:
						echo BAD_FORMAT();
					break;
				}
			}else{
				echo BAD_FORMAT();	
			}
		}else{
			echo BAD_FORMAT();
		}

	}elseif(strtolower($argv[1]) == 'git'){ require_once 'import.php';
		$import = new import();
		if(isset($argv[2]) && $argv[2]!=''){
			$whatAt = explode(":", $argv[2]);
			if(count($whatAt) == 2){
				$type = strtolower($whatAt[0]);
				$typeName = strtolower($whatAt[1]);
				switch ($type) {
					case 'package':
						echo (trim($type)!="" && $typeName)?clean_color($import->git_package($typeName)):BAD_FORMAT();
					break;
					case 'module':
						echo (trim($type)!="" && $typeName)?clean_color($import->git_module($typeName)):BAD_FORMAT();
					break;				
					default:
						echo BAD_FORMAT();
					break;
				}
			}else{
				echo BAD_FORMAT();	
			}
		}else{
			echo BAD_FORMAT();
		}

	}elseif(strtolower($argv[1]) == 'compile' || strtolower($argv[1]) == 'exe'){ require_once 'compile.php';
		$compile = new compile();
		if(isset($argv[2]) && $argv[2]!=''){						
				$type = $argv[2]; $typeName = '';
				$whatAt = explode(":", $argv[2]);
				if(count($whatAt) == 2){
					$type = strtolower($whatAt[0]);
					$typeName = strtolower($whatAt[1]);
				}
				switch ($type) {
					case 'extender':
						echo clean_color($compile->extender());
						if($typeName!=""){# Single
							echo clean_color($compile->one($typeName));
						}else{# All
							echo clean_color($compile->extender());
						}
					break;				
					default:
						echo BAD_FORMAT();
					break;
				}
			
		}else{
			echo BAD_FORMAT();
		}

	}elseif(strtolower($argv[1]) == 'explain' || strtolower($argv[1]) == 'exp'){ require_once 'explain.php';
		$explain = new explain();
		if(isset($argv[2]) && $argv[2]!=''){
			$whatAt = explode(":", $argv[2]);
			if(count($whatAt) == 2 && $whatAt[1]!=""){
				$type = strtolower($whatAt[0]);
				$typeName = strtolower($whatAt[1]);
				switch ($type) {
					case 'module':
						echo (trim($type)!="" && $typeName)?clean_color($explain->module($typeName)):BAD_FORMAT();
					break;
					case 'extender':
						echo (trim($type)!="" && $typeName)?clean_color($explain->extender($typeName)):BAD_FORMAT();
					break;
					case 'routes':
						echo (trim($type)!="" && $typeName)?clean_color($explain->routes($typeName)):BAD_FORMAT();
					break;		
					case 'modules:live':
						echo clean_color(show::live_module("modules"));
					break;
					case 'packages:live':
						echo clean_color(show::live_package("packages"));
					break;
					default:
						echo BAD_FORMAT();
					break;
				}
			}else{
				echo BAD_FORMAT();	
			}
		}else{
			echo BAD_FORMAT();
		}

	}elseif(strtolower($argv[1]) == 'show' || strtolower($argv[1]) == 'ls' || strtolower($argv[1]) == 'list'){ require_once 'show.php';

		if(isset($argv[2]) && $argv[2]!=''){
				$type = strtolower($argv[2]);
				$typeName = strtolower($argv[2]);
				switch ($type) {
					case 'controllers':
						echo clean_color(show::controller($typeName));
					break;
					case 'models':
						echo clean_color(show::model($typeName));
					break;
					case 'libraries':
						echo clean_color(show::library($typeName));
					break;
					case 'api':
						echo clean_color(show::api($typeName));
					break;
					case 'extenders':
						echo clean_color(show::extender($typeName));
					break;
					case 'packages':
						echo clean_color(show::package($typeName));
					break;
					case 'modules':
						echo clean_color(show::module($typeName));
					break;
					case 'modules:live':
						echo clean_color(show::live_module("modules"));
					break;
					case 'packages:live':
						echo clean_color(show::live_package("packages"));
					break;
					case 'modules:git':
						echo clean_color(show::git_module("modules"));
					break;
					case 'packages:git':
						echo clean_color(show::git_package("packages"));
					break;
										
					default:
						echo BAD_FORMAT();
					break;
				}
		}else{
			echo BAD_FORMAT();
		}

	}elseif(strtolower($argv[1]) == 'nano' || strtolower($argv[1]) == 'subl' || strtolower($argv[1]) == 'vim' || strtolower($argv[1]) == 'notepad'){ require_once 'edit.php';
		$edit = new edit();
		if(isset($argv[2]) && $argv[2]!=''){
			$whatAt = explode(":", $argv[2]);
			if(count($whatAt) == 2 && $whatAt[1]!=""){
				$type = strtolower($whatAt[0]);
				$fileName = strtolower($whatAt[1]);
				switch ($type) {
					case 'package':
						echo (trim($type)!="" && $fileName!='')?clean_color($edit->package($fileName , strtolower($argv[1]))):BAD_FORMAT();
					break;
					case 'library':
						echo (trim($type)!="" && $fileName!='')?clean_color($edit->library($fileName , strtolower($argv[1]))):BAD_FORMAT();
					break;
					case 'extender':
						echo (trim($type)!="" && $fileName!='')?clean_color($edit->extender($fileName , strtolower($argv[1]))):BAD_FORMAT();
					break;
					case 'model':
						echo (trim($type)!="" && $fileName!='')?clean_color($edit->model($fileName , strtolower($argv[1]))):BAD_FORMAT();
					break;
					case 'controller':
						echo (trim($type)!="" && $fileName!='')?clean_color($edit->controller($fileName , strtolower($argv[1]))):BAD_FORMAT();
					break;
					case 'html':
						echo (trim($type)!="" && $fileName!='')?clean_color($edit->html($fileName , strtolower($argv[1]))):BAD_FORMAT();
					break;
					case 'module':
						echo (trim($type)!="" && $fileName!='')?clean_color($edit->module($fileName , strtolower($argv[1]))):BAD_FORMAT();
					break;
					case 'api':
						echo (trim($type)!="" && $fileName!='')?clean_color($edit->api($fileName , strtolower($argv[1]))):BAD_FORMAT();
					break;
					default:
						echo BAD_FORMAT();
					break;
				}
			}else{
				echo BAD_FORMAT();	
			}
		}else{
			echo BAD_FORMAT();
		}

	}elseif($argv[1] == 'curl'){ require_once 'curl.php';
		$curl = new curl();
		if(isset($argv[2]) && $argv[2]!=''){
			$whatAt = explode(":", $argv[2]);			
			if(count($whatAt) >=2 && $whatAt[1]!=""){
				$type = strtolower($whatAt[0]);
				$whatAt = explode($type.":", $argv[2]);
				$typeName = strtolower($whatAt[1]);
				switch ($type) {
					case 'get':
						echo clean_color($curl->get($typeName));
					break;
					case 'post':
						echo clean_color($curl->post($typeName));
					break;											
					default:
						echo BAD_FORMAT();
					break;
				}
			}else{
				echo BAD_FORMAT();	
			}
		}else{
			echo BAD_FORMAT();
		}

	}elseif(strtolower($argv[1]) == 'server' || strtolower($argv[1]) == '-s'){
		
		if(isset($argv[2]) && $argv[2]!=''){
			$whatAt = explode(":", $argv[2]);			
			if(count($whatAt) >=2 ){
				$type = strtolower($whatAt[0]);
				$whatAt = explode($type.":", $argv[2]);
				$port = strtolower($whatAt[1]);
				shell_exec("php -S localhost:".$port);				
			}else{
				echo BAD_FORMAT();	
			}
		}else{
			echo BAD_FORMAT();
		}
			
	}elseif(strtolower($argv[1]) == '-v' || strtolower($argv[1]) == '-version'){
			echo clean_color("\033[0;32msh-service framework v1.0.0 \033[0m (\033[0;37mDeveloped @ Soava Lab\033[0m) \n");
	}elseif(strtolower($argv[1]) == '-h' || strtolower($argv[1]) == '-help'){
		require_once 'commands.php';
	}elseif(strtolower($argv[1]) == 'status'){
		echo clean_color("\033[0;32msh-service is running...\033[0m \n");
	}elseif(strtolower($argv[1]) == 'sudo'){
		if(isset($argv[2]) && $argv[2]!=''){			
				$cmd = $argv[2];
				echo shell_exec($cmd);
		}else{
			echo BAD_FORMAT();
		}
	}elseif(strtolower($argv[1]) == 'cmd'){
		if(isset($argv[2]) && $argv[2]!=''){		
				$cmd = $argv[2];
				echo shell_exec($cmd);
		}else{
			echo BAD_FORMAT();
		}
	}else{
		echo BAD_FORMAT();
	}
}else{
		
		# $sh : command
		function sh_cmd(){
			ob_start();
			$message   =  "\n".'$sh>';
			print $message;
			flush();
			ob_flush();
			$cmd  =  trim( fgets( STDIN ) );
			if(trim($cmd) == "") {
				ob_get_flush();
				sh_cmd();
			}
			if(strtolower($cmd) == 'exit'){ echo "Bye \n"; exit(0); }
			if($cmd == 'clear' || $cmd == 'reset' || $cmd == 'cls'){  
				if(strtoupper(substr(PHP_OS, 0, 3)) == 'WIN'){
					echo shell_exec("cls"); $cmd = '-v'; 
				}else{
					echo shell_exec("reset"); $cmd = '-v';
				}
			}
			$explode = explode(" ",$cmd);
			if(count($explode) >=2){
				$baseCmd = strtolower($explode[0]);
				if($baseCmd == 'rm' || $baseCmd == 'remove'){
					if(isset($explode[1]) && $explode[1]!=''){
						$whatAt = explode(":", $explode[1]);
						if(count($whatAt) == 2){
							$type = strtolower($whatAt[0]);
							$typeName = strtolower($whatAt[1]);
							$rm_api = NULL;
							if($type == 'api'){
								$rm_api  = (isset($explode[2]))?$explode[2]:NULL;
								$prompt  = (isset($explode[3]))?$explode[3]:NULL;
								if(is::$type($typeName,$rm_api,$prompt) != 1){
									#echo $type;
									echo clean_color(is::$type($typeName,$rm_api,$prompt));
									ob_get_flush();
									sh_cmd();
								}
							}else{
								$prompt  = (isset($explode[2]))?$explode[2]:NULL;
								if(is::$type($typeName,$prompt) != 1){
									echo clean_color(is::$type($typeName,$prompt));
									ob_get_flush();
									sh_cmd();
								}
							}
							
						}
					}
					
					ob_get_flush();
					ob_start();
					$message   =  "Are you sure want to remove permanently [y/N] :";
					print $message;
					flush();
					ob_flush();
					$confirmation  =  strtolower(trim( fgets( STDIN ) ));
					if ( $confirmation !== 'y' ) {
					   # Other keywords to exit
					   ob_get_flush();
					   sh_cmd();
					}else{
						echo shell_exec("php sh ".$cmd." y");
						ob_get_flush();
						sh_cmd();
					}				 
				
				}else if(isset($baseCmd) && ($baseCmd == 'push' || $baseCmd == 'pull')){ 
					echo $baseCmd." service only for remote sh \n";
					ob_get_flush();
					sh_cmd();
				}else if($baseCmd == 'remote' || $baseCmd == '-i'){
					$domain = strtolower($explode[1]);			
					$domain = rtrim($domain,"/");					
					$token = isset($explode[2])? $explode[2] : '';
					$tokenObj = json_encode(array("token"=>$token));
					$url = trim($domain."/service.php");
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$url);
					curl_setopt($ch, CURLOPT_POST, 1);
		            curl_setopt($ch, CURLOPT_POSTFIELDS,$tokenObj);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$status = curl_exec($ch);
					curl_close ($ch);
					if($status != ""){
						$auth = json_decode($status);				
						if(isset($auth,$auth->auth_key,$auth->auth_token)){ 
							if($auth->auth_key!="" && $auth->auth_token!=""){
								$key = $auth->auth_key; $token = $auth->auth_token;
								$url = $baseUrl = $url.'?key='.$key.'&token='.$token.'&cmd=';
								echo "Remote sh service connected successfuly.\nFor help enter -h\n";
								ob_get_flush();
								remote_sh_cmd($url);
							}else{
								echo "Sorry, your token is invalid. please check it\n";
								ob_get_flush();
								sh_cmd();
							}
						}else{
							if($status == 'sh'){
								echo "Security token is missing, Check CMD : remote url token.\n";
								ob_get_flush();
								sh_cmd();
							}else{
								echo "Sorry, could not find sh service.\n";
								ob_get_flush();
								sh_cmd();
							}
						}
					}else{
						echo "Sorry, could not find sh service.\n";
						ob_get_flush();
						sh_cmd();
					}
				}else{
					echo shell_exec("php sh ".$cmd);
					ob_get_flush();
					sh_cmd();
				}
		  }else{
			  echo shell_exec("php sh ".$cmd);
			  ob_get_flush();
			  sh_cmd();
		  }
			#$output = ob_get_contents();
			
		}
		sh_cmd();
}
function BAD_FORMAT(){
	return clean_color("\033[0;31msh-service bad format command.\033[0m \n");
}
function clean_color($str){ 
	 $codes = array("\033[0;32m", "\033[0m", "\033[0;31m","\033[0m","\033[1;33m","\033[0;37m","\033[0;33m","\033[1;33m","\033[43m");
	 $rcodes = array("","","","","","","","","");
	 if(strtoupper(substr(PHP_OS, 0, 3)) != 'LIN'){ 
	 	$str = str_replace($codes,$rcodes, $str);
	 } return $str;
}
function rrmdir($dir){
   if (is_dir($dir)) { 
     $objects = scandir($dir); 
     foreach ($objects as $object) { 
       if ($object != "." && $object != ".."){
         if (is_dir($dir."/".$object))
           rrmdir($dir."/".$object);
         else
           unlink($dir."/".$object); 
       } 
     }
     rmdir($dir); 
   } 
 }
