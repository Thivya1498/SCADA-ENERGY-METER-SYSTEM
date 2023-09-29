<?php
// Assuming you have already established a connection to the database.
// Replace 'your_username_here', 'your_password_here', and 'your_db_name_here' with appropriate values.

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ev_system";


// Establish the database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the form was submitted for register
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_register"])) {
    // Retrieve the user input from the form
    $username = $_POST["username"];
    //$phone_number = $_POST["phone_number"];
    //$email = $_POST["email"];
    $password = $_POST["password"];
    // $confirm_password = $_POST["confirm_password"];

    // Validate input and perform any necessary checks (e.g., password match, strong password requirements, etc.)
    // if ($password !== $confirm_password) {
    //     echo "Error: Password and confirm password do not match.";
    // } else {
        // Hash the password for security (you should use password_hash() function for better security)
        //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL statement to insert the new user into the database
        $sql = "INSERT INTO login_user (username, password) VALUES ('$username', '$password')";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful. You can now log in.";
            header("Location: index.html");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
// }

// Close the database connection
$conn->close();
?>
<!-- HTML Form for Registration -->

