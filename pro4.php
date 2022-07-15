<?php
error_reporting(0);
$conn = mysqli_connect("localhost","root","");
mysqli_select_db("sms2",$conn);
$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++) {
mysqli_query("DELETE FROM studentstable WHERE student_id='" . $_POST["users"][$i] . "'");
}
header("Location:pro1.php");

?>
