<?php
session_start();
?>

<?php

$servername = "";
$username = "";
$password = "";
$dbname = "";
$name = test_input($_POST['name']);
$passworduser = test_input($_POST['password']);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

    $sql = $conn->prepare("INSERT INTO Users(User, Password)
    VALUES (?, ?)");
    $sql->bind_param("ss", $name, $passworduser);
    
    if($sql->execute()) 
    {
                    $_SESSION["user"] = $name;
                    echo '<div class="w3-bar-item" style="text-align: center; font-size: 17px;"><b>Registration successful ' . $nameresult . ". You are now logged in and
                    ready to share your text.</b></div>";
                    echo '<script>',
                         'hideform();',
                         '</script>
                         
                         <script>
                          document.getElementById("logout").href = "logout.php";
                          document.getElementById("logout").style.display="block";
                          setTimeout(
                            function() {
                              document.getElementById("respondRegister").style.display="none";
                            }, 7000);
                         </script>';
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
    
    function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
    }
    
?>
