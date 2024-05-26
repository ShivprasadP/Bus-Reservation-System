<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Include database connection
        include_once("includes/db.php");

        // Get form data
        $from = $_POST['from'];
        $to = $_POST['to'];
        $stops = $_POST['stops'];
        $priceIncrease = $_POST['priceIncrease'];
        $driver = $_POST['driver'];
        $conductor = $_POST['conductor'];
        $time = $_POST['time'];
        $date = $_POST['date'];
        $busNumber = $_POST['busNumber'];

        // Prepare an SQL statement
        $stmt = $conn->prepare("INSERT INTO bus_schedule (from_location, to_location, stops, price_increase, driver, conductor, departure_time, date, bus_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Check if the prepare was successful
        if ($stmt === false) {
            echo "Error: " . htmlspecialchars($conn->error);
            exit;
        }

        // Bind parameters
        $bind = $stmt->bind_param("sssdsssss", $from, $to, $stops, $priceIncrease, $driver, $conductor, $time, $date, $busNumber);

        // Check if the bind was successful
        if ($bind === false) {
            echo "Error: " . htmlspecialchars($stmt->error);
            exit;
        }

        // Execute the statement
        $exec = $stmt->execute();

        // Check if the execute was successful
        if ($exec === false) {
            echo "Error: " . htmlspecialchars($stmt->error);
            exit;
        } else {
            echo "New record created successfully";
        }

        // Close the statement
        $stmt->close();
    }
?>