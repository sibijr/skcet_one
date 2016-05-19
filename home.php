<?php
require_once('core/init.php');
$user = new user();
if($user->data()->group == 4){
require_once('includes/header.php');
}else{
require_once('includes/nav_ad_tu.php');
}
?>

<?php
require_once('includes/footer.php');
?>