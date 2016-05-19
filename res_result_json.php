<style>
#cen{
   text-align: center;   
}
</style>
<?php
require_once('core/init.php');
require_once('core/boot.php');

$admin = new admin();
if(input::exists()){
$reg = input::get('id');
$result = $admin->get_result($reg);
$result = $admin->data();
if(isset($result)){
echo json_encode($result);
}else{
echo 'error fetching result';
}
}
?>