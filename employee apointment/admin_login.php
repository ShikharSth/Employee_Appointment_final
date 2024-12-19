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
	$sql = "SELECT * FROM admin WHERE admin_name = '$name'";

	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($result);
	$stored_pass=$row["admin_pass"];
	if ($password == $stored_pass) {
		if (is_array($row)) {
			// $_SESSION['id'] = $row['admin_id'];
			// $_SESSION['name'] = $row['admin_name'];

			if ($row["admin_role"] == "Admin") {
				$_SESSION['id'] = $row['admin_id'];
				$_SESSION['name'] = $row['admin_name'];
                header("Location: admin_dash.php");
                exit();
            } elseif ($row["admin_role"] == "Super Admin") {
            	$_SESSION['id'] = $row['admin_id'];
				$_SESSION['sname'] = $row['admin_name'];
                header("Location: supadmin_dash.php");
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
	<title>Admin Login Page</title>
	<link rel="stylesheet" type="text/css" href="">
	
</head>
<body>
	<div class="Login">
		<form action="#" method="post">
			<h1>Admin Login</h1>
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