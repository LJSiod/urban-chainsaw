<?php
include 'db.php'; 

$query = "
    SELECT 
        ei.employee_id, 
        ei.employee_name, 
        ei.department, 
        ei.position, 
        ei.unitName, 
        ei.branch, 
        eq.item_type, 
        eq.make, 
        eq.model, 
        eq.serial_number, 
        eq.date_purchased, 
        eq.date_acquired, 
        eq.status
    FROM employee_info ei
    LEFT JOIN equipment eq ON ei.employee_id = eq.employee_id
    WHERE eq.status = 'Deployed'
    ORDER BY ei.employee_name";
    
$result = $conn->query($query);

$employees = [];
// Group the equipment by employee
while ($row = $result->fetch_assoc()) {
    $employees[$row['employee_id']]['details'] = [
        'name' => $row['employee_name'],
        'department' => $row['department'],
        'position' => $row['position'],
        'unitName' => $row['unitName'],
        'branch' => $row['branch']
    ];
    $employees[$row['employee_id']]['equipment'][] = [
        'item_type' => $row['item_type'],
        'make' => $row['make'],
        'model' => $row['model'],
        'serial_number' => $row['serial_number'],
        'date_purchased' => $row['date_purchased'],
        'date_acquired' => $row['date_acquired']
    ];
}

