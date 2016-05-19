<?php
session_start();

$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => 'localhost',
		'username' => 'root',
		'password' => '',
		'db' => 'skcet_one'  
		),
	'remember' => array(
		'cookie_name' => 'hash',
		'cookie_expiry'=> 604800
		 ),
	'session' => array(
		'session_name' => 'user',
		'token_name' => 'token'
		)

 );

spl_autoload_register(function($class){
	require_once 'classes/' .$class.'.php';
});


require_once 'functions/sanitize.php';
if(cookies::exists(config::get('remember/cookie_name')) && !session::exists(config::get('session/session_name'))){
	$hash = cookies::get(config::get('remember/cookie_name'));
	$hashcheck = DB::getInstance()->get('user_sessions',array('hash', '=',$hash));

	if($hashcheck->count()){
		$user = new user($hashcheck->first()->user_id);
		$user->login();
	}


}
?>