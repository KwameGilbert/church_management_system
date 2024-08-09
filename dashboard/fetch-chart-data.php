<?php

require_once("../database/db_connection.php");

// Fetch offertory data for the current month
$offertoryData = [];
$offertoryQuery = "SELECT WEEK(offertory_date) as week, SUM(amount) as total FROM offertory WHERE MONTH(offertory_date) = MONTH(CURRENT_DATE()) GROUP BY WEEK(offertory_date)";
if ($result = $conn->query($offertoryQuery)) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $offertoryData[] = $row;
        }
    }
    $result->free();
}

// Fetch attendance data for the current month
$attendanceData = [];
$attendanceQuery = "SELECT WEEK(service_date) as week, SUM(males_count + females_count + children_count) as total FROM attendance WHERE MONTH(service_date) = MONTH(CURRENT_DATE()) GROUP BY WEEK(service_date)";
if ($result = $conn->query($attendanceQuery)) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $attendanceData[] = $row;
        }
    }
    $result->free();
}

// Close the connection
$conn->close();

// Return data as JSON
header('Content-Type: application/json');
echo json_encode([
    'offertory' => $offertoryData,
    'attendance' => $attendanceData
]);
?>
