<?php
    // Include database connection
    include_once("includes/db.php");

    // Get the id from the URL
    $id = $_GET['id'];

    // Prepare an SQL statement for driver
    $stmt = $conn->prepare("SELECT * FROM drivers WHERE id = ?");

    // Bind parameters
    $stmt->bind_param("i", $id);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch the data
    $row = $result->fetch_assoc();

    // Convert the data to JSON and print it
    echo json_encode($row);

    // Close the statement
    $stmt->close();
?>