<?php
require_once('core/init.php');
$user = new user();
/*
if(!$user->isLoggedIn()){
	redirect::to('index.php');
} 
*/

$data = false;
$admission = new admission();

if(input::exists()){
$dept = input::get('department');
$table = 'placement';
if($admission->get_table($table,$dept)){
$data= true;
}else{
$data = false;
}
}


if(session::exists('placement')){
	echo session::flash('placement');
}



?>



<form action = "" method = "post">
Department search : 
<br><br>
<table>
<tr>
<td>
department:
</td>
<td>
<select name = "department">
<option value="cse">cse</option>
<option value="mct">mct</option>
<option value="mech">mech</option>
<option value="it">it</option>
<option value="ece">ece</option>
<option value="eee">eee</option>
</select>
</td>
</tr>
</table>
<input type = "submit" value ="search"/>
</form>




<form action = "placement_update.php" method = "post">
<h4>placement</h4>
<table>
<tr>
<td>
department:
</td>
<td>
<input name = "department" type = "hidden" value ="<?php if($data){echo $admission->data()->department; }else{echo '';} ?>" />
</td>
</tr>
<tr>
<td>
eligible
</td>
<td>
<input name="eligible" type = "text" value ="<?php if($data){echo $admission->data()->eligible; }else{echo '';} ?>" />
</td>
</tr>
<tr>
<td>
unique features
</td>
<td>
<input name="unique" type = "text" value ="<?php if($data){echo $admission->data()->uniq; }else{echo '';} ?>" />
</td>
</tr>
<tr>
<td>
percentage
</td>
<td>
<input name = "percentage" type = "text" value ="<?php if($data){echo $admission->data()->percent; }else{echo '';} ?>" />
</td>
</tr>
<tr>
<td>
category
</td>
<td>
<input name = "category" type = "text" value ="<?php if($data){echo $admission->data()->category; }else{echo '';} ?>" />
</td>
</tr>
<td>
<input type="submit" /> 
</td>
</table>
</form>