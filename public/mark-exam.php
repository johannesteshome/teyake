<?php
    if(!isset($_POST['examineeAnswers'])){
        header('Loaction: ../index.php');
    }

    $ExamAnswers = json_decode($_POST['examineeAnswers']);

    include_once "../shared/includes/database.php";

    $retrieve_answer = mysqli_query($conn, "SELECT AnswerList FROM answer WHERE ExamKey = '".$ExamAnswers[1]."'");
    if($retrieve_answer){
        $row = mysqli_fetch_assoc($retrieve_answer);
        $rec_answer = json_decode($row["AnswerList"]);
    }


    $mark = 0;
    $outOf = count($rec_answer);
    for ($i=0; $i < count($rec_answer); $i++) { 
        if($rec_answer[$i] == $ExamAnswers[0][$i]){
            $mark++;
        }
    }
    $ExamAnswers[0] = json_encode($ExamAnswers[0]);

    $update_examinee = mysqli_query($conn, "UPDATE `examinee` SET `Score` = '".$mark."', `AnswerList` = '".$ExamAnswers[0]."' WHERE `examinee`.`ID` = '".$ExamAnswers[2]."'");
    $remove_exam_query = mysqli_query($conn, ("DELETE FROM `inprogressexams` WHERE Email = '".$ExamAnswers[3]."' AND ExamKey = '".$ExamAnswers[1]."'"));
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/takeexam.css">
    <title>Result</title>
    <script>

    </script>
</head>

<body>
    <div class="result">
        <div class="result-box flex flex-col items-center justify-center">
            <h2 class="text-center" id="result-student-name">Student Name</h2>
            <h3 class="text-center" id="result-exam-name">Exam name</h3>
            <p>You scored <span id="score"><?php echo $mark ?></span>/<span id="result-max"><?php echo $outOf ?></span>
            </p>
            <a href="../index.php" id="finish-exam"><button>Done</button></a>
        </div>
    </div>
</body>

</html>