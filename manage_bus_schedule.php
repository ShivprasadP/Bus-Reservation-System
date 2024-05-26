<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bus Schedule</title>
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
                window.location.href='manage_bus_schedule.php';
            </script>";
        }
        if (isset($_GET['deleted']) && $_GET['deleted'] == 'true') {
            echo "<script>
                alert('Record deleted successfully');
                window.location.href='manage_bus_schedule.php';
            </script>";
        }
    ?>
    
    <?php include 'navbar.php'; ?>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Bus Schedule</h2>
            <button type="button" class="btn btn-primary"n data-toggle="modal" data-target="#newModal">Add</button>
        </div>
        <table class="table mt-4 table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Bus Number</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Intermediate Stops</th>
                    <th>Departure Time</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Include database connection
                    include_once("includes/db.php");

                    // Prepare an SQL statement
                    $stmt = $conn->prepare("SELECT * FROM bus_schedule");

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
                            echo "<td>" . $row['bus_number'] . "</td>";
                            echo "<td>" . $row['from_location'] . "</td>";
                            echo "<td>" . $row['to_location'] . "</td>";
                            echo "<td>" . $row['stops'] . "</td>";
                            echo "<td>" . date('g:i A', strtotime($row['departure_time'])) . "</td>";
                            echo "<td>" . $row['date'] . "</td>";
                            echo "<td>";
                            echo "<div class='d-flex'>";
                            echo "<a href='#' class='btn btn-primary mr-2 editBtn' data-id='" . $row['id'] . "' data-toggle='modal' data-target='#editModal'><i class='fas fa-edit'></i></a>";
                            echo "<a href='#' class='btn btn-danger deleteBtn' data-id='" . $row['id'] . "' data-toggle='modal' data-target='#deleteModal'><i class='fas fa-trash'></i></a>";
                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' style='text-align:center'>No records found</td></tr>";
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
                    <h5 class="modal-title" id="newModalLable">Manage Bus Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container h-100 d-flex justify-content-center align-items-center">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h1>Manage Bus Schedule</h1>
                            </div>
                            <form action="add_bus_schedule.php" method="post" class="col-12" id="addBusForm">
                                <div class="form-group col-12">
                                    <label for="from">From:</label>
                                    <input type="text" class="form-control" id="from" name="from">
                                </div>
                                <div class="form-group col-12">
                                    <label for="to">To:</label>
                                    <input type="text" class="form-control" id="to" name="to">
                                </div>
                                <div class="form-group col-12">
                                    <label for="stops">Intermediate Stops: [Separete each stop by comma (,)]</label>
                                    <textarea class="form-control" id="stops" name="stops"></textarea>
                                </div>
                                <div class="form-group col-12">
                                    <label for="priceIncrease">Ticket Price Increase Per Stop:</label>
                                    <input type="number" class="form-control" id="priceIncrease" name="priceIncrease">
                                </div>
                                <div class="form-group col-12">
                                    <label for="driver">Driver:</label>
                                    <select class="form-control" id="driver" name="driver">
                                        <?php
                                            // Include database connection
                                            include_once("includes/db.php");

                                            // Prepare an SQL statement
                                            $stmt = $conn->prepare("SELECT name FROM drivers");

                                            // Execute the statement
                                            $stmt->execute();

                                            // Get the result
                                            $result = $stmt->get_result();

                                            // Check if any rows were fetched
                                            if ($result->num_rows > 0) {
                                                // Fetch all rows and output them as options
                                                echo "<option>Choose a driver</option>";
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option>" . $row['name'] . "</option>";
                                                }
                                            } else {
                                                // No rows were fetched, output "No driver found"
                                                echo "<option>No driver found</option>";
                                            }

                                            // Close the statement
                                            $stmt->close();
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <label for="conductor">Conductor:</label>
                                    <select class="form-control" id="conductor" name="conductor">
                                        <?php
                                            // Include database connection
                                            include_once("includes/db.php");

                                            // Prepare an SQL statement
                                            $stmt = $conn->prepare("SELECT name FROM conductors");

                                            // Execute the statement
                                            $stmt->execute();

                                            // Get the result
                                            $result = $stmt->get_result();

                                            // Check if any rows were fetched
                                            if ($result->num_rows > 0) {
                                                // Fetch all rows and output them as options
                                                echo "<option>Choose a conductor</option>";
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option>" . $row['name'] . "</option>";
                                                }
                                            } else {
                                                // No rows were fetched, output "No conductor found"
                                                echo "<option>No conductor found</option>";
                                            }

                                            // Close the statement
                                            $stmt->close();
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <label for="time">Departure Time:</label>
                                    <input type="time" class="form-control" id="time" name="time">
                                </div>
                                <div class="form-group col-12">
                                    <label for="date">Date:</label>
                                    <input type="date" class="form-control" id="date" name="date">
                                </div>
                                <div class="form-group col-12">
                                    <label for="busNumber">Bus Number:</label>
                                    <select class="form-control" id="busNumber" name="busNumber">
                                        <?php
                                            // Include database connection
                                            include_once("includes/db.php");

                                            // Prepare an SQL statement
                                            $stmt = $conn->prepare("SELECT bus_num FROM buses");

                                            // Execute the statement
                                            $stmt->execute();

                                            // Get the result
                                            $result = $stmt->get_result();

                                            // Check if any rows were fetched
                                            if ($result->num_rows > 0) {
                                                // Fetch all rows and output them as options
                                                echo "<option>Choose a bus number</option>";
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option>" . $row['bus_num'] . "</option>";
                                                }
                                            } else {
                                                // No rows were fetched, output "No Bus found"
                                                echo "<option>No Bus found</option>";
                                            }

                                            // Close the statement
                                            $stmt->close();
                                        ?>
                                    </select>
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
                    <h5 class="modal-title" id="editModalLable">Manage Bus Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container h-100 d-flex justify-content-center align-items-center">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h1>Edit Bus Schedule</h1>
                            </div>
                            <form action="update_bus_schedule.php" method="post" class="col-12">
                                <input type="hidden" id="editId" name="id">
                                <div class="form-group col-12">
                                    <label for="editFrom">From:</label>
                                    <input type="text" class="form-control" id="editFrom" name="editFrom">
                                </div>
                                <div class="form-group col-12">
                                    <label for="editTo">To:</label>
                                    <input type="text" class="form-control" id="editTo" name="editTo">
                                </div>
                                <div class="form-group col-12">
                                    <label for="editStops">Intermediate Stops: [Separete each stop by comma (,)]</label>
                                    <textarea class="form-control" id="editStops" name="editStops"></textarea>
                                </div>
                                <div class="form-group col-12">
                                    <label for="editPriceIncrease">Ticket Price Increase Per Stop:</label>
                                    <input type="number" class="form-control" id="editPriceIncrease" name="editPriceIncrease">
                                </div>
                                <div class="form-group col-12">
                                    <label for="editDriver">Driver:</label>
                                    <select class="form-control" id="editDriver" name="editDriver">
                                        <option>Driver 1</option>
                                        <option>Driver 2</option>
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <label for="editConductor">Conductor:</label>
                                    <select class="form-control" id="editConductor" name="editConductor">
                                        <option>Conductor 1</option>
                                        <option>Conductor 2</option>
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <label for="editTime">Departure Time:</label>
                                    <input type="time" class="form-control" id="editTime" name="editTime">
                                </div>
                                <div class="form-group col-12">
                                    <label for="ediDtate">Date:</label>
                                    <input type="date" class="form-control" id="editDate" name="editDate">
                                </div>
                                <div class="form-group col-12">
                                    <label for="editBusNumber">Bus Number:</label>
                                    <input type="text" class="form-control" id="editBusNumber" name="editBusNumber">
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
                <form action="delete_bus_schedule.php" method="post">
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

        fetch('add_bus_schedule.php', {
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
            window.location.href = 'manage_bus_schedule.php';
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
            fetch('get_bus_schedule.php?id=' + id)
                .then(response => response.json())
                .then(data => {
                    // Set the values of the modal fields
                    document.getElementById('editFrom').value = data.from_location;
                    document.getElementById('editTo').value = data.to_location;
                    document.getElementById('editStops').value = data.stops;
                    document.getElementById('editPriceIncrease').value = data.price_increase;
                    document.getElementById('editDriver').value = data.driver;
                    document.getElementById('editConductor').value = data.conductor;
                    document.getElementById('editTime').value = data.departure_time;
                    document.getElementById('editDate').value = data.date;
                    document.getElementById('editBusNumber').value = data.bus_number;

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