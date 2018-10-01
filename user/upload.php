<?php
/**
 * Created by PhpStorm.
 * User: Влад
 * Date: 07.08.2018
 * Time: 11:29
 */
require_once 'excel_reader2.php';//подключаем библиотеку
session_start();
include '../connection.php';

if(isset($_POST['UPLOAD'])){//проверяем была ли отправлена форма
    $file=$_FILES['file'];
    //print_r($file);
    $fileName=$_FILES['file']['name']; //имя файла у пользователя
    $fileTmpName=$_FILES['file']['tmp_name'];//временное имя файла которое присваивает сервер именно эту перемунную используем как
    //имя файла в библиотеке
    $fileSize=$_FILES['file']['size']; // размер файла
    $fileError=$_FILES['file']['error'];//ошибки при загрузке
    $fileType=$_FILES['file']['type'];//расширение файла
    //echo $fileName;
    $fileExt=explode("." , $fileName); //получаем расширение файла
    $fileActualExt=strtolower(end($fileExt));//получаем расширение файла
    $allowed=array('xls');// тут в массиве указиваю допустимые расширеня файлов
    if(in_array($fileActualExt, $allowed)){//проверка на то является ли расширение файла допустимым из массива
        if($fileError===0){//проверка на наличие ошибок при загрузке
            if($fileSize < 5000000){//проверка на превышение размера файла
                $data = new Spreadsheet_Excel_Reader($fileTmpName);// записываем все инфу файла в переменную
                if(Chek($data,$num)){
                    $query = sprintf("UPDATE Qualification SET Qualification_EN = '%s'
                    , Qualification_UA = '%s',  Main_field_study_UA = '%s'
                    , Main_field_study_EN = '%s', Degree ='%s',   abbreviation = '%s'
                     WHERE User_ID = '" . $_SESSION['user_id'] . "' AND Qualification_ID ='" . $_SESSION["id_qualification"] . "'",
                        mysqli_real_escape_string($linc, $data->val(2, 2, 1)),
                        mysqli_real_escape_string($linc, $data->val(1, 2, 1)),
                        mysqli_real_escape_string($linc, $data->val(3, 2, 1)),
                        mysqli_real_escape_string($linc, $data->val(4, 2, 1)),
                        mysqli_real_escape_string($linc, $data->val(5, 2, 1)),
                        mysqli_real_escape_string($linc, $data->val(6, 2, 1))
                    );
                    mysqli_query($linc, $query) or die(mysqli_error($linc));
                }
                else{echo "There is an error in the design of the document";}

            } else {
                echo "Your file is too big!";
            }
        } else {
            echo "There was an error uploading your file!";
        }

    } else {
        echo "You cannot upload this file";
    }


}
function Chek($sheets,$num){
    if(count($sheets->sheets)< ($num+1)){
        return false;
    }
    if($num==1){
        for($i=1;$i<=6;$i++){
            if(($sheets->val($i,2,1))== null){
                return false;
            }
        }
        return true;

    }

}
?>