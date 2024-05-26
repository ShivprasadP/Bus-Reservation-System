<?php
    include_once("includes/db.php");

    $stmt = $conn->prepare("SELECT selected_seats FROM bookings WHERE bus_number = ?");
    $stmt->bind_param("s", $_GET['bus_number']);
    $stmt->execute();
    $result = $stmt->get_result();
    $bookedSeats = $result->fetch_all(MYSQLI_ASSOC);

    $bookedSeatsArray = [];
    foreach ($bookedSeats as $bookedSeat) {
        $seats = explode(',', $bookedSeat['selected_seats']);
        foreach ($seats as $seat) {
            $bookedSeatsArray[] = trim($seat);
        }
    }

    echo json_encode($bookedSeatsArray);
?>