<?php
require_once('core/init.php');
$user = new user();

if(input::exists()){
			try{
					$dept = input::get('department');
					$user->update_admission('admission',$dept ,array(
						'OC' => input::get('OC'),
						'BC' => input::get('BC'),
						'MBC' => input::get('MBC'),
						'ST' => input::get('ST'),
						'SC' => input::get('SC'),
						'SCA' => input::get('SCA'),
						'BCM' => input::get('BCM')
						));
					session::flash('admission','admission table has been updated successfully!');
					redirect::to('admission.php');
			}catch(Exception $e){
				die($e->getMessage());
			}
	
}
?>


