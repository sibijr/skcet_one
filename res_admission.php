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

$table = $admission->get_tb_all('admission');


echo "
<header><center><h3>ADMISSION DETAILS</h3></center></header>";
foreach ($table as $row)   
{  
print "
<table class = \"table table-striped  \">
<tr>"; 
print "<td><b>Department</b></td>";
print "<td><b>" . $row['department'] . "</b></td>"; 
print "</tr>";
print "<tr>"; 
print "<td>OC</td>";
print "<td>" . $row['OC'] . "</td>"; 
print "</tr>";
print "<tr>"; 
print "<td>BC</td>";
print "<td>" . $row['BC'] . "</td>"; 
print "</tr>";
print "<tr>"; 
print "<td>MBC</td>";
print "<td>" . $row['MBC'] . "</td>"; 
print "</tr>";
print "<tr>"; 
print "<td>SC</td>";
print "<td>" . $row['SC'] . "</td>"; 
print "</tr>";
print "<tr>"; 
print "<td>SCA</td>";
print "<td>" . $row['SCA'] . "</td>"; 
print "</tr>";
print "<tr>"; 
print "<td>BCM</td>";
print "<td>" . $row['BCM'] . "</td>"; 
print "</tr>"; 
}
print "</table>"; 




?>