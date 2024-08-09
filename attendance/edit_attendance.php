<?php
require_once("../database/db_connection.php");

$attendance_id = $_POST['attendance_id'];
$service_date = $_POST['service_date'];
$males_count = $_POST['males_count'];
$females_count = $_POST['females_count'];
$children_count = $_POST['children_count'];
$service_name = $_POST['service_name'];

$query = "UPDATE attendance SET service_date='$service_date', males_count=$males_count, females_count=$females_count,
          children_count=$children_count, service_name='$service_name' WHERE attendance_id=$attendance_id";

if ($conn->query($query) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Attendance updated successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
}
?>
