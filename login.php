<?php
require_once('core/init.php');
require_once('includes/navbar.php');
$user = new user();

if($user->isLoggedIn()){
	redirect::to('index.php');
} 

if(input::exists()){
	if(token::check(input::get('token'))){
		$validate = new validate();
		$validation = $validate->check($_POST,array(
			'username' =>  array('required' => true),
			'password' =>  array('required' => true)
			));

		if($validation->passed()){
			$user = new user();
			$remember = (input::get('remember') === 'on') ? true : false; 
			$login = $user->login(input::get('username'),input::get('password'),$remember); 
			if($login){
				echo 'success';
				redirect::to('index.php');
			}else{
				echo '<p>Sorry, loggin failed!</p>';
			}
		}else{
			foreach ($validation->error() as $error) {
				echo '<p>'. $error .'</p>';
			}
		}
	}
}

?>
<div class="container-fluid">
<div class="row">
<div id="form" class="col-md-6 col-md-offset-3 shadow-z-2" style="margin-top:50px;">
<form action ="" method = "post">
<legend class="text-center">Login</legend>

<div class="form-group">
<label for="username" class="col-md-2 control-label">Username</label>
<div class="col-md-10">
<input type="text" class="form-control" name="username" id="username" placeholder="Username">
</div>
</div>
<div class="form-group">
<label for="password" class="col-md-2 control-label">Password</label>
<div class="col-md-10">
<input type="password" class="form-control" name="password" id="password" placeholder="Password">
</div>
</div>
<input type= "hidden"  name="token" value = "<?php echo token::generate();?>">

<div class="col-md-4 col-md-offset-4">
<input type="submit"  class="btn btn-primary btn-block" value = "Log in">
</div>
</form>
</div>
</div>
</div>
<?php
require_once('includes/footer.php');
?>
</body>
</html>