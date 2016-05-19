<?php
require_once('core/init.php');
require_once('includes/nav_ad_tu.php');

$user = new user();

	if(session::exists('mystudents_tutor')){
	echo "<center>". session::flash('mystudents_tutor') ."</center>";
	}

?>
<form action = "send_gcm_students.php" method="post">
Message :<textarea name="message" placeholder="enter your text here!" > </textarea>
<?php
$db = DB::getInstance();
$staff_id =  $user->data()->reg_no;
$details= $db->query_assoc("select * from adviser_tutor where staff_id = '$staff_id'");
$details = $details->first();
$batch = $details['tu_batch'];
$department = $details['tu_department'];
$year = $details['tu_year'];
$section = $details['tu_section'];
$result = $db->query_assoc("select * from users where batch = '$batch' and department = '$department' and year = '$year' and section = '$section';");
$result = $result->results();

$html="<table class='table table-hover'><th>NAME</th><th>REGISTER NUMBER</th>
<th>DEPARTMENT</th><th>YEAR</th><th>SECTION</th><th>BATCH</th><th>SELECT STUDENTS</th>";


foreach($result as $order ){
		$html .= "<tr>";
		$html .= "<td>" .$order['name'] ."</td>";
		$html .= "<td>" .$order['reg_no'] ."</td>";
		$html .= "<td>" .$order['department']."</td>";
		$html .= "<td>" .$order['year']."</td>";
		$html .= "<td>" .$order['section']."</td>";
		$html .= "<td>" .$order['batch']."</td>";
		$html .= "<td><input type='checkbox' name = 'gcm_id[]'  value = " . $order['gcm_id'] . "/></td>";
		$html .= "</tr>";
		}
$html .="</table>";

echo $html;



?>

<input value="send" type='submit'/> 

</form>
<?php
require_once('includes/footer.php');
?>