<?php

    echo "<pre>";
        session_start();

        if($_SESSION['login'] != 'ok'){
          header("Location: signin.php");
        }


        include_once "../shared/includes/database.php";
        
      if(isset($_POST["finishedTest"])){
        $exam = json_decode($_POST["finishedTest"]);
        var_dump($exam);    
        $answers = [];
        for($x = 0; $x < count($exam->questions);$x++){
           array_push($answers, $exam->questions[$x][count($exam->questions[$x])-1]);
        }
        for($x = 0; $x < count($exam->questions);$x++){
           array_pop($exam->questions[$x]);
        }
        $answers = json_encode($answers);
        //SENDING EXAM DATA
        
        $examName = $exam->name;
        $examKey =  $exam->key;
        $examiner_id = $_SESSION['id'];
        $examStatus = $exam->status;
        $examDuration = $_POST['exam-duration'];
      
        
        $questions = json_encode($exam->questions);


        $insert_exam_query = $conn->prepare('INSERT INTO exam (Name, ExamKey, ExaminerID, Status, Duration) VALUES (?,?,?,?,?)');
        $insert_exam_query->bind_param("ssisi", $examName, $examKey, $examiner_id, $examStatus, $examDuration);
        $insert_exam_query->execute();
        
        
        $insert_question_query = $conn->prepare("INSERT INTO question (ExamKey, QuestionList) VALUES (?,?)");
        $insert_question_query->bind_param("ss", $examKey, $questions);
        $insert_question_query->execute();
      
        $insert_answer_query = $conn->prepare("INSERT INTO answer (ExamKey, AnswerList) VALUES (?,?)");
        $insert_answer_query->bind_param("ss", $examKey, $answers );
        $insert_answer_query->execute();

        var_dump($examKey);

        $rec_questionid_row = mysqli_query($conn, ("SELECT ID FROM question WHERE ExamKey=\"".$examKey."\""));
        if (mysqli_num_rows($rec_questionid_row) > 0) {
                $row = mysqli_fetch_assoc($rec_questionid_row);
                $rec_questionid = $row["ID"];
          }
        $rec_answerid_row = mysqli_query($conn, ("SELECT ID FROM answer WHERE ExamKey=\"".$examKey."\""));
        if (mysqli_num_rows($rec_answerid_row) > 0) {
                $row = mysqli_fetch_assoc($rec_answerid_row);
                $rec_answerid = $row["ID"];
          }
        $update_questionid_row = mysqli_query($conn, "UPDATE exam SET QuestionID = " . $rec_questionid . " WHERE exam.ExamKey=\"".$examKey."\"");
        $update_answerid_row = mysqli_query($conn, "UPDATE exam SET AnswerID = " . $rec_answerid . " WHERE exam.ExamKey=\"".$examKey."\"");

            header('Location: dashboard.php');

          };
          mysqli_close($conn);
    echo "</pre>";
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

</body>

</html>