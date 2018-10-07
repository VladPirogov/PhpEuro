<?php
/**
 * Created by PhpStorm.
 * User: Влад
 * Date: 20.06.2018
 * Time: 12:43
 */

 // З'єдняння з базою даних
$linc= mysqli_connect("localhost", "root", "root") or die(mysqli_error());
$conn= mysqli_select_db($linc,"Euro-App") or die(mysqli_error());
global $linc;
/*echo 'Подключение к базе данных.<br>';

$result = mysqli_query($linc,"SELECT Name FROM User");

$row = mysqli_fetch_row($result);
echo "Сотрудник 1: ", $row[0], "<br>\n";

mysqli_close($linc);*/
?>
