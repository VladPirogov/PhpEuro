<?php
/**
 * Created by PhpStorm.
 * User: Влад
 * Date: 13.08.2018
 * Time: 10:40
 */
session_start();
include '../connection.php';
include 'functions_Disciplines.php';
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Генератор єврододатків</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/discipline.css" rel="stylesheet">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">

</head>
<body>
    <header id="header">
        <script src="../js/jquery-3.2.1.min.js"></script>
        <h1><i><p>Автор: <span><?php echo $_SESSION['username'];?></span></p></i></h1>
        <h2>
            <i>
                <p>Назва:
                    <span>
                        <?php
                        $query="SELECT
                                    Qualification.Qualification_UA,
                                    Qualification.abbreviation
                                    FROM Qualification
                                    WHERE Qualification.Qualification_ID =".$_SESSION["id_qualification"];
                        $result = mysqli_query($linc,$query) or die(mysqli_error($linc));
                        $row=mysqli_fetch_array($result,MYSQLI_NUM);
                        echo $row[0]." <p>Абрівіатура: ".$row[1]."</p>";
                        $query="SELECT
                              Qualification.Qualification_EN,
                              Qualification.Qualification_UA,
                              Qualification.Main_field_study_UA,
                              Qualification.Main_field_study_EN,
                              Qualification.Degree,
                              Qualification.abbreviation
                            FROM Qualification
                            WHERE Qualification.User_ID = ".$_SESSION['user_id']."
                            AND Qualification.Qualification_ID =".$_SESSION["id_qualification"];
                        $result = mysqli_query($linc,$query) or die(mysqli_error($linc));
                        $row=mysqli_fetch_array($result,MYSQLI_NUM);

                        function selected( $value, $remember ){
                            return
                                $value == $remember ? 'selected' : null;
                        }

                        ?>
                    </span>
                </p>
            </i>
        </h2>
    </header>
    <div id="main">
        <div class="flex-container-1">
            <div class="flex-element" id="menu" >
                <form  action="Discipline.php" method="POST">
                    <ul>
                        <li><a href="National_framework.php">Національна рамка</a></li>
                        <li><a href="Contents_and_results.php">Зміст та результати</a></li>
                        <li><a href="">Список студентів</a></li>
                        <li><a href="">Предмети</a></li>
                        <li><a href="">Оцінки</a></li>
                        <li><a href="kabinet.php">Список спеціальностей</a></li>
                        <li><input type='button' value="Завантажити Exel" action="upload.php"></li>
                    </ul>
                </form>
            </div>
            <div class="flex-element" id="content">
                <form  action="Discipline.php" method="POST">
                <input type="submit" name="addDiscipline" value="Додати предмет"/>
                <input type='submit'  name='save' value="Зберегти"/>
                <div class="flex-container-2">
                    <?php
                    $query="SELECT
                              For_save.Numberdisciplines
                            FROM For_save
                            WHERE For_save.Qualification_ID =".$_SESSION["id_qualification"];
                    $result = mysqli_query($linc,$query) or die(mysqli_error($linc));
                    $row=mysqli_fetch_array($result,MYSQLI_NUM);
                    ?>

                    <p class="flex-element-2">Очікувана кількість предметів</p>
                    <input class="flex-element-2" name="text_num_2" id="text_num_2" type="number" disabled="disabled" value=<?php echo '"'.$row[0].'"';?> >

                    <?php
                    $query="SELECT
                            COUNT(Discipline.Discipline_ID) AS expr1
                            FROM Discipline
                            WHERE Discipline.Qualification_ID =".$_SESSION["id_qualification"];
                    $result = mysqli_query($linc,$query) or die(mysqli_error($linc));
                    $num=mysqli_fetch_array($result,MYSQLI_NUM);
                    ?>

                    <p class="flex-element-2">Реальна кількість предметів</p>
                    <input class="flex-element-2" name="text_num_2" id="text_num_2" type="number" disabled="disabled" value=<?php echo '"'.$num[0].'"';?>>
                </div>
                </form>
                <div class="el">
                <table class="display-table" border="1">
                    <thead>
                    <tr>
                        <th scope="col">Текстовое поле</th>
                        <th scope="col">Текстовое поле</th>
                        <th scope="col">Числовое поле</th>
                        <th scope="col">Числовое поле</th>
                        <th scope="col">числовое поле</th>
                        <th scope="col">checkbox</th>
                        <th scope="col">Семестр</th>
                        <th scope="col">Прізвище викладача</th>
                        <th scope="col">Додання/видалення строки</th>
                    </tr>
                    </thead>
                    <?php

                    $query="SELECT
                          Discipline.Discipline_ID,
                          Discipline.Course_title_UA,
                          Discipline.Course_title_EN,
                          Discipline.Loans,
                          Discipline.Hours,
                          Discipline.Teaching,
                          Discipline.Differential,
                          Discipline.Semester,
                          Discipline.Teacher_ID
                        FROM Discipline
                        WHERE Discipline.Qualification_ID = ".$_SESSION["id_qualification"];
                    $result = mysqli_query($linc,$query) or die(mysqli_error($linc));
                    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                        printf('
                    <form name="table" method="post">
                        <tbody id="dynamic">
                            <tr>
                                <td style="display: none">
                                    <input type="text" name="Discipline_ID" value="%s">
                                </td>
                                <td>
                                    <input type="text" name="Course_title_UA" value="%s">
                                </td>
                                <td>
                                    <input type="text" name="Course_title_EN" value="%s">
                                </td>
                                <td>
                                    <input name="Loans" type="text"  value="%s" pattern="^[ 0-9]+$">
                                </td>
                                <td>
                                    <input name="Hours" type="text" value="%s" pattern="\d+(,\d{2})?">
                                </td>
                                <td>
                                    <label>
                                        <select name="Teaching">
                                            <option value="1" <?=selected("1",$row[5] )?>1</option>
                                            <option value="2" <?=selected("2",$row[5] )?>2</option>
                                            <option value="3" <?=selected("3",$row[5] )?>3</option>
                                            <option value="4" <?=selected("4",$row[5] )?>4</option>
                                        </select>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <select name="Differential">
                                            <option value="Оцінка" <?=selected("Оцінка",$row[6] )?>Оцінка</option>
                                            <option value="Зарах" <?=selected("Зарах",$row[6] )?>Зарах</option>
                                        </select>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <select name="Discipline.Semester">
                                            <option value="1" <?=selected("1",$row[6])?>1</option>
                                            <option value="2" <?=selected("2",$row[6])?>2</option>
                                            <option value="3" <?=selected("3",$row[6])?>3</option>
                                            <option value="4" <?=selected("4",$row[6])?>4</option>
                                            <option value="5" <?=selected("5",$row[6])?>5</option>
                                            <option value="6" <?=selected("6",$row[6])?>6</option>
                                        </select>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <select name=\"Discipline.Teacher_ID\">
                                            <!--<option value=\'0\'>Выбор</option>-->
                                               %s 
                                        </select>
                                    </label> 
                                </td>
                                <td>
                                    <button type="button" class="add">+</button>
                                    <button type="button" class="del">-</button>
                                </td>
                            </tr>
                    </form>',$row[0],$row[1],$row[2],$row[3],$row[4],select($row[7]));
                    }
                    ?>
                    <form name="table" method="post">
                        <tr CLASS="dynamicExample" style="display: none">
                            <td style="display: none">
                                <input type="text" name="Discipline_ID" value="NaN">
                            </td>
                            <td>
                                <input type="text" name="text" value="Значение 1">
                            </td>
                            <td>
                                <input type="text" name="text" value="Значение 1">
                            </td>
                            <td>
                                <input type="text" name="text" value="Значение 1">
                            </td>
                            <td>
                                <input type="text" name="text" value="Значение 1">
                            </td>
                            <td>
                                <label>
                                    <select name="Teaching">
                                        <option value="1" >1</option>
                                        <option value="2" >2</option>
                                        <option value="3" >3</option>
                                        <option value="4" >4</option>
                                    </select>
                                </label>
                            </td>
                            <td>
                                <label>
                                    <select name="Differential">
                                        <option value="Оцінка" >Оцінка</option>
                                        <option value="Зарах" >Зарах</option>
                                    </select>
                                </label>
                            </td>
                            <td>
                                <label>
                                    <select name="Discipline.Semester">
                                        <option value="1" >1</option>
                                        <option value="2" >2</option>
                                        <option value="3" >3</option>
                                        <option value="4" >4</option>
                                        <option value="5" >5</option>
                                        <option value="6" >6</option>
                                    </select>
                                </label>
                            </td>
                            <td>
                                <?php
                                $sql = "SELECT Teacher.* FROM Teacher";
                                $result_select = mysqli_query($linc, $sql);?>
                                <label>
                                    <select name="Discipline.Teacher_ID">

                                        <?php
                                        while($object = mysqli_fetch_object($result_select)){
                                            echo "<option value = '$object->Teacher_ID' > $object->Lastname </option>";}
                                        ?>
                                    </select>
                                </label>
                            </td>
                            <td>
                                <button type="button" class="add">+</button>
                                <button type="button" class="del">-</button>
                            </td>
                        </tr>
                        </tbody>
                    </form >
                </table>
            </div  >
            <form name="sub" method="POST" >
                <input type="submit" action="function_Disciplines.php" value="SEND" style="margin: 10px">
            </form>
        </div>
        </div>
    <script src="../js/DynamicTableOld.js"></script>
    <script>
        new DynamicTable( document.getElementById("dynamic") );
    </script>
</body>

