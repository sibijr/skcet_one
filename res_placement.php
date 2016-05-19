<?php
require_once('core/init.php');
require_once('core/boot.php');
function stdToArray($obj){
  $reaged = (array)$obj;
  foreach($reaged as $key => &$field){
    if(is_object($field))$field = stdToArray($field);
  }
  return $reaged;
}

$admission = new admission();

$table = $admission->get_tb_all('placement');

print " 

<header><center><h3>PLACEMENT DETAILS</h3></center></header>
<table class=\"table table-striped\"><tr> 
<td width=100><b>Department</b></td> 
<td width=100><b>Eligible</b></td> 
<td width=100><b>Percentage</b></td> 
<td width=100><b>Unique</b></td> 
</tr>"; 


foreach ($table as $row)   
{  
print "<tr>"; 
print "<td>" . $row['department'] . "</td>"; 
print "<td>" . $row['eligible'] . "</td>"; 
print "<td>" . $row['percentage'] ."</td>";  
print "<td>" . $row['unique'] . "</td>";
print "</tr>";  
}
print "</table>"; 




?>