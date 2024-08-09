<?php
require_once("../database/db_connection.php");

$elder_id = $_POST['elder_id'];
$member_id = $_POST['member_id'];
$position = $_POST['position'];
$image = $_FILES['image'];

$memberNameQuery = "SELECT member_name FROM members WHERE member_id = ?";
$stmt = $conn->prepare($memberNameQuery);
$stmt->bind_param('i', $member_id);
$stmt->execute();
$stmt->bind_result($member_name);
$stmt->fetch();
$stmt->close();

$imageName = strtolower(str_replace(' ', '_', $member_name)) . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
$targetDir = "../images/";
$targetFile = $targetDir . basename($imageName);

// Check if a new image is uploaded
if ($image['size'] > 0) {
    // Delete the old image
    $query = "SELECT image FROM elders WHERE elder_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $elder_id);
    $stmt->execute();
    $stmt->bind_result($oldImage);
    $stmt->fetch();
    $stmt->close();

    if (file_exists($targetDir . $oldImage)) {
        unlink($targetDir . $oldImage);
    }

    // Upload the new image
    if (!move_uploaded_file($image['tmp_name'], $targetFile)) {
        echo json_encode(['success' => false, 'message' => 'Failed to upload new image.']);
        exit();
    }
} else {
    // Use the existing image name if no new image is uploaded
    $imageNameQuery = "SELECT image FROM elders WHERE elder_id = ?";
    $stmt = $conn->prepare($imageNameQuery);
    $stmt->bind_param('i', $elder_id);
    $stmt->execute();
    $stmt->bind_result($imageName);
    $stmt->fetch();
    $stmt->close();
}

$updateQuery = "UPDATE elders SET member_id = ?, position = ?, image = ? WHERE elder_id = ?";
$stmt = $conn->prepare($updateQuery);
$stmt->bind_param('issi', $member_id, $position, $imageName, $elder_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Elder updated successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update elder.']);
}

$stmt->close();
$conn->close();
?>
