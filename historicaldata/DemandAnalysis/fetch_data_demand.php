<?php
// Database connection details
$servername = "103.6.198.160";
$username = "reactive_rnd";
$password = "reactive@123";
$dbname = "reactive_data";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the AJAX request was made
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Get the selected Energy Meter ID, Date Filter, Interval, and Data Type from the AJAX request
    $selectedEnergyMeterId = $_GET['customer_serial_number'];
    $selectedDateFilter = $_GET['dateFilter'];
    $selectedInterval = $_GET['interval'];
    $selectedDataType = $_GET['datatype'];

    // Determine the appropriate table name based on the selected Date Filter
    $tableName = "";
    if ($selectedDateFilter === 'today') {
        $tableName = 'store_day';
    } elseif ($selectedDateFilter === 'month') {
        $tableName = 'store_month';
    } elseif ($selectedDateFilter === 'year') {
        $tableName = 'store_years';
    }

    // Determine the column to select based on the data type (Max Power)
    $columnToSelect = "";
    if ($selectedDataType === 'Max Power') {
        $columnToSelect = 'max_power_column_name'; // Replace 'max_power_column_name' with the actual column name for Max Power in your table.
    }

    // Prepare the SQL query to fetch Max Power data from the selected table
    $sql = "SELECT date, time, $columnToSelect FROM $tableName WHERE customer_serial_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $selectedEnergyMeterId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Initialize the response variable
    $response = "";

    $response .= "<table>";
    $response .= "<tr><th>Date</th>"; // Column for Date
    $response .= "<th>Time</th>"; // Column for Time
    $response .= "<th>Max Power</th>"; // Column for Max Power

    $response .= "</tr>";

    while ($row = $result->fetch_assoc()) {
        $response .= "<tr>";
        $response .= "<td>" . $row['date'] . "</td>"; // Display Date
        $response .= "<td>" . $row['time'] . "</td>"; // Display Time
        $response .= "<td>" . $row[$columnToSelect] . " </td>"; // Display Max Power
        $response .= "</tr>";
    }

    $response .= "</table>";

    // Close the database connection
    $stmt->close();

    // Return the response
    echo $response;
}

$conn->close();
?>
