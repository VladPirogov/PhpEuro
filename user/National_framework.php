<?php
/**
 * Created by PhpStorm.
 * User: Влад
 * Date: 09.08.2018
 * Time: 10:48
 */
session_start();
include '../connection.php';
if(isset($_POST['save'])){
    $query=sprintf("UPDATE National_framework
        SET Level_qualification_UA = '%s',
            Level_qualification_EN = '%s',
            Official_duration_programme_UA = '%s',
            Official_duration_programme_EN = '%s',
            Access_requirements_UA = '%s',
            Access_requirements_EN = '%s',
            Access_further_study_UA = '%s',
            Access_further_study_EN = '%s',
            Professional_status_UA = '%s',
            Professional_status_EN = '%s'
        WHERE Qualification_ID =".$_SESSION["id_qualification"],
        mysqli_real_escape_string($linc,$_POST['Level_qualification_UA']),
        mysqli_real_escape_string($linc,$_POST['Level_qualification_EN']),
        mysqli_real_escape_string($linc,$_POST['Official_duration_programme_UA']),
        mysqli_real_escape_string($linc,$_POST['Official_duration_programme_EN']),
        mysqli_real_escape_string($linc,$_POST['Access_requirements_UA']),
        mysqli_real_escape_string($linc,$_POST['Access_requirements_EN']),
        mysqli_real_escape_string($linc,$_POST['Access_further_study_UA']),
        mysqli_real_escape_string($linc,$_POST['Access_further_study_EN']),
        mysqli_real_escape_string($linc,$_POST['Professional_status_UA']),
        mysqli_real_escape_string($linc,$_POST['Professional_status_EN'])
    );
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
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/style2Nat_fram.css" rel="stylesheet">
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
                                  National_framework.Level_qualification_UA,
                                  National_framework.Level_qualification_EN,
                                  National_framework.Official_duration_programme_UA,
                                  National_framework.Official_duration_programme_EN,
                                  National_framework.Access_requirements_UA,
                                  National_framework.Access_requirements_EN,
                                  National_framework.Access_further_study_UA,
                                  National_framework.Access_further_study_EN,
                                  National_framework.Professional_status_UA,
                                  National_framework.Professional_status_EN
                                FROM National_framework
                                WHERE National_framework.Qualification_ID =".$_SESSION["id_qualification"];
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
    <form id="main" action="National_framework.php" method="POST">

        <div class="flex-container-1">
            <div class="flex-element" id="menu" >
                <ul>
                    <li><a href="addQualification.php">Спеціальність</a></li>
                    <li><a href="Contents_and_results.php">Зміст та результати</a></li>
                    <li><a href="">Список студентів</a></li>
                    <li><a href="">Предмети</a></li>
                    <li><a href="">Оцінки</a></li>
                    <li><a href="kabinet.php">Список спеціальностей</a></li>
                    <li><input type='button' value="Завантажити Exel" action="upload.php"></li>
                </ul>
            </div>
        <div class="flex-element" id="content">
            <div class="text_zone">
                <p>Рівень кваліфікації</p>
                <textarea name="Level_qualification_UA" method="POST" required><?php echo $row[0];?></textarea>
            </div>
            <div class="text_zone">
                <p>Рівень кваліфікації англійською</p>
                <textarea name="Level_qualification_EN" method="POST" required><?php echo $row[1];?></textarea>
            </div>
            <div class="text_zone">
                <p>Офіційна тривалість програми</p>
                <textarea name="Official_duration_programme_UA" method="POST" required><?php echo $row[2];?></textarea>
            </div>
            <div class="text_zone">
                <p>Офіційна тривалість програми англійською</p>
                <textarea name="Official_duration_programme_EN" method="POST" required><?php echo $row[3];?></textarea>
            </div>
            <div class="text_zone">
                <p>Вимоги до вступу</p>
                <textarea name="Access_requirements_UA" method="POST" required><?php echo $row[4];?></textarea>
            </div>
            <div class="text_zone">
                <p>Вимоги до вступу англійською</p>
                <textarea name="Access_requirements_EN" method="POST" required><?php echo $row[5];?></textarea>
            </div>
            <div class="text_zone">
                <p>Академічні права</p>
                <textarea name="Access_further_study_UA" method="POST" required><?php echo $row[6];?></textarea>
            </div>
            <div class="text_zone">
                <p>Академічні права англійською</p>
                <textarea name="Access_further_study_EN" method="POST" required><?php echo $row[7];?></textarea>
            </div>
            <div class="text_zone">
                <p>Професійні права</p>
                <textarea name="Professional_status_UA" method="POST" required><?php echo $row[8];?></textarea>
            </div>
            <div class="text_zone">
                <p>Професійні права англійською</p>
                <textarea name="Professional_status_EN" method="POST" required><?php echo $row[9];?></textarea>
            </div>
            <div class="save" action='National_framework.php' method='post'>
                <input type='submit'  name='save' value="Зберегти"/>
            </div>
        </div>
        </div>
    </form>

</body>
</html>
