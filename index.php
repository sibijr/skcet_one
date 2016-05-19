<?php
require_once 'core/init.php';

$user = new user();

if(session::exists('home')){
	echo session::flash('home');
}

$data = $user->data();
	$uploadDir = 'profile_pics/';

		if(isset($_POST['Submit']))
		{
		$fileName = $_FILES['Photo']['name'];
		$tmpName  = $_FILES['Photo']['tmp_name'];
		$fileSize = $_FILES['Photo']['size'];
		$fileType = $_FILES['Photo']['type'];

		$userfile_extn = substr($fileName, strrpos($fileName, '.')+1);
		$userfile_extn = '.' . $userfile_extn;
		$filePath = $uploadDir . $data->username . $userfile_extn;

		if(file_exists($filePath))
		 { 
		 	unlink ($filePath); 
		 }

		$result = move_uploaded_file($tmpName, $filePath);
		if (!$result) {
		echo "Error uploading file";
		exit;
		}                                           

		if(!get_magic_quotes_gpc())
		{
		    $fileName = addslashes($fileName);
			$filePath = addslashes($filePath);
		}

		$user->update(array(
			'pro_pic' => $filePath
			));

		}
if($user->isLoggedIn()){
require_once('includes/nav_ad_tu.php');
?>
<p>Hello <a href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?>!</a></p>
<br>

<img border="0" src=
<?php 

if($data->pro_pic !== "")
	{
		echo '"'. $data->pro_pic . '"';
	}else{
		echo 'profile_pics/default.jpg';
	}
?> width="102"  height="91">
<br><br>
<form name="Image" enctype="multipart/form-data" action="" method="POST">
<input type="file" name="Photo" size="2000000" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" size="26">
<INPUT type="submit" class="button" name="Submit" value="  Submit  "> 
&nbsp;&nbsp;<INPUT type="reset" class="button" value="Cancel">
</form>

<a href="change_password.php">Change password!</a><br>
<a href="update.php">Update details!</a><br>
<a href="logout.php">Log out!</a>
<?php
	
}else{
	require_once('includes/navbar.php');
	echo "<br><br>";
	echo '<p>You need to <a href="login.php">Log in</a>  or <a href="register.php">Register</a></p>';
}

require_once('includes/footer.php');
?>