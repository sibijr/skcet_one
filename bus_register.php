<?php

	require_once 'core/init.php';	
	if(input::exists()){
		if(token::check(input::get('token'))){
		$validate = new validate();
		$validation = $validate->check($_POST, array(
			'username' => array(
				'required' => true,
				'min' => 2,
				'max' => 20,
				'unique' => 'users'
			),
			'password' => array(
				'required' => true,
				'min' => 6
				),
			'password_again' => array(
				'required' => true,
				'match' => 'password'
				),
			'name' => array(
				'required' => true,
				'min' => 2,
				'max' => 50
				) 
		));

		if($validation->passed()){
			$user = new user();
			$salt = hash::salt(32);
			try{
					
						$username = input::get('username');
						$password = hash::make(input::get('password'),$salt);
						$name = input::get('name');
						$joined = date('Y-m-d H:i:s');
						$group = input::get('group');
						$number = input::get('number');
						$db = DB::getInstance();
						if($db->query("insert into user (`username`,`password`) values('".$username."','".$password."');")){
							echo "ok";
						}
						
					session::flash('home','your registeration is successful! ur are free to login!');
					redirect::to('index.php');
			}catch(Exception $e){
				die($e->getMessage());
			}
		}else{
			foreach ($validation->error() as $error) {
					echo $error,'<br>';
				}	
		}
	}
	}   

	
	
?>

<h3>Bus registeration</h3>
<form action="" method = "post">
	<div class= "field">
		<label for="username">Username</label>
		<input type ="text" name = "username" id = "username" value ="" autocomplete = "off"/>
	</div>
	<br>
	<div class= "field">
		<label for="password">Choose a password</label>
		<input type ="password" name = "password" id = "password"/>
	</div>
	<br>
	<div class= "field">
		<label for="password_again">Conform password</label>
		<input type ="password" name = "password_again" id = "password_again"/>
	</div>
	<br>
	<div class= "field">
		<label for="name">Bus No</label>
		<input type ="text" name = "name" value = "<?php echo escape(input::get('name'));  ?>" id = "name"/>
	</div>
	<br>
		<div class= "field">
		<label for="name">Phone number</label>
		<input type ="text" name = "number" value = "<?php echo escape(input::get('number'));  ?>" id = "name"/>
	</div>

	<div class= "field">
		<input type="hidden" name="group" value="9" />
	</div>
	
	
	<input type="hidden" name = "token" value="<?php  echo token::generate(); ?>" >
	<input type="submit" value ="Register">
</form>