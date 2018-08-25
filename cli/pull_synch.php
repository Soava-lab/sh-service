<?php
# CLI command remove
require_once 'db.php';
class pullSynch{
	protected function isExist($url) 
	{
	  # start curl
	  $ch = curl_init();
	  curl_setopt( $ch, CURLOPT_URL, $url.':isExist' );
	  # set return transfer to false
	  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
	  curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
	  # execute curl # 
	  $result = curl_exec( $ch );  
	  # close curl
	  curl_close( $ch );
	  return $result;
	}
	protected function download($url, $path) 
	{
	  # open file to write
	  $fp = fopen ($path, 'w+');
	  # start curl
	  $ch = curl_init();
	  curl_setopt( $ch, CURLOPT_URL, $url );
	  # set return transfer to false
	  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, false );
	  curl_setopt( $ch, CURLOPT_BINARYTRANSFER, true );
	  curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
	  # increase timeout to download big file
	  curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
	  # write data to local file
	  curl_setopt( $ch, CURLOPT_FILE, $fp );
	  # execute curl
	  curl_exec( $ch );
	  # close curl
	  curl_close( $ch );
	  # close local file
	  fclose( $fp );

	  if (filesize($path) > 0) return true;
	}
	protected function takeBackup($folder=NULL,$file=NULL){
		$backup = "backup/".date('d-m-Y')."/".$folder."/";
		if(!is_dir($backup)){
			$uold     = umask(0);
			mkdir($backup,0777,true);
			umask($uold);
		}
		if(!is_writable($backup)){
			$uold     = umask(0);
			chmod($backup,0777,true); 
			umask($uold);
		}
		if($folder != NULL && $file != NULL){
			$filename = $folder.'/'.$file;
			if(file_exists($filename)){
				copy($filename, $backup.time().'-'.$file);
			}
		}

	}
	public function controller($fileName,$dest=NULL,$url=NULL){ $msg=BAD_FORMAT(); $c_dir = 'controller'; $file = $c_dir.'/'.ucfirst($fileName.'.php');
		#echo $url;			
	  $path	 = $file;
	  if(is_dir($c_dir) && is_writable($c_dir)){
	  	 if(self::isExist($url) == 1){ self::takeBackup($c_dir,ucfirst($fileName.'.php'));
		  if (self::download($url, $path)){
		 	$msg = "\033[0;32m".ucfirst($c_dir).' '.ucfirst($fileName).' has been pulled '."\033[0m \nGo to ".$file." check the methods .\n";
		  }else{
		  	$msg = "\033[0;31mSorry,coult't pull ".$c_dir."  \033[0m \n";
		  }
		}else{
			$msg = "\033[0;31mSorry, ".$c_dir." ".ucfirst($fileName)." is not exist. \033[0m \n";
		}
	  }else{
	  	$msg = "\033[0;31mPermission denied. coult't write ".$c_dir."  \033[0m \n";
	  }
	  return $msg;
	}
	public function model($fileName,$dest=NULL,$url=NULL){ $msg=BAD_FORMAT(); $c_dir = 'model'; $file = $c_dir.'/'.ucfirst($fileName.'.php');
		#echo $url;			
	  $path	 = $file;
	  if(is_dir($c_dir) && is_writable($c_dir)){
	  	if(self::isExist($url) == 1){ self::takeBackup($c_dir,ucfirst($fileName.'.php'));
		  if (self::download($url, $path)){
		 	$msg = "\033[0;32m".ucfirst($c_dir).' '.ucfirst($fileName).' has been pulled '."\033[0m \nGo to ".$file." check the methods .\n";
		  }else{
		  	$msg = "\033[0;31mSorry,coult't pull ".$c_dir."  \033[0m \n";
		  }
		}else{
			$msg = "\033[0;31mSorry, ".$c_dir." ".ucfirst($fileName)." is not exist. \033[0m \n";
		}
	  }else{
	  	$msg = "\033[0;31mPermission denied. coult't write ".$c_dir."  \033[0m \n";
	  }
	  return $msg;
	}
	public function library($fileName,$dest=NULL,$url=NULL){ $msg=BAD_FORMAT(); $c_dir = 'library'; $file = $c_dir.'/'.ucfirst($fileName.'.php');
		#echo $url;			
	  $path	 = $file;
	  if(is_dir($c_dir) && is_writable($c_dir)){
	  	if(self::isExist($url) == 1){ self::takeBackup($c_dir,ucfirst($fileName.'.php'));
		  if (self::download($url, $path)){
		 	$msg = "\033[0;32m".ucfirst($c_dir).' '.ucfirst($fileName).' has been pulled '."\033[0m \nGo to ".$file." check the methods .\n";
		  }else{
		  	$msg = "\033[0;31mSorry,coult't pull ".$c_dir."  \033[0m \n";
		  }
		}else{
			$msg = "\033[0;31mSorry, ".$c_dir." ".ucfirst($fileName)." is not exist. \033[0m \n";
		}
	  }else{
	  	$msg = "\033[0;31mPermission denied. coult't write ".$c_dir."  \033[0m \n";
	  }
	  return $msg;
	}
	public function extender($fileName,$dest=NULL,$url=NULL){ $msg=BAD_FORMAT(); $c_dir = 'extender'; $file = $c_dir.'/'.ucfirst($fileName.'.php');
		#echo $url;			
	  $path	 = $file;
	  if(is_dir($c_dir) && is_writable($c_dir)){
	  	if(self::isExist($url) == 1){ self::takeBackup($c_dir,ucfirst($fileName.'.php'));
		  if (self::download($url, $path)){
		 	$msg = "\033[0;32m".ucfirst($c_dir).' '.ucfirst($fileName).' has been pulled '."\033[0m \nGo to ".$file." check the methods .\n";
		  }else{
		  	$msg = "\033[0;31mSorry,coult't pull ".$c_dir."  \033[0m \n";
		  }
		}else{
			$msg = "\033[0;31mSorry, ".$c_dir." ".ucfirst($fileName)." is not exist. \033[0m \n";
		}
	  }else{
	  	$msg = "\033[0;31mPermission denied. coult't write ".$c_dir."  \033[0m \n";
	  }
	  return $msg;
	}
	public function package($fileName,$dest=NULL,$url=NULL){ $msg=BAD_FORMAT(); $c_dir = 'package'; $file = $c_dir.'/'.ucfirst($fileName.'.php');
		#echo $url;			
	  $path	 = $file;
	  if(is_dir($c_dir) && is_writable($c_dir)){
	  	if(self::isExist($url) == 1){ self::takeBackup($c_dir,ucfirst($fileName.'.php'));
		  if (self::download($url, $path)){
		 	$msg = "\033[0;32m".ucfirst($c_dir).' '.ucfirst($fileName).' has been pulled '."\033[0m \nGo to ".$file." check the methods .\n";
		  }else{
		  	$msg = "\033[0;31mSorry,coult't pull ".$c_dir."  \033[0m \n";
		  }
		}else{
			$msg = "\033[0;31mSorry, ".$c_dir." ".ucfirst($fileName)." is not exist. \033[0m \n";
		}
	  }else{
	  	$msg = "\033[0;31mPermission denied. coult't write ".$c_dir."  \033[0m \n";
	  }
	  return $msg;
	}
	public function module($fileName,$dest=NULL,$url=NULL){ $msg=BAD_FORMAT(); $c_dir = 'modules'; $file = $c_dir.'/'.ucfirst($fileName.'.php');
		#echo $url;			
	  $path	 = $file;
	  if(is_dir($c_dir) && is_writable($c_dir)){
	  	if(self::isExist($url) == 1){ self::takeBackup($c_dir,ucfirst($fileName.'.php'));
		  if (self::download($url, $path)){
		 	$msg = "\033[0;32m".ucfirst($c_dir).' '.ucfirst($fileName).' has been pulled '."\033[0m \nGo to ".$file." check the methods .\n";
		  }else{
		  	$msg = "\033[0;31mSorry,coult't pull ".$c_dir."  \033[0m \n";
		  }
		}else{
			$msg = "\033[0;31mSorry, ".$c_dir." ".ucfirst($fileName)." is not exist. \033[0m \n";
		}
	  }else{
	  	$msg = "\033[0;31mPermission denied. coult't write ".$c_dir."  \033[0m \n";
	  }
	  return $msg;
	}
	public function api($fileName,$dest=NULL,$url=NULL){ $msg=BAD_FORMAT(); $c_dir = 'extender/init'; $file = $c_dir.'/'.ucfirst($fileName.'.php');
		#echo $url;			
	  $path	 = $file;
	  if(is_dir($c_dir) && is_writable($c_dir)){
	  	if(self::isExist($url) == 1){ self::takeBackup($c_dir,ucfirst($fileName.'.php'));
		  if (self::download($url, $path)){
		 	$msg = "\033[0;32m".ucfirst($c_dir).' '.ucfirst($fileName).' has been pulled '."\033[0m \nGo to ".$file." check the methods .\n";
		  }else{
		  	$msg = "\033[0;31mSorry,coult't pull ".$c_dir."  \033[0m \n";
		  }
		}else{
			$msg = "\033[0;31mSorry, ".$c_dir." ".ucfirst($fileName)." is not exist. \033[0m \n";
		}
	  }else{
	  	$msg = "\033[0;31mPermission denied. coult't write ".$c_dir."  \033[0m \n";
	  }
	  return $msg;
	}
}
