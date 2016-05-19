<?php
require_once 'core/init.php';	
$admin=new admin_process();
$admin->add_user_using_excel_sheet($_FILES['fileToUpload']['tmp_name']);
?>