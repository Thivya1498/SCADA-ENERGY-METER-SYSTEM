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
    // Get the selected Energy Meter ID, Date, and Data Type from the AJAX request
    $selectedEnergyMeterId = $_GET['customer_serial_number'];
    $selectedDate = $_GET['date'];
    $selectedDataType = $_GET['datatype'];

    // Determine the columns to select based on the data type
    $columnsToSelect = [];
    if ($selectedDataType === 'Voltage Line to Neutral [V]') {
        $columnsToSelect = ['time', 'L1', 'L2', 'L3'];
    } elseif ($selectedDataType === 'Voltage Line to Line [V]') {
        $columnsToSelect = ['time', 'L12', 'L32', 'L13'];
    } elseif ($selectedDataType === 'Current [A]') {
        $columnsToSelect = ['time', 'I1', 'I2', 'I3', 'I_Neutral'];
    }

    // Prepare the SQL query to fetch data for the selected columns and date
    $columns = implode(', ', $columnsToSelect);
    $sql = "SELECT $columns FROM store WHERE customer_serial_number = ? AND DATE(date) = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $selectedEnergyMeterId, $selectedDate);
    $stmt->execute();
    $result = $stmt->get_result();

    // Start building the response
    $response = "<table>";
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
