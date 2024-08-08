<?php
// Include the database connection
require_once '../database/db_connection.php';

header('Content-Type: application/json');

// Initialize the response array
$response = ['success' => false, 'message' => ''];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);
    $address = trim($_POST['address']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validate form data
    if (empty($name) || empty($email) || empty($contact) || empty($address) || empty($username) || empty($password) || empty($confirm_password)) {
        $response['message'] = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = 'Invalid email address.';
    } elseif ($password !== $confirm_password) {
        $response['message'] = 'Passwords do not match.';
    } else {
        // Check if the email or username already exists
        $stmt = $conn->prepare("SELECT pastor_id FROM pastors WHERE pastor_email = ? UNION SELECT pastor_id FROM pastor_credentials WHERE username = ?");
        $stmt->bind_param('ss', $email, $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $response['message'] = 'This email or username is already registered.';
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Insert the new pastor into the pastors table
            $stmt = $conn->prepare("INSERT INTO pastors (pastor_name, pastor_email, pastor_contact, pastor_address) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('ssss', $name, $email, $contact, $address);

            if ($stmt->execute()) {
                $pastor_id = $stmt->insert_id; // Get the inserted pastor's ID

                // Insert the credentials into the pastor_credentials table
                $stmt = $conn->prepare("INSERT INTO pastor_credentials (pastor_id, username, password_hash) VALUES (?, ?, ?)");
                $stmt->bind_param('iss', $pastor_id, $username, $hashed_password);

                if ($stmt->execute()) {
                    $response['success'] = true;
                    $response['message'] = 'Registration successful!';
                } else {
                    $response['message'] = 'Failed to save credentials. Please try again.';
                }
            } else {
                $response['message'] = 'Registration failed. Please try again.';
            }

            $stmt->close();
        }
    }
}

// Return the response as JSON
echo json_encode($response);

// Close the database connection
$conn->close();
?>
