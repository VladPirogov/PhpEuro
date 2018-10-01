<?php
/**
 * Created by PhpStorm.
 * User: Влад
 * Date: 01.10.2018
 * Time: 14:37
 */
session_start();
include '../connection.php';

function ()
{
    if(check())
    {
        if($_POST["Discipline_ID"]!="NaN")
        {
            $quer=sprintf("UPDATE Discipline
                    SET Course_title_UA = '%s',
                        Course_title_EN = '%s',
                        Loans = '%s',
                        Hours = '%s',
                        Teaching = '%s',
                        Differential = '%s',
                        Semester = '%s',
                        Teacher_ID ='%s'
                    WHERE Discipline_ID = ".$_POST["Discipline_ID"],
                mysqli_real_escape_string($linc,$_POST['Course_title_UA']),
                mysqli_real_escape_string($linc,$_POST['Course_title_EN']),
                mysqli_real_escape_string($linc,$_POST['Loans']),
                mysqli_real_escape_string($linc,$_POST['Hours']),
                mysqli_real_escape_string($linc,$_POST['Teaching']),
                mysqli_real_escape_string($linc,$_POST['Differential']),
                mysqli_real_escape_string($linc,$_POST['Semester']),
                mysqli_real_escape_string($linc,$_POST['Teacher_ID']));
        }
        else
        {

        }

    }

}
function check(){return true;}
?>