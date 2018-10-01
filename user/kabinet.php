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
        <h1 id="username"><i>Автор: <span><?php echo $_SESSION['username'];?></span></i></h1>
    </header>
    <form id="login" action="kabinet.php" method="POST">
        <!--<div class="flex-container">
            <input class="flex-element" type="text" placeholder="Пошук" autofocus>
            <input class="flex-element" type="submit" value="Почати пошук">
        </div>-->
        <div class="flex-container-1">
            <input class="flex-element" href="addQualification.php" type="submit" name="addQualification" value="Створити спеціальність">
        </div>


        <p> </p>
        <div id="table">
        <table class="table ">
        <?php
            echo  "<tr>
                <th>Дата створення</th>
                <th>Абрівіатура</th>
                <th>Повна назва</th>
                <th>Редагувати</th>
            </tr>";
            $query="SELECT   Qualification.Date,   
                    Qualification.abbreviation,
                    Qualification.Qualification_UA, 
                    Qualification.Qualification_ID
                    FROM Qualification WHERE Qualification.User_ID=".$_SESSION['user_id'];/*Доделать запрос возможно
                    количество не нулевых дисциплин*/
        $result = mysqli_query($linc,$query) or die(mysqli_error($linc));
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
        {
            printf("           
             <tr>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td>
                    <form action='kabinet.php' method='post'>
                        <input type='hidden'  name='r' value='$row[3]' />
                        <input type='submit'  name='submit' value=\"Перегляд\"/>
                    </form>  
             </tr>
        
             ", $row[0], $row[1],$row[2]);
        }

        ?>
        </table>
        </div>

    </form>
</body>
</html>
<?php
if(isset($_POST['addQualification']))
{
    $query = "INSERT INTO Qualification (User_ID,Date) VALUES (\"" . $_SESSION['user_id'] . "\",\"".date("d.m.Y")."\")";
    mysqli_query($linc,$query) or die(mysqli_error($linc));
    $_SESSION["id_qualification"]=mysqli_insert_id($linc);
    echo '<script>location.replace("addQualification.php");</script>'; exit;


}
if(isset($_POST['r']))
{
    $_SESSION["id_qualification"]=$_POST['r'];
    echo '<script>location.replace("addQualification.php");</script>'; exit;
}
?>
