<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Drivers</title>
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
                window.location.href='manage_drivers.php';
            </script>";
        }
        if (isset($_GET['deleted']) && $_GET['deleted'] == 'true') {
            echo "<script>
                alert('Record deleted successfully');
                window.location.href='manage_drivers.php';
            </script>";
        }
    ?>
        <?php include 'navbar.php'; ?>

        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Driver Details</h2>
                <button type="button" class="btn btn-primary"n data-toggle="modal" data-target="#newModal">Add</button>
            </div>
            <table class="table mt-4 table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Driver Name</th>
                        <th>Phone Number</th>
                        <th>Email ID</th>
                        <th>Address</th>
                        <th>Driver License</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php
                    // Include database connection
                    include_once("includes/db.php");

                    // Prepare an SQL statement
                    $stmt = $conn->prepare("SELECT * FROM drivers");

                    // Execute the statement
                    $stmt->execute();

                    // Get the result
                    $result = $stmt->get_result();

                    // Check if there are any rows
                    if ($result->num_rows > 0) {
                        // Fetch all rows and display them in the table
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['phone_num'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['address'] . "</td>";
                            echo "<td class='text-center'><a href='uploads/drivers/" . $row['license'] . "' class='btn btn-primary' target='_blank'><i class='fas fa-file-pdf'></i></a></td>";
                            echo "<td>
                                    <div class='d-flex'>
                                        <a href='#' class='btn btn-primary mr-2 editDriverBtn' data-id='" . $row['id'] . "' data-toggle='modal' data-target='#editModal'><i class='fas fa-edit'></i></a>
                                        <a href='#' class='btn btn-danger deleteBtn' data-id='" . $row['id'] . "' data-toggle='modal' data-target='#deleteModal'><i class='fas fa-trash'></i></a>
                                    </div>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        // No data found
                        echo "<tr>";
                        echo "<td colspan='7' class='text-center'>No data found</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </div>

        <!-- New Modal -->
        <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newModalLabel">Add Driver</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container h-100 d-flex justify-content-center align-items-center">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h1>Add Driver Details</h1> 
                                </div>
                                <form action="add_driver_details.php" method="post"  id="addDriverForm" class="col-12" enctype="multipart/form-data">
                                    <div class="form-group col-12">
                                        <label for="driverName">Driver Name:</label>
                                        <input type="text" class="form-control" id="driverName" name="driverName">
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="phoneNumber">Phone Number:</label>
                                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber">
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="driverEmail">Email ID:</label>
                                        <input type="email" class="form-control" id="driverEmail" name="driverEmail">
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="driverAddress">Address:</label>
                                        <textarea class="form-control" id="driverAddress" name="driverAddress"></textarea>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="licenseDocument">License Document:</label>
                                        <input type="file" class="form-control" id="licenseDocument" name="licenseDocument">
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
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Driver Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container h-100 d-flex justify-content-center align-items-center">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h1>Edit Driver Details</h1>
                                </div>
                                <form action="edit_driver_details.php" method="post" class="col-12" enctype="multipart/form-data">
                                    <input type="hidden" id="editDriverId" name="editDriverId">
                                    <div class="form-group col-12">
                                        <label for="editDriverName">Driver Name:</label>
                                        <input type="text" class="form-control" id="editDriverName" name="editDriverName">
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="editPhoneNumber">Phone Number:</label>
                                        <input type="text" class="form-control" id="editPhoneNumber" name="editPhoneNumber">
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="editDriverEmail">Email ID:</label>
                                        <input type="email" class="form-control" id="editDriverEmail" name="editDriverEmail">
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="editDriverAddress">Address:</label>
                                        <textarea class="form-control" id="editDriverAddress" name="editDriverAddress"></textarea>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="editLicenseDocument">License Document:</label>
                                        <input type="file" class="form-control" id="editLicenseDocument" name="editLicenseDocument">
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
                        <h5 class="modal-title" id="deleteModalLabel">Delete Driver Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="delete_driver_details.php" method="post">
                        <input type="hidden" id="deleteDriverId" name="deleteDriverId">
                        <div class="modal-body">
                            Are you sure you want to delete this driver's details?
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

        <!-- Add driver script -->
        <script>
        document.getElementById("addDriverForm").addEventListener('submit', function(event){
            event.preventDefault(); // Prevent the form from submitting via the browser
            var formData = new FormData(this);

            fetch('add_driver.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Display the returned data in console
                console.log(data);

                // You can also display a success message on your page
                alert("Driver data stored successfully");

                // Redirect to manage_driver.php
                window.location.href = 'manage_drivers.php';
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        });
        </script>

        <!-- Update driver script -->
        <script>
        document.querySelectorAll('.editDriverBtn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var id = this.getAttribute('data-id');

                // Fetch the data for this id from the server
                fetch('get_driver.php?id=' + id)
                    .then(response => response.json())
                    .then(data => {
                        // Set the values of the modal fields
                        document.getElementById('editDriverName').value = data.name;
                        document.getElementById('editPhoneNumber').value = data.phone_num;
                        document.getElementById('editDriverEmail').value = data.email;
                        document.getElementById('editDriverAddress').value = data.address;

                        // Set the id of the record to be updated
                        document.getElementById('editDriverId').value = id;
                    });
            });
        });
        </script>

        <!-- Delete driver script -->
        <script>
        document.querySelectorAll('.deleteBtn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var id = this.getAttribute('data-id');

                // Set the id of the record to be deleted
                document.getElementById('deleteDriverId').value = id;
            });
        });
        </script>
</body>
</html>