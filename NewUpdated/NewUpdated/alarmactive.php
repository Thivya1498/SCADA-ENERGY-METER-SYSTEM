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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="alarmactivestyles.css">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@latest/dist/feather.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="testside.css">
  <title>Alarm Active</title>
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
        <li><a href="maps.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="dashboard.php"><i class="fas fa-th-large"></i> Dashboard</a></li>
        <li><a href="historicaldata.php"><i class="fas fa-chart-line"></i> Historical Data</a></li>
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
                <li  class="active"><a href="alarmactive.php"><i class="fas fa-bell"></i> Alarm Active</a></li>
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
    <!-- <div class="user-profile">
        <div class="user-info">
            <img src="images/Picture5.png" alt="User Avatar">
            <div class="user-details">
                <span class="user-name">MupaJ</span>
                <span class="user-role">SCADA Engineer</span>
            </div>
        </div>
        <a href="login.html">
            <i class="fas fa-sign-out-alt" style="color: aliceblue;"></i> 
            <span style="color: rgb(245, 231, 231);">Logout</span>
        </a>
    </div>
</nav> -->
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

        <div class="alarm-icon-container">
            <img class="alarm-1-1" src="images/notification.png" alt="Alarm Icon" />
            <h2 for="alarm-1-1">Alarm Active</h2>
        </div>
        <div class="alarm-active"></div>
    </div>
 
    

    <!-- <div class="search-header"> -->
      <div class="search-row">
          <label for="plant-search">Plant Name:</label>
          <input type="text" id="plant-search" placeholder="Search Plant...">
          
          <label for="alarm-search">Alarm Name:</label>
          <input type="text" id="alarm-search" placeholder="Search Alarm...">
  
          <label for="start-date-picker">Start Date:</label>
          <input type="date" id="start-date-picker">
  
          <label for="end-date-picker">End Date:</label>
          <input type="date" id="end-date-picker">
  
          <button id="search-button">Search</button>
          <button class="button" id="clear-selection-button">Clear Selection</button>
          <button class="button" id="export-data-button">Export Data</button>
      </div>
  </div>
  <div class="legend-container">
    <label for="auto-refresh-toggle">Auto Refresh:</label>
    <input type="checkbox" id="auto-refresh-toggle" checked>
    <span id="auto-refresh-status">On</span>
<!-- </div> -->
<div class="legend-container">
    <div class="legend-item" data-filter="Critical" title="Critical alarms">
        <i data-feather="alert-triangle" class="icon-critical"></i> 
         <span id="critical-count">0</span>
    </div>
    <div class="legend-item" data-filter="Major" title="Major alarms">
        <i data-feather="alert-octagon" class="icon-major"></i> 
        <span id="major-count">0</span>
        <!-- Major [<span id="major-count">0</span>] -->
    </div>
    <div class="legend-item" data-filter="Minor" title="Minor alarms">
        <i data-feather="alert-circle" class="icon-minor"></i> 
        <span id="minor-count">0</span>
    </div>
    <div class="legend-item" data-filter="Warning" title="Warning alarms">
        <i data-feather="info" class="icon-warning"></i> 
        <span id="warning-count">0</span>
    </div>
</div>
</div>

    <table>
      <thead>
        <tr>
          <th>Select</th>
          <th>Alarm Severity</th>
          <th>Plant Name</th>
          <th>Alarm ID</th>
          <th>Alarm Name</th>
          <th>Device Name</th>
          <th>Occurrence Time</th>
          <th>Operation</th>
        </tr>
      </thead>
      <tbody id="table-body">
        <!-- Data will be dynamically populated here -->
        <tr>
            <!-- ... other cells ... -->
            <td class="operation-icons">
                <button class="icon-button edit-button">
                    <i class='bx bx-edit'></i>
                </button>
                <button class="icon-button delete-button">
                    <i class='bx bx-trash'></i>
                </button>
            </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div id="clearAlarmModal" class="modal">
    <div class="modal-content">
        <span class="close-button">×</span>
        <i data-feather="help-circle"></i>
        <p>The fault that causes the alarm may have not been rectified. Are you sure you want to forcibly clear the selected alarm?</p>
        <button id="confirmClearAlarm">Yes</button>
        <button id="cancelClearAlarm">No</button>
    </div>
</div>
  

<!-- <p class="copyright">
  &copy; 2020 - <span>Reactive Energy Sdn Bhd</span> All Rights Reserved.
</p> -->

</main>
  <script src="alarmactive.js"></script>
  <script src="notification_language.js"></script>
  <script src="activemenuclick.js"></script>
</body>
</html>
