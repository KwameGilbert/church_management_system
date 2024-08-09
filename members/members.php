<?php
require_once("../database/db_connection.php");

// Search functionality
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch members data
$query = "SELECT * FROM members WHERE member_name LIKE ?";
$stmt = $conn->prepare($query);
$searchTerm = "%$search%";
$stmt->bind_param('s', $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Members - Church Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 p-6">
    <h1 class="text-2xl font-bold mb-4">Church Members</h1>

    <!-- Search and Add Member -->
    <div class="flex items-center justify-between mb-4">
        <input 
            type="text" 
            id="searchBar" 
            placeholder="Search by name" 
            class="p-2 border border-gray-300 rounded"
            value="<?php echo htmlspecialchars($search); ?>"
        />
        <button id="addMemberBtn" class="bg-blue-500 text-white p-2 rounded">Add Member</button>
    </div>

    <!-- Members Table -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="w-full table-auto">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Contact</th>
                    <th class="px-4 py-2">Address</th>
                    <th class="px-4 py-2">Position</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($row['member_name']); ?></td>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($row['member_email']); ?></td>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($row['member_contact']); ?></td>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($row['member_address']); ?></td>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($row['member_position']); ?></td>
                    <td class="border px-4 py-2">
                        <button 
                            class="bg-yellow-500 text-white px-2 py-1 rounded editBtn" 
                            data-id="<?php echo $row['member_id']; ?>"
                            data-name="<?php echo htmlspecialchars($row['member_name']); ?>"
                            data-email="<?php echo htmlspecialchars($row['member_email']); ?>"
                            data-contact="<?php echo htmlspecialchars($row['member_contact']); ?>"
                            data-address="<?php echo htmlspecialchars($row['member_address']); ?>"
                            data-position="<?php echo htmlspecialchars($row['member_position']); ?>"
                        >
                            Edit
                        </button>
                        <button 
                            class="bg-red-500 text-white px-2 py-1 rounded deleteBtn" 
                            data-id="<?php echo $row['member_id']; ?>"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Add Member Modal -->
    <div id="addMemberModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-md w-1/3">
            <h2 class="text-xl font-bold mb-4">Add New Member</h2>
            <form id="addMemberForm">
                <div class="mb-4">
                    <label class="block text-gray-700">Name</label>
                    <input type="text" id="memberName" class="p-2 border border-gray-300 rounded w-full" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Email</label>
                    <input type="email" id="memberEmail" class="p-2 border border-gray-300 rounded w-full" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Contact</label>
                    <input type="text" id="memberContact" class="p-2 border border-gray-300 rounded w-full" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Address</label>
                    <input type="text" id="memberAddress" class="p-2 border border-gray-300 rounded w-full" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Position</label>
                    <input type="text" id="memberPosition" class="p-2 border border-gray-300 rounded w-full" required />
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Member</button>
                <button type="button" id="closeAddMemberModal" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Close</button>
            </form>
        </div>
    </div>
    
    <!-- Edit Member Modal -->
    <div id="editMemberModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-md w-1/3">
            <h2 class="text-xl font-bold mb-4">Edit Member</h2>
            <form id="editMemberForm">
                <input type="hidden" id="editMemberId" />
                <div class="mb-4">
                    <label class="block text-gray-700">Name</label>
                    <input type="text" id="editMemberName" class="p-2 border border-gray-300 rounded w-full" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Email</label>
                    <input type="email" id="editMemberEmail" class="p-2 border border-gray-300 rounded w-full" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Contact</label>
                    <input type="text" id="editMemberContact" class="p-2 border border-gray-300 rounded w-full" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Address</label>
                    <input type="text" id="editMemberAddress" class="p-2 border border-gray-300 rounded w-full" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Position</label>
                    <input type="text" id="editMemberPosition" class="p-2 border border-gray-300 rounded w-full" required />
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Member</button>
                <button type="button" id="closeEditMemberModal" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Close</button>
            </form>
        </div>
    </div>

</body>
</html>
