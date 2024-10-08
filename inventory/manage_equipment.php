<?php
// Include the database connection
include('config/db.php');

// Handle status change logic (repair or damaged)
if (isset($_GET['equipment_id']) && isset($_GET['action'])) {
    $equipmentId = $_GET['equipment_id'];
    $action = $_GET['action'];

    // Determine the new status based on the action
    $newStatus = '';
    if ($action == 'repair') {
        $newStatus = 'In Repair';
    } elseif ($action == 'damaged') {
        $newStatus = 'Damaged';
    }

    if ($newStatus) {
        // Update the equipment status in the database
        $queryUpdateStatus = "UPDATE equipment SET status = '$newStatus' WHERE equipment_id = $equipmentId";
        if (mysqli_query($conn, $queryUpdateStatus)) {
            // Redirect back to the main page after the update
            header('Location: index.php');
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
}

// Fetch equipment and branch info for deployment
$equipment_id = $_GET['equipment_id'];

$equipment_query = "SELECT * FROM equipment WHERE equipment_id = $equipment_id";
$equipment_result = mysqli_query($conn, $equipment_query);
$equipment = mysqli_fetch_assoc($equipment_result);

$branches_query = "SELECT DISTINCT branch FROM employee_info"; 
$branches_result = mysqli_query($conn, $branches_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Equipment</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Chivo+Mono|Nunito+Sans|Inter">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<style>

    .container {
        border: 1px solid lightgray;
        max-width: 40%;
    }

    .formBackground {
        background-image: url("assets/image/neo-watermark.png");
        background-size: cover;
        background-repeat: no-repeat;
    }

</style>
<body>
    <div class="container cards mt-5 p-3 formBackground">
        <button type="button" class="close p-2 m-3" aria-label="Close" style="box-shadow: unset;"
        onclick="window.location.href = 'index.php'">
        <span aria-hidden="true" title="Close Form">&times;</span>
    </button>
    <h2>Manage Equipment: <?php echo $equipment['item_type']; ?> (ID: <?php echo $equipment['equipment_id']; ?>)</h2>
    <hr>

    <form action="deploy_equipment.php" method="POST">
        <input type="hidden" name="equipment_id" value="<?php echo $equipment['equipment_id']; ?>">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="branch">Select Branch:</label>
                <select id="branch" name="branch" class="form-control" required>
                    <option value="">Select Branch</option>
                    <?php while ($branch = mysqli_fetch_assoc($branches_result)): ?>
                        <option value="<?php echo $branch['branch']; ?>"><?php echo $branch['branch']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="employee">Select Employee:</label>
                <select id="employee" name="employee_id" class="form-control" required>
                    <option value="">Select Employee</option>
                    <!-- You need to fetch employees based on the selected branch using AJAX -->
                </select>
            </div>
        </div>
        <div class="form-group d-flex flex-row-reverse">
            <button type="submit" class="btn btn-sm btn-success">Deploy Equipment</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('branch').addEventListener('change', function() {
        const branch = this.value;
        const employeeSelect = document.getElementById('employee');

        employeeSelect.innerHTML = '<option value="">Select Employee</option>';

        if (branch) {
            fetch('get_employees.php?branch=' + branch)
            .then(response => response.json())
            .then(data => {
                data.forEach(employee => {
                    const option = document.createElement('option');
                    option.value = employee.employee_id;
                    option.textContent = employee.employee_name;
                    employeeSelect.appendChild(option);
                });
            });
        }
    });
</script>

</body>
</html>
