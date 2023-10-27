<?php
session_start();

// If the loggedInUser session variable isn't set, redirect to login page
if (!isset($_SESSION['loggedInUser'])) {
    header('Location: login.php');
    exit(); // Always exit after sending a header
}
?>
