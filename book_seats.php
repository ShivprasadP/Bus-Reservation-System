<?php
    session_start(); // Start the session

    include_once("includes/db.php");

    $userId = $_SESSION['user_id']; // Get user_id from session
    $selectedSeats = $_POST['selected_seats'];
    $pricePerSeat = $_POST['price_per_seat'];
    $total = str_replace('₹', '', $_POST['total']);
    $total = floatval($total);
    $date = $_POST['date'];
    $time = $_POST['time'];
    $busNumber = $_POST['bus_number'];
    $fromLocation = $_POST['from_location'];
    $toLocation = $_POST['to_location'];

    $stmt = $conn->prepare("INSERT INTO bookings (selected_seats, from_location, to_location, price_per_seat, total, date, time, bus_number, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $selectedSeats, $fromLocation, $toLocation, $pricePerSeat, $total, $date, $time, $busNumber, $userId);
    
    if ($stmt->execute()) {
        header("Location: seat_arrangment.php?booked=true");
        exit;
    } else {
        // Handle error here
        echo "Error: " . $stmt->error;
    }
?>