<?php
    $cookie_name = "user";
    $cookie_value = "visited";
    setcookie($cookie_name,$cookie_value, time() + (86400 * 30), "/");
?>

<?php
if(!isset($_COOKIE[$cookie_name])) {
    echo '<script>    
    var isSet = 1;
    </script>';
} else {
    echo '<script>    
    var isSet = 0;
    </script>';
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Essej - share your text</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="icon" href="icon.png" type="image/gif" sizes="16x16">
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<style>

form.box input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: none;
  background: #f1f1f1;
}

form.box button {
  padding: 10px;
  background: white;
  color: #A9A9A9;
  font-size: 17px;
  border: none;
  border-left: none;
  cursor: pointer;
}

form.box button:hover {
  color: grey;
}

body,h1,h2,h3,h4,h5,h6 {font-family: "Karma", sans-serif}
.w3-bar-block .w3-bar-item {padding:20px}

#bestpostname{
    font-size: 100px;
    font-family: "Karma", sans-serif;
    margin : 0px;
}

.short-text { display: none; }

@media (max-width: 1000px) {
    .short-text { display: inline-block; }
    .full-text { display: none; }
     h1{font-size: 30px;}
    #search{ width : 90px;}
    .popuptext{ min-width: 175px !important;}
}

a{
    text-decoration : none;
}


input{
     outline:none;  
}

div {
  word-wrap: break-word;
}

#overlay {
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
background-color: black;
filter:alpha(opacity=70);
-moz-opacity:0.7;
-khtml-opacity: 0.7;
opacity: 0.7;
z-index: 100;

}

.popup{
width: 100%;
margin: 0 auto;
position: fixed;
z-index: 101;
display: none;
}

.popuptext{
min-width: 600px;
width: 100px;
min-height: 150px;
margin: 10px auto;
background: white;
position: relative;
z-index: 103;
padding: 25px 25px;
border-radius: 5px;
}

.popuptext p, button {
    clear: both;
    font-size: 20px;
    font-family: sans-serif;
    outline: none;
}

#closeButton{
    position: absolute;
    top: 5px;
    right: 5px;
    border-radius: 50%;
    font-weight: bold;
    }

}

</style>

<script type='text/javascript'>
    
if(isSet == 1){
    $(function(){
    var overlay = $('<div id="overlay"></div>');
    var poptext = ["In a left top corner, you register and later on login, in order to write and vote on articles.", 
    "In right top corner, you can go to Write a Post site.", "In main section, you can see the newest posts on the top, best post of the day in the middle.", 
    "And at the bottom, best posts of all time and search bar for finding the article you need."];
    var i = 0;
    overlay.show();
    overlay.appendTo(document.body);
    $('.popup').show();
    $('.close').click(function(){
    $('.popup').hide();
    overlay.appendTo(document.body).remove();
    return false;
    });
    
    $('.next').click(function(){
    $('#popuptext').html(poptext[i]);
    i++;
    
    if(i==1){
        document.getElementById("overlay").style.width = "50%";
        document.getElementById("overlay").style.left = "50%";
        document.getElementsByClassName('popup')[0].style.width = "150%"
        document.getElementsByClassName('popuptext')[0].style.minWidth = "500px";
    }else if(i==2){;
        document.getElementById("overlay").style.left = "0";
        document.getElementsByClassName('popup')[0].style.width = "50%";
    }else if(i==3){
        document.getElementsByClassName('popup')[0].style.width = "250px";
        document.getElementById("overlay").style.width = "250px";
        document.getElementById("overlay").style.height = "100%"
        document.getElementsByClassName('popuptext')[0].style.minWidth = "200px";
    }
    else if(i==4){
       $('#nextButton').html('Close'); 
       $('#closeButton').hide(); 
    }else if(i==5){
        $('.popup').hide();
        overlay.appendTo(document.body).remove();
        return false;
    }
    return false;
    });
    
    
    $('.x').click(function(){
    $('.popup').hide();
    overlay.appendTo(document.body).remove();
    return false;
    });
    
    });
}
</script>

</head>

<?php
session_start();
?>

