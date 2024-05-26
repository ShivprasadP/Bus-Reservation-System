<?php
// Include database connection
include_once("includes/db.php");

$feedbackType = $_POST['feedbackType'] ?? null;
$feedbacks = [];

if ($feedbackType && $feedbackType != 'select') {
    if ($feedbackType == 'busFeedback') {
        $stmt = $conn->prepare("SELECT * FROM bus_feedback");
    } elseif ($feedbackType == 'driverFeedback') {
        $stmt = $conn->prepare("SELECT * FROM driver_feedback");
    } elseif ($feedbackType == 'conductorFeedback') {
        $stmt = $conn->prepare("SELECT * FROM conductor_feedback");
    } else {
        echo "Invalid feedback type";
        exit;
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $feedbacks = $result->fetch_all(MYSQLI_ASSOC);
}
?>