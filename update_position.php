<?php

	require_once 'core/init.php';	
	if(input::exists()){
		
			$user = new user();
			$db=DB::getInstance();
			$lat=input::get('lat');
			$lon=input::get('lon');
			try{
			$user->update(array('lat'=>$lat),58);
			$user->update(array('lon'=>$lon),58);
		}catch(Exception $e){
			die($e->getMessage());
		}		
		}   
?>