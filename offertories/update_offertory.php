<?php
require_once("../database/db_connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $offertory_id = $_POST['offertory_id'];
    $offertory_date = $_POST['offertory_date'];
    $amount = $_POST['amount'];
    $service_name = $_POST['service_name'];

    $stmt = $conn->prepare("UPDATE offertory SET offertory_date = ?, amount = ?, service_name = ? WHERE offertory_id = ?");
    $stmt->bind_param("sdsi", $offertory_date, $amount, $service_name, $offertory_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Offertory updated successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update offertory.']);
    }

    $stmt->close();
    $conn->close();
}
?>
