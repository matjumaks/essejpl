<?php

if($_POST['userSession']!= ""){
    $servername = "";
    $username = "";
    $password = "";
    $dbname = "";
    $id = $_POST['id'];
    $userSession = $_POST['userSession'];
    $articleTitle = $_POST['articleTitle'];
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    $sql="
        SELECT VotesUser, User
        FROM Users
        WHERE NOT EXISTS
        (SELECT VotesUser, User FROM Users WHERE User='$userSession' AND VotesUser LIKE '%$articleTitle%');
    ";
    
    $result = $conn->query($sql);
        if ($result->num_rows > 0) {
                $sql = "UPDATE Posts SET Votes = Votes + 1 WHERE Id = '$id' ;" ;
                $sql .= "UPDATE Users SET VotesUser = CONCAT(VotesUser, ' $articleTitle') WHERE User = '$userSession' ";
                                            
                    $conn->multi_query($sql);
                    mysqli_next_result($conn);
    
                    $sql = "SELECT Votes FROM Posts WHERE Id = '$id' ";
                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                        // output data of each row
                        echo 'Votes : <b>' . $row[Votes] . '</b>'; 
                        }
    
                    }else{
                        echo "Error: " . $sql . "<br>" . $conn->error;
                }    
        }
        else
        {
            echo "You already voted for this post.";
            //echo '<script>setTimeout(function(){ $("#votesCount").html('echo . $votes .'); }, 3000)</script>';
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
        
}else{
    echo "You need to be logged in.";
}
    
?>