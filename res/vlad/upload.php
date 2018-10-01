<?php
if(isset($_POST['submit'])){//проверяем была ли отправлена форма
	$file=$_FILES['file'];
	//print_r($file);
	$fileName=$_FILES['file']['name']; //имя файла у пользователя
	$fileTmpName=$_FILES['file']['tmp_name'];//временное имя файла которое присваивает сервер именно эту перемунную используем как 
	//имя файла в библиотеке
	$fileSize=$_FILES['file']['size']; // размер файла
	$fileError=$_FILES['file']['error'];//ошибки при загрузке
	$fileType=$_FILES['file']['type'];//тип файла (расширение)
	//echo $fileName;
	$fileExt=explode("." , $fileName); //получаем расширение файла
	$fileActualExt=strtolower(end($fileExt));//получаем расширение файла
	$allowed=array('xls');// тут в массиве можно указать допустимые расширеня файлов
if(in_array($fileActualExt, $allowed)){//проверка на то является ли расширение файла допустимым из массива
		if($fileError===0){//проверка на наличие ошибок при загрузке
			if($fileSize < 50000){//проверка на превышение размера файла
				//$fileNameNew=uniqid('', true).".".$fileActualExt;//это если будешь загружать файл прям на сервер
				//$fileDestination='uploads/'.$fileNameNew;//это если будешь загружать файл прям на сервер
				//move_uploaded_file($fileTmpName, $fileDestination);//это если будешь загружать файл прям на сервер
				require_once 'excel_reader2.php'; //подключаем библиотеку, но лучше эту строчку перенести вверх файла, удобней
				$data = new Spreadsheet_Excel_Reader($fileTmpName);// записываем все инфу файла в переменную
				/*echo "<pre>";
				print_r($data);
				echo "</pre>"; *///можешь раскоментить тут служебная инфа по файлу
				 echo $data->dump(true,true);
				 //for ($i = 0; $i <= $data->sheets[0]['numRows']; $i++) {} //вот так можешь сделать цикл по строкам файла и 
				 //заполнить бд
				 // цикл по столбцам в строке. $data->sheets[0]['numCols'] - количество колонок
				  //for ($j = 0; $j <= $data->sheets[0]['numCols']; $j++) {
				    // выводим ячейку по ее СТРОКЕ ($i) и КОЛОНКЕ ($j)
				    // $data->sheets[0]['cells'] - двумерный массив ячеек
				//header("Location: example.php"); // это вернет обратно на форму загрузки файла 
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
?>