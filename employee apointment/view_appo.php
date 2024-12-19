<?php
session_start();

if (!isset($_SESSION['rname'])) {
    header('location:emp_logout.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Appointments</title>
    <style>
        table {
            text-align: center;
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Current Appointments</h1>
    <?php
    // Database connection
    $con = mysqli_connect('localhost', 'root', '', 'emp_appo') or die('Unable to connect');

    // Fetch active appointments
    $sql = "SELECT emp_id, emp_name, emp_department, emp_role, appointment_time, valid_until 
            FROM Employee 
            WHERE emp_availability = 0 AND NOW() <= valid_until";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Role</th>
                    <th>Appointment Start Time</th>
                    <th>Validity (End Time)</th>
                </tr>
              </thead>
              <tbody>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['emp_id']}</td>";
            echo "<td>{$row['emp_name']}</td>";
            echo "<td>{$row['emp_department']}</td>";
            echo "<td>{$row['emp_role']}</td>";
            echo "<td>{$row['appointment_time']}</td>";
            echo "<td>{$row['valid_until']}</td>";
            echo "</tr>";
        }
        echo "</tbody></table><br>";
    } else {
        echo "<p>No active appointments found.</p>";
    }

    mysqli_close($con);
    ?>
    <a href="rece_dash.php"><button>Back</button></a>
</body>
</html>
