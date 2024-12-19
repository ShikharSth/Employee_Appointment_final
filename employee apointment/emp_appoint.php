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
    <title>Employee Appoint</title>
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
        .appoint-btn {
            padding: 5px 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .appoint-btn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
        .appoint-btn:hover:enabled {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <?php
    // Set the timezone to match your location
    date_default_timezone_set('Asia/Kathmandu');

    // Database connection
    $con = mysqli_connect('localhost', 'root', '', 'emp_appo') or die('Unable to connect');

    // Handle appointment request
    if (isset($_POST['appoint_employee'])) {
        $emp_id = $_POST['emp_id'];
        $appointment_time = date('Y-m-d H:i:s'); // Current time with timezone adjustment
        $valid_until = date('Y-m-d H:i:s', strtotime('+15 minutes', strtotime($appointment_time)));

        $appoint_sql = "UPDATE Employee SET emp_availability = 0, appointment_time = '$appointment_time', valid_until = '$valid_until' WHERE emp_id = $emp_id";
        if (mysqli_query($con, $appoint_sql)) {
            echo "<script>alert('Employee appointed successfully. Appointment valid for 15 minutes.');</script>";
        } else {
            echo "<script>alert('Error in appointment process.');</script>";
        }
    }

    // Auto-expire appointments after 15 minutes
    $expire_sql = "UPDATE Employee SET emp_availability = 1 WHERE NOW() > valid_until AND emp_availability = 0";
    mysqli_query($con, $expire_sql);

    // Fetch employees
    $sql = "SELECT emp_id, emp_name, emp_phone, emp_role, emp_address, emp_department, emp_presence, emp_availability, appointment_time FROM Employee";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Address</th>
                    <th>Department</th>
                    <th>Presence</th>
                    <th>Availability</th>
                    <th>Appoint</th>
                </tr>
              </thead>
              <tbody>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['emp_id']}</td>";
            echo "<td>{$row['emp_name']}</td>";
            echo "<td>{$row['emp_phone']}</td>";
            echo "<td>{$row['emp_role']}</td>";
            echo "<td>{$row['emp_address']}</td>";
            echo "<td>{$row['emp_department']}</td>";

            // Presence column
            echo "<td>";
            echo ($row['emp_presence'] == 1) ? "Present" : "Not Present";
            echo "</td>";

            // Availability column
            echo "<td>";
            echo ($row['emp_availability'] == 1) ? "Unoccupied" : "Occupied";
            echo "</td>";

            // Appoint button
            echo "<td>";
            if ($row['emp_presence'] == 1 && $row['emp_availability'] == 1) {
                echo "<form method='post' style='display: inline;'>
                        <input type='hidden' name='emp_id' value='{$row['emp_id']}'>
                        <button type='submit' name='appoint_employee' class='appoint-btn'>Appoint</button>
                      </form>";
            } else {
                echo "<button class='appoint-btn' disabled>Appoint</button>";
            }
            echo "</td>";

            echo "</tr>";
        }
        echo "</tbody></table><br>";
    } else {
        echo "<p>No employees found.</p>";
    }

    mysqli_close($con);
    ?>
    <a href="rece_dash.php"><button>Back</button></a>
</body>
</html>
