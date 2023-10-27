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
    <title>Company Management</title>
    <link rel="stylesheet" href="companymanagement.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
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
            
    <div class="container">
        <div class="company-info">
            <img class="company-image" src="images/management.png" alt="">
            <h2>User Management</h2>
        </div>
        
        <!-- <h2><i class="fas fa-user-alt"></i> User Management</h2> -->

        <!-- Search Fields -->
        <div>
            <label for="searchUsername">Search by Username:</label>
            <input type="text" id="searchUsername" placeholder="Enter username">
            <label for="searchEmail">Search by Email:</label>
            <input type="text" id="searchEmail" placeholder="Enter email">
            <button onclick="searchUsers()"><i class="fas fa-search"></i> Search</button>
            <button onclick="resetFields()"><i class="fas fa-sync"></i> Reset</button>
        </div>
    
        <!-- User Table -->
        <table>
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Username</th>
                    <th>Role Name</th>
                    <th>Company Name</th>
                    <th>Mobile Number</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                <!-- User data rows will be populated here -->
            </tbody>
        </table>
    </div>
    <div id="overlay" class="overlay"> <!-- Modal background -->
    <!-- Pop-up dialog for password reset -->
    <div id="passwordResetDialog" class="dialog">
        <h2>Reset the password of user <span id="selectedUser">User1</span></h2>
        <label for="newPassword">New Password:</label>
        <input type="password" id="newPassword" required>
        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" id="confirmPassword" required>
        <!-- <div class="modal-actions"> -->
        <button id="cancelButton">Cancel</button>
        <button id="okButton">OK</button>
    </div>
    <!-- Pop-up dialog for modifying a user -->
    <div id="modifyUserDialog" class="dialog">
        <h2>Modify User: <span id="modifyUserName">User1</span></h2>
        <!-- Add fields and buttons for modifying a user -->
        <!-- For example, you can add input fields for editing user information -->
        <label for="newUsername">New Username:</label>
        <input type="text" id="newUsername">
        <button id="cancelModifyButton">Cancel</button>
        <button id="okModifyButton">Save Changes</button>
    </div>

    <!-- Pop-up dialog for user deletion -->
    <div id="deleteUserDialog" class="dialog">
        <h2><i class="fas fa-exclamation-triangle"></i> Delete</h2>
        <p>Are you sure to delete <span id="deleteUserName">User1</span>?</p>
        <button id="cancelDeleteButton">Cancel</button>
        <button id="okDeleteButton">OK</button>
    </div>

    <!-- Pop-up dialog for disabling a user -->
    <div id="disableUserDialog" class="dialog">
        <h2>Disable User: <span id="disableUserName">User1</span></h2>
        <!-- Add information and buttons for disabling a user -->
        <!-- For example, you can provide a confirmation message and a "Disable" button -->
        <p>Are you sure you want to disable this user?</p>
        <button id="cancelDisableButton">Cancel</button>
        <button id="disableButton">Disable</button>
    </div>

</main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script> -->
    <script src="companymanagement.js"></script>
    <script src="notification_language.js"></script>
    <script src="activemenuclick.js"></script>
</body>
</html>
