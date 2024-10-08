<?php
include('config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_name = $_POST['employee_name'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $unitName = $_POST['unitName'];
    $branch = $_POST['branch'];

    $query = "INSERT INTO employee_info (employee_name, department, position, unitName, branch) VALUES ('$employee_name', '$department', '$position', '$unitName', '$branch')";
    mysqli_query($conn, $query);
    header("Location: index.php"); // Redirect back to the main page
}
?>
