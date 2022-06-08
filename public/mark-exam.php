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
    
    $retrieve_examinee_query = "SELECT * FROM examinee WHERE ID = '".$ExamAnswers[2]."'";
    $retrieve_examinee_row = mysqli_query($conn, $retrieve_examinee_query);
    if (mysqli_num_rows($retrieve_examinee_row) > 0) {
      $examinee_row = mysqli_fetch_assoc($retrieve_examinee_row);
      var_dump($examinee_row);
    }
    $retrieve_exam_query = "SELECT * FROM exam WHERE ExamKey = '".$ExamAnswers[1]."'";
    $retrieve_exam_row = mysqli_query($conn, $retrieve_exam_query);
    if (mysqli_num_rows($retrieve_exam_row) > 0) {
      $exam_row = mysqli_fetch_assoc($retrieve_exam_row);
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/takeexam.css">
    <link rel="stylesheet" href="css/style-reset.css">
    <title>Result</title>
    <script>

    </script>
</head>

<body>
    <div class="result">
        <div class="result-box flex flex-col items-center justify-center" style="border:2px solid black">
            <h2 class="text-center" id="result-student-name"><?php echo $examinee_row["FullName"] ?></h2>
            <h3 class="text-center" id="result-exam-name"><?php echo $exam_row["Name"] ?></h3>
            <p>You scored <span id="score"><?php echo $mark ?></span>/<span id="result-max"><?php echo $outOf ?></span>
            </p>
            <a href="../index.php" id="finish-exam"><button>Done</button></a>
        </div>
    </div>
</body>

</html>