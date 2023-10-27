<?php
// Database connection details
$servername = "localhost";
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
    // Get the selected Energy Meter ID, Date, and Data Type from the AJAX request
    $selectedEnergyMeterId = $_GET['customer_serial_number'];
    // $selectedDate = $_GET['date'];
    $startDate = isset($_GET['start_date']) ? $_GET['start_date'] : date("Y-m-d", strtotime("-30 days"));
    $endDate = isset($_GET['end_date']) ? $_GET['end_date'] : date("Y-m-d");
    $selectedDataType = $_GET['datatype'];


    
    // Determine the columns to select based on the data type
    $columnsToSelect = [];
    if ($selectedDataType === 'Voltage Line to Neutral [V]') {
        $columnsToSelect = ['time', 'L1', 'L2', 'L3'];
    } elseif ($selectedDataType === 'Voltage Line to Line [V]') {
        $columnsToSelect = ['time', 'L12', 'L32', 'L13'];
    } elseif ($selectedDataType === 'Current [A]') {
        $columnsToSelect = ['time', 'I1', 'I2', 'I3', 'I_Neutral'];
    } elseif ($selectedDataType === 'Active Power') {
        $columnsToSelect = ['time', 'A_P_L1', 'A_P_L2', 'A_P_L3',];
    } elseif ($selectedDataType === 'Apparent Power') {
        $columnsToSelect = ['time', 'App_P_L1', 'App_P_L2', 'App_P_L3',];
    } elseif ($selectedDataType === 'Reactive Power [var]') {
    $columnsToSelect = ['time', 'R_P_L1', 'R_P_L2', 'R_P_L3',];
    }

    // Prepare the SQL query to fetch data for the selected columns and date
    $columns = implode(', ', $columnsToSelect);
    // $sql = "SELECT $columns FROM store WHERE customer_serial_number = ? AND DATE(date) = ?";
    // $stmt = $conn->prepare($sql);
    // $stmt->bind_param("ss", $selectedEnergyMeterId, $selectedDate);
    $sql = "SELECT $columns FROM store WHERE customer_serial_number = ? AND DATE(date) BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $selectedEnergyMeterId, $startDate, $endDate);

    $stmt->execute();
    $result = $stmt->get_result();

    // Initialize the response variable
    $response = "";

    $response .= "<table>";
    $response .= "<tr><th>Last Update</th>"; // Change header label to "Last Update"
    
    foreach ($columnsToSelect as $column) {
        if ($column !== 'time') {
            $response .= "<th>" . $column . "</th>";
        }
    }
    
    $response .= "</tr>";

    while ($row = $result->fetch_assoc()) {
        $response .= "<tr>";
        $response .= "<td>" . $row['time'] . "</td>";
        
        foreach ($columnsToSelect as $column) {
            if ($column !== 'time') {
                $response .= "<td>" . $row[$column] . " </td>";
            }
        }
        
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
