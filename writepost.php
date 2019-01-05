<!DOCTYPE html>
<html>
<title>Essej- share your text</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">

<link rel="icon" href="icon.png" type="image/gif" sizes="16x16">

<style>
   body,h2,h3,h4,h5,h6 {font-family: "Karma", sans-serif}
    .w3-bar-block .w3-bar-item {padding:20px}
    
    h1{
        font-family: "Karma", sans-serif;
        font-size: 110px;
    }
    
    @media (max-width: 1200px) {
        .name { font-size: 50px; }
        
        .forminputsize { width: 315px;
                         height: 450px;
        }
        .inputfile + label { width: 200px;}
        #needlog { font-size: 50px; }
    }
    
    @media (min-width: 1200px) {
        .forminputsize { width: 600px;
                         height: 300px;
        }
        .inputfile + label { width: 600px;}
        #needlog { font-size: 70px; }
    }
    
    input, textarea{
        outline:none;  
    }

    ::placeholder { 
      color: black;
      opacity: 1;  
      font-weight: bold;
      font-size: 18px;
    }
    
    :-ms-input-placeholder { 
      color: black;
      font-weight: bold;
      font-size: 18px;
    }
    
    ::-ms-input-placeholder { 
      color: black;
      font-weight: bold;
      font-size: 18px;
    }
    
    .inputfile + label {
    cursor: pointer; 
    }
    
    .inputfile {
    width: 0.1px;
	height: 0.1px;
	opacity: 0;
	overflow: hidden;
	position: absolute;
	z-index: -1;
    }
    
    .inputfile + label {
    font-size: 1.0em;
    font-weight: 700;
    color: white;
    background-color: black;
    display: inline-block;
    padding: 5px;
    }
    
    .inputfile:focus + label,
    .inputfile + label:hover {
        background-color: #FFD801;
    }
    
    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }
    
    /* Modal Content */
    .modal-content {
        text-align: center;
        position: relative;
        background-color: #fefefe;
        margin: auto;
        padding: 10px;
        border: none;
        width: 100%;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
        -webkit-animation-name: animatetop;
        -webkit-animation-duration: 0.4s;
        animation-name: animatetop;
        animation-duration: 0.4s
    }
    
    /* Add Animation */
    @-webkit-keyframes animatetop {
        from {top:-300px; opacity:0} 
        to {top:0; opacity:1}
    }
    
    @keyframes animatetop {
        from {top:-300px; opacity:0}
        to {top:0; opacity:1}
    }
    
    /* The Close Button */
    .close {
        color: white;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    
    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
    
    
    #container {
      width: 400px;
      height: 400px;
      position: relative;
      background: yellow;
    }
    #animate {
      width: 50px;
      height: 50px;
      position: absolute;
      background-color: red;
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
 } else {
   //echo 'not logged in';
 }
?>

<body>

    <div class="navbar w3-bar w3-white w3-padding">
      <a href="/" class="w3-bar-item w3-button w3-hover-black">Home</a>
    </div>
    <br>
