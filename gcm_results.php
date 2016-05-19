
        <?php
        include_once 'core/init.php';
		$admin_result = new admin_process();
		
		echo $admin_result->result_via_gcm('131031128',array('id' =>3));
		
		
       