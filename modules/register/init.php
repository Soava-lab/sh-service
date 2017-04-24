<?php
if(!defined("SHA")) die("Access denied!");
Http::get('/dashboard',function($app,$req){
	if($req->session->get('is_login')){
		$json = Curl::get('/api/user/'.$req->session->get('user_id'));
		echo 'Welcome '.$json->body[0]->username.' <a href="./logout">Logout</a>';
	}else{
		header("location:./login");
	}

});
Http::get('/logout',function($app,$req){
	$req->session->delete('is_login');
	header("location:./login");
});

Http::get('/signup',function($app){
	$app->db->query("CREATE TABLE IF NOT EXISTS `users`(
 `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
 `first_name` varchar(100) DEFAULT NULL,
 `last_name` varchar(100) DEFAULT NULL,
 `username` varchar(250) DEFAULT NULL,
 `phone` varchar(50) DEFAULT NULL,
 `email` varchar(100) DEFAULT NULL,
 `password` varchar(350) DEFAULT NULL,
 `dob` date DEFAULT NULL,
 `address` varchar(500) DEFAULT NULL,
 `status` tinyint(4) DEFAULT NULL COMMENT '{0=>inactive,1=>active}',
 `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`user_id`),
 KEY `first_name` (`first_name`),
 KEY `last_name` (`last_name`),
 KEY `username` (`username`),
 KEY `phone` (`phone`),
 KEY `email` (`email`),
 KEY `address` (`address`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1");
	$app->html('../modules/register/html/signup');
});
Http::page('/login',function($app,$req){ $msg = 'Please fill out required fields.';
	if($req->post('username')!='' && $req->post('password')!=''){
		$query = $app->db->get_where("users",array("username"=>$req->post('username'),"password"=>$req->post('password')));
		if($query->num_rows() > 0){
			$fet = $query->row();
			$req->session->set("is_login",true);
			$req->session->set("user_id",$fet->user_id);
			header("location:./dashboard");
		}else{
			$msg = "Invalid login credential.";
		}
		echo $app->json($msg);
	}
	$app->html('../modules/register/html/login');
});
# API
Http::post('/signup',function($app,$req){ $msg = 'Please fill out required fields.';

	 if($req->post() && trim($req->post('email'))!='' && trim($req->post('password'))!=''){
	 	unset($_POST['doSubmit']);
	 	$app->db->insert("users",$req->post());
	 	if($app->db->insert_id()!=''){
	 		$msg = "Form Registration  has been done.";
	 	}
	 }else{ # Third party
	 	$body = $app->body();
	 	if(count($body) > 0){
		 	$app->db->insert("users",$body);
		 	if($app->db->insert_id()!=''){
		 		$msg = "Json Registration has been done.";
		 	}
	 	}
	   
	 }
	echo $app->json($msg);
});
Http::get('/api/users',function($app){
	$query = $app->db->get("users");
	$app->json($query->result());
});
Http::get('/api/user/(int):id',function($app,$req){
	$query = $app->db->get_where("users",array("user_id"=>$req->id));
	$app->json($query->result());
});

/*{
"first_name" : "demo",
"last_name" : "demo",
"username" : "demo",
"email" : "demo@gmail.com",
"phone" : "9878327482",
"address" : "demo"
}*/