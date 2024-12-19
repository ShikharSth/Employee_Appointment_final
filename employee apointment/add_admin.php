<?php
    session_start();

    if(!isset($_SESSION['sname'])){
       header('location:logout.php');
    }
?>
<?php
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $role = $_POST['role'];
        $pass = $_POST['pass'];
        if (empty($name) || empty($pass)) {
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
        $sql = "INSERT INTO admin(admin_name,admin_role, admin_pass) VALUES ('$name','$role','$pass')";
        if (mysqli_query($conn, $sql)) {
            header("location: supadmin_dash.php");
            exit();
        }
        else{
        echo "Error: ";
        }
    }
?> 





<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Admin</title>
    <style type="text/css">
        .addadmin{
            max-width: 550px;
            background-color: aqua;
            padding: 10px;
            margin: auto;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="addadmin">
        <h1>Add Admin</h1>
    	<form method="post" action="#">
    		<label>Admin Name:</label><br>
    		<input type="text" name="name" placeholder="Name"><br>
            <input type="text" name="role" value="Admin" hidden><br>
            <input type="text" name="pass" placeholder="Password"><br>
    		<input type="submit" name="submit" value="Add">
            <button><a href="supadmin_dash.php">Go Back</a></button>
    	</form>
    </div>


</body>
</html>