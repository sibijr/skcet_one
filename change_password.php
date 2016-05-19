<?php
require_once 'core/init.php';

$user = new user();

if(!$user->isLoggedIn()){
	redirect::to('index.php');
} 

if(input::exists()){
	if(token::check(input::get('token'))){
		$validate = new validate();
		$validation = $validate->check($_POST,array(
			'password_current' => array(
				'required' => true,
				'min' => 6
				),
			'password_new' => array(
				'required' => true,
				'min' => 6
				),
			'password_new_again' => array(
				'required' => true,
				'min' => 6,
				'matches' => 'password_new'
				)
			));

		if($validation->passed()){
			if(hash::make(input::get('password_current'),$user->data()->salt) !== $user->data()->password){
				echo 'Your current password is wrong!';
			}else{
			$salt = hash::salt(32);
			$user->update(array(
				'password' => hash::make(input::get('password_new'),$salt),
				'salt' => $salt
				));
			session::flash('home','Your password has been changed!');
			redirect::to('index.php');
			}


		}else{
			foreach($validation->errors() as $error){
				echo $error,'<br>';
			}
		}


	}
}

?>


<form action="" method = "post">
<div class ="field">
	<label for="password">Current password</label>
	<input type="password" name="password_current" id="password" autocomplete="off">
</div>
<br>
<div class ="field">
	<label for="password">New password</label>
	<input type="password" name="password_new" id="password" autocomplete="off">
</div>
<br>
<div class ="field">
	<label for="password">New password again</label>
	<input type="password" name="password_new_again" id="password" autocomplete="off">
</div>
<br>
<input type= "hidden"  name="token" value = "<?php echo token::generate();?>">
<br>
<input type = "submit" value = "Change">
</form>