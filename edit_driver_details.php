<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Include database connection
        include_once("includes/db.php");

        // Get form data
        $id = $_POST['editDriverId'];
        $name = $_POST['editDriverName'];
        $phone_num = $_POST['editPhoneNumber'];
        $email = $_POST['editDriverEmail'];
        $address = $_POST['editDriverAddress'];

        // Handle file upload
        if(isset($_FILES['editLicenseDocument'])){
            $file_name = $_FILES['editLicenseDocument']['name'];
            $file_tmp =$_FILES['editLicenseDocument']['tmp_name'];

            // Define your upload path
            $upload_dir = "uploads/drivers/";

            // Get the old file name from the database
            $stmt = $conn->prepare("SELECT license FROM drivers WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $old_file_name = $row['license'];

            // Delete the old file
            if(file_exists($upload_dir . $old_file_name)){
                unlink($upload_dir . $old_file_name);
            }

            // Rename the uploaded file
            $licenseNewName = $id . '_license.' . pathinfo($file_name, PATHINFO_EXTENSION);
            $licenseDestination = $upload_dir . $licenseNewName;
            // Move the uploaded file to the upload directory
            move_uploaded_file($file_tmp, $licenseDestination);

        }

        // Prepare an SQL statement
        $stmt = $conn->prepare("UPDATE drivers SET name = ?, phone_num = ?, email = ?, address = ? WHERE id = ?");

        // Bind parameters
        $bind = $stmt->bind_param("ssssi", $name, $phone_num, $email, $address, $id);

        // Execute the statement
        $exec = $stmt->execute();

        // Check if the execute was successful
        if ($exec === false) {
            echo "Error: " . htmlspecialchars($stmt->error);
            exit;
        } else {
            header("Location: manage_drivers.php?updated=true");
            exit;
        }
    }
?>