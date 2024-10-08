<?php
include('config/db.php');

$branch = $_GET['branch'];
$query = "SELECT * FROM employee_info WHERE branch = '$branch'";
$result = mysqli_query($conn, $query);

$employees = [];
while ($row = mysqli_fetch_assoc($result)) {
    $employees[] = $row;
}

echo json_encode($employees);
?>