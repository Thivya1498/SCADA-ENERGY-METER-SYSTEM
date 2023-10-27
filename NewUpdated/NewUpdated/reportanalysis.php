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
    <title>Analysis Dashboard</title>
    <!-- Highcharts Library -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="reportanalysis.css">
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
            <li><a href="historicaldata.php"><i class="fas fa-chart-line"></i> Historical Data</a></li>
            <li  class="active"><a href="reportanalysis.php"><i class="fas fa-chart-pie"></i> Analytic Data</a></li>
            <li>
                <a href="#"><i class="fas fa-cogs"></i> Management</a>
                <ul class="submenu-content">
                    <li><a href="addplace.php"><i class="fas fa-map-marked-alt"></i> Plant Management</a></li>
                    <li><a href="devicemanagement.php"><i class="fas fa-tachometer-alt"></i> Device Management</a></li>
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
                    <li><a href="#"><i class="fas fa-trash"></i> Delete Account</a></li>
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
<div class="tabs">
    <div class="tab active" onclick="showTab(1)">Comparison Meter Analysis</div>
    <div class="tab" onclick="showTab(2)">Comprehensive Analysis</div>
</div>
<div class="tab-content">
    <div id="tab1-content">
        <div class="card-2">
            <!-- <h1>Meter Comparison Analysis</h1> -->
            
            <!--<label for="meterIds">Plant Name :</label>-->
            <!--<input type="text" id="plantName" placeholder="Enter Plant Name">-->
            
             <!-- Add Plant Name label and input here -->
         <label>Plant Location:</label>
     <select id="meterID">
         <option value="1">Reactive Energy Sdn Bhd</option>
         
            <label for="meterIds">Energy Meter ID :</label>
            <input type="text" id="meterIds" placeholder="Enter Energy Meter ID">
            <label for="startDate">Start Date:</label>
            <input type="date" id="startDate">
            <label for="endDate">End Date:</label>
            <input type="date" id="endDate">
            <label for="groupBy">Group Data By:</label>
            <select id="groupBy">
                <option value="hour">Hour</option>
                <option value="day">Day</option>
                <option value="month">Month</option>
                <option value="year">Year</option>
            </select>
            <button id="viewData">View Data</button>
            <div class="chart-container" id="comparisonChart"></div>
        </div>
    </div>

    <div id="tab2-content" style="display:none;">
        <!-- Selection Section -->
        <div class="select-time-container">

         <!-- Add Plant Name label and input here -->
         <label>Plant Location:</label>
     <select id="meterID">
         <option value="1">Reactive Energy Sdn Bhd</option>
        <!--<input type="text" id="plantName" placeholder="Enter Plant Name">-->
        </div>
<label for="meterIds">Energy Meter ID :</label>
            <input type="text" id="meterIds" placeholder="Enter Energy Meter ID">
        <!-- <div class="input-with-icon">
        <label for="plantName" class="plant-name-label">
            Plant Name:
        </label>
        <input type="text" id="plantName" placeholder="Enter Plant Name">
        </div> -->

            <label for="selectTime" class="select-time-label">Select Time:</label>
            <input type="month" id="selectTime" placeholder="Select Time (yyyy-mm)">
            <button id="viewComprehensiveData">View Data</button>
        </div>

        <div class="comprehensive-charts-container">
            <!-- Overall Consumption -->
            <div class="chart-box card">
                <h2><i class="fas fa-chart-area"></i> Overall Consumption</h2>
                <div style="display: flex;">
                    <div style="flex: 1;">
                        <table class="table-container">
                            <tr>
                                <td>Current Month</td>
                                <td id="currentMonthConsumption">-</td>
                            </tr>
                            <tr>
                                <td>Last Month</td>
                                <td id="lastMonthConsumption">-</td>
                            </tr>
                            <tr>
                                <td>Same Month Last Year</td>
                                <td id="sameMonthLastYearConsumption">-</td>
                            </tr>
                            <tr>
                                <td>Last Year</td>
                                <td id="lastYearConsumption">-</td>
                            </tr>
                            <tr>
                                <td>Average Monthly</td>
                                <td id="averageMonthlyConsumption">-</td>
                            </tr>
                            <tr>
                                <td>Average Daily</td>
                                <td id="averageDailyConsumption">-</td>
                            </tr>
                        </table>
                    </div>
                    <div style="flex: 1;">
                        <div class="chart-container" id="overallConsumptionChart"></div>
                    </div>
                </div>
            </div>

            <!-- Daily Consumption -->
            <div class="chart-box card">
                <h2><i class="fas fa-chart-bar"></i> Daily Consumption</h2>
                <div style="display: flex;">
                    <div style="flex: 1;">
                        <div class="chart-container" id="dailyConsumptionByDayChart"></div>
                    </div>
                    <div style="flex: 1;">
                        <div class="chart-container" id="dailyConsumptionByDayOfWeekChart"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="comprehensive-charts-container">
            <!-- Weekends vs Weekdays Comparison -->
            <div class="chart-box card">
                <h2><i class="fas fa-chart-pie"></i> Weekends vs Weekdays Comparison</h2>
                <div class="card-pie-chart">
                    <div class="chart-container pie-chart" id="weekdaysWeekendsPieChart"></div>
                    <div class="chart-container pie-chart" id="dayOfWeekPieChart"></div>
                </div>
            </div>

            <!-- Active Power History -->
            <div class="chart-box card">
                <h2><i class="fas fa-bolt"></i> Active Power History</h2>
                <div class="chart-container" id="activePowerHistoryChart"></div>
            </div>
        </div>
    </div>
</div>
</main>
<script src="reportanalysis.js"></script>
<script src="notification_language.js"></script>
<script src="activemenuclick.js"></script>
</body>
</html>