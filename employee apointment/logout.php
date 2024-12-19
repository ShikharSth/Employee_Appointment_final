<?php

$con = mysqli_connect('localhost','root','','emp_appo') or die('unable to connect');

session_start();
session_unset();
session_destroy();

header('location:admin_login.php');

?>