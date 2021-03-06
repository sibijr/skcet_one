<?php
require_once 'core/init.php';

$user = new user();

if(session::exists('home')){
	echo session::flash('home');
}

?>
 <html>

    <head>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Include roboto.css to use the Roboto web font, material.css to include the theme and ripples.css to style the ripple effect -->
        <link href="css/roboto.min.css" rel="stylesheet">
        <link href="css/material.css" rel="stylesheet">
        <link href="css/ripples.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        

    </head>

    <body>
        <header class="container-fluid header shadow-z-2">
            <div class="row">
                <div class="col-sm-12 text-center">
                <h1 class="">Sri Krishna College of Engineering &amp; Technology</h1>
                <h3>adviser / tutor control Panel</h3>
                </div>
            </div>
            
        </header>
<div class="navbar navbar-default shadow-z-2" style="margin-bottom:0;">
    <div class="navbar-header ">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="javascript:void(0)">SKCET ONE</a>
    </div>
    <div class="navbar-collapse collapse navbar-responsive-collapse">
        <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
			<li ><a href="profile.php?user=<?php echo $user->data()->username; ?>">Profile</a></li>
			<li ><a href="update.php">Settings</a></li>
			<?php
			$user = new user();
			if($user->data()->group == 5 || $user->data()->group == 7){
			?>
			<li><a href="student_adviser.php">My students</a></li>
			<?php
			}
			if($user->data()->group == 6 || $user->data()->group == 7){
			?>
			<li><a href="student_tutor.php">My students (tutor)</a></li>
            <?php
			}
			?>
        </ul>
        
        <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</div>
