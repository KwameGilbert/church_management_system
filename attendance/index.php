<?php
require_once("../database/db_connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">
            <i class="fas fa-users mr-2"></i> Attendance Management
        </h1>

        <button id="addAttendanceBtn" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4">
            <i class="fas fa-plus-circle mr-2"></i> Add Attendance
        </button>

        <!-- Attendance List -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2"><i class="fas fa-heading"></i> Service Name</th>
                        <th class="px-4 py-2"><i class="fas fa-male"></i> Males</th>
                        <th class="px-4 py-2"><i class="fas fa-female"></i> Females</th>
                        <th class="px-4 py-2"><i class="fas fa-child"></i> Children</th>
                        <th class="px-4 py-2"><i class="fas fa-calendar-alt"></i> Service Date</th>
                        <th class="px-4 py-2"><i class="fas fa-cogs"></i> Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php
                    $query = "SELECT * FROM attendance ORDER BY service_date DESC";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='border-b'>
                                    <td class='px-4 py-2'>{$row['service_name']}</td>
                                    <td class='px-4 py-2'>{$row['males_count']}</td>
                                    <td class='px-4 py-2'>{$row['females_count']}</td>
                                    <td class='px-4 py-2'>{$row['children_count']}</td>
                                    <td class='px-4 py-2'>{$row['service_date']}</td>
                                    <td class='px-4 py-2'>
                                        <button class='bg-green-500 text-white px-3 py-1 rounded-md editBtn' data-id='{$row['attendance_id']}'>Edit</button>
                                        <button class='bg-red-500 text-white px-3 py-1 rounded-md deleteBtn' data-id='{$row['attendance_id']}'>Delete</button>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center py-4'>No attendance records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

<!-- Attendance Modal -->
<div id="attendanceModal" class="fixed inset-0 flex justify-center items-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg max-w-md w-full mx-4 sm:mx-0">
        <h2 id="modalTitle" class="text-2xl font-bold mb-4">Add Attendance</h2>
        <form id="attendanceForm">
            <input type="hidden" id="attendanceId" name="attendance_id">
            <div class="mb-4">
                <label class="block text-gray-700">Service Date</label>
                <input type="date" id="serviceDate" name="service_date" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Males Count</label>
                <input type="number" id="malesCount" name="males_count" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" value="0">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Females Count</label>
                <input type="number" id="femalesCount" name="females_count" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" value="0">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Children Count</label>
                <input type="number" id="childrenCount" name="children_count" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" value="0">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Service Name</label>
                <input type="text" id="serviceName" name="service_name" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div class="flex justify-end">
                <button type="button" id="cancelBtn" class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Save</button>
            </div>
        </form>
    </div>
</div>


    
</body>
</html>
