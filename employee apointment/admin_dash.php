<?php
	session_start();

	if(!isset($_SESSION['name'])){
	   header('location:logout.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Dashborad</title>
</head>
<body>
	<h1>Admin Dash</h1>
	<a href="add_emp.php">Add Employee</a><br>
	<a href="emp_availability.php">Employee Availability</a><br>
	<a href="logout.php">Logout</a>
</body>
</html>