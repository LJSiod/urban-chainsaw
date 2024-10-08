<?php
include('config/db.php');

// Query to fetch all "Damaged" items
$queryAll = "SELECT * FROM equipment";
$resultAll = mysqli_query($conn, $queryAll);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Equipment</title>
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
        <h1 class="text-center">All Equipments</h1>
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
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($resultAll) > 0) : ?>
                    <?php while ($row = mysqli_fetch_assoc($resultAll)) : ?>
                        <tr>
                            <td><?php echo str_pad($row['equipment_id'], 4, '0', STR_PAD_LEFT); ?></td>
                            <td><?php echo $row['item_type']; ?></td>
                            <td><?php echo $row['make']; ?></td>
                            <td><?php echo $row['model']; ?></td>
                            <td><?php echo $row['serial_number']; ?></td>
                            <td><?php echo $row['date_purchased'] ? $row['date_purchased'] : 'N/A'; ?></td>
                            <td><?php echo $row['date_acquired'] ? $row['date_acquired'] : 'N/A'; ?></td>
                            <td>
                                <?php if ($row['status'] == 'In Stock') : ?>
                                    <span class="badge badge-success">In Stock</span>
                                <?php elseif ($row['status'] == 'Deployed') : ?>
                                    <span class="badge badge-primary">Deployed</span>
                                <?php elseif ($row['status'] == 'In Repair') : ?>
                                    <span class="badge badge-warning">In Repair</span>
                                <?php elseif ($row['status'] == 'Damaged') : ?>
                                    <span class="badge badge-danger">Damaged</span>
                                <?php else : ?>
                                    <span class="badge badge-secondary">Unknown</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="text-center">No damaged items</td>
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

