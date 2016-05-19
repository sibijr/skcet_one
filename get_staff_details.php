<?php
require_once 'core/init.php';

if(input::exists()){

$dept = input::get('department');
$db = DB::getInstance();
$result = $db->query_assoc("select * from users where `department`= '$dept' and `group` = 5 or `group`= 8");
$result = $result->results();
echo json_encode($result);
}


?>