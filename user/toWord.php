<?php

session_start();
include '../connection.php';//MySql

require '../vendor/autoload.php';


$query=sprintf();

//Загрузка шаблона
$_doc = new \PhpOffice\PhpWord\TemplateProcessor('Template.docx');

//Вставка значений

$_doc->setValue('d_num', '10/29-77-Ю');
$_doc->setValue('d_date',date("d/m/Y"));
$_doc->setValue('last_name','Пирогов');
$_doc->setValue('name', 'Владислав');
$_doc->setValue('surname','Николайович');


//Таблица
$_doc->cloneRow('table', 3);



//Сохранение документа в браузер
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment;filename="dogovor.docx"');
header('Cache-Control: max-age=0');
$_doc->saveAs('php://output');
die;

?>