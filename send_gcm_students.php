<?php
require_once 'core/init.php';

if(input::exists()){
				
				
						$gcm=new GCM();
						echo $messages = input::get('message');
						
						foreach($_POST['gcm_id'] as $id){
						$id = array($id);
						$message = array("price"=>$messages);
						$result = $gcm->send_notification($id,$message);
						}
							

}
?>