<?php
require_once("../database/db_connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $query = "DELETE FROM members WHERE member_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        echo 'Success';
    } else {
        echo 'Error';
    }

    $stmt->close();
    $conn->close();
}
?>
