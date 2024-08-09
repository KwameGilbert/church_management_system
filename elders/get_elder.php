<?php
require_once("../database/db_connection.php");

$elder_id = $_GET['id'];

$query = "SELECT * FROM elders WHERE elder_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $elder_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $elder = $result->fetch_assoc();
    echo json_encode(['success' => true, 'elder' => $elder]);
} else {
    echo json_encode(['success' => false, 'message' => 'Elder not found']);
}

$stmt->close();
$conn->close();
?>
