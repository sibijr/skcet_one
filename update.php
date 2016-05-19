<?php
require_once 'core/init.php';
require_once('includes/nav_ad_tu.php');
$user = new user();

if(!$user->isLoggedIn()){
	redirect::to('index.php');
}

if(input::exists()){
	if(token::check(input::get('token'))){

	$validate = new validate();
	$validation = $validate->check($_POST,array(
		'name' => array(
			'required' => true,
			'min' => 2,
			'max' => 50
			)
		));
	if($validation->passed()){

		try{
			$user->update(array(
				'name' => input::get('name'),
				'department' => input::get('department'),
				'batch' => input::get('batch'),
				'section' => input::get('section'),
				'email' => input::get('email')
				));
			session::flash('home','your details have been updated');
			redirect::to('index.php');
		}catch(Exception $e){
			die($e->getMessage());
		}

	}else{
		foreach ($validation->errors() as $error) {
			echo $error, '<br>';
		}
	}

	}


}

?>


<form action = "" method="post">

	<div class = "field">
		<label for="name">Name</label>
		<input type = "text" name = "name" value = "<?php echo escape($user->data()->name); ?>" ><br><br>
				<label for="name">Department</label>
		<input type = "text" name = "department" value = "<?php echo escape($user->data()->department); ?>" ><br><br>
				<label for="name">Batch</label>
		<input type = "text" name = "batch" value = "<?php echo escape($user->data()->batch); ?>" ><br><br>
		<label for="name">section</label>
		<input type = "text" name = "section" value = "<?php echo escape($user->data()->section); ?>" ><br><br>
		<label for="name">email</label>
		<input type = "text" name = "email" value = "<?php echo escape($user->data()->email); ?>" ><br><br>
		<input type = "submit" value = "update">
		<input type = "hidden" name = "token" value = "<?php echo token::generate(); ?>" >
	</div>

<form>


<?php
require_once('includes/footer.php');
?>