<?php
// Define the database credentials
$host = 'sql307.infinityfree.com';       // The hostname of the database server
$dbname = 'if0_36702081_church_db';     // The name of the database you are connecting to
$username = 'if0_36702081';        // Your database username
$password = '9h7DhdmRJq';            // Your database password

// Establish a connection to the MySQL database using MySQLi
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Optionally, you can set the character set to UTF-8 for better handling of special characters
$conn->set_charset('utf8');
?>
