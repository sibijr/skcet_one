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
					$user->create(array(
						'username' => input::get('username'),
						'password' => hash::make(input::get('password'),$salt),
						'salt' => $salt,
						'name' => input::get('name'),
						'reg_no' => input::get('reg_no'),
						'roll_no' => input::get('roll_no'),
						'year' => input::get('year'),
						'section' => input::get('section'),
						'batch' => input::get('batch'),
						'department' => input::get('department'),  
						'group' => 1
						));
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


<form action="" method = "post">
	<div class= "field">
		<label for="username">Username</label>
		<input type ="text" name = "username" id = "username" value ="" autocomplete = "off"/>
	</div>
	
	<br>
	<div class= "field">
		<label for="year">Year</label>
		<input type ="text" name = "year" id = "year"/>
	</div>
	<br>
	<div class= "field">
		<label for="year">department</label>
		<input type ="text" name = "department" id = "year"/>
	</div>
	<br>
	<div class= "field">
		<label for="section">Section</label>
		<input type ="text" name = "section" id = "section"/>
	</div>
	<br>
	<div class= "field">
		<label for="password">Roll no</label>
		<input type ="text" name = "roll_no" id = "roll_no"/>
	</div>
	<br>
	<div class= "field">
		<label for="reg_no">Register no</label>
		<input type ="text" name = "reg_no" id = "reg_no"/>
	</div>
	<br>
	<div class= "field">
		<label for="reg_no"> Batch</label>
		<input type ="text" name = "batch" id = "reg_no"/>
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
		<label for="name">Choose a name</label>
		<input type ="text" name = "name" value = "<?php echo escape(input::get('name'));  ?>" id = "name"/>
	</div>
	<br>
	<input type="hidden" name = "token" value="<?php  echo token::generate(); ?>" >
	<input type="submit" value ="Register">
</form>