<?php
error_reporting(0);
$conn=mysqli_connect('localhost','root','','sms2')or die(mysqli_error("Connection error"));
?>
<?php
 session_start(); 
//Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['admin_id']) || (trim($_SESSION['admin_id']) == '')) { ?>

<?php
}
$session_id=$_SESSION['id'];
$user_query = mysqli_query($conn,"select * from admin where admin_id = '$session_id'")or die(mysqli_error());
$user_row = mysqli_fetch_array($user_query);
$user_username = $user_row['username'];
?>