<?php
require_once 'core/init.php';	
$result=new result_process();
$result->add_result_using_excel_sheet($_FILES['fileToUpload']['tmp_name']);
?>
