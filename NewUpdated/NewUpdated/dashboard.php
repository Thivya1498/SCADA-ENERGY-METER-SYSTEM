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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="testside.css">
  <link rel="stylesheet" href="dashboardstyle.css" />
  <link href='https://fonts.googleapis.com/css?family=Josefin+Slab' rel='stylesheet' type='text/css'>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script src="https://cdn.jsdelivr.net/npm/raphael@2.1.4/raphael.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/justgage@1.4.0/dist/justgage.js"></script>

 
  <style>
    /* CSS styles for alarm dashboard */
    body {
      margin: 10px;
      margin-top: 10px;
      padding: 0;
      font-family: Arial, sans-serif;
      /* background-color: #0a5e9b; Light blue background */
    }

    #container {
      display: inline-block;
      /* flex-direction: column; */
      height: 100vh;
      padding: 20px;
    }

    /* Set fixed widths for each column in the table */
    th,
    td {
      width: 20%; /* Adjust the width of all columns equally */
    }

    th:nth-child(5),
    td:nth-child(5) {
      width: 40%; /* Adjust the width of the last column (Operation) */
    }
    .label {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin: 10px 0;
  }
  .gauge {
    max-width: 80%; /* Make the gauge responsive */
    width: 200px; /* Adjust the width as needed */
  }

  .containerinside{
  width: 100%;
  margin: 11px 0px;
  display: flex;
  justify-content: flex-start;
  gap: 40px;
  flex-wrap: wrap;
  flex-direction: row;
  margin-top:40px;
  } 

  /* /////////////////////////////////// */

  .buttons {
      display: flex;
      flex-direction: row;
      gap: 24px;
      align-items: flex-start;
      justify-content: flex-start;
      position: relative;
    }
    .tab-button {
      display: flex;
      flex-direction: column;
      gap: 8px;
      align-items: flex-start;
      justify-content: flex-start;
      flex-shrink: 0;
      position: relative;
      overflow: hidden;
      cursor: pointer;
    }
    .contents {
      padding: 12px 16px 0px 16px;
      display: flex;
      flex-direction: row;
      gap: 0px;
      align-items: flex-start;
      justify-content: flex-start;
      flex-shrink: 0;
      position: relative;
    }
    .label {
      color: #9a9ea5;
      text-align: left;
      font: 500 16px/24px "Poppins", sans-serif;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: flex-start;
    }
    .line {
      background: #007aff;
      align-self: stretch;
      flex-shrink: 0;
      height: 4px;
      position: relative;
      display: none; /* Initially hide the line */
    }
    /* Show the line for the active tab */
    .tab-button.active .line {
      display: block;
    }
    /* Initially hide all content sections */
    .tab-content {
      display: none;
    }
    /* Show the content section with the 'active' class */
    .tab-content.active {
      display: block;
    }
    
    /* Styles for dropdowns and data table */
    .dropdowns {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-top: 20px;
    }
    .dropdown {
      flex: 1;
      max-width: 300px;
    }
    label {
      font-weight: bold;
      color: #fff;
    }
    select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      color: rgb(10, 10, 10);
    }
    .data-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      display: none; /* Initially hide the data table */
    }
    input#time-PeriodDataTable
    {
      color: rgb(24, 22, 22);
      margin-top: 10px;
    }

    input[type="date" i] {
    font-family: monospace;
    padding-inline-start: 1px;
    cursor: default;
    align-items: center;
    display: inline-flex;
    overflow: hidden;
    padding: 0px;
    color: rgb(10, 10, 10);
    padding: 10px 20px;
    margin-top: 16px;
}
    .data-table th, .data-table td {
      padding: 10px;
      border: 1px solid #ccc;
      text-align: center;
      color: #fff;
    }
    /* Style for the icon */
    .dropdown .fa {
      margin-right: 10px;
    }

    /* Styles for buttons and title */
    .buttons {
      margin-top: 20px;
      display: flex;
      flex-wrap: wrap;
      align-items: center;

    }
    .button:hover {
    transform: scale(1.05);
    font-weight: bold;
}

    /*.history-title {
      font-size: 24px;
      font-weight: bold;
      margin-right: auto;
    }*/

    
    .view-button {
      background: #10428d;
      color: white;
      border: none;
      border-radius: 4px;
      padding: 10px 20px;
      cursor: pointer;
      margin-right: 5px;
    }
    .export-button {
      background: #135c85;
      color: white;
      border: none;
      border-radius: 4px;
      padding: 10px 20px;
      cursor: pointer;
    }
    
  </style>
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
        <li class="active"><a href="dashboard.php"><i class="fas fa-th-large"></i> Dashboard</a></li>
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
        <a href="logout.php">
            <i class="fas fa-sign-out-alt" style="color: aliceblue;"></i> 
            <span style="color: rgb(245, 231, 231);">Logout</span>
        </a>
    </div> -->
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
	<script type="text/javascript" src="https://code.jquery.com/jquery-latest.js"></script>
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
    <!-- <img class="location-1-1" src="location-1-1.png" alt=""/>
    <div class="reactive-energy-sdn-bhd-petaling-jaya-selangor">
      Reactive Energy Sdn Bhd, Petaling Jaya, Selangor
    </div> -->
    <div class="column">
      <div id="data-table-content" class="tab-content active">
        <!-- Dropdowns for Location, Energy Meter ID, and Time Period -->
        <div class="dropdowns">
          <div class="dropdown">
            <label for="locationDataTable"><i class="fas fa-search-location"></i>Plant Location</label>
            <select id="locationDataTable" name="location">
              <option value="location1">Reactive Energy Sdn Bhd</option>
              <!-- <option value="location2">Location 2</option> -->
              <!-- <option value="location3">Location 3</option> -->
              <!-- Add more location options as needed -->
            </select>
          </div>
          <div class="dropdown">
            <label for="meter-idDataTable"><i class="fas fa-tachometer-alt"></i>Energy Meter ID</label>
            <select id="meter-idDataTable" name="meter-id">
              <option value="meter1">Energy Meter 1</option>
              <!-- <option value="meter2">EM 2</option> -->
              <!-- <option value="meter3">EM 3</option> -->
              <!-- Add more meter ID options as needed -->
            </select>
          <!-- </div>
          <div class="dropdown">
            <label for="time-periodDataTable"><i class="far fa-calendar-alt"></i> Time Period</label>
            <input type="date" id="time-periodDataTable" name="time-period">
          </div> -->
        </div>
        <!-- View and Export buttons -->
        <div class="buttons">
          <button class="view-button" onclick="showDataTable('data-table-content')">View</button>
          <!-- <button class="export-button">Export</button> -->
        </div>
        <!-- Data Table -->
        <table class="data-table" id="data-table">
          <thead>
            <tr>
              <th><input type="checkbox"></th>
              <th>Last Update</th>
              <th>Voltage</th>
              <th>Current</th>
              <th>Power</th>
              <th>Total Energy Consumption</th>
            </tr>
          </thead>
          <tbody>
            <!-- Add table rows with data here -->
          </tbody>
        </table>
      </div>
      <div class="containerinside">
        <!-- //////1/// -->
    <div class="card">
      <div class="card__inner">
        <!--Front Card-->
        <div class="front face">
          <div class="goals">
            <div class="content5">
              <div class="header">
                <div class="frame-40639">
                  <div class="phase-voltage-v">L-Neutral Voltage[V]</div>
                  <div class="group-4044">
                    <div class="group-4045">
                      <button class="flip real-data flip-me">Real Data</button>
                      <svg
                        class="chevron-right"
                        width="30"
                        height="24"
                        viewBox="0 0 30 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M13.4198 7C13.1054 7 12.791 7.098 12.5515 7.293C12.0713 7.684 12.0713 8.316 12.5515 8.707L16.6105 12.012L12.705 15.305C12.2346 15.703 12.2481 16.336 12.7357 16.719C13.2245 17.102 14.0019 17.091 14.4723 16.695L19.2154 12.695C19.6809 12.302 19.6748 11.679 19.2007 11.293L14.2881 7.293C14.0486 7.098 13.7342 7 13.4198 7Z"
                          fill="#F3E9E9"
                        />
                      </svg>
  
                      <svg
                        class="chevron-left"
                        width="30"
                        height="24"
                        viewBox="0 0 30 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M16.9109 6.99999C16.5891 6.99999 16.2686 7.10199 16.0279 7.30499L11.2835 11.305C10.8193 11.698 10.8254 12.321 11.2995 12.707L16.2121 16.707C16.6911 17.098 17.4685 17.098 17.9487 16.707C18.4277 16.316 18.4277 15.684 17.9487 15.293L13.8897 11.988L17.794 8.69499C18.2656 8.29699 18.2521 7.66399 17.7645 7.28099C17.525 7.09299 17.218 6.99999 16.9109 6.99999Z"
                          fill="#F3E9E9"
                        />
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
              <div class="details">
                <div class="left-content">
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-1-0-v">L1 Voltage: <span id="l1Value" >N/A</span></p>
                      <!-- <div class="l-1-0-v">L1 : 0 V</div> -->
                    </div>
                  </div>
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-2-0-v">L2 Voltage: <span id="l2Value">N/A</span></p>
                      <!-- <div >L2 : 0 V</div> -->
                    </div>
                  </div>
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-3-240-v">L3 Voltage: <span id="l3Value">N/A</span></p>
                      <!-- <div >L3 : 240 V</div> -->
                    </div>
                  </div>
                </div>
                <div>
                  <div class="gauge" id="totalVoltageGauge"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--Back Card-->
        <div class="back face">
          <div class="top-content2">
            <div class="goals2">
              <div class="content5">
                <div class="header">
                  <div class="frame-40639">
                    <div class="total-harmonic-i">L-Neutral Voltage[V]</div>
                    <div class="group-4044">
                      <div class="group-4045">
                        <button class="flip graph return">Graph</button>
                        <svg
                          class="chevron-right5"
                          width="22"
                          height="24"
                          viewBox="0 0 22 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M9.87631 7C9.64641 7 9.4165 7.098 9.24138 7.293C8.89024 7.684 8.89024 8.316 9.24138 8.707L12.2095 12.012L9.35364 15.305C9.00968 15.703 9.01956 16.336 9.37609 16.719C9.73352 17.102 10.302 17.091 10.6459 16.695L14.1142 12.695C14.4546 12.302 14.4501 11.679 14.1035 11.293L10.5112 7.293C10.3361 7.098 10.1062 7 9.87631 7Z"
                            fill="#F3E9E9"
                          />
                        </svg>
  
                        <svg
                          class="chevron-left5"
                          width="23"
                          height="24"
                          viewBox="0 0 23 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M12.5002 6.99999C12.2649 6.99999 12.0305 7.10199 11.8545 7.30499L8.38528 11.305C8.04582 11.698 8.05031 12.321 8.39696 12.707L11.9892 16.707C12.3394 17.098 12.9079 17.098 13.259 16.707C13.6093 16.316 13.6093 15.684 13.259 15.293L10.291 11.988L13.1459 8.69499C13.4907 8.29699 13.4809 7.66399 13.1243 7.28099C12.9492 7.09299 12.7247 6.99999 12.5002 6.99999Z"
                            fill="#F3E9E9"
                          />
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="chart-container">
                  <div id="lineChart"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- //////2/// -->
    <div class="card">
      <div class="card__inner">
        <!--Front Card-->
        <div class="front face">
          <div class="goals">
            <div class="content5">
              <div class="header">
                <div class="frame-40639">
                  <div class="phase-voltage-v">Line-Line Voltage [V]</div>
                  <div class="group-4044">
                    <div class="group-4045">
                      <button class="flip real-data flip-me">Real Data</button>
                      <svg
                        class="chevron-right"
                        width="30"
                        height="24"
                        viewBox="0 0 30 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M13.4198 7C13.1054 7 12.791 7.098 12.5515 7.293C12.0713 7.684 12.0713 8.316 12.5515 8.707L16.6105 12.012L12.705 15.305C12.2346 15.703 12.2481 16.336 12.7357 16.719C13.2245 17.102 14.0019 17.091 14.4723 16.695L19.2154 12.695C19.6809 12.302 19.6748 11.679 19.2007 11.293L14.2881 7.293C14.0486 7.098 13.7342 7 13.4198 7Z"
                          fill="#F3E9E9"
                        />
                      </svg>
  
                      <svg
                        class="chevron-left"
                        width="30"
                        height="24"
                        viewBox="0 0 30 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M16.9109 6.99999C16.5891 6.99999 16.2686 7.10199 16.0279 7.30499L11.2835 11.305C10.8193 11.698 10.8254 12.321 11.2995 12.707L16.2121 16.707C16.6911 17.098 17.4685 17.098 17.9487 16.707C18.4277 16.316 18.4277 15.684 17.9487 15.293L13.8897 11.988L17.794 8.69499C18.2656 8.29699 18.2521 7.66399 17.7645 7.28099C17.525 7.09299 17.218 6.99999 16.9109 6.99999Z"
                          fill="#F3E9E9"
                        />
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
              <div class="details">
                <div class="left-content">
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-1-0-v">L12 Voltage: <span id="l12Value">N/A</span></p>
                      <!-- <div class="l-1-0-v">L1 : 0 V</div> -->
                    </div>
                  </div>
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-2-0-v">L32 Voltage: <span id="l32Value">N/A</span></p>
                      <!-- <div >L2 : 0 V</div> -->
                    </div>
                  </div>
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-3-240-v">L13 Voltage: <span id="l13Value">N/A</span></p>
                      <!-- <div >L3 : 240 V</div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--Back Card-->
        <div class="back face">
          <div class="top-content2">
            <div class="goals2">
              <div class="content5">
                <div class="header">
                  <div class="frame-40639">
                    <div class="total-harmonic-i">Line-Line Voltage [V]</div>
                    <div class="group-4044">
                      <div class="group-4045">
                        <button class="flip graph return">Graph</button>
                        <svg
                          class="chevron-right5"
                          width="22"
                          height="24"
                          viewBox="0 0 22 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M9.87631 7C9.64641 7 9.4165 7.098 9.24138 7.293C8.89024 7.684 8.89024 8.316 9.24138 8.707L12.2095 12.012L9.35364 15.305C9.00968 15.703 9.01956 16.336 9.37609 16.719C9.73352 17.102 10.302 17.091 10.6459 16.695L14.1142 12.695C14.4546 12.302 14.4501 11.679 14.1035 11.293L10.5112 7.293C10.3361 7.098 10.1062 7 9.87631 7Z"
                            fill="#F3E9E9"
                          />
                        </svg>
  
                        <svg
                          class="chevron-left5"
                          width="23"
                          height="24"
                          viewBox="0 0 23 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M12.5002 6.99999C12.2649 6.99999 12.0305 7.10199 11.8545 7.30499L8.38528 11.305C8.04582 11.698 8.05031 12.321 8.39696 12.707L11.9892 16.707C12.3394 17.098 12.9079 17.098 13.259 16.707C13.6093 16.316 13.6093 15.684 13.259 15.293L10.291 11.988L13.1459 8.69499C13.4907 8.29699 13.4809 7.66399 13.1243 7.28099C12.9492 7.09299 12.7247 6.99999 12.5002 6.99999Z"
                            fill="#F3E9E9"
                          />
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="chart-container">
                  <div id="lineChart2"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- //////3/// -->
    <div class="card">
      <div class="card__inner">
        <!--Front Card-->
        <div class="front face">
          <div class="goals">
            <div class="content5">
              <div class="header">
                <div class="frame-40639">
                  <div class="phase-voltage-v"> Current [A]</div>
                  <div class="group-4044">
                    <div class="group-4045">
                      <button class="flip real-data flip-me">Real Data</button>
                      <svg
                        class="chevron-right"
                        width="30"
                        height="24"
                        viewBox="0 0 30 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M13.4198 7C13.1054 7 12.791 7.098 12.5515 7.293C12.0713 7.684 12.0713 8.316 12.5515 8.707L16.6105 12.012L12.705 15.305C12.2346 15.703 12.2481 16.336 12.7357 16.719C13.2245 17.102 14.0019 17.091 14.4723 16.695L19.2154 12.695C19.6809 12.302 19.6748 11.679 19.2007 11.293L14.2881 7.293C14.0486 7.098 13.7342 7 13.4198 7Z"
                          fill="#F3E9E9"
                        />
                      </svg>
  
                      <svg
                        class="chevron-left"
                        width="30"
                        height="24"
                        viewBox="0 0 30 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M16.9109 6.99999C16.5891 6.99999 16.2686 7.10199 16.0279 7.30499L11.2835 11.305C10.8193 11.698 10.8254 12.321 11.2995 12.707L16.2121 16.707C16.6911 17.098 17.4685 17.098 17.9487 16.707C18.4277 16.316 18.4277 15.684 17.9487 15.293L13.8897 11.988L17.794 8.69499C18.2656 8.29699 18.2521 7.66399 17.7645 7.28099C17.525 7.09299 17.218 6.99999 16.9109 6.99999Z"
                          fill="#F3E9E9"
                        />
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
              <div class="details">
                <div class="left-content">
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-1-0-v">Current L1: <span id="currentl1_value">N/A</span></p>
                    </div>
                  </div>
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-2-0-v">Current L2: <span id="currentl2_value">N/A</span></p>
                    </div>
                  </div>
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-3-240-v">Current L3: <span id="currentl3_value">N/A</span></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--Back Card-->
        <div class="back face">
          <div class="top-content2">
            <div class="goals2">
              <div class="content5">
                <div class="header">
                  <div class="frame-40639">
                    <div class="total-harmonic-i"> Current [A]</div>
                    <div class="group-4044">
                      <div class="group-4045">
                        <button class="flip graph return">Graph</button>
                        <svg
                          class="chevron-right5"
                          width="22"
                          height="24"
                          viewBox="0 0 22 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M9.87631 7C9.64641 7 9.4165 7.098 9.24138 7.293C8.89024 7.684 8.89024 8.316 9.24138 8.707L12.2095 12.012L9.35364 15.305C9.00968 15.703 9.01956 16.336 9.37609 16.719C9.73352 17.102 10.302 17.091 10.6459 16.695L14.1142 12.695C14.4546 12.302 14.4501 11.679 14.1035 11.293L10.5112 7.293C10.3361 7.098 10.1062 7 9.87631 7Z"
                            fill="#F3E9E9"
                          />
                        </svg>
  
                        <svg
                          class="chevron-left5"
                          width="23"
                          height="24"
                          viewBox="0 0 23 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M12.5002 6.99999C12.2649 6.99999 12.0305 7.10199 11.8545 7.30499L8.38528 11.305C8.04582 11.698 8.05031 12.321 8.39696 12.707L11.9892 16.707C12.3394 17.098 12.9079 17.098 13.259 16.707C13.6093 16.316 13.6093 15.684 13.259 15.293L10.291 11.988L13.1459 8.69499C13.4907 8.29699 13.4809 7.66399 13.1243 7.28099C12.9492 7.09299 12.7247 6.99999 12.5002 6.99999Z"
                            fill="#F3E9E9"
                          />
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="chart-container">
                  <div id="lineChart3"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- //////4/// -->
    <div class="card">
      <div class="card__inner">
        <!--Front Card-->
        <div class="front face">
          <div class="goals">
            <div class="content5">
              <div class="header">
                <div class="frame-40639">
                  <div class="phase-voltage-v">Active Power [KW]</div>
                  <div class="group-4044">
                    <div class="group-4045">
                      <button class="flip real-data flip-me">Real Data</button>
                      <svg
                        class="chevron-right"
                        width="30"
                        height="24"
                        viewBox="0 0 30 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M13.4198 7C13.1054 7 12.791 7.098 12.5515 7.293C12.0713 7.684 12.0713 8.316 12.5515 8.707L16.6105 12.012L12.705 15.305C12.2346 15.703 12.2481 16.336 12.7357 16.719C13.2245 17.102 14.0019 17.091 14.4723 16.695L19.2154 12.695C19.6809 12.302 19.6748 11.679 19.2007 11.293L14.2881 7.293C14.0486 7.098 13.7342 7 13.4198 7Z"
                          fill="#F3E9E9"
                        />
                      </svg>
  
                      <svg
                        class="chevron-left"
                        width="30"
                        height="24"
                        viewBox="0 0 30 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M16.9109 6.99999C16.5891 6.99999 16.2686 7.10199 16.0279 7.30499L11.2835 11.305C10.8193 11.698 10.8254 12.321 11.2995 12.707L16.2121 16.707C16.6911 17.098 17.4685 17.098 17.9487 16.707C18.4277 16.316 18.4277 15.684 17.9487 15.293L13.8897 11.988L17.794 8.69499C18.2656 8.29699 18.2521 7.66399 17.7645 7.28099C17.525 7.09299 17.218 6.99999 16.9109 6.99999Z"
                          fill="#F3E9E9"
                        />
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
              <div class="details">
                <div class="left-content">
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-1-0-v">Active Power L1: <span id="ActivePowerl1_value">N/A</span></p>
                    </div>
                  </div>
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-2-0-v">Active Power L2: <span id="ActivePowerl2_value">N/A</span></p>
                    </div>
                  </div>
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-3-240-v">Active Power L3: <span id="ActivePowerl3_value">N/A</span></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--Back Card-->
        <div class="back face">
          <div class="top-content2">
            <div class="goals2">
              <div class="content5">
                <div class="header">
                  <div class="frame-40639">
                    <div class="total-harmonic-i">Active Power [KW]</div>
                    <div class="group-4044">
                      <div class="group-4045">
                        <button class="flip graph return">Graph</button>
                        <svg
                          class="chevron-right5"
                          width="22"
                          height="24"
                          viewBox="0 0 22 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M9.87631 7C9.64641 7 9.4165 7.098 9.24138 7.293C8.89024 7.684 8.89024 8.316 9.24138 8.707L12.2095 12.012L9.35364 15.305C9.00968 15.703 9.01956 16.336 9.37609 16.719C9.73352 17.102 10.302 17.091 10.6459 16.695L14.1142 12.695C14.4546 12.302 14.4501 11.679 14.1035 11.293L10.5112 7.293C10.3361 7.098 10.1062 7 9.87631 7Z"
                            fill="#F3E9E9"
                          />
                        </svg>
  
                        <svg
                          class="chevron-left5"
                          width="23"
                          height="24"
                          viewBox="0 0 23 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M12.5002 6.99999C12.2649 6.99999 12.0305 7.10199 11.8545 7.30499L8.38528 11.305C8.04582 11.698 8.05031 12.321 8.39696 12.707L11.9892 16.707C12.3394 17.098 12.9079 17.098 13.259 16.707C13.6093 16.316 13.6093 15.684 13.259 15.293L10.291 11.988L13.1459 8.69499C13.4907 8.29699 13.4809 7.66399 13.1243 7.28099C12.9492 7.09299 12.7247 6.99999 12.5002 6.99999Z"
                            fill="#F3E9E9"
                          />
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="chart-container">
                  <div id="lineChart4"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- //////5/// -->
    <div class="card">
      <div class="card__inner">
        <!--Front Card-->
        <div class="front face">
          <div class="goals">
            <div class="content5">
              <div class="header">
                <div class="frame-40639">
                  <div class="phase-voltage-v">React. Power[KVAR]</div>
                  <div class="group-4044">
                    <div class="group-4045">
                      <button class="flip real-data flip-me">Real Data</button>
                      <svg
                        class="chevron-right"
                        width="30"
                        height="24"
                        viewBox="0 0 30 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M13.4198 7C13.1054 7 12.791 7.098 12.5515 7.293C12.0713 7.684 12.0713 8.316 12.5515 8.707L16.6105 12.012L12.705 15.305C12.2346 15.703 12.2481 16.336 12.7357 16.719C13.2245 17.102 14.0019 17.091 14.4723 16.695L19.2154 12.695C19.6809 12.302 19.6748 11.679 19.2007 11.293L14.2881 7.293C14.0486 7.098 13.7342 7 13.4198 7Z"
                          fill="#F3E9E9"
                        />
                      </svg>
  
                      <svg
                        class="chevron-left"
                        width="30"
                        height="24"
                        viewBox="0 0 30 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M16.9109 6.99999C16.5891 6.99999 16.2686 7.10199 16.0279 7.30499L11.2835 11.305C10.8193 11.698 10.8254 12.321 11.2995 12.707L16.2121 16.707C16.6911 17.098 17.4685 17.098 17.9487 16.707C18.4277 16.316 18.4277 15.684 17.9487 15.293L13.8897 11.988L17.794 8.69499C18.2656 8.29699 18.2521 7.66399 17.7645 7.28099C17.525 7.09299 17.218 6.99999 16.9109 6.99999Z"
                          fill="#F3E9E9"
                        />
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
              <div class="details">
                <div class="left-content">
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-1-0-v">Reactive Power L1: <span id="ReactivePowerl1_value">N/A</span></p>
                    </div>
                  </div>
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-2-0-v">Reactive Power L2: <span id="ReactivePowerl2_value">N/A</span></p>
                    </div>
                  </div>
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-3-240-v">Reactive Power L3: <span id="ReactivePowerl3_value">N/A</span></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--Back Card-->
        <div class="back face">
          <div class="top-content2">
            <div class="goals2">
              <div class="content5">
                <div class="header">
                  <div class="frame-40639">
                    <div class="total-harmonic-i">React. Power[KVAR]</div>
                    <div class="group-4044">
                      <div class="group-4045">
                        <button class="flip graph return">Graph</button>
                        <svg
                          class="chevron-right5"
                          width="22"
                          height="24"
                          viewBox="0 0 22 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M9.87631 7C9.64641 7 9.4165 7.098 9.24138 7.293C8.89024 7.684 8.89024 8.316 9.24138 8.707L12.2095 12.012L9.35364 15.305C9.00968 15.703 9.01956 16.336 9.37609 16.719C9.73352 17.102 10.302 17.091 10.6459 16.695L14.1142 12.695C14.4546 12.302 14.4501 11.679 14.1035 11.293L10.5112 7.293C10.3361 7.098 10.1062 7 9.87631 7Z"
                            fill="#F3E9E9"
                          />
                        </svg>
  
                        <svg
                          class="chevron-left5"
                          width="23"
                          height="24"
                          viewBox="0 0 23 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M12.5002 6.99999C12.2649 6.99999 12.0305 7.10199 11.8545 7.30499L8.38528 11.305C8.04582 11.698 8.05031 12.321 8.39696 12.707L11.9892 16.707C12.3394 17.098 12.9079 17.098 13.259 16.707C13.6093 16.316 13.6093 15.684 13.259 15.293L10.291 11.988L13.1459 8.69499C13.4907 8.29699 13.4809 7.66399 13.1243 7.28099C12.9492 7.09299 12.7247 6.99999 12.5002 6.99999Z"
                            fill="#F3E9E9"
                          />
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="chart-container">
                  <div id="lineChart5"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- //////6/// -->
    <div class="card">
      <div class="card__inner">
        <!--Front Card-->
        <div class="front face">
          <div class="goals">
            <div class="content5">
              <div class="header">
                <div class="frame-40639">
                  <div class="phase-voltage-v">Appt. Power [KVA]</div>
                  <div class="group-4044">
                    <div class="group-4045">
                      <button class="flip real-data flip-me">Real Data</button>
                      <svg
                        class="chevron-right"
                        width="30"
                        height="24"
                        viewBox="0 0 30 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M13.4198 7C13.1054 7 12.791 7.098 12.5515 7.293C12.0713 7.684 12.0713 8.316 12.5515 8.707L16.6105 12.012L12.705 15.305C12.2346 15.703 12.2481 16.336 12.7357 16.719C13.2245 17.102 14.0019 17.091 14.4723 16.695L19.2154 12.695C19.6809 12.302 19.6748 11.679 19.2007 11.293L14.2881 7.293C14.0486 7.098 13.7342 7 13.4198 7Z"
                          fill="#F3E9E9"
                        />
                      </svg>
  
                      <svg
                        class="chevron-left"
                        width="30"
                        height="24"
                        viewBox="0 0 30 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M16.9109 6.99999C16.5891 6.99999 16.2686 7.10199 16.0279 7.30499L11.2835 11.305C10.8193 11.698 10.8254 12.321 11.2995 12.707L16.2121 16.707C16.6911 17.098 17.4685 17.098 17.9487 16.707C18.4277 16.316 18.4277 15.684 17.9487 15.293L13.8897 11.988L17.794 8.69499C18.2656 8.29699 18.2521 7.66399 17.7645 7.28099C17.525 7.09299 17.218 6.99999 16.9109 6.99999Z"
                          fill="#F3E9E9"
                        />
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
              <div class="details">
                <div class="left-content">
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-1-0-v">Apparent Power L1: <span id="ApparentPowerl1_value">N/A</span></p>
                    </div>
                  </div>
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-2-0-v">Apparent Power L2: <span id="ApparentPowerl2_value">N/A</span></p>
                    </div>
                  </div>
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-3-240-v">Apparent Power L3: <span id="ApparentPowerl3_value">N/A</span></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--Back Card-->
        <div class="back face">
          <div class="top-content2">
            <div class="goals2">
              <div class="content5">
                <div class="header">
                  <div class="frame-40639">
                    <div class="total-harmonic-i">Appt. Power[KVAR]</div>
                    <div class="group-4044">
                      <div class="group-4045">
                        <button class="flip graph return">Graph</button>
                        <svg
                          class="chevron-right5"
                          width="22"
                          height="24"
                          viewBox="0 0 22 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M9.87631 7C9.64641 7 9.4165 7.098 9.24138 7.293C8.89024 7.684 8.89024 8.316 9.24138 8.707L12.2095 12.012L9.35364 15.305C9.00968 15.703 9.01956 16.336 9.37609 16.719C9.73352 17.102 10.302 17.091 10.6459 16.695L14.1142 12.695C14.4546 12.302 14.4501 11.679 14.1035 11.293L10.5112 7.293C10.3361 7.098 10.1062 7 9.87631 7Z"
                            fill="#F3E9E9"
                          />
                        </svg>
  
                        <svg
                          class="chevron-left5"
                          width="23"
                          height="24"
                          viewBox="0 0 23 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M12.5002 6.99999C12.2649 6.99999 12.0305 7.10199 11.8545 7.30499L8.38528 11.305C8.04582 11.698 8.05031 12.321 8.39696 12.707L11.9892 16.707C12.3394 17.098 12.9079 17.098 13.259 16.707C13.6093 16.316 13.6093 15.684 13.259 15.293L10.291 11.988L13.1459 8.69499C13.4907 8.29699 13.4809 7.66399 13.1243 7.28099C12.9492 7.09299 12.7247 6.99999 12.5002 6.99999Z"
                            fill="#F3E9E9"
                          />
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="chart-container">
                  <div id="lineChart6"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- //////7/// -->
    <div class="card">
      <div class="card__inner">
        <!--Front Card-->
        <div class="front face">
          <div class="goals">
            <div class="content5">
              <div class="header">
                <div class="frame-40639">
                  <div class="phase-voltage-v">Phase Agl. Voltage[θ]</div>
                  <div class="group-4044">
                    <div class="group-4045">
                      <button class="flip real-data flip-me">Real Data</button>
                      <svg
                        class="chevron-right"
                        width="30"
                        height="24"
                        viewBox="0 0 30 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M13.4198 7C13.1054 7 12.791 7.098 12.5515 7.293C12.0713 7.684 12.0713 8.316 12.5515 8.707L16.6105 12.012L12.705 15.305C12.2346 15.703 12.2481 16.336 12.7357 16.719C13.2245 17.102 14.0019 17.091 14.4723 16.695L19.2154 12.695C19.6809 12.302 19.6748 11.679 19.2007 11.293L14.2881 7.293C14.0486 7.098 13.7342 7 13.4198 7Z"
                          fill="#F3E9E9"
                        />
                      </svg>
  
                      <svg
                        class="chevron-left"
                        width="30"
                        height="24"
                        viewBox="0 0 30 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M16.9109 6.99999C16.5891 6.99999 16.2686 7.10199 16.0279 7.30499L11.2835 11.305C10.8193 11.698 10.8254 12.321 11.2995 12.707L16.2121 16.707C16.6911 17.098 17.4685 17.098 17.9487 16.707C18.4277 16.316 18.4277 15.684 17.9487 15.293L13.8897 11.988L17.794 8.69499C18.2656 8.29699 18.2521 7.66399 17.7645 7.28099C17.525 7.09299 17.218 6.99999 16.9109 6.99999Z"
                          fill="#F3E9E9"
                        />
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
              <div class="details">
                <div class="left-content">
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-1-0-v">L1: <span id="PhaseAngleVoltagel1_value">N/A</span></p>
                    </div>
                  </div>
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-2-0-v">L2: <span id="PhaseAngleVoltagel2_value">N/A</span></p>
                    </div>
                  </div>
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-3-240-v">L3: <span id="PhaseAngleVoltagel3_value">N/A</span></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--Back Card-->
        <div class="back face">
          <div class="top-content2">
            <div class="goals2">
              <div class="content5">
                <div class="header">
                  <div class="frame-40639">
                    <div class="total-harmonic-i">Phase Agl. Voltage[θ]</div>
                    <div class="group-4044">
                      <div class="group-4045">
                        <button class="flip graph return">Graph</button>
                        <svg
                          class="chevron-right5"
                          width="22"
                          height="24"
                          viewBox="0 0 22 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M9.87631 7C9.64641 7 9.4165 7.098 9.24138 7.293C8.89024 7.684 8.89024 8.316 9.24138 8.707L12.2095 12.012L9.35364 15.305C9.00968 15.703 9.01956 16.336 9.37609 16.719C9.73352 17.102 10.302 17.091 10.6459 16.695L14.1142 12.695C14.4546 12.302 14.4501 11.679 14.1035 11.293L10.5112 7.293C10.3361 7.098 10.1062 7 9.87631 7Z"
                            fill="#F3E9E9"
                          />
                        </svg>
  
                        <svg
                          class="chevron-left5"
                          width="23"
                          height="24"
                          viewBox="0 0 23 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M12.5002 6.99999C12.2649 6.99999 12.0305 7.10199 11.8545 7.30499L8.38528 11.305C8.04582 11.698 8.05031 12.321 8.39696 12.707L11.9892 16.707C12.3394 17.098 12.9079 17.098 13.259 16.707C13.6093 16.316 13.6093 15.684 13.259 15.293L10.291 11.988L13.1459 8.69499C13.4907 8.29699 13.4809 7.66399 13.1243 7.28099C12.9492 7.09299 12.7247 6.99999 12.5002 6.99999Z"
                            fill="#F3E9E9"
                          />
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="chart-container">
                  <div id="lineChart7"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- //////8/// -->
    <div class="card">
      <div class="card__inner">
        <!--Front Card-->
        <div class="front face">
          <div class="goals">
            <div class="content5">
              <div class="header">
                <div class="frame-40639">
                  <div class="phase-voltage-v">Phase Agl. Current[θ]</div>
                  <div class="group-4044">
                    <div class="group-4045">
                      <button class="flip real-data flip-me">Real Data</button>
                      <svg
                        class="chevron-right"
                        width="30"
                        height="24"
                        viewBox="0 0 30 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M13.4198 7C13.1054 7 12.791 7.098 12.5515 7.293C12.0713 7.684 12.0713 8.316 12.5515 8.707L16.6105 12.012L12.705 15.305C12.2346 15.703 12.2481 16.336 12.7357 16.719C13.2245 17.102 14.0019 17.091 14.4723 16.695L19.2154 12.695C19.6809 12.302 19.6748 11.679 19.2007 11.293L14.2881 7.293C14.0486 7.098 13.7342 7 13.4198 7Z"
                          fill="#F3E9E9"
                        />
                      </svg>
  
                      <svg
                        class="chevron-left"
                        width="30"
                        height="24"
                        viewBox="0 0 30 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M16.9109 6.99999C16.5891 6.99999 16.2686 7.10199 16.0279 7.30499L11.2835 11.305C10.8193 11.698 10.8254 12.321 11.2995 12.707L16.2121 16.707C16.6911 17.098 17.4685 17.098 17.9487 16.707C18.4277 16.316 18.4277 15.684 17.9487 15.293L13.8897 11.988L17.794 8.69499C18.2656 8.29699 18.2521 7.66399 17.7645 7.28099C17.525 7.09299 17.218 6.99999 16.9109 6.99999Z"
                          fill="#F3E9E9"
                        />
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
              <div class="details">
                <div class="left-content">
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-1-0-v">L1: <span id="PhaseAngleCurrentl1_value">N/A</span></p>
                    </div>
                  </div>
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-2-0-v">L2: <span id="PhaseAngleCurrentl2_value">N/A</span></p>
                    </div>
                  </div>
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-3-240-v">L3: <span id="PhaseAngleCurrentl3_value">N/A</span></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--Back Card-->
        <div class="back face">
          <div class="top-content2">
            <div class="goals2">
              <div class="content5">
                <div class="header">
                  <div class="frame-40639">
                    <div class="total-harmonic-i">Phase Agl. Current[θ]</div>
                    <div class="group-4044">
                      <div class="group-4045">
                        <button class="flip graph return">Graph</button>
                        <svg
                          class="chevron-right5"
                          width="22"
                          height="24"
                          viewBox="0 0 22 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M9.87631 7C9.64641 7 9.4165 7.098 9.24138 7.293C8.89024 7.684 8.89024 8.316 9.24138 8.707L12.2095 12.012L9.35364 15.305C9.00968 15.703 9.01956 16.336 9.37609 16.719C9.73352 17.102 10.302 17.091 10.6459 16.695L14.1142 12.695C14.4546 12.302 14.4501 11.679 14.1035 11.293L10.5112 7.293C10.3361 7.098 10.1062 7 9.87631 7Z"
                            fill="#F3E9E9"
                          />
                        </svg>
  
                        <svg
                          class="chevron-left5"
                          width="23"
                          height="24"
                          viewBox="0 0 23 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M12.5002 6.99999C12.2649 6.99999 12.0305 7.10199 11.8545 7.30499L8.38528 11.305C8.04582 11.698 8.05031 12.321 8.39696 12.707L11.9892 16.707C12.3394 17.098 12.9079 17.098 13.259 16.707C13.6093 16.316 13.6093 15.684 13.259 15.293L10.291 11.988L13.1459 8.69499C13.4907 8.29699 13.4809 7.66399 13.1243 7.28099C12.9492 7.09299 12.7247 6.99999 12.5002 6.99999Z"
                            fill="#F3E9E9"
                          />
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="chart-container">
                  <div id="lineChart8"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- //////9/// -->
    <div class="card">
      <div class="card__inner">
        <!--Front Card-->
        <div class="front face">
          <div class="goals">
            <div class="content5">
              <div class="header">
                <div class="frame-40639">
                  <div class="phase-voltage-v">Frequency [Hz]</div>
                  <div class="group-4044">
                    <div class="group-4045">
                      <button class="flip real-data flip-me">Real Data</button>
                      <svg
                        class="chevron-right"
                        width="30"
                        height="24"
                        viewBox="0 0 30 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M13.4198 7C13.1054 7 12.791 7.098 12.5515 7.293C12.0713 7.684 12.0713 8.316 12.5515 8.707L16.6105 12.012L12.705 15.305C12.2346 15.703 12.2481 16.336 12.7357 16.719C13.2245 17.102 14.0019 17.091 14.4723 16.695L19.2154 12.695C19.6809 12.302 19.6748 11.679 19.2007 11.293L14.2881 7.293C14.0486 7.098 13.7342 7 13.4198 7Z"
                          fill="#F3E9E9"
                        />
                      </svg>
  
                      <svg
                        class="chevron-left"
                        width="30"
                        height="24"
                        viewBox="0 0 30 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M16.9109 6.99999C16.5891 6.99999 16.2686 7.10199 16.0279 7.30499L11.2835 11.305C10.8193 11.698 10.8254 12.321 11.2995 12.707L16.2121 16.707C16.6911 17.098 17.4685 17.098 17.9487 16.707C18.4277 16.316 18.4277 15.684 17.9487 15.293L13.8897 11.988L17.794 8.69499C18.2656 8.29699 18.2521 7.66399 17.7645 7.28099C17.525 7.09299 17.218 6.99999 16.9109 6.99999Z"
                          fill="#F3E9E9"
                        />
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
              <div class="details">
                <div class="left-content">
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-1-0-v">L1: <span id="Frequency_value">N/A</span></p>
                    </div>
                  </div>
                  <div class="target-achieved">
                    <div class="text">
                      <!-- <p class="l-2-0-v">L1: <span id="Frequency_value">N/A</span></p> -->
                    </div>
                  </div>
                  <div class="target-achieved">
                    <div class="text">
                      <!-- <p class="l-3-240-v">L1: <span id="Frequency_value">N/A</span></p> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--Back Card-->
        <div class="back face">
          <div class="top-content2">
            <div class="goals2">
              <div class="content5">
                <div class="header">
                  <div class="frame-40639">
                    <div class="total-harmonic-i">Frequency [Hz]</div>
                    <div class="group-4044">
                      <div class="group-4045">
                        <button class="flip graph return">Graph</button>
                        <svg
                          class="chevron-right5"
                          width="22"
                          height="24"
                          viewBox="0 0 22 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M9.87631 7C9.64641 7 9.4165 7.098 9.24138 7.293C8.89024 7.684 8.89024 8.316 9.24138 8.707L12.2095 12.012L9.35364 15.305C9.00968 15.703 9.01956 16.336 9.37609 16.719C9.73352 17.102 10.302 17.091 10.6459 16.695L14.1142 12.695C14.4546 12.302 14.4501 11.679 14.1035 11.293L10.5112 7.293C10.3361 7.098 10.1062 7 9.87631 7Z"
                            fill="#F3E9E9"
                          />
                        </svg>
  
                        <svg
                          class="chevron-left5"
                          width="23"
                          height="24"
                          viewBox="0 0 23 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M12.5002 6.99999C12.2649 6.99999 12.0305 7.10199 11.8545 7.30499L8.38528 11.305C8.04582 11.698 8.05031 12.321 8.39696 12.707L11.9892 16.707C12.3394 17.098 12.9079 17.098 13.259 16.707C13.6093 16.316 13.6093 15.684 13.259 15.293L10.291 11.988L13.1459 8.69499C13.4907 8.29699 13.4809 7.66399 13.1243 7.28099C12.9492 7.09299 12.7247 6.99999 12.5002 6.99999Z"
                            fill="#F3E9E9"
                          />
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="chart-container">
                  <div id="lineChart9"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- //////10/// -->
    <div class="card">
      <div class="card__inner">
        <!--Front Card-->
        <div class="front face">
          <div class="goals">
            <div class="content5">
              <div class="header">
                <div class="frame-40639">
                  <div class="phase-voltage-v">THD Current I [%]</div>
                  <div class="group-4044">
                    <div class="group-4045">
                      <button class="flip real-data flip-me">Real Data</button>
                      <svg
                        class="chevron-right"
                        width="30"
                        height="24"
                        viewBox="0 0 30 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M13.4198 7C13.1054 7 12.791 7.098 12.5515 7.293C12.0713 7.684 12.0713 8.316 12.5515 8.707L16.6105 12.012L12.705 15.305C12.2346 15.703 12.2481 16.336 12.7357 16.719C13.2245 17.102 14.0019 17.091 14.4723 16.695L19.2154 12.695C19.6809 12.302 19.6748 11.679 19.2007 11.293L14.2881 7.293C14.0486 7.098 13.7342 7 13.4198 7Z"
                          fill="#F3E9E9"
                        />
                      </svg>
  
                      <svg
                        class="chevron-left"
                        width="30"
                        height="24"
                        viewBox="0 0 30 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M16.9109 6.99999C16.5891 6.99999 16.2686 7.10199 16.0279 7.30499L11.2835 11.305C10.8193 11.698 10.8254 12.321 11.2995 12.707L16.2121 16.707C16.6911 17.098 17.4685 17.098 17.9487 16.707C18.4277 16.316 18.4277 15.684 17.9487 15.293L13.8897 11.988L17.794 8.69499C18.2656 8.29699 18.2521 7.66399 17.7645 7.28099C17.525 7.09299 17.218 6.99999 16.9109 6.99999Z"
                          fill="#F3E9E9"
                        />
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
              <div class="details">
                <div class="left-content">
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-1-0-v">L1: <span id="TotalHarmonicl1_value">N/A</span></p>
                    </div>
                  </div>
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-2-0-v">L2: <span id="TotalHarmonicl2_value">N/A</span></p>
                    </div>
                  </div>
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-3-240-v">L3: <span id="TotalHarmonicl3_value">N/A</span></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--Back Card-->
        <div class="back face">
          <div class="top-content2">
            <div class="goals2">
              <div class="content5">
                <div class="header">
                  <div class="frame-40639">
                    <div class="total-harmonic-i">THD Current I [%]</div>
                    <div class="group-4044">
                      <div class="group-4045">
                        <button class="flip graph return">Graph</button>
                        <svg
                          class="chevron-right5"
                          width="22"
                          height="24"
                          viewBox="0 0 22 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M9.87631 7C9.64641 7 9.4165 7.098 9.24138 7.293C8.89024 7.684 8.89024 8.316 9.24138 8.707L12.2095 12.012L9.35364 15.305C9.00968 15.703 9.01956 16.336 9.37609 16.719C9.73352 17.102 10.302 17.091 10.6459 16.695L14.1142 12.695C14.4546 12.302 14.4501 11.679 14.1035 11.293L10.5112 7.293C10.3361 7.098 10.1062 7 9.87631 7Z"
                            fill="#F3E9E9"
                          />
                        </svg>
  
                        <svg
                          class="chevron-left5"
                          width="23"
                          height="24"
                          viewBox="0 0 23 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M12.5002 6.99999C12.2649 6.99999 12.0305 7.10199 11.8545 7.30499L8.38528 11.305C8.04582 11.698 8.05031 12.321 8.39696 12.707L11.9892 16.707C12.3394 17.098 12.9079 17.098 13.259 16.707C13.6093 16.316 13.6093 15.684 13.259 15.293L10.291 11.988L13.1459 8.69499C13.4907 8.29699 13.4809 7.66399 13.1243 7.28099C12.9492 7.09299 12.7247 6.99999 12.5002 6.99999Z"
                            fill="#F3E9E9"
                          />
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="chart-container">
                  <div id="lineChart10"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- //////11/// -->
    <div class="card">
      <div class="card__inner">
        <!--Front Card-->
        <div class="front face">
          <div class="goals">
            <div class="content5">
              <div class="header">
                <div class="frame-40639">
                  <div class="phase-voltage-v">THD Voltage U [%]</div>
                  <div class="group-4044">
                    <div class="group-4045">
                      <button class="flip real-data flip-me">Real Data</button>
                      <svg
                        class="chevron-right"
                        width="30"
                        height="24"
                        viewBox="0 0 30 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M13.4198 7C13.1054 7 12.791 7.098 12.5515 7.293C12.0713 7.684 12.0713 8.316 12.5515 8.707L16.6105 12.012L12.705 15.305C12.2346 15.703 12.2481 16.336 12.7357 16.719C13.2245 17.102 14.0019 17.091 14.4723 16.695L19.2154 12.695C19.6809 12.302 19.6748 11.679 19.2007 11.293L14.2881 7.293C14.0486 7.098 13.7342 7 13.4198 7Z"
                          fill="#F3E9E9"
                        />
                      </svg>
  
                      <svg
                        class="chevron-left"
                        width="30"
                        height="24"
                        viewBox="0 0 30 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M16.9109 6.99999C16.5891 6.99999 16.2686 7.10199 16.0279 7.30499L11.2835 11.305C10.8193 11.698 10.8254 12.321 11.2995 12.707L16.2121 16.707C16.6911 17.098 17.4685 17.098 17.9487 16.707C18.4277 16.316 18.4277 15.684 17.9487 15.293L13.8897 11.988L17.794 8.69499C18.2656 8.29699 18.2521 7.66399 17.7645 7.28099C17.525 7.09299 17.218 6.99999 16.9109 6.99999Z"
                          fill="#F3E9E9"
                        />
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
              <div class="details">
                <div class="left-content">
                  <div class="target-achieved">
                    <div class="text">
                      <div class="l-1-0-v">L1 : N/A</div>
                    </div>
                  </div>
                  <div class="target-achieved">
                    <div class="text">
                      <div class="l-2-0-v">L2 : N/A</div>
                    </div>
                  </div>
                  <div class="target-achieved">
                    <div class="text">
                      <div class="l-3-240-v">L3 : N/A</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--Back Card-->
        <div class="back face">
          <div class="top-content2">
            <div class="goals2">
              <div class="content5">
                <div class="header">
                  <div class="frame-40639">
                    <div class="total-harmonic-i">THD Voltage U [%]</div>
                    <div class="group-4044">
                      <div class="group-4045">
                        <button class="flip graph return">Graph</button>
                        <svg
                          class="chevron-right5"
                          width="22"
                          height="24"
                          viewBox="0 0 22 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M9.87631 7C9.64641 7 9.4165 7.098 9.24138 7.293C8.89024 7.684 8.89024 8.316 9.24138 8.707L12.2095 12.012L9.35364 15.305C9.00968 15.703 9.01956 16.336 9.37609 16.719C9.73352 17.102 10.302 17.091 10.6459 16.695L14.1142 12.695C14.4546 12.302 14.4501 11.679 14.1035 11.293L10.5112 7.293C10.3361 7.098 10.1062 7 9.87631 7Z"
                            fill="#F3E9E9"
                          />
                        </svg>
  
                        <svg
                          class="chevron-left5"
                          width="23"
                          height="24"
                          viewBox="0 0 23 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M12.5002 6.99999C12.2649 6.99999 12.0305 7.10199 11.8545 7.30499L8.38528 11.305C8.04582 11.698 8.05031 12.321 8.39696 12.707L11.9892 16.707C12.3394 17.098 12.9079 17.098 13.259 16.707C13.6093 16.316 13.6093 15.684 13.259 15.293L10.291 11.988L13.1459 8.69499C13.4907 8.29699 13.4809 7.66399 13.1243 7.28099C12.9492 7.09299 12.7247 6.99999 12.5002 6.99999Z"
                            fill="#F3E9E9"
                          />
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="chart-container">
                  <div id="lineChart11"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- //////12/// -->
    <div class="card">
      <div class="card__inner">
        <!--Front Card-->
        <div class="front face">
          <div class="goals">
            <div class="content5">
              <div class="header">
                <div class="frame-40639">
                  <div class="phase-voltage-v">Power Factor</div>
                  <div class="group-4044">
                    <div class="group-4045">
                      <button class="flip real-data flip-me">Real Data</button>
                      <svg
                        class="chevron-right"
                        width="30"
                        height="24"
                        viewBox="0 0 30 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M13.4198 7C13.1054 7 12.791 7.098 12.5515 7.293C12.0713 7.684 12.0713 8.316 12.5515 8.707L16.6105 12.012L12.705 15.305C12.2346 15.703 12.2481 16.336 12.7357 16.719C13.2245 17.102 14.0019 17.091 14.4723 16.695L19.2154 12.695C19.6809 12.302 19.6748 11.679 19.2007 11.293L14.2881 7.293C14.0486 7.098 13.7342 7 13.4198 7Z"
                          fill="#F3E9E9"
                        />
                      </svg>
  
                      <svg
                        class="chevron-left"
                        width="30"
                        height="24"
                        viewBox="0 0 30 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M16.9109 6.99999C16.5891 6.99999 16.2686 7.10199 16.0279 7.30499L11.2835 11.305C10.8193 11.698 10.8254 12.321 11.2995 12.707L16.2121 16.707C16.6911 17.098 17.4685 17.098 17.9487 16.707C18.4277 16.316 18.4277 15.684 17.9487 15.293L13.8897 11.988L17.794 8.69499C18.2656 8.29699 18.2521 7.66399 17.7645 7.28099C17.525 7.09299 17.218 6.99999 16.9109 6.99999Z"
                          fill="#F3E9E9"
                        />
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
              <div class="details">
                <div class="left-content">
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-1-0-v">L1: <span id="PowerFactorl1_value">N/A</span></p>
                    </div>
                  </div>
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-2-0-v">L2: <span id="PowerFactorl2_value">N/A</span></p>
                    </div>
                  </div>
                  <div class="target-achieved">
                    <div class="text">
                      <p class="l-3-240-v">L3: <span id="PowerFactorl3_value">N/A</span></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--Back Card-->
        <div class="back face">
          <div class="top-content2">
            <div class="goals2">
              <div class="content5">
                <div class="header">
                  <div class="frame-40639">
                    <div class="total-harmonic-i">Power Factor</div>
                    <div class="group-4044">
                      <div class="group-4045">
                        <button class="flip graph return">Graph</button>
                        <svg
                          class="chevron-right5"
                          width="22"
                          height="24"
                          viewBox="0 0 22 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M9.87631 7C9.64641 7 9.4165 7.098 9.24138 7.293C8.89024 7.684 8.89024 8.316 9.24138 8.707L12.2095 12.012L9.35364 15.305C9.00968 15.703 9.01956 16.336 9.37609 16.719C9.73352 17.102 10.302 17.091 10.6459 16.695L14.1142 12.695C14.4546 12.302 14.4501 11.679 14.1035 11.293L10.5112 7.293C10.3361 7.098 10.1062 7 9.87631 7Z"
                            fill="#F3E9E9"
                          />
                        </svg>
  
                        <svg
                          class="chevron-left5"
                          width="23"
                          height="24"
                          viewBox="0 0 23 24"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M12.5002 6.99999C12.2649 6.99999 12.0305 7.10199 11.8545 7.30499L8.38528 11.305C8.04582 11.698 8.05031 12.321 8.39696 12.707L11.9892 16.707C12.3394 17.098 12.9079 17.098 13.259 16.707C13.6093 16.316 13.6093 15.684 13.259 15.293L10.291 11.988L13.1459 8.69499C13.4907 8.29699 13.4809 7.66399 13.1243 7.28099C12.9492 7.09299 12.7247 6.99999 12.5002 6.99999Z"
                            fill="#F3E9E9"
                          />
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="chart-container">
                  <div id="lineChart12"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      </div>
    </div>
    
  </div>
  
  <!-- Your HTML content for displaying voltage values -->
</main>
<script src="notification_language.js"></script>
<script src="activemenuclick.js"></script>
<!--Jquery-->
<script src="jquery-3.5.1.js"></script>
<!--JS-->    
<script src="dashboard1.js"></script>
<script src="dashboard2.js"></script>
<script src="dashboard3.js"></script>

</body>
</html>