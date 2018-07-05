<?php
/**
 * Created by PhpStorm.
 * User: Влад
 * Date: 04.07.2018
 * Time: 10:47
 */
session_start();
/*
echo $_SESSION['user_id'];*/
include '../connection.php';
session_start();

$query = "SELECT Name FROM User WHERE User_ID=".$_SESSION['user_id']." LIMIT 1";
$result = mysqli_query($linc,$query) or die(mysqli_error($linc));
$row = mysqli_fetch_row($result);
$_SESSION['username']=$row[0];
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Генератор єврододатків</title>

    <!--<link href="css/bootstrap.min.css" rel="stylesheet">-->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style2kabinet.css" rel="stylesheet">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/notUpload.js"></script>

</head>
<body>
    <header>
        <h1 id="username"><i>Строрінка: <span><?php echo $_SESSION['username'];?></span></i></h1>
    </header>
    <form id="login">
        <button class="addQualification" >Створити спеціальність</button>
    </form>
</body>
</html>
<?php
?>
