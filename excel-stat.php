<?php

session_start();
$_SESSION['id'] = 6;


require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use PhpOffice\PhpSpreadsheet\Writer\Xlsx; 
  
// Creates New Spreadsheet 
$spreadsheet = new Spreadsheet(); 


  
// Retrieve the current active worksheet 
$sheet = $spreadsheet->getActiveSheet(); 

include "./shared/includes/database.php";
$rec_questionid_row = mysqli_query($conn, ("SELECT FullName,Score,exam.ExamKey, SchoolID , exam.Name, examinee.AnswerList FROM `examinee` INNER JOIN exam ON examinee.ExamKey=exam.ExamKey AND exam.ExaminerID='".$_SESSION['id']."';"));
$studentResult = [];
if (mysqli_num_rows($rec_questionid_row) > 0) {
    while($row = mysqli_fetch_assoc($rec_questionid_row)){
        array_push($studentResult, $row);
    }
  }

$sheet->setCellValue("A1", "Full Name");
$sheet->setCellValue("B1", "Exam Name");
$sheet->setCellValue("C1", "School ID");
$sheet->setCellValue("D1", "Score");
$sheet->setCellValue("E1", "Exam Key");


for ($i=0; $i < count($studentResult); $i++) { 
    $sheet->setCellValue("A".($i+2), $studentResult[$i]['FullName']);
    $sheet->setCellValue("B".($i+2), $studentResult[$i]['Name']);
    $sheet->setCellValue("C".($i+2), $studentResult[$i]['SchoolID']);
    $sheet->setCellValue("D".($i+2), $studentResult[$i]['Score']);
    $sheet->setCellValue("E".($i+2), $studentResult[$i]['ExamKey']);  
}


   
// Write an .xlsx file  
$writer = new Xlsx($spreadsheet); 
  
// Save .xlsx file to the files directory 
$writer->save('stat.xlsx'); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p><a href="stat.xlsx">Download Excel File</a></p>
</body>
</html>