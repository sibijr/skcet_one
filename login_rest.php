<?php
require_once('core/init.php');
$result['default']="hello";
if(input::exists()){
	
$user =new user();	
$login = $user->login_response(input::get('username'),input::get('password'));
$data = $user->find_response($login);
//$data is in stdclass ....if u want to change to assoc means change get to get_assoc in db class!!
if(!empty($data)){
	$result['error']=0;
$result['regno']=input::get('username');
}
else{
	$result['error']=1;
	$result['error_msg']="Login Failed";
}

echo json_encode($result);
}
?>
<!-- machan delete this da... just for chcking.. -->
<form action ="" method ="post">
<input type = "text" name="username"/><br><br>
<input type = "password" name="password"/><br><br>
<input type = "submit" />
</form>