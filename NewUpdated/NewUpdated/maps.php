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
    <title>Homepage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="maps.css">
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
            <li class="active"><a href="maps.php"><i class="fas fa-home"></i> <span data-i18n="home">Home</span></a></li>
            <li><a href="dashboard.php"><i class="fas fa-th-large"></i> Dashboard</a></li>
            <li><a href="historicaldata.php"><i class="fas fa-chart-line"></i> Historical Data</a></li>
            <li><a href="reportanalysis.php"><i class="fas fa-chart-pie"></i> Analytic Data</a></li>
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
                        echo "Guest"; 
                    }
                ?>
                <br>

                <!-- Display Role -->
                <?php 
                    if (isset($_SESSION['loggedInUser']['role'])) {
                        echo $_SESSION['loggedInUser']['role'];
                    }
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
        
        <div class="info-container">

            <div class="info-box">
                <div class="icon-wrapper">
                    <img src="images/location (1).png" alt="Plant Icon">
                </div>
                <span>Total Monitored Plants</span>
                <p>1</p>
            </div>
        
            <div class="info-box">
                <div class="icon-wrapper">
                    <img src="images/power-meter.png" alt="Devices Icon">
                </div>
                <span>Total Devices</span>
                <p>1</p>
            </div>
        
            <div class="info-box">
                <div class="icon-wrapper">
                    <img src="images/electric-meter (1).png" alt="Active Devices Icon">
                </div>
                <span>Active Devices</span>
                <p>1</p>
            </div>
        
            <div class="info-box">
                <div class="icon-wrapper">
                    <img src="images/growth.png" alt="Energy Icon">
                </div>
                <span>Total Energy Consumption</span>
                <p>8,120 kWh</p>
            </div>
        </div>
      
          <!-- Swiper container -->
          <div class="swiper-container">
              <div class="swiper-wrapper">
                  <!-- First Slide (Map) -->
                  <div class="swiper-slide">
            <!-- Search form -->
              <!-- <input type="text" id="locationSearch" placeholder="Enter location name..."> -->
              <!-- <button id="searchButton">Search</button> -->
              <!-- <button id="darkModeToggle">Toggle Dark Mode</button> -->
              <div id="map">
                <div class="map-search">
                  <input type="text" id="locationSearch" placeholder="Enter location name...">
                  <button id="searchButton">Search</button>
                  <span>Dark Mode: </span> <!-- Corrected the span here -->
                  <label class="switch">
                      <input type="checkbox" id="darkModeToggle">
                      <span class="slider round"></span>
                  </label>
              </div>
            </div>
        <!-- </div> -->
         <!-- Suggestions container -->
    <div id="suggestionsContainer"></div>
