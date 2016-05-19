<?php
require_once('core/init.php');

$admin = new admin();
if(input::exists()){
$table = input::get('table');
$result = $admin->get_date($table);
$result = $admin->data();
if(isset($result)){

echo $result['time'];
}else{
echo 'error fetching result';
}

}
?>
<form action="" method="post">
enter the table name:
<input type="text" name="table" />
<input type="submit" />	
</form>