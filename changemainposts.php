            <?php
            
                $servername = "";
                $username = "";
                $password = "";
                $dbname = "";
                $numfirst = $_POST['numfirst'];
                $num = $_POST['num'];
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 
               
                    if($num == 5){
                        $num = $numfirst-1;
                        echo "<script>numfirst--;</script>";
    
                    }else if($num == 6){
                        $num = $numfirst+1;
                        echo "<script>numfirst++;</script>";
                    }
                    
                    
                    if($num < 1 || $num > 3){
                            echo "<b>No more posts.</b>";
                        }else{
                            if($num == 1){
                                $num=0;
                            }elseif ($num == 2){
                                $num=8;    
                            }elseif ($num == 3){
                                $num=16;    
                            }elseif ($num == 4){
                                $num=24;    
                            }
                            
                            $sql = "SELECT Title, Content, User, Id FROM Posts ORDER BY Id DESC LIMIT 4 OFFSET $num";
               
                            $result = $conn->query($sql);
                            
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo '<div class="w3-quarter"><a href="/showpost.php?id='. $row["Id"] .'"><h1><b>'
                                    . substr($row["User"],0,20).'</b></h1><h3>' . substr($row["Title"],0,20).
                                    '...</h3><p>'. substr($row["Content"],0,95).'...</p></a></div>';
                                    }
                            } else {
                                echo "<b>No more posts.</b>";
                            }
                        }
                
                $conn->close();
            
            ?>