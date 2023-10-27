<?php
$servername = "localhost";
$username = "reactive_rnd";
$password = "reactive@123";
$dbname = "reactive_data";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit_signup'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $checkSql = "SELECT username FROM user_login WHERE username = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param('s', $username);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        echo "<script>alert('The username is already taken. Please choose another one.');</script>";
    } else {
        if ($password !== $confirm_password) {
            echo "<script>alert('Passwords do not match.');</script>";
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user_login (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $username, $hashedPassword);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful.');</script>";
        } else {
            echo "<script>alert('Error: {$stmt->error}');</script>";
        }
    }
}
?>