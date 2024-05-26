<?php
// Include database connection
include_once("includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $bus_num = $_POST['bus_num'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $comments = $_POST['comments'];
    $date = date('Y-m-d'); // Current date
    $time = date('H:i'); // Current time

    // Prepare an SQL statement
    $stmt = $conn->prepare("INSERT INTO driver_feedback (fname, lname, bus_num, city, state, zip, comments, date, time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind the parameters
    $stmt->bind_param("sssssssss", $fname, $lname, $bus_num, $city, $state, $zip, $comments, $date, $time);

    // Execute the statement
    if ($stmt->execute()) {
        // Close the statement
        $stmt->close();

        // Redirect to the same page with a success message
        header("Location: driver feedback.php?success=1");
        exit;
    }

    // Close the statement
    $stmt->close();
}

// Prepare an SQL statement for fetching bus numbers
$stmt = $conn->prepare("SELECT bus_num FROM buses");

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();
?>