<body>

    <div class='popup'>
        <div class='popuptext'>
                <p id="popuptext">At essej.pl you can share your text with anybody in a short, easy way.</p> 
                <button id="nextButton" class='next w3-btn w3-black w3-text-white w3-round-large'>Next</button>
                <button id="closeButton" class='close w3-button w3-circle w3-white w3-medium w3-hover-white'>x</button>
        </div>
    </div>
    
    <nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" style="display:none;z-index:2;width:40%;min-width:300px" id="mySidebar">
      <a href="javascript:void(0)" onclick="w3_close()"
      class="w3-bar-item w3-button">Close</a>
      
      <!--signin-->
      <a id="signin" class="w3-bar-item w3-button">Sigh in</a>
      <div id="login" style="display:none">
        <?php 
        
        if (isset($_SESSION['user'])) {
            echo '<script>document.getElementById("signin").innerHTML = "Log out";
                          document.getElementById("signin").href = "logout.php";
                  </script>
            ';
            
        }else{

        echo '
        <div class="w3-center">
            <form id="formSignin" name="form" autocomplete="off" action="" class="w3-container" method="post">
                <h3>
                <input id="name" class="w3-cell w3-mobile w3-border-bottom w3-border-0" type="text" name="name" maxlength="35" size="35" placeholder="Login"></h3>

                <h3>
                <input id="password" class="w3-cell w3-mobile w3-border-bottom w3-border-0" type="password" name="password" maxlength="35" size="35" placeholder="Password"></h3>

                <button  class="w3-btn w3-black-black" type="submit" name="SubmitButton"><b>Log in</b></button>             
            </form>            
        </div>  

        <div class="w3-center" id="respondSignin"></div>';
        }
        ?> 
      </div>
     
     <!--register-->
     
     <a id="register" class="w3-bar-item w3-button">Registration</a>
     <div id="regLogin" style="display:none">
        <?php 
        if (isset($_SESSION['user'])) {
            echo '<script>$("#register").hide();
                  </script>
            ';
            
        }else{

        echo '
        <div class="w3-center">
            <form id="registerform" name="formreg" autocomplete="off" action="" class="w3-container" method="post">
                <h3>
                <input class="w3-cell w3-mobile w3-border-bottom w3-border-0" type="text" name="name" minlength="5" maxlength="35" size="35" placeholder="Login"
                 required></h3>

                <h3>
                <input class="w3-cell w3-mobile w3-border-bottom w3-border-0" type="password" name="password" minlength="5" maxlength="35" size="35" placeholder="Password"
                required></h3>

                <button  class="w3-btn w3-black-black" type="submit" name="SubmitButton"><b>Register</b></button>             
            </form>            
        </div>  

        <div class="w3-center" id="respondRegister"></div>';
        }
        ?> 
      </div>
      
      <!--log out button-->
      <a id="logout" class="w3-bar-item w3-button" style="display:none">Log out</a>
      
    </nav>

    <div class="w3-top">
      <div class="w3-white w3-xlarge" style="max-width:1200px;margin:auto">
        <div class="w3-button w3-padding-16 w3-left" onclick="w3_open()">&#8801;</div>
        <div class="w3-right w3-padding-16"  style="margin-right: 1px"><a href="/writepost.php">
        <span class="full-text"><u>Write a post</u></span>
        <span class="short-text"><u>Write <br>a post</u></span>
        </a></div>
        <div class="w3-center w3-padding-16">Today's posts</div>
      </div>
    </div>       
  
    <div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">
        <div id="posts01" class="w3-row-padding w3-padding-16 w3-center">
    
            <?php
            
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
                
                $sql = 'SELECT Title, Content , User, Id FROM Posts ORDER BY Id DESC LIMIT 4';
                
                
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="textover w3-quarter"><a href="/showpost.php?id='. $row["Id"] .'"><h1><b>'
                        . substr($row["User"],0,20).'</b></h1><h3>' . substr($row["Title"],0,20).
                        '...</h3><p>'. substr($row["Content"],0,95).'...</p></a></div>';
                        }
                    } 
                    else 
                    {
                        echo "0 results";
                    }
                
                $conn->close();
            
            ?>
        </div>
        
        <div id="posts02" class="w3-row-padding w3-padding-16 w3-center">
            <?php
        
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
                
                $sql = "SELECT Title, Content, User, Id FROM Posts ORDER BY Id DESC LIMIT 4 OFFSET 4";
   
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="w3-quarter"><a href="/showpost.php?id='. $row["Id"] .'"><h1><b>'
                        . substr($row["User"],0,20).'</b></h1><h3>' . substr($row["Title"],0,20).
                        '...</h3><p>'. substr($row["Content"],0,95).'...</p></a></div>';
                        }
                } else {
                    echo "0 results";
                }
                
                $conn->close();
        
            ?>
        </div>


 <!-- Pagination -->
  <div class="w3-center w3-padding-32">
    <div class="w3-bar">
      <p class="pagenum w3-bar-item w3-button w3-hover-black">&laquo;</p>
      <p class="pagenum w3-bar-item w3-button w3-hover-black">1</p>
      <p class="pagenum w3-bar-item w3-button w3-hover-black">2</p>
      <p class="pagenum w3-bar-item w3-button w3-hover-black">3</p>
      <p class="pagenum w3-bar-item w3-button w3-hover-black">4</p>
      <p class="pagenum w3-bar-item w3-button w3-hover-black">&raquo;</p>
    </div>
  </div>  
  
