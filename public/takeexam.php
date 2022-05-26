<?php
  include_once "../database.php";
  include_once "../core.php";

    // echo "<pre>";
    //   var_dump($_POST);
    //   echo "</pre>";
    $exam_key = $_POST["examKey"];

    //retrieve Exam Query
    $retrieve_exam_query = "SELECT * FROM exam WHERE ExamKey = " . $exam_key;
    $retrieve_exam_row = mysqli_query($conn, $retrieve_exam_query);
    if (mysqli_num_rows($retrieve_exam_row) > 0) {
      $exam_row = mysqli_fetch_assoc($retrieve_exam_row);
    }
    //Declaring received data from the database
    $rec_questions = [];
    //Query to receive question from Database
    $retrieve_question_query = "SELECT QuestionList FROM question WHERE ID = " . $exam_row["QuestionID"];
    $rec_question_row = mysqli_query($conn, $retrieve_question_query);
    //Storing retreived questions
    if (mysqli_num_rows($rec_question_row) > 0) {
      $row = mysqli_fetch_assoc($rec_question_row);
      $rec_questions = json_decode($row["QuestionList"]);
    } else {
      echo "0 results";
    }
  
    for ($x = 0; $x < count($rec_questions); $x++) {
      array_push($rec_questions[$x], 0);
    }

    $current_exam = new Exam();

    $current_exam->name = $exam_row["Name"];
    $current_exam->teacherID = $exam_row["ExaminerID"];
    $current_exam->status = $exam_row["Status"];
    $current_exam->duration = $exam_row["Duration"];
    $current_exam->key = $exam_row["ExamKey"];
    $current_exam->questions = $rec_questions;
    $current_exam->date = $exam_row["Date"];

    $current_exam = json_encode($current_exam);

    echo "<p class=\"hidden\" id = \"current-exam\">".$current_exam."</p>";
    
    echo "<pre>";
      var_dump($_POST);
      echo "</pre>";


    //SENDING Examinee DATA


    $insert_examinee_query = $conn->prepare('INSERT INTO examinee (FullName, Email, SchoolID, Sex, ExamKey, Section) VALUES (?,?,?,?,?, ?)');
    $insert_examinee_query->bind_param("ssssss", $_POST["examineeName"], $_POST["examineeEmail"], $_POST["examineeID"], $_POST["sex"], $_POST["examKey"], $_POST["examineeSection"]);
    $insert_examinee_query->execute();


    
    if(!($_POST["institution"] == "none")){
      $update_examineeInst_row = mysqli_query($conn, "UPDATE examinee SET InstID = " . $_POST["institution"] . " WHERE examinee.SchoolID =". $_POST["examineeID"]);
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Take Exam</title>
  <link rel="icon" type="image/png" sizes="32x32" href="../favicon-32x32.png" />
  <link rel="stylesheet" href="css/style-reset.css" />
  <link rel="stylesheet" href="css/takeexam.css" />
</head>

<body>
  <div class="container">
    <main class="hidden">
      <div class="exam-container">

      <input type="hidden" name="examineeAnswers" id="">

      </div>
      <button id="submit-exam" type="submit" class="hidden">Submit</button>
    </main>
  </div>

  <div class="result hidden">
    <div class="result-box flex flex-col items-center justify-center">
      <h2 class="text-center" id="result-student-name">Student Name</h2>
      <h3 class="text-center" id="result-exam-name">Exam name</h3>
      <p>You scored <span id="score">6</span>/<span id="result-max">10</span> </p>
      <a href="../index.php" id="finish-exam"><button>Done</button></a>
    </div>
  </div>

  <div class="warning-modal hidden" id="warning-modal">
    <div class="warning-modal-content">
      <h2>You're not allowed to leave fullscreen mode!</h2>

      <p>Go back to fullscreen mode in <span id="remainingSeconds">0</span> or your test will be disqualified.</p>

      <p class="warning-btns">
        <button type="button" id="back-to-exam">Back to Exam</button>
        <button type="button" id="exit-exam"">Exit Anyways</button>
          </p>
      </div>
    </div>
  </body>
  <script src=" takeexam.js" type="module"></script>

</html>