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
    <form id="login" action="kabinet.php" method="POST">
        <div >
            <input type="text" name="search"  placeholder="Пошук">
            <button type="submit"  class="btn btn-default">Пошук</button>
        </div>
        <a href="addQualification.php" class="btn btn-default">Створити спеціальність</a>
        <p>Кольоровий зір людини залежить від здатності ока сприймати кольори та їх відтінки.
            Око людини здатне сприймати до 13000 кольорів та їх відтінків. Хоча механізм перетворення фізичних
            характеристик світла у психофізичні до кінця не вивчений, існує безліч теорій,
            які намагалися пояснити механізми кольорового зору людини. Основна теорія пояснення кольорового зору людини
             це трьохкомпонентна теорія кольорового зору (теорія Юнга-Гемгольца).
            Оскільки наше око містить три види колбочок, які сприймають три кольори. Цих трьох кольорів достатньо для
            змішування та формування усіх інших кольорів спектру. </p>
        <table class="table ">
        <?php
            echo  "<tr>
                <th>Дата створення</th>
                <th>Абрівіатура</th>
                <th>Повна назва</th>
                
            </tr>";
            $query="SELECT   Qualification.Date,   
                    Qualification.abbreviation,
                    Qualification.Qualification_UA 
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
            </tr>
        
             ", $row[0], $row[1],$row[2]);
        }

        ?>
        </table>

    </form>
</body>
</html>
<?php
?>
