<?php
require_once("../database/db_connection.php");

$elder_id = $_POST['elder_id'];

// Get the image filename before deleting the elder
$query = "SELECT elder_image FROM elders WHERE elder_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $elder_id);
$stmt->execute();
$stmt->bind_result($image);
$stmt->fetch();
$stmt->close();

// Delete the elder from the database
$deleteQuery = "DELETE FROM elders WHERE elder_id = ?";
$stmt = $conn->prepare($deleteQuery);
$stmt->bind_param('i', $elder_id);

if ($stmt->execute()) {
    // Delete the image file from the server
    $targetDir = "../images/";
    if (file_exists($targetDir . $image)) {
        unlink($targetDir . $image);
    }

    echo json_encode(['success' => true, 'message' => 'Elder deleted successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to delete elder.']);
}

$stmt->close();
$conn->close();
?>
