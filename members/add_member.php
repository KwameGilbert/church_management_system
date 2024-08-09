<?php
require_once("../database/db_connection.php");

// Check if the form data has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $position = $_POST['position'];

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO members (member_name, member_email, member_contact, member_address, member_position) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssss', $name, $email, $contact, $address, $position);

    // Execute the statement
    if ($stmt->execute()) {
        echo "success"; // Respond with success
    } else {
        echo "error"; // Respond with error
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
