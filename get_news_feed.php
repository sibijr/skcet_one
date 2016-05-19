<?php
require_once 'core/init.php';

if(input::exists()){
$num = input::get('page');
$db = DB::getInstance();
$result = $db->query_assoc("select * from news_feed limit $num,5");
$result = $result->results();
echo json_encode($result);
}


?>