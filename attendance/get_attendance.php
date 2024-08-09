<?php
require_once("../database/db_connection.php");

$attendance_id = $_GET['id'];

$query = "SELECT * FROM attendance WHERE attendance_id=$attendance_id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $attendance = $result->fetch_assoc();
    echo json_encode(['success' => true, 'attendance' => $attendance]);
} else {
    echo json_encode(['success' => false, 'message' => 'Attendance not found.']);
}
?>
