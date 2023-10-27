<?php
session_start();

// Redirect users who aren't logged in back to the login page.
if (!isset($_SESSION['loggedInUser'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Historical Data</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="historicaldata.css">
    <link rel="stylesheet" href="testside.css">
</head>

<body>
<nav class="side-menu">
    <div class="menu-header">
        <!-- Logo and Menu Name -->
        <div class="logo-and-name">
            <div class="logo">
                <img src="images/RE - Logo.png" alt="Your Logo">
            </div>
            <div class="menu-name">
                Reactive Energy
            </div>
        </div>
    </div>
    
    <ul>
            <li><a href="maps.php"><i class="fas fa-home"></i> <span data-i18n="home">Home</span></a></li>
            <li><a href="dashboard.php"><i class="fas fa-th-large"></i> Dashboard</a></li>
            <li  class="active"><a href="historicaldata.php"><i class="fas fa-chart-line"></i> Historical Data</a></li>
            <li><a href="reportanalysis.php"><i class="fas fa-chart-pie"></i> Analytic Data</a></li>
            <li>
                <a href="#"><i class="fas fa-cogs"></i> Management</a>
            <ul class="submenu-content">
                <li><a href="devicemanagement.php"><i class="fas fa-tachometer-alt"></i> Device Management</a></li>
                <li  class="active"><a href="addplace.php"><i class="fas fa-map-marked-alt"></i> Add New Place </a></li>
                <li><a href="companymanagement.php"><i class="fas fa-building"></i> Company Management</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fas fa-bell"></i> Alarm</a>
                <ul class="submenu-content">
                    <li><a href="alarmactive.php"><i class="fas fa-bell"></i> Alarm Active</a></li>
                    <li><a href="alarmhistorical.php"><i class="fas fa-history"></i> Alarm Historical</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fas fa-cog"></i> System Setting</a>
                <ul class="submenu-content">
                    <li><a href="changepassword.php"><i class="fas fa-user-cog"></i> Password Setting</a></li>
                    <!--<li><a href="#"><i class="fas fa-trash"></i> Delete Account</a></li>-->
                </ul>
            </li>
            <li>
                <a href="#"><i class="fas fa-info-circle"></i> About Us</a>
                <ul class="submenu-content">
                    <li><a href="#"><i class="fas fa-shield-alt"></i> Privacy Policy</a></li>
                    <li><a href="#"><i class="fas fa-file-alt"></i> Term of Use</a></li>
                    <li><a href="#"><i class="fas fa-code"></i> Version Information</a></li>
                    <li><a href="#"><i class="fas fa-envelope"></i> Contact Us</a></li>
                </ul>
            </li>
        </ul>
        <!-- User Profile Section -->
        <div class="user-profile">
            <div class="user-info">
                <img src="images/user4.png" alt="User Avatar">
                <div class="user-details">
            <!-- Display Username -->
            <?php 
                if (isset($_SESSION['loggedInUser']['username'])) {
                    echo $_SESSION['loggedInUser']['username'];
                } else {
                    echo "Guest"; // or any placeholder text for users who aren't logged in
                }
            ?>

            <br> <!-- Line break for visual spacing between username and role -->

            <!-- Display Role -->
            <?php 
                if (isset($_SESSION['loggedInUser']['role'])) {
                    echo $_SESSION['loggedInUser']['role'];
                } 
                // No else here since if there's no role, nothing should be displayed
            ?>
        </div>
    </div>
    <a href="logout.php">
        <i class="fas fa-sign-out-alt" style="color: aliceblue;"></i> 
        <span style="color: rgb(245, 231, 231);">Logout</span>
    </a>
</div>
</nav>

<main class="content">
    <!-- Main content of the page goes here -->
    
    <div class="top-header">
        <div class="notification">
            <i class="fas fa-bell alarm-icon" id="alarm-icon" style="color: #e01010; font-size: 32px; align-items: center; margin-right: 10px;" onclick="togglePopup()"></i>
            <span class="notification-count" id="notification-count">0</span>
            <div id="alarm-popup" class="alarm-popup">
                <div class="alarms-list">
                <!-- Your alarm content here -->
                </div>
            </div>
        </div>
        <div class="language-select">
            <select id="language-select">
                <option value="en">English</option>
                <option value="my">Malay</option>
                <option value="md">Mandarin</option>
            </select>
        </div>
    </div>
    
    <div class="nav-tab-container">
        <button id="dataGraphTab" class="nav-tab active" onclick="activateTab('data-graph')">DATA GRAPH</button>
        <button class="nav-tab" onclick="activateTab('power-quality')">POWER QUALITY</button>
        <button class="nav-tab" onclick="activateTab('demand-analysis')">DEMAND ANALYSIS</button>
        <button class="nav-tab" onclick="activateTab('energy-usage-and-billing')">ENERGY USAGE AND BILLING</button>
    </div>
    

    </div>
    <iframe id="content-frame" width="100%" height="1000px" frameborder="0"></iframe>
    
</main>

<script src="historicaldata.js"></script>
<script src="notification_language.js"></script>
<script src="activemenuclick.js"></script>
<script>
    // Function to activate the "Data Graph" tab
    function activateDataGraphTab() {
        var dataGraphTab = document.getElementById('dataGraphTab');
        if (dataGraphTab) {
            dataGraphTab.click(); // Simulate a click on the tab button
        }
    }

    // Attach the function to the window.onload event to run it when the page loads
    window.onload = activateDataGraphTab;
</script>
</body>
</html>
