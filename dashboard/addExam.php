<?php
    echo "<pre>";
    
        include_once "../database.php";
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

        // $examName = $exam->name;
        // $examKey =  $exam->key;
        // $examiner_id = $exam->teacherID;
        // $examStatus = $exam->status;
        // $examDuration = 10;
        // $examDate = date("d/m/y");
        // $questions = json_encode($exam->questions);

        // $insert_exam_query = $conn->prepare('INSERT INTO exam (Name, ExamKey, ExaminerID, Status, Duration, Date) VALUES (?,?,?,?,?,?)');
        // $insert_exam_query->bind_param("ssisis", $examName, $examKey, $examiner_id, $examStatus, $examDuration, $examDate);
        // $insert_exam_query->execute();
        
        
        // $insert_question_query = $conn->prepare("INSERT INTO question (ExamKey, QuestionList) VALUES (?,?)");
        // $insert_question_query->bind_param("ss", $examKey, $questions);
        // $insert_question_query->execute();
      
        // $insert_answer_query = $conn->prepare("INSERT INTO answer (ExamKey, AnswerList) VALUES (?,?)");
        // $insert_answer_query->bind_param("ss", $examKey, $answers );
        // $insert_answer_query->execute();

        // $rec_questionid_row = mysqli_query($conn, "SELECT ID FROM question WHERE ExamKey = ".$exam_key);
        // if (mysqli_num_rows($rec_questionid_row) > 0) {
        //         $row = mysqli_fetch_assoc($rec_questionid_row);
        //         $rec_questionid = $row["ID"];
        //   }
        // $rec_answerid_row = mysqli_query($conn, "SELECT ID FROM answer WHERE ExamKey = ".$exam_key);
        // if (mysqli_num_rows($rec_answerid_row) > 0) {
        //         $row = mysqli_fetch_assoc($rec_answerid_row);
        //         $rec_answerid = $row["ID"];
        //   }
        // $update_questionid_row = mysqli_query($conn, "UPDATE exam SET QuestionID = " . $rec_questionid . " WHERE exam.ExamKey =". $exam_key);
        // $update_answerid_row = mysqli_query($conn, "UPDATE exam SET AnswerID = " . $rec_answerid . " WHERE exam.ExamKey =". $exam_key);

            // header('Location: ../dashboard/dashboard.php');

        





        //Declaring received data from the database
        $rec_questions = [];
        $rec_answers = [];

        //Query to receive answer from database
        $exam_key = 903;
        $retrieve_answer_query = "SELECT AnswerList FROM answer WHERE ExamKey = ".$exam_key;        
        $rec_answer_row = mysqli_query($conn, $retrieve_answer_query);
        //Storing retreived answer
        // echo "<pre>";
        //     var_dump($rec_answer_row);
        // echo "</pre>";
        if (mysqli_num_rows($rec_answer_row) > 0) {
                $row = mysqli_fetch_assoc($rec_answer_row);
              echo "Answers: " . $row["AnswerList"]. "<br>";  
              $rec_answers = json_decode($row["AnswerList"]);
          } 
          else {
            echo "0 results";
          }
        //Query to receive question from Database
        $retrieve_question_query = "SELECT QuestionList FROM question WHERE ExamKey = ".$exam_key;        
        $rec_question_row = mysqli_query($conn, $retrieve_question_query);
        //Storing retreived questions
        echo "<pre>";
        var_dump($rec_question_row);
        echo "</pre>";
        if (mysqli_num_rows($rec_question_row) > 0) {
                $row = mysqli_fetch_assoc($rec_question_row);
                // echo "<pre>";
                // var_dump(json_decode($row["QuestionList"]));
                // echo "</pre>";
                $rec_questions = json_decode($row["QuestionList"]);
          } else {
            echo "0 results";
          }
        
          for($x = 0; $x < count($rec_questions);$x++){
            array_push($rec_questions[$x], $rec_answers[$x]);
         }
        //  echo "<pre>";
        //  var_dump($rec_questions);
        //  echo "</pre>";
        //  echo "</br>";

        //retrieve Exam Query
        $retrieve_exam_query = "SELECT Name, Status, Duration, Date FROM exam WHERE ExamKey = ".$exam_key;
        $retrieve_exam_row = mysqli_query($conn, $retrieve_exam_query);
        if (mysqli_num_rows($retrieve_exam_row) > 0) {
            $row = mysqli_fetch_assoc($retrieve_exam_row);
            echo "<pre>";
            var_dump($row);
            echo "</pre>";
            // $retrieve_exam = json_decode($row);
      } 
      $rec_examinerid_row = mysqli_query($conn, "SELECT ExaminerID FROM exam WHERE ExamKey = ".$exam_key);
      if (mysqli_num_rows($rec_examinerid_row) > 0) {
              $row = mysqli_fetch_assoc($rec_examinerid_row);
              $rec_examinerid = $row["ExaminerID"];
        }

        
    };


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