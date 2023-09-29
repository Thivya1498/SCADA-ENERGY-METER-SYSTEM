<?php
// Assuming you have already established a connection to the database.
// Replace 'your_username_here', 'your_password_here', and 'your_db_name_here' with appropriate values.


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ev_system";


// Establish the database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the form was submitted for login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_login"])) {
    // Retrieve the user input from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare the SQL statement to select the user with the provided username
    $sql = "SELECT * FROM login_user WHERE username = '$username' AND password = '$password'";

    // Execute the query
    $result = $conn->query($sql);

    // Check if any rows were returned (user with the provided username exists)
    if ($result->num_rows > 0) {
        // Fetch the user record from the result
        $user = $result->fetch_assoc();
        echo "Successful.";
      //  $hashed_password_from_db = $user["password"];
        // Verify the password using password_verify() function
    //    if (password_verify($password, $hashed_password_from_db)) {
            // User authenticated, redirect to a secure page or set a session, etc.
      //      echo "Sign In Successful.";
      //  } else {
            // Invalid credentials, display an error message
     //       echo "Invalid username or password.";
     //   }
        header("Location:/WEB%20APP%20ENERGY%20METER/sidemenu/homepage/homepage.html");
        exit(); // Make sure to exit the script after the redirect
    } else {
        // User with the provided username not found, display an error message
        echo "Invalid username or password.";
    }
}

// Close the database connection
$conn->close();
?>
