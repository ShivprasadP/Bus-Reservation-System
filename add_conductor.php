<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Include database connection
        include_once("includes/db.php");

        // Get form data
        $name = $_POST['conductorName'];
        $phone_num = $_POST['phoneNumber'];
        $email = $_POST['conductorEmail'];
        $address = $_POST['conductorAddress'];
        $aadharCard = $_FILES['aadharcardDocument'];

        // Prepare an SQL statement
        $stmt = $conn->prepare("INSERT INTO conductors (name, phone_num, email, address, aadhar_card) VALUES (?, ?, ?, ?, ?)");

        // Check if the prepare was successful
        if ($stmt === false) {
            echo "Error: " . htmlspecialchars($conn->error);
            exit;
        }

        // Execute the statement
        $stmt->bind_param("sssss", $name, $phone_num, $email, $address, $aadharCard['name']);
        $stmt->execute();

        // Get the last inserted ID
        $conductorId = $conn->insert_id;

        // Rename the uploaded file with the conductor's ID
        $aadharCardNewName = $conductorId . '_aadharCard.' . pathinfo($aadharCard['name'], PATHINFO_EXTENSION);
        $aadharCardDestination = 'uploads/conductors/' . $aadharCardNewName;

        // Move the uploaded file to the uploads/conductors directory
        move_uploaded_file($aadharCard['tmp_name'], $aadharCardDestination);

        // Update the conductor's aadhar_card in the database
        $stmt = $conn->prepare("UPDATE conductors SET aadhar_card = ? WHERE id = ?");
        $stmt->bind_param("si", $aadharCardNewName, $conductorId);
        $stmt->execute();

        echo "New conductor record created successfully";

        // Close the statement
        $stmt->close();
    }
?>