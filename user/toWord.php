<?php

session_start();
include '../connection.php';
require '../vendor/autoload.php';

toword();
function  Toword()
{

    header('Content-Type: text/html; charset=utf-8');
    //MySql

    //require '../vendor/autoload.php';
    include '../connection.php';
    require '../vendor/autoload.php';

    $query="SELECT   graduates.*,  Qualification.*,  Contents_and_results.*,  National_framework.* FROM graduates ".
        "INNER JOIN Qualification ON graduates.Qualification_ID = Qualification.Qualification_ID ".
        "INNER JOIN Contents_and_results ON Contents_and_results.Qualification_ID = Qualification.Qualification_ID ".
        "INNER JOIN National_framework  ON National_framework.Qualification_ID = Qualification.Qualification_ID ".
        "WHERE Qualification.Qualification_ID = ". (string)1;
    $result = mysqli_query($linc,$query) or die(mysqli_error($linc));
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
//$query=sprintf();

//Загрузка шаблона
        $document = new PhpOffice\PhpWord\TemplateProcessor('Bachelor_Template.docx');

//Вставка значений
        $document->setValue('SerialDiploma', $row[7]);
        $document->setValue('numberDiploma', $row[8]);
        $document->setValue('numberAddition', $row[9]);
        $document->setValue('lastname_UA', $row[2]);
        $document->setValue('lastname_EN', $row[3]);
        $document->setValue('firstname_UA', $row[4]);
        $document->setValue('firstname_UA', $row[5]);

        $document->setValue('birthday', $row[6]);

        $document->setValue('qualification_UA', $row[25]);
        $document->setValue('qualification_EN', $row[24]);
        $document->setValue('FieldStudyUA', $row[32]);
        $document->setValue('FieldStudyEN', $row[33]);
        $document->setValue('FirstSpecialtyUA', $row[34]);
        $document->setValue('FirstSpecialtyEN', $row[35]);
        $document->setValue('SecondSpecialtyUA', $row[36]);
        $document->setValue('SecondSpecialtyEN', $row[37]);
        $document->setValue('SpecializationUA', $row[38]);
        $document->setValue('SpecializationEN', $row[39]);

        $document->setValue('durationProgram_UA', $row[54]);
        $document->setValue('durationProgram_EN', $row[55]);
        $document->setValue('accessRequiments_UA', $row[56]);
        $document->setValue('accessRequiments_EN', $row[57]);

        $document->setValue('modeStudy', $row[41]."/".$row[42]);
        $document->setValue('programSpecification_UA', $row[43]);
        $document->setValue('programSpecification_EN', $row[44]);

        $document->setValue('knowledgeUnderstanding_UA', $row[45]);
        $document->setValue('applyingKnowledge_UA', $row[47]);
        $document->setValue('quotas', $row[49]);

        $document->setValue('knowledgeUnderstanding_EN', $row[46]);
        $document->setValue('applyingKnowledge_UA', $row[48]);
        $document->setValue('quotas', $row[50]);

        $document->setValue('special_conditions', $row[56]);
        $document->setValue('Employment_history', $row[57]);

        $document->setValue('special_conditions', $row[60]);
        $document->setValue('Employment_history', $row[61]);

        $document->setValue('DurationOfTraining_UA', $row[13]);
        $document->setValue('DurationOfTraining_EN', $row[14]);

        $document->setValue('TrainingStar', $row[15]);
        $document->setValue('TrainingEnd', $row[16]);

        $document->setValue('DecisionDate', $row[18]);
        $document->setValue('ProtNum', $row[19]);

        $document->setValue('QualificationAwardedUA', $row[20]);
        $document->setValue('QualificationAwardedEN', $row[21]);

        $document->setValue('prevDocument_UA', $row[10]);
        $document->setValue('prevDocument_EN', $row[11]);

        $document->setValue('PrevSerialNumberAddition', $row[12]);
        $document->setValue('IssuedBy', $row[22]);


//Таблица
//$_doc->cloneRow('table', 3);


//Сохранение документа в браузер

        $temp_file = tempnam(sys_get_temp_dir(), 'PHPWord');
        $document->saveAs($temp_file);
//$document->saveAs('test.docx');
        header("Content-Disposition: attachment; filename='myFile.docx'");
        readfile($temp_file); // or echo file_get_contents($temp_file);
        unlink($temp_file);  // remove temp file
    }
}
?>