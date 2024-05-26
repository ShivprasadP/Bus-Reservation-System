<?php
include_once("includes/db.php");

$fromLocation = $_POST['from'] ?? null;
$toLocation = $_POST['to'] ?? null;

if ($fromLocation == 'Select Location' && $toLocation == 'Select Location') {
    $stmt = $conn->prepare("SELECT * FROM bus_schedule");
} else {
    $stmt = $conn->prepare("SELECT * FROM bus_schedule WHERE from_location = ? OR to_location = ?");
    $stmt->bind_param("ss", $fromLocation, $toLocation);
}

$stmt->execute();
$result = $stmt->get_result();
$schedules = $result->fetch_all(MYSQLI_ASSOC);

foreach ($schedules as $schedule) {
    echo '<tr>';
    echo '<td>' . $schedule['from_location'] . '</td>';
    echo '<td>' . $schedule['to_location'] . '</td>';
    echo '<td>' . $schedule['stops'] . '</td>';
    echo '<td>' . $schedule['departure_time'] . '</td>';
    echo '<td>' . $schedule['date'] . '</td>';
    echo '<td>' . $schedule['bus_number'] . '</td>';
    echo '</tr>';
}
?>