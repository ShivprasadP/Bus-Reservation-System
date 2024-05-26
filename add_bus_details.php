<?php
    // Start the session
    session_start();

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Include database connection
        include_once("includes/db.php");

        // Get form data
        $busNumber = $_POST['busNumber'];
        $passingDate = $_POST['passingDate'];
        $renewPassingDate = $_POST['renewPassingDate'];

        // Get file names
        $registrationDocument = $_FILES['registrationDocument']['name'];
        $insuranceDocument = $_FILES['insuranceDocument']['name'];

        // Rename files
        $newRegistrationDocument = $busNumber . '_registration.' . pathinfo($registrationDocument, PATHINFO_EXTENSION);
        $newInsuranceDocument = $busNumber . '_insurance.' . pathinfo($insuranceDocument, PATHINFO_EXTENSION);

        // Move uploaded files to target directory
        move_uploaded_file($_FILES['registrationDocument']['tmp_name'], "uploads/buses/" . $newRegistrationDocument);
        move_uploaded_file($_FILES['insuranceDocument']['tmp_name'], "uploads/buses/" . $newInsuranceDocument);

        // Check if busNumber already exists
        $stmt = $conn->prepare("SELECT * FROM buses WHERE bus_num = ?");
        $stmt->bind_param("s", $busNumber);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // busNumber already exists, set error message
            echo "Bus number already exists!";
            exit;
        } else {
            // Prepare an SQL statement
            $stmt = $conn->prepare("INSERT INTO buses (bus_num, start_date, end_date, registration, insurance) VALUES (?, ?, ?, ?, ?)");

            // Check if the prepare was successful
            if ($stmt === false) {
                echo "Error: " . htmlspecialchars($conn->error);
                exit;
            }

            // Bind parameters
            $bind = $stmt->bind_param("sssss", $busNumber, $passingDate, $renewPassingDate, $newRegistrationDocument, $newInsuranceDocument);

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
                // Set success message
                echo "Bus added successfully!";
                exit;
            }
        }
    }
?>