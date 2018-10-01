<?php
/**
 * Created by PhpStorm.
 * User: Влад
 * Date: 10.08.2018
 * Time: 11:58
 */
session_start();
include '../connection.php';
if(isset($_POST['save'])){
    $query=sprintf("UPDATE Contents_and_results
        SET Form_study_UA = '%s',
            Form_study_EN = '%s',
            Program_Specification_UA = '%s',
            Program_Specification_EN = '%s',
            Knowledge_undestanding_UA = '%s',
            Knowledge_undestanding_EN = '%s',
            Application_knowledge_understanding_UA = '%s',
            Application_knowledge_understanding_EN = '%s',
            Making_judgments_UA = '%s',
            Making_judgments_EN = '%s'
        WHERE Qualification_ID =".$_SESSION["id_qualification"],
        mysqli_real_escape_string($linc,$_POST['Form_study_UA']),
        mysqli_real_escape_string($linc,$_POST['Form_study_EN']),
        mysqli_real_escape_string($linc,$_POST['Program_Specification_UA']),
        mysqli_real_escape_string($linc,$_POST['Program_Specification_EN']),
        mysqli_real_escape_string($linc,$_POST['Knowledge_undestanding_UA']),
        mysqli_real_escape_string($linc,$_POST['Knowledge_undestanding_EN']),
        mysqli_real_escape_string($linc,$_POST['Application_knowledge_understanding_UA']),
        mysqli_real_escape_string($linc,$_POST['Application_knowledge_understanding_EN']),
        mysqli_real_escape_string($linc,$_POST['Making_judgments_UA']),
        mysqli_real_escape_string($linc,$_POST['Making_judgments_EN'])
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
                          Contents_and_results.Form_study_UA,
                          Contents_and_results.Form_study_EN,
                          Contents_and_results.Program_Specification_UA,
                          Contents_and_results.Program_Specification_EN,
                          Contents_and_results.Knowledge_undestanding_UA,
                          Contents_and_results.Knowledge_undestanding_EN,
                          Contents_and_results.Application_knowledge_understanding_UA,
                          Contents_and_results.Application_knowledge_understanding_EN,
                          Contents_and_results.Making_judgments_UA,
                          Contents_and_results.Making_judgments_EN
                        FROM Contents_and_results
                        WHERE Contents_and_results.Qualification_ID =".$_SESSION["id_qualification"];
                        $result = mysqli_query($linc,$query) or die(mysqli_error($linc));
                        $row=mysqli_fetch_array($result,MYSQLI_NUM);
                        ?>
                        </span>
            </p>
        </i>
    </h2>
</header>
<form id="main" action="Contents_and_results.php" method="POST">

    <div class="flex-container-1">
        <div class="flex-element" id="menu" >
            <ul>
                <li><a href="addQualification.php">Спеціальність</a></li>
                <li><a href="National_framework.php">Національна рамка</a></li>
                <li><a href="">Список студентів</a></li>
                <li><a href="">Предмети</a></li>
                <li><a href="">Оцінки</a></li>
                <li><a href="kabinet.php">Список спеціальностей</a></li>
                <li><input type='button' value="Завантажити Exel" action="upload.php"></li>
            </ul>
        </div>
        <div class="flex-element" id="content">
            <div class="text_zone">
                <p>Форма навчання</p>
                <textarea name="Form_study_UA" method="POST" required><?php echo $row[0];?></textarea>
            </div>
            <div class="text_zone">
                <p>Форма навчання англійською</p>
                <textarea name="Form_study_EN" method="POST" required><?php echo $row[1];?></textarea>
            </div>
            <div class="text_zone">
                <p>Навчальний план</p>
                <textarea name="Program_Specification_UA" method="POST" required><?php echo $row[2];?></textarea>
            </div>
            <div class="text_zone">
                <p>Навчальний план англійською</p>
                <textarea name="Program_Specification_EN" method="POST" required><?php echo $row[3];?></textarea>
            </div>
            <div class="text_zone">
                <p>Знання і розуміння</p>
                <textarea name="Knowledge_undestanding_UA" method="POST" required><?php echo $row[4];?></textarea>
            </div>
            <div class="text_zone">
                <p>Знання і розуміння англійською</p>
                <textarea name="Knowledge_undestanding_EN" method="POST" required><?php echo $row[5];?></textarea>
            </div>
            <div class="text_zone">
                <p>Застосування знань і розумінь</p>
                <textarea name="Application_knowledge_understanding_UA" method="POST" required><?php echo $row[6];?></textarea>
            </div>
            <div class="text_zone">
                <p>Застосування знань і розумінь англійською</p>
                <textarea name="Application_knowledge_understanding_EN" method="POST" required><?php echo $row[7];?></textarea>
            </div>
            <div class="text_zone">
                <p>Формування суджень</p>
                <textarea name="Making_judgments_UA" method="POST" required><?php echo $row[8];?></textarea>
            </div>
            <div class="text_zone">
                <p>Формування суджень англійською</p>
                <textarea name="Making_judgments_EN" method="POST" required><?php echo $row[9];?></textarea>
            </div>
            <div class="save" action='Contents_and_results.php' method='post'>
                <input type='submit'  name='save' value="Зберегти"/>
            </div>
        </div>
    </div>
</form>


</body>
</html>
