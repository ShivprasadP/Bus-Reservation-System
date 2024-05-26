<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Include database connection
        include_once("includes/db.php");

        // Get form data
        $id = $_POST['editConductorsId'];
        $name = $_POST['editConductorName'];
        $phone_num = $_POST['editPhoneNumber'];
        $email = $_POST['editConductorEmail'];
        $address = $_POST['editConductorAddress'];

        // Handle file upload
        if(isset($_FILES['editAadharcardDocument'])){
            $file_name = $_FILES['editAadharcardDocument']['name'];
            $file_tmp =$_FILES['editAadharcardDocument']['tmp_name'];

            // Define your upload path
            $upload_dir = "uploads/conductors/";

            // Get the old file name from the database
            $stmt = $conn->prepare("SELECT aadhar_card FROM conductors WHERE id = ?");
            $stmt->bind_param("i", $id); 
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $old_file_name = $row['aadhar_card'];

            // Delete the old file
            if(file_exists($upload_dir . $old_file_name)){
                unlink($upload_dir . $old_file_name);
            }

            // Rename the uploaded file
            $aadharNewName = $id . '_aadhar.' . pathinfo($file_name, PATHINFO_EXTENSION);
            $aadharDestination = $upload_dir . $aadharNewName;

            // Move the uploaded file to the upload directory
            move_uploaded_file($file_tmp, $aadharDestination);

            // Use the new file name in the database
            $aadhar_card = $aadharNewName;
        } else {
            // If no file was uploaded, use the old aadhar_card value
            $aadhar_card = $_POST['editAadharcardDocument'];
        }

        // Prepare an SQL statement
        $stmt = $conn->prepare("UPDATE conductors SET name = ?, phone_num = ?, email = ?, address = ?, aadhar_card = ? WHERE id = ?");

        // Bind parameters
        $bind = $stmt->bind_param("sssssi", $name, $phone_num, $email, $address, $aadhar_card, $id);

        // Execute the statement
        $exec = $stmt->execute();

        // Check if the execute was successful
        if ($exec === false) {
            echo "Error: " . htmlspecialchars($stmt->error);
            exit;
        } else {
            header("Location: manage_conductors.php?updated=true");
            exit;
        }
    }
?>