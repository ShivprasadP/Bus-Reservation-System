<?php
    // Include database connection
    include_once("includes/db.php");

    // Get the id from the form
    $id = $_POST['id'] ?? null;

    if ($id === null) {
        echo "Error: id is not set";
        exit;
    }

    // Get the old file names from the database
    $stmt = $conn->prepare("SELECT registration, insurance FROM buses WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $old_registration_file_name = $row['registration'];
    $old_insurance_file_name = $row['insurance'];

    // Define your upload path
    $upload_dir = "uploads/buses/";

    // Delete the old registration file
    if(file_exists($upload_dir . $old_registration_file_name)){
        unlink($upload_dir . $old_registration_file_name);
    }

    // Delete the old insurance file
    if(file_exists($upload_dir . $old_insurance_file_name)){
        unlink($upload_dir . $old_insurance_file_name);
    }

    // Prepare an SQL statement
    $stmt = $conn->prepare("DELETE FROM buses WHERE id = ?");

    if ($stmt === false) {
        echo "Error: " . htmlspecialchars($conn->error);
        exit;
    }

    // Bind parameters
    $stmt->bind_param("i", $id);

    // Execute the statement
    $exec = $stmt->execute();

    // Check if the execute was successful
    if ($exec === false) {
        echo "Error: " . htmlspecialchars($stmt->error);
        exit;
    } else {
        // Redirect to manage_bus.php and pass a query parameter
        header("Location: manage_bus.php?deleted=true");
        exit;
    }
?>