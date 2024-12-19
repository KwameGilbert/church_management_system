<?php
require_once("../database/db_connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $offertory_date = $_POST['offertory_date'];
    $amount = $_POST['amount'];
    $service_name = $_POST['service_name'];

    $stmt = $conn->prepare("INSERT INTO offertory(offertory_date, amount, service_name) VALUES(?, ?, ?)");
    $stmt->bind_param("sds", $offertory_date, $amount, $service_name);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Offertory added successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add offertory.']);
    }

    $stmt->close();
    $conn->close();
}
