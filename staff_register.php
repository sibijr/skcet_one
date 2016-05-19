<?php

	require_once 'core/init.php';
require_once('includes/navbar.php');	
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
						$db = DB::getInstance();
						$salt = hash::salt(32);
/*					
					$username= input::get('username');
						$password = hash::make(input::get('password'),$salt);
						$salt = $salt;
						$name = input::get('name');
						$reg_no = input::get('reg_no');
						$group = 5;
						$number = input::get('number');
						$department = input::get('department');
						$batch = input::get('batch');
						$year = input::get('year');
						$section = input::get('section');
						echo "insert into users (`username`,`password`,`salt`,`name`,`reg_no`,`joined`,`group`,`number`,`department`,`batch`,`year`,`section`) values ('$username','$password','$salt','$name','$reg_no','$joined','$group','$number','$department','$batch','$year','$section');";
			*/
			try{
					//if($db->query_assoc("insert into users (`username`,`password`,`salt`,`name`,`reg_no`,`group`,`number`,`department`,`batch`,`year`,`section`) values ('$username','$password','$salt','$name','$reg_no','$group','$number','$department','$batch','$year','$section');")){
					//session::flash('home','your registeration is successful! ur are free to login!');
					//redirect::to('index.php');	
					//}else{
						//echo "error";
					//}
					
					$user->create(array(
						'username' => input::get('username'),
						'password' => hash::make(input::get('password'),$salt),
						'salt' => $salt,
						'name' => input::get('name'),
						'reg_no' => input::get('reg_no'),
						'joined' => date('Y-m-d H:i:s'),
						'group' => 5,
						'number' => input::get('number'),
						'department' => input::get('department'),
						'batch' => input::get('batch'),
						'year' => input::get('year'),
						'section' => input::get('section'),
						'email' => input::get('email')
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

<h3>Adviser/tutor register</h3>
<form action="" method = "post">
	<div class= "field">
		<label for="username">Username</label>
		<input type ="text" name = "username" id = "username" value ="" autocomplete = "off"/>
	</div>
	<br>
	<div class= "field">
		<label for="reg_no">Staff ID</label>
		<input type ="text" name = "reg_no" />
	</div>
	<br>
	<div class= "field">
		<label for="password">Choose a password</label>
		<input type ="password" name = "password" />
	</div>
	<br>
	<div class= "field">
		<label for="password_again">Conform password</label>
		<input type ="password" name = "password_again" />
	</div>
	<br>
	<div class= "field">
		<label for="name">Choose a name</label>
		<input type ="text" name = "name" value = "<?php echo escape(input::get('name'));  ?>" />
	</div>
	<br>
		<div class= "field">
		<label for="name">number</label>
		<input type ="text" name = "number" value = "<?php echo escape(input::get('number'));  ?>" />
	</div>
	<br>
	<div class= "field">
		<label for="name">department</label>
		<input type ="text" name = "department" value = "<?php echo escape(input::get('department'));  ?>"/>
	</div>

	<div class= "field">
		<label for="name">Batch</label>
		<input type ="text" name = "batch" value = "<?php echo escape(input::get('batch'));  ?>" />
	</div>
	<br>
		<div class= "field">
		<label for="name">year of your class</label>
		<input type ="text" name = "year" value = "<?php echo escape(input::get('year'));  ?>" />
	</div>
	<br>
		<div class= "field">
		<label for="name">Section</label>
		<input type ="text" name = "section" value = "<?php echo escape(input::get('section'));  ?>" />
	</div>
	<br>
			<div class= "field">
		<label for="name">Email</label>
		<input type ="text" name = "email" value = "<?php echo escape(input::get('email'));  ?>" />
	</div>
	<br>

	<div class= "field">
		<label for="name">Group</label>
		<select name = "group">
		<option value = "5">Adviser</option>
		<option value = "8">oly staff</option>
		</select>
	</div>
	
	
	<input type="hidden" name = "token" value="<?php  echo token::generate(); ?>" >
	<input type="submit" value ="Register">
</form>

<?php
//require_once('includes/footer.php');
?>