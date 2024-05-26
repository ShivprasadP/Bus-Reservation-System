<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Buses</title>
    <style>
        .container {
            background-color: rgba(147, 129, 255, 0.2);
            padding: 50px;
            border-radius: 30px;
        }
        .table-bordered td, .table-bordered th {
            border: 2px solid black !important;
        }
    </style>
</head>
<body>
    <?php
        // Check if the updated query parameter is present
        if (isset($_GET['updated']) && $_GET['updated'] == 'true') {
            echo "<script>
                alert('Record updated successfully');
                window.location.href='manage_bus.php';
            </script>";
        }
        if (isset($_GET['deleted']) && $_GET['deleted'] == 'true') {
            echo "<script>
                alert('Record deleted successfully');
                window.location.href='manage_bus.php';
            </script>";
        }
    ?>
    
    <?php include 'navbar.php'; ?>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Bus Details</h2>
            <button type="button" class="btn btn-primary"n data-toggle="modal" data-target="#newModal">Add</button>
        </div>
        <table class="table mt-4 table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Bus Number</th>
                    <th>Bus Passing Date</th>
                    <th>Bus Renew Passing Date</th>
                    <th>Bus Registration Document</th>
                    <th>Bus Insurance Document</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Include database connection
                    include_once("includes/db.php");

                    // Prepare an SQL statement
                    $stmt = $conn->prepare("SELECT * FROM buses");

                    // Execute the statement
                    $stmt->execute();

                    // Get the result
                    $result = $stmt->get_result();

                    // Check if there are any records
                    if ($result->num_rows > 0) {
                        // Loop through the records
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['bus_num'] . "</td>";
                            echo "<td>" . $row['start_date'] . "</td>";
                            echo "<td>" . $row['end_date'] . "</td>";
                            echo "<td class='text-center'><a href='uploads/buses/" . $row['registration'] . "' class='btn btn-primary' target='_blank'><i class='fas fa-file-pdf'></i></a></td>";
                            echo "<td class='text-center'><a href='uploads/buses/" . $row['insurance'] . "' class='btn btn-primary' target='_blank'><i class='fas fa-file-pdf'></i></a></td>";
                            echo "<td>";
                            echo "<div class='d-flex'>";
                            echo "<a href='#' class='btn btn-primary mr-2 editBtn' data-id='" . $row['id'] . "' data-toggle='modal' data-target='#editModal'><i class='fas fa-edit'></i></a>";
                            echo "<a href='#' class='btn btn-danger deleteBtn' data-id='" . $row['id'] . "' data-toggle='modal' data-target='#deleteModal'><i class='fas fa-trash'></i></a>";
                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' style='text-align:center'>No records found</td></tr>";
                    }

                    // Close the statement
                    $stmt->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- New Modal -->
    <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLable" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newModalLable">Manage Bus Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container h-100 d-flex justify-content-center align-items-center">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h1>Manage Bus Details</h1>
                            </div>
                            <form action="add_bus_details.php" method="post" class="col-12" id="addBusForm" enctype="multipart/form-data">
                                <div class="form-group col-12">
                                    <label for="busNumber">Bus Number:</label>
                                    <input type="text" class="form-control" id="busNumber" name="busNumber" required>
                                </div>
                                <div class="form-group col-12">
                                    <label for="passingDate">Passing Date:</label>
                                    <input type="date" class="form-control" id="passingDate" name="passingDate" required>
                                </div>
                                <div class="form-group col-12">
                                    <label for="renewPassingDate">Renew Passing Date:</label>
                                    <input type="date" class="form-control" id="renewPassingDate" name="renewPassingDate" required>
                                </div>
                                <div class="form-group col-12">
                                    <label for="registrationDocument">Registration Document:</label>
                                    <input type="file" class="form-control" id="registrationDocument" name="registrationDocument" required>
                                </div>
                                <div class="form-group col-12">
                                    <label for="insuranceDocument">Insurance Document:</label>
                                    <input type="file" class="form-control" id="insuranceDocument" name="insuranceDocument" required>
                                </div>
                                <div class="form-group text-center col-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLable" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLable">Manage Bus Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container h-100 d-flex justify-content-center align-items-center">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h1>Edit Bus Details</h1>
                            </div>
                            <form action="edit_bus_details.php" method="post" class="col-12" enctype="multipart/form-data">
                                <input type="hidden" id="editId" name="id">
                                <div class="form-group col-12">
                                    <label for="editBusNumber">Bus Number:</label>
                                    <input type="text" class="form-control" id="editBusNumber" name="busNumber" required>
                                </div>
                                <div class="form-group col-12">
                                    <label for="editPassingDate">Passing Date:</label>
                                    <input type="date" class="form-control" id="editPassingDate" name="passingDate" required>
                                </div>
                                <div class="form-group col-12">
                                    <label for="editRenewPassingDate">Renew Passing Date:</label>
                                    <input type="date" class="form-control" id="editRenewPassingDate" name="renewPassingDate" required>
                                </div>
                                <div class="form-group col-12">
                                    <label for="editRegistrationDocument">Registration Document:</label>
                                    <input type="file" class="form-control" id="editRegistrationDocument" name="registrationDocument">
                                </div>
                                <div class="form-group col-12">
                                    <label for="editInsuranceDocument">Insurance Document:</label>
                                    <input type="file" class="form-control" id="editInsuranceDocument" name="insuranceDocument">
                                </div>
                                <div class="form-group text-center col-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Bus Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="delete_bus_details.php" method="post">
                    <div class="modal-body">
                        Are you sure you want to delete this bus schedule?
                        <input type="hidden" id="deleteId" name="id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Add bus schedule script -->
    <script>
    document.getElementById("addBusForm").addEventListener('submit', function(event){
        event.preventDefault(); // Prevent the form from submitting via the browser
        var formData = new FormData(this);

        fetch('add_bus_details.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Display the returned data in console
            console.log(data);

            // You can also display a success message on your page
            alert("Data stored successfully");

            // Redirect to manage_bus_schedule.php
            window.location.href = 'manage_bus.php';
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    });
    </script>

    <!-- Update bus schedule script -->
    <script>
    document.querySelectorAll('.editBtn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var id = this.getAttribute('data-id');

            // Fetch the data for this id from the server
            fetch('fetch_bus_details.php?id=' + id)
                .then(response => response.json())
                .then(data => {
                    // Set the values of the modal fields
                    document.getElementById('editBusNumber').value = data.bus_num;
                    document.getElementById('editPassingDate').value = data.start_date;
                    document.getElementById('editRenewPassingDate').value = data.end_date;

                    // Set the id of the record to be updated
                    document.getElementById('editId').value = id;
                });
        });
    });
    </script>

    <!-- Delete bus schedule script -->
    <script>
    document.querySelectorAll('.deleteBtn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var id = this.getAttribute('data-id');

            // Set the id of the record to be deleted
            document.getElementById('deleteId').value = id;
        });
    });
    </script>
</body>
</html>