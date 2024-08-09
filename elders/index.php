<!-- elders.php -->
<?php
require_once("../database/db_connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elders Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">Elders Management</h1>

    <!-- Add Elder Button -->
    <button class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4" id="addElderBtn">
        <i class="fas fa-plus"></i> Add Elder
    </button>

    <!-- Elders List -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-2">Image</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Position</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php
                $query = "SELECT e.elder_id, m.member_name, e.elder_position, e.elder_image 
                          FROM elders e 
                          JOIN members m ON e.member_id = m.member_id";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='border-b'>
                                <td class='px-4 py-2'>
                                    <img src='images/{$row['image']}' alt='{$row['member_name']}' class='h-16 w-16 object-cover rounded-full'>
                                </td>
                                <td class='px-4 py-2'>{$row['member_name']}</td>
                                <td class='px-4 py-2'>{$row['position']}</td>
                                <td class='px-4 py-2'>
                                    <button class='bg-green-500 text-white px-3 py-1 rounded-md editBtn' data-id='{$row['elder_id']}'>Edit</button>
                                    <button class='bg-red-500 text-white px-3 py-1 rounded-md deleteBtn' data-id='{$row['elder_id']}'>Delete</button>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center py-4'>No elders found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add/Edit Elder Modal -->
<div id="elderModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-1/3">
        <h2 id="modalTitle" class="text-xl font-bold mb-4">Add Elder</h2>
        <form id="elderForm" enctype="multipart/form-data">
            <input type="hidden" name="elder_id" id="elderId">

            <div class="mb-4">
                <label for="member_id" class="block text-sm font-medium text-gray-700">Member</label>
                <select id="member_id" 
                name="member_id" 
                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Select a Member</option>
                    <?php
                    $membersQuery = "SELECT member_id, member_name FROM members";
                    $membersResult = $conn->query($membersQuery);

                    if ($membersResult->num_rows > 0) {
                        while ($member = $membersResult->fetch_assoc()) {
                            echo "<option value='{$member['member_id']}'>{$member['member_name']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                <input type="text" id="position" name="position" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Upload Image</label>
                <input type="file" id="image" name="image" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <img id="imagePreview" class="mt-2 h-20 w-20 object-cover rounded-full" style="display:none;">
            </div>

            <div class="flex justify-end">
                <button type="button" id="cancelBtn" class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2">Cancel</button>
                <button type="submit" id="saveBtn" class="bg-blue-500 text-white px-4 py-2 rounded-md">Save</button>
            </div>
        </form>
    </div>
</div>

<script src="../js/scripts.js"></script>
<script>
</script>

</body>
</html>
