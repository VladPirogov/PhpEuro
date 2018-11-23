<?php
/**
 * Created by PhpStorm.
 * User: Влад
 * Date: 06.07.2018
 * Time: 15:08
 */
session_start();
include '../connection.php';

if(isset($_POST['save'])){

    $query=sprintf("UPDATE Qualification SET Qualification_EN = '%s'
    , Qualification_UA = '%s',  Main_field_study_UA = '%s'
    , Main_field_study_EN = '%s', Degree ='%s',   abbreviation = '%s'
     WHERE User_ID = '".$_SESSION['user_id']."' AND Qualification_ID ='".$_SESSION["id_qualification"]."'",
        mysqli_real_escape_string($linc,$_POST['NameQ_Eng']),
        mysqli_real_escape_string($linc,$_POST['NameQ']),
        mysqli_real_escape_string($linc,$_POST['Main_field_study_UA']),
        mysqli_real_escape_string($linc,$_POST['Main_field_study_EN']),
        mysqli_real_escape_string($linc,$_POST['Degree']),
        mysqli_real_escape_string($linc,$_POST['abi'])
    );
    mysqli_query($linc,$query) or die(mysqli_error($linc));
           $query="UPDATE For_save
        SET Numberdisciplines = '".$_POST['text_num_2']."',
            Number_students = '".$_POST['text_num']."'
        WHERE Qualification_ID = '".$_SESSION['id_qualification']."'";
        mysqli_query($linc,$query) or die(mysqli_error($linc));

}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Генератор єврододатків</title>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/input.js"></script>
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
                    <li><a href="graduates.php">Список студентів</a></li>
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
                <form action="addQualification.php" method="POST">
                <div class="text_zone">
                    <p>Абривиатура</p>
                    <textarea name="abi" method="POST" required><?php echo $row[5];?></textarea>
                </div>
                <div class="text_zone">
                    <p>Оберіть ступінь освіти</p>
                    <select  name="Degree" method="POST">
                        <option value="Бакалавр" <?=selected("Бакалавр",$row[4] )?>>Бакалавр</option>
                        <option value="Магістр" <?=selected("Магістр",$row[4] )?>>Магістр</option>
                        <option value="Спеціаліст" <?=selected("Спеціаліст",$row[4] )?>>Спеціаліст</option>
                    </select>
                </div>
                <div class="text_zone">
                    <p>Повна назва</p>
                    <textarea name="NameQ" method="POST" required><?php echo $row[1];?></textarea>
                </div>
                <div class="text_zone">
                    <p>Повна назва английскою</p>
                    <textarea name="NameQ_Eng" method="POST" required><?php echo $row[0];?></textarea>
                </div>
                <div class="text_zone">
                    <p>Основний(і) напрям(и)підготовки за кваліфікацією</p>
                    <textarea name="Main_field_study_UA" method="POST" required><?php echo $row[2];?></textarea>
                </div>
                <div class="text_zone">
                    <p>Основний(і) напрям(и)підготовки за кваліфікацією английскою</p>
                    <textarea name="Main_field_study_EN" method="POST" required><?php echo $row[3];?></textarea>
                </div>
                <div class="flex-container-2">
                    <?php

                    $query="SELECT
                          For_save.Numberdisciplines,
                          For_save.Number_students
                        FROM For_save
                        WHERE For_save.Qualification_ID = ".$_SESSION["id_qualification"];
                    $result = mysqli_query($linc,$query) or die(mysqli_error($linc));
                    $row=mysqli_fetch_array($result,MYSQLI_NUM);

                    ?>
                    <p class="flex-element-2" >Очікувана кількість студентів</p>
                    <input class="flex-element-2" name="text_num" id="text_num" type="number" value=<?php echo '"'.$row[1].'"';?>>
                    <p class="flex-element-2">Очікувана кількість предметів</p>
                    <input class="flex-element-2" name="text_num_2" id="text_num_2" type="number" value=<?php echo '"'.$row[0].'"';?>>
                </div>
                <div class="save" action='addQualification.php' method='post'>
                    <input type='submit'  name='save' value="Зберегти"/>
                </div>
                </form>
            </div>
        </div>
    </div>



</body>
</html>
<?php


?>
