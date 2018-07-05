<?php
session_start();
include '../connection.php';
/*if (empty($_POST['username']) and empty($_POST['password'])and isset($_POST['submit']))
{*/
    $login = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT User_ID FROM User WHERE Name LIKE \"".$login."\" AND pass LIKE \"".$password."\" LIMIT 1";
    $result = mysqli_query($linc,$query) or die(mysqli_error());
    if(mysqli_num_rows($result)==1)
    {
        $row = mysqli_fetch_row($result);

        $_SESSION['user_id'] =$row[0] ;
        echo '<script>location.replace("kabinet.php");</script>'; exit;

    }
    else
    {
         echo '
         <script type="text/javascript"> 
          alert( "Ви не правильно ввели дані" );
          location.replace("../index.html");
         </script>';exit;
    }

//}


?>
