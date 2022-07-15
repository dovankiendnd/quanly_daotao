<?php
mysqli_select_db('sms2',mysqli_connect('localhost','root',''));
?>
<?php

session_start();
session_destroy();
header('location:index.php');
?>