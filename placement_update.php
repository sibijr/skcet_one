<?php
require_once('core/init.php');
$user = new user();
/*
if(!$user->isLoggedIn()){
	redirect::to('index.php');
} 
*/
			try{
					$dept = input::get('department'); 
					echo input::get('unique');
					$user->update_admission
					('placement',$dept ,array(
						'eligible' => input::get('eligible'),
						'percent' => input::get('percentage'),
						'uniq' => input::get('unique'),
						'category' => input::get('category')
						));
					/*
					$user->update_placement($dept, array(
						'eligible' => input::get('eligible'),
						'unique' => input::get('unique'),
						
						
						)); */
					session::flash('placement','placement table has been updated successfully!');
					redirect::to('placement.php');
			}catch(Exception $e){
				die($e->getMessage());
			}
?>
