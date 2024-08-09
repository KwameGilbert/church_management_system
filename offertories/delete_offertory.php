<?php
require_once("../database/db_connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $offertory_id = $_POST['offertory_id'];

    $stmt = $conn->prepare("DELETE FROM offertory WHERE offertory_id = ?");
    $stmt->bind_param("i", $offertory_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Offertory deleted successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete offertory.']);
    }

    $stmt->close();
    $conn->close();
}
?>
