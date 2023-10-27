<?php
// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "energy_meter_admin";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data (with null coalescing for safety)
$name = $_POST['name'] ?? '';
$timezone = $_POST['timezone'] ?? '';
$country = $_POST['country'] ?? '';
$state = $_POST['state'] ?? '';
$city = $_POST['city'] ?? '';
$address = $_POST['address'] ?? '';
$currency = $_POST['currency'] ?? '';
$powerTariff = isset($_POST['powerTariff']) ? implode(', ', $_POST['powerTariff']) : "";
$billingDay = $_POST['billingDay'] ?? '';
$remark = $_POST['remark'] ?? '';
$location = $_POST['location'] ?? '';
//$sortNo = $_POST['sortNo'] ?? '';
//$sn = $_POST['sn'] ?? '';

// Insert data into the database
$sql = "INSERT INTO form_data (name, timezone, country, state, city, address, currency, power_tariff, billing_day, remark, location)
        VALUES ('$name', '$timezone', '$country', '$state', '$city', '$address', '$currency', '$powerTariff', '$billingDay', '$remark', '$location')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
