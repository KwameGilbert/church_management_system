
<?php

require_once("../database/db_connection.php");

// Fetch Total Members
$result = $conn->query("SELECT COUNT(*) as total_members FROM members");
$total_members = $result->fetch_assoc()['total_members'];

// Fetch Total Elders
$result = $conn->query("SELECT COUNT(*) as total_elders FROM elders");
$total_elders = $result->fetch_assoc()['total_elders'];

// Fetch Total Attendance For Last Service
$result = $conn->query("SELECT SUM(males_count + females_count + children_count) as total_attendance FROM attendance WHERE service_date = (SELECT MAX(service_date) FROM attendance)");
$last_service_attendance = $result->fetch_assoc()['total_attendance'];

// Fetch Total Offertory
$result = $conn->query("SELECT SUM(amount) as total_offertory FROM offertory");
$total_offertory = $result->fetch_assoc()['total_offertory'];

// Fetch Last 5 Members
$last_five_members = $conn->query("SELECT member_name, member_email, created_at FROM members ORDER BY created_at DESC LIMIT 5");

// Fetch offertory data for the current month
$offertoryData = [];
$offertoryQuery = "SELECT WEEK(offertory_date) as week, SUM(amount) as total FROM offertory WHERE MONTH(offertory_date) = MONTH(CURRENT_DATE()) GROUP BY WEEK(offertory_date)";
if ($result = $conn->query($offertoryQuery)) {
    while ($row = $result->fetch_assoc()) {
        $offertoryData[] = $row;
    }
    $result->free();
}

// Fetch attendance data for the current month
$attendanceData = [];
$attendanceQuery = "SELECT WEEK(service_date) as week, SUM(males_count + females_count + children_count) as total FROM attendance WHERE MONTH(service_date) = MONTH(CURRENT_DATE()) GROUP BY WEEK(service_date)";
if ($result = $conn->query($attendanceQuery)) {
    while ($row = $result->fetch_assoc()) {
        $attendanceData[] = $row;
    }
    $result->free();
}

// Close the connection
$conn->close();
?>



<!-- Dashboard Overview -->
<h1 class="text-2xl font-bold mb-6">Dashboard</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold">Total Members</h2>
        <p class="text-gray-700 text-3xl mt-2">
            <?php echo $total_members; ?>
        </p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold">Total Elders</h2>
        <p class="text-gray-700 text-3xl mt-2">
            <?php echo $total_elders; ?>
        </p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold">Attendance Last Service</h2>
        <p class="text-gray-700 text-3xl mt-2">
            <?php echo $last_service_attendance; ?>
    </p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold">Total Offertory</h2>
        <p class="text-gray-700 text-3xl mt-2">
        $<?php echo $total_offertory; ?>
        </p>
    </div>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Offertory This Month</h2>
        <canvas id="offertoryChart"></canvas>
    </div>
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Attendance This Month</h2>
        <canvas id="attendanceChart"></canvas>
    </div>
</div>

<!-- Last 5 Members Section -->
<div class="bg-white p-4 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4">Last 5 Members Added</h2>
    <table class="min-w-full table-auto">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Date Joined</th>
            </tr>
        </thead>
        <tbody>
                <?php while($row = $last_five_members->fetch_assoc()): ?>
                    <tr>
                        <td class="border px-4 py-2"><?php echo $row['member_name']; ?></td>
                        <td class="border px-4 py-2"><?php echo $row['member_email']; ?></td>
                        <td class="border px-4 py-2"><?php echo $row['created_at']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
    </table>
</div>


<script>
// Offertory data
const offertoryLabels = <?php echo json_encode(array_column($offertoryData, 'week')); ?>;
const offertoryValues = <?php echo json_encode(array_column($offertoryData, 'total')); ?>;

// Attendance data
const attendanceLabels = <?php echo json_encode(array_column($attendanceData, 'week')); ?>;
const attendanceValues = <?php echo json_encode(array_column($attendanceData, 'total')); ?>;

const offertoryCtx = document.getElementById('offertoryChart').getContext('2d');
const offertoryChart = new Chart(offertoryCtx, {
    type: 'line',
    data: {
        labels: offertoryLabels,
        datasets: [{
            label: 'Offertory',
            data: offertoryValues,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
    }
});

const attendanceCtx = document.getElementById('attendanceChart').getContext('2d');
const attendanceChart = new Chart(attendanceCtx, {
    type: 'line',
    data: {
        labels: attendanceLabels,
        datasets: [{
            label: 'Attendance',
            data: attendanceValues,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
    }
});
</script>