</div>
            
          <!-- Plant Management Page -->
      <div class="swiper-slide">
        <!-- Search and Add New Plant Container -->
        <div class="plant-management-container">
            <input type="text" id="plantSearch" placeholder="Search by Plant Name">
            <button id="searchPlant">Search</button>            
          <!-- <button id="deleteSelected">Delete Selected</button> -->
          <!-- <button id="addNewPlant">Add New Plant</button> -->
      </div>
      
      <table>
          <thead>
              <tr>
                  <!-- <th><input type="checkbox" id="selectAll"></th> -->
                  <th>Status</th>
                  <th>Plant Name</th>
                  <th>Location</th>
                  <th>Energy Usage Today (kWh)</th>
                  <th>Cumulative Energy Usage (kWh)</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <!-- <td><input type="checkbox"></td> -->
                  <td><span class="status-indicator active"></span>Online</td>
                  <td>Reactive Energy Sdn Bhd</td>
                  <td>Petaling Jaya, Selangor</td>
                  <td>210</td>
                  <td>8,120</td>
              </tr>
              <!-- <tr>
                  <td><input type="checkbox"></td>
                  <td><span class="status-indicator inactive"></span>Inactive</td>
                  <td>Kilang Beras KL</td>
                  <td>Kuala Lumpur</td>
                  <td>120</td>
                  <td>4500</td>
              </tr>
              <tr>
                  <td><input type="checkbox"></td>
                  <td><span class="status-indicator error"></span>Error</td>
                  <td>Kilang Beras Penang</td>
                  <td>Butterworth, Penang</td>
                  <td>90</td>
                  <td>4200</td>
              </tr>
              <tr>
                <td><input type="checkbox"></td>
                <td><span class="status-indicator active"></span>Active</td>
                <td>Kilang Beras Johor</td>
                <td>Johor Bahru, Johor</td>
                <td>150</td>
                <td>5000</td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td><span class="status-indicator inactive"></span>Inactive</td>
                <td>Kilang Beras Kuantan</td>
                <td>Kuantan, Pahang</td>
                <td>120</td>
                <td>4500</td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td><span class="status-indicator error"></span>Error</td>
                <td>Kilang Beras Kelantan</td>
                <td>Kota Bahru, Kelantan</td>
                <td>90</td>
                <td>4200</td>
            </tr>
            <tr>
              <td><input type="checkbox"></td>
              <td><span class="status-indicator active"></span>Active</td>
              <td>Kilang Beras Kedah</td>
              <td>Kulim, Kedah</td>
              <td>150</td>
              <td>5000</td>
          </tr>
          <tr>
              <td><input type="checkbox"></td>
              <td><span class="status-indicator error"></span>Error</td>
              <td>Kilang Beras Perlis</td>
              <td>Padang Besar, Perlis</td>
              <td>90</td>
              <td>4200</td>
          </tr>
          <tr>
            <td><input type="checkbox"></td>
            <td><span class="status-indicator active"></span>Active</td>
            <td>Kilang Beras Terengganu</td>
            <td>Kemaman, </td>
            <td>150</td>
            <td>5000</td>
        </tr>
        <tr>
            <td><input type="checkbox"></td>
            <td><span class="status-indicator inactive"></span>Inactive</td>
            <td>Kilang Beras Ipoh</td>
            <td>Ipoh, Perak</td>
            <td>120</td>
            <td>4500</td>
        </tr>
        <tr>
            <td><input type="checkbox"></td>
            <td><span class="status-indicator error"></span>Error</td>
            <td>Kilang Beras Melaka</td>
            <td>Ayer Keroh, Melaka</td>
            <td>90</td>
            <td>4200</td>
        </tr>
        <tr>
          <td><input type="checkbox"></td>
          <td><span class="status-indicator inactive"></span>Inactive</td>
          <td>Kilang Beras Sarawak</td>
          <td>Kuching, Sarawak</td>
          <td>120</td>
          <td>4500</td>
      </tr>
      <tr>
          <td><input type="checkbox"></td>
          <td><span class="status-indicator error"></span>Error</td>
          <td>Kilang Beras Sabah</td>
          <td>Sandakan, Sabah</td>
          <td>90</td>
          <td>4200</td>
      </tr> -->
              <!-- Add more rows as required for dummy data -->
          </tbody>
      </table>
      
      <!-- Popup modal for adding a new plant -->
      <div id="newPlantModal">
        <h3>Add New Plant</h3>
          <label for="companyName">Company:</label>
          <input type="text" id="companyName" placeholder="Enter company name">
      
          <label for="plantName">Plant Name:</label>
          <input type="text" id="plantName" placeholder="Enter plant name">
      
          <label for="contactPerson">Contact Person:</label>
          <input type="text" id="contactPerson" placeholder="Enter contact person's name">
      
          <label for="gridConnectionDate">Connection date:</label>
          <input type="date" id="gridConnectionDate">
          <div class="modal-actions">
          <button id="savePlant">Save</button>
          <button id="cancelAdd">Cancel</button>
      </div>
    </div>

      <div class="overlay"></div>
        <div class="swiper-pagination"></div>
    </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        </div>
    </div>
    </main>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/i18next/22.4.4/i18next.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-i18next/1.3.1/jquery-i18next.min.js"></script>
    <script src="maps.js"></script>
    <script src="notification_language.js"></script>
    <script src="activemenuclick.js"></script>
    <script src="language.js"></script>
</body>
</html>
