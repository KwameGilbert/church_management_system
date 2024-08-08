<?php
// Start the session
session_start();

// Include the database connection
require_once '../database/db_connection.php';

// Initialize an array to hold the response
$response = ['success' => false, 'message' => ''];

// Check if the request is an AJAX POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Sanitize input
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Basic validation
    if (empty($username) || empty($password)) {
        $response['message'] = 'Username and Password are required.';
        echo json_encode($response);
        exit;
    }

    // Prepare the SQL query
    $sql = "SELECT * FROM pastor_credentials WHERE username = ? LIMIT 1";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $user['password_hash'])) {
                $_SESSION['pastor_id'] = $user['pastor_id'];
                $_SESSION['username'] = $user['username'];

                // Set success response
                $response['success'] = true;
                $response['message'] = 'Login successful.';
            } else {
                $response['message'] = 'Invalid username or password.';
            }
        } else {
            $response['message'] = 'Invalid username or password.';
        }

        $stmt->close();
    } else {
        $response['message'] = 'Database error occurred.';
    }

    // Output the response as JSON
    echo json_encode($response);
    exit;
}

// Close the connection
$conn->close();
?>
