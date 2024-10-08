<?php
// Include the database connection
include('config/db.php');

// Queries to get equipment statistics
$queryTotalEquipment = "SELECT COUNT(*) as total FROM equipment";
$queryDeployedEquipment = "SELECT COUNT(*) as deployed FROM equipment WHERE status = 'Deployed'";
$queryInRepairEquipment = "SELECT COUNT(*) as in_repair FROM equipment WHERE status = 'In Repair'";
$queryDamagedEquipment = "SELECT COUNT(*) as damaged FROM equipment WHERE status = 'Damaged'";
$queryInStockEquipment = "SELECT COUNT(*) as in_stock FROM equipment WHERE status = 'In Stock'";

// Execute the queries
$resultTotalEquipment = mysqli_fetch_assoc(mysqli_query($conn, $queryTotalEquipment));
$resultDeployedEquipment = mysqli_fetch_assoc(mysqli_query($conn, $queryDeployedEquipment));
$resultInRepairEquipment = mysqli_fetch_assoc(mysqli_query($conn, $queryInRepairEquipment));
$resultDamagedEquipment = mysqli_fetch_assoc(mysqli_query($conn, $queryDamagedEquipment));
$resultInStockEquipment = mysqli_fetch_assoc(mysqli_query($conn, $queryInStockEquipment));
?>
<style>
    .sidebar {
        position: fixed;
        top: 0;
        right: 0;
        width: 250px;
        height: 100%;
        background-color: #f8f9fa;
        padding: 10px;
        border-left: 1px solid #ccc;
    }

    .content {
        margin-right: 270px; 
    }

    .sidebar h5 {
        font-weight: bold;
        margin-bottom: 20px;
    }

    .list-group-item {
        font-size: 1.1em;
    }

    a {
        color: black;
    }
</style>

<div class="sidebar">
    <h4>Menu</h4>
    <hr>
    <h5>Equipment Summary</h5>
    <ul class="list-group">
        <a class="list-group-item d-flex justify-content-between align-items-center" href="all_equipments.php" style="text-decoration: unset;">
            Total Equipment
            <span class="badge badge-secondary badge-pill"><?php echo $resultTotalEquipment['total']; ?></span>
        </a>
        <a class="list-group-item d-flex justify-content-between align-items-center" href="in_stock.php" style="text-decoration: unset;">
            In Stock
            <span class="badge badge-success badge-pill"><?php echo $resultInStockEquipment['in_stock']; ?></span>
        </a>
        <a class="list-group-item d-flex justify-content-between align-items-center" href="index.php" style="text-decoration: unset;">
            Deployed
            <span class="badge badge-primary badge-pill"><?php echo $resultDeployedEquipment['deployed']; ?></span>
        </a>
        <a class="list-group-item d-flex justify-content-between align-items-center" href="in_repair.php" style="text-decoration: unset;">
            In Repair
            <span class="badge badge-warning badge-pill"><?php echo $resultInRepairEquipment['in_repair']; ?></span>
        </a>
        <a class="list-group-item d-flex justify-content-between align-items-center" href="damaged.php" style="text-decoration: unset;">
            Damaged
            <span class="badge badge-danger badge-pill"><?php echo $resultDamagedEquipment['damaged']; ?></span>
        </a>
    </ul>
    <hr>

    <h5>Actions</h5>
    <ul class="list-group">
        <a class="list-group-item d-flex justify-content-between align-items-center" href="add_employee.php" style="text-decoration: unset;">
            Add Employee
        </a>
        <a class="list-group-item d-flex justify-content-between align-items-center" href="add_equipment.php" style="text-decoration: unset;">
            Add Equipment
        </a>
    </ul>
    <hr>

    <h5>Filter</h5>
    <ul class="list-group">
        <form method="GET" action="index.php" class="mb-4">
            <select class="list-group-item d-flex justify-content-between align-items-center" name="branch" id="branch" onchange="this.form.submit()" style="color: black; text-decoration: unset;">
                <option value="">All Branches</option>
                <?php foreach ($branches as $branch) : ?>
                    <option value="<?php echo $branch['branch']; ?>" <?php echo (isset($_GET['branch']) && $_GET['branch'] == $branch['branch']) ? 'selected' : ''; ?>>
                        <?php echo $branch['branch']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </ul>
</div>


