<?php
require_once("../database/db_connection.php");

// Decode the JSON payload
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['offertory_id'])) {
    $offertory_id = $data['offertory_id'];

    $stmt = $conn->prepare("DELETE FROM offertory WHERE offertory_id = ?");
    $stmt->bind_param("i", $offertory_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Offertory deleted successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete offertory.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Offertory ID not provided.']);
}

$conn->close();
?>
