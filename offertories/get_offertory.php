<?php
require_once("../database/db_connection.php");

if (isset($_GET['id'])) {
    $offertory_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM offertory WHERE offertory_id = ?");
    $stmt->bind_param("i", $offertory_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $offertory = $result->fetch_assoc();

        echo json_encode(['success' => true, 'offertory' => $offertory]);
    } else {
        echo json_encode(['success' => false]);
    }

    $stmt->close();
    $conn->close();
}
?>
