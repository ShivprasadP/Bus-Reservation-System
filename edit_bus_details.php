<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Include database connection
        include_once("includes/db.php");

        // Get form data
        $id = $_POST['id'];
        $busNumber = $_POST['busNumber'];
        $passingDate = $_POST['passingDate'];
        $renewPassingDate = $_POST['renewPassingDate'];

        // Handle file upload for registration document
        if(isset($_FILES['registrationDocument'])){
            $file_name = $_FILES['registrationDocument']['name'];
            $file_tmp =$_FILES['registrationDocument']['tmp_name'];

            // Define your upload path
            $upload_dir = "uploads/buses/";

            // Get the old file name from the database
            $stmt = $conn->prepare("SELECT registration FROM buses WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $old_file_name = $row['registration'];

            // Delete the old file
            if(file_exists($upload_dir . $old_file_name)){
                unlink($upload_dir . $old_file_name);
            }

            // Rename the uploaded file
            $newRegistrationDocument = $busNumber . '_registration.' . pathinfo($file_name, PATHINFO_EXTENSION);
            $registrationDestination = $upload_dir . $newRegistrationDocument;
            // Move the uploaded file to the upload directory
            move_uploaded_file($file_tmp, $registrationDestination);
        }

        // Handle file upload for insurance document
        if(isset($_FILES['insuranceDocument'])){
            $file_name = $_FILES['insuranceDocument']['name'];
            $file_tmp =$_FILES['insuranceDocument']['tmp_name'];

            // Define your upload path
            $upload_dir = "uploads/buses/";

            // Get the old file name from the database
            $stmt = $conn->prepare("SELECT insurance FROM buses WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $old_file_name = $row['insurance'];

            // Delete the old file
            if(file_exists($upload_dir . $old_file_name)){
                unlink($upload_dir . $old_file_name);
            }

            // Rename the uploaded file
            $newInsuranceDocument = $busNumber . '_insurance.' . pathinfo($file_name, PATHINFO_EXTENSION);
            $insuranceDestination = $upload_dir . $newInsuranceDocument;
            // Move the uploaded file to the upload directory
            move_uploaded_file($file_tmp, $insuranceDestination);
        }

        // Prepare an SQL statement
        $stmt = $conn->prepare("UPDATE buses SET bus_num = ?, start_date = ?, end_date = ?, registration = ?, insurance = ? WHERE id = ?");

        // Bind parameters
        $bind = $stmt->bind_param("sssssi", $busNumber, $passingDate, $renewPassingDate, $newRegistrationDocument, $newInsuranceDocument, $id);

        // Execute the statement
        $exec = $stmt->execute();

        // Check if the execute was successful
        if ($exec === false) {
            echo "Error: " . htmlspecialchars($stmt->error);
            exit;
        } else {
            header("Location: manage_bus.php?updated=true");
            exit;
        }
    }
?>