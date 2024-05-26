<?php
    include_once("includes/db.php");

    $fromLocation = $_POST['from_location'];
    $toLocation = $_POST['to_location'];

    $stmt = $conn->prepare("SELECT bus_number, price_increase, stops, date, departure_time FROM bus_schedule WHERE (from_location = ? AND to_location = ?) OR (stops LIKE ? AND stops LIKE ?)");
    $fromLocationLike = '%' . $fromLocation . '%';
    $toLocationLike = '%' . $toLocation . '%';
    $stmt->bind_param("ssss", $fromLocation, $toLocation, $fromLocationLike, $toLocationLike);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $stops = explode(',', $row['stops']); // Assuming stops are comma-separated
        $numStops = count($stops);
        $row['num_stops'] = $numStops;
        echo json_encode($row);
    } else {
        echo 'No bus found for this route.';
    }
?>