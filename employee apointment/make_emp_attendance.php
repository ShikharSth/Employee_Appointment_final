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
    <title>View Employee</title>
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
        .toggle-btn {
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .toggle-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php
    // Database connection
    $con = mysqli_connect('localhost', 'root', '', 'emp_appo') or die('Unable to connect');

    // Update presence status if toggle is clicked
    if (isset($_POST['toggle_presence'])) {
        $emp_id = $_POST['emp_id'];
        $current_presence = $_POST['current_presence'];
        $new_presence = $current_presence == 1 ? 0 : 1;

        $update_sql = "UPDATE Employee SET emp_presence = $new_presence WHERE emp_id = $emp_id";
        if (mysqli_query($con, $update_sql)) {
            // echo "<script>alert('Presence status updated successfully.');</script>";
            header("location: make_emp_attendance.php");
        } else {
            echo "<script>alert('Error updating presence status.');</script>";
        }
    }

    // Fetch employees
    $sql = "SELECT emp_id, emp_name, emp_phone, emp_role, emp_address, emp_department, emp_presence, emp_availability FROM Employee";
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

            // Presence toggle button
            echo "<td>";
            echo ($row['emp_presence'] == 1) ? "Present" : "Not Present";
            echo "<form method='post' style='display: inline;'>
                    <input type='hidden' name='emp_id' value='{$row['emp_id']}'>
                    <input type='hidden' name='current_presence' value='{$row['emp_presence']}'>
                    <button type='submit' name='toggle_presence' class='toggle-btn'>Change</button>
                  </form>";
            echo "</td>";

            // Availability
            echo "<td>";
            echo ($row['emp_availability'] == 1) ? "Unoccupied" : "Occupied";
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
