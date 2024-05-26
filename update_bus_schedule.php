<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Include database connection
        include_once("includes/db.php");

        // Get form data
        $id = $_POST['id'];
        $from = $_POST['editFrom'];
        $to = $_POST['editTo'];
        $stops = $_POST['editStops'];
        $priceIncrease = $_POST['editPriceIncrease'];
        $driver = $_POST['editDriver'];
        $conductor = $_POST['editConductor'];
        $time = $_POST['editTime'];
        $date = $_POST['editDate'];
        $busNumber = $_POST['editBusNumber'];

        // Prepare an SQL statement
        $stmt = $conn->prepare("UPDATE bus_schedule SET from_location = ?, to_location = ?, stops = ?, price_increase = ?, driver = ?, conductor = ?, departure_time = ?, date = ?, bus_number = ? WHERE id = ?");

        // Check if the prepare was successful
        if ($stmt === false) {
            echo "Error: " . htmlspecialchars($conn->error);
            exit;
        }

        // Bind parameters
        $bind = $stmt->bind_param("sssdsssssi", $from, $to, $stops, $priceIncrease, $driver, $conductor, $time, $date, $busNumber, $id);

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
            header("Location: manage_bus_schedule.php?updated=true");
            exit;
        }
    }
?>