<?php
            $servername = "";
            $username = "";
            $password = "";
            $dbname = "";
            $date = date("Y-m-d");
            
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                } 
            
            $sql = "SELECT Title, Content, User, Votes, Id FROM Posts WHERE Date = '$date' ORDER BY Votes DESC LIMIT 1";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                          echo '
                              <hr>  
                              <div class="w3-container w3-padding-16 w3-center"><a href="/showpost.php?id='. $row["Id"] .'">
                                <b>Best post of the day:</b><br>
                                <h3>' .$row[Title]. '</h3><br>
                                <p id="bestpostname"><b> ' .$row[User]. ' </b></p>
                                <div class="w3-padding-16">
                                  <h4> ' .$row[Content]. '</h4> 
                                </div>
                                <div class="w3-yellow w3-padding-16">
                                  <h4>Votes : <b>' .$row[Votes]. '</b></h4> 
                                </div>
                              </a></div>
                              <hr>
                          ';
                    }
                } 
                else 
                {
                    echo '<div class="w3-container w3-padding-32 w3-center">
                            <div class="w3-cell-row">
                            <div class="w3-center w3-cell w3-mobile"><p><b>No new posts today.</b></p></div>
                            </div>
                          </div>';
                }
        
        $conn->close();

?>  
  
  <!-- Footer -->
  <footer class="w3-row-padding w3-padding-32">
  
    <div class="w3-third">
      <h3>Most voted posts:</h3>
      <ul class="w3-ul w3-hoverable">
      <?php 
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
            
            $sql = "SELECT Title, Content, Id FROM Posts ORDER BY Votes DESC LIMIT 2";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo'<a href="/showpost.php?id='. $row["Id"] .'">
                        <li class="w3-padding-16">          
                            <span class="w3-large">'.$row[Title].'</span><br>
                            <span>'.substr($row[Content],0,50).'...</span>
                        </li></a>';
                }
            }
            $conn->close();
       ?> 
      </ul>
    </div>

    <div class="w3-third w3-serif w3-center w3-padding w3-mobile">
        <form autocomplete="off" class="box" action="searchfromposts.php" method="POST">
          <input id="search" type="text" placeholder="Search.." name="search" minlength="5" required>
          <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
    
    <div class="w3-third w3-padding">
      <p align="center">You can contact author of this website via maksymowicz.matthias@gmail.com .</p>
      <p align="center">Powered by <a href="http://mattmaksymowicz.pl/"><b><u>Matt Maksymowicz</u></b></a></p>
    </div>
  </footer>

</div>

    <script>
    
    // Script to open and close sidebar
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
    }
    
    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
    }
    
    //login and register toggle
    $(document).ready(function(){
      $("#signin").click(function(){
        $("#login").toggle();
      });
    }); 
    
    $(document).ready(function(){
      $("#register").click(function(){
        $("#regLogin").toggle();
      });
    });

    var el = document.getElementById("formSignin");
    if(el){
              document.getElementById("formSignin").addEventListener("submit", function(event){
                var forminfo = $("#formSignin").serialize();
                $.ajax({
                type: 'POST',
                data: forminfo,
                url: "form.php",
                success: function(result){
                        $("#respondSignin").html(result);
                    }
                });
                event.preventDefault()
        });
    }


    var el2 = document.getElementById("registerform");
    if(el2){
        document.getElementById("registerform").addEventListener("submit", function(event){
                var reginfo = $("#registerform").serialize();
                $.ajax({
                type: 'POST',
                data: reginfo,
                url: "register.php",
                success: function(result){
                        $("#respondRegister").html(result);
                    }
                });
                event.preventDefault()
        });
    }
          
    function hideform(){
            $("#formSignin").hide();
            $("#registerform").hide();
            $("#signin").hide();
            $("#register").hide();
    } 

    var numfirst = 1;

    $(document).ready(function(){
      $(".pagenum").click(function(){
        var numweb = $( this ).html();
        
        if(numweb == "«"){
            numweb = 5;
        }else if(numweb == "»" ){
            numweb = 6;
        }else{
            numfirst = $(this).html();
        }
        

        $.ajax({
            type: "POST",
            data: { num : numweb,
                    numfirst : numfirst
            },
            url: "changemainposts.php",
            success: function(result){
                    $("#posts01").html(result);
                }
                
            });
            

        $.ajax({
            type: "POST",
            data: { num2 : numweb,
                    numfirst : numfirst
            },
            url: "changemainposts2.php",
            success: function(result){
                    $("#posts02").html(result);
                }
                
            });
        });
    });
        
    </script>

</body>
</html>


