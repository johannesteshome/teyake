<?php
include_once "../shared/includes/database.php";
  session_start();
  if($_SESSION["login"] != "ok"){
    header('Location: signin.php');
  }
  $user_id = $_SESSION['id'];
  if(isset($_POST['status'])){
    include "../shared/includes/database.php";
    $rec_questionid_row = mysqli_query($conn, ("UPDATE exam SET Status='".$_POST['status']."' WHERE ExamKey='".$_POST['ExamKey']."';"));

  }
  $sql_email = "SELECT * FROM examiner WHERE id =$user_id";
  $result = mysqli_query($conn, $sql_email);
  $row = mysqli_fetch_assoc($result);
  $image_url = $row['ImageURL'];
  
  $sql_email = "SELECT Email FROM examiner WHERE id =$user_id";
  $result = mysqli_query($conn, $sql_email);
  $row = mysqli_fetch_assoc($result);
  $user_email = $row['Email'];
  $user_email_dir = str_replace(".", "_", $user_email);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard | Teyake</title>
    <link rel="stylesheet" href="css/style-reset.css" />
    <link rel="stylesheet" href="css/dashboard.css" />
</head>

<body>
    <div class="container">
        <header class="bg-primary">
            <div class="logo-box bg-secondary">
                <img src="./media/teyake_white_fill.png" alt="Teyake Logo" class="logo" />
            </div>
            <div class="nav-right">
                <a href="my_profile.php"><?php if($image_url == NULL): ?>
                    <img src="../public/media/images/user.png" alt="User Icon" width="50px" height="50px"
                        class="profileDisplay">
                    <?php elseif($image_url !=NULL): ?>
                    <img src=<?php echo"../public/uploads/".$user_email_dir.'/'.$image_url?> alt="User Icon"
                        width="50px" height="50px" class="profileDisplay">
                    <?php endif; ?>
                </a>
                <a href="../index.php?action=logout" class="transition" id="logout">Log Out</a>
            </div>
        </header>
        <main>
            <nav class="sidebar bg-primary">
                <div class="nav-list">
                    <ul>
                        <li class="list-item active">
                            <a href="#">Home</a>
                        </li>
                        <li class="list-item"><a href="#">Exam List</a></li>
                        <li class="list-item"><a href="#">New Exam</a></li>
                        <li class="list-item"><a href="#">Results</a></li>
                    </ul>
                </div>
            </nav>

            <div class="pages-container">
                <!-- DASHBOARD HOME -->
                <div class="page dashboard-home">
                    <div class="stat-container">
                        <div class="stat-card">
                            <svg xmlns="http://www.w3.org/2000/svg" class="account transition" viewBox="0 0 512 512">
                                <title>Person Circle</title>
                                <path
                                    d="M258.9 48C141.92 46.42 46.42 141.92 48 258.9c1.56 112.19 92.91 203.54 205.1 205.1 117 1.6 212.48-93.9 210.88-210.88C462.44 140.91 371.09 49.56 258.9 48zm126.42 327.25a4 4 0 01-6.14-.32 124.27 124.27 0 00-32.35-29.59C321.37 329 289.11 320 256 320s-65.37 9-90.83 25.34a124.24 124.24 0 00-32.35 29.58 4 4 0 01-6.14.32A175.32 175.32 0 0180 259c-1.63-97.31 78.22-178.76 175.57-179S432 158.81 432 256a175.32 175.32 0 01-46.68 119.25z" />
                                <path
                                    d="M256 144c-19.72 0-37.55 7.39-50.22 20.82s-19 32-17.57 51.93C191.11 256 221.52 288 256 288s64.83-32 67.79-71.24c1.48-19.74-4.8-38.14-17.68-51.82C293.39 151.44 275.59 144 256 144z" />
                            </svg>
                            <p>Students - <span id="studCount">
                                    <?php
                                include "../shared/includes/database.php";
                                $student_count_rec = mysqli_query($conn, ("SELECT COUNT(ID) FROM `examinee` INNER JOIN exam ON examinee.ExamKey=exam.ExamKey AND exam.ExaminerID='".$_SESSION['id']."';"));
                                if (mysqli_num_rows($student_count_rec) > 0) {
                                    $row = mysqli_fetch_assoc($student_count_rec);
                                    echo $row['COUNT(ID)'];
                                  }
                                ?>
                                </span></p>
                        </div>
                        <div class="stat-card">
                            <svg xmlns="http://www.w3.org/2000/svg" class="account transition" viewBox="0 0 512 512">
                                <title>Person Circle</title>
                                <path
                                    d="M258.9 48C141.92 46.42 46.42 141.92 48 258.9c1.56 112.19 92.91 203.54 205.1 205.1 117 1.6 212.48-93.9 210.88-210.88C462.44 140.91 371.09 49.56 258.9 48zm126.42 327.25a4 4 0 01-6.14-.32 124.27 124.27 0 00-32.35-29.59C321.37 329 289.11 320 256 320s-65.37 9-90.83 25.34a124.24 124.24 0 00-32.35 29.58 4 4 0 01-6.14.32A175.32 175.32 0 0180 259c-1.63-97.31 78.22-178.76 175.57-179S432 158.81 432 256a175.32 175.32 0 01-46.68 119.25z" />
                                <path
                                    d="M256 144c-19.72 0-37.55 7.39-50.22 20.82s-19 32-17.57 51.93C191.11 256 221.52 288 256 288s64.83-32 67.79-71.24c1.48-19.74-4.8-38.14-17.68-51.82C293.39 151.44 275.59 144 256 144z" />
                            </svg>
                            <p>Exams - <span id="examCount">
                                    <?php
                                include "../shared/includes/database.php";
                                $exam_count_rec = mysqli_query($conn, ("SELECT COUNT(ExamKey) FROM exam WHERE ExaminerID='".$_SESSION['id']."';"));
                                if (mysqli_num_rows($exam_count_rec) > 0) {
                                    $row = mysqli_fetch_assoc($exam_count_rec);
                                    echo $row['COUNT(ExamKey)'];
                                  }
                                ?>

                                </span></p>
                        </div>
                    </div>
                    <div class="center-content">
                        <div class="active-exams">
                            <h1 class="text-center bg-primary text-white">Active Exams</h1>
                            <div class="exam-list-head">
                                <p class="exam-name">Exam Name</p>
                                <p class="">Exam Key</p>
                                <p class="date-created">Date Created</p>
                                <p class="status">Status</p>
                            </div>
                            <div class="exam-tile-container">
                                <?php
                                include "../shared/includes/database.php";
                                $rec_questionid_row = mysqli_query($conn, ("SELECT Name, ExamKey, Status, Date, Duration FROM `exam` WHERE ExaminerID=\"".$_SESSION['id']."\" AND Status=\"open\""));

                                if (mysqli_num_rows($rec_questionid_row) > 0) {
                                    while($row = mysqli_fetch_assoc($rec_questionid_row)){
                                         echo  '<div class= "exam-tile relative">
                                          <p class="exam-name">'.$row['Name'].'</p>
                                            <p class="exam-key">'.$row['ExamKey'].'</p>
                                            <p class="date-created">'.$row['Date'].'</p>
                                            <p class="status">'.$row['Status'].'</p>
                                            </div>';

                                        }

                                  }

                                //   $conn->close();

                                ?>



                            </div>
                            <div class="btn-container">
                                <button type="button" id="add-btn" class="bg-primary text-white transition">
                                    Add Exam
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- EXAM LIST -->
                <div class="page exam-list">
                    <div class="center-content">
                        <!-- <form class="search-input">
                <input
                  type="text"
                  name="search-bar"
                  id="search-bar"
                  placeholder="Enter Search Text"
                />
                <button type="submit" id="search-btn">Search</button>
              </form> -->
                        <div class="all-exams">
                            <h1 class="text-center bg-primary text-white">All Exams</h1>
                            <div class="exam-list-head">
                                <p class="exam-name">Exam Name</p>
                                <p class="">Exam Key</p>
                                <p class="date-created">Date Created</p>
                                <p class="status">Status</p>
                            </div>
                            <div class="all-exam-container">
                                <?php
                                include "../shared/includes/database.php";
                                $rec_questionid_row = mysqli_query($conn, ("SELECT Name, ExamKey, Status, Date, Duration FROM `exam` WHERE ExaminerID=\"".$_SESSION['id']."\""));

                                if (mysqli_num_rows($rec_questionid_row) > 0) {
                                    while($row = mysqli_fetch_assoc($rec_questionid_row)){
                                        $btn = ($row['Status'] == "open")?"close":"open";
                                         echo  '<div class= "exam-tile all-exam-item relative">
                                          <p class="exam-name">'.$row['Name'].'</p>
                                            <p class="exam-key">'.$row['ExamKey'].'</p>
                                            <p class="date-created">'.$row['Date'].'</p>
                                            <div id="status">
                                            <p class="status">'.$row['Status'].'</p>
                                            <form action="" method="post">
                                            <input type="hidden" value="'.$btn.'" name="status">
                                            <input type="hidden" value="'.$row['ExamKey'].'" name="ExamKey">
                                            <button type="submit" class="toggle-exam">'.$btn.'</button>
                                            </form>
                                            </div>
                                            </div>';

                                        }

                                  }

                                //   $conn->close();

                                ?>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- ADD EXAM -->
                <div class="add-exam-container">
                    <div class="page add-exam flex flex-col items-center">
                        <div class="input-card add-exam-name">
                            <form action="addExam.php" method="POST" name="newExam" enctype=”multipart/form-data”>
                                <h2 class="input-card-title text-center bg-primary text-white">
                                    Create New Exam
                                </h2>
                                <div class="input-card-content flex flex-col items-center">
                                    <input type="text" id="add-exam-name" placeholder="Enter the Exam Name"
                                        name="exam-name" />
                                    <label for="add-exam-name">Assign the exam name(to be shown to students)</label>
                                </div>
                                <div class="input-card-content flex flex-col items-center">
                                    <input type="number" id="add-exam-name" placeholder="Enter the Exam Duration"
                                        name="exam-duration" />
                                    <label for="add-exam-name">Duration</label>
                                </div>
                        </div>
                        <div class="input-card student-info">
                            <h2 class="input-card-title text-center bg-primary text-white">
                                Student Information
                            </h2>
                            <div class="input-card-content">
                                <p>Required Student Information</p>
                                <div class="information-list">
                                    <ul>
                                        <li class="info-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="info-icon"
                                                viewBox="0 0 512 512">
                                                <title>Checkbox</title>
                                                <path fill="none" stroke="orange" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="32"
                                                    d="M352 176L217.6 336 160 272" />
                                                <rect x="64" y="64" width="384" height="384" rx="48" ry="48" fill="none"
                                                    stroke="orange" stroke-linejoin="round" stroke-width="32" />
                                            </svg>
                                            <span class="info-test"> Full Name </span>
                                        </li>
                                        <li class="info-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="info-icon"
                                                viewBox="0 0 512 512">
                                                <title>Checkbox</title>
                                                <path fill="none" stroke="orange" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="32"
                                                    d="M352 176L217.6 336 160 272" />
                                                <rect x="64" y="64" width="384" height="384" rx="48" ry="48" fill="none"
                                                    stroke="orange" stroke-linejoin="round" stroke-width="32" />
                                            </svg>
                                            <span class="info-test"> Student ID </span>
                                        </li>
                                        <li class="info-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="info-icon"
                                                viewBox="0 0 512 512">
                                                <title>Checkbox</title>
                                                <path fill="none" stroke="orange" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="32"
                                                    d="M352 176L217.6 336 160 272" />
                                                <rect x="64" y="64" width="384" height="384" rx="48" ry="48" fill="none"
                                                    stroke="orange" stroke-linejoin="round" stroke-width="32" />
                                            </svg>
                                            <span class="info-test"> Email Address </span>
                                        </li>
                                        <li class="info-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="info-icon"
                                                viewBox="0 0 512 512">
                                                <title>Checkbox</title>
                                                <path fill="none" stroke="orange" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="32"
                                                    d="M352 176L217.6 336 160 272" />
                                                <rect x="64" y="64" width="384" height="384" rx="48" ry="48" fill="none"
                                                    stroke="orange" stroke-linejoin="round" stroke-width="32" />
                                            </svg>
                                            <span class="info-test"> Phone Number </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="proceed-to-write">Continue</button>
                    </div>
                    <!-- Write Exam -->
                    <div class="page write-exam flex flex-col items-center hidden">
                        <!-- HIDDEN WAS HERE-->
                        <div class="write-exam-card exam-name">
                            <h2 class="write-exam-title text-center bg-primary text-white flex justify-between">
                                Add Questions
                                <button type="button" id="finalize-btn">Finalize Exam</button>
                            </h2>

                            <div class="hidden" id="submit-form">
                                <input type="hidden" name="finishedTest" id="finishedTest" value="">
                            </div>

                            </form>


                            <form class="write-exam-content flex flex-col" action="" method="POST"
                                enctype=”multipart/form-data”>
                                <span id="question-number">Question 1</span>
                                <textarea name="" id="question-prompt" cols="30" rows="5"></textarea>
                                <div class="write-exam-btns flex justify-between items-center">
                                    <button type="button" id="add-choice">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <button type="button" id="add-question">
                                        Add Question
                                    </button>
                                </div>
                                <div class="choice-container"></div>
                            </form>
                        </div>
                        <form action="cancelExam()" method="POST" enctype=”multipart/form-data”>
                            <!-- <button id="back-exam" type="button">Go Back</button> -->
                            <button id="cancel-exam" type="button">Cancel Exam</button>
                        </form>

                        <div class="input-card exam-bank-container">
                            <h2 class="input-card-title text-center bg-primary text-white">
                                Exam Bank
                            </h2>
                            <div class="input-card-content flex flex-col items-center">
                                <input type="text" id="exam-bank-search" placeholder="Search" name="exam-bank-search" />
                            </div>
                            <?php 
                                include_once "../shared/includes/database.php";
                                include_once "../shared/core.php";

                                $examList = [];

                                $exam_select_row = mysqli_query($conn, "SELECT * FROM `exam` WHERE `ExaminerID`='".$_SESSION['id']."'" );
                                // 
                                while($row = mysqli_fetch_assoc($exam_select_row)){
                                    $exam = new Exam();

                                    $exam->name = $row["Name"];
                                    $exam->teacherID = $row["ExaminerID"];
                                    $exam->key = $row["ExamKey"];
                                    $exam->date = $row["Date"];
                                    $exam->status = $row["Status"];
                                    $exam->duration = $row["Duration"];
                                    
                                    $question_row = mysqli_query($conn, "SELECT * FROM `question` WHERE `ExamKey`='".$row['ExamKey']."'" );
                                    if($q_row = mysqli_fetch_assoc($question_row)){
                                        $exam->questions = json_decode($q_row["QuestionList"]);
                                    }
                                    $answer_row = mysqli_query($conn, "SELECT * FROM `answer` WHERE `ExamKey`='".$row['ExamKey']."'" );
                                    if($a_row = mysqli_fetch_assoc($answer_row)){
                                        $ans = json_decode($a_row["AnswerList"]);

                                    }
                                    // var_dump($ans);
                                    
                                    for ($i=0; $i < count($exam->questions) ; $i++) { 
                                        array_push($exam->questions[$i], $ans[$i]);
                                    }
                                    array_push($examList, $exam);
                                }
                                    $examList = json_encode($examList);
                                    // var_dump($examList);
                                    // echo "<br>";
                                    // echo "<br>";
                                    // $examListEnc = str_replace( "\\", "", $examListEnc );
                                    // $examListEnc = str_replace( "\"", "\\\"", $examListEnc );
                                    // echo "<br>";
                                    // var_dump($examListEnc);


                                    echo "<p class=\"hidden\" id=\"all-exams\">".$examList."</p>"
                                    ?>
                            <div class="exam-bank">
                                <div class="exam-bank-table" id="listingTable">

                                </div>
                                <div class="pagination-block">
                                    <span class="pageButton outline-none" id="button_prev">Prev</span>
                                    <span id="page_number" class="outline-none"></span>
                                    <span class="pageButton outline-none" id="button_next">Next</span>
                                </div>
                            </div>
                        </div>
                        <div class="selected-questions hide">
                            <span id="selected-questions-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" class="chevron" fill="none" viewBox="0 0 24 24"
                                    stroke="#000" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M5 11l7-7 7 7M5 19l7-7 7 7" />
                                </svg>
                            </span>
                            <div class="selected-questions-title">
                                <h3>Selected Questions</h3>
                                <button type="button" id="add-to-exam">Add</button>
                            </div>
                            <div class="selected-questions-list">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="preview-exam hidden">
                    <div class="preview-content hidden">
                        <h2 class="text-center">Exam Preview</h2>
                        <div class="preview-btns flex gap-4">
                            <button type="button" id="done-preview">Done</button>
                            <button type="button" id="cancel-preview">Cancel Exam</button>
                            <button type="button" id="close-preview">Go Back</button>
                        </div>
                        <div class="preview-question-list"></div>
                    </div>
                    <div class="edit-modal">
                        <textarea id="edit-question-prompt" cols="30" rows="10"></textarea>
                        <button type="button" id="done-edit">Done</button>
                        <button type="button" id="cancel-edit">Cancel</button>
                        <button type="button" id="add-choice-edit">Add Choice</button>
                        <div class="edit-choice-list"></div>
                    </div>
                </div>
            </div>
            <div class="results-page flex flex-col items-center justify-center">
                <div class="center-content">
                    <div class="student-results">
                        <h1 class="text-center bg-primary text-white">
                            Student Results
                        </h1>
                        <div class="result-list-head">
                            <p class="student-name">Student Name</p>
                            <p class="student-id">Student ID</p>
                            <p class="exam-name">Exam Name</p>
                            <p class="score">Score</p>
                        </div>
                        <?php
                                include "../shared/includes/database.php";
                                $rec_questionid_row = mysqli_query($conn, ("SELECT FullName,Score,exam.ExamKey, SchoolID , exam.Name, examinee.AnswerList FROM `examinee` INNER JOIN exam ON examinee.ExamKey=exam.ExamKey AND exam.ExaminerID='".$_SESSION['id']."';"));
                                $studentResult = [];
                                if ($rec_questionid_row) {
                                    while($row = mysqli_fetch_assoc($rec_questionid_row)){

                                $rec_answer_row = mysqli_query($conn, ("SELECT AnswerList FROM `answer` WHERE ExamKey='".$row['ExamKey']."'"));
                                $answer = mysqli_fetch_assoc($rec_answer_row);
                                $row['CorrectAnswer'] = $answer;

                                        array_push($studentResult, $row);

                                    }
                                }
                                echo '<p id="result-list" class="hidden">'.json_encode($studentResult).'</p>';
                                ?>
                        <div class="result-tile-container">

                        </div>
                    </div>
                </div>
            </div>
    </div>
    </main>
    </div>
</body>
<script src="./js/dashboard.js" type="module"></script>

</html>