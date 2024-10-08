
<?php
include ('config/db.php');;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['employeeId'], $_POST['updatedName'], $_POST['updatedDepartment'], $_POST['updatedPosition'], $_POST['updatedUnitName'], $_POST['updatedBranch'])) {
        $updateEmployeeQuery = "UPDATE employee_info SET employee_name=?, department=?, position=?, unitName=?, branch=? WHERE employee_id=?";
        $stmt = mysqli_prepare($conn, $updateEmployeeQuery);
        mysqli_stmt_bind_param($stmt, "sssssi", $_POST['updatedName'], $_POST['updatedDepartment'], $_POST['updatedPosition'], $_POST['updatedUnitName'], $_POST['updatedBranch'], $_POST['employeeId']);

        if (mysqli_stmt_execute($stmt)) {
            echo "Employee information updated successfully";
        } else {
            echo "Failed to update employee information";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "One or more required fields are missing";
    }
} else {
    header("Location: index.php");
    exit;
}

mysqli_close($conn);
?>


