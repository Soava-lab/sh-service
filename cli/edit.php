<?php
# CLI command show 
class edit{
	public function controller($filename=NULL , $editor='nano'){ $msg=BAD_FORMAT(); $c_dir = 'controller'; $file = __DIR__.'/../'.$c_dir.'/'.ucfirst($filename).'.php';
		  //if(!is_dir($init_dir)) mkdir($init_dir,777);
		  require_once 'cli-terminal.php';
		  $colors = new Colors();
		  $msg = "\n";
		  if($filename!=NULL){
				if(is_dir($c_dir)){	
					if(file_exists($file) && is_writable($file) ){
						echo shell_exec("sudo ".$editor." ".$file." > `tty`");
						#system("sudo nano ".$file." > `tty`"); # Working Good
						#system("sudo nano > `tty`");

					}else{
						echo "File `".$file."` is not exist. \n";
					}
				}else{
						echo "Folder `".$c_dir."` is not exist. \n";
				}

		  }else{
		  	$msg = "\033[0;31m".ucfirst($c_dir)." ".$filename." does not exist in ".$c_dir."  \033[0m \n";
		  }		
		  return $msg;
	}
	public function model($filename=NULL , $editor='nano'){ $msg=BAD_FORMAT(); $c_dir = 'model'; $file = __DIR__.'/../'.$c_dir.'/'.ucfirst($filename).'.php';
		  //if(!is_dir($init_dir)) mkdir($init_dir,777);
		  require_once 'cli-terminal.php';
		  $colors = new Colors();
		  $msg = "\n";
		  if($filename!=NULL){
				if(is_dir($c_dir)){	
					if(file_exists($file) && is_writable($file) ){
						echo shell_exec("sudo ".$editor." ".$file." > `tty`");
						#system("sudo nano ".$file." > `tty`"); # Working Good
						#system("sudo nano > `tty`");

					}else{
						echo "File `".$file."` is not exist. \n";
					}
				}else{
						echo "Folder `".$c_dir."` is not exist. \n";
				}

		  }else{
		  	$msg = "\033[0;31m".ucfirst($c_dir)." ".$filename." does not exist in ".$c_dir."  \033[0m \n";
		  }		
		  return $msg;
	}
	public function html($filename=NULL , $editor='nano'){ $msg=BAD_FORMAT(); $c_dir = 'html'; $file = __DIR__.'/../'.$c_dir.'/'.$filename.'.php';
		  //if(!is_dir($init_dir)) mkdir($init_dir,777);
		  require_once 'cli-terminal.php';
		  $colors = new Colors();
		  $msg = "\n";
		  if($filename!=NULL){
				if(is_dir($c_dir)){	
					if(file_exists($file) && is_writable($file) ){
						echo shell_exec("sudo ".$editor." ".$file." > `tty`");
						#system("sudo nano ".$file." > `tty`"); # Working Good
						#system("sudo nano > `tty`");

					}else{
						echo "File `".$file."` is not exist. \n";
					}
				}else{
						echo "Folder `".$c_dir."` is not exist. \n";
				}

		  }else{
		  	$msg = "\033[0;31m".ucfirst($c_dir)." ".$filename." does not exist in ".$c_dir."  \033[0m \n";
		  }		
		  return $msg;
	}
	public function library($filename=NULL , $editor='nano'){ $msg=BAD_FORMAT(); $c_dir = 'library'; $file = __DIR__.'/../'.$c_dir.'/'.ucfirst($filename).'.php';
		  //if(!is_dir($init_dir)) mkdir($init_dir,777);
		  require_once 'cli-terminal.php';
		  $colors = new Colors();
		  $msg = "\n";
		  if($filename!=NULL){
				if(is_dir($c_dir)){	
					if(file_exists($file) && is_writable($file) ){
						echo shell_exec("sudo ".$editor." ".$file." > `tty`");
						#system("sudo nano ".$file." > `tty`"); # Working Good
						#system("sudo nano > `tty`");

					}else{
						echo "File `".$file."` is not exist. \n";
					}
				}else{
						echo "Folder `".$c_dir."` is not exist. \n";
				}

		  }else{
		  	$msg = "\033[0;31m".ucfirst($c_dir)." ".$filename." does not exist in ".$c_dir."  \033[0m \n";
		  }		
		  return $msg;
	}
	public function package($filename=NULL , $editor='nano'){ $msg=BAD_FORMAT(); $c_dir = 'package'; $file = __DIR__.'/../'.$c_dir.'/'.ucfirst($filename).'.php';
		  //if(!is_dir($init_dir)) mkdir($init_dir,777);
		  require_once 'cli-terminal.php';
		  $colors = new Colors();
		  $msg = "\n";
		  if($filename!=NULL){
				if(is_dir($c_dir)){	
					if(file_exists($file) && is_writable($file) ){
						echo shell_exec("sudo ".$editor." ".$file." > `tty`");
						#system("sudo nano ".$file." > `tty`"); # Working Good
						#system("sudo nano > `tty`");

					}else{
						echo "File `".$file."` is not exist. \n";
					}
				}else{
						echo "Folder `".$c_dir."` is not exist. \n";
				}

		  }else{
		  	$msg = "\033[0;31m".ucfirst($c_dir)." ".$filename." does not exist in ".$c_dir."  \033[0m \n";
		  }		
		  return $msg;
	}
	public function extender($filename=NULL , $editor='nano'){ $msg=BAD_FORMAT(); $c_dir = 'extender'; $file = __DIR__.'/../'.$c_dir.'/'.ucfirst($filename).'.php';
		  //if(!is_dir($init_dir)) mkdir($init_dir,777);
		  require_once 'cli-terminal.php';
		  $colors = new Colors();
		  $msg = "\n";
		  if($filename!=NULL){
				if(is_dir($c_dir)){	
					if(file_exists($file) && is_writable($file) ){
						echo shell_exec("sudo ".$editor." ".$file." > `tty`");
						#system("sudo nano ".$file." > `tty`"); # Working Good
						#system("sudo nano > `tty`");

					}else{
						echo "File `".$file."` is not exist. \n";
					}
				}else{
						echo "Folder `".$c_dir."` is not exist. \n";
				}

		  }else{
		  	$msg = "\033[0;31m".ucfirst($c_dir)." ".$filename." does not exist in ".$c_dir."  \033[0m \n";
		  }		
		  return $msg;
	}
	
