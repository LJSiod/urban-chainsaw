<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Equipment Tracking</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: "Nunito Sans", sans-serif;
        }

        .container {
            border: 1px solid lightgray;
            max-width: 40%;
        }

        .formBackground {
            background-image: url("assets/image/neo-watermark.png");
            background-size: cover;
            background-repeat: no-repeat;
        }

        button {
            font-size: 14px;
            border-radius: 5px;
            padding: 7px 18px;
            border: none;
            font-weight: 500;
            background-color: #b02b3d;
            color: white;
            cursor: pointer;
            margin-top: 25px;
            transition: 0.2s;
        }

        button:hover {
            box-shadow: 0px 3px 8px rgba(187, 45, 64, 0.5);
        }

        button:active {
            transform: translate(0em, 0.2em);
        }

    </style>
</head>
<body>
    <div class="container cards mt-5 p-3 formBackground">
        <button type="button" class="close p-2 m-3" aria-label="Close" style="box-shadow: unset;"
        onclick="window.location.href = 'index.php'">
        <span aria-hidden="true" title="Close Form">&times;</span>
    </button>
    <h2>Add Employee</h2>
    <hr>
    <form id="addEmployeeForm" class="mx-auto mt-2" method="POST" style="max-width: 650px;">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="employee_name">Employee Name:</label>
                <input type="text" class="form-control" id="employee_name" name="employee_name" placeholder="Employee Name" required>
            </div>
            <div class="form-group col-md-6">
                <label for="unitName">Unit Name:</label>
                <input type="text" class="form-control" id="unitName" name="unitName" placeholder="Unit Name" required>
            </div>
            <div class="form-group col-md-6">
                <label for="department">Department</label>
                <select class="form-control" id="department" name="department" required onchange="updatePositions()">
                    <option value="Administration">Administration</option>
                    <option value="Accounting">Accounting</option>
                    <option value="Credit and Collection">Credit and Collection</option>
                    <option value="IT Department">IT Department</option>
                    <option value="Executive">Executive</option>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="position">Position</label>
                <select class="form-control" id="position" name="position" required>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="branch">Branch:</label>
                <select class="form-control" id="branch" name="branch" required>
                    <option>BANSALAN</option>
                    <option>CABANTIAN</option>
                    <option>CALINAN</option>
                    <option>CALUMPANG</option>
                    <option>DIGOS</option>
                    <option>ISULAN</option>
                    <option>KIDAPAWAN</option>
                    <option>MARBEL</option>
                    <option>MATI</option>
                    <option>MATINA</option>
                    <option>MIDSAYAP</option>
                    <option>MLANG</option>
                    <option>PADADA</option>
                    <option>PANABO</option>
                    <option>PIGCAWAYAN</option>
                    <option>POLOMOLOK</option>
                    <option>QUIMPO</option>
                    <option>SAMAL</option>
                    <option>SANTIAGO</option>
                    <option>STO. NIÑO</option>
                    <option>SURALLAH</option>
                    <option>TACURONG</option>
                    <option>TAGUM</option>
                    <option>TORIL</option>
                    <option>TUPI</option>
                </select>
            </div>
        </div>
        <div class="form-group d-flex flex-row-reverse">
            <button type="submit" class="btn btn-sm btn-primary">Add Employee</button>
        </div>
    </form>
</div>

<!-- MODAL -->
<div class="modal fade" id="responseModal" tabindex="-1" role="dialog" aria-labelledby="responseModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="responseModalLabel">Submission Success</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="modalMessage">
            Quota Updated Succesfully.
        </div>
        <div class="modal-footer">
            <button type="button" onclick="window.location.href='index.php'">Back to Table</button>
            <button type="button" onclick="window.location.href='add_employee.php'">Add Another Entry</button>
        </div>
    </div>
</div>
</div>

<script>
    function updatePositions() {
        const departmentSelect = document.getElementById("department");
        const positionSelect = document.getElementById("position");
        const selectedDepartment = departmentSelect.value;

        positionSelect.innerHTML = "";

        switch (selectedDepartment) {
        case "Administration":
            positionSelect.innerHTML += "<option>Manager</option>";
            break;
        case "Accounting":
            positionSelect.innerHTML += "<option>Cashier</option>";
            positionSelect.innerHTML += "<option>Accounting Clerk</option>";
            break;
        case "Credit and Collection":
            positionSelect.innerHTML += "<option>Loans Officer</option>";
            positionSelect.innerHTML += "<option>Credit Officer</option>";
            positionSelect.innerHTML += "<option>Collection Officer</option>";
            break;
        case "IT Department":
            positionSelect.innerHTML += "<option>IT Staff</option>";
            positionSelect.innerHTML += "<option>Manager</option>";
            break;
        case "Executive":
            positionSelect.innerHTML += "<option>CEO/President</option>";
            positionSelect.innerHTML += "<option>Vice President</option>";
            positionSelect.innerHTML += "<option>Chief Financial Officer</option>";
            positionSelect.innerHTML += "<option>Corporate Secretary</option>";
            break;
        default:
            positionSelect.innerHTML += "<option>Please select a department first</option>";
        }
    }

    document.getElementById('addEmployeeForm').addEventListener('submit', (event) => {
        event.preventDefault();
        const form = document.getElementById("addEmployeeForm");
        const formData = new FormData(form);
        fetch('process_add_employee.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Submission Success!");
            } else {
                alert('Submission failed. Please try again.');
            }
        })
        .catch(error => console.error('Error:', error));
        $('#responseModal').modal('show');
    });
</script>
</body>
</html>

