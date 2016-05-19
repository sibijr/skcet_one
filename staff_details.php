<?php
require_once('core/init.php');
require_once('core/boot.php');
$admin = new admin();
if(input::exists()){
$db = DB::getInstance();
$dept = input::get('department');
$grp1 = '8';
$result = $db->query_assoc("select name,number,email from users where `department` = '$dept' and `group` = '5';");
$result = $result->results();
print_r($result);
if(isset($result)){
echo json_encode($result);
}else{
echo 'error fetching result';
}
}
?>
