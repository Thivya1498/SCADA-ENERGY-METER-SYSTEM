<?php
session_start();

$servername = "localhost";
$username = "reactive_rnd";
$password = "reactive@123";
$dbname = "reactive_data";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user_login WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        
        $_SESSION['loggedInUser']['username'] = $user['username'];

        // Assuming the 'role' column exists in your user_login table
        $_SESSION['loggedInUser']['role'] = $user['role'];

        header('Location: maps.php');
        exit;
    } else {
        echo "<script>alert('Incorrect username or password.');</script>";
    }
}
?>

    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loginstyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="loginscript.js" defer></script>
    <title>Energy Meter Management System</title>
    </head>
    <body>
        <div class="container">
            <div class="card">
                <div class="card-front">
                    <div class="header-section">
                        <img class="meter-image" src="images/meter.png"alt="Energy Meter">
                        <h1>Energy Meter<br>Management System</h1>
                    </div>
                    <h3>Welcome Back, Please login to your account.</h3>
                    
                    <h1>Log In</h1>
                    <form method="POST" action="login.php">
                        <div class="input-field">
                            <i class="icon fas fa-user"></i>
                            <input type="text" name="username" placeholder="Enter Username">
                        </div>
                        <div class="input-wrapper">
                            <i class="icon fas fa-lock"></i>
                            <input type="password" name="password" placeholder="Enter Password" id="password">
                            <i onclick="toggleVisibility('password', 'togglePassword')" id="togglePassword" class="icon fas fa-eye toggle-icon"></i>
                        </div>
                        <div class="remember-forgot-section">
                            <label>
                                <input type="checkbox" name="remember"> Remember Me
                            </label>
                            <span class="forgot-password" onclick="showForgotPasswordModal()">Forgot Password?</span>
                        </div>
                        <button class="login-btn" name="submit_login" type="submit">LOGIN →</button>
                        <p>Don’t have an account? <span class="highlighted-action" onclick="flipCard()">SIGN UP</span></p>
                        </form>
                    </div>
                    
            <!-- Sign Up Form -->
            <div class="card-back">
                <div class="header-section">
                    <img class="meter-image" src="images/meter.png" alt="Energy Meter Management System">
                    <h1>Energy Meter<br>Management System</h1>
                </div>
                <h1>Sign Up</h1>
                <p>Please fill the form to register.</p>
                <form method="POST" action="register.php">
                    <div class="input-field">
                        <i class="icon fas fa-user"></i>
                        <input type="text" name="username" placeholder="Enter Username">
                    </div>
                    <div class="input-wrapper">
                        <i class="icon fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Enter Password" id="signupPassword">
                        <i onclick="toggleVisibility('signupPassword', 'toggleSignupPassword')" id="toggleSignupPassword" class="icon fas fa-eye toggle-icon"></i>
                    </div>
                    <div class="input-wrapper">
                        <i class="icon fas fa-lock"></i>
                        <input type="password" name="confirm_password" placeholder="Enter Confirm Password" id="confirmPassword">
                        <i onclick="toggleVisibility('confirmPassword', 'toggleConfirmPassword')" id="toggleConfirmPassword" class="icon fas fa-eye toggle-icon"></i>
                    </div>                
                    <button class="signup-btn" name="submit_signup" type="submit">SIGN UP →</button>
                </form>
                <p>Already have an account? <span class="highlighted-action" onclick="flipCard()">LOGIN</span></p>
            </div>      
        </div>
        <div class="modal" id="forgotPasswordModal">
            <div class="modal-backdrop" onclick="backToLogin()"></div>
            <div class="card-forgot">
                <div class="header-section">
                    <img class="meter-image" src="images/meter.png" alt="Energy Meter">
                    <h1>Energy Meter<br>Management System</h1>
                </div>
                <h1><i class="fas fa-unlock"></i><span class="forgottext"> Forgot Password</h1></span>
                <p><span class="guideforgot">You will receive a link to create a new password via email. Please enter your email to receive password reset link account.</span></p>
                <div class="input-field">
                    <i class="fas fa-envelope icon-email"></i>
                    <input type="email" placeholder="Enter Email">
                </div>
                <div class="buttons-group">
                    <button class="submit-btn">SUBMIT</button>
                    <button class="cancel-btn" onclick="backToLogin()">CANCEL</button>
                </div>
            </div>
    </div>
        <div class="image-section">
            <img class="section-image" src="images/4.png" alt="Image 1">
        </div>
    </div>
</body>
</html>
