<?php require_once("../database/db_connection.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Offertories</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Manage Offertories</h1>
        <button id="addOffertoryBtn" class="bg-blue-500 text-white px-4 py-2 rounded-md">Add Offertory</button>
    </div>

    <!-- Offertory List -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-2">Service Name</th>
                    <th class="px-4 py-2">Amount</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php
                $query = "SELECT * FROM offertory ORDER BY offertory_id DESC";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='border-b'>
                                <td class='px-4 py-2'>{$row['service_name']}</td>
                                <td class='px-4 py-2'>¢{$row['amount']}</td>
                                <td class='px-4 py-2'>{$row['offertory_date']}</td>
                                <td class='px-4 py-2'>
                                    <button class='bg-green-500 text-white px-3 py-1 rounded-md editBtn' data-id='{$row['offertory_id']}'>Edit</button>
                                    <button class='bg-red-500 text-white px-3 py-1 rounded-md deleteBtn' data-id='{$row['offertory_id']}'>Delete</button>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center py-4'>No offertories found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add/Edit Offertory Modal -->
<div id="offertoryModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg p-8 max-w-lg w-full">
            <h2 id="modalTitle" class="text-2xl font-bold mb-4">Add Offertory</h2>
            <form id="offertoryForm">
                <input type="hidden" id="offertoryId" name="offertory_id">

                <div class="mb-4">
                    <label for="offertoryDate" class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="date" id="offertoryDate" name="offertory_date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                    <input type="number" id="amount" name="amount" required step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="serviceName" class="block text-sm font-medium text-gray-700">Service Name</label>
                    <input type="text" id="serviceName" name="service_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="flex justify-end">
                    <button type="button" id="cancelBtn" class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        initializeOffertoryScripts();
    });

   
</script>

</body>
</html>
