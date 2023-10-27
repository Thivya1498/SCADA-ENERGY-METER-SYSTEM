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
    <title>Device Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="testside.css">
    <link rel="stylesheet" href="devicemanagement.css">
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
            <li class="active"><a href="maps.php"><i class="fas fa-home"></i> <span data-i18n="home">Home</span></a></li>
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
            <div class="device-info">
                <img class="device-image" src="images/gauge.png" alt="">
                <h2>Device Management</h2>
            </div>
            <!-- <h2><i class="fas fa-tachometer-alt"></i> Device Management</h2>        -->
                        <!-- Filter fields -->
                        <div class="filters my-4">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="deviceNameFilter" placeholder="Device Name">
                                <select class="form-select" id="communicationStatusFilter">
                                    <option value="All">All</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                    <option value="Error">Error</option>
                                </select>
                                <input type="text" class="form-control" id="serialNumberFilter" placeholder="Serial Number">
                                <button id="searchButton" class="btn btn-primary">Search</button>
                            </div>
                        </div>
        
                         <!-- Data table -->
                <div class="table-responsive">
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" id="selectAll">
                                </th>
                                <th>Status</th>
                                <th>Device Name</th>
                                <th>Plant Name</th>
                                <th>Serial Number (S/N)</th>
                                <th>Device Brand</th>
                                <th>Warranty Expiration Date</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <!-- Table rows will be dynamically generated here -->
                        </tbody>
                    </table>
                </div>
                <div class="pagination-buttons">
                    <button id="prevPage" class="btn btn-secondary">Previous</button>
                    <span id="currentPage">Page 1</span>
                    <button id="nextPage" class="btn btn-secondary">Next</button>
                </div>
                <!-- Modal -->
                    <div id="editModal" class="modal">
                        <div class="modal-content">
                            <!-- <span class="close" id="closeModal">&times;</span> -->
                            <h2>Modify</h2>
                            <div class="modal-body">
                                <label for="deviceName">Device Name:</label>
                    <input type="text" id="deviceName">
              
                    <label for="sn">SN:</label>
                    <input type="text" id="sn">
                
                    <label for="deviceIPAddress">Device IP Address:</label>
                    <input type="text" id="deviceIPAddress">
                    <div class="modal-actions">
                <button id="okButton">OK</button>
                <button id="cancelButton">Cancel</button>
            </div>
        </div>
        <!-- Delete Confirmation Modal -->
        <div id="deleteModal" class="modal">
            <div class="modal-content">
                <h2>Delete Confirmation</h2>
                <p>Are you sure you want to delete this device?</p>
                <button id="confirmDeleteButton" class="btn btn-danger">OK</button>
                <button id="cancelDeleteButton" class="btn btn-secondary">Cancel</button>
            </div>
        </div>


            </main>
        
            <!-- JavaScript for Bootstrap and your custom scripts -->
            <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script> -->
            <script src="devicemanagement.js"></script>
            <script src="notification_language.js"></script>
            <script src="activemenuclick.js"></script>
    
    </body>
    </html>