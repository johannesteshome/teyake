<?php
    session_start();
    $_SESSION['id'] = 6;


$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");

include "./shared/includes/database.php";
$rec_questionid_row = mysqli_query($conn, ("SELECT FullName,Score,exam.ExamKey, SchoolID , exam.Name, examinee.AnswerList FROM `examinee` INNER JOIN exam ON examinee.ExamKey=exam.ExamKey AND exam.ExaminerID='".$_SESSION['id']."';"));
$studentResult = [];
if (mysqli_num_rows($rec_questionid_row) > 0) {
    while($row = mysqli_fetch_assoc($rec_questionid_row)){

$rec_answer_row = mysqli_query($conn, ("SELECT AnswerList FROM `answer` WHERE ExamKey='".$row['ExamKey']."'"));
$answer = mysqli_fetch_assoc($rec_answer_row);
$row['CorrectAnswer'] = $answer;

        array_push($studentResult, $row);

    }
    echo var_dump($studentResult);
  }


$txt = "FullName Of Examinee\tExamName\tSchoolID\tScore\t\n";
fwrite($myfile, $txt);
for ($i=0; $i < count($studentResult); $i++) { 
    $txt = $studentResult[$i]['FullName']."\t".$studentResult[$i]['Name']."\t".$studentResult[$i]['SchoolID']."\t".$studentResult[$i]['Score'];
    fwrite($myfile, $txt."\n");
}
fclose($myfile);
?>