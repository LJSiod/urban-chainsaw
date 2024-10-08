<?php
include('config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $equipment_id = $_POST['equipment_id'];
    $employee_id = $_POST['employee_id']; // Make sure to capture this from the form
    $branch = $_POST['branch']; // Optionally capture branch info if needed

    // Update the equipment record to associate it with an employee
    $query = "UPDATE equipment SET employee_id = '$employee_id', status = 'Deployed' WHERE equipment_id = $equipment_id";
    mysqli_query($conn, $query);
    
    header("Location: index.php"); // Redirect back to in stock page
}

