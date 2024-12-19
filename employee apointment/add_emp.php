<?php
    session_start();

    if(!isset($_SESSION['sname']) && !isset($_SESSION['name'])){
       header('location:logout.php');
    }

?>
<?php
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $role = $_POST['role'];
        $address = $_POST['address'];
        $department = $_POST['department'];
        $pass = $_POST['pass'];
        if (empty($name) || empty($phone) || empty($role) || empty($address) || empty($department) || empty($pass)) {
            echo '<script>alert("Dont leave any field empty and password and confirm password must be same")</script>';
            die();
        }
        else{
            // create connection
            $conn=mysqli_connect('localhost','root','','emp_appo');
        }
        //check connection
        if (!$conn) {
            die("Connection failed!");
        }
        $sql = "INSERT INTO Employee(emp_name,emp_phone,emp_role,emp_address, emp_department, emp_pass)
                VALUES ('$name','$phone','$role','$address','$department','$pass')";
        if (mysqli_query($conn, $sql)) {
            if (isset($_SESSION['sname'])) {
				header("location: supadmin_dash.php");
			}elseif (isset($_SESSION['name'])) {
				header("location: admin_dash.php");
			}
            exit();
        }
        else{
        echo "Error: ";
        }
    }
?> 
<?php
    if(isset($_POST['goback'])){
    	if (isset($_SESSION['sname'])) {
		    header("location: supadmin_dash.php");
		}elseif (isset($_SESSION['name'])) {
			header("location: admin_dash.php");
		}
    }
?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Employee</title>
    <style type="text/css">
        .addemp{
            max-width: 550px;
            background-color: aqua;
            padding: 10px;
            margin: auto;
            text-align: center;
        }
    </style>
</head>
<body>
	<div class="addemp">
		<h1>Add Employee</h1>
		<form method="post" action="#">
			<label>Name:</label><br>
			<input type="text" name="name" placeholder="Name"><br>
			<label>Phone:</label><br>
			<input type="text" name="phone" placeholder="Phone"><br>
			<label>Role:</label><br>
			<select name="role">
				<option>Select Role</option>
				<option value="employee">Employee</option>
				<option value="receptionist">receptionist</option>
			</select><br>
			<label>Address:</label><br>
			<input type="text" name="address" placeholder="Address"><br>
			<label>Department:</label><br>
			<select name="department">
				<option>Select Department</option>
				<option value="Production">Production</option>
				<option value="Sales">Sales</option>
				<option value="Reception">Reception</option>
			</select><br>
			<label>Password:</label><br>
			<input type="text" name="pass" placeholder="Password"><br>
			<input type="submit" name="submit" value="Submit">
			<input type="submit" name="goback" value="Go Back">
		</form>
	</div>

</body>
</html>