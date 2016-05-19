<?php
require_once 'core/init.php';
require_once('includes/nav_ad_tu.php');

$user = new user(); 

if(!$username = input::get('user')){
	redirect::to('index.php');
}else{
	$user = new user($username);
	if(!$user->exists()){
		redirect::to(404);
	}else{
		$data = $user->data();
	}
?>
<h3><?php echo escape($data->username); ?></h3>


<p>Full name : <?php echo escape($data->name); ?></p>
<p>Department : <?php echo escape($data->department); ?></p>
<p>Year : <?php echo escape($data->year); ?></p>
<p>Section : <?php echo escape($data->section); ?></p>
<p>Number : <?php echo escape($data->number); ?></p>
<br>
<img border="0" src=
<?php 

if($data->pro_pic !== "")
	{
		echo '"'. $data->pro_pic . '"';
	}else{
		echo 'profile_pics\default.jpg';
	}
?> width="102"  height="91">

<?php
}
require_once('includes/footer.php');
?>
