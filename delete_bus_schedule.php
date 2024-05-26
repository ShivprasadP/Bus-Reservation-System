<?php
    // Include database connection
    include_once("includes/db.php");

    // Get the id from the form
    $id = $_POST['id'] ?? null;

    if ($id === null) {
        echo "Error: id is not set";
        exit;
    }

    // Prepare an SQL statement
    $stmt = $conn->prepare("DELETE FROM bus_schedule WHERE id = ?");

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
        // Redirect to manage_bus_schedule.php and pass a query parameter
        header("Location: manage_bus_schedule.php?deleted=true");
        exit;
    }
?>