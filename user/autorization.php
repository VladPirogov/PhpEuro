<?php
//session_start();
include '../connection.php';
/*if (empty($_POST['username']) and empty($_POST['password'])and isset($_POST['submit']))
{*/
    echo "<script>console.log('".$_POST['username']."')</script>";
    echo "<script>console.log('".$_POST['password']."')</script>";
    $login = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT User_ID FROM User WHERE Name LIKE \"".$login."\" AND pass LIKE \"".$password."\" LIMIT 1";
    echo "<script>console.log('".$query."')</script>";
    $result = mysqli_query($linc,$query) or die(mysqli_error());
    echo "<script>console.log('".mysqli_num_rows($result)."')</script>";
    if(mysqli_num_rows($result)==1)
    {
        $row = mysqli_fetch_row($result);
        $_SESSION['user_id'] = $row['ID_user'];
        echo '<script>location.replace("/user/kabinet.php");</script>'; exit;
    }
    else
    {
        echo '
         <script type="text/javascript"> 
          alert( "Ви не правильно ввели дані" );
          //location.replace("../index.html");
         </script>';
    }

//}


?>
