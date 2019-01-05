<!DOCTYPE html>
<html>
<title>Essej - share your text</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<link rel="icon" href="icon.png" type="image/gif" sizes="16x16">

<style>

    body,h2,h3,h4,h5,h6 {font-family: "Karma", sans-serif}
    .w3-bar-block .w3-bar-item {padding:20px}
    
    h1{
        font-family: "Karma", sans-serif;
        font-size: 120px;
    }
    
    @media (max-width: 1200px) {
        .name { font-size: 70px; }
    }
    
    #votesCount {
        cursor: pointer; 
    }
    
    #dlink{
        text-decoration : none;
        font-size: 18px;
        font-weight: bold;
        text-align: right;
    }
    
    .navbar{
        font-weight: bold;
        font-size: 20px;
        position: fixed;
    }
    
</style>

<?php
session_start();

if (isset($_SESSION['user'])) {
  //echo  'logged in';
  $userSession = $_SESSION['user'];
 } else {
   //echo 'not logged in';
 }
?>

<body>

<div class="navbar w3-bar w3-white w3-padding">
    <a href="/" class="w3-bar-item w3-button w3-hover-black">Home</a>
    <a href="/writepost.php" class="w3-bar-item w3-button w3-hover-black">Write an article</a>
</div>
<br>
<?php

    if(isset($_GET['id'])) {
            $servername = "";
            $username = "";
            $password = "";
            $dbname = "";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                } 
            
            $id = test_input($_GET['id']);
            
            //$sql = "SELECT Title, Content, User, Votes FROM Posts WHERE Id = $id ";
            //$result = $conn->query($sql);
            
            
                $sql = $conn->prepare("SELECT Title, User, Content, Votes, Data FROM Posts WHERE Id = ? ");
                $sql->bind_param("i", $id);
                $sql->execute();
                $sql->store_result();
                $num_of_rows = $sql->num_rows;
                $sql->bind_result($titledb, $user, $content, $votes, $data);

                while ($sql->fetch()) {
                          echo '<div class="w3-container w3-padding-32 w3-center">
                                    <div class="w3-cell-row">
                                        <div class="w3-center w3-cell w3-mobile"><h3> ' .$titledb. '</h3></div>   
                                    </div>
                                    
                                    <div class="w3-cell-row">
                                        <div class="w3-center w3-cell w3-mobile"><h1 class="name"><b>' .$user. '</b></h1></div>
                                    </div>
                                    
                                    <div class="w3-cell-row w3-padding">
                                        <div class="w3-center w3-cell w3-mobile"><h4> ' .$content. '</h4></div>
                                    </div>
                                    
                                    <div class="w3-cell-row">
                                        <a class="w3-button w3-hover-white" id="dlink" href="download.php?file='.$data.'">Download full version of article here &rArr;</a>
                                    </div>
                                    <br>
                                    <div id="votesDiv" class="w3-yellow w3-cell-row w3-padding">
                                        <div class="w3-cell w3-mobile"><h4 id="votesCount">Votes : <b>' .$votes. '</b></h4></div>
                                        <input type="hidden"></input>
                                    </div>
                                    
                                </div>

                                
                                <footer class="w3-container w3-center">
                                      <p>Powered by <a href="http://mattmaksymowicz.pl/" ><b>Matt Maksymowicz</b></a></p>
                                </footer>';
                                $title =  $titledb;
                                $votesjs = $votes;
                                
            }
        

        $sql->close(); 
        $conn->close(); 
        }
        
        function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
        }   


echo '<script>
  
        document.getElementById("votesDiv").addEventListener("click", function(){
            var userSession = "'.htmlspecialchars($userSession).'";
            var id = "'.htmlspecialchars($id).'";
            var articleTitle = "'.htmlspecialchars($title).'";
            var votesjs = "'.htmlspecialchars($votesjs).'";
            $.ajax({
            type: "POST",
            data: { 
                id : id,
                userSession : userSession,
                articleTitle : articleTitle
            },
            url: "countvotes.php",
            success: function(result){
                    $("#votesCount").html(result);
                }
                
            });
    });
    
</script>';
            
?>

</body>
</html>
					