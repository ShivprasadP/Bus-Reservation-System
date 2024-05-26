<?php
    // Include database connection
    include_once("includes/db.php");

    // Get the id from the form
    $driverId = $_POST['deleteDriverId'] ?? null;

    if ($driverId === null) {
        echo "Error: id is not set";
        exit;
    }

    // Get the old file name from the database
    $stmt = $conn->prepare("SELECT license_file FROM drivers WHERE id = ?");
    $stmt->bind_param("i", $driverId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $old_file_name = $row['license_file'];

    // Define your upload path
    $upload_dir = "uploads/drivers/";

    // Delete the old file
    if(file_exists($upload_dir . $old_file_name)){
        unlink($upload_dir . $old_file_name);
    }

    // Prepare an SQL statement for deleting driver
    $stmtDriver = $conn->prepare("DELETE FROM drivers WHERE id = ?");

    if ($stmtDriver === false) {
        echo "Error: " . htmlspecialchars($conn->error);
        exit;
    }

    // Bind parameters
    $stmtDriver->bind_param("i", $driverId);

    // Execute the statement
    $execDriver = $stmtDriver->execute();

    // Check if the execute was successful
    if ($execDriver === false) {
        echo "Error: " . htmlspecialchars($stmtDriver->error);
        exit;
    } else {
        // Redirect to manage_drivers.php and pass a query parameter
        header("Location: manage_drivers.php?deleted=true");
        exit;
    }
?>