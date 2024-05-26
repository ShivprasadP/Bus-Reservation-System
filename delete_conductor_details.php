<?php
    // Include database connection
    include_once("includes/db.php");

    // Get the id from the form
    $conductorId = $_POST['deleteConductorId'] ?? null;

    if ($conductorId === null) {
        echo "Error: id is not set";
        exit;
    }

    // Get the old file name from the database
    $stmt = $conn->prepare("SELECT aadhar_card FROM conductors WHERE id = ?");
    $stmt->bind_param("i", $conductorId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $old_file_name = $row['aadhar_card'];

    // Define your upload path
    $upload_dir = "uploads/conductors/";

    // Delete the old file
    if(file_exists($upload_dir . $old_file_name)){
        unlink($upload_dir . $old_file_name);
    }

    // Prepare an SQL statement for deleting conductor
    $stmtConductor = $conn->prepare("DELETE FROM conductors WHERE id = ?");

    if ($stmtConductor === false) {
        echo "Error: " . htmlspecialchars($conn->error);
        exit;
    }

    // Bind parameters
    $stmtConductor->bind_param("i", $conductorId);

    // Execute the statement
    $execConductor = $stmtConductor->execute();

    // Check if the execute was successful
    if ($execConductor === false) {
        echo "Error: " . htmlspecialchars($stmtConductor->error);
        exit;
    } else {
        // Redirect to manage_conductors.php and pass a query parameter
        header("Location: manage_conductors.php?deleted=true");
        exit;
    }
?>