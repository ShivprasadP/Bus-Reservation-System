<?php
require('includes/fpdf186/fpdf.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session
}

include_once("includes/db.php");

$bookingId = $_GET['booking_id']; // Get booking id from URL

$stmt = $conn->prepare("SELECT * FROM bookings WHERE id = ?");
$stmt->bind_param("s", $bookingId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $booking = $result->fetch_assoc();

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);

    $pdf->Cell(40,10,"Selected Seats: {$booking['selected_seats']}");
    $pdf->Ln();
    $pdf->Cell(40,10,"From Location: {$booking['from_location']}");
    $pdf->Ln();
    $pdf->Cell(40,10,"To Location: {$booking['to_location']}");
    $pdf->Ln();
    $pdf->Cell(40,10,"Price Per Seat: {$booking['price_per_seat']}");
    $pdf->Ln();
    $pdf->Cell(40,10,"Total: {$booking['total']}");
    $pdf->Ln();
    $pdf->Cell(40,10,"Date: {$booking['date']}");
    $pdf->Ln();
    $pdf->Cell(40,10,"Time: {$booking['time']}");
    $pdf->Ln();
    $pdf->Cell(40,10,"Bus Number: {$booking['bus_number']}");
    $pdf->Ln();

    $pdf->Output();
} else {
    echo 'No booking found.';
}
?>