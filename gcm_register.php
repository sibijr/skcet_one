<?php
require_once 'core/init.php';
$db=DB::getInstance(); 
if(input::exists())
{
$gcm_id=input::get('gcm_id');
$reg_no=input::get('reg_no');
$db->update_regno('users',$reg_no,array('gcm_id'=>$gcm_id));	
echo "success";
}
?>