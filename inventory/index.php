<?php
include('config/db.php');

// Fetch all employees and their equipment
$branchFilter = isset($_GET['branch']) ? $_GET['branch'] : '';

$queryEmployees = "
SELECT emp.*, e.*
FROM employee_info emp
LEFT JOIN equipment e ON e.employee_id = emp.employee_id
" . ($branchFilter ? " WHERE emp.branch = '" . mysqli_real_escape_string($conn, $branchFilter) . "'" : "") . "
";

$resultEmployees = mysqli_query($conn, $queryEmployees);

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

// Fetch distinct branches
$queryBranches = "SELECT DISTINCT branch FROM employee_info";
$resultBranches = mysqli_query($conn, $queryBranches);
$branches = mysqli_fetch_all($resultBranches, MYSQLI_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Equipment Tracking</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Chivo+Mono|Nunito+Sans|Inter">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>

    body {
        font-family: "Nunito Sans", sans-serif;
    }

    
</style>
<body id="content">
    <?php include('loader.php'); ?>
    <div class="mt-5 ml-4" style="margin-right: 280px;">
        <h1 class="text-center">Deployed Items</h1>
        <hr>
        <?php 
        $currentEmployeeId = null; 
        while ($row = mysqli_fetch_assoc($resultEmployees)) : 
            if ($currentEmployeeId != $row['employee_id']) : 
                if ($currentEmployeeId !== null) : ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; 
$currentEmployeeId = $row['employee_id']; 
?>


<div class="employee-section mb-5">
    <div class="d-flex align-items-center">
    <h3><?php echo $row['employee_name']; ?> </h3><?php echo "<span type='button' class='ml-2 update-btn' href='#' data-toggle='modal' data-target='#updateEmployeeModal' data-employeeid='".$row['employee_id']."' data-employeename='".$row['employee_name']."' data-department='".$row['department']."' data-position='".$row['position']."' data-unitname='".$row['unitName']."' data-branch='".$row['branch']."'><i class='fa fa-pencil'></i></span>"; ?>
    </div>
    <p>Department: <?php echo $row['department']; ?> | Position: <?php echo $row['position']; ?> | Branch: <?php echo $row['branch']; ?></p>

    <div class="table">
        <table class="table table-sm">
            <thead class="thead-dark">
                <tr>
                    <th>Item ID</th>
                    <th>Item Type</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Serial Number</th>
                    <th>Date Acquired</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php endif; ?>

            <?php if ($row['equipment_id'] && $row['status'] == 'Deployed') : ?>
                <tr>
                    <td><?php echo $row['equipment_id']; ?></td>
                    <td><?php echo $row['item_type']; ?></td>
                    <td><?php echo $row['make']; ?></td>
                    <td><?php echo $row['model']; ?></td>
                    <td><?php echo $row['serial_number']; ?></td>
                    <td><?php echo $row['date_acquired']; ?></td>
                    <td>
                        <div class="dropdown dropright">
                            <span type="button" class="btn btn-sm btn-light" data-toggle="dropdown">
                             <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                         </span>
                         <div class="dropdown-menu dropdown-menu-right">
                            <a href='manage_equipment.php?equipment_id=<?php echo $row['equipment_id']; ?>&action=repair' class='dropdown-item'>Mark as In Repair</a>
                            <a href='manage_equipment.php?equipment_id=<?php echo $row['equipment_id']; ?>&action=damaged' class='dropdown-item'>Mark as Damaged</a>
                            <a href='manage_equipment.php?equipment_id=<?php echo $row['equipment_id']; ?>&action=redeploy' class='dropdown-item'>Redeploy Equipment</a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endif; ?>

    <?php endwhile; ?>
</tbody>
</table>
</div>
</div>
</div>

<div class="modal fade formBackground" id="updateEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="updateEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header theader">
          <h5 class="modal-title" id="updateEmployeeModalLabel">Update Employee Information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
      <form id="updateEmployeeForm" method="POST">
        <input type="hidden" id="updated_employee_id" name="updated_employee_id"> 
        <label for="updated_name">Name</label>
        <input type="text" id="updated_name" name="updated_name" class="form-control" required>
        <label for="updated_unit_name">Unit Name</label>
        <input type="text" id="updated_unit_name" name="updated_unit_name" class="form-control" required>
        <label for="updated_department">Department</label>
        <input type="text" id="updated_department" name="updated_department" class="form-control" required>
        <label for="updated_position">Position</label>
        <input type="text" id="updated_position" name="updated_position" class="form-control" required>
        <label for="updated_branch">Branch</label>
        <input type="text" id="updated_branch" name="updated_branch" class="form-control" required>
    </form>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
  <button type="button" class="btn btn-primary" id="updateEmployeeButton">Update</button>
</div>
</div>
</div>
</div>

<?php include 'sidebar.php'; ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

 $(document).ready(function() {
    $('.update-btn').click(function() {
      var employeeId = $(this).data('employeeid');
      var employeeName = $(this).data('employeename');
      var department = $(this).data('department');
      var position = $(this).data('position');
      var unitName = $(this).data('unitname');
      var branch = $(this).data('branch');

      $('#updated_employee_id').val(employeeId);
      $('#updated_name').val(employeeName);
      $('#updated_department').val(department);
      $('#updated_position').val(position);
      $('#updated_unit_name').val(unitName);
      $('#updated_branch').val(branch);
  });

    $('#updateEmployeeButton').click(function() {
      var employeeId = $('#updated_employee_id').val();
      var updatedName = $('#updated_name').val();
      var updatedDepartment = $('#updated_department').val();
      var updatedPosition = $('#updated_position').val();
      var updatedUnitName = $('#updated_unit_name').val();
      var updatedBranch = $('#updated_branch').val();

      $.ajax({
        type: 'POST',
        url: 'update_employee.php',
        data: {
          employeeId: employeeId,
          updatedName: updatedName,
          updatedDepartment: updatedDepartment,
          updatedPosition: updatedPosition,
          updatedUnitName: updatedUnitName,
          updatedBranch: updatedBranch
      },
      success: function(response) {
          console.log(response);
          location.reload();
      },
      error: function(xhr, status, error) {
          console.error(error);
      }
  });
  });
});

</script>

</body>
</html>


