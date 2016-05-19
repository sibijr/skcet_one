<?php
require_once('core/init.php');
require_once('includes/header.php');
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
if($admission->get_table('admission',$dept)){
$data= true;
}else{
$data = false;
}
}

if(session::exists('admission')){
	echo session::flash('admission');
}
?>

<div class="container-fluid">
<div class="row">
<div class="col-md-6 col-md-offset-3">

<form action = "" method = "post">
Department search : 
<br><br>
<table>
<tr>
<td>
department:
</td>
<td>
<select name = "department" >
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
</div></div></div>
<form action = "admission_update.php" method = "post">

<input type="hidden" name="department" value ="<?php if($data){echo $admission->data()->department; }else{echo '';} ?>" />
<h4>Admission</h4>
<table>
<tr>
<td>
OC
</td>
<td>
<input name = "OC" type = "text" value="<?php if($data){echo $admission->data()->OC; }else{ echo '';} ?>" />
</td>
</tr>
<tr>
<td>
BC
</td>
<td>
<input name = "BC" type = "text" value="<?php if($data){echo $admission->data()->BC; }else{ echo '';} ?>" />
</td>
</tr>
<tr>
<td>
MBC
</td>
<td>
<input name = "MBC" type = "text" value="<?php if($data){echo $admission->data()->MBC; }else{ echo '';} ?>" />
</td>
</tr>
<tr>
<td>
SC
</td>
<td>
<input name = "SC" type = "text" value="<?php if($data){echo $admission->data()->SC; }else{ echo '';} ?>" />
</td>
</tr>
<tr>
<td>
SCA
</td>
<td>
<input name = "SCA" type = "text" value="<?php if($data){echo $admission->data()->SCA; }else{ echo '';} ?>" />
</td>
</tr>

<tr>
<td>
ST
</td>
<td>
<input name = "ST" type = "text" value="<?php if($data){echo $admission->data()->ST; }else{ echo '';} ?>" />
</td>
</tr>
<tr>
<td>
BCM
</td>
<td>
<input name = "BCM" type = "text" value="<?php if($data){echo $admission->data()->BCM; }else{ echo '';} ?>" />
</td>
</tr>


<td>
<input type="submit" /> 
</td>
</table>


</form>