<?php
require_once 'core/init.php';	
	$user = new user();
			$db=DB::getInstance();
			$result=$db->get_assoc("users",array("id","=",58));
			$result=$result->first();
			$response['lat']=$result['lat'];
			$response['lon']=$result['lon'];
			echo json_encode($response);
?>
