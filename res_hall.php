<style>

#tab{
border-style: solid;
border-color: #98bf21;
}

</style>

<?php
require_once('core/init.php');
require_once('core/boot.php');
$admin = new admin();
if(input::exists()){
$reg = input::get('id');
$result = $admin->get_hall($reg);
$result = $admin->data();
if(isset($result)){

echo"
<header><center><h3>HALL ALLOTMENT</h3></center></header>

<div  id =\" tab\">
<table id=\"\" class=\"table table-striped\"  >
<tr>
<td>Hall number:</td>
<td>".$result['hall_no']."</td>
</tr>
<tr>
<table>
</div>
";
}else{
echo 'error fetching result';
}

}
?>