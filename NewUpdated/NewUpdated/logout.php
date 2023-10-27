<?php
session_start();
unset($_SESSION['loggedInUser']);  // remove logged-in user details
session_destroy();  // destroy session
header('Location: login.php');  // redirect to login page after logout
exit();
?>