	public function api($filename=NULL , $editor='nano'){ $msg=BAD_FORMAT(); $c_dir = 'extender/init'; $file = __DIR__.'/../'.$c_dir.'/'.$filename.'.php';
		  //if(!is_dir($init_dir)) mkdir($init_dir,777);
		  require_once 'cli-terminal.php';
		  $colors = new Colors();
		  $msg = "\n";
		  if($filename!=NULL){
				if(is_dir($c_dir)){	
					if(file_exists($file) && is_writable($file) ){
						echo shell_exec("sudo ".$editor." ".$file." > `tty`");
						#system("sudo nano ".$file." > `tty`"); # Working Good
						#system("sudo nano > `tty`");

					}else{
						echo "File `".$file."` is not exist. \n";
					}
				}else{
						echo "Folder `".$c_dir."` is not exist. \n";
				}

		  }else{
		  	$msg = "\033[0;31m Module ".$filename." does not exist in ".$c_dir."  \033[0m \n";
		  }		
		  return $msg;
	}

	public function module($filename=NULL , $editor='nano'){ $msg=BAD_FORMAT(); $c_dir = 'modules'; $file = __DIR__.'/../'.$c_dir.'/'.$filename.'.php';
		  //if(!is_dir($init_dir)) mkdir($init_dir,777);
		  require_once 'cli-terminal.php';
		  $colors = new Colors();
		  $msg = "\n";
		  if($filename!=NULL){
				if(is_dir($c_dir)){	
					if(file_exists($file) && is_writable($file) ){
						echo shell_exec("sudo ".$editor." ".$file." > `tty`");
						#system("sudo nano ".$file." > `tty`"); # Working Good
						#system("sudo nano > `tty`");

					}else{
						echo "File `".$file."` is not exist. \n";
					}
				}else{
						echo "Folder `".$c_dir."` is not exist. \n";
				}

		  }else{
		  	$msg = "\033[0;31m Module ".$filename." does not exist in ".$c_dir."  \033[0m \n";
		  }		
		  return $msg;
	}

}
