<?php 
session_start();
$message = "";
$error = [];
if (isset($_POST['submit'])) {
	$con = mysqli_connect('localhost','root','','emp_appo') or die('unable to connect');
	$name = $_POST['name'];
	$password = $_POST['pass'];
	if (empty($name) || empty($password)) {
		$message = "Don't Leave Any Field Empty!";
	}
	else{
	$sql = "SELECT * FROM Employee WHERE emp_name = '$name'";

	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($result);
	$stored_pass=$row["emp_pass"];
	if ($password == $stored_pass) {
		if (is_array($row)) {
			// $_SESSION['id'] = $row['admin_id'];
			// $_SESSION['name'] = $row['admin_name'];

			if ($row["emp_role"] == "receptionist") {
				$_SESSION['rid'] = $row['emp_id'];
				$_SESSION['rname'] = $row['emp_name'];
                header("Location: rece_dash.php");
                exit();
            } elseif ($row["emp_role"] == "employee") {
            	$_SESSION['eid'] = $row['emp_id'];
				$_SESSION['ename'] = $row['emp_name'];
                header("Location: emp_dash.php");
                exit();
            } else {
                $message = "Invalid role assigned!";
            }

		}
		else{
			$message = "Wrong name or password!";
		}
	}
	else {
		$message = "Wrong name or password!";
	}
}
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Employee Login Page</title>
	<link rel="stylesheet" type="text/css" href="">
	
</head>
<body>
	<div class="Login">
		<form action="#" method="post">
			<h1>Employee Login</h1>
			<?php if (!empty($message)) { echo "<p style='color:red;'>$message</p>"; } ?>
			<label>Name</label><br>
			<input type="text" name="name" placeholder="Enter name"><br><br>
			<label>Password</label><br>
			<input type="password" name="pass" placeholder="Enter password"><br><br>
			<input class="btn" type="submit" name="submit" value="Login">
			<button><a href="index.php">Index Page</a></button>
		
		</form>
	</div>
</body>
</html> 