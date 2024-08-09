<?php
require_once("../database/db_connection.php");

$service_date = $_POST['service_date'];
$males_count = $_POST['males_count'];
$females_count = $_POST['females_count'];
$children_count = $_POST['children_count'];
$service_name = $_POST['service_name'];

$query = "INSERT INTO attendance (service_date, males_count, females_count, children_count, service_name) 
          VALUES ('$service_date', $males_count, $females_count, $children_count, '$service_name')";

if ($conn->query($query) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Attendance added successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
}
?>
