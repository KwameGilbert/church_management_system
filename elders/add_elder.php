<?php
include '../database/db_connection.php';

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

if (move_uploaded_file($image['tmp_name'], $targetFile)) {
    $query = "INSERT INTO elders (member_id, elder_position, elder_image) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iss', $member_id, $position, $imageName);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Elder added successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add elder.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to upload image.']);
}

$conn->close();
?>
