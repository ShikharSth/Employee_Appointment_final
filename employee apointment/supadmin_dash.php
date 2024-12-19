<?php
	session_start();

	if(!isset($_SESSION['sname'])){
	   header('location:logout.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Super Admin Dashborad</title>
</head>
<body>
	<h1>Admin Dash</h1>
	<a href="add_admin.php">Add Admin</a><br>
	<a href="add_emp.php">Add Employee</a><br>
	<a href="logout.php">Logout</a><br>
</body>
</html>