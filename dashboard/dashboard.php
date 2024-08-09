<!--dashboard.php -->
<!-- Dashboard Overview -->
<h1 class="text-2xl font-bold mb-6">Dashboard</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold">Total Members</h2>
        <p class="text-gray-700 text-3xl mt-2">123</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold">Total Elders</h2>
        <p class="text-gray-700 text-3xl mt-2">10</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold">Attendance Last Service</h2>
        <p class="text-gray-700 text-3xl mt-2">95</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold">Total Offertory</h2>
        <p class="text-gray-700 text-3xl mt-2">$450</p>
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
            <tr>
                <td class="border px-4 py-2">John Doe</td>
                <td class="border px-4 py-2">johndoe@example.com</td>
                <td class="border px-4 py-2">2024-08-01</td>
            </tr>
            <tr>
                <td class="border px-4 py-2">Jane Smith</td>
                <td class="border px-4 py-2">janesmith@example.com</td>
                <td class="border px-4 py-2">2024-07-29</td>
            </tr>
            <tr>
                <td class="border px-4 py-2">Jane Smith</td>
                <td class="border px-4 py-2">janesmith@example.com</td>
                <td class="border px-4 py-2">2024-07-29</td>
            </tr>
            <tr>
                <td class="border px-4 py-2">Jane Smith</td>
                <td class="border px-4 py-2">janesmith@example.com</td>
                <td class="border px-4 py-2">2024-07-29</td>
            </tr>
            <tr>
                <td class="border px-4 py-2">Jane Smith</td>
                <td class="border px-4 py-2">janesmith@example.com</td>
                <td class="border px-4 py-2">2024-07-29</td>
            </tr>
            <!-- Add more rows as necessary -->
        </tbody>
    </table>
</div>

<script>
        // Offertory Chart
        const offertoryCtx = document.getElementById('offertoryChart').getContext('2d');
        const offertoryChart = new Chart(offertoryCtx, {
            type: 'line', // or 'bar', 'pie', etc.
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [{
                    label: 'Offertory',
                    data: [100, 150, 200, 450],
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

        // Attendance Chart
        const attendanceCtx = document.getElementById('attendanceChart').getContext('2d');
        const attendanceChart = new Chart(attendanceCtx, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [{
                    label: 'Attendance',
                    data: [80, 85, 90, 95],
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