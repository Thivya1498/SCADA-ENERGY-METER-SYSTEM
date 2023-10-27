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
    <link rel="stylesheet" href="addplace.css">
    <!-- Leaflet CSS and JavaScript -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- moment-timezone library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.36/moment-timezone-with-data.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="testside.css">
    <title>Add New Place</title>
</head>

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
    <!-- <h1><i class='bx bx-map'></i> Add Place Details</h1> -->
    <div class="content-wrapper"></div>
    <form action="process_form.php" method="post">
    <fieldset>
        <legend>Add New Place</legend>

        <label for="name">Plant Name:</label>
        <input type="text" id="name" name="name"><br>

        <label for="timezone">Timezone:</label>
        <select id="timezone" name="timezone"></select><br>

        <label for="country">Country or Region:</label>
        <select id="country" name="country">
            <option value="Malaysia">Malaysia</option>
        </select><br>

        <label for="state">State:</label>
        <select id="state" name="state"></select><br>

        <label for="city">City:</label>
        <select id="city" name="city"></select><br>

        <label for="currency">Currency:</label>
        <select id="currency" name="currency">
            <option value="MYR">MYR</option>
        </select><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address"><br>

        <!-- <label>Power Tariff (Grid Consumption):</label><br>
        <input type="checkbox" id="fixedRate" name="powerTariff[]" value="Fixed Rate">
        <label for="fixedRate">Fixed Rate</label><br>

        <div id="fixedRateField" style="display: none;">
            <label for="fixedChargeMonthly">Fixed Charge (Monthly):</label>
            <input type="text" id="fixedChargeMonthly" name="fixedChargeMonthly"> -->
        </div>

        <label for="remark">Remark:</label>
        <textarea id="remark" name="remark" rows="4" cols="50" placeholder="Enter your remarks here..."></textarea><br>


        <label for="location">Location (Map):</label><br>
        <div id="map" style="height: 300px;"></div>
        <button type="button" id="selectLocation">Select Location</button>
        <input type="hidden" id="selectedLocation" name="location">

    </fieldset>
    <input type="submit" value="Save">
    <input type="button" value="Cancel">
</form>

</main>

<!-- <script>
</script> -->
<script src="addplace.js"></script>
    <script src="notification_language.js"></script>
  <script src="activemenuclick.js"></script>
</body>
</html>
