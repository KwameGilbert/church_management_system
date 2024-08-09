<?php
    session_start();

    if (!isset($_SESSION['pastor_id'])) {
        header("Location: ./login/");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Church Management System</title>
    <link href="./imports/tailwind.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./fontawesome/css/all.min.css">
   
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="./imports/sweetalert2.min.css">
    <style>

        /* Custom styles for transition */
        .transition-width {
            transition: width 0.3s;
        }

        .transition-margin {
            transition: margin-left 0.3s;
        }

        body {
            display: flex;
            min-height: 100vh;
            /* Ensure body takes the full height of the screen */
            overflow: hidden;
            /* Prevent scrolling on the entire body */
        }

        #sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            overflow-y: auto;
            /* Allow scrolling inside the sidebar if it overflows */
        }

        #content {
            margin-left: 16rem;
            /* Adjust this based on your sidebar width */
            flex: 1;
            overflow-y: auto;
            /* Enable scrolling for the content */
            padding: 1.5rem;
            /* Adjust based on your design */
            height: 100vh;
            box-sizing: border-box;
        }

        .transition-width {
            transition: width 0.3s, margin-left 0.3s;
        }
    </style>

    </style>
</head>

<body class="bg-gray-100 h-screen flex overflow-hidden">
    <!-- Sidebar -->
    <div id="sidebar" class="bg-gray-800 text-white w-64 transition-width">
        <div class="flex items-center justify-between p-4">
            <div id="churchIcon" class="text-2xl">
                <i class="fas fa-church"></i>
                <span id="sidebarTitle" class="ml-2">CMS</span>
            </div>
            <button id="hamburger" class="text-white focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
        <!-- Sidebar navigation -->
        <nav class="mt-5">
            <ul>
                <li class="px-4 py-2 hover:bg-gray-700 transition">
                    <a href="./dashboard/index.php" class="flex items-center sidebar-link"
                        data-page="./dashboard/index.php">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                </li>
                <li class="px-4 py-2 hover:bg-gray-700 transition">
                    <a href="./members/index.php" class="flex items-center sidebar-link" 
                        data-page="./members/index.php">
                        <i class="fas fa-users mr-3"></i>
                        <span class="sidebar-text">Members</span>
                    </a>
                </li>
                <li class="px-4 py-2 hover:bg-gray-700 transition">
                    <a href="./elders/index.php" class="flex items-center sidebar-link"
                    data-page="./elders/index.php">
                        <i class="fas fa-user-tie mr-3"></i>
                        <span class="sidebar-text">Elders</span>
                    </a>
                </li>
                <li class="px-4 py-2 hover:bg-gray-700 transition">
                    <a href="./offertories/index.php" class="flex items-center sidebar-link" 
                    data-page="./offertories/index.php">
                        <i class="fas fa-donate mr-3"></i>
                        <span class="sidebar-text">Offertory</span>
                    </a>
                </li>
                <li class="px-4 py-2 hover:bg-gray-700 transition">
                    <a href="./attendance/index.php" class="flex items-center sidebar-link" 
                    data-page="./attendance/index.php">
                        <i class="fas fa-calendar-check mr-3"></i>
                        <span class="sidebar-text">Attendance</span>
                    </a>
                </li>
            </ul>
        </nav>

 <a href="logout.php" class="flex items-center">
        <div class="absolute bottom-0 w-full">
            <li class="px-4 py-2 hover:bg-gray-700 transition">
                
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    <span class="sidebar-text">Logout</span>
               
            </li>
        </div>
    </div>
 </a>


    <!-- Main content -->
    <div id="content" class="transition-width overflow-y-auto h-screen">
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
    <!-- Dashboard content goes here -->

    </div>

<script src="./imports/sweetalert2@11.js"></script>
<script src="./imports/chart.js"></script>
<script src="./js/scripts.js"></script>


   
</body>

</ht