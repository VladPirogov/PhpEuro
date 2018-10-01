<?php

session_start();
include '../connection.php';


?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Генератор єврододатків</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="../js/input.js"></script>
    <script type="text/javascript" src="../js/DynamicTableOld.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/style2addQuali.css" rel="stylesheet">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
</head>
<body>
<header id="header">
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

<div id="main" >
    <div class="flex-container-1">
        <div class="flex-element" id="menu" >
            <ul>
                <li><a href="National_framework.php">Національна рамка</a></li>
                <li><a href="Contents_and_results.php">Зміст та результати</a></li>
                <li><a href="">Список студентів</a></li>
                <li><a href="Discipline.php">Предмети</a></li>
                <li><a href="">Оцінки</a></li>
                <li><a href="kabinet.php">Список спеціальностей</a></li>
                <li>
                    <form class="file_upload"
                          action="upload.php" method="POST" enctype="multipart/form-data" >
                        <div class="file_and_upload">
                            <label>
                                <input type="file" name="file">
                                <span>Оберіть файл</span>
                            </label>
                        </div>
                        <script>

                            $(document).ready( function() {
                                $(".file_and_upload input[type=file]").change(function(){
                                    var filename = $(this).val().replace(/.*\\/, "");
                                    $("#filename").val(filename);
                                });
                            });

                        </script>
                        <input type="text" id="filename" class="filename" disabled>
                        <button type="submit" name="UPLOAD">Оновити данні</button>
                    </form>
                </li>
                <li>
                    <form name="toWord" action="toWord.php" method="post" >
                        <button type="submit" name="Word">Створити ворд</button>
                    </form>
                </li>
                <li>
                    <form name="toPDF" action="toPDF.php">
                        <button type="submit" name="PDF">Створити pdf</button>
                    </form>
                </li>
            </ul>
        </div>
        <div class="flex-element" id="content">
            <form name="calc" class="calc">
                <table width="800" border="1" cellspacing="0" cellpadding="5">
                    <thead>
                    <tr>
                        <th scope="col">Товар</th>
                        <th scope="col">Цена, руб.</th>
                        <th scope="col">Количество</th>
                        <th scope="col">Стоимость, руб.</th>
                        <th scope="col">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody id="dynamic">
                    <tr>
                        <td>
                            <label>
                                <input type="text" name="text" value="Наименование">
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="number" value="0.00" required pattern="\d+(\.\d{2})?" >
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="number" value="0.000" required pattern="\d+(\.\d{3})?">
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="number" id="sum" required pattern="\d+(\.\d{2})?"  >
                            </label>
                        </td>
                        <td>
                            <button type="button" class="add">+</button>
                            <button type="button" class="del">-</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>



</body>
</html>