<?php


  if (isset($_SESSION['user'])) {
   echo '
        <div class="w3-container w3-padding-32 w3-center">
            
            <form autocomplete="off"  enctype="multipart/form-data" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">
                
                        <div class="w3-cell-row">
                            <div class="w3-center w3-cell w3-mobile"><h3><input class="w3-leftbar w3-border-black w3-border-0" type="text" 
                                placeholder=" t i t l e" maxlength="33" name="title" minlength="10" required></h3>
                            </div>   
                        </div>
                
                        <div class="w3-cell-row">
                            <div class="w3-center w3-cell w3-mobile"><h1 class="name"><b>'. $_SESSION['user'].'</b></h1></div>
                        </div>
            
                        <div class="w3-cell-row">
                            <div class="w3-center w3-cell w3-mobile"><h4>
                                <textarea class="forminputsize w3-border-0 w3-leftbar w3-border-black" name="content" 
                                placeholder="d
e
s
c
r
i
p
t
i
o
n"
                                cols="50" maxlength="570" 
                                minlength="350" required></textarea>
                            </h4></div>
                        </div>  
                        
                        <div class="w3-cell-row w3-padding ">
                            <div class="w3-center w3-cell w3-mobile">
                                <p>File is required. Only TXT, PDF and DOCs can be uploaded, up to 5mb.</p>
                                <input type="file" name="uploaded_file" id="uploaded_file" class="inputfile" required></input>
                                <label id="labelFile" for="uploaded_file">Choose a file</label>
                            </div>
                        </div>
                        
 
                    <button class="w3-btn w3-blue-black w3-mobile" style="font-size: 18px;" type="submit" name="SubmitButton" onclick="Message()"><b>Send</b></button>
                    
            </form> 
            
        </div>
        
      <!-- The Modal -->
      <div id="myModal" class="modal">
    
          <!-- Modal content -->
          <div class="modal-content">
            <span class="close">&times;</span>
            <h2><b><p id="modaltext">Upload success &#10003;</p></b></h2>
          </div>
      
      </div>  ';
      
    }else{
        echo '<div class="w3-container w3-padding-32 w3-center">
                <div class="w3-cell-row">
                    <div class="w3-center w3-cell w3-mobile"><p id="needlog"><b>You need to be logged in to write an article.</b></p></div>
                </div>
              </div>';
    }
    
    if(isset($_POST['SubmitButton'])){
                            //file upload
                            if(!empty($_FILES['uploaded_file']))
                              {   
                                  $path = "uploads/";
                                  $path = $path . basename( $_FILES['uploaded_file']['name']);

                                  $fileType = strtolower(pathinfo($path,PATHINFO_EXTENSION));
                                  if($fileType != "txt" && $fileType != "doc" && $fileType != "pdf"
                                    && $fileType != "docx" && $fileType != "rtf" ) {
                                        echo '
                                                 <script>
                                                
                                                
                                                // Get the modal
                                                var modal = document.getElementById("myModal");
                                                
                                                
                                                // Get the <span> element that closes the modal
                                                var span = document.getElementsByClassName("close")[0];
                                                
                                                // When the user clicks the button, open the modal 
                                                function display() {
                                                    modal.style.display = "block";
                                                }
                                                
                                                window.onload = display;
                                                // When the user clicks on <span> (x), close the modal
                                                span.onclick = function() {
                                                    modal.style.display = "none";
                                                }
                                                
                                                // When the user clicks anywhere outside of the modal, close it
                                                window.onclick = function(event) {
                                                    if (event.target == modal) {
                                                        modal.style.display = "none";
                                                    }
                                                }
                                                
                                                document.getElementById("modaltext").innerHTML = ("Wrong type of file &#10008;");
                                                </script>  
                                        ';
                                        $uploadOk = 0;
                                        }
                                        else
                                        {
                                            $uploadOk = 1;
                            
                                            if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
                                              /*echo "The file ".  basename( $_FILES['uploaded_file']['name']). 
                                              " has been uploaded"*/;
                                                    }
                                            }       
            }
    }                          
                            
    if(isset($_POST['SubmitButton']) && $uploadOk == 1) {
                       
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
    
    $title = test_input($_POST['title']);
    $content = test_input($_POST['content']);
    $date = date("Y-m-d");
    $user = $_SESSION['user'];
    
    
    //$sql = "INSERT INTO Posts (Title, Content, Date , User)
    //VALUES ('$title' , '$content', '$date' , '$user' )";
    
    $sql = $conn->prepare("INSERT INTO Posts (Title, Content, Date , User, Data)
    VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param("sssss", $title, $content, $date, $user, $path);
    
    if($sql->execute()){
        echo 
            '
            <script>
            
            // Get the modal
            var modal = document.getElementById("myModal");
            
            
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];
            
            // When the user clicks the button, open the modal 
            function display() {
                modal.style.display = "block";
            }
            
            window.onload = display;
            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }
            
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
            
                window.setTimeout(function(){
            
                    window.location.href = "http://essej.pl/";
            
                }, 3000);
            </script>
            ';
            
            } 
            
            $sql->close();
            $conn->close();              
            
            ///////////////////////  
        }         
            
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
    }
        
    ?>
    
        <footer class="w3-container w3-center">
            <p>Powered by <a href="http://mattmaksymowicz.pl/"><b>Matt Maksymowicz</b></a></p>
        </footer>
        
    <script>
        document.getElementById('uploaded_file').onchange = function () {
            var fullPath = document.getElementById('uploaded_file').value;
                if (fullPath) {
                    var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
                    var filename = fullPath.substring(startIndex);
                    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                        filename = filename.substring(1);
                    }
                    document.getElementById('labelFile').innerHTML = filename;
            }
        }
    </script>
    
</body>
</html>									