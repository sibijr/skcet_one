<style>
#cen{
   text-align: center;   
}
</style>
<?php
require_once('core/init.php');
require_once('core/boot.php');

$admin = new admin();
if(input::exists()){
$reg = input::get('id');
$result = $admin->get_result($reg);
$result = $admin->data();
if(isset($result)){

echo"
<header><center><h3>RESULT</h3></center></header>
<div class=\"container\">
<table class=\"table\" id=\"cen\" >
<tr>
<td>NAME: ".$result['name_of_student']."</td>
<td>DEPT: ".$result['department']."</td>
</tr>

<tr>
<td>SEM: ".$result['sem']."</td>
<td>BATCH: ".$result['batch']."</td>
</tr>

</table>
</div>

<div  id =\" tab\">
<table id=\"\" class=\"table table-striped\"  >
<tr>
<th>SUBJECT</th>
<th>SUBJECT CODE </th>
<th>GRADE</th>
</tr>


<tr>
<td>".$result['sub_name_1'] ."</td>
<td>".$result['sub_code_1']." </td>
<td>".$result['sub_grade_1']."</td>
</tr>
<tr>
<td>".$result['sub_name_2'] ."</td>
<td>". $result['sub_code_2']."</td>
<td>".$result['sub_grade_2']."</td>
</tr>
<tr>
<td>".$result['sub_name_3'] ."</td>
<td>". $result['sub_code_3']."</td>
<td>".$result['sub_grade_3']."</td>
</tr>
<tr>
<td>".$result['sub_name_4'] ."</td>
<td>". $result['sub_code_4']."</td>
<td>".$result['sub_grade_4']."</td>
</tr>
<tr>
<td>".$result['sub_name_5'] ."</td>
<td>". $result['sub_code_5']."</td>
<td>".$result['sub_grade_5']."</td>
</tr>
<tr>
<td>".$result['sub_name_6'] ."</td>
<td>". $result['sub_code_6']."</td>
<td>".$result['sub_grade_6']."</td>
</tr>
<tr>
<td>".$result['sub_name_7'] ."</td>
<td>". $result['sub_code_7']."</td>
<td>".$result['sub_grade_7']."</td>
</tr>
<tr>
<td>".$result['sub_name_8'] ."</td>
<td>". $result['sub_code_8']."</td>
<td>".$result['sub_grade_8']."</td>
</tr>
<tr>
<td>".$result['sub_name_9'] ."</td>
<td>". $result['sub_code_9']."</td>
<td>".$result['sub_grade_9']."</td>
</tr>

<table>
</div>
";
}else{
echo 'error fetching result';
}

}
?>