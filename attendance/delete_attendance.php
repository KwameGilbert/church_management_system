<?php
require_once("../database/db_connection.php");

$attendance_id = $_POST['id'];

$query = "DELETE FROM attendance WHERE attendance_id=$attendance_id";

if ($conn->query($query) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Attendance deleted successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
}
?>
