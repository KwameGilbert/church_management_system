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
        echo 'Success';
    } else {
        echo 'Error';
    }

    $stmt->close();
    $conn->close();
}
?>
