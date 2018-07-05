<?php
/**
 * Created by PhpStorm.
 * User: Влад
 * Date: 04.07.2018
 * Time: 16:12
 */
include '../connection.php';
session_start();
$login = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['userEmail'];
$query = "SELECT User_ID FROM User WHERE Name LIKE \"".$login."\" LIMIT 1";
$result = mysqli_query($linc,$query) or die(mysqli_error($linc));
if(mysqli_num_rows($result)==0)
{
    $query = "INSERT INTO `User`(`Name`, `pass`, `e-mail`) VALUES (\"" . $login . "\",\"" . $password . "\",\"" . $email . "\")";
    mysqli_query($linc,$query) or die(mysqli_error($linc));
    $id=mysqli_insert_id($linc);
    echo '
         <script type="text/javascript"> 
          alert('.$id .');
           </script>';
    $_SESSION['user_id'] = $id;
    echo '<script>location.replace("kabinet.php");</script>'; exit;

}
else
{
    echo '
         <script type="text/javascript"> 
          alert( "Такий логін вже використовується" );
          location.replace("../index.html");
         </script>';exit;
}
?>