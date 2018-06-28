<?php
/**
 * Created by PhpStorm.
 * User: Влад
 * Date: 20.06.2018
 * Time: 12:43
 */

 // З'єдняння з базою даних
 mysqli_connect("localhost", "root", "root") or die(mysqli_error());
 mysqli_select_db("Euro-App") or die(mysqli_error());

echo 'Подключение к базе данных.<br>';

$result = mysqli_query('SELECT Name FROM User');

$row = mysqli_fetch_row($result);
echo "Сотрудник 1: ", $row[0], "<br>\n";

mysqli_close($conn);
?>
