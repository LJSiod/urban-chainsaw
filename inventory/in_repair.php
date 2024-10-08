<?php
include('config/db.php');

$queryInRepair = "SELECT * FROM equipment WHERE status = 'In Repair'";
$resultInRepair = mysqli_query($conn, $queryInRepair);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In Repair Equipment</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Chivo+Mono|Nunito+Sans|Inter">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
    
    body {
        font-family: "Nunito Sans", sans-serif;
    }


</style>
<body>
    <?php include('loader.php'); ?>
    <div class="mt-5 ml-4" style="margin-right: 280px;">
        <h1 class="text-center">In Repair Equipment</h1>
        <hr>
        
        <table class="table table-sm">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Item Type</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Serial Number</th>
                    <th>Date Purchased</th>
                    <th>Date Acquired</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($resultInRepair) > 0) : ?>
                    <?php while ($row = mysqli_fetch_assoc($resultInRepair)) : ?>
                        <tr>
                            <td><?php echo str_pad($row['equipment_id'], 4, '0', STR_PAD_LEFT); ?></td>
                            <td><?php echo $row['item_type']; ?></td>
                            <td><?php echo $row['make']; ?></td>
                            <td><?php echo $row['model']; ?></td>
                            <td><?php echo $row['serial_number']; ?></td>
                            <td><?php echo $row['date_purchased'] ? $row['date_purchased'] : 'N/A'; ?></td>
                            <td><?php echo $row['date_acquired'] ? $row['date_acquired'] : 'N/A'; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td>
                                <a href='manage_equipment.php?equipment_id=<?php echo $row['equipment_id']; ?>&action=redeploy' class='btn btn-sm btn-primary'>Redeploy</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="9" class="text-center">No items in repair</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php include 'sidebar.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    
</body>
</html>

