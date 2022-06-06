<?php

include_once "../shared/includes/database.php";
include_once "../shared/core.php";
$payload = json_decode(file_get_contents('php://input'), true);

    $retrieve_exam_query = "SELECT * FROM exam WHERE ExamKey = '".$payload['examID']."'";
    $retrieve_exam_row = mysqli_query($conn, $retrieve_exam_query);
    if (mysqli_num_rows($retrieve_exam_row) > 0) {
      $exam_row = mysqli_fetch_assoc($retrieve_exam_row);
    }
    //Declaring received data from the database
    $rec_questions = [];
    //Query to receive question from Database
    $retrieve_question_query = "SELECT QuestionList FROM question WHERE ID = '".$exam_row["QuestionID"]."'";
    $rec_question_row = mysqli_query($conn, $retrieve_question_query);
    //Storing retreived questions
    if (mysqli_num_rows($rec_question_row) > 0) {
      $row = mysqli_fetch_assoc($rec_question_row);
      $rec_questions = json_decode($row["QuestionList"]);
    } else {
      echo "0 results";
    }
    $answer_row = mysqli_query($conn, "SELECT * FROM `answer` WHERE `ExamKey`='".$payload['examID']."'" );
    if($a_row = mysqli_fetch_assoc($answer_row)){
        $ans = json_decode($a_row["AnswerList"]);

    }
    // for ($x = 0; $x < count($rec_questions); $x++) {
    //   array_push($rec_questions[$x], 0);
    // }
    for ($i=0; $i < count($rec_questions) ; $i++) { 
        array_push($rec_questions[$i], $ans[$i]);
    }
    $current_exam = new Exam();

    $current_exam->name = $exam_row["Name"];
    $current_exam->teacherID = $exam_row["ExaminerID"];
    $current_exam->status = $exam_row["Status"];
    $current_exam->duration = $exam_row["Duration"];
    $current_exam->key = $exam_row["ExamKey"];
    $current_exam->questions = $rec_questions;
    $current_exam->date = $exam_row["Date"];

    echo json_encode($current_exam);
?>