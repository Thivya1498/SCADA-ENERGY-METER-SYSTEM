<?php session_start();
if(empty($_SESSION['username'])):
    header('Location:index.html');
endif;
?>
<!DOCTYPE html>
<html>
<body>
    <div style="width:150px;margin:auto;height:500px;margin-top:300px">

    <?php
    // Assuming you have already established a connection to the database.
    // Replace 'your_username_here', 'your_password_here', and 'your_db_name_here' with appropriate values.
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ev_system";
    
    // Establish the database connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if (mysqli_connect_error())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    session_destroy();

     echo '<meta http-equiv="refresh" content="2;url=index.htlm">';
     echo '<progress max=100><strong>Progress: 60% done.</strong></progress><br>';
     echo '<span class="itext">Logging out please wait!...</span>';

     $conn->close();
    ?>
    </div>

</body>
</html>