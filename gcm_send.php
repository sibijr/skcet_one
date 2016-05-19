<?php
require_once 'core/init.php';
if(input::exists()){
$gcm=new GCM();
$regid=input::get('regid');
$message=input::get('message');
echo $message;
$registatoin_ids = array($regid);
$message = array("price"=>$message);
$result = $gcm->send_notification($registatoin_ids,$message);
echo $result;
}
?>