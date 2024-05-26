<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Include database connection
        include_once("includes/db.php");

        // Get form data
        $name = $_POST['driverName'];
        $phone_num = $_POST['phoneNumber'];
        $email = $_POST['driverEmail'];
        $address = $_POST['driverAddress'];
        $license = $_FILES['licenseDocument'];

        // Prepare an SQL statement
        $stmt = $conn->prepare("INSERT INTO drivers (name, phone_num, email, address, license) VALUES (?, ?, ?, ?, ?)");

        // Check if the prepare was successful
        if ($stmt === false) {
            echo "Error: " . htmlspecialchars($conn->error);
            exit;
        }

        // Execute the statement
        $stmt->bind_param("sssss", $name, $phone_num, $email, $address, $license['name']);
        $stmt->execute();

        // Get the last inserted ID
        $driverId = $conn->insert_id;

        // Rename the uploaded file with the driver's ID
        $licenseNewName = $driverId . '_license.' . pathinfo($license['name'], PATHINFO_EXTENSION);
        $licenseDestination = 'uploads/drivers/' . $licenseNewName;

        // Move the uploaded file to the uploads/drivers directory
        move_uploaded_file($license['tmp_name'], $licenseDestination);

        // Update the driver's license in the database
        $stmt = $conn->prepare("UPDATE drivers SET license = ? WHERE id = ?");
        $stmt->bind_param("si", $licenseNewName, $driverId);
        $stmt->execute();

        echo "New driver record created successfully";

        // Close the statement
        $stmt->close();
    }
?>