<?php
require_once("../database/db_connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $position = $_POST['position'];

    $query = "UPDATE members SET member_name=?, member_email=?, member_contact=?, member_address=?, member_position=? WHERE member_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssssi', $name, $email, $contact, $address, $position, $id);

    if ($stmt->execute()) {
        header('HTTP/1.1 200 OK');
        echo json_encode(['state' => 'success']);
    } else if ($stmt->errno == 1062) {
        header('HTTP/1.1 409 Conflict');
        echo json_encode(['state' => 'duplicate']);
    } else {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['state' => 'error']);
    }

    $stmt->close();
    $conn->close();
}
?>
