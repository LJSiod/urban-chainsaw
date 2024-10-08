<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Employee Equipment Tracking</title>
	<link rel="stylesheet" href="assets/css/styles.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Chivo+Mono|Nunito+Sans|Inter">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
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
<body>
	<div class="container cards mt-5 p-3 formBackground">
		<button type="button" class="close p-2 m-3" aria-label="Close" style="box-shadow: unset;"
		onclick="window.location.href = 'index.php'">
		<span aria-hidden="true" title="Close Form">&times;</span>
	</button>
	<h2>Add Equipment</h2>
	<hr>
	<form id="addEquipmentForm" class="mx-auto mt-2" style="max-width: 650px;">
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="item_type">Item Type:</label>
				<input type="text" class="form-control" id="item_type" name="item_type" placeholder="Item Type" required>
			</div>
			<div class="form-group col-md-6">
				<label for="make">Make:</label>
				<input type="text" class="form-control" id="make" name="make" placeholder="Make" required>
			</div>
			<div class="form-group col-md-6">
				<label for="model">Model:</label>
				<input type="text" class="form-control" id="model" name="model" placeholder="Model">
			</div>
			<div class="form-group col-md-6">
				<label for="serial_number">Serial Number:</label>
				<input type="text" class="form-control" id="serial_number" name="serial_number" placeholder="Serial Number">
			</div>
			<div class="form-group col-md-6">
				<label for="date_purchased">Date Purchased:</label>
				<input type="date" class="form-control" id="date_purchased" name="date_purchased">
			</div>
			<div class="form-group col-md-6">
				<label for="date_acquired">Date Acquired:</label>
				<input type="date" class="form-control" id="date_acquired" name="date_acquired">
			</div>
		</div>
		<div class="form-group d-flex flex-row-reverse">
			<button type="submit" class="btn btn-sm btn-primary">Add Equipment</button>
		</div>
	</form>


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
				<button type="button" onclick="window.location.href='add_equipment.php'">Add Another Entry</button>
			</div>
		</div>
	</div>
</div>


</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<script>

	document.getElementById('addEquipmentForm').addEventListener('submit', function (event) {
		event.preventDefault();
		var form = document.getElementById('addEquipmentForm');
		var formData = new FormData(form);

		fetch('process_add_equipment.php', {
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
</html>