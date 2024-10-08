<?php
include('config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_type = $_POST['item_type'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $serial_number = $_POST['serial_number'];

    // Check if the dates are provided; if not, set them to NULL
    $date_purchased = !empty($_POST['date_purchased']) ? $_POST['date_purchased'] : NULL;
    $date_acquired = !empty($_POST['date_acquired']) ? $_POST['date_acquired'] : NULL;

    $status = "In Stock"; // Default status for new equipment

    // Prepare the query
    $query = "INSERT INTO equipment (item_type, make, model, serial_number, date_purchased, date_acquired, status) 
              VALUES ('$item_type', '$make', '$model', '$serial_number', 
              " . ($date_purchased ? "'$date_purchased'" : "NULL") . ", 
              " . ($date_acquired ? "'$date_acquired'" : "NULL") . ", 
              '$status')";

    mysqli_query($conn, $query);
    header("Location: in_stock.php"); // Redirect back to in stock page
}
?>
