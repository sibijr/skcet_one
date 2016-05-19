<?php

require_once('core/init.php');
$user = new user();
if(!$user->isLoggedIn()){
	redirect::to('index.php');
}